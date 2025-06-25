<?php
namespace FirstChoicePHPShield;

/**
 * Class Scanner
 *
 * Main Scanner class - orchestrates the malware scanning process.
 * Scans directories recursively for malware using signature, entropy,
 * heuristic, and forensic detection engines. Supports optional quarantine of flagged files.
 *
 * @package FirstChoicePHPShield
 */
class Scanner
{
    /** @var string Path to scan */
    protected string $path;

    /** @var SignatureEngine Signature-based detection engine */
    protected SignatureEngine $signatureEngine;

    /** @var EntropyEngine Entropy/obfuscation detection engine */
    protected EntropyEngine $entropyEngine;

    /** @var HeuristicEngine Heuristic-based detection engine */
    protected HeuristicEngine $heuristicEngine;

    /** @var ForensicsEngine Forensic/metadata analysis engine */
    protected ForensicsEngine $forensicsEngine;

    /** @var Logger Logger instance for logging scan results */
    protected Logger $logger;

    /** @var Quarantine|null Optional quarantine handler */
    protected ?Quarantine $quarantine;

    /**
     * Scanner constructor.
     *
     * @param string          $path         Path to scan
     * @param SignatureEngine $sig          Signature-based engine
     * @param EntropyEngine   $entropy      Entropy-based engine
     * @param HeuristicEngine $heuristics   Heuristic engine
     * @param ForensicsEngine $forensics    Forensics engine
     * @param Logger          $logger       Logger for output
     * @param Quarantine|null $quarantine   Optional quarantine handler
     */
    public function __construct(
        string $path,
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
     * Scans all files recursively and logs detections.
     *
     * @return void
     */
    public function run(): void
    {
        $it = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($this->path, \FilesystemIterator::SKIP_DOTS)
        );
        foreach ($it as $file) {
            if (!is_file($file) || !is_readable($file)) continue;

            // SCAN EVERY FILE, NO FILTERING ON EXTENSION

            $content = @file_get_contents($file);
            if ($content === false) continue;

            $flagged = false;

            // Signature scan (also log as "malware" if severity is high/critical)
            foreach ($this->signatureEngine->scan($content) as $sig) {
                $this->logger->logSuspicious((string)$file, "{$sig['name']} ({$sig['severity']})");
                if (in_array(strtolower($sig['severity']), ['critical', 'high'])) {
                    $this->logger->logMalware((string)$file, "{$sig['name']} ({$sig['severity']})");
                }
                $flagged = true;
            }
            // Entropy scan
            $entropy = Utils::entropy($content);
            if ($entropy > ENTROPY_THRESHOLD) {
                $this->logger->logEntropy((string)$file, $entropy);
                $flagged = true;
            }
            // Heuristic scan
            foreach ($this->heuristicEngine->detect($content) as $h) {
                $this->logger->logSuspicious((string)$file, "Heuristic: {$h['name']} ({$h['severity']})");
                // Optionally, you could log certain heuristics as malware here as well
                $flagged = true;
            }
            // Forensics scan
            foreach ($this->forensicsEngine->analyzeFile($file, $content) as $f) {
                $this->logger->logSuspicious((string)$file, "Forensic: {$f['issue']} | Fix: {$f['recommendation']}");
                // Optionally, you could log certain forensics as malware here as well
                $flagged = true;
            }
            // Quarantine if flagged and enabled
            if ($flagged && $this->quarantine) {
                $moved = $this->quarantine->move($file);
                $this->logger->logSuspicious((string)$file, "[QUARANTINE] => $moved");
            }
            // Log clean file
            if (!$flagged) {
                $this->logger->logClean((string)$file);
            }
        }
    }
}
