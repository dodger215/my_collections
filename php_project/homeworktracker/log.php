<?php

session_start();
include_once 'config.php';
$msg = "";

if(isset($_POST['login'])){
	$username = $_POST['username'];
	$password = $_POST['password'];

	

	if(!empty(trim($username) && !empty(trim($password)))){
		$pass = md5(trim($password));
		$sql = "SELECT * FROM user WHERE username = '{$username}' AND password = '{$pass}'";
		$result = mysqli_query($conn, $sql);
		
		if (mysqli_num_rows($result) == 1) {
			$userData = mysqli_fetch_array($result);
			session_regenerate_id();
			$_SESSION['unique_id'] = $userData['unique_id'];
			$msg = "Success";
			header("location: index.php");
		}else{
			$msg = "information don't exist, register instead";
		}
	}else{
		$msg = "Enter field to register or login";
	}

	
}

if(isset($_POST['register'])){
	$username = $_POST['username'];
	$password = $_POST['password'];

	
	
	if(!empty(trim($username) && !empty(trim($password)))){
		$pass = md5(trim($password));
		$sql = "SELECT * FROM user WHERE username = '{$username}' AND password = '{$pass}'";
		$result = mysqli_query($conn, $sql);
		
		if (mysqli_num_rows($result) == 1) {
			$msg = "information exist, login instead";
		}else{
			$tim = date('Y');
			$id = rand($tim, 10000);
			$query = mysqli_query($conn, "INSERT INTO user (unique_id, username, password) VALUE ('{$id}', '{$username}', '{$pass}')");
			if($query){
				$msg = "Now Enter the field again and login";
				header("location: log.php");
			}else{
				$msg = "Error: not successful";
			}
			
		}
	}else{
		$msg = "Enter field to register or login";
	}

	
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<title>Login - Homework Tracker</title>
	<link rel="icon" 
      type="image/png" 
      href="favicon.png">

<link rel="stylesheet" href="css/style.css" />

</head>
<body>
	<div class="meg"><?php echo $msg ?></div>
	<div class="login">
		<h1>Homework Tracker</h1>
		<h2>By:</h2>
		<form action="" method="POST">
			<div class="field">
				<input type="text" name="username" placeholder="Username" required>		
				<input type="password" name="password" placeholder="Password" required>
			</div>
			
			<div class="buttons">
				<button type="submit" name="register">Register</button>
				<button type="submit" name="login">Login</button>
			</div>
		</form>		
	</div>
</body>
</html>