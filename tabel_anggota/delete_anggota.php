<?php 
    // Koneksi database
    include '../koneksi.php';
    
    // Menangkap data yang dikirim dari form
    $kode_anggota = $_GET['id'];

    $sql = $koneksi->query("SELECT * FROM tabel_anggota WHERE kode_anggota='$kode_anggota'");

    $data = $sql->fetch_assoc();

    $profil_anggota = $data['profil_anggota'];
    if (file_exists("img/$profil_anggota")) {
        unlink("img/$profil_anggota");
    }
    // Menghapus data dari database
    mysqli_query($koneksi, "DELETE FROM tabel_anggota WHERE kode_anggota='$kode_anggota'");

    // Mengalihkan halaman kembali ke view_anggota.php
    echo "<script>alert('Data Berhasil Dihapus!');";
    echo "location.replace('view_anggota.php');";
    echo "</script>";
?>
