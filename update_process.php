<?php
session_start();
require 'includes/db.php'; // Update path to your db.php

// Check if user is logged in and has admin role
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $name = $_POST['title'] ?? ''; // Change this to $name to match the column name
    $price = $_POST['price'] ?? 0;
    $image = $_FILES['image'] ?? null;

    // Validate data
    if ($id && !empty($name) && $price >= 0) {
        // Prepare update query using the correct column name
        $stmt = $pdo->prepare("UPDATE products SET name = :name, price = :price WHERE id = :id");
        
        // Debugging output
        echo "Updating product with ID: $id, Name: $name, Price: $price";

        $stmt->execute(['name' => $name, 'price' => $price, 'id' => $id]);

        // Handle image upload if a new image is uploaded
        if ($image && $image['error'] === UPLOAD_ERR_OK) {
            $targetDir = 'img/menu/';
            $targetFile = $targetDir . basename($image['name']);
            move_uploaded_file($image['tmp_name'], $targetFile);

            // Update the image path in the database
            $stmt = $pdo->prepare("UPDATE products SET image = :image WHERE id = :id");
            $stmt->execute(['image' => $targetFile, 'id' => $id]);
        }

        header("Location: dashboard_admin.php"); // Redirect after update
        exit();
    } else {
        die("Invalid input.");
    }
} else {
    die("Invalid request.");
}