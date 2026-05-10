<?php
session_start();
include('db_connect.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: signin.php");
    exit();
}

$view_id = isset($_GET['id']) ? $_GET['id'] : $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT * FROM account WHERE id = ?");
$stmt->bind_param("i", $view_id);
$stmt->execute();
$result = $stmt->get_result();
$user_data = $result->fetch_assoc();

if (!$user_data) {
    header("Location: index.php");
    exit();
}

$avatar_path = !empty($user_data['avatar']) ? "uploads/" . $user_data['avatar'] : "uploads/avatar_1.jpg";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile - <?php echo $user_data['fullname']; ?></title>
    <style>
        * { font-family: 'Sonorous', sans-serif; }
        body { 
            background-color: #DACADD; 
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .container { 
            width: 90%; 
            max-width: 1200px; 
            background: white;
            margin-top: 30px;
            padding: 40px;
            border-radius: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }
        .profile-header {
            display: flex;
            align-items: center;
            gap: 50px;
        }
        .nickname { color: #5B3765; font-weight: bold; font-size: 1.2rem; }
        .about-section {
            background-color: #C3B3D4; 
            padding: 20px;
            border-radius: 15px;
            color: white;
            margin-top: 20px;
        }
        .edit-btn {
            background: #5B3765;
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            text-decoration: none;
            font-size: 14px;
        }
    </style>
</head>
<body>

<?php include('menubar.php'); ?>

<div class="container">
    <div class="profile-header">
        <img src="<?php echo $avatar_path; ?>" style="width: 180px; height: 180px; border-radius: 50%; border: 4px solid #5B3765; object-fit: cover;">
        <div class="info">
            <div style="display: flex; align-items: center; gap: 20px;">
                <h1 style="margin: 0; color: #333;"><?php echo $user_data['fullname']; ?></h1>
                <?php if ($view_id == $_SESSION['user_id']): ?>
                    <a href="setting.php" class="edit-btn">Edit Profile</a>
                <?php endif; ?>
            </div>
            <p class="nickname">@<?php echo $user_data['username']; ?></p>
            <div class="about-section">
                <h3 style="margin-top: 0;">About Me:</h3>
                <p><?php echo $user_data['description']; ?></p>
            </div>
        </div>
    </div>
</div>

</body>
</html>
