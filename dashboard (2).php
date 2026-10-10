<?php
require_once 'config.php';
require_once 'auth.php';
require_login();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="robots" content="noindex, nofollow">
<title>Dashboard — Case Dossier</title>
<style>
  *{box-sizing:border-box;margin:0;padding:0}
  body{
    font-family:'Segoe UI',Tahoma,Arial,sans-serif;
    background:#f7f8fa; min-height:100vh; padding:30px 20px;
  }
  .container{max-width:900px; margin:0 auto}
  .header{
    background:linear-gradient(135deg,#0b3d91,#062a63);
    color:#fff; padding:26px; border-radius:12px;
    margin-bottom:22px; display:flex;
    justify-content:space-between; align-items:center;
    flex-wrap:wrap; gap:14px;
  }
  .header h1{font-size:20px}
  .header .sub{font-size:13px; opacity:.85; margin-top:4px}
  .logout-btn{
    background:#c8102e; color:#fff; text-decoration:none;
    padding:10px 20px; border-radius:8px; font-size:14px;
    font-weight:600;
  }
  .logout-btn:hover{background:#a10c24}
  .info-box{
    background:#fff; border-radius:12px; padding:22px;
    margin-bottom:22px; border-left:4px solid #0b3d91;
  }
  .info-box h2{color:#0b3d91; font-size:17px; margin-bottom:12px}
  .info-grid{
    display:grid; grid-template-columns:1fr 1fr;
    gap:10px; font-size:14px;
  }
  .info-grid div{padding:8px; background:#f7f8fa; border-radius:6px}
  .info-grid strong{color:#0b3d91}
  .lang-cards{
    display:grid; grid-template-columns:repeat(auto-fit,minmax(240px,1fr));
    gap:18px;
  }
  .lang-card{
    background:#fff; border-radius:14px; padding:32px 24px;
    text-align:center; text-decoration:none; color:inherit;
    border:2px solid #e0e5eb; transition:.25s;
    box-shadow:0 2px 6px rgba(0,0,0,.04);
  }
  .lang-card:hover{
    border-color:#0b3d91; transform:translateY(-4px);
    box-shadow:0 12px 28px rgba(11,61,145,.15);
  }
  .lang-card .flag{font-size:48px; margin-bottom:14px}
  .lang-card .name{font-size:20px; font-weight:700; color:#0b3d91}
  .lang-card .desc{font-size:13px; color:#666; margin-top:8px}
  @media(max-width:600px){
    .info-grid{grid-template-columns:1fr}
    .header h1{font-size:16px}
  }
</style>
</head>
<body>

<div class="container">

  <div class="header">
    <div>
      <h1>⚖️ Case Dossier Dashboard</h1>
      <div class="sub">Logged in as: <?php echo htmlspecialchars($_SESSION['username']); ?></div>
    </div>
    <a href="logout.php" class="logout-btn">🚪 Logout</a>
  </div>

  <div class="info-box">
    <h2>📋 Case Reference</h2>
    <div class="info-grid">
      <div><strong>Claimant:</strong> Habibur Rahman (Maruf)</div>
      <div><strong>Civil ID:</strong> 103352388</div>
      <div><strong>MOL REF:</strong> REF2607290085</div>
      <div><strong>Court Case:</strong> 1005/1215/2026</div>
      <div><strong>Hearing:</strong> 12 Oct 2026 — 1:00 PM</div>
      <div><strong>Total Claim:</strong> 6,317.000 OMR</div>
    </div>
  </div>

  <div class="lang-cards">
    <a href="en.php" class="lang-card">
      <div class="flag">🇬🇧</div>
      <div class="name">English</div>
      <div class="desc">View full case dossier in English</div>
    </a>
    <a href="ar.php" class="lang-card">
      <div class="flag">🇴🇲</div>
      <div class="name">العربية</div>
      <div class="desc">عرض ملف القضية بالكامل بالعربية</div>
    </a>
    <a href="bn.php" class="lang-card">
      <div class="flag">🇧🇩</div>
      <div class="name">বাংলা</div>
      <div class="desc">সম্পূর্ণ মামলা নথি বাংলায় দেখুন</div>
    </a>
  </div>

</div>

</body>
</html>