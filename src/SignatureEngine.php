<?php
namespace FirstChoicePHPShield;

/**
 * Loads and checks malware signatures (JSON patterns).
 */
class SignatureEngine
{
    /** @var array */
    protected array $sigs;
    /**
     * @param string $file Path to JSON signature file
     */
    public function __construct($file)
    {
        $this->sigs = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
    }
    /**
     * Scan a string for malware signatures.
     * @param string $str
     * @return array
     */
    public function scan($str): array
    {
        $out = [];
        foreach ($this->sigs as $sig) {
            if (@preg_match('/' . $sig['pattern'] . '/i', $str)) {
                $out[] = [
                    'name' => $sig['name'],
                    'severity' => $sig['severity'] ?? 'medium'
                ];
            }
        }
        return $out;
    }
}
