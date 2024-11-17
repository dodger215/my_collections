<?php

session_start();
if(isset($_SESSION['first_name'])){
    header("location: ../patient.php");
}

$output = "";
$patientId = "";


include_once "php/config.php";

$sql = "SELECT * FROM patients";
$query = mysqli_query($conn, $sql);

if(mysqli_num_rows($query) > 0){
    while ($row = mysqli_fetch_assoc($query)) {
        $patientId = $row['patient_id'];
        $output .= ' 
                <tr>
                    <th>'. $row['first_name'] .'</th>
                    <th>'. $row['last_name'] .'</th>
                    <th>'. $row['gender'] .'</th>
                    <th>'. $row['date_of_birth'] .'</th>
                    <th>'. $row['contact_number'] .'</th>
                    <th>'. $row['email'] .'</th>
                    <th>'. $row['address'] .'</th>
                    <th>'. $row['medical_history'] .'</th>
                    <form method="post" autocomplete="off">
                        <td>
                            <button class="edit" name="edit">Edit</button>
                            <button class="delete" name="delete">Delete</button>
                        </td>
                    </form>
                </tr>
        ';

        
    }
    
}else{
    $output .= "";
}

if(isset($_POST['delete'])){
    $query = mysqli_query($conn, "DELETE FROM patients WHERE patient_id = '{$patientId}'");
}

if(isset($_POST['edit'])){
    header("location: editPatient.php");

}



$editArea = '
        <form method="post" action="#">
            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName" required>
            <label for="lastName">Last Name:</label>
            <input type="text" id="lastName" name="lastName" required>
            <label for="gender">Gender:</label>
            <select id="gender" name="gender">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>
            <label for="dateOfBirth">Date of Birth:</label>
            <input type="date" id="dateOfBirth" name="dateOfBirth" required>
            <label for="contactNumber">Contact Number:</label>
            <input type="tel" id="contactNumber" name="contactNumber" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email">
            <label for="address">Address:</label>
            <textarea id="address" name="address" required></textarea>
            <label for="medicalHistory">Medical History:</label>
            <textarea id="medicalHistory" name="medicalHistory"></textarea>
            <button type="submit" name="submit">Edit</button>
        </form>
';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Management</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <header>
        <h1>Patient Management</h1>
        <nav>
            <ul>
                <li><a href="../index.html">Dashboard</a></li>
                <li style="border-bottom: solid 3px #ffffff8e; color: rgba(255, 255, 255, 0.91); padding: 10px 15px; margin: -10px; font-weight: 500;"><a href="pages/patient.php">Patients</a></li>
                <li><a href="doctors.php">Doctors</a></li>
                <li><a href="appointments.php">Appointments</a></li>
                <li><a href="billing.php">Billing</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Add New Patient</h2>
        <form id="addPatientForm" method="post" autocomplete="off" action="php/patients_info.php">
            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName" required>
            <label for="lastName">Last Name:</label>
            <input type="text" id="lastName" name="lastName" required>
            <label for="gender">Gender:</label>
            <select id="gender" name="gender">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>
            <label for="dateOfBirth">Date of Birth:</label>
            <input type="date" id="dateOfBirth" name="dateOfBirth" required>
            <label for="contactNumber">Contact Number:</label>
            <input type="tel" id="contactNumber" name="contactNumber" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email">
            <label for="address">Address:</label>
            <textarea id="address" name="address" required></textarea>
            <label for="medicalHistory">Medical History:</label>
            <textarea id="medicalHistory" name="medicalHistory"></textarea>
            <button type="submit">Add Patient</button>
        </form>
        <h2>Patients List</h2>
        <table id="patientsTable">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Gender</th>
                    <th>Date of Birth</th>
                    <th>Contact Number</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Medical History</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Patient records will be dynamically inserted here -->
                <?php 
                    echo $output;

                    

                ?>
            </tbody>
        </table>
    </main>
    
    <script>
    </script>
    
</body>
</html>
