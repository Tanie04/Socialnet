<?php
$conn = new mysqli("localhost", "root", "YOUR_DB_PASS", "DB_NAME");
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
