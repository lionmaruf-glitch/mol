<?php
require_once 'config.php';
session_start();
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
<title>🔐 Entry — Case Dossier</title>
<style>
  *{box-sizing:border-box;margin:0;padding:0}
  body{
    font-family:'Segoe UI',Tahoma,Arial,sans-serif;
    background:linear-gradient(135deg,#0b3d91,#062a63);
    min-height:100vh; display:flex; align-items:center;
    justify-content:center; padding:20px;
  }
  .entry-box{
    background:#fff; border-radius:16px; padding:44px 36px;
    width:100%; max-width:460px;
    box-shadow:0 25px 70px rgba(0,0,0,.45);
    text-align:center;
  }
  .logo{font-size:58px; margin-bottom:14px}
  .entry-box h1{
    color:#0b3d91; font-size:24px; margin-bottom:6px;
  }
  .entry-box .sub{
    color:#666; font-size:14px; margin-bottom:22px;
    padding-bottom:20px; border-bottom:2px dashed #e0e0e0;
  }
  .flag-row{
    display:flex; justify-content:center; gap:18px;
    margin-bottom:26px; font-size:34px;
  }
  .flag-row span{opacity:.7}
  .entry-btn{
    display:block; width:100%; padding:16px;
    background:#0b3d91; color:#fff; border:none;
    border-radius:10px; font-size:17px; font-weight:700;
    cursor:pointer; transition:.2s; text-decoration:none;
    margin-bottom:12px;
  }
  .entry-btn:hover{background:#062a63; transform:translateY(-2px)}
  .entry-btn.secondary{
    background:#fff; color:#0b3d91;
    border:2px solid #0b3d91;
  }
  .entry-btn.secondary:hover{background:#f0f4fa}
  .lock-icon{text-align:center; font-size:42px; margin-bottom:8px}
  label{
    display:block; text-align:left; font-size:13px;
    color:#333; font-weight:600; margin-bottom:6px;
  }
  input[type="text"],input[type="password"]{
    width:100%; padding:13px 14px; font-size:15px;
    border:1.5px solid #d0d5db; border-radius:8px;
    margin-bottom:16px; font-family:inherit;
  }
  input:focus{
    outline:none; border-color:#0b3d91;
    box-shadow:0 0 0 3px rgba(11,61,145,.12);
  }
  .error{
    background:#fde8ec; color:#c8102e; padding:12px;
    border-radius:8px; font-size:13px; margin-bottom:16px;
    border-left:4px solid #c8102e; text-align:left;
  }
  .footer-note{
    text-align:center; font-size:11px; color:#999;
    margin-top:20px; padding-top:16px;
    border-top:1px solid #eee;
  }
  .hidden{display:none!important}
  .info-note{
    background:#eef6ff; color:#0b3d91;
    padding:11px; border-radius:8px;
    font-size:12px; margin-bottom:16px; text-align:left;
  }
</style>
</head>
<body>

<div class="entry-box">
  <div class="logo">⚖️</div>
  <h1>Case Dossier Portal</h1>
  <div class="sub">
    Habibur Rahman (Maruf) v. Al Yarmook Modern Trading LLC
  </div>

  <div class="flag-row">
    <span>🇬🇧</span><span>🇴🇲</span><span>🇧🇩</span>
  </div>

  <!-- ENTRY CHOICE BUTTONS -->
  <div id="choice-view">
    <div class="info-note">
      ℹ️ Choose an option below to enter the case dossier system.
    </div>

    <button class="entry-btn" onclick="showLogin()">
      🔓 Entry with Password
    </button>

    <a href="en.php" class="entry-btn secondary">
      🇬🇧 Read in English
    </a>
    <a href="ar.php" class="entry-btn secondary">
      🇴🇲 القراءة بالعربية
    </a>
    <a href="bn.php" class="entry-btn secondary">
      🇧🇩 বাংলায় পড়ুন
    </a>
  </div>

  <!-- LOGIN FORM (hidden initially) -->
  <div id="login-view" class="hidden">
    <div class="lock-icon">🔐</div>

    <?php if ($error): ?>
      <div class="error">⚠️ <?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form method="POST" action="login.php" autocomplete="off">
      <label for="username">Username / ইউজারনেম</label>
      <input type="text" id="username" name="username" required
             placeholder="Enter username" autofocus>

      <label for="password">Password / পাসওয়ার্ড</label>
      <input type="password" id="password" name="password" required
             placeholder="Enter password">

      <button type="submit" class="entry-btn">🔓 Entry / প্রবেশ</button>
    </form>

    <button class="entry-btn secondary" onclick="showChoice()">
      ← Back / পেছনে
    </button>
  </div>

  <div class="footer-note">
    Document ID: <?php echo DOC_ID; ?><br>
    Hearing: <?php echo HEARING_DATE; ?>
  </div>
</div>

<script>
function showLogin(){
  document.getElementById('choice-view').classList.add('hidden');
  document.getElementById('login-view').classList.remove('hidden');
}
function showChoice(){
  document.getElementById('choice-view').classList.remove('hidden');
  document.getElementById('login-view').classList.add('hidden');
}
</script>

</body>
</html>