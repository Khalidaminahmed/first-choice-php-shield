<?php
namespace FirstChoicePHPShield;

/**
 * Collects and logs scan results, both to screen and file.
 */
class Logger
{
    /** @var string */
    protected string $logFile;
    /** @var array */
    protected array $lines = [];
    /**
     * @param string $dir
     */
    public function __construct($dir)
    {
        if (!is_dir($dir)) mkdir($dir, 0755, true);
        $this->logFile = $dir . 'scan_' . date('Ymd_His') . '.log';
    }
    /**
     * Write a line to log and screen.
     * @param string $line
     * @param string $type
     */
    public function log($line, $type = 'info')
    {
        echo "$line\n";
        $this->lines[] = "[" . date('Y-m-d H:i:s') . "] $line";
    }
    /**
     * Finalize and write the log to disk.
     */
    public function finalize()
    {
        file_put_contents($this->logFile, implode(PHP_EOL, $this->lines));
    }
    /**
     * Get the log file path.
     * @return string
     */
    public function getLogFilePath(): string { return $this->logFile; }
}
