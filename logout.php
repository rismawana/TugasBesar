<?php
session_start();
require 'includes/db.php'; // Koneksi database

// Hapus session
session_unset();
session_destroy();

// Hapus cookie "Remember Me"
if (isset($_COOKIE['remember_me'])) {
    setcookie('remember_me', '', time() - 3600, "/"); // Hapus cookie
    // Hapus token dari database jika perlu
    // $stmt = $pdo->prepare("UPDATE users SET remember_token = NULL WHERE id = :id");
    // $stmt->execute(['id' => $_SESSION['user_id']]);
}

header("Location: login.php");
exit();
?>