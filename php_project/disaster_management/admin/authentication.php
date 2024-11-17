<?php

//Checking the authentication
 if (isset($_SESSION['auth'])) {

    //Checking the role
    if (isset($_SESSION['loggedInUserRole'])) {
        $role = validate($_SESSION['loggedInUserRole']);
        $email = validate($_SESSION['loggedInUser']['email']);

        //Verification
        $query = "SELECT * FROM users WHERE email='$email' AND role='$role' LIMIT 1";
        $result = mysqli_query($conn, $query);

        //If True
        if ($result) {
            if (mysqli_num_rows($result) == 0) {

                //Logout Session
                logouSession();
                redirect('index.php', 'Access Denied');
            } else {
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                //Checking if the user is not an admin
                if ($row['role'] != 'admin') {
                    logouSession();
                    redirect('index.php', 'You cannot loggin as admin');
                }
                
                //Checking if the user is blocked
                if ($row['is_ban'] == 1) {
                    logouSession();
                redirect('index.php', 'Your account has benn bloaked');
                }
                
            }
            
        } else {
            redirect('index.php', 'Something Went Wrong');
        }
        
    }
 }else{
    //Not authenticated
    redirect('index.php', 'Login as admin to access the dashboard');
 }

?>