<?php
namespace FirstChoicePHPShield;

/**
 * Utility static functions (entropy, etc).
 */
class Utils
{
    /**
     * Calculate Shannon entropy of string.
     * @param string $data
     * @return float
     */
    public static function entropy($data)
    {
        $h = 0;
        $len = strlen($data);
        if ($len === 0) return 0;
        $freq = count_chars($data, 1);
        foreach ($freq as $v) {
            $p = $v / $len;
            $h -= $p * log($p, 2);
        }
        return $h;
    }
}
