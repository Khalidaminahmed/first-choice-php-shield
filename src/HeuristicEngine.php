<?php
namespace FirstChoicePHPShield;

/**
 * Scans for dangerous behavior patterns (function + input).
 */
class HeuristicEngine
{
    /** @var array */
    protected array $rules = [
        [
            'name' => 'POST + system()',
            'pattern' => '/\$_POST\s*\[\s*[\'"]\w+[\'"]\s*\].*?system\s*\(/is',
            'severity' => 'high'
        ],
        [
            'name' => 'assert($_REQUEST)',
            'pattern' => '/assert\s*\(\s*\$_(REQUEST|POST|GET)/i',
            'severity' => 'high'
        ],
        [
            'name' => 'upload + PHP extension',
            'pattern' => '/move_uploaded_file\s*\(.*?\.php[\'"]?/i',
            'severity' => 'medium'
        ],
        [
            'name' => 'preg_replace /e modifier',
            'pattern' => '/preg_replace\s*\(.*?\/e[\'"]?/i',
            'severity' => 'medium'
        ]
    ];
    /**
     * Detect dangerous code in a string.
     * @param string $content
     * @return array
     */
    public function detect(string $content): array
    {
        $results = [];
        foreach ($this->rules as $rule) {
            if (@preg_match($rule['pattern'], $content)) {
                $results[] = [
                    'name' => $rule['name'],
                    'severity' => $rule['severity']
                ];
            }
        }
        return $results;
    }
}
