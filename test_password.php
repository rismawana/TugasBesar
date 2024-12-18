<?php
require 'includes/db.php';

$username = 'admin'; // Username admin
$password = 'admin12'; // Password yang ingin diuji

$stmt = $pdo->prepare("SELECT password FROM users WHERE username = :username");
$stmt->execute(['username' => $username]);
$user = $stmt->fetch();

if ($user) {
    if (password_verify($password, $user['password'])) {
        echo "Password valid!";
    } else {
        echo "Password tidak valid.";
    }
} else {
    echo "User tidak ditemukan.";
}
?>