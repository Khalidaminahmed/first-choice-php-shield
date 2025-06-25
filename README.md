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

Restore quarantined files:

```bash
php shield restore logs/shield-YYYY-MM-DD-HHMM.log
```

---

## 📖 Usage

### Example CLI Output

```bash
Scanning started...
[WARNING] Malicious file detected: /var/www/html/uploads/shell.php
Signature: PHP Web Shell - system command
[QUARANTINE] File moved to /quarantine/shell.php

Scan completed: 1 threat detected and quarantined.
Logs available at: logs/shield-2025-06-25-1812.log
```

Restore quarantined files:

```bash
php shield restore logs/shield-2025-06-25-1812.log
```

---

## ⚙️ Configuration Reference

### General configuration (`config/config.php`)

```php
return [
    'quarantine_path' => __DIR__ . '/../quarantine/',
    'log_path' => __DIR__ . '/../logs/',
    'entropy_threshold' => 7.5,
];
```

### Email configuration (`config/email.php`)

```php
return [
    'smtp_host' => 'smtp.example.com',
    'smtp_port' => 587,
    'smtp_user' => 'user@example.com',
    'smtp_password' => 'password',
    'email_alerts' => true,
    'alert_recipient' => 'admin@example.com',
];
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

Contributions are welcome! Check our [CONTRIBUTING.md](CONTRIBUTING.md) to get started. Look for issues labeled ["good first issue"](https://github.com/khalidaminahmed/first-choice-php-shield/issues?q=is%3Aissue+is%3Aopen+label%3A%22good+first+issue%22) or submit a PR for review.

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
