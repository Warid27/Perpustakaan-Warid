<?php 
    // Koneksi database
    include '../koneksi.php';

    // Menangkap data yang dikirim dari form
    $kode_buku = $_POST['kode_buku'];
    $judul_buku = $_POST['judul_buku'];
    $pengarang = $_POST['pengarang'];
    $penerbit = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];

    // Mengatur upload file gambar sampul buku
    if ($_FILES["sampul_buku"]["error"] !== 4) {
        $fileName = $_FILES["sampul_buku"]["name"];
        $fileSize = $_FILES["sampul_buku"]["size"];
        $tmpName = $_FILES["sampul_buku"]["tmp_name"];

        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (!in_array($imageExtension, $validImageExtension)) {
            echo "<script>alert('Ekstensi Gambar Harus jpg, jpeg, atau png!');";
            echo "location.replace('form_buku.php');";
            echo "</script>";
        } elseif ($fileSize > 1000000) {
            echo "<script>alert('Ukuran Gambar Terlalu Besar!');";
            echo "location.replace('form_buku.php');";
            echo "</script>";
        } else {
            // Membuat nama unik untuk gambar
            $sampul_buku = uniqid() . '.' . $imageExtension;

            // Memindahkan file gambar ke folder img
            if (move_uploaded_file($tmpName, 'img/' . $sampul_buku)) {
                // Menginput data ke database
                $insert = "INSERT INTO `tabel_buku`(`id_buku`, `kode_buku`, `judul_buku`, `pengarang`, `penerbit`, `tahun_terbit`, `sampul_buku`) VALUES('', '$kode_buku', '$judul_buku', '$pengarang', '$penerbit', '$tahun_terbit', '$sampul_buku')";
                if (mysqli_query($koneksi, $insert)) {
                    // Redirect ke halaman view_buku.php jika data berhasil disimpan
                    echo "<script>alert('Data Berhasil Disimpan!');";
                    echo "location.replace('view_buku.php');";
                    echo "</script>";
                }
            }
        }
    } else {
        // Jika tidak ada gambar yang diunggah, gunakan gambar default
        $insert = "INSERT INTO `tabel_buku`(`id_buku`, `kode_buku`, `judul_buku`, `pengarang`, `penerbit`, `tahun_terbit`, `sampul_buku`) VALUES('', '$kode_buku', '$judul_buku', '$pengarang', '$penerbit', '$tahun_terbit', 'default')";
        if (mysqli_query($koneksi, $insert)) {
            echo "<script>alert('Data Berhasil Disimpan!');";
            echo "location.replace('view_buku.php');";
            echo "</script>";
        }
    }
?>
