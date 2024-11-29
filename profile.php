<?php
// Daftar anggota kelompok
$team_members = [
    ['name' => 'Anggota 1', 'role' => 'Front-end Developer', 'image' => 'img/anggota1.jpg'],
    ['name' => 'Anggota 2', 'role' => 'Back-end Developer', 'image' => 'img/anggota2.jpg'],
    ['name' => 'Anggota 3', 'role' => 'UI/UX Designer', 'image' => 'img/anggota3.jpg'],
    ['name' => 'Anggota 4', 'role' => 'Project Manager', 'image' => 'img/anggota4.jpg'],
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Kelompok</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <!-- Navbar yang sama seperti di halaman lainnya -->
    <header>
        <div class="logo-container">
            <img src="img/logo.jpg" alt="Logo Kelompok5" class="logo" id="logo-anda">
            <img src="img/logo kampus.jpg" alt="Logo Kampus" class="logo" id="logo-kampus">
        </div>


    </header>
    <nav class="navbar">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="profile.php">Profil</a></li>
            <!-- <li><a href="cart.php" class="cart-icon"><i class="fas fa-shopping-cart"></i></a></li> -->
        </ul>
    </nav>
    <h1 style="text-align:center; margin-top: 20px;">Profil Kelompok</h1>

    <div class="team-members">
        <?php foreach ($team_members as $member): ?>
            <div class="team-member">
                <img src="<?= $member['image'] ?>" alt="<?= $member['name'] ?>" class="team-photo">
                <h2><?= $member['name'] ?></h2>
                <p>Role: <?= $member['role'] ?></p>
            </div>
        <?php endforeach; ?>
    </div>

</body>
</html>
