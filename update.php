<?php
session_start();
require 'includes/db.php'; // Update path to your db.php

// Check if user is logged in and has admin role
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Fetch the product data based on the provided ID
$productId = $_GET['id'] ?? null; // Get the product ID from the URL
$product = null;

if ($productId) {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
    $stmt->execute(['id' => $productId]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Check if product exists
if (!$product) {
    die("Product not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
</head>
<body>

<h2>Update Product</h2>

<form action="update_process.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= htmlspecialchars($product['id']); ?>">

    <label for="title">Title:</label>
<input type="text" name="title" placeholder="Product Title" value="<?= htmlspecialchars($product['title'] ?? ''); ?>" required>

    <label for="price">Price:</label>
    <input type="number" name="price" id="price" value="<?= htmlspecialchars($product['price'] ?? ''); ?>" required>

    <label for="image">Image:</label>
    <input type="file" name="image" id="image">
    <p>Current Image: <br>
        <?php if (!empty($product['image'])): ?>
            <img src="<?= htmlspecialchars($product['image']); ?>" style="max-width: 200px;">
        <?php else: ?>
            No image available.
        <?php endif; ?>
    </p>

    <button type="submit">Update Product</button>
</form>

</body>
</html>