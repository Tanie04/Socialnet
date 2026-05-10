<?php
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: signin.php"); exit(); }

$conn = new mysqli("localhost", "root", "Abc123", "socialnet");


$target_user = isset($_GET['owner']) ? $_GET['owner'] : "";

if ($target_user == "") {
    $my_id = $_SESSION['user_id'];
    $res = $conn->query("SELECT username FROM account WHERE id = $my_id");
    $me = $res->fetch_assoc();
    $target_user = $me['username'];
}


$stmt = $conn->prepare("SELECT fullname, username, description, avatar FROM account WHERE username = ?");
$stmt->bind_param("s", $target_user);
$stmt->execute();
$user_info = $stmt->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: sans-serif; background: #f0f2f5; padding: 20px; }
        .profile-card { background: white; padding: 30px; border-radius: 15px; max-width: 500px; margin: auto; text-align: center; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        .avatar-large { width: 150px; height: 150px; border-radius: 50%; object-fit: cover; border: 4px solid #fff; box-shadow: 0 2px 10px rgba(0,0,0,0.2); }
        .bio { font-style: italic; color: #666; margin-top: 15px; text-align: left; background: #f9f9f9; padding: 15px; border-radius: 8px; }
    </style>
</head>
<body>
    <div class="profile-card">
        <?php include 'menubar.php'; ?>
        
        <?php if ($user_info): ?>
            <img src="<?php echo $user_info['avatar']; ?>" class="avatar-large">
            
            <h1 style="margin-bottom: 5px;"><?php echo htmlspecialchars($user_info['fullname']); ?></h1>
            <p style="color: #1877f2; font-weight: bold;">@<?php echo htmlspecialchars($user_info['username']); ?></p>
            
            <div class="bio">
                <strong>About Me:</strong>
                <p><?php echo nl2br(htmlspecialchars($user_info['description'])); ?></p>
            </div>
        <?php else: ?>
            <p>User not found!</p>
        <?php endif; ?>
    </div>
</body>
</html>
