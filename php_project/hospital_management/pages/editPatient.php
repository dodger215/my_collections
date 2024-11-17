<?php

$patientId = "";
$first = "";
$last = "";
$gender = "";
$date = "";
$contacts = "";
$email = "";
$address = "";
$medicals = "";




include_once "php/config.php";

$sql = "SELECT * FROM patients";
$query = mysqli_query($conn, $sql);

if(mysqli_num_rows($query) > 0){
    while ($row = mysqli_fetch_assoc($query)) {
        $patientId = $row['patient_id'];    
    }
    
}

$sql1 = "SELECT * FROM patients WHERE patient_id='{$patientId}'";
$query1 = mysqli_query($conn, $sql1);

if(mysqli_num_rows($query1) > 0){
    while ($row = mysqli_fetch_assoc($query1)) {
        $first = $row['first_name'];
        $last = $row['last_name'];
        $gender = $row['gender'];
        $date = $row['date_of_birth'];
        $contacts = $row['contact_number'];
        $email = $row['email'];
        $address = $row['address'];
        $medicals = $row['medical_history'];



    }
    
}
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <header>
      <h1>Patient Edit Area</h1>
        <nav>
            <ul>
                <li><a href="patient.php">Back to Add Patient</a></li>
            </ul>
        </nav>
    </header>
        <form method="post" action="edit_patient_config.php" autocomplete="off">
              <input type="text" name="id" value="<?php echo $patientId ?>" hidden>
              <label for="firstName">First Name:</label>
              <input type="text" id="firstName" name="firstName" placeholder="<?php echo $first ?>" required>
              <label for="lastName">Last Name:</label>
              <input type="text" id="lastName" name="lastName" placeholder="<?php echo $last ?>"  required>
              <label for="gender">Gender:</label>
              <select id="gender" name="gender">
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                  <option value="Other">Other</option>
              </select>
              <label for="dateOfBirth">Date of Birth:</label>
              <input type="date" id="dateOfBirth" name="dateOfBirth" placeholder="<?php echo $date ?>" required>
              <label for="contactNumber">Contact Number:</label>
              <input type="tel" id="contactNumber" placeholder="<?php echo $contacts ?>" name="contactNumber" required>
              <label for="email">Email:</label>
              <input type="email" id="email" placeholder="<?php echo $email ?>" name="email">
              <label for="address">Address:</label>
              <textarea id="address" name="address" placeholder="<?php echo $address ?>" required></textarea>
              <label for="medicalHistory">Medical History:</label>
              <textarea id="medicalHistory" placeholder="<?php echo $medicals ?>" name="medicalHistory"></textarea>
              <button type="submit" name="format">Edit</button>
        </form>
</body>
</html>