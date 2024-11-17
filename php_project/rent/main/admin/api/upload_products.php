<?php
session_start();

if (!isset($_SESSION['auth'])) {
    header("Location: ../../signin.php");
    exit("Try again");
}

$ran_id = rand(2000, 9999);
header('Content-Type: application/json');

$uploadDir = 'uploads/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$jsonFilePath = 'products_data.json';

$response = [
    'status' => 'error',
    'message' => '',
    'products' => []
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $existingProducts = file_exists($jsonFilePath) ? json_decode(file_get_contents($jsonFilePath), true) : [];
    $existingProducts = is_array($existingProducts) ? $existingProducts : [];

    if (isset($_FILES['images']) && !empty($_POST['location'])) {
        $totalProducts = count($_POST['location']);

        for ($i = 0; $i < $totalProducts; $i++) {
            $product = [
                'user_id' => $_SESSION['auth'],
                'product_id' => $ran_id,
                'location' => $_POST['location'][$i] ?? '',
                'description' => $_POST['product_descriptions'][$i] ?? '',
                'teams' => $_POST['rent_descriptions'][$i] ?? '',
                'period' => $_POST['period'][$i] ?? '',
                'price' => $_POST['product_prices'][$i] ?? '',
                'image' => ''
            ];

            if (isset($_FILES['images']['tmp_name'][$i]) && is_uploaded_file($_FILES['images']['tmp_name'][$i])) {
                $imageName = basename($_FILES['images']['name'][$i]);
                $imagePath = $uploadDir . time() . "_" . $imageName . "-" . $_SESSION['auth'];

                if (move_uploaded_file($_FILES['images']['tmp_name'][$i], $imagePath)) {
                    $product['image'] = $imagePath;
                } else {
                    $response['message'] = 'Error uploading image: ' . $imageName;
                    echo json_encode($response);
                    exit;
                }
            } else {
                $response['message'] = 'No image uploaded for product: ' . $product['title'];
                echo json_encode($response);
                exit;
            }

            $existingProducts[] = $product;
        }

        file_put_contents($jsonFilePath, json_encode($existingProducts, JSON_PRETTY_PRINT));

        $response['status'] = 'success';
        $response['message'] = 'Products uploaded successfully!';
        $response['products'] = $existingProducts;
    } else {
        $response['message'] = 'Please provide both images and product titles.';
    }

    echo json_encode($response);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
