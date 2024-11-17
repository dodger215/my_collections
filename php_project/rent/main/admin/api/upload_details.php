<?php

header('Content-Type: application/json');

require('../../include/node/config.php');
require('../../include/node/function.php');

// Path to the orders and products JSON files
$JsonFile = 'details_data.json';


$response = ['status' => 'error', 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'])) {
    $company_id = rand(date('Y'), 9999);

    // Check if user is logged in
    if (!isset($_SESSION['auth'])) {
        $response['message'] = 'User not logged in';
        echo json_encode($response);
        exit;
    }

    $userId = $_SESSION['auth'];

    // Fetch the user's full name from the session
    $query = mysqli_query($conn, "SELECT full_name FROM register WHERE unique_id = '$userId'");
    $user = mysqli_fetch_assoc($query);

    if (!$user) {
        $response['message'] = 'User not found';
        echo json_encode($response);
        exit;
    }


    $order = [
        'company_id' => $company_id,
        'user_name' => $user['full_name'],
        'admin_id' => $userId,
        'company_name' => $_POST['name'],
        'started_account_date' => date('Y-m-d H:i:s')
    ];

    // Load existing orders from the JSON file
    $existingOrders = [];
    if (file_exists($JsonFile)) {
         $jsonData = file_get_contents($JsonFile);
         $existingOrders = json_decode($jsonData, true);
         if (!is_array($existingOrders)) {
             $existingOrders = [];
         }
    }

    // Add the new order to the existing orders
    $existingOrders[] = $order;

     // Save the updated orders back to the JSON file
     if (file_put_contents($JsonFile, json_encode($existingOrders, JSON_PRETTY_PRINT))) {
         $response['status'] = 'success';
         $response['message'] = "Your company is created successfully: '{$_POST['name']}' LIMITED";

         redirect("../../signin.php", $response['message']);

     } else {
         $response['message'] = 'Failed to save order';
     }

     echo json_encode($response);
} else {
     $response['message'] = 'Invalid request';
     echo json_encode($response);
}

