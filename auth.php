<?php
require_once 'config.php';

// Session security
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 1);
session_start();

// Check if logged in
function is_logged_in() {
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        return false;
    }
    // Session timeout check
    if (isset($_SESSION['last_activity']) && 
        (time() - $_SESSION['last_activity']) > SESSION_TIMEOUT) {
        session_unset();
        session_destroy();
        return false;
    }
    $_SESSION['last_activity'] = time();
    return true;
}

// Require login
function require_login() {
    if (!is_logged_in()) {
        header('Location: index.php?error=session_expired');
        exit;
    }
    // Regenerate session ID periodically (prevents hijacking)
    if (!isset($_SESSION['created'])) {
        $_SESSION['created'] = time();
    } elseif (time() - $_SESSION['created'] > 1800) {
        session_regenerate_id(true);
        $_SESSION['created'] = time();
    }
}

// Get client IP
function get_client_ip() {
    return $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? 'unknown';
}
?>