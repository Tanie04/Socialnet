<?php
$conn = new mysqli("localhost", "root", "Abc123", "socialnet");
if ($conn->connect_error) die("Connection failed.");
session_start();
?>
