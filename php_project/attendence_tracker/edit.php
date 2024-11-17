<?php
session_start();

if (!isset($_SESSION['id'])) {
    header('location: index.php');
    exit;
}

require_once 'php/config.php';

// Fetch the current user information
$query = mysqli_query($conn, "SELECT * FROM register WHERE unique_id = '{$_SESSION['id']}'");
$row = mysqli_fetch_array($query);

$firstName = $row['first_name'];
$lastName = $row['last_name'];
$dOB = $row['date_of_birth'];
$gen = $row['gender'];
$class = $row['status_no'];
$tel = $row['number'];
$tit = $row['title'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container mt-5">
    <div class="text-end">
        <a href="index.php" class="btn btn-danger">&times; Close</a>
    </div>
    <form method="post" autocomplete="off">
        <h2>Edit <?= htmlspecialchars($firstName . " " . $lastName) ?>'s Information</h2>
        <div class="mb-3">
            <label for="fname" class="form-label">First Name</label>
            <input type="text" class="form-control" id="fname" name="fname" placeholder="From <?= htmlspecialchars($firstName) ?> to:" />
        </div>
        <div class="mb-3">
            <label for="lname" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="lname" name="lname" placeholder="From <?= htmlspecialchars($lastName) ?> to:" />
        </div>
        <div class="mb-3">
            <label for="dateOfBirth" class="form-label">Date of Birth</label>
            <input type="date" class="form-control" id="dateOfBirth" name="dateOfBirth" />
        </div>
        <div class="mb-3">
            <label for="number" class="form-label">Telephone</label>
            <input type="tel" class="form-control" id="number" name="number" placeholder="From <?= htmlspecialchars($tel) ?> to:" />
        </div>
        <div class="mb-3">
            <label for="gender" class="form-label">Gender</label>
            <select class="form-select" id="gender" name="gender">
                <option value="<?= htmlspecialchars($gen) ?>"><?= ucfirst(htmlspecialchars($gen)) ?></option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <select class="form-select" id="title" name="title">
                <option value="<?= htmlspecialchars($tit) ?>"><?= ucfirst(htmlspecialchars($tit)) ?></option>
                <option value="member">Member</option>
                <option value="dcn">Dcn.</option>
                <option value="elder">Elder</option>
                <option value="pastor">Pastor</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status">
                <option value="<?= htmlspecialchars($class) ?>"><?= ucfirst(htmlspecialchars($class)) ?></option>
                <option value="married">Married</option>
                <option value="single">Single</option>
                <option value="courtship">Courtship</option>
            </select>
        </div>
        <button name="edit" type="submit" class="btn btn-primary">Change</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php
if (isset($_POST['edit'])) {
    $fname = !empty($_POST['fname']) ? $_POST['fname'] : $firstName;
    $lname = !empty($_POST['lname']) ? $_POST['lname'] : $lastName;
    $date = !empty($_POST['dateOfBirth']) ? $_POST['dateOfBirth'] : $dOB;
    $num = !empty($_POST['number']) ? $_POST['number'] : $tel;
    $gender = !empty($_POST['gender']) ? $_POST['gender'] : $gen;
    $title = !empty($_POST['title']) ? $_POST['title'] : $tit;
    $status = !empty($_POST['status']) ? $_POST['status'] : $class;

    // Update query
    $edit_query = mysqli_query($conn, "UPDATE register SET first_name = '{$fname}', last_name = '{$lname}', date_of_birth = '{$date}', gender = '{$gender}', status_no = '{$status}', number = '{$num}', title = '{$title}' WHERE unique_id = '{$_SESSION['id']}'");

    if ($edit_query) {
        $_SESSION['status'] = "Record updated successfully!";
        header('location: index.php');
        exit; // Make sure to exit after redirect
    } else {
        echo "<div class='alert alert-danger'>Error updating record: " . mysqli_error($conn) . "</div>";
    }
}
?>
</body>
</html>
