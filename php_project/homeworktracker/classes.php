<?php
	session_start();
	if(!isset($_SESSION['unique_id'])) {
		header("location: log.php");
		exit();
	}


    if(isset($_PSOT['done'])){
        header("location: addclasses.php");
    }
?>
<!DOCTYPE html>

<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<title>Enter Classes - Homework Tracker</title>
<link rel="icon" 
      type="image/png" 
      href="favicon.png">
 
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/all.min.css" />

</head>
<body>
	<div class="main">
        <a href="index.php">&times;</a>
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
                <tbody>
                        <th><input class="txt" placeholder="Class 2" type="text" name="subject"/></th>
                        <th><input id="name" type="checkbox" name="1"></th>
                        <th><input id="name" type="checkbox" name="2"></th>
                        <th><input id="name" type="checkbox" name="3"></th>
                        <th><input id="name" type="checkbox" name="4"></th>
                        <th><input id="name" type="checkbox" name="5"></th>
                </tbody>
                <tbody>
                        <th><input class="txt" placeholder="Class 3" type="text" name="subject"/></th>
                        <th><input id="name" type="checkbox" name="1"></th>
                        <th><input id="name" type="checkbox" name="2"></th>
                        <th><input id="name" type="checkbox" name="3"></th>
                        <th><input id="name" type="checkbox" name="4"></th>
                        <th><input id="name" type="checkbox" name="5"></th>
                </tbody>
                <tbody>
                        <th><input class="txt" placeholder="Class 4" type="text" name="subject"/></th>
                        <th><input id="name" type="checkbox" name="1"></th>
                        <th><input id="name" type="checkbox" name="2"></th>
                        <th><input id="name" type="checkbox" name="3"></th>
                        <th><input id="name" type="checkbox" name="4"></th>
                        <th><input id="name" type="checkbox" name="5"></th>
                </tbody>
                <tbody>
                        <th><input class="txt" placeholder="Class 5" type="text" name="subject"/></th>
                        <th><input id="name" type="checkbox" name="1"></th>
                        <th><input id="name" type="checkbox" name="2"></th>
                        <th><input id="name" type="checkbox" name="3"></th>
                        <th><input id="name" type="checkbox" name="4"></th>
                        <th><input id="name" type="checkbox" name="5"></th>
                </tbody>
                <tbody>
                        <th><input class="txt" placeholder="Class 6" type="text" name="subject"/></th>
                        <th><input id="name" type="checkbox" name="1"></th>
                        <th><input id="name" type="checkbox" name="2"></th>
                        <th><input id="name" type="checkbox" name="3"></th>
                        <th><input id="name" type="checkbox" name="4"></th>
                        <th><input id="name" type="checkbox" name="5"></th>
                </tbody>
                <tbody>
                        <th><input class="txt" placeholder="Class 7" type="text" name="subject"/></th>
                        <th><input id="name" type="checkbox" name="1"></th>
                        <th><input id="name" type="checkbox" name="2"></th>
                        <th><input id="name" type="checkbox" name="3"></th>
                        <th><input id="name" type="checkbox" name="4"></th>
                        <th><input id="name" type="checkbox" name="5"></th>
                </tbody>
                <tbody>
                        <th><input class="txt" placeholder="Class 8" type="text" name="subject"/></th>
                        <th><input id="name" type="checkbox" name="1"></th>
                        <th><input id="name" type="checkbox" name="2"></th>
                        <th><input id="name" type="checkbox" name="3"></th>
                        <th><input id="name" type="checkbox" name="4"></th>
                        <th><input id="name" type="checkbox" name="5"></th>
                </tbody>
                <div class="btn">
                    <button name="done" type="submit" onclick="send()"><i class="fa fa-check"></i></button>
                    <button onclick="add()"><i class="fa fa-plus"></i></button>
                </div>
            </form>
        </table>
    </div>

    <script>

const table =document.querySelector("table");
let rowNum = table.rows.length;
let count = 0;

function add(){
    for(var i=0; i < rowNum; i++){
        count++;
    }
    let tr = `
            <tbody>
                    <th><input class="txt" placeholder="Class ${count}" type="text" name="subject"/></th>
                    <th><input id="name" type="checkbox" name="1"></th>
                    <th><input id="name" type="checkbox" name="2"></th>
                    <th><input id="name" type="checkbox" name="3"></th>
                    <th><input id="name" type="checkbox" name="4"></th>
                    <th><input id="name" type="checkbox" name="5"></th>
            </tbody>
    `;

    table.insertAdjacentHTML('beforeend', tr);
}

const box = document.querySelectorAll("#name");
function send(){
    box.forEach(boxs => {
        if(boxs.checked){
            boxs.value= "1";
        }else{
            boxs.value="0";
        }
    });   
}

    </script>

    <script src="js/all.js"></script>
</body>
</html>

<?php


?>