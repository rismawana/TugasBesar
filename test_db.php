<?php
require 'includes/db.php';

$stmt = $pdo->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($products as $product) {
    echo "ID: " . htmlspecialchars($product['id']) . "<br>";
    echo "Title: " . htmlspecialchars($product['title']) . "<br>";
    echo "Price: IDR " . htmlspecialchars($product['price']) . "<br>";
    echo "Image: " . htmlspecialchars($product['image']) . "<br><br>";
}
?>