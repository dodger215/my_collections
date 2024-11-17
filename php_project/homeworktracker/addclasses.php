<?php
	session_start();
	if(!isset($_SESSION['unique_id'])) {
		header("location: log.html");
		exit();
	}
	require("config.php");
	//error handler function 
	$i = 0;
	
		if(isset($_POST['1'])){
			$_POST['1'] = 1;
		}else{
			$_POST['1'] = "";
		}
	
		if(isset($_POST['2'])){
			$_POST['2'] = 1;
		}else{
			$_POST['2'] = 0;
		}
	
		if(isset($_POST['3'])){
			$_POST['3'] = 1;
		}else{
			$_POST['3'] = 0;
		}
	
		if(isset($_POST['4'])){
			$_POST['4'] = 1;
		}else{
			$_POST['4'] = 0;
		}
	
		if(isset($_POST['5'])){
			$_POST['5'] = 1;
		}else{
			$_POST['5'] = 0;
		}
	
	
	
	$ran = rand(1000, 9000);

	$user_id = $_SESSION["unique_id"];
	$name = $_POST['subject'];
	$monday = $_POST['1'];
	$tuesday = $_POST['2'];
	$wednesday = $_POST['3'];
	$thursday = $_POST['4'];
	$friday = $_POST['5'];	

	if(!empty($monday) || empty($tuesday) || !empty($wednesday) || !empty($thursday) || !empty($friday)){

		$sql = "INSERT INTO classes (class_id, user_id, name, monday, tuesday, wednesday, thursday, friday) VALUE
		('{$ran}', '{$user_id}', '{$name}', '{$monday}', '{$tuesday}', '{$wednesday}', '{$thursday}', '{$friday}')";	

		$result = mysqli_query($conn, $sql);

		if($result)
		{
			echo "success";
			header("location: index.php");
		}
		else {
			echo "failed";
		}
	}
				
?>