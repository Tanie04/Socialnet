<?php
session_start();
include('db_connect.php');

if(!isset($_SESSION['user_id'])) { header("Location: signin.php"); exit(); }
$user_id = $_SESSION['user_id'];
$msg = ""; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $description = $_POST['description'];
    
    if (!empty($_FILES['avatar']['name'])) {
        $avatar_name = time() . '_' . $_FILES['avatar']['name'];
        move_uploaded_file($_FILES['avatar']['tmp_name'], "uploads/" . $avatar_name);
        $sql = "UPDATE account SET description = ?, avatar = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $description, $avatar_name, $user_id);
    } else {
        $sql = "UPDATE account SET description = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $description, $user_id);
    }
    
    if ($stmt->execute()) {
        $msg = "Update successfully!"; 
    }
}


$stmt = $conn->prepare("SELECT * FROM account WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user_data = $stmt->get_result()->fetch_assoc();
$avatar_path = !empty($user_data['avatar']) ? "uploads/" . $user_data['avatar'] : "uploads/avatar_1.jpg";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Settings - SocialNet</title>
    <style>
        * { font-family: 'Sonorous', sans-serif; box-sizing: border-box; }
        body { background-color: #DACADD; margin: 0; padding: 0; }
        .main-content { display: flex; flex-direction: column; align-items: center; padding-top: 30px; }
        .container { width: 90%; max-width: 600px; background: white; padding: 40px; border-radius: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); text-align: center; }
        .avatar-preview { width: 150px; height: 150px; border-radius: 50%; border: 4px solid #5B3765; object-fit: cover; margin-bottom: 20px; }
        .custom-file-upload { display: inline-block; padding: 10px 20px; background: #f0f0f0; border-radius: 10px; cursor: pointer; border: 1px dashed #5B3765; color: #5B3765; width: 100%; text-align: center; }
        #file-name { display: block; margin-top: 10px; color: #5B3765; font-weight: bold; font-size: 0.9rem; }
        .success-text { color: #75c9c8 !important; } 
        label { font-weight: bold; color: #5B3765; display: block; margin-bottom: 10px; text-align: left; }
        textarea { width: 100%; border-radius: 15px; padding: 15px; border: 1px solid #C3B3D4; outline: none; resize: none; margin-bottom: 20px; }
        .save-btn { background: #5B3765; color: white; border: none; padding: 15px; border-radius: 25px; width: 100%; font-size: 1.1rem; font-weight: bold; cursor: pointer; }
    </style>
</head>
<body>
    <?php include 'menubar.php'; ?>
    <div class="main-content">
        <div class="container">
            <h1 style="color: #5B3765;">Account Settings</h1>
            <img src="<?php echo $avatar_path; ?>" class="avatar-preview" id="preview-img">
            
            <form action="setting.php" method="POST" enctype="multipart/form-data">
                <div style="margin: 20px 0; text-align: left;">
                    <label>Change Avatar:</label>
                    <label for="file-upload" class="custom-file-upload">Click to choose an image</label>
                    <input id="file-upload" name="avatar" type="file" style="display:none;"/>
                    
                    <span id="file-name" class="<?php echo ($msg != "") ? 'success-text' : ''; ?>">
                        <?php echo ($msg != "") ? $msg : "No file chosen"; ?>
                    </span>
                </div>
                
                <label>About Me:</label>
                <textarea name="description" rows="4"><?php echo $user_data['description']; ?></textarea>
                <button type="submit" class="save-btn">Save All Changes</button>
            </form>
        </div>
    </div>

    <script>
        const fileInput = document.getElementById('file-upload');
        const fileName = document.getElementById('file-name');
        const previewImg = document.getElementById('preview-img');

        fileInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                fileName.classList.remove('success-text'); 
                fileName.textContent = "Selected: " + this.files[0].name;
                const reader = new FileReader();
                reader.onload = e => previewImg.src = e.target.result;
                reader.readAsDataURL(this.files[0]);
            }
        });
    </script>
</body>
</html>
