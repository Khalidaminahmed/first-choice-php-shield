<?php
namespace FirstChoicePHPShield;

/**
 * Handles moving flagged files to a quarantine folder.
 */
class Quarantine
{
    /** @var string */
    protected string $path;
    /**
     * @param string $path
     */
    public function __construct(string $path)
    {
        if (!is_dir($path)) mkdir($path, 0755, true);
        $this->path = $path;
    }
    /**
     * Move a file to quarantine.
     * @param string $file
     * @return string|null
     */
    public function move(string $file): ?string
    {
        $dest = $this->path . '/' . basename($file) . '_' . time();
        return rename($file, $dest) ? $dest : null;
    }
}
