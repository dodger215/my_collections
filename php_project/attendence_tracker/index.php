<?php
session_start();
include_once 'php/config.php';

$msg = "";
$id = "";
$class = "";
$full = "";
$num = "";
$confirm = "";

$sql = "SELECT * FROM register";
$query = mysqli_query($conn, $sql);

if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        $id = $row['unique_id'];
        $full = $row['first_name'] . " " . $row['last_name'];
        $num = $row['number'];
        
        // Dynamically create options based on conditions
        if ($row['gender'] == 'male' && $row['status_no'] == 'married') {
            $msg .= '<option value="' . $row['unique_id'] . '"> Mr. ' . $row['first_name'] . " " . $row['last_name'] . '</option>';
        }if ($row['gender'] == 'female' && $row['status_no'] == 'married') {
            $msg .= '<option value="' . $row['unique_id'] . '"> Mrs. ' . $row['first_name'] . " " . $row['last_name'] . '</option>';
        }if ($row['gender'] == 'male' && $row['status_no'] == 'single' && $row['title'] == 'member') {
            $msg .= '<option value="' . $row['unique_id'] . '"> Bro. ' . $row['first_name'] . " " . $row['last_name'] . '</option>';
        }if ($row['gender'] == 'female' && $row['status_no'] == 'single' && $row['title'] == 'member') {
            $msg .= '<option value="' . $row['unique_id'] . '"> Sis. ' . $row['first_name'] . " " . $row['last_name'] . '</option>';
        }if ($row['gender'] == 'male' && ($row['status_no'] == 'married' || $row['status_no'] == 'single') && $row['title'] == 'dcn') {
            $msg .= '<option value="' . $row['unique_id'] . '"> Dcn. ' . $row['first_name'] . " " . $row['last_name'] . '</option>';
        }if ($row['gender'] == 'female' && ($row['status_no'] == 'married' || $row['status_no'] == 'single') && ($row['title'] == 'dcn' || $row['title'] == 'eld' || $row['title'] == 'pastor')) {
            $msg .= '<option value="' . $row['unique_id'] . '"> Dcns. ' . $row['first_name'] . " " . $row['last_name'] . '</option>';
        }if ($row['gender'] == 'male' && ($row['status_no'] == 'married' || $row['status_no'] == 'single') && $row['title'] == 'elder') {
            $msg .= '<option value="' . $row['unique_id'] . '"> Eld. ' . $row['first_name'] . " " . $row['last_name'] . '</option>';
        }
        if ($row['gender'] == 'male' && ($row['status_no'] == 'married' || $row['status_no'] == 'single') && $row['title'] == 'paster') {
            $msg .= '<option value="' . $row['unique_id'] . '"> Eld. ' . $row['first_name'] . " " . $row['last_name'] . '</option>';
        }
    }
} else {
    $msg = "<option>No data</option>";
}

if (isset($_POST['send'])) {
    $list = $_POST['list'];
    $stat = "present";
    $sql_sel = mysqli_query($conn, "SELECT * FROM register WHERE unique_id = '{$list}'");
    $row = mysqli_fetch_assoc($sql_sel);
    $full = $row['first_name'] . " " . $row['last_name'];
    $check = mysqli_query($conn, "SELECT * FROM member_present WHERE unique_id = '{$list}'");

    if (mysqli_num_rows($check) > 0) {
        $_SESSION['status'] = "<span class='text-danger font-weight-bold'>Member already present</span>";
    } else {
        $row1 = mysqli_query($conn, "INSERT INTO member_present (unique_id, full_name, classified, phone, state, gender) VALUE ('{$row['unique_id']}', '{$full}', '{$row['title']}', '{$row['number']}', '{$stat}', '{$row['gender']}')");
        if ($row1) {
            $_SESSION['status'] = "<span class='text-success font-weight-bold'>$full added</span>";
        }
    }
}

$show = "";
$sel_sql = mysqli_query($conn, "SELECT * FROM member_present");
if (mysqli_num_rows($sel_sql) > 0) {
    while ($row = mysqli_fetch_assoc($sel_sql)) {
        $id = $row['full_name'];
        $show .= "<li class='list-group-item d-flex justify-content-between'><span>{$row['full_name']}</span><button name='del' class='btn btn-danger btn-sm'>&times;</button></li>";
    }
} else {
    $show = "<span class='text-muted'>No attendance</span>";
}

if (isset($_POST['del'])) {
    mysqli_query($conn, "DELETE FROM member_present WHERE full_name = '{$id}'");
    $_SESSION['status'] = "Deleted successfully";
}

$total_mem = mysqli_num_rows(mysqli_query($conn, "SELECT state FROM member_present"));
$sql_male = mysqli_query($conn, "SELECT * FROM member_present WHERE gender = 'male'");
$sql_female = mysqli_query($conn, "SELECT * FROM member_present WHERE gender = 'female'");
$total = mysqli_num_rows($query);
$tot_male = mysqli_num_rows($sql_male);
$tot_female = mysqli_num_rows($sql_female);

if (isset($_SESSION['status'])) {
    $confirm = $_SESSION['status'];
} else {
    $confirm = "";
}

if (isset($_POST['edit'])) {
    $_SESSION['id'] = $_POST['list'];
    header('location: edit.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <!-- Status Message -->
    <?php if ($confirm): ?>
        <div class="alert alert-info text-center"><?= $confirm ?></div>
    <?php endif; ?>

    <!-- Attendance Form -->
    <div class="card shadow-sm p-4 mb-5">
        <h1 class="text-center mb-4">Attendance</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="list" class="form-label">Select your name</label>
                <div class="input-group">
                    <select name="list" id="list" class="form-select">
                        <?= $msg ?>
                    </select>
                    <button name="send" class="btn btn-primary">Submit</button>
                </div>
            </div>
            <div class="d-grid">
                <button name="edit" type="submit" class="btn btn-warning">Edit Member Details</button>
            </div>
        </form>
        <div class="text-center mt-3">
            <p>If your name isn't listed, click <strong>Add Member</strong> to register.</p>
            <button class="btn btn-outline-success pop_up">Add Member</button>
        </div>
    </div>

    <!-- Members Present -->
    <div class="card shadow-sm p-4 mb-5">
        <h3 class="h5 mb-3">Members Present</h3>
        <select class="form-select mb-3">
            <option>Total: <?= $total_mem ?></option>
            <option>Males: <?= $tot_male ?></option>
            <option>Females: <?= $tot_female ?></option>
        </select>
        <form method="POST">
            <ol class="list-group">
                <?= $show ?>
            </ol>
        </form>
    </div>

    <!-- View Overall Button -->
    <div class="text-center">
        <form action="view.php" method="POST">
            <button class="btn btn-outline-primary">View Overall Attendance</button>
        </form>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="script.js"></script>
</body>
</html>