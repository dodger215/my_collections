<?php 
session_start();
if(!isset($_SESSION['unique_id'])){
    header('log.php');
}

include_once "config.php";
	
	$classid = "";

	// Check connection
	if ($conn->connect_error) {
		die("Please try again later.");
	} 

	$show_sub = "";

	$sql = "SELECT username FROM user WHERE unique_id = '{$_SESSION['unique_id']}' limit 1"; 
	$result = mysqli_query($conn, $sql);
	$row_name = mysqli_fetch_assoc($result);

	$class_sql = "SELECT * FROM classes WHERE user_id = '{$_SESSION['unique_id']}'";
	$class_query = mysqli_query($conn, $class_sql);
	$show_sub = "";
    $show_mon = "";
    $show_tue = "";
    $show_wed = "";
    $show_thu = "";
    $show_fri = "";


    
	if(mysqli_num_rows($class_query) > 0){
		while($row = mysqli_fetch_assoc($class_query)){
    
            if($row['monday'] == 1){
                $id = $row['class_id'];
                $monitor_query = mysqli_query($conn, "SELECT description, summary, progress FROM monitor 
                                    WHERE class_id = '{$id}'");
                $monitor_row = mysqli_fetch_assoc($monitor_query);
                if((!empty($monitor_row['description'])) && (!empty($monitor_row['summary'])) && (!empty($monitor_row['progress']))){
                    $description = $monitor_row['description'];
                    $summary = $monitor_row['summary'];
                    $progress = $monitor_row['progress'];
                }else{
                    $description = "Records not set";
                    $summary = "Records not set";
                    $progress = "Records not set";
                }
                $show_mon .= "<li> <h2>". $row['name']. " on Monday</h2>
                <div class='description'>Description: <br>" .$description. ".</div>
                <div class='sammary'>Summary: <br>" .$summary. ".</div>
                <div class='progress'>
                <span class='status'>Progress: " .$progress. "</span>
                <span class='color'></span>
                </div> </li>";
            }else{
                $show_mon = "";
            }

            if($row['tuesday'] == 1){
                $id = $row['class_id'];
                $monitor_query = mysqli_query($conn, "SELECT description, summary, progress FROM monitor 
                                    WHERE class_id = '{$id}'");
                $monitor_row = mysqli_fetch_assoc($monitor_query);
                if((!empty($monitor_row['description'])) && (!empty($monitor_row['summary'])) && (!empty($monitor_row['progress']))){
                    $description = $monitor_row['description'];
                    $summary = $monitor_row['summary'];
                    $progress = $monitor_row['progress'];
                }else{
                    $description = "Records not set";
                    $summary = "Records not set";
                    $progress = "Records not set";
                }
                $show_mon .= "<li> <h2>". $row['name']. " on Tuesday</h2>
                <div class='description'>Description: <br>" .$description. ".</div>
                <div class='sammary'>Summary: <br>" .$summary. ".</div>
                <div class='progress'>
                <span class='status'>Progress: " .$progress. "</span>
                <span class='color'></span>
                </div> </li>";
            }else{
                $show_tue = "";
            }

            if($row['wednesday'] == 1){
                $id = $row['class_id'];
                $monitor_query = mysqli_query($conn, "SELECT description, summary, progress FROM monitor 
                                    WHERE class_id = '{$id}'");
                $monitor_row = mysqli_fetch_assoc($monitor_query);
                if((!empty($monitor_row['description'])) && (!empty($monitor_row['summary'])) && (!empty($monitor_row['progress']))){
                    $description = $monitor_row['description'];
                    $summary = $monitor_row['summary'];
                    $progress = $monitor_row['progress'];
                }else{
                    $description = "Records not set";
                    $summary = "Records not set";
                    $progress = "Records not set";
                }
                $show_mon .= "<li> <h2>". $row['name']. " on Wednesday</h2>
                <div class='description'>Description: <br>" .$description. ".</div>
                <div class='sammary'>Summary: <br>" .$summary. ".</div>
                <div class='progress'>
                <span class='status'>Progress: " .$progress. "</span>
                <span class='color'></span>
                </div> </li>";
            }else{
                $show_wed = "";
            }

            if($row['thursday'] == 1){
                $id = $row['class_id'];
                $monitor_query = mysqli_query($conn, "SELECT description, summary, progress FROM monitor 
                                    WHERE class_id = '{$id}'");
                $monitor_row = mysqli_fetch_assoc($monitor_query);
                if((!empty($monitor_row['description'])) && (!empty($monitor_row['summary'])) && (!empty($monitor_row['progress']))){
                    $description = $monitor_row['description'];
                    $summary = $monitor_row['summary'];
                    $progress = $monitor_row['progress'];
                }else{
                    $description = "Records not set";
                    $summary = "Records not set";
                    $progress = "Records not set";
                }
                $show_mon .= "<li> <h2>". $row['name']. " on Thursday</h2>
                <div class='description'>Description: <br>" .$description. ".</div>
                <div class='sammary'>Summary: <br>" .$summary. ".</div>
                <div class='progress'>
                <span class='status'>Progress: " .$progress. "</span>
                <span class='color'></span>
                </div> </li>";
            }else{
                $show_thu = "";
            }

            if($row['friday'] == 1){
                $id = $row['class_id'];
                $monitor_query = mysqli_query($conn, "SELECT description, summary, progress FROM monitor 
                                    WHERE class_id = '{$id}'");
                $monitor_row = mysqli_fetch_assoc($monitor_query);
                if((!empty($monitor_row['description'])) && (!empty($monitor_row['summary'])) && (!empty($monitor_row['progress']))){
                    $description = $monitor_row['description'];
                    $summary = $monitor_row['summary'];
                    $progress = $monitor_row['progress'];
                }else{
                    $description = "Records not set";
                    $summary = "Records not set";
                    $progress = "Records not set";
                }
                $show_mon .= "<li> <h2>". $row['name']. " on Friday</h2>
                <div class='description'>Description: <br>" .$description. ".</div>
                <div class='sammary'>Summary: <br>" .$summary. ".</div>
                <div class='progress'>
                <span class='status'>Progress: " .$progress. "</span>
                <span class='color'></span>
                </div> </li>";
            }else{
                $show_fri = "";
            }

            $show_sub .= $show_mon . $show_tue . $show_wed . $show_thu . $show_fri;
		}
	}else{
		$show_sub = "<span style='color: #372700; font-weight: 600; position: absolute; left: 50%; transform: translateX(-50%);
		 font-size: 1.5em;'>No Subjects displayed</span>";
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | homework</title>
    <link rel="icon" 
      type="image/png" 
      href="favicon.png">
    <link rel="stylesheet" href="css/home_css.css">
</head>
<body>
    <header>
        <a href="index.php" class="back">Back to main page</a>
        <h1>Dashboard - <span><?= $row_name['username']?>'s homework</span></h1>
    </header>
    <ul>
       <?= $show_sub ?> 
    </ul>
    <a class="expert" onclick="printMyBillingArea()" >Expert to pdf</a>
    <script src="js/function.js">

    </script>
</body>
</html>