<?php
// Database configuration
$servername = "sql305.infinityfree.com";
$username = "if0_37447680";
$password = "GNUyEgGYKNox";
$dbname = "if0_37447680_attendance_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>