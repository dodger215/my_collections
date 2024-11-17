<?php
  require 'config/function.php';

  //Checking The Id
  $parameterResult = checkParamiterId('id');
  if (is_numeric($parameterResult)) {
    $disasterId = validate($parameterResult);

    //Checking If The Id Exists
    $disaster = getById('disaster', $disasterId);
    //If Found Delete
    if ($disaster['status'] == 200) {
        $disasterDelete = deleteQuery('disaster', $disasterId);
        if ($disasterDelete) {
            redirect('disasters.php', 'Record Deleted Successuly');
        } else {
            redirect('disasters.php', 'Record Not Deleted');
        }
        
    } else {
        redirect('disasters.php', $disaster['message']);
    }
    
  } else {
    redirect('disasters.php', $parameterResult);
  }
  

?>