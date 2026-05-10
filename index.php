<?php
session_start();
include('db_connect.php');
if(!isset($_SESSION['user_id'])) { header("Location: signin.php"); exit(); }
$sql = "SELECT * FROM account WHERE id != " . $_SESSION['user_id'];
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home - SocialNet</title>
    <style>
        * { font-family: 'Sonorous', sans-serif; box-sizing: border-box; }
        body { background-color: #DACADD; margin: 0; padding: 0; }
        .main-content { display: flex; flex-direction: column; align-items: center; width: 100%; padding-top: 30px; }
        .container { width: 95%; max-width: 1000px; background: white; padding: 40px; border-radius: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        h1 { color: #5B3765; }
        .user-card { display: flex; justify-content: space-between; align-items: center; padding: 20px; border-bottom: 1px solid #f5f5f5; transition: 0.3s; border-radius: 15px; }
        .user-card:hover { background-color: #fcfaff; }
        .view-btn { background: #5B3765; color: white; padding: 10px 25px; border-radius: 25px; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>
    <?php include 'menubar.php'; ?>
    <div class="main-content">
        <div class="container">
            <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
            <h3 style="color: #75c9c8; margin-bottom: 30px;">Explore Other Users</h3>
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="user-card">
                    <span style="font-size: 1.2rem; color: #333;">
                        <strong><?php echo $row['fullname']; ?></strong> 
                        <span style="color: #5B3765; margin-left: 10px;">@<?php echo $row['username']; ?></span>
                    </span>
                    <a href="profile.php?id=<?php echo $row['id']; ?>" class="view-btn">View Profile</a>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>
