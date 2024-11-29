<?php include 'header.php'; ?>

<h1>Kontak Kami</h1>

<p>Jika Anda memiliki pertanyaan atau masalah, silakan hubungi kami melalui salah satu cara berikut:</p>

<h2>Email</h2>
<p>Anda dapat mengirim email ke kami di: <strong>support@tokoonlinek5.com</strong></p>

<h2>Alamat</h2>
<p>Jl. Raya Toko Online K5, No. 123, Kota Online</p>

<h2>Telepon</h2>
<p>+62 21 23456789</p>

<h2>Formulir Kontak</h2>
<form action="submit_contact.php" method="POST">
    <label for="name">Nama:</label><br>
    <input type="text" id="name" name="name" required><br><br>

    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br><br>

    <label for="message">Pesan:</label><br>
    <textarea id="message" name="message" required></textarea><br><br>

    <input type="submit" value="Kirim Pesan">
</form>

<?php include 'footer.php'; ?>
