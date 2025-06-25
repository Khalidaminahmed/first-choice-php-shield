<?php
namespace FirstChoicePHPShield;

/**
 * Main Scanner class - orchestrates the scanning process.
 */
class Scanner
{
    /** @var string */
    protected string $path;
    /** @var SignatureEngine */
    protected SignatureEngine $signatureEngine;
    /** @var EntropyEngine */
    protected EntropyEngine $entropyEngine;
    /** @var HeuristicEngine */
    protected HeuristicEngine $heuristicEngine;
    /** @var ForensicsEngine */
    protected ForensicsEngine $forensicsEngine;
    /** @var Logger */
    protected Logger $logger;
    /** @var Quarantine|null */
    protected ?Quarantine $quarantine;

    /**
     * Scanner constructor.
     * @param string $path
     * @param SignatureEngine $sig
     * @param EntropyEngine $entropy
     * @param HeuristicEngine $heuristics
     * @param ForensicsEngine $forensics
     * @param Logger $logger
     * @param Quarantine|null $quarantine
     */
    public function __construct(
        $path,
        SignatureEngine $sig,
        EntropyEngine $entropy,
        HeuristicEngine $heuristics,
        ForensicsEngine $forensics,
        Logger $logger,
        ?Quarantine $quarantine = null
    ) {
        $this->path = $path;
        $this->signatureEngine = $sig;
        $this->entropyEngine = $entropy;
        $this->heuristicEngine = $heuristics;
        $this->forensicsEngine = $forensics;
        $this->logger = $logger;
        $this->quarantine = $quarantine;
    }

    /**
     * Run the malware scan on the target path.
     */
    public function run()
    {
        $it = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($this->path, \FilesystemIterator::SKIP_DOTS)
        );
        foreach ($it as $file) {
            if (!is_file($file) || !is_readable($file)) continue;
            $content = @file_get_contents($file);
            if ($content === false) continue;

            $flagged = false;

            // Signature scan
            foreach ($this->signatureEngine->scan($content) as $sig) {
                $this->logger->log("[MATCH] $file => {$sig['name']} ({$sig['severity']})", 'match');
                $flagged = true;
            }
            // Entropy scan
            $entropy = Utils::entropy($content);
            if ($entropy > ENTROPY_THRESHOLD) {
                $this->logger->log("[ENTROPY] $file => $entropy", 'entropy');
                $flagged = true;
            }
            // Heuristic scan
            foreach ($this->heuristicEngine->detect($content) as $h) {
                $this->logger->log("[HEURISTIC] $file => {$h['name']} ({$h['severity']})", 'heuristic');
                $flagged = true;
            }
            // Forensics scan
            foreach ($this->forensicsEngine->analyzeFile($file, $content) as $f) {
                $this->logger->log("[FORENSIC] $file => {$f['issue']} | Fix: {$f['recommendation']}", 'forensic');
                $flagged = true;
            }
            // Quarantine
            if ($flagged && $this->quarantine) {
                $moved = $this->quarantine->move($file);
                $this->logger->log("[QUARANTINE] $file => $moved", 'match');
            }
            if (!$flagged) {
                $this->logger->log("[CLEAN] $file", 'clean');
            }
        }
    }
}
