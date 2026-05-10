<?php
$conn = new mysqli("localhost", "root", "Abc123", "socialnet");
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
