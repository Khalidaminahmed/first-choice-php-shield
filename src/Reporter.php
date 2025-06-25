<?php
namespace FirstChoicePHPShield;

/**
 * Sends scan report via email.
 */
class Reporter
{
    /** @var string */
    protected string $email;
    /**
     * @param string $email
     */
    public function __construct(string $email) { $this->email = $email; }
    /**
     * Send scan report.
     * @param string $subject
     * @param string $message
     */
    public function sendReport(string $subject, string $message): void
    {
        mail($this->email, $subject, $message, 'From: scanner@yourdomain.com');
    }
}
