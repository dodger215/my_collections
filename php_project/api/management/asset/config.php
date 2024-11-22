<?php

$hostname = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "management_db";

$conn = mysqli_connect($hostname, $username, $password, $dbname);
if (!$conn) {
    echo json_encode(["status" => "error", "message" => "Database not connected"]);
    exit();
}


