<?php
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: signin.php"); exit(); }

$conn = new mysqli("localhost", "root", "Abc123", "socialnet");
$user_id = $_SESSION['user_id'];
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['description'])) {
        $new_desc = $_POST['description'];
        $stmt = $conn->prepare("UPDATE account SET description = ? WHERE id = ?");
        $stmt->bind_param("si", $new_desc, $user_id);
        $stmt->execute();
        $message = "Profile updated!";
    }

        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
        $target_dir = "uploads/";
        $file_ext = pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION);
        $file_name = "avatar_" . $user_id . "." . $file_ext; 
        $target_file = $target_dir . $file_name;

        if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
            $stmt_img = $conn->prepare("UPDATE account SET avatar = ? WHERE id = ?");
            $stmt_img->bind_param("si", $target_file, $user_id);
            $stmt_img->execute();
            $message = "Avatar uploaded successfully!";
        }
    }
}

$res = $conn->query("SELECT description, avatar FROM account WHERE id = $user_id");
$user = $res->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Settings - SocialNet</title>
    <style>
        body { font-family: sans-serif; background: #f0f2f5; padding: 20px; }
        .card { background: white; padding: 30px; border-radius: 10px; max-width: 500px; margin: auto; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        .avatar-preview { width: 100px; height: 100px; border-radius: 50%; object-fit: cover; margin-bottom: 10px; border: 2px solid #1877f2; }
        textarea { width: 100%; height: 80px; margin-bottom: 10px; }
        .btn { background: #1877f2; color: white; border: none; padding: 10px; border-radius: 5px; cursor: pointer; width: 100%; }
    </style>
</head>
<body>
    <div class="card">
        <?php include 'menubar.php'; ?>
        <h2>Account Settings</h2>
        <?php if($message) echo "<p style='color:green'>$message</p>"; ?>
        
        <form method="POST" enctype="multipart/form-data">
            <p>Current Avatar:</p>
            <img src="<?php echo $user['avatar']; ?>" class="avatar-preview">
            <br>
            <input type="file" name="avatar">
            <hr>
            <p>About Me:</p>
            <textarea name="description"><?php echo htmlspecialchars($user['description']); ?></textarea>
            <input type="submit" class="btn" value="Save All Changes">
        </form>
    </div>
</body>
</html>
