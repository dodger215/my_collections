

<?php 
require('../include/node/function.php');
require('../include/node/config.php');

if(!isset($_SESSION['auth'])){
    redirect("../signin.php", "Try again");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send ID and Image</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 50px;
        }
        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-control, .btn {
            border-radius: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card p-4">
        <a href="home.php" class="btn btn-close"></a>
        <h2 class="text-center mb-4">Submit Your Email & Upload Image</h2>
        <form action="api/verificate.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <label for="email" class="form-label">password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Change from customer to admin</button>
        </form>
    </div>
</div>

<!-- Bootstrap JS (optional for certain interactive components) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
