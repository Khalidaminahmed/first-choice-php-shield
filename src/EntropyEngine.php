<?php
namespace FirstChoicePHPShield;

/**
 * Detects high entropy (likely obfuscated/encoded) content.
 */
class EntropyEngine
{
    /** @var float */
    protected float $threshold;
    /**
     * @param float $threshold
     */
    public function __construct(float $threshold = 5.5) { $this->threshold = $threshold; }
    /**
     * Calculate entropy of a string.
     * @param string $data
     * @return float
     */
    public function getEntropy(string $data): float {
        $h = 0; $len = strlen($data); if ($len === 0) return 0;
        $freq = count_chars($data, 1);
        foreach ($freq as $v) { $p = $v / $len; $h -= $p * log($p, 2); }
        return $h;
    }
    /**
     * Checks if data is high entropy.
     * @param string $data
     * @return bool
     */
    public function isHighEntropy(string $data): bool {
        return $this->getEntropy($data) >= $this->threshold;
    }
}
