<?php
	session_start();
	if(!isset($_SESSION['unique_id'])) {
		header("location: log.php");
		exit();
	}


	//set error handler
	//set_error_handler("customError");
	// Create connection
	include_once "config.php";
	
	$classid = "";

	// Check connection
	if ($conn->connect_error) {
		die("Please try again later.");
	} 

	$class_mon = "";
	$class_tue = "";
	$class_wed = "";
	$class_thu = "";
	$class_fri = "";
	$class_sub = "";

	$sql = "SELECT username FROM user WHERE unique_id = '{$_SESSION['unique_id']}' limit 1"; 
	$result = mysqli_query($conn, $sql);
	$row_name = mysqli_fetch_assoc($result);

	$class_sql = "SELECT * FROM classes WHERE user_id = '{$_SESSION['unique_id']}'";
	$monitor_sql = "SELECT * FROM monitor WHERE user = '{$_SESSION['unique_id']}'";
	$class_query = mysqli_query($conn, $class_sql);
	$monitor_query = mysqli_query($conn, $monitor_sql);
	$show_sub = "";
	if(mysqli_num_rows($class_query) > 0){
		$subject = "";
		$mon = "";
		$tue = "";
		$wed = "";
		$thu = "";
		$fri = ""; 
		while($row = mysqli_fetch_assoc($class_query)){
			if($row['monday'] == '1'){
				$mon = '<li>' . $row['name'] . '</li>';
				$show_sub .= "<option value='". $row['class_id'] ."'><span>". $row['name'] ."</span><span> (Monday)</span></option>";
			}else{
				$mon = "";
			}
			if($row['tuesday'] == '1'){
				$tue = '<li>' . $row['name'] . '</li>';
				$classid = $row['class_id'];
				$show_sub .= "<option value='". $row['class_id'] ."'><span>". $row['name'] ."</span><span> (Tuesday)</span></option>";
			}else{
				$tue = "";
			}
			if($row['wednesday'] == '1'){
				$wed = '<li>' . $row['name'] . '</li>';
				$classid = $row['class_id'];
				$show_sub .= "<option value='". $row['class_id'] ."'><span>". $row['name'] ."</span><span> (Wednesday)</span></option>";
			}else{
				$wed = "";
			}
			if($row['thursday'] == '1'){
				$thu = '<li>' . $row['name'] . '</li>';
				$classid = $row['class_id'];
				$show_sub .= "<option value='". $row['class_id'] ."'><span>". $row['name'] ."</span><span> (Thursday)</span></option>";
			}else{
				$thu = "";
			}
			if($row['friday'] == '1'){
				$fri = '<li>' . $row['name'] . '</li>';
				$classid = $row['class_id'];
				$show_sub .= "<option value='". $row['class_id'] ."'><span>". $row['name'] ."</span><span> (Friday)</span></option>";
			}else{
				$fri = "";
			}
			$class_mon .= $mon;
			$class_tue .= $tue;
			$class_wed .= $wed;
			$class_thu .= $thu;
			$class_fri .= $fri;
		}
	}else{
		$class_sub = "<span style='color: #372700; font-weight: 600; position: absolute; left: 50%; transform: translateX(-50%);
		 font-size: 1.5em;'>No Subjects displayed</span>";
	}
	$name = $row_name['username'] . "'s homework";
if(isset($_POST['del'])){
	mysqli_query($conn, "DELETE FROM classes WHERE class_id = '{$classid}' ");
	mysqli_query($conn, "DELETE FROM monitor WHERE class_id = '{$classid}' ");
}


if(isset($_POST['clear'])){
	mysqli_query($conn, "DELETE FROM classes WHERE user_id = '{$_SESSION['unique_id']}'");
	mysqli_query($conn, "DELETE FROM monitor WHERE user = '{$_SESSION['unique_id']}'");
}
?>
<!DOCTYPE html>

<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<title>Homework Tracker</title>
<link rel="icon" 
      type="image/png" 
      href="favicon.png">
	<link rel="stylesheet" href="css/style1.css">
	<link rel="stylesheet" href="css/all.min.css">
</head>
<body>

	<div class="nav">
		<!-- <h1>Homework tracker</h1> -->
		<div class="intro">
			<span><i class="fa fa-user-alt"></i></span>
			<span><?= $name ?></span>
		</div>
		<button class="add" name="add">Add Classes</button>
		<button class="edit" name="edit"><i class="fa fa-edit edit"></i></button>
		<form action="logout.php" method="POST">
			<button name="logout"><i class="fa fa-door-open"></i></button>
		</form>
	</div>
	<div class="show">
		<table>
			<thead>
				<th>Monday</th>
				<th>Tuesday</th>
				<th>Wednesday</th>
				<th>Thurday</th>
				<th>Friday</th>
			</thead>
			
		</table>
			<div class="list">
					<ul class="mon"><?= $class_mon?></ul>
					<ul class="tue"><?= $class_tue?></ul>
					<ul class="wed"><?= $class_wed?></ul>
					<ul class="thu"><?= $class_thu?></ul>
					<ul class="fri"><?= $class_fri?></ul>
					<?php echo $class_sub ?>
			</div>
		
	</div>

	<div class="bg">
		<div class="ground"></div>
		<div class="main">
			<div class="canncel">&times;</div>
			<h2>What classes do you have homework for?</h2>
			<table id="classesTable">
				<thead>
					<th>Name</th>
					<th>M</th>
					<th>T</th>
					<th>W</th>
					<th>Th</th>
					<th>F</th>
				</thead>
				<form action="addclasses.php" method="POST">
					<tbody>
							<th><input class="txt" placeholder="Class 1" type="text" name="subject"/></th>
							<th><input id="name" type="checkbox" name="1"></th>
							<th><input id="name" type="checkbox" name="2"></th>
							<th><input id="name" type="checkbox" name="3"></th>
							<th><input id="name" type="checkbox" name="4"></th>
							<th><input id="name" type="checkbox" name="5"></th>
					</tbody>
					<div class="btn">
						<button name="done" type="submit" onclick="send()"><i class="fa fa-check"></i></button>
					</div>
				</form>
			</table>
		</div>		
	</div>
	
	<div class="preformance">
		<span class="remove">&times;</span>
		<form method="POST">
			<select name="view_sub">
				<?= $show_sub ?>
			</select>
			<div class="about">
				<input class="description" type="text" name="description" placeholder="Description: " />
				<input class="summary" type="text" name="summary" placeholder="Summary: " />
			</div>
			<div class="progress"><h3>Preformance:</h3></div>
			<div class="radio">
				<span id="progresstxt" name="progress">0%</span><span id="color"></span>
				<input type="range" id="slider" name="progress" min="0" max="100" value="0">
				<div class="rank">
					<div class="poor">
						<span>Poor</span>
						<span class="color" style="border: solid 7px rgb(200, 5, 10);"></span>
					</div>
					<div class="averge">
						<span>Averge</span>
						<span class="color" style="border: solid 7px #ff9500;"></span>
					</div>
					<div class="good">
						<span>Good</span>
						<span class="color" style="border: solid 7px #fff700;"></span>
					</div>
					<div class="excellent">
						<span>Excellent</span>
						<span class="color" style="border: solid 7px #15ff00;"></span>
					</div>
				</div>
			</div>
			<div class="btn">
				<button class="grade" name="grade">Grade proformance</button>
				<button class="del" name="del">Delete</button>
				<button class="clear" name="clear">Clear all</button>
			</div>
		</form>
		
		
	</div>

	<div class="dashboard"><a href="home.php">Dashboard</a></div>

		
	
	<script src="js/all.js"></script>	
	<script src="js/function.js"></script>

	<script>
const canncel = document.querySelector('.canncel');
const bg = document.querySelector(".bg");
const add = document.querySelector(".add");
const del = document.querySelector(".del");
const clear = document.querySelector(".clear");

del.addEventListener('click', () => {
	alert('Delete information');
});

clear.addEventListener('click', () => {
	alert('Delete all information');
});

canncel.addEventListener('click', () => {
	bg.style.display="none";
});
add.addEventListener('click', () => {
	bg.style.display="block";
});

const edit = document.querySelector('.edit');

edit.addEventListener('click', () => {
	document.querySelector('.preformance').style.display="block";
});

const box = document.querySelectorAll("#name");
function send(){
        if(box.checked){
            box.value= "1";
        }else{
            box.value = "0";
        }
}

	</script>
</body>
</html>	


<?php 
if(isset($_POST['logout'])){
	header('location: logout.php');
}






if(isset($_POST['grade'])){
$view_sub = $_POST['view_sub'];
$description = $_POST['description'];
$summary = $_POST['summary'];
$progress = $_POST['progress'];
	if((!empty($description)) && (!empty($summary))){
		$ran_d = rand(2000, 9999);
		$insert = "INSERT INTO monitor (id, class_id, summary, description, progress) VALUE 
		           ('{$ran_d}', '{$view_sub}', '{$summary}', '{$description}', '{$progress}')";
		$query = mysqli_query($conn, $insert);

		if($query){
			$mss = "Success";
		}else{
			header("location: index.php");
		}
	}else{
		header("location: index.php");
	} 
}


?>