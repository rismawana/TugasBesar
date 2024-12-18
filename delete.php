<?php
session_start();
require 'includes/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: dashboard_admin.php"); // Redirect to the dashboard
    exit();
}
?>