<?php
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: signin.php"); exit(); }
?>

<!DOCTYPE html>
<html>
<head>
    <title>About Me - SocialNet</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f0f2f5; padding: 20px; }
        .card { background: white; padding: 40px; border-radius: 15px; max-width: 500px; margin: auto; text-align: center; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        .info { font-size: 1.2rem; color: #333; margin: 10px 0; }
        .label { font-weight: bold; color: #1877f2; }
    </style>
</head>
<body>
    <div class="card">
        <?php include 'menubar.php'; ?>
        <h1>Student Information</h1>
        <hr>
        <div class="info"><span class="label">Name:</span> Trần Yến Nhi</div>
        <div class="info"><span class="label">Student ID:</span> 20239595</div>
        <div class="info"><span class="label">School:</span> HUST - SoICT</div>
        <p style="margin-top: 20px; color: #777;">This is a mock social network project for Web Application course.</p>
    </div> </body> </html>
