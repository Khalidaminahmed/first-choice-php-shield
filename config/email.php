<?php
/**
 * Email Configuration for First Choice PHP Shield
 * @author First Choice Cars UAE
 * @license MIT
 */

return [
    // SMTP mail server host (e.g., smtp.gmail.com)
    'smtp_host'      => 'smtp.example.com',

    // SMTP server port (usually 587 for TLS, 465 for SSL)
    'smtp_port'      => 587,

    // SMTP username (your email address or login)
    'smtp_user'      => 'user@example.com',

    // SMTP password
    'smtp_password'  => 'your_password_here',

    // Encryption: 'tls', 'ssl', or leave empty for none
    'smtp_encryption' => 'tls',

    // The FROM address for outgoing scan reports and alerts
    'from_address'   => 'shield@firstchoicecars.com',
    'from_name'      => 'First Choice PHP Shield',

    // Enable or disable email alerts
    'email_alerts'   => true,

    // Recipient for admin/security notifications
    'alert_recipient' => 'admin@firstchoicecars.com',

    // Optional: CC or BCC addresses (array of emails)
    'cc'             => [],
    'bcc'            => [],

    // Email subject prefix
    'subject_prefix' => '[PHP Shield Alert]',
];
