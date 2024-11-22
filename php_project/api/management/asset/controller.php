<?php 
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
require 'config.php';
$method = $_SERVER['REQUEST_METHOD'];
$input = [];

if (in_array($method, ['POST', 'PUT', 'DELETE'])) {
    $input = json_decode(file_get_contents('php://input'), true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo json_encode(["status" => "error", "message" => "Invalid JSON input"]);
        exit;
    }
}


switch ($method) {
    // case 'GET':
    //     if (!empty($_GET['unique_id'])) {
    //         $id = $_GET['unique_id'];
    //         getUser($id);
    //     } else {
    //         getUsers();
    //     }
    //     break;
    case 'POST':
        createUsers();
        break;
    case 'PUT':
        $id = $_GET['unique_id'];
        updateUser($id);
        break;
    case 'DELETE': 
        $id = $_GET['unique_id'];
        deleteUser($id);
        break;
        case 'UPDATE_PASSWORD': 
            $id = $_GET['unique_id'];
            updateUserPassword($id);
            break;
    default:
        echo json_encode(["status" => "error", "message" => "Method not allowed"]);
        break;
}

function validate($conn, $input) {
    return trim(mysqli_real_escape_string($conn, $input));
}

function encrypt($input){
    $txt_encrypt = strrev(md5($input));
    $pass = $txt_encrypt. md5($input);

    return $pass;
}

function getUser($uniqueId) {    
    global $conn;
    $id = validate($conn, $_GET['unique_id']);
    $sql = "SELECT * FROM user WHERE unique_id = '{$id}'";
    $query = mysqli_query($conn, $sql);
    echo json_encode(mysqli_fetch_assoc($query));
}

function getUsers() {
    global $conn; 
    $sql = "SELECT * FROM user";
    $query = mysqli_query($conn, $sql);
    $users = mysqli_fetch_all($query, MYSQLI_ASSOC);  
    echo json_encode($users);
}

function createUsers() {
    global $conn, $input;
    if (
        !empty($input['first_name']) && 
        !empty($input['last_name']) && 
        !empty($input['password']) && 
        !empty($input['email']) && 
        !empty($input['work_type']) && 
        !empty($input['date_of_birth']) && 
        !empty($input['gender'])
    ) {
        $uniqueId = strrev(md5($input['first_name'] . rand(10000, 999999)));
        $name = validate($conn, $input['first_name']) . " " . validate($conn, $input['last_name']);
        $email = validate($conn, $input['email']);
        $type = validate($conn, $input['work_type']);
        $dof = validate($conn, $input['date_of_birth']);
        $gender = validate($conn, $input['gender']);
        $password = validate($conn, $input['password']);
        $encrypt_password = encrypt($password);

        $stmt = $conn->prepare("INSERT INTO user (unique_id, full_name, email, work_type, date_of_birth, gender, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $uniqueId, $name, $email, $type, $dof, $gender, $encrypt_password);

        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "User info created successfully"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to create user"]);
        }

        $stmt->close();
    } else {
        echo json_encode(["status" => "error", "message" => "Missing values"]);
    }
}


function updateUser($uniqueId) {
    global $conn, $input;
    if ((isset($_GET['unique_id'])) && (!empty($input['first_name'])) && (!empty($input['last_name'])) && (!empty($input['password'])) && (!empty($input['email'])) && (!empty($input['work_type'])) && (!empty($input['date_of_birth'])) && (!empty($input['gender']))) {
        $id = validate($conn, $_GET['unique_id']);
        $name = validate($conn, $input['first_name']) . " " . validate($conn, $input['last_name']);
        $email = validate($conn, $input['email']);
        $type = validate($conn, $input['work_type']);
        $dof = validate($conn, $input['date_of_birth']);
        $gender = validate($conn, $input['gender']);

        $sql = "UPDATE user SET name = '{$name}', email = '{$email}', work_type = '{$type}', date_of_birth = '{$dof}', gender = '{$gender}' WHERE unique_id = '{$id}'";
        $query = mysqli_query($conn, $sql);

        if ($query) {
            echo json_encode(["status" => "success", "message" => "User info updated successfully"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to update user"]);
        }            
    } else {
        echo json_encode(["status" => "Error", "message" => "Missing values"]);
    }
}

function deleteUser($uniqueId) {
    global $conn;
    if (isset($_GET['unique_id'])) {
        $id = validate($conn, $_GET['unique_id']);

        $sql = "DELETE FROM user WHERE unique_id = '{$id}'";
        $query = mysqli_query($conn, $sql);

        if ($query) {
            echo json_encode(["status" => "success", "message" => "User info deleted successfully"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to delete user"]);
        }            
    } else {
        echo json_encode(["status" => "Error", "message" => "Failed"]);
    }
}

function updateUserPassword($uniqueId) {
    global $conn, $input;
    if ((isset($_GET['unique_id'])) && (!empty($input['password']))) {
        $id = validate($conn, $_GET['unique_id']);
        $password = validate($conn, $input['password']);

        $encrypt_password = encrypt($password);
        $sql = "UPDATE user SET password = '{$encrypt_password}' WHERE unique_id = '{$id}'";
        $query = mysqli_query($conn, $sql);

        if ($query) {
            echo json_encode(["status" => "success", "message" => "User info updated successfully"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to update user"]);
        }            
    } else {
        echo json_encode(["status" => "Error", "message" => "Missing values"]);
    }
}