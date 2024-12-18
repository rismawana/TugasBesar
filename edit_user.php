<?php
session_start();
require 'includes/db.php'; // Koneksi ke database

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Periksa apakah id ada di URL
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Ambil data pengguna berdasarkan id
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch();

    // Jika pengguna tidak ditemukan
    if (!$user) {
        echo "Pengguna tidak ditemukan!";
        exit();
    }
} else {
    echo "ID tidak ditemukan!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengguna</title>
</head>
<body>
    <h3>Edit Pengguna</h3>
    <form action="update_user.php" method="POST">
        <input type="hidden" name="id" value="<?= $user['id']; ?>">

        <input type="text" name="username" value="<?= htmlspecialchars($user['username'] ?? ''); ?>" required>
        <input type="email" name="email" value="<?= htmlspecialchars($user['email'] ?? ''); ?>" required>

        <select name="role">
            <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
            <option value="user" <?= $user['role'] === 'user' ? 'selected' : ''; ?>>User</option>
        </select>

        <input type="password" name="password" placeholder="Password (Kosongkan jika tidak ingin mengubah)" />

        <button type="submit">Update</button>
    </form>
</body>
</html>
