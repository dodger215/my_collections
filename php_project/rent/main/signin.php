<?php 


require 'include/node/function.php';

if(!isset($_SESSION['status'])){
    $_SESSION['status'] = "Log into your account";
}

$sta = $_SESSION['status'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Market Hub | sign up</title>
    <style>
.dialog {
    display: none; /* Hidden by default */
    position: fixed;
    left: 0;
    top: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.7); /* Dark overlay */
    z-index: 1001;
    justify-content: center;
    align-items: center;
    backdrop-filter: blur(5px); /* Blurred background */
    animation: fadeIn 0.3s; /* Animation for showing */
}

.dialog.active {
    display: flex; /* Show dialog when active */
    animation: fadeIn 0.3s; /* Animation for showing */
}
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"><link href="" rel="icon">
</head>
<body>
    
    <section class="auth-container d-flex align-items-center justify-content-center" style="min-height: 100vh; background-color: #f8f9fa; display: flex; flex-direction: column; justify-content: space-between;">
        <!-- <div style="padding: 5px; background-color: rgba(2, 159, 12, 0.5); border-radius: 5px; font-size: 600; color: #ffffff;"><?= $sta ?></div> -->
        <div class="auth-box bg-white p-5 rounded shadow-sm" style="max-width: 400px; width: 100%; margin: 10px 0;">
            <h2 class="text-center mb-4">Login</h2>
            <form action="./include/php/signin.php" method="POST" id="login-form">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
                <p class="text-center mt-3">Don't have an account? <a href="signup.php">Sign up here</a></p>
            </form>
        </div>
    </section>

    <div class="dialog error">
            <div class="container" style="padding: 20px 10px; width: 70%; background-color: #ffffff; border-radius: 10px; display: flex; flex-direction: column; align-items: center; justify-content: space-between;">
                <span class="icon" style="color: blue; font-weight: 600; opacity: 60%; margin: 10px 0; font-size: 4em;"><i class="fas fa-info-circle"></i></span>
                <span class="show_error" style="color: blue; font-weight: 600; opacity: 60%; margin: 10px 0;"><?= $sta ?></span>     
                <button class="btn btn-danger disable" style="margin: 10px 0;">close</button>
            </div>       
        </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>

(function(e){

    document.querySelector('.dialog').classList.add('active');
} ());





document.querySelector('.disable').addEventListener('click', () => {
    document.querySelector('.show_error').innerHTML="";
    document.querySelector('.dialog').classList.remove('active');
});

    </script>

   
</body>
</html>