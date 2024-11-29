<?php
session_start();

// Daftar produk dengan kategori
$products = [
    ['id' => 1, 'name' => 'Jaket', 'price' => 1000000, 'image' => 'img/Jaket.jpeg', 'category' => 'Baju'],
    ['id' => 2, 'name' => 'Jepitan', 'price' => 2000000, 'image' => 'img/jepitan.jpeg', 'category' => 'Aksesoris'],
    ['id' => 3, 'name' => 'Selimut', 'price' => 1500000, 'image' => 'img/selimut.jpeg', 'category' => 'Baju'],
    ['id' => 4, 'name' => 'Sendal', 'price' => 1000000, 'image' => 'img/Sendal.jpg', 'category' => 'Sepatu'],
    ['id' => 5, 'name' => 'Sepatu', 'price' => 2000000, 'image' => 'img/P1.jpeg', 'category' => 'Sepatu'],
    ['id' => 6, 'name' => 'Baju', 'price' => 1500000, 'image' => 'img/BB.jpg', 'category' => 'Baju'],
    ['id' => 7, 'name' => 'Kacamata', 'price' => 1000000, 'image' => 'img/kacamata.jpg', 'category' => 'Aksesoris'],
    ['id' => 8, 'name' => 'Gelang', 'price' => 26200, 'image' => 'img/gelang.jpg', 'category' => 'Aksesoris'],
    ['id' => 6, 'name' => 'Baju', 'price' => 100000, 'image' => 'img/kemeja.jpg', 'category' => 'Baju'],
    ['id' => 5, 'name' => 'Sepatu', 'price' => 329000, 'image' => 'img/sepatu300.jpg', 'category' => 'Sepatu'],
];

// Menambahkan produk ke cart menggunakan session
if (isset($_GET['add_to_cart'])) {
    $product_id = $_GET['add_to_cart'];
    $product = $products[$product_id - 1]; // Mengambil produk berdasarkan ID
    $_SESSION['cart'][] = $product; // Menambahkan produk ke cart
    echo json_encode(['status' => 'success', 'message' => 'Produk berhasil ditambahkan ke keranjang']);
    exit();
}

// Filter produk berdasarkan kategori
$selected_category = $_GET['category'] ?? null;
$filtered_products = $selected_category
    ? array_filter($products, fn($product) => $product['category'] === $selected_category)
    : $products;

// Menentukan filter harga (murah atau mahal)
$price_filter = $_GET['price_filter'] ?? null;

if ($price_filter === 'cheap') {
    usort($filtered_products, fn($a, $b) => $a['price'] - $b['price']); // Mengurutkan berdasarkan harga termurah
} elseif ($price_filter === 'expensive') {
    usort($filtered_products, fn($a, $b) => $b['price'] - $a['price']); // Mengurutkan berdasarkan harga termahal
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<header>
    <div class="logo-container">
        <img src="img/logo.jpg" alt="Logo Kelompok5" class="logo" id="logo-anda">
        <img src="img/logo kampus.jpg" alt="Logo Kampus" class="logo" id="logo-kampus">
    </div>
</header>

<h1>Selamat datang di Website Ecommerce K5</h1>

<nav class="navbar">
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="profile.php">Profil</a></li>
        <li><a href="cart.php" class="cart-icon"><i class="fas fa-shopping-cart"></i></a></li>
    </ul>
</nav>

<!-- Daftar Kategori dan Filter Harga -->
<div class="categories">
    <h2>Pilih Kategori</h2>
    <nav class="navbar">
        <ul>
            <li><a href="index.php">Semua Produk</a></li>
            <li><a href="index.php?category=Baju">Baju</a></li>
            <li><a href="index.php?category=Aksesoris">Aksesoris</a></li>
            <li><a href="index.php?category=Sepatu">Sepatu</a></li>
        </ul>
    </nav>
</div>

<div class="price-filter">
    <h3>Filter Berdasarkan Harga</h3>
    <a href="index.php?price_filter=cheap" class="<?= ($price_filter === 'cheap') ? 'active' : '' ?>">Produk Termurah</a> | 
    <a href="index.php?price_filter=expensive" class="<?= ($price_filter === 'expensive') ? 'active' : '' ?>">Produk Termahal</a>
</div>


<!-- Daftar Produk -->
<div class="product-list">
    <?php foreach ($filtered_products as $product): ?>
        <div class="product">
            <img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
            <h2><?= $product['name'] ?></h2>
            <p>Harga: Rp <?= number_format($product['price'], 0, ',', '.') ?></p>
            <button class="add-to-cart" data-id="<?= $product['id'] ?>">Tambah ke Keranjang</button>
        </div>
    <?php endforeach; ?>
</div>

<script src="js/cart.js"></script>
<!-- Footer -->
<footer>
    <div class="footer-content">
        <p>&copy; 2024 Toko Online K5. Semua hak cipta dilindungi.</p>
        <div class="footer-links">
            <a href="about.php">Tentang Kami</a> | 
            <a href="contact.php">Kontak</a> | 
            <a href="privacy.php">Kebijakan Privasi</a>
        </div>
    </div>
</footer>

</body>
</html>
