<?php
session_start();
if(!isset($_SESSION['classid'])){
    echo "error";
}

include_once 'config.php';

$sql = "SELECT * FROM classes WHERE class_id = '{$_SESSION['classid']}'";
$result = mysqli_query($conn, $sql);

$name = "";
if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        $name = $row['name'];
    }
}


echo $name;

?>