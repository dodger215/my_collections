<?php
include_once 'config.php';
session_start();

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$date_of_birth = $_POST['dateOfBirth'];
$gender = $_POST['gender'];
$title = $_POST['title'];
$number = $_POST['number'];
$status = $_POST['status'];

if(($gender == "male") && ($status == "member")){
    $st = "Brother ";
}
if(($gender == "female") && ($status == "member")){
    $st = "Sister ";
}
if(($gender == "male") && ($status == "pastor")){
    $st = "Ps. ";
}
if(($gender == "female") && ($status == "pastor")){
    $st = "Dcns.";
}
if(($gender == "male") && ($status == "elder")){
    $st = "Eld. ";
}
if(($gender == "female") && ($status == "elder")){
    $st = "Dcns. ";
}
if(($gender == "male") && ($status == "dcn")){
    $st = "Dcn. ";
}
if(($gender == "female") && ($status == "dcn")){
    $st = "Dcns. ";
}
if(!empty($fname) && !empty($lname) && !empty($date_of_birth) && !empty($gender) && !empty($title) && !empty($number) && !empty($status)){
    $sqi = mysqli_query($conn, "SELECT * FROM register WHERE first_name = '{$fname}' AND last_name = '{$lname}'");
    if(mysqli_num_rows($sqi) > 0){
        echo $fname . " " . $lname .  " - This information already exist!";
    }else{
        $time = time();
        $rand_id = rand($time, 10000);
        $pnumber = $number;
        $insert_sqi = "INSERT INTO register (unique_id, first_name, last_name, date_of_birth, gender, status_no, number, title) VALUE 
                        ('{$rand_id}', '{$fname}', '{$lname}', '{$date_of_birth}', '{$gender}', '{$status}', '{$pnumber}', '{$title}')";
        
        $insert = mysqli_query($conn, $insert_sqi);
        if($insert){
            header('location: ../index.php');
            $_SESSION['status'] = "Registered " . $st . $fname . " " . $lname . "sucessfully"; 
        }

    }


}
?>