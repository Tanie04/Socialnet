<?php
session_start();
include 'db_connect.php';
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM account WHERE username = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

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
    <title>SocialNet - Sign In</title>
    <style>
        body { 
            font-family: 'Sonorous', sans-serif; 
            background-color: #DACADD; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
            margin: 0; 
        }

        .login-container { 
            background: white; 
            padding: 50px; 
            border-radius: 30px; 
            box-shadow: 0 15px 35px rgba(0,0,0,0.1); 
            width: 350px; 
            text-align: center; 
        }

        h1 { color: #5B3765; font-size: 2.5rem; margin-bottom: 30px; }

        input { 
            width: 100%; 
            padding: 15px; 
            margin-bottom: 15px; 
            border: 2px solid #C3B3D4; 
            border-radius: 25px; 
            font-size: 1rem; 
            box-sizing: border-box; 
            outline: none; 
            transition: 0.3s; 
        }

        input:focus { border-color: #5B3765; }

        .login-btn { 
            background: #5B3765; 
            color: white; 
            border: none; 
            cursor: pointer; 
            font-weight: bold; 
            border-radius: 25px; 
            padding: 15px; 
            width: 100%;
            transition: 0.3s;
        }

        .login-btn:hover { background: #4a2d52; }

        .error-msg { color: #ff4757; margin-bottom: 15px; font-size: 0.9rem; }
        
        .footer-link { margin-top: 20px; font-size: 0.9rem; }
        .footer-link a { color: #5B3765; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Sign In</h1>
        <?php if($error) echo "<div class='error-msg'>$error</div>"; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" class="login-btn" value="Sign In">
        </form>
        <div class="footer-link">
            Don't have an account? <a href="newuser.php">Sign Up</a>
        </div>
    </div>
</body>
</html>
