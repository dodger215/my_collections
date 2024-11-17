<?php

session_start();




function validate($inputData){
    global $conn;
    $validatedData =  mysqli_real_escape_string($conn,$inputData);
    return trim($validatedData);
  }

function redirect($loc, $stat){
	$_SESSION['status'] = $stat;
	header("location: {$loc}");
}

function getContent($content){
	header("location: {$content}");
}
function logouSession(){
    unset($_SESSION['auth']);
}


function encrypt_password($word){
    $first_step_encrypt = md5($word);
    $second_step_encrypt = strrev($first_step_encrypt);
    $third_step_encrypt = $first_step_encrypt . $second_step_encrypt;
    $forth_step_encrypt = md5($third_step_encrypt);

    return trim($forth_step_encrypt . strrev($third_step_encrypt));
}


?>