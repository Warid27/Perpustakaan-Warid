<?php 
    // Cek apakah ini adalah akses langsung ke file koneksi.php
    if (basename($_SERVER['PHP_SELF']) == 'koneksi.php') {
        // Jika iya, tampilkan pesan alert
        echo "<script>alert('Akses langsung ke koneksi.php!');</script>";
    }

    $koneksi=mysqli_connect("localhost","root","","perpustakaan_warid");

    if ($koneksi) {
        // Tampilkan pesan alert jika koneksi berhasil
    } else {
        // Tampilkan pesan alert jika koneksi gagal
        echo "<script>alert('Koneksi Gagal!');</script>". mysqli_connect_error();
    }
?>
