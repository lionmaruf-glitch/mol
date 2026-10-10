<?php
// ============================================
// CONFIGURATION — CHANGE THESE VALUES
// ============================================
define('SITE_USERNAME', 'maruf.bd');

// IMPORTANT: Generate new hash for your password!
// Visit: https://bcrypt-generator.com/  (rounds=12)
// Or use: php -r "echo password_hash('YourNewPassword', PASSWORD_BCRYPT);"
define('SITE_PASSWORD_HASH', '$2y$12$YourGeneratedHashHereReplaceThisWithRealHashXXXXXXXXXXXXXXXXX');

define('SESSION_TIMEOUT', 3600); // 1 hour in seconds
define('MAX_LOGIN_ATTEMPTS', 5);
define('LOCKOUT_TIME', 900); // 15 minutes

// Document metadata
define('DOC_ID', 'MARUF-MOL-2026-001');
define('HEARING_DATE', '12 October 2026 — 1:00 PM');
?>