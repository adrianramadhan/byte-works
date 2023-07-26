<?php
// File koneksi ke database
require "koneksi.php";

// Mengambil parameter 'nama' dari URL dan membersihkan input dari karakter khusus
$nama = htmlspecialchars($_GET['nama']);
// Query SQL untuk mengambil detail produk dengan nama yang telah ditentukan dari tabel "produk"
$queryProduk = mysqli_query($conn, "SELECT * FROM produk WHERE nama='$nama'");
// Mengambil hasil query dan menyimpannya ke variabel $produk sebagai array asosiatif
$produk = mysqli_fetch_array($queryProduk);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <!-- Memuat stylesheet dari Bootstrap -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Memuat stylesheet dari Font Awesome -->
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <!-- Memuat stylesheet khusus untuk halaman ini -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <!-- Menampilkan gambar produk -->
                    <img src="images/<?php echo $produk['foto']; ?>" class="w-100">
                </div>
                <div class="col-md-6 offset-md-1 mt-3">
                    <h2><b><?php echo $produk['nama'] ?></b></h2>
                    <!-- Menampilkan detail produk -->
                    <p class="fs-5">
                        <?php echo $produk['detail'] ?>
                    </p>
                    <!-- Menampilkan harga produk -->
                    <p class="text-harga">
                        Rp <?php echo $produk['harga'] ?>
                    </p>
                    <p class="fs-5">
                        <!-- Menampilkan status ketersediaan produk -->
                        Status Ketersediaan : <strong><?php echo $produk['ketersediaan_stok'] ?></strong>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Memuat footer dari komponen "footer.php" -->
    <?php require "component/footer.php" ?>

    <!-- Memuat script dari Bootstrap dan Font Awesome -->
    <script src=" bootstrap/js/bootstrap.min.js">
    </script>
    <script src="fontawesome/js/all.min.js"></script>
</body>

</html>
