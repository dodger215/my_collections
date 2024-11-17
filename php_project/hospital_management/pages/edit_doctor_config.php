<?php 

$doctorFirstName = $_POST['doctorFirstName'];
$doctorLastName = $_POST['doctorLastName'];
$specialty = $_POST['specialty'];
$contactNumber = $_POST['contactNumber'];
$email = $_POST['email'];
$availability = $_POST['availability'];

$id = $_POST['id'];


include_once "php/config.php";

$sql = "SELECT * FROM patients";
$query = mysqli_query($conn, $sql);


$editQuery = mysqli_query($conn, "UPDATE doctors SET (first_name, last_name, specialty, contact_number, email, availability) VALUES ('{$doctorFirstName}', '{$doctorLastName}', '{$specialty}', '{$contactNumber}', '{$email}', '{$availability}') WHERE doctor_id = '{$id}'");


    echo "Success";
    header("location: ../patient.php");
?>