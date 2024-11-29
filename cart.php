<?php
session_start();

// Menambahkan barang ke keranjang
if (isset($_GET['add_to_cart'])) {
    $product_id = $_GET['add_to_cart'];
    $product = [
        'id' => $product_id,
        'name' => "Produk " . $product_id, // Ganti dengan nama produk yang sesuai
        'price' => 1000000 * $product_id, // Ganti dengan harga yang sesuai
    ];
    
    // Tambahkan produk ke keranjang
    $_SESSION['cart'][] = $product;
    header("Location: cart.php");
    exit();
}

// Menghapus produk dari keranjang
if (isset($_GET['remove_from_cart'])) {
    $product_id = $_GET['remove_from_cart'];
    unset($_SESSION['cart'][$product_id]); // Menghapus produk berdasarkan index
    $_SESSION['cart'] = array_values($_SESSION['cart']); // Menyusun ulang array
    header("Location: cart.php");
    exit();
}

// Mengedit jumlah produk di keranjang
if (isset($_POST['update_cart'])) {
    foreach ($_POST['quantity'] as $index => $quantity) {
        $_SESSION['cart'][$index]['quantity'] = $quantity; // Update jumlah produk
    }
    header("Location: cart.php");
    exit();
}

// Mengecek apakah ada barang di keranjang
if (!isset($_SESSION['cart']) || count($_SESSION['cart']) === 0) {
    echo "<p>Keranjang belanja Anda kosong.</p>";
    exit();
}

// Menghitung total harga dan mempersiapkan isi pesan
$total = 0;
$cart_items = "";
foreach ($_SESSION['cart'] as $index => $product) {
    $product_total = $product['price'] * (isset($product['quantity']) ? $product['quantity'] : 1); // Jika ada quantity, hitung totalnya
    $cart_items .= $product['name'] . " - Rp " . number_format($product_total, 0, ',', '.') . "\n";
    $total += $product_total;
}

// Pesan yang akan dikirim ke WhatsApp
$message = "Saya ingin membeli produk berikut:\n" . $cart_items . "\nTotal Pembelian: Rp " . number_format($total, 0, ',', '.') . "\n\nMohon konfirmasi.";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Header dengan Logo di Kiri dan Navbar -->
<header>
    <div class="logo-container">
        <!-- Logo Anda di Kiri -->
        <img src="img/logo.jpg" alt="Logo Kelompok5" class="logo" id="logo-anda">
        <!-- Logo Kampus di Kanan -->
        <img src="img/logo kampus.jpg" alt="Logo Kampus" class="logo" id="logo-kampus">
    </div>


</header>

        <nav class="navbar">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="profile.php">Profil</a></li>
                <li><a href="cart.php" class="cart-icon"><i class="fas fa-shopping-cart"></i></a></li>
            </ul>
        </nav>
    <h1>Keranjang Belanja Anda</h1>

    <form method="POST" action="cart.php">
        <table>
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['cart'] as $index => $product): ?>
                    <tr class="product-item">
                        <td><?= $product['name'] ?></td>
                        <td>Rp <?= number_format($product['price'], 0, ',', '.') ?></td>
                        <td>
                            <input type="number" name="quantity[<?= $index ?>]" value="<?= isset($product['quantity']) ? $product['quantity'] : 1 ?>" min="1">
                        </td>
                        <td>
                            <a href="cart.php?remove_from_cart=<?= $index ?>" class="remove">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <button type="submit" name="update_cart" class="update-cart">Perbarui Keranjang</button>
    </form>

    <p>Total: Rp <?= number_format($total, 0, ',', '.') ?></p>

    <!-- Link untuk checkout via WhatsApp dengan pesan dinamis -->
    <a href="https://wa.me/+6281280760582?text=<?= urlencode($message) ?>" class="checkout">Beli via WhatsApp</a>

</body>
</html>
