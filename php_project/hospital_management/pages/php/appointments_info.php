<?php
// session_start();
include_once "config.php";

$patient = $_POST['patient'];
$doctor = $_POST['doctor'];
$appointmentDate = $_POST['appointmentDate'];
$appointmentTime = $_POST['appointmentTime'];



$sql = "SELECT * FROM appointments";
$ran_id = rand(50, 1000);
    if($sql){
        $insert_query = mysqli_query($conn, "INSERT INTO appointments (appointment_id, patient_id, doctor_id, appointment_date, appointment_time) VALUES ('{$ran_id}', '{$patient}', '{$doctor}', '{$appointmentDate}', '{$appointmentTime}') ");

        if($insert_query){
            echo "Success";
            header("location: ../appointments.php");
       }
        
        


        
    }else{
        echo "Error: " . $sql->connect_error();
    }    




?>