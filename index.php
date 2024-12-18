<?php
include 'includes/db.php';

$stmt = $pdo->query("SELECT * FROM menu");
$items = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Menu</title>
</head>
<body>
    <h2>Menu</h2>
    <div class="row">
        <?php foreach ($items as $item): ?>
            <div class="menu-card">
                <img src="<?= $item['image'] ?>" alt="<?= $item['title'] ?>" class="menu-card-img">
                <h3 class="menu-card-title"><?= $item['title'] ?></h3>
                <p class="menu-card-price">IDR <?= $item['price'] ?></p>
                <a href="update.php?id=<?= $item['id'] ?>">Edit</a>
                <a href="delete.php?id=<?= $item['id'] ?>">Delete</a>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>