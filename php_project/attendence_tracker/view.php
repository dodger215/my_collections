<?php
include_once 'php/config.php';

$id = "";
$time = date('l, F j, Y');
$query = mysqli_query($conn, "SELECT * FROM member_present");

$msg = "";
$ab_msg = "";

$query_ab = mysqli_query($conn, "SELECT * FROM register WHERE unique_id NOT IN (SELECT unique_id FROM member_present)");

if (mysqli_num_rows($query_ab) > 0) {
    while ($row = mysqli_fetch_assoc($query_ab)) {
        $ab_msg .= '<tr>
                    <td>' . $row['first_name'] . ' ' . $row['last_name'] . '</td>
                    <td>' . $row['title'] . '</td>
                    <td>' . $row['number'] . '</td>
                    <td>Absent</td>
                </tr>';
    }
} else {
    $ab_msg = "<tr><td colspan='4' style='text-align: center;'>No data recorded</td></tr>";
}

if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        $msg .= '<tr>
                    <td>' . $row['full_name'] . '</td>
                    <td>' . $row['classified'] . '</td>
                    <td>' . $row['phone'] . '</td>
                    <td>' . $row['state'] . '</td>
                </tr>';
    }
} else {
    $msg = "<tr><td colspan='4' style='text-align: center;'>No data recorded</td></tr>";
}

$sql_male = mysqli_query($conn, "SELECT * FROM member_present WHERE gender = 'male'");
$sql_female = mysqli_query($conn, "SELECT * FROM member_present WHERE gender = 'female'");

$total = mysqli_num_rows($query);
$tot_male = mysqli_num_rows($sql_male);
$tot_female = mysqli_num_rows($sql_female);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Church Attendance</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa; /* Light background for contrast */
        }
        .header {
            margin-bottom: 30px;
            text-align: center;
        }
        .total {
            margin: 20px 0;
            display: flex;
            justify-content: space-around;
            font-size: 1.2em;
            font-weight: 600;
        }
        .total span {
            color: #0006b8; /* Highlighting total values */
        }
        button {
            position: absolute;
            z-index: 5000;
            right: 5%;
            bottom: 5%;
            font-size: 1.2em;
            font-weight: 600;
            color: #00d3d7;
            background-color: #002f48;
            padding: 10px 20px;
            border-radius: 50px;
            box-shadow: 2px 2px 12px #000000b0;
            outline: none;
            border: none;
        }
        a {
            text-decoration: none;
            font-size: 1.2em;
            font-weight: 600;
            color: #00d3d7;
            padding: 20px;
            position: absolute;
            z-index: 5000;
            left: 5%;
            bottom: 5%;
            background-color: #002f48;
            padding: 10px 20px;
            border-radius: 50px;
            box-shadow: 2px 2px 12px #000000b0;
        }
        .back-button {
            position: absolute;
            top: 10px;
            left: 10px;
            z-index: 5000;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="index.php" style="height: 40px;" class="btn btn-secondary back-button">Back</a>
        <header class="header">
            <h2 class="title">Church Attendance</h2>
            <span>Date: <?php echo $time; ?></span>
        </header>
        <div class="main">
            <!-- Present Members Table -->
            <h3>Present Members</h3>
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Full Name</th>
                        <th>Classified as</th>
                        <th>Phone Number</th>
                        <th>Attendance</th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $msg; ?>
                </tbody>
            </table>

            <div class="total">
                <span>Male: <?php echo $tot_male; ?></span>
                <span>Female: <?php echo $tot_female; ?></span>
                <span>Total: <?php echo $total; ?></span>
            </div>

            <!-- Absent Members Table -->
            <h3>Absent Members</h3>
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Full Name</th>
                        <th>Classified as</th>
                        <th>Phone Number</th>
                        <th>Attendance</th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $ab_msg; ?>
                </tbody>
            </table>
        </div>

        <button class="export" onclick="exportData()">Export</button>
        <a href="dashboard.php">Go to Dashboard</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>

    <script>
        // Function to export data to a JSON file and delete it from the database
        function exportData() {
            fetch('export.php', {
                method: 'POST'
            })
            .then(response => response.json())
            .then(data => {
                alert("Data exported and deleted successfully.");
            })
            .catch(error => {
                alert("There was an error exporting data.");
                console.error("Error:", error);
            });
        }
    </script>
</body>
</html>
