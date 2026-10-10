<?php
require_once 'config.php';
require_once 'auth.php';

session_start();

$ip = get_client_ip();

// Brute-force protection
if (!isset($_SESSION['login_attempts'])) $_SESSION['login_attempts'] = 0;
if (!isset($_SESSION['last_attempt'])) $_SESSION['last_attempt'] = 0;

if ($_SESSION['login_attempts'] >= MAX_LOGIN_ATTEMPTS) {
    if (time() - $_SESSION['last_attempt'] < LOCKOUT_TIME) {
        header('Location: index.php?error=locked');
        exit;
    } else {
        // Reset after lockout period
        $_SESSION['login_attempts'] = 0;
    }
}

// Only POST allowed
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

// Validate
if ($username === SITE_USERNAME && password_verify($password, SITE_PASSWORD_HASH)) {
    // SUCCESS
    session_regenerate_id(true);
    $_SESSION['logged_in'] = true;
    $_SESSION['username'] = $username;
    $_SESSION['last_activity'] = time();
    $_SESSION['created'] = time();
    $_SESSION['login_attempts'] = 0;
    $_SESSION['ip'] = $ip;

    header('Location: dashboard.php');
    exit;
} else {
    // FAILURE
    $_SESSION['login_attempts']++;
    $_SESSION['last_attempt'] = time();
    header('Location: index.php?error=invalid');
    exit;
}
?>