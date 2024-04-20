<?php 
    // Koneksi database
    include '../koneksi.php';
    
    // Menangkap data yang dikirim dari form
    $id_buku = $_GET['id'];

    $sql = $koneksi->query("SELECT * FROM tabel_buku WHERE id_buku='$id_buku'");

    $data = $sql->fetch_assoc();

    $sampul_buku = $data['sampul_buku'];
    if (file_exists("img/$sampul_buku")) {
        unlink("img/$sampul_buku");
    }
    // Menghapus data dari database
    mysqli_query($koneksi, "DELETE FROM tabel_buku WHERE id_buku='$id_buku'");

    // Mengalihkan halaman kembali ke view_buku.php
    echo "<script>alert('Data Berhasil Dihapus!');";
    echo "location.replace('view_buku.php');";
    echo "</script>";
?>
