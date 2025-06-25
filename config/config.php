<?php
/**
 * First Choice PHP Shield - Config
 * Adjust these values for your environment.
 * @license MIT
 */

// Calculate project root directory (assuming config/ is inside project)
define('PROJECT_ROOT', dirname(__DIR__));

define('SCAN_PATH', PROJECT_ROOT); // Default scan path (overridden by CLI argument)
define('SIGNATURE_FILE', PROJECT_ROOT . '/signatures/default.json');
define('LOG_DIR', PROJECT_ROOT . '/logs/');
define('QUARANTINE_ENABLED', true);
define('QUARANTINE_DIR', PROJECT_ROOT . '/quarantine/');
define('ENTROPY_THRESHOLD', 5.5);
