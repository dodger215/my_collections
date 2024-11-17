<?php
// session_start();
include_once "config.php";

$doctorFirstName = $_POST['doctorFirstName'];
$doctorLastName = $_POST['doctorLastName'];
$specialty = $_POST['specialty'];
$contactNumber = $_POST['contactNumber'];
$email = $_POST['email'];
$availability = $_POST['availability'];

$fir = time() - 20000;

$ran_id = rand($fir, 100000000);

$sql = "SELECT * FROM doctors";

    if($sql){
        $insert_query = mysqli_query($conn, "INSERT INTO doctors (doctor_id, first_name, last_name, specialty, contact_number, email, availability) VALUES ('{$ran_id}', '{$doctorFirstName}', '{$doctorLastName}', '{$specialty}', '{$contactNumber}', '{$email}', '{$availability}') ");

        if($insert_query){
            echo "Success";
            header("location: ../doctors.php");
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