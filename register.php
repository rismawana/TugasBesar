<?php
session_start();
require 'includes/db.php'; // Koneksi database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password']; // Simpan password tanpa hashing
    $role = 'user'; // Default role is user

    // Cek apakah username sudah ada
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    if ($stmt->rowCount() > 0) {
        $error = "Username sudah terdaftar!";
    } else {
        // Masukkan pengguna baru ke database
        $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (:username, :password, :role)");
        $stmt->execute(['username' => $username, 'password' => $password, 'role' => $role]);
        header('Location: login.php'); // Redirect ke halaman login setelah berhasil
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran - Hijab Ana</title>
    <link rel="stylesheet" href="css/style1.css">
</head>
<body>
    <div class="container">
        <h2>Pendaftaran</h2>
        <form action="" method="POST">
            <?php if (isset($error)): ?>
                <p style="color:red;"><?= $error; ?></p>
            <?php endif; ?>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Daftar</button>
        </form>
        <div class="footer">
            <p>&copy; 2024 My Website</p>
            <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
        </div>
    </div>
</body>
</html>