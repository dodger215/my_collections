<?php

session_start();


$output = "";
$outputPatients = "";
$outputDoctors = "";


include_once "php/config.php";

$sql = "SELECT * FROM appointments";
$sql2 = "SELECT * FROM patients";
$sql3 = "SELECT * FROM doctors";
$query = mysqli_query($conn, $sql);
$queryPatients = mysqli_query($conn, $sql2);
$queryDoctors = mysqli_query($conn, $sql3);

$docName = "";
$PatientName = "";
$appointmentId = "";



if(mysqli_num_rows($queryPatients) > 0){
    while ($row = mysqli_fetch_assoc($queryPatients)) {
       
        $patFName = $row['first_name'] . " " . $row['last_name'];
        $outputPatients .= ' 
                <option value="'. $row['patient_id'] .'">' .$patFName. '</option>
        ';

        $PatientName = $patFName;
    }

}

if(mysqli_num_rows($queryDoctors) > 0){
    while ($row = mysqli_fetch_assoc($queryDoctors)) {
        $docFName = $row['first_name'] . " " . $row['last_name'];
        $outputDoctors .= ' 
                <option value="'. $row['doctor_id'] .'">Dr. ' .$docFName. '</option>
        ';
        $docName = $docFName;
    }
}

if(mysqli_num_rows($query) > 0){
    
    while ($row = mysqli_fetch_assoc($query)) {
        $appointmentId = $row['appointment_id'];
        $output .= ' 
                <tr>
                    <th>'. $PatientName .'</th>
                    <th> Dr.'. $docName .'</th>
                    <th>'. $row['appointment_date'] .'</th>
                    <th>'. $row['appointment_date'] .'</th>
                    <th>Active</th>

                    <form method="post" autocomplete="off">
                        <td>
                            <button class="delete" name="delete">Delete</button>
                        </td>
                    </form>
                </tr>
        ';
    }
}

if(isset($_POST['delete'])){
    $query = mysqli_query($conn, "DELETE FROM appointments WHERE appointment_id = '{$appointmentId}'");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Management</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <header>
        <h1>Appointment Management</h1>
        <nav>
            <ul>
                <li><a href="../index.html">Dashboard</a></li>
                <li><a href="patient.php">Patients</a></li>
                <li><a href="doctors.php">Doctors</a></li>
                <li style="border-bottom: solid 3px #ffffff8e; color: rgba(255, 255, 255, 0.91); padding: 10px 15px; margin: -10px; font-weight: 500;"><a href="appointments.php">Appointments</a></li>
                <li><a href="billing.php">Billing</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Schedule Appointment</h2>
        <form id="scheduleAppointmentForm" method="post" action="./php/appointments_info.php" autocomplete="off">
            <label for="patient">Patient:</label>
            <select id="patient" name="patient">
                <!-- Patient options will be dynamically inserted here -->
                <?php echo $outputPatients;?>
            </select>
            <label for="doctor">Doctor:</label>
            <select id="doctor" name="doctor">
                <!-- Doctor options will be dynamically inserted here -->
                <?php echo $outputDoctors ?>
            </select>
            <label for="appointmentDate">Date:</label>
            <input type="date" id="appointmentDate" name="appointmentDate" required>
            <label for="appointmentTime">Time:</label>
            <input type="time" id="appointmentTime" name="appointmentTime" required>
            <button type="submit">Schedule Appointment</button>
        </form>
        <h2>Appointments List</h2>
        <table id="appointmentsTable">
            <thead>
                <tr>
                    <th>Patient</th>
                    <th>Doctor</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Appointment records will be dynamically inserted here -->
                <?php echo $output ?>
            </tbody>
        </table>
    </main>
    <script src="../js/main.js"></script>
</body>
</html>
