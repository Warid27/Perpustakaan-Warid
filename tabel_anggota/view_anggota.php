<?php 
    // Koneksi database
    include "../koneksi.php"; 

    $data = mysqli_query($koneksi, "SELECT * FROM tabel_anggota");
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
        <div class="tambah"><a href="form_anggota.php"><i class="fa-solid fa-square-plus"></i></a><span>TAMBAH ANGGOTA</span></div>
    </div>
    <br>
    <br>
        <div class="card-container">
            <?php while ($anggota = mysqli_fetch_array($data)) { ?>
                <div class="card">
                    <div class="card-kode_anggota"><?php echo $anggota['kode_anggota']; ?></div>
                    <div class="card-profil">
                        <?php if ($anggota['profil_anggota'] == 'default') { ?>
                            <i class="fa-solid fa-user"></i>
                        <?php } else { ?>
                            <img src="img/<?php echo $anggota['profil_anggota']; ?>">
                        <?php } ?>
                    </div>
                    <div class="card-deskripsi">
                        <div class="card-nama_anggota"><?php echo $anggota['nama_anggota']; ?></div>
                        <div class="card-kelas"><?php echo $anggota['kelas']; ?></div>
                        <div class="card-aksi">
                            <a href="edit_anggota.php?id=<?php echo $anggota['kode_anggota'] ?>"><i class="fa-solid fa-pen"></i></a>
                            <a href="delete_anggota.php?id=<?php echo $anggota['kode_anggota'] ?>"><i class="fa-solid fa-trash-can"></i></a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
</body>
</html>
