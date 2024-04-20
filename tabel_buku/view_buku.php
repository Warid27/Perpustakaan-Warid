<?php 
    // Koneksi database
    include "../koneksi.php"; 

    $data = mysqli_query($koneksi, "SELECT * FROM tabel_buku");
    $no = 1;
?>
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
        <div class="tambah"><a href="form_buku.php"><i class="fa-solid fa-square-plus"></i></a><span>TAMBAH BUKU</span></div>
    </div>
    <br>
    <br>
        <div class="card-container">
            <?php while ($buku = mysqli_fetch_array($data)) { ?>
                <div class="card">
                    <div class="card-kode_buku"><?php echo $buku['kode_buku']; ?></div>
                    <div class="card-sampul">
                        <?php if ($buku['sampul_buku'] == 'default') { ?>
                            <i class="fa-solid fa-book"></i>
                        <?php } else { ?>
                            <img src="img/<?php echo $buku['sampul_buku']; ?>">
                        <?php } ?>
                    </div>
                    <div class="card-deskripsi">
                        <div class="card-judul_buku"><?php echo $buku['judul_buku']; ?></div>
                        <div class="card-deskripsi-rinci">
                            <div class="cardDesk pengarang">
                                <div>Pengarang</div>
                                <div>:</div>
                                <div><?php echo $buku['pengarang']; ?></div>
                            </div>
                            <div class="cardDesk penerbit">
                                <div>Penerbit</div>
                                <div>:</div>
                                <div><?php echo $buku['penerbit']; ?></div>
                            </div>
                            <div class="cardDesk tahun_terbit">
                                <div>Tahun Terbit</div>
                                <div>:</div>
                                <div><?php echo $buku['tahun_terbit']; ?></div>
                                <input type="hidden" name="id" value="<?php echo $buku['id_buku'] ?>">
                            </div>
                        </div>
                        <div class="card-aksi">
                            <a href="edit_buku.php?id=<?php echo $buku['id_buku'] ?>"><i class="fa-solid fa-pen"></i></a>
                            <a href="delete_buku.php?id=<?php echo $buku['id_buku'] ?>"><i class="fa-solid fa-trash-can"></i></a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
</body>
</html>
