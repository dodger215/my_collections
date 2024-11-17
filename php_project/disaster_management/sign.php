<?php

require './admin/config/function.php';
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$password = $_POST['password'];
$is_ban = 0;
$role = "user";



if((!empty($name)) && (!empty($phone)) && (!empty($email)) && (!empty($password))){

        $query = "INSERT INTO users(name, phone, email, password, is_ban, role) 
        VALUES('$name','$phone','$email','$password','$is_ban','$role')";

        $result = mysqli_query($conn, $query);
        if ($result) {
            redirect('index.php', "User / Admin Added Successfully");
        } else {
            redirect('sign_in.php', "Something went wrong");
    }
}
?>