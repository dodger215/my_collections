<?php

session_start();
if(isset($_SESSION['first_name'])){
    header("location: ../pages/doctors.php");
}

$output = "";
$doctorId = "";


include_once "php/config.php";

$sql = "SELECT * FROM doctors";
$query = mysqli_query($conn, $sql);

if(mysqli_num_rows($query) > 0){
    while ($row = mysqli_fetch_assoc($query)) {
        $doctorId = $row['doctor_id'];
        $output .= ' 
                <tr>
                    <th>'. $row['first_name'] .'</th>
                    <th>'. $row['last_name'] .'</th>
                    <th>'. $row['specialty'] .'</th>
                    <th>'. $row['contact_number'] .'</th>
                    <th>'. $row['email'] .'</th>
                    <th>'. $row['availability'] .'</th>
                    <form method="post" autocomplete="off">
                        <td>
                            <button class="edit" name="edit">Edit</button>
                            <button class="delete" name="delete">Delete</button>
                        </td>
                    </form>
                </tr>
        ';
    }


}

if(isset($_POST['delete'])){
    $query = mysqli_query($conn, "DELETE FROM doctors WHERE doctor_id = '{$doctorId}'");
}

if(isset($_POST['edit'])){
    header("location: editDoctor.php");

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Management</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <header>
        <h1>Doctor Management</h1>
        <nav>
            <ul>
                <li><a href="../index.html">Dashboard</a></li>
                <li><a href="patient.php">Patients</a></li>
                <li style="border-bottom: solid 3px #ffffff8e; color: rgba(255, 255, 255, 0.91); padding: 10px 15px; margin: -10px; font-weight: 500;

                "><a href="doctors.php">Doctors</a></li>
                <li><a href="appointments.php">Appointments</a></li>
                <li><a href="billing.php">Billing</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Add New Doctor</h2>
    <form method="post" id="addDoctorForm" autocomplete="off" action="./php/doctor_info.php">
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
        <h2>Doctors List</h2>
        <table id="doctorsTable">
            <thead>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Specialty</th>
                    <th>Contact Number</th>
                    <th>Email</th>
                    <th>Availability</th>
                    <th>Actions</th>
            </thead>
            <tbody>
                <!-- Doctor records will be dynamically inserted here -->
                <form method="post" autocomplete="no">
                    
                <?php 

                    echo $output;

                    // if(isset($_POST['edit'])){
                    //     edit();
                    // }

                    // function edit()
                    // {
                    //     header("location: php/edit.php");
                    // }

                    if(isset($_POST['delete'])){
                        delete();
                    }

                    function delete()
                    {
                        // $deleteQuery = "DELETE FROM doctors WHERE doctor_id = '2'";
                        // $delete_row = mysqli_query($conn, $deleteQuery);
                    }

                ?>
                </form>
            </tbody>
        </table>
    </main>
    <script src="../js/main.js"></script>
</body>
</html>
