<?php

 session_start();
  require 'db.php';

  //Validation
  function validate($inputData){
    global $conn;
    $validatedData =  mysqli_real_escape_string($conn,$inputData);
    return trim($validatedData);
  }

  //Invalid Authentication
  function redirect($url, $status){
    $_SESSION['status'] = $status;
        header('Location: '.$url);
        exit(0);
  }

  //The notification
  function alertMessage(){
    if (isset($_SESSION['status'])) {
      echo'<div class="alert alert-success">
        <h5>'.$_SESSION['status'].'</h5>
       </div>';
       unset($_SESSION['status']);
    }
  }

  //Fecthing all users records
  function getAll($tableName){
    global $conn;
    $table = validate($tableName);
    $query = "SELECT * FROM $table";
    $result = mysqli_query($conn, $query);
    return $result;
  }

  //Checking the records
  function checkParamiterId($paramType){
    if (isset($_GET[$paramType])) {
      if ($_GET[$paramType] != null) {
        return $_GET[$paramType];
      }else{
        return "NO id Found";
      }
    }else{
      return 'No id saved';
    }
  }

  //Fetching a single data
  function getById($tableName, $id){
    global $conn;
    $table = validate($tableName);
    $id = validate($id);

    $query = "SELECT * FROM $table WHERE id='$id' LIMIT 1";
    $result = mysqli_query($conn, $query);

    //Show the results
    if ($result) {
      //Checking for one record
      if(mysqli_num_rows($result) == 1){
          $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
          $response = [
            'status' => 200,
            'message' => 'Records Found',
            'data' => $row
          ];
          return $response;
      }else{
        $response = [
          'status' => 404,
          'message' => 'No Record Found'
        ];
        return $response;
      }
    } else {
      $response = [
        'status' => 500,
        'message' => 'Something Went Wrong'
      ];
      return $response;
    }
    
  }

  //Deleting a record
  function deleteQuery($tableName, $id){
    global $conn;

    $table = validate($tableName);
    $id = validate($id);
    $query = "DELETE FROM $table WHERE id='$id' LIMIT 1";
    $result = mysqli_query($conn, $query);
    return $result;
  }

  //Logout function
  function logouSession(){
    unset($_SESSION['auth']);
    unset($_SESSION['loggedInUserRole']);
    unset($_SESSION['loggedInUser']);
  }

  //The Titled Pages
  function webSettings($columnName){
    $setting = getById('settings', 1);
    if ($setting['status'] == 200) {
      return $setting['data'][$columnName];
    }
  }

  //Counting Details
  function getCount($tableName){
    global $conn;
    $table = validate($tableName);
    $query = "SELECT * FROM $table";
    $result = mysqli_query($conn, $query);
    $total = mysqli_num_rows($result);
    return $total;
  }
?>