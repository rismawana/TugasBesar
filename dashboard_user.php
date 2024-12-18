<?php
session_start();
require 'includes/db.php'; // Update path ke db.php

// Check if the user is logged in and is a user
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php"); // Redirect to login if not user
    exit();
}

// Ambil data pengguna
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
$stmt->execute(['id' => $user_id]);
$user = $stmt->fetch();
?>
<!DOCTYPE html>
< lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HIjab Ana</title>
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
    <!-- feather icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- my style -->
    <link rel="stylesheet" href="css/style2.css">
</head>
<>

    <!-- Navbar start -->
     <nav class="navbar">
        <a href="#" class="navbar-logo">Hijab Ana</a>

        <div class="navbar-nav">
        <a href="#home">Home</a>
        <a href="#about">Tentang Kami</a>
        <a href="#menu">Menu</a>
        <a href="#sale">Sale</a>
        <a href="#contact">Kontak</a>
        </div>

        <div class="navbar-extra">
            <a href="#" id="search"><i data-feather="search"></i></a>
            <a href="#" id="shopping-cart"><i data-feather="shopping-cart"></i></a>
            <a href="#" id="hamburger-menu"><i data-feather="menu"></i></a>
            <div class="account-dropdown">
    <a href="#" id="account" onclick="toggleDropdown(event)">
        <i data-feather="user"></i>
    </a>
    <div class="dropdown-content" id="dropdownMenu">
        <?php if (isset($_SESSION['username'])): ?>
            <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>
            <a href="#profile">Profile</a>
            <a href="#settings">Settings</a>
            <a href="logout.php">Logout</a> <!-- Logout link -->
        <?php else: ?>
            <a href="login.php">Login</a>
        <?php endif; ?>
    </div>
</div>
        </div>
     </nav>

     <!-- Navbar end -->

    

     <!-- Hero Section start -->
     <section class="hero" id="home">
        <main class="content">
            <h1>Tampil Anggun dengan Koleksi <span>Hijab</span> Terbaru Kami.</h1>
            <p>Hadirkan keindahan dan kenyamanan dalam setiap langkah. Temukan gaya yang mencerminkan kepribadianmu.</p>
            <a href="#" class="cta">Beli Sekarang</a>
        </main>
     </section>

     <!-- Hero Section end -->

     <!-- About Section start -->
     <section id="about" class="about">
        <h2><span>Tentang</span> Kami</h2>
        
        <div class="row">
            <div class="about-img">
                <img src="img/Tentang-kami.jpg" alt="Tentang Kami">
            </div>
            <div class="content">
               <h3>Kenapa memilih hijab kami?</h3>
               <p>Selamat datang di Hijab Ana! Kami hadir untuk memberikan koleksi hijab yang elegan, nyaman, dan berkualitas tinggi. Dengan berbagai pilihan desain dan warna, kami berkomitmen untuk memenuhi kebutuhan gaya hidup modern Anda, sambil memastikan kenyamanan dalam setiap kesempatan. Di Hijab Ana, hijab bukan hanya tentang penampilan, tetapi juga rasa percaya diri. Temukan hijab yang sempurna untuk setiap momen Anda di sini.</p> 
            </div>
        </div>
     </section>
     <!-- About Section and -->

     <!-- Menu Section Start-->
     <section id="menu" class="menu">
    <h2><span>Shop By</span> Category</h2>

    <div class="row">
        <?php
        // Ambil data produk dari database
        $stmt = $pdo->query("SELECT * FROM products");
        $products = $stmt->fetchAll();

        if (count($products) > 0): ?>
            <?php foreach ($products as $product): ?>
                <div class="menu-card">
                    <img src="<?= htmlspecialchars($product['image'] ?? 'default.jpg'); ?>" alt="<?= htmlspecialchars($product['title'] ?? 'Unknown Title'); ?>" class="menu-card-img">
                    <h3 class="menu-card-title"><?= htmlspecialchars($product['title'] ?? 'Unknown Title'); ?></h3>
                    <p class="menu-card-price">IDR <?= htmlspecialchars(number_format($product['price'] ?? 0, 2)); ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No products found.</p>
        <?php endif; ?>
    </div>
</section>

     <!-- Menu Section and-->

     <!-- Sale Section Start-->
     <section id="sale" class="sale">
        <h2><span>Sale</span></h2>

        <div class="sale-row">
            <div class="sale-card">
                <img src="img/menu/gambar1.jpg" alt="gambar1" class="sale-card-img">
                <h3 class="sale-card-title">Phasmina Ciput </h3>
                <p class="sale-card-price">IDR 45k</p>
            </div>
            <div class="sale-card">
                <img src="img/menu/gambar2.jpg" alt="gambar2" class="sale-card-img">
                <h3 class="sale-card-title">Phasmina</h3>
                <p class="sale-card-price">IDR 55k</p>
            </div>
            <div class="sale-card">
                <img src="img/menu/gambar3.jpg" alt="gambar3" class="sale-card-img">
                <h3 class="sale-card-title">Hijab Motif </h3>
                <p class="sale-card-price">IDR 60k</p>
            </div>
            <div class="sale-card">
                <img src="img/menu/gambar4.jpg" alt="gambar4" class="sale-card-img">
                <h3 class="sale-card-title">Hijab Polos </h3>
                <p class="sale-card-price">IDR 35k</p>
            </div>
            <div class="sale-card">
                <img src="img/menu/gambar5.jpg" alt="gambar5" class="sale-card-img">
                <h3 class="sale-card-title">Phasmina Kaos</h3>
                <p class="sale-card-price">IDR 45k</p>
            </div>
        </div>
     </section>

     <!-- Sale Section and-->
     <!-- Contact Secction start -->
      <section id="contact" class="contact">
        <h2><span>Contact</span> Kami</h2>

        <div class="row">
           <form action="">
            <div class="input-group">
                <i data-feather="user"></i>
                <input type="text" placeholder="nama">
            </div>
            <div class="input-group">
                <i data-feather="mail"></i>
                <input type="text" placeholder="email">
            </div>
            <div class="input-group">
                <i data-feather="phone"></i>
                <input type="text" placeholder="no hp">
            </div>
            <button type="submit" class="btn">Kirim pesan</button>
           </form> 
        </div>
      </section>
     <!-- Contact Secction and -->

     <!-- Footer start -->
      <footer>
        <div class="socials">
            <a href="#"><i data-feather="instagram"></i></a>
            <a href="#"><i data-feather="twitter"></i></a>
        </div>
        <div class="links">
            <a href="#home">Home</a>
            <a href="#about">Tentang Kami</a>
            <a href="#menu">Menu</a>
            <a href="#sale">Sale</a>
            <a href="#contact">Kontak</a>
        </div>
        <div class="credit">
            <p>Created by <a href="">Rismawana</a>. | &copy; 2024.</p>
        </div>
      </footer>
     <!-- Footer and -->
    <!-- feather icons -->
    <script>
        feather.replace();
    </script>

    <!-- my JAvaScript -->
     <script src="js/script.js"></script>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user['id']; ?></td>
            <td><?= htmlspecialchars($user['username']); ?></td>
            <td><?= htmlspecialchars($user['role']); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>