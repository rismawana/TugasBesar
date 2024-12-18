<?php
$host = 'localhost'; // Host database
$dbname = 'role_management'; // Nama database
$username = 'root'; // Ganti dengan username yang sesuai
$password = ''; // Ganti dengan password yang sesuai, biasanya kosong untuk 'root' di localhost

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Menampilkan error jika ada
} catch (PDOException $e) {
    echo "Koneksi gagal: " . $e->getMessage(); // Menampilkan error koneksi
}
?>
