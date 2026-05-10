<?php
session_start();
// 1. Redirect to Signin Page if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: signin.php");
    exit();
}

$conn = new mysqli("localhost", "root", "Abc123", "socialnet");
$user_id = $_SESSION['user_id'];

// 2. Fetch logged-in user details
$stmt = $conn->prepare("SELECT username, fullname FROM account WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$current_user = $stmt->get_result()->fetch_assoc();

// 3. Fetch list of other users (for the Home Page requirement)
$others = $conn->query("SELECT username, fullname FROM account WHERE id != $user_id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SocialNet - Home</title>
    <style>
        body { font-family: sans-serif; margin: 40px; background: #f4f7f6; }
        .container { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .user-list { margin-top: 20px; border-top: 1px solid #eee; padding-top: 10px; }
        .user-item { padding: 10px; border-bottom: 1px solid #f9f9f9; display: flex; justify-content: space-between; }
        .btn-profile { background: #3498db; color: white; padding: 5px 10px; text-decoration: none; border-radius: 4px; font-size: 0.8em; }
    </style>
</head>
<body>
    <div class="container">
        <?php include 'menubar.php'; ?>
        
        <h1>Welcome, <?php echo htmlspecialchars($current_user['fullname']); ?>!</h1>
        <p><strong>Username:</strong> <?php echo htmlspecialchars($current_user['username']); ?></p>

        <div class="user-list">
            <h3>Explore Other Users</h3>
            <?php while($row = $others->fetch_assoc()): ?>
                <div class="user-item">
                    <span><?php echo $row['fullname']; ?> (@<?php echo $row['username']; ?>)</span>
                    <a href="profile.php?owner=<?php echo $row['username']; ?>" class="btn-profile">View Profile</a>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>

