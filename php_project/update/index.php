<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload Form</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom Dark Theme Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: #f1f1f1;
        }
        .container {
            padding-top: 50px;
            max-width: 600px;
            margin: auto;
        }
        .btn-custom {
            background-color: #4CAF50;
            color: white;
            border-radius: 4px;
        }
        label {
            font-weight: bold;
            color: #f1f1f1;
        }
        .form-control {
            background-color: #333;
            color: #f1f1f1;
            border: 1px solid #555;
        }
        .form-control:focus {
            border-color: #4CAF50;
            box-shadow: 0 0 0 0.2rem rgba(76, 175, 80, 0.5);
        }
        .btn-custom:hover {
            background-color: #45a049;
        }
        h2 {
            color: #f1f1f1;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-control::placeholder {
            color: #bbb;
        }
        /* For Button Disabled State */
        .btn:disabled {
            background-color: #777;
            border-color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Upload Image</h2>
        <form action="save.php" method="POST" enctype="multipart/form-data">
            <!-- Image Upload -->
            <div class="form-group">
                <label for="image">Choose an image:</label>
                <input type="file" class="form-control" name="image" id="image" required>
            </div>

            <!-- Type Selection -->
            <div class="form-group">
                <label for="type">Type:</label>
                <select class="form-control" name="type" id="type" required>
                    <option value="all">All</option>
                    <option value="logo">Logo</option>
                    <option value="others">Others</option>
                </select>
            </div>

            <!-- Title Input -->
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" name="title" id="title" placeholder="Enter title" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-custom btn-block">Submit</button>
        </form>
    </div>

    <!-- Add Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
