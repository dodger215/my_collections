<?php
  require 'config/function.php';

  //Checking The Id
  $parameterResult = checkParamiterId('id');
  if (is_numeric($parameterResult)) {
    $userId = validate($parameterResult);

    //Checking If The Id Exists
    $user = getById('users', $userId);
    //If Found Delete
    if ($user['status'] == 200) {
        $userDelete = deleteQuery('users', $userId);
        if ($userDelete) {
            redirect('users.php', 'Record Deleted Successuly');
        } else {
            redirect('users.php', 'Record Not Deleted');
        }
        
    } else {
        redirect('users.php', $user['message']);
    }
    
  } else {
    redirect('users.php', $parameterResult);
  }
  

?>