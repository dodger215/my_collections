<?php

require './admin/config/function.php';

//Inserting Enquiries Data Into The Database
// if (isset($_POST['enquirySave'])) {
//     $name = validate($_POST['name']);
//     $email = validate($_POST['email']);
//     $phone = validate($_POST['phone']);
//     $service = validate($_POST['service']);
//     $message = validate($_POST['message']);

//     $query = "INSERT INTO enquiries(name, email, phone, service, message)
//     VALUES('$name', '$email', '$phone', '$service', '$message')";
//     $result = mysqli_query($conn, $query);

//     if ($result) {
//         redirect('thank-you.php', 'Thank You For Enquiry');
//     }else{
//         redirect('service.php', 'Enqiury Not Saved');
//     }
// }


//Inserting Enquiries Data Into The Database
if (isset($_POST['appointmentSave'])) {
    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $phone = validate($_POST['phone']);
    $appoinment = validate($_POST['appoinment']);
    $message = validate($_POST['message']);

    $query = "INSERT INTO appoinmentenquiries(name, email, phone, appoinment, message)
    VALUES('$name', '$email', '$phone', '$appoinment', '$message')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        redirect('thank-you.php', 'Thank You For Enquiry');
    }else{
        redirect('appoinments.php', 'Enqiury Not Saved');
    }
}
?>