# 🚀 First Choice PHP Shield

**A powerful, open-source CLI security scanner for detecting PHP malware, backdoors, and performing forensic analysis.**

![License](https://img.shields.io/github/license/khalidaminahmed/first-choice-php-shield)
![PHP Version](https://img.shields.io/badge/PHP-%3E%3D7.4-blue)
![Version](https://img.shields.io/badge/version-1.0.0-blue)

---

## 💡 What is First Choice PHP Shield?

First Choice PHP Shield is an easy-to-use, command-line security scanner designed specifically for PHP applications. It detects malicious code, hidden payloads, and backdoors. It also helps identify how attackers infiltrate your application. This tool supports popular frameworks such as Laravel, WordPress, CodeIgniter, Magento, and other custom PHP applications.

---

## 📋 Prerequisites

* PHP 7.4 or higher
* Composer installed globally

---

## 📥 Installation

### Composer (recommended)

```bash
composer require khalidaminahmed/first-choice-php-shield
```

### Manual installation

```bash
git clone https://github.com/khalidaminahmed/first-choice-php-shield.git
cd first-choice-php-shield
composer install
```

---

## 🚦 Quick Start

Scan your PHP project:

```bash
php shield scan /path/to/your/project
```

Restore quarantined files (*restore feature for new log structure coming soon*):

```bash
php shield restore logs/shield-YYYY-MM-DD-HHMM.log
```

---

## 📖 Usage

### Example CLI Output

```bash
Scanning started...
[MALWARE] /var/www/html/uploads/shell.php - Eval Base64 Decode (high)
[SUSPICIOUS] /var/www/html/uploads/shell.php - Eval Base64 Decode (high)
[ENTROPY] /var/www/html/images/logo.png => 7.93
[CLEAN] /var/www/html/index.php

Scan completed: 1 malware, 1 suspicious, 1 entropy, 1 clean.
Logs available at: logs/shield-YYYY-MM-DD-HHMM-malware.log (also entropy, suspicious, clean logs)
```

---

## 📑 Scan Log Files

After each scan, First Choice PHP Shield creates four separate log files in the `logs/` directory:

* `*_malware.log` — Files confirmed as 100% malware (critical/high-severity signatures)
* `*_suspicious.log` — All files flagged as suspicious (malware patterns, heuristic or forensic findings, quarantine actions)
* `*_entropy.log` — Files with high entropy/obfuscation (including binaries, images, packed scripts, and encrypted files)
* `*_clean.log` — Files scanned and found clean

**Sample Output:**

```txt
[MALWARE] /var/www/html/uploads/shell.php - Eval Base64 Decode (high)
[SUSPICIOUS] /var/www/html/uploads/shell.php - Eval Base64 Decode (high)
[ENTROPY] /var/www/html/images/logo.png => 7.93
[CLEAN] /var/www/html/index.php
```

**Note:**

* **First Choice PHP Shield scans all file types and extensions by default.**
* Expect image, video, and binary files in the entropy log due to their high randomness.
* Review the malware log first for critical threats, then the suspicious and entropy logs for further investigation.

---

## ⚙️ Configuration Reference

### General configuration (`config/config.php`)

```php
define('PROJECT_ROOT', dirname(__DIR__));
define('LOG_DIR', PROJECT_ROOT . '/logs/');
define('QUARANTINE_ENABLED', true);
define('QUARANTINE_DIR', PROJECT_ROOT . '/quarantine/');
define('ENTROPY_THRESHOLD', 7.5);
```

### Email configuration (`config/email.php`)

```php
define('SMTP_HOST', 'smtp.example.com');
define('SMTP_PORT', 587);
define('SMTP_USER', 'user@example.com');
define('SMTP_PASSWORD', 'password');
define('EMAIL_ALERTS', true);
define('ALERT_RECIPIENT', 'admin@example.com');
```

### Example Signature (`signatures/default.json`)

```json
{
  "name": "PHP Web Shell - eval",
  "pattern": "eval\\s*\\(",
  "description": "Detects usage of eval() which is commonly abused"
}
```

---

## 📂 Directory Structure

```
first-choice-php-shield/
├── shield
├── signatures/
├── quarantine/
├── logs/
├── config/
├── src/
├── tests/
├── README.md
├── CONTRIBUTING.md
├── CODE_OF_CONDUCT.md
├── SECURITY.md
└── LICENSE
```

---

## 🔒 Security Policy

Report vulnerabilities responsibly via [SECURITY.md](SECURITY.md).

---

## 🤝 Contributing

Contributions are welcome! Check our [CONTRIBUTING.md](CONTRIBUTING.md) to get started. Look for issues labeled ["good first issue"](https://github.com/khalidaminahmed/first-choice-php-shield/issues?q=is%3Aissue+is%3Aopen+label%3A%22good+first+issue%22) or submit a PR for review. The scanner is cross-platform compatible (Linux, macOS, Windows).

---

## 📃 Code of Conduct

Please read and adhere to our [Code of Conduct](CODE_OF_CONDUCT.md) to maintain a respectful community.

---

## 🛠️ Troubleshooting

* **Permission denied errors:** Run `chmod +x shield`.
* **Missing logs:** Ensure the `logs` directory exists and has proper write permissions.

---

## ⚠️ Limitations and Known Issues

* Large files (>100MB) may slow down scanning.
* Does not detect encrypted malware unless signatures are explicitly provided.

---

## 📅 Roadmap

Upcoming features:

* Web-based dashboard
* Scheduled automatic scans
* Advanced heuristic and entropy analysis

---

## ✅ Automated Tests

Run PHPUnit tests:

```bash
vendor/bin/phpunit tests/
```

---

## 🙌 Credits

* **Lead Developer:** Khalid Amin Ahmed
* **Inspired by:** PHP Malware Finder, Linux Malware Detect (LMD), YARA
* **Contributors:** Valued open-source community

---

## 📄 License

[MIT License](LICENSE) – provided "as-is" with no warranty. Full details in LICENSE.

---

## 📧 Contact & Support

* **Issues:** [GitHub Issues](https://github.com/khalidaminahmed/first-choice-php-shield/issues)
* **Email:** [khalid@firstchoicecars.com](mailto:khalid@firstchoicecars.com)

---

**🔐 Protect your PHP applications proactively. Detect, quarantine, and investigate threats before they become incidents.**
