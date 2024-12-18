<?php
session_start();
require 'includes/db.php'; // Koneksi database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk memeriksa pengguna
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();

    // Verifikasi password
    if ($user && $user['password'] === $password) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        
        // Set cookie jika "Remember Me" dicentang
        if (isset($_POST['remember'])) {
            $cookieValue = $user['id'] . ':' . $user['password']; // Contoh cookie value
            setcookie('remember_me', $cookieValue, time() + (86400 * 30), "/"); // 30 hari
        }

        // Redirect berdasarkan role
        if ($user['role'] === 'admin') {
            header('Location: dashboard_admin.php'); // Halaman Dashboard Admin
        } else {
            header('Location: dashboard_user.php'); // Halaman Dashboard User
        }
        exit();
    } else {
        $error = "Username atau password salah!";
    }
} else {
    // Cek cookie untuk login otomatis
    if (isset($_COOKIE['remember_me'])) {
        list($userId, $password) = explode(':', $_COOKIE['remember_me']);
        
        // Query untuk memeriksa pengguna
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id AND password = :password");
        $stmt->execute(['id' => $userId, 'password' => $password]);
        $user = $stmt->fetch();

        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Redirect berdasarkan role
            if ($user['role'] === 'admin') {
                header('Location: dashboard_admin.php');
            } else {
                header('Location: dashboard_user.php');
            }
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style1.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <div class="remember-me">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember Me</label>
            </div>
            <button type="submit">Login</button>
            <?php if (isset($error)): ?>
                <p><?php echo $error; ?></p>
            <?php endif; ?>
        </form>
        <div class="footer">
            <p>&copy; 2024 My Website</p>
            <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
        </div>
    </div>
</body>
</html>