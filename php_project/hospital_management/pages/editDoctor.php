<?php
$doctorId = "";


include_once "php/config.php";

$sql = "SELECT * FROM doctors";
$query = mysqli_query($conn, $sql);

if(mysqli_num_rows($query) > 0){
    while ($row = mysqli_fetch_assoc($query)) {
        $doctorId = $row['doctor_id'];    
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
      <h1>Doctor Edit Area</h1>
        <nav>
            <ul>
                <li><a href="doctors.php">Back to Add Doctor</a></li>
            </ul>
        </nav>
    </header>
        <form method="post" action="edit_doctor_config.php" autocomplete="off">
              <input type="text" name="id" value="<?php echo $patientId ?>" hidden>
              <label for="doctorFirstName">First Name:</label>
            <input type="text" id="doctorFirstName" name="doctorFirstName" required>
            <label for="doctorLastName">Last Name:</label>
            <input type="text" id="doctorLastName" name="doctorLastName" required>
            <label for="specialty">Specialty:</label>
            <input type="text" id="specialty" name="specialty" required>
            <label for="contactNumber">Contact Number:</label>
            <input type="tel" id="contactNumber" name="contactNumber" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email">
            <label for="availability">Availability:</label>
            <textarea id="availability" name="availability" required></textarea>
            <button type="submit" name="submit">Add Doctor</button>
        </form>
        </form>
</body>
</html>