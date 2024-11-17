<?php

session_start();
if(isset($_SESSION['first_name'])){
    header("location: ../pages/doctors.php");
}

$output = "";
$outputPatients = "";
$outputDoctors = "";


include_once "php/config.php";

$sql = "SELECT * FROM billing";
$sql2 = "SELECT * FROM patients";
$sql3 = "SELECT * FROM appointments";
$query = mysqli_query($conn, $sql);
$queryPatients = mysqli_query($conn, $sql2);
$queryApointments = mysqli_query($conn, $sql3);

$AppoName = "";
$PatientName = "";

$billId = "";



if(mysqli_num_rows($queryPatients) > 0){
    while ($row = mysqli_fetch_assoc($queryPatients)) {
        $patFName = $row['first_name'] . " " . $row['last_name'];
        
        $outputPatients .= ' 
                <option value="'. $row['patient_id'] .'">' .$patFName. '</option>
        ';

        $PatientName = $patFName;
    }

}

if(mysqli_num_rows($queryApointments) > 0){
    while ($row = mysqli_fetch_assoc($queryApointments)) {
        $docFName = $row['appointment_date'];
        $outputDoctors .= ' 
                <option value="'. $row['appointment_id'] .'">' .$docFName. '</option>
        ';
        $docName = $docFName;
    }
}

if(mysqli_num_rows($query) > 0){
    while ($row = mysqli_fetch_assoc($query)) {
        $billId = $row['bill_id'];
        $output .= ' 
                <tr>
                    <th>'. $PatientName .'</th>
                    <th>'. $docName .'</th>
                    <th>'. $row['amount'] .'</th>
                    <th>'. $row['payment_date'] .'</th>
                    <th>'. $row['payment_status'] .'</th>
                    <th>Active</th>

                    <form method="post" autocomplete="off">
                        <td>
                            <button class="delete" name="delete">Delete</button>
                        </td>
                    </form>
                </tr>
        ';
    }

    if(isset($_POST['delete'])){
        $query = mysqli_query($conn, "DELETE FROM billing WHERE bill_id = '{$billId}'");
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing and Payment</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <header>
        <h1>Billing and Payment</h1>
        <nav>
            <ul>
                <li><a href="../index.html">Dashboard</a></li>
                <li><a href="patient.php">Patients</a></li>
                <li><a href="doctors.php">Doctors</a></li>
                <li><a href="appointments.php">Appointments</a></li>
                <li style="border-bottom: solid 3px #ffffff8e; color: rgba(255, 255, 255, 0.91); padding: 10px 15px; margin: -10px; font-weight: 500;"><a href="billing.php">Billing</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Generate Bill</h2>
        <form id="generateBillForm">
            <label for="patientBill">Patient:</label>
            <select id="patientBill" name="patientBill">
                <!-- Patient options will be dynamically inserted here -->
            </select>
            <label for="appointmentBill">Appointment:</label>
            <select id="appointmentBill" name="appointmentBill">
                <!-- Appointment options will be dynamically inserted here -->
            </select>
            <label for="amount">Amount:</label>
            <input type="number" id="amount" name="amount" required>
            <label for="paymentStatus">Payment Status:</label>
            <select id="paymentStatus" name="paymentStatus">
                <option value="Paid">Paid</option>
                <option value="Unpaid">Unpaid</option>
            </select>
            <label for="paymentDate">Payment Date:</label>
            <input type="date" id="paymentDate" name="paymentDate" required>
            <button type="submit">Generate Bill</button>
        </form>
        <h2>Billing List</h2>
        <table id="billingTable">
            <thead>
                <tr>
                    <th>Patient</th>
                    <th>Appointment</th>
                    <th>Amount</th>
                    <th>Payment Status</th>
                    <th>Payment Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Billing records will be dynamically inserted here -->
            </tbody>
        </table>
    </main>
    <script src="../js/main.js"></script>
</body>
</html>
