<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

require '../asset/config.php';

$method = $_SERVER['REQUEST_METHOD'];

$input = json_decode(file_get_contents('php://input'), true);
if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode(["status" => "error", "message" => "Invalid JSON input"]);
    exit;
}

function validate($conn, $input) {
    return trim(mysqli_real_escape_string($conn, $input));
}

function encrypt($input){
    $txt_encrypt = strrev(md5($input));
    $pass = $txt_encrypt. md5($input);

    return $pass;
}

function signinUser() {
    global $conn, $input;
    if (!empty($input['email']) && !empty($input['password'])) {
        $email = validate($conn, $input['email']);
        $password = validate($conn, $input['password']);
        $encrypt_password = encrypt($password);

        // Check if the user exists with the provided email and encrypted password
        $sql = "SELECT * FROM user WHERE email = '{$email}' AND password = '{$encrypt_password}'";
        $query = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($query) > 0) {
            // User found, return success
            echo json_encode(["status" => "success", "message" => "Signin successful"]);
        } else {
            // No matching user, return error
            echo json_encode(["status" => "error", "message" => "Invalid credentials"]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Missing email or password"]);
    }
}

switch ($method) {
    case 'POST':
        signinUser();
        break;
    default:
        echo json_encode(["status" => "error", "message" => "Method not allowed"]);
        break;
}

?>
