<?php

require('../node/function.php');
require('../node/config.php');


$fname = validate($_POST['fname']);
$email = validate($_POST['email']);
$number = validate($_POST['number']);
$password = validate($_POST['password']);
$location = validate($_POST['location']);


$time = time();



$sql = mysqli_query($conn, "SELECT email FROM register WHERE email = '{$email}'");

	if($sql){
		echo "User already registed, use another email";
	}
	$ran_id = rand($time, 999999999);
	$password_encrypt = encrypt_password($password);
	$status = "customer";

	$insert_sql = mysqli_query($conn, "INSERT INTO register (unique_id, full_name, email, number, password, location, status_no) VALUE ('{$ran_id}', '{$fname}', '{$email}', '{$number}', '{$password_encrypt}', '{$location}', '{$status}')");

	if($insert_sql){
		echo "success";
		$txt = "Successfully registed {$fname}, now log in";
		redirect("../../signin.php", $txt);
	}else{
			echo "Error";
	}



?>