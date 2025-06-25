<?php
namespace FirstChoicePHPShield;

/**
 * Logger
 * 
 * Handles logging of scan results into separate files for entropy-based, 
 * suspicious, clean, and confirmed malware file detections.
 * 
 * @author  First Choice Cars UAE
 * @license MIT
 */
class Logger
{
    /**
     * @var string Path to the base filename (without extension)
     */
    protected string $baseFile;

    /**
     * @var string Path to entropy log file
     */
    protected string $entropyFile;

    /**
     * @var string Path to suspicious log file
     */
    protected string $suspiciousFile;

    /**
     * @var string Path to malware log file
     */
    protected string $malwareFile;

    /**
     * @var string Path to clean files log file
     */
    protected string $cleanFile;

    /**
     * @var resource File handle for entropy log
     */
    protected $entropyHandle;

    /**
     * @var resource File handle for suspicious log
     */
    protected $suspiciousHandle;

    /**
     * @var resource File handle for malware log
     */
    protected $malwareHandle;

    /**
     * @var resource File handle for clean files log
     */
    protected $cleanHandle;

    /**
     * Logger constructor.
     * 
     * @param string $dir Directory to store log files
     */
    public function __construct(string $dir)
    {
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $this->baseFile        = $dir . 'scan_' . date('Ymd_His');
        $this->entropyFile     = $this->baseFile . '_entropy.log';
        $this->suspiciousFile  = $this->baseFile . '_suspicious.log';
        $this->malwareFile     = $this->baseFile . '_malware.log';
        $this->cleanFile       = $this->baseFile . '_clean.log';

        $this->entropyHandle     = fopen($this->entropyFile, 'a');
        $this->suspiciousHandle  = fopen($this->suspiciousFile, 'a');
        $this->malwareHandle     = fopen($this->malwareFile, 'a');
        $this->cleanHandle       = fopen($this->cleanFile, 'a');
    }

    /**
     * Log an entropy-based detection.
     * 
     * @param string $filepath File path detected
     * @param float  $score    Calculated entropy score
     * @return void
     */
    public function logEntropy(string $filepath, float $score): void
    {
        $line = "[ENTROPY] $filepath => $score";
        echo $line . "\n";
        fwrite($this->entropyHandle, $line . "\n");
    }

    /**
     * Log a suspicious detection (malware pattern, heuristic, forensic, etc.).
     * 
     * @param string $filepath File path detected
     * @param string $reason   Reason for suspicion (pattern, heuristic, etc.)
     * @return void
     */
    public function logSuspicious(string $filepath, string $reason): void
    {
        $line = "[SUSPICIOUS] $filepath - $reason";
        echo $line . "\n";
        fwrite($this->suspiciousHandle, $line . "\n");
    }

    /**
     * Log a confirmed malware detection (100% certain, e.g., critical/high signature).
     * 
     * @param string $filepath File path detected
     * @param string $reason   Reason for detection (pattern, signature, etc.)
     * @return void
     */
    public function logMalware(string $filepath, string $reason): void
    {
        $line = "[MALWARE] $filepath - $reason";
        echo $line . "\n";
        fwrite($this->malwareHandle, $line . "\n");
    }

    /**
     * Log a clean (no threat) file.
     * 
     * @param string $filepath Clean file path
     * @return void
     */
    public function logClean(string $filepath): void
    {
        $line = "[CLEAN] $filepath";
        fwrite($this->cleanHandle, $line . "\n");
        // Optionally echo, but typically not for clean files
    }

    /**
     * Finalize and close all log files.
     * 
     * @return void
     */
    public function finalize(): void
    {
        fclose($this->entropyHandle);
        fclose($this->suspiciousHandle);
        fclose($this->malwareHandle);
        fclose($this->cleanHandle);
    }

    /**
     * Get the entropy log file path.
     * 
     * @return string
     */
    public function getEntropyLogFile(): string
    {
        return $this->entropyFile;
    }

    /**
     * Get the suspicious log file path.
     * 
     * @return string
     */
    public function getSuspiciousLogFile(): string
    {
        return $this->suspiciousFile;
    }

    /**
     * Get the malware log file path.
     * 
     * @return string
     */
    public function getMalwareLogFile(): string
    {
        return $this->malwareFile;
    }

    /**
     * Get the clean log file path.
     * 
     * @return string
     */
    public function getCleanLogFile(): string
    {
        return $this->cleanFile;
    }
}
