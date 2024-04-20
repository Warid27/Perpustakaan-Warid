<?php 
    // Koneksi database
    include '../koneksi.php';

    // Mendapatkan kode anggota terakhir
    $query_last_code = "SELECT * FROM `tabel_anggota` ORDER BY kode_anggota DESC LIMIT 1";
    $result_last_code = mysqli_query($koneksi, $query_last_code);

    if($result_last_code && mysqli_num_rows($result_last_code) > 0) {
        $last_anggota = mysqli_fetch_assoc($result_last_code);
        $last_kode_anggota = $last_anggota['kode_anggota'];
        // Membuat kode anggota baru (+1)
        $kode_anggota = 'KODE-A' . str_pad(substr($last_kode_anggota, 6) + 1, 5, '0', STR_PAD_LEFT);
    } else {
        // Jika tidak ada anggota sebelumnya, mulai dari awal
        $kode_anggota = 'KODE-A00001';
    }

    // Menangkap data yang dikirim dari form
    $nama_anggota = $_POST['nama_anggota'];
    $kelas = $_POST['kelas'];

    // Mengatur upload file gambar profil
    if ($_FILES["profil_anggota"]["error"] !== 4) {
        $fileName = $_FILES["profil_anggota"]["name"];
        $fileSize = $_FILES["profil_anggota"]["size"];
        $tmpName = $_FILES["profil_anggota"]["tmp_name"];

        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (!in_array($imageExtension, $validImageExtension)) {
            echo "<script>alert('Ekstensi Gambar Harus jpg, jpeg, atau png!');";
            echo "location.replace('form_anggota.php');";
            echo "</script>";
        } elseif ($fileSize > 1000000) {
            echo "<script>alert('Ukuran Gambar Terlalu Besar!');";
            echo "location.replace('form_anggota.php');";
            echo "</script>";
        } else {
            // Membuat nama unik untuk gambar
            $profil_anggota = uniqid() . '.' . $imageExtension;

            // Memindahkan file gambar ke folder img
            if (move_uploaded_file($tmpName, 'img/' . $profil_anggota)) {
                // Menginput data ke database
                $insert = "INSERT INTO `tabel_anggota`(`kode_anggota`, `nama_anggota`, `kelas`, `profil_anggota`) VALUES('$kode_anggota', '$nama_anggota', '$kelas', '$profil_anggota')";
                if (mysqli_query($koneksi, $insert)) {
                    // Redirect ke halaman view_anggota.php jika data berhasil disimpan
                    echo "<script>alert('Data Berhasil Disimpan!');";
                    echo "location.replace('view_anggota.php');";
                    echo "</script>";
                }
            }
        }
    } else {
        // Jika tidak ada gambar yang diunggah, gunakan gambar default
        $insert = "INSERT INTO `tabel_anggota`(`kode_anggota`, `nama_anggota`, `kelas`, `profil_anggota`) VALUES('$kode_anggota', '$nama_anggota', '$kelas', 'default')";
        if (mysqli_query($koneksi, $insert)) {
            echo "<script>alert('Data Berhasil Disimpan!');";
            echo "location.replace('view_anggota.php');";
            echo "</script>";
        }
    }
?>
