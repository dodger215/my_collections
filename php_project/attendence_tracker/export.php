<?php
include_once 'php/config.php';

// Get the current date
$current_date = date('Y-m-d');

// Path to the JSON file
$json_file_path = 'attendance_data.json';

// Create a query to get all data from the member_present table
$query = mysqli_query($conn, "SELECT * FROM member_present");

$data = [];
if (mysqli_num_rows($query) > 0) {
    // Fetch each row and add it to the array
    while ($row = mysqli_fetch_assoc($query)) {
        $data[] = $row;
    }

    // Initialize an empty array to hold the existing JSON data
    $existing_data = [];

    // Check if the JSON file exists
    if (file_exists($json_file_path)) {
        // Read the existing data from the JSON file
        $existing_data = json_decode(file_get_contents($json_file_path), true);
    }

    // Add the new data under the current date as an identifier
    $existing_data[$current_date] = $data;

    // Write the updated data back to the JSON file
    file_put_contents($json_file_path, json_encode($existing_data, JSON_PRETTY_PRINT));

    // Delete all data from the member_present table
    mysqli_query($conn, "DELETE FROM member_present");

    // Send response back to the client
    echo json_encode(['status' => 'success', 'message' => 'Data exported and added to the JSON file']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'No data to export']);
}
?>

