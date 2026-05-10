<?php
session_start();
$conn = new mysqli("localhost", "root", "Abc123", "socialnet");
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM account WHERE username = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    // Verify hashed password
    if ($result && password_verify($pass, $result['password'])) {
        $_SESSION['user_id'] = $result['id'];
        $_SESSION['username'] = $user;
        header("Location: index.php");
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SocialNet - Login</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background: linear-gradient(to right, #4facfe 0%, #00f2fe 100%); display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-container { background: white; padding: 50px; border-radius: 15px; box-shadow: 0 15px 35px rgba(0,0,0,0.2); width: 350px; text-align: center; }
        h1 { color: #333; font-size: 2.5rem; margin-bottom: 30px; letter-spacing: -1px; }
        input { width: 100%; padding: 15px; margin-bottom: 15px; border: 2px solid #f1f1f1; border-radius: 30px; font-size: 1rem; box-sizing: border-box; outline: none; transition: 0.3s; }
        input:focus { border-color: #4facfe; }
        .login-btn { background: #4facfe; color: white; border: none; cursor: pointer; font-weight: bold; text-transform: uppercase; }
        .login-btn:hover { background: #00f2fe; }
        .error-msg { color: #ff4757; margin-bottom: 15px; font-size: 0.9rem; }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>SocialNet</h1>
        <?php if($error) echo "<div class='error-msg'>$error</div>"; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" class="login-btn" value="Sign In">
        </form>
    </div>
</body>
</html>
