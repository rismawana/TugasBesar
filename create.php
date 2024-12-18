<?php
session_start();
require 'includes/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name']; // Get the name input
    $title = $_POST['title']; // Get the title input
    $price = $_POST['price']; // Get the price input
    $image = $_FILES['image']; // Get the image input

    // Handle file upload
    $target_dir = "uploads/"; // Directory to save uploaded images
    $target_file = $target_dir . basename($image["name"]);
    $uploadOk = 1;

    // Check if the file is an actual image
    $check = getimagesize($image["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size (limit to 5MB)
    if ($image["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // If everything is ok, try to upload file
        if (move_uploaded_file($image["tmp_name"], $target_file)) {
            // Insert into database
            $stmt = $pdo->prepare("INSERT INTO products (name, title, price, image) VALUES (?, ?, ?, ?)");
            $stmt->execute([$name, $title, $price, $target_file]);

            header("Location: dashboard_admin.php"); // Redirect to the admin dashboard
            exit();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
</head>
<body>
    <h2>Add New Product</h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Product Title" required>
        <input type="number" name="price" placeholder="Product Price" required step="0.01">
        <input type="file" name="image" accept="image/*" required>
        <button type="submit">Add Product</button>
    </form>
</body>
</html>