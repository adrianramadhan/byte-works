<?php
require "../../../koneksi.php";
require "../../component/navbar-admin.php";

$nama = htmlspecialchars($_GET['nama']);
$queryProduk = mysqli_query($conn, "SELECT * FROM produk WHERE nama='$nama'");
$produk = mysqli_fetch_array($queryProduk);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <link rel="stylesheet" href="../../../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../../../assets/css/style.css">
</head>

<body>
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <img src="../../../assets/images/<?php echo $produk['foto']; ?>" class="w-100">
                </div>
                <div class="col-md-6 offset-md-1 mt-3">
                    <h1><?php echo $produk['nama'] ?></h1>
                    <p class="fs-5">
                        <?php echo $produk['detail'] ?>
                    </p>
                    <p class="text-harga">
                        Rp <?php echo $produk['harga'] ?>
                    </p>
                    <p class="fs-5">
                        Status Ketersediaan : <strong><?php echo $produk['ketersediaan_stok'] ?></strong>
                    </p>
                </div>
            </div>
        </div>
    </div>


    <?php require "../../component/footer.php" ?>

    <script src="../../../assets/bootstrap/js/bootstrap.min.js">
    </script>
    <script src="../../../assets/fontawesome/js/all.min.js"></script>
</body>

</html>
