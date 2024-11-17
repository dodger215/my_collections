<?php

require('../../include/node/function.php');
require('../../include/node/config.php');

$email = validate($_POST['email']);
$password = validate($_POST['password']);

$password_encrypt = encrypt_password($password);

$sql = "SELECT * FROM register WHERE email = '{$email}' AND password = '{$password_encrypt}' LIMIT 1";

$result = mysqli_query($conn, $sql);

if($result){
	if(mysqli_num_rows($result) == 1){

		mysqli_query($conn, "UPDATE register SET status_no = 'admin' WHERE email = '{$email}'");
        redirect("../input_company_name.php", "now log in as admin");

	}else{
	redirect("../../signin.php", "Field error, Try again");
		}
}else{
	redirect("../../signin.php", "Field error, Try again");
}
?>
