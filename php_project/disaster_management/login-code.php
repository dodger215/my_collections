<?php

require './admin/config/function.php';

if (isset($_POST['loginBtn'])) {
    $emailInput = validate($_POST['email']);
    $passwordInput = validate($_POST['password']);

    //Sanitizing
    $email = filter_var($emailInput, FILTER_SANITIZE_EMAIL);
    $password = filter_var($passwordInput, FILTER_SANITIZE_STRING);

    //Checking for an empty fileds
    if ($email != '' && $password != '') {
        $query = "SELECT * FROM users WHERE email='$email' AND password='$password' LIMIT 1";
        $result = mysqli_query($conn, $query);

        //If True Redirect
        if ($result) {

            //Checking the number of rows are true
            if (mysqli_num_rows($result) == 1) {

                //Fetching the data
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                //Checking the users
                if ($row['role'] == 'admin') {

                    //Checking if Users is ban
                    if ($row['is_ban'] == 1) {
                        redirect('login', 'Your account is block');
                    }

                    //Session for admin
                    $_SESSION['auth'] = true;
                    $_SESSION['loggedInUserRole'] = $row['role'];
                    $_SESSION['loggedInUser'] = [
                        'name' => $row['name'],
                        'email' => $row['email']
                    ];
                    redirect('admin/index.php', 'Login Successful');

                } else {
                    redirect('index.php', 'Login Successful');
                }
                
            } else {
                //Session for user
                $_SESSION['auth'] = true;
                $_SESSION['loggedInUserRole'] = $row['role'];
                $_SESSION['loggedInUser'] = [
                    'name' => $row['name'],
                    'email' => $row['email']
                ];
                redirect('login.php', 'Invalid Email or Password');
            }
            
        } else {
            redirect('login.php', 'Something Went Wrong');
        }
        
    } else {
        redirect('login.php', 'All fields required');
    }
    
}

?>