# Contributing to First Choice PHP Shield

Thank you for your interest in contributing!

## How to Contribute

### 1. Search Before Submitting an Issue

Before opening a new issue, please search existing issues to avoid duplicates.

### 2. Open an Issue

Report bugs, suggest features, or ask questions using [GitHub Issues](https://github.com/khalidaminahmed/first-choice-php-shield/issues).

### 3. Fork the Repository

Click "Fork" on GitHub and work on your copy.

### 4. Sync Your Fork

Before starting your work, ensure your fork is synced with the main repository to avoid merge conflicts:

```bash
git remote add upstream https://github.com/khalidaminahmed/first-choice-php-shield.git
git fetch upstream
git checkout main
git merge upstream/main
```

### 5. Local Development Setup

* Clone your fork locally:

```bash
git clone https://github.com/your-username/first-choice-php-shield.git
cd first-choice-php-shield
composer install
```

* Run tests to ensure the setup is correct:

```bash
vendor/bin/phpunit tests/
```

### 6. Coding Standards

* Follow the style and structure used in the project.
* Write clean, well-documented code.
* Use clear and descriptive commit messages following conventional commits (e.g., `feat:`, `fix:`, `docs:`).
* Run linters and code formatters (e.g., PHP CS Fixer, PHPStan, or `.editorconfig`) before submitting your PR.

### 7. Test Coverage Requirements

All new features and bug fixes should include relevant unit, integration, or functional tests. Add tests under the appropriate test directory (`tests/unit/`, `tests/integration/`, or `tests/functional/`).

### 8. Pull Requests

* Make your changes in a new branch.
* Test your code thoroughly before submitting.
* Describe your changes clearly in the pull request.
* Reference relevant issues using keywords such as `Closes #X` or `Fixes #X` in the PR description.
* Ensure your pull request passes all existing and new tests.
* Update documentation (README, usage docs, configuration reference) when changing or adding features.

### 9. Proposing Major Changes

For major features or design proposals, open a discussion or issue first to ensure alignment with project maintainers.

### 10. Contribution Licensing

All contributions are licensed under the MIT License in line with the project's primary license.

### 11. Expected Review and Response Times

Project maintainers typically review pull requests within one week. Please allow time for reviews and discussions.

### 12. Issue and PR Templates

Use provided GitHub issue and PR templates when creating new issues or pull requests. Templates coming soon.

### 13. Contributing Non-Code Assets

We welcome contributions of non-code assets such as signature updates, translations, and documentation improvements. Open an issue or PR to suggest changes.

### 14. Project Roadmap

Check our roadmap (if available) to align your contributions with the project's upcoming features and goals.

### 15. Review and Approval Process

All contributions will be reviewed by project maintainers. Decisions are based on code quality, alignment with the project's direction, and passing tests.

### 16. Additional Resources

Review the main [README.md](README.md) for details on project structure, coding standards, and setup instructions.

### 17. Code of Conduct

Please read and follow our [Code of Conduct](CODE_OF_CONDUCT.md) to help foster a welcoming and respectful community.

### 18. Security Reporting

If you find a security vulnerability, please review our [SECURITY.md](SECURITY.md) and contact us privately at [khalid@firstchoicecars.com](mailto:khalid@firstchoicecars.com).

### 19. Accessibility & Translations

We encourage contributions that improve accessibility or help translate project resources into other languages. Please open an issue if interested!

### 20. "Good First Issue"

Look for issues labeled [good first issue](https://github.com/khalidaminahmed/first-choice-php-shield/issues?q=is%3Aissue+is%3Aopen+label%3A%22good+first+issue%22) to start contributing right away!

## Need Help?

Open an issue or email [khalid@firstchoicecars.com](mailto:khalid@firstchoicecars.com).

Thank you for contributing!
