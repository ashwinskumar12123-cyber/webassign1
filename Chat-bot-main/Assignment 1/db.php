<?php
// Database connection settings - change these to match your MySQL server
$servername = "localhost";
$username   = "chatuser";
$password   = "chatpass";
$dbname     = "chatdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// utf8mb4 so emoji and non-English text are stored correctly
$conn->set_charset("utf8mb4");
?>
