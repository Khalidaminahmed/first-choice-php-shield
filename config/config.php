<?php
/**
 * First Choice PHP Shield - Config
 * Adjust these values for your environment.
 * @license MIT
 */
define('SCAN_PATH', __DIR__);
define('SIGNATURE_FILE', __DIR__ . '/signatures/default.json');
define('LOG_DIR', __DIR__ . '/logs/');
define('QUARANTINE_ENABLED', true);
define('QUARANTINE_DIR', __DIR__ . '/quarantine/');
define('ENTROPY_THRESHOLD', 5.5);
