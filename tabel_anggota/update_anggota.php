<?php 
    // Koneksi database
    include '../koneksi.php';
   
    // Menangkap data yang dikirim dari form
    $kode_anggota = $_POST['kode_anggota'];
    $nama_anggota = $_POST['nama_anggota'];
    $kelas = $_POST['kelas'];

    // Update data ke database
    mysqli_query($koneksi, "UPDATE tabel_anggota SET nama_anggota='$nama_anggota', kelas='$kelas' WHERE kode_anggota='$kode_anggota'");

    // Update gambar profil 
    if ($_FILES["profil_anggota"]["error"] !== 4) {
        $fileName = $_FILES["profil_anggota"]["name"];
        $fileSize = $_FILES["profil_anggota"]["size"];
        $tmpName = $_FILES["profil_anggota"]["tmp_name"];

        // Proses mengupload gambar
        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (!in_array($imageExtension, $validImageExtension)) {
            echo "<script>alert('Ekstensi Gambar Harus jpg, jpeg, atau png!');";
            echo "location.replace('edit_anggota.php?id=$kode_anggota');";
            echo "</script>";
        } elseif ($fileSize > 1000000) {
            echo "<script>alert('Ukuran Gambar Terlalu Besar!');";
            echo "location.replace('edit_anggota.php?id=$kode_anggota');";
            echo "</script>";
        } else {
            // Unik ID untuk gambar
            $profil_anggota = uniqid() . '.' . $imageExtension;

            // Memindahkan file gambar ke folder img
            if (move_uploaded_file($tmpName, 'img/' . $profil_anggota)) {
                // Update data ke database
                mysqli_query($koneksi, "UPDATE tabel_anggota SET profil_anggota='$profil_anggota' WHERE kode_anggota='$kode_anggota'");
            }
        }
    }   else {
        // Jika tidak ada gambar yang diunggah, gunakan gambar default
        mysqli_query($koneksi, "UPDATE tabel_anggota SET profil_anggota='default' WHERE kode_anggota='$kode_anggota'");
            echo "<script>alert('Data Berhasil Disimpan!');";
            echo "location.replace('view_anggota.php');";
            echo "</script>";
    }

    // Mengalihkan halaman kembali ke view_anggota.php
    echo "<script>alert('Data Berhasil Disimpan!');";
    echo "location.replace('view_anggota.php');";
    echo "</script>";
?>
