<?php $current_page = basename($_SERVER['PHP_SELF']); ?>
<style>
        * { font-family: 'Sonorous', sans-serif; } 
    
    .navbar {
        background: #5B3765; 
        padding: 15px 5%;
        margin-bottom: 20px;
        border-radius: 8px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .nav-links a {
        color: white;
        margin-right: 20px;
        text-decoration: none;
        opacity: 0.8;
    }
    
    .nav-links a.active {
        font-weight: bold;
        opacity: 1;
        border-bottom: 2px solid #FAEECD;
    }
    .signout-link {
        color: white;
        text-decoration: none;
    }
</style>

<div class="navbar">
    <nav class="nav-links">
        <a href="index.php" class="<?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">Home</a>
        <a href="setting.php" class="<?php echo ($current_page == 'setting.php') ? 'active' : ''; ?>">Setting</a>
        <a href="profile.php" class="<?php echo ($current_page == 'profile.php') ? 'active' : ''; ?>">Profile</a>
        <a href="about.php" class="<?php echo ($current_page == 'about.php') ? 'active' : ''; ?>">About</a>
    </nav>
    <a href="signout.php" class="signout-link">Sign Out 🚪</a>
</div>
