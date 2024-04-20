<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PERPUSTAKAAN SKANIDA</title>
    <link rel="icon" href="https://smkn2mgl.sch.id/media_library/images/4cf9743116d33ca628f4238601357f7f.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/style_buku.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">
</head>
<body>
<h1>DAFTAR BUKU</h1>
    <br>
    <div class="aksi-page">
        <a href="../index.php" class="home"><i class="fa-solid fa-home"></i></a>
        <div class="tambah"><a href="view_buku.php"><i class="fa-solid fa-hand-point-left"></i></a><span>KEMBALI</span></div>
    </div>
    <br>
    <br>

    <?php 
        include '../koneksi.php';
        
        // Get kode buku
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            
            // Ambil data buku
            $data = mysqli_query($koneksi,"SELECT * FROM tabel_buku WHERE id_buku='$id'");
            
            // Menemukan data sebelum form ditampilkan
            if(mysqli_num_rows($data) > 0) {
                $buku = mysqli_fetch_assoc($data);
    ?>
    
    <!-- Form untuk mengedit data buku -->
    <form action="update_buku.php" method="post" enctype="multipart/form-data">
        <table class="isiForm">
            <tr>
                <td colspan="3"><h3>EDIT DATA BUKU</h3></td>
            </tr>
            <tr>
                <td>KODE BUKU</td>
                <td>:</td>
                <td>
                    <input type="hidden" name="id" value="<?php echo $buku['id_buku'] ?>">
                    <input type="text" name="kode_buku" value="<?php echo $buku['kode_buku'] ?>">
                </td>
            </tr>                          
            <tr>
                <td>JUDUL BUKU</td>
                <td>:</td>
                <td><input type="text" name="judul_buku" value="<?php echo $buku['judul_buku'] ?>"></td>
            </tr>
            <tr>
                <td>PENGARANG</td>
                <td>:</td>
                <td><input type="text" name="pengarang" value="<?php echo $buku['pengarang'] ?>"></td>
            </tr>
            <tr>
                <td>PENERBIT</td>
                <td>:</td>
                <td><input type="text" name="penerbit" value="<?php echo $buku['penerbit'] ?>"></td>
            </tr>
            <tr>
                <td>TAHUN TERBIT</td>
                <td>:</td>
                <td><input type="date" name="tahun_terbit" value="<?php echo $buku['tahun_terbit'] ?>"></td>
            </tr>
            <tr>
                <td>SAMPUL BUKU</td>
                <td>:</td>
                <td>
                    <div class="fotoSampul">
                        <?php if ($buku['sampul_buku'] == 'default') { ?>
                            <i class="fa-solid fa-book"></i>
                        <?php } else { ?>
                            <img src="img/<?php echo $buku['sampul_buku']; ?>">
                        <?php } ?>
                    </div>
                    <input type="file" name="sampul_buku" accept=".jpg, .jpeg, .png" value="" id="uploadBtn">
                    <label for="uploadBtn"><i class="fa-solid fa-repeat"></i> Ubah Sampul</label>
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
                echo "Data buku tidak ditemukan.";
            }
        } else {
            echo "Kode buku tidak diberikan.";
        }
    ?>
</body>
</html>

