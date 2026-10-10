<?php
require_once 'config.php';
session_start();

// Already logged in? Redirect
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header('Location: dashboard.php');
    exit;
}

$error = '';
if (isset($_GET['error'])) {
    if ($_GET['error'] === 'invalid') $error = 'Invalid username or password.';
    elseif ($_GET['error'] === 'locked') $error = 'Too many failed attempts. Try again in 15 minutes.';
    elseif ($_GET['error'] === 'session_expired') $error = 'Session expired. Please log in again.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="robots" content="noindex, nofollow">
<title>🔐 Secure Login — Case Dossier</title>
<style>
  *{box-sizing:border-box;margin:0;padding:0}
  body{
    font-family:'Segoe UI',Tahoma,Arial,sans-serif;
    background:linear-gradient(135deg,#0b3d91 0%,#062a63 100%);
    min-height:100vh; display:flex; align-items:center;
    justify-content:center; padding:20px;
  }
  .login-box{
    background:#fff; border-radius:14px; padding:40px 35px;
    width:100%; max-width:420px;
    box-shadow:0 20px 60px rgba(0,0,0,.4);
  }
  .login-box h1{
    color:#0b3d91; font-size:22px; text-align:center;
    margin-bottom:8px;
  }
  .login-box .sub{
    text-align:center; color:#666; font-size:13px;
    margin-bottom:26px; padding-bottom:18px;
    border-bottom:1px solid #e0e0e0;
  }
  .lock-icon{text-align:center; font-size:42px; margin-bottom:12px}
  label{
    display:block; font-size:13px; color:#333;
    font-weight:600; margin-bottom:6px;
  }
  input[type="text"],input[type="password"]{
    width:100%; padding:12px 14px; font-size:15px;
    border:1.5px solid #d0d5db; border-radius:8px;
    margin-bottom:16px; transition:.2s; font-family:inherit;
  }
  input:focus{
    outline:none; border-color:#0b3d91;
    box-shadow:0 0 0 3px rgba(11,61,145,.12);
  }
  button{
    width:100%; padding:13px; background:#0b3d91;
    color:#fff; border:none; border-radius:8px;
    font-size:16px; font-weight:600; cursor:pointer;
    transition:.2s;
  }
  button:hover{background:#062a63; transform:translateY(-1px)}
  button:active{transform:translateY(0)}
  .error{
    background:#fde8ec; color:#c8102e; padding:11px;
    border-radius:8px; font-size:13px; margin-bottom:16px;
    border-left:4px solid #c8102e;
  }
  .footer-note{
    text-align:center; font-size:11px; color:#999;
    margin-top:18px; padding-top:16px;
    border-top:1px solid #eee;
  }
</style>
</head>
<body>

<div class="login-box">
  <div class="lock-icon">🔐</div>
  <h1>Secure Access</h1>
  <div class="sub">Case Dossier — Habibur Rahman (Maruf)</div>

  <?php if ($error): ?>
    <div class="error">⚠️ <?php echo htmlspecialchars($error); ?></div>
  <?php endif; ?>

  <form method="POST" action="login.php" autocomplete="off">
    <label for="username">Username</label>
    <input type="text" id="username" name="username" required
           placeholder="Enter username" autofocus>

    <label for="password">Password</label>
    <input type="password" id="password" name="password" required
           placeholder="Enter password">

    <button type="submit">🔓 Login Securely</button>
  </form>

  <div class="footer-note">
    Protected by PHP Session Authentication<br>
    Document ID: <?php echo DOC_ID; ?>
  </div>
</div>

</body>
</html>