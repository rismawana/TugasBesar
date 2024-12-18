<?php
require 'includes/db.php';

// Hash password untuk admin
$hashedPassword = password_hash('admin12', PASSWORD_DEFAULT);

try {
    // Pastikan hanya dieksekusi sekali
    $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES ('admin', :password, 'admin')");
    $stmt->execute(['password' => $hashedPassword]);
    echo "Akun admin berhasil dibuat.";
} catch (PDOException $e) {
    echo "Terjadi kesalahan: " . $e->getMessage();
}
?>