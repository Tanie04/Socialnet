<?php
session_start();
if(!isset($_SESSION['user_id'])) { header("Location: signin.php"); exit(); }
?>
<!DOCTYPE html>
<html>
<head>
    <title>About Me - SocialNet</title>
    <style>
        * { font-family: 'Sonorous', sans-serif; box-sizing: border-box; }
        body { background-color: #DACADD; margin: 0; padding: 0; }
        .main-content { display: flex; flex-direction: column; align-items: center; width: 100%; padding-top: 30px; }
        .container { width: 90%; max-width: 800px; background: white; padding: 50px; border-radius: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); text-align: center; }
        h1 { color: #5B3765; font-size: 2.5rem; margin-bottom: 30px; }
        .info-box { display: inline-block; text-align: left; margin: 0 auto; }
        .info-row { margin: 20px 0; font-size: 1.3rem; color: #333; }
        .label { font-weight: bold; color: #5B3765; width: 150px; display: inline-block; }
    </style>
</head>
<body>
    <?php include 'menubar.php'; ?>
    <div class="main-content">
        <div class="container">
            <h1>Student Information</h1>
            <hr style="border: 0; border-top: 1px solid #eee; margin-bottom: 40px;">
            <div class="info-box">
                <div class="info-row"><span class="label">Name:</span> TRAN YEN NHI</div>
                <div class="info-row"><span class="label">Student ID:</span> 20239595</div>
                <div class="info-row"><span class="label">School:</span> HUST - SoICT</div>
            </div>
            <p style="margin-top: 50px; color: #75c9c8; font-style: italic;">This is a mock social network project for Web Application course.</p>
        </div>
    </div>
</body>
</html>
