<?php
  require 'config/function.php';

  //Checking The Id
  $parameterResult = checkParamiterId('id');
  if (is_numeric($parameterResult)) {
    $socialMediaId = validate($parameterResult);

    //Checking If The Id Exists
    $social_media = getById('social_media', $socialMediaId);
    //If Found Delete
    if ($social_media['status'] == 200) {
        $social_mediaDelete = deleteQuery('social_media', $socialMediaId);
        if ($social_mediaDelete) {
            redirect('social-media.php', 'Record Deleted Successuly');
        } else {
            redirect('social-media.php', 'Record Not Deleted');
        }
        
    } else {
        redirect('social-media.php', $social_media['message']);
    }
    
  } else {
    redirect('social-media.php', $parameterResult);
  }
  

?>