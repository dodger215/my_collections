<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle the image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $imageTmpName = $_FILES['image']['tmp_name'];
        $imageName = $_FILES['image']['name'];
        $imageType = $_FILES['image']['type'];
        
        // Set the upload directory
        $uploadDir = 'uploads/';
        $targetFile = $uploadDir . basename($imageName);

        // Check if file is an image (simple check)
        if (getimagesize($imageTmpName)) {
            if (move_uploaded_file($imageTmpName, $targetFile)) {
                echo "Image uploaded successfully.<br>";
            } else {
                echo "Error in uploading image.<br>";
            }
        } else {
            echo "Please upload a valid image.<br>";
        }
    } else {
        echo "No image uploaded or an error occurred.<br>";
    }

    // Get the type and title from the form
    $type = $_POST['type'];
    $title = $_POST['title'];
    
    // Prepare the data to save
    $data = [
        'title' => $title,
        'image' => $targetFile,  // Store the path to the uploaded image
        'type' => $type,
        'timestamp' => time(), // Add timestamp to each entry
    ];

    // Read existing data from JSON file (if any)
    $jsonFile = 'data.json';
    if (file_exists($jsonFile)) {
        $jsonData = file_get_contents($jsonFile);
        $dataArray = json_decode($jsonData, true);
    } else {
        $dataArray = [];
    }

    // Add the new data entry
    $dataArray[] = $data;

    // Save the updated data to the JSON file
    file_put_contents($jsonFile, json_encode($dataArray, JSON_PRETTY_PRINT));

    echo "Data has been saved to JSON.<br>";
} else {
    echo "Invalid request method.<br>";
}
?>
