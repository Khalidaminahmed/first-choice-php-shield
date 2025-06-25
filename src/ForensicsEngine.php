<?php
namespace FirstChoicePHPShield;

/**
 * Traces code responsible for creating a backdoor (entry point).
 */
class ForensicsEngine
{
    /** @var array */
    protected array $entryPatterns = [
        [
            'name' => 'Unrestricted File Upload',
            'pattern' => '/move_uploaded_file\\s*\\(.*\\$_FILES.*\\)/i',
            'trigger' => 'Allows arbitrary uploads',
            'recommendation' => 'Restrict extensions and MIME types'
        ],
        [
            'name' => 'PHP File Write via POST',
            'pattern' => '/file_put_contents\\s*\\(.*\\$_POST.*\\.php/i',
            'trigger' => 'Writing PHP file from user input',
            'recommendation' => 'Block writing executable files from requests'
        ],
        [
            'name' => 'Dynamic Include with GET',
            'pattern' => '/include\\s*\\(\\s*\\$_(GET|REQUEST)/i',
            'trigger' => 'Remote file inclusion risk',
            'recommendation' => 'Avoid dynamic includes from user input'
        ],
        [
            'name' => 'Eval from User Input',
            'pattern' => '/eval\\s*\\(\\s*\\$_(GET|POST|REQUEST|COOKIE)/i',
            'trigger' => 'Remote code execution via eval',
            'recommendation' => 'Never evaluate user input'
        ]
    ];

    /**
     * Analyze a file's content for entry point patterns.
     * @param string $path
     * @param string $content
     * @return array
     */
    public function analyzeFile(string $path, string $content): array
    {
        $alerts = [];
        foreach ($this->entryPatterns as $pattern) {
            if (@preg_match($pattern['pattern'], $content)) {
                $alerts[] = [
                    'file' => $path,
                    'issue' => $pattern['name'],
                    'trigger' => $pattern['trigger'],
                    'recommendation' => $pattern['recommendation']
                ];
            }
        }
        return $alerts;
    }
}
