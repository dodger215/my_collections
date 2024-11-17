<?php
// session_start();
include_once "config.php";

$patient = $_POST['patientBill'];
$appointmentId = $_POST['appointmentBill']
$appointmentBill = $_POST['amount'];
$paymentStatus = $_POST['paymentStatus'];
$paymentDate = $_POST['paymentDate'];

$patientId = "";
$appointmentId = "";



$sql = "SELECT * FROM billing";


$ran_id = rand(100, 1000);

    if($sql){
        $insert_query = mysqli_query($conn, "INSERT INTO billing (bill_id, patient_id, appointments_id, amount, payment_status, payment_date) VALUES ('{$ran_id}', '{$patient}', '{$appointmentId}', '{$appointmentBill}', '{$paymentStatus}', '{$paymentDate}') ");

        if($insert_query){
            echo "Success";
            header("location: ../billing.php");
       }
        
        


        // if($insert_query){
        //     $select_sql2 = mysqli_query($conn, $sql);
        //     if(mysqli_num_rows($select_sql2) > 0){
        //         $result = mysqli_fetch_assoc($select_sql2);
        //         $_SESSION['first_name'] = $result['first_name'];
        //         echo "success";
        //     }
        // }
    }else{
        echo "Error: " . $sql->connect_error();
    }    




?>