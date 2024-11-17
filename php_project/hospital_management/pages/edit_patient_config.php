<?php 

$patientFirstName = $_POST['firstName'];
$patientLastName = $_POST['lastName'];
$gender = $_POST['gender'];
$dateOfBirth = $_POST['dateOfBirth'];
$contactNumber = $_POST['contactNumber'];
$email = $_POST['email'];
$address = $_POST['address'];
$medicalHistory = $_POST['medicalHistory'];

$id = $_POST['id'];


include_once "php/config.php";

$sql = "SELECT * FROM patients";
$query = mysqli_query($conn, $sql);


$editQuery = mysqli_query($conn, "UPDATE patients SET (first_name, last_name, gender, date_of_birth, contact_number, email, address, medical_history) VALUES ('{$patientFirstName}', '{$patientLastName}', '{$gender}', '{$dateOfBirth}', '{$contactNumber}', '{$email}', '{$address}', '{$medicalHistory}') WHERE patient_id = '{$id}'");
// header("location: patient.php");

    echo "Success";
    header("location: ../patient.php");
?>