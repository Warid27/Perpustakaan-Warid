<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PERPUSTAKAAN SKANIDA</title>
    <link rel="icon" href="https://smkn2mgl.sch.id/media_library/images/4cf9743116d33ca628f4238601357f7f.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/style_anggota.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">
</head>
<body>
<h1>DAFTAR ANGGOTA</h1>
    <br>
    <div class="aksi-page">
        <a href="../index.php" class="home"><i class="fa-solid fa-home"></i></a>
        <div class="tambah"><a href="view_anggota.php"><i class="fa-solid fa-hand-point-left"></i></a><span>KEMBALI</span></div>
    </div>
    <br>
    <br>

    <?php 
        include '../koneksi.php';
        
        // Get kode anggota
        if(isset($_GET['id'])) {
            $kode_anggota = $_GET['id'];
            
            // Ambil data anggota
            $data = mysqli_query($koneksi,"SELECT * FROM tabel_anggota WHERE kode_anggota='$kode_anggota'");
            
            // Menemukan data sebelum form ditampilkan
            if(mysqli_num_rows($data) > 0) {
                $anggota = mysqli_fetch_assoc($data);
    ?>
    
    <!-- Form untuk mengedit data anggota -->
    <form action="update_anggota.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="kode_anggota" value="<?php echo $anggota['kode_anggota'] ?>">
        <table class="isiForm">
            <tr>
                <td colspan="3"><h3>EDIT DATA ANGGOTA</h3></td>
            </tr>
            <tr>
                <td>Kode Anggota</td>
                <td>:</td>
                <td>
                    <input type="text" name="kode_anggota" value="<?php echo $anggota['kode_anggota'] ?>" readonly>
                </td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>
                    <input type="text" name="nama_anggota" value="<?php echo $anggota['nama_anggota'] ?>">
                </td>
            </tr>
            <tr>
                <td>Kelas</td>
                <td>:</td>
                <td>
                    <input type="text" name="kelas" value="<?php echo $anggota['kelas'] ?>">
                </td>
            </tr>
            <tr>
                <td>Gambar Profil</td>
                <td>:</td>
                <td>
                <div class="fotoProfil">
                        <?php if ($anggota['profil_anggota'] == 'default') { ?>
                            <i class="fa-solid fa-user"></i>
                        <?php } else { ?>
                            <img src="img/<?php echo $anggota['profil_anggota']; ?>">
                        <?php } ?>
                    </div>
                    <input type="file" name="profil_anggota" accept=".jpg, .jpeg, .png" value="" id="uploadBtn">
                    <label for="uploadBtn"><i class="fa-solid fa-repeat"></i> Ubah Foto</label>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><input type="submit" value="SIMPAN"></td>
            </tr>
        </table>
    </form>

    <?php
            } else {
                echo "Data anggota tidak ditemukan.";
            }
        } else {
            echo "Kode anggota tidak diberikan.";
        }
    ?>
</body>
</html>
