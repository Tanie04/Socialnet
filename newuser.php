<?php
include 'db_connect.php';
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $fullname = $_POST['fullname'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO account (username, fullname, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $user, $fullname, $pass);
    
    if ($stmt->execute()) {
        $message = "<span style='color: #75c9c8;'>Create a new account successfully!</span>";
    } else {
        $message = "<span style='color: #e74c3c;'>Error: Username already exists!</span>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SocialNet - New User</title>
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

        .register-container { 
            background: white; 
            padding: 50px; 
            border-radius: 30px; 
            box-shadow: 0 15px 35px rgba(0,0,0,0.1); 
            width: 400px; 
            text-align: left; 
        }

        h1 { 
            text-align: center; 
            color: #5B3765; 
            font-size: 2rem; 
            margin-bottom: 10px; 
        }

        .status-msg { text-align: center; margin-bottom: 20px; font-weight: bold; }

        label { display: block; margin-bottom: 8px; color: #333; font-weight: bold; }

        input { 
            width: 100%; 
            padding: 12px 15px; 
            margin-bottom: 20px; 
            border: 1px solid #ddd; 
            border-radius: 10px; 
            box-sizing: border-box; 
            outline: none;
        }

        .add-btn { 
            background-color: #5B3765; 
            color: white; 
            border: none; 
            padding: 15px; 
            border-radius: 10px; 
            width: 100%; 
            font-size: 1rem; 
            font-weight: bold; 
            cursor: pointer; 
            transition: 0.3s;
        }

        .add-btn:hover { opacity: 0.9; background-color: #4a2d52; }
    </style>
</head>
<body>
    <div class="register-container">
        <h1>Sign Up</h1>
        <div class="status-msg"><?php echo $message; ?></div>
        
        <form method="POST">
            <label>Username</label>
            <input type="text" name="username" required>
            
            <label>Full Name</label>
            <input type="text" name="fullname" required>
            
            <label>Password</label>
            <input type="password" name="password" required>
            
            <input type="submit" class="add-btn" value="Sign Up">
        </form>
    </div>
</body>
</html>
