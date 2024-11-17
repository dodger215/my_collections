<?php
// session_start();
include_once "config.php";

$patientFirstName = $_POST['firstName'];
$patientLastName = $_POST['lastName'];
$gender = $_POST['gender'];
$dateOfBirth = $_POST['dateOfBirth'];
$contactNumber = $_POST['contactNumber'];
$email = $_POST['email'];
$address = $_POST['address'];
$medicalHistory = $_POST['medicalHistory'];



$sql = "SELECT * FROM patients";


$ran_id = rand(time(), 100000000);
    if($sql){
        $insert_query = mysqli_query($conn, "INSERT INTO patients (patient_id, first_name, last_name, gender, date_of_birth, contact_number, email, address, medical_history) VALUES ('{$ran_id}', '{$patientFirstName}', '{$patientLastName}', '{$gender}', '{$dateOfBirth}', '{$contactNumber}', '{$email}', '{$address}', '{$medicalHistory}') ");

        if($insert_query){
            echo "Success";
            header("location: ../patient.php");
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