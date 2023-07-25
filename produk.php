<?php
require './koneksi.php';
require "adminpanel/component/navbar.php";

$queryKategori = mysqli_query($conn, "SELECT * FROM kategori");

// Get produk by nama produk/keyword
if (isset($_GET['keyword'])) {
    $queryProduk = mysqli_query($conn, "SELECT * FROM produk WHERE nama LIKE '%$_GET[keyword]%'");
}
// Get produk by kategori
else if (isset($_GET['kategori'])) {
    $queryGetKategoriId = mysqli_query($conn, "SELECT id FROM kategori WHERE nama='$_GET[kategori]'");
    $kategoriId = mysqli_fetch_array($queryGetKategoriId);

    $queryProduk = mysqli_query($conn, "SELECT * FROM produk WHERE kategori_id='$kategoriId[id]'");
}
// Get produk default
else {
    $queryProduk = mysqli_query($conn, "SELECT * FROM produk");
}

$countData = mysqli_num_rows($queryProduk);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- banner -->
    <div class="container-fluid banner-produk d-flex align-items-center">
        <div class="container">
            <h1 class="text-white text-center"><b>Produk</b></h1>
        </div>
    </div>

    <!-- body -->
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-3 mb-5">
                <h3><b>Kategori</b></h3>
                <ul class="list-group">
                    <?php while ($kategori = mysqli_fetch_array($queryKategori)) {
                    ?>
                    <a style="text-decoration: none;" href="produk.php?kategori=<?php echo $kategori['nama'] ?>">
                        <li class="list-group-item"><?php echo $kategori['nama']; ?></li>
                    </a>
                    <?php
                    } ?>
                </ul>
            </div>
            <div class="col-lg-9">
                <h3 class="text-center mb-3"><b>Produk</b></h3>
                <div class="row">
                    <?php
                    if ($countData < 1) {
                    ?>
                    <h4 class="text-center py-5">Produk yang anda cari tidak ditemukan</h4>
                    <?php
                    }
                    ?>
                    <?php
                    while ($produk = mysqli_fetch_array($queryProduk)) {
                    ?>
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="card h-100">
                            <img style="object-fit: cover; object-position: center;" height="200px"
                                src="images/<?php echo $produk['foto'] ?>" class="card-img-top" alt="">
                            <div class="card-body">
                                <h4 class="card-title"><?php echo $produk['nama'] ?></h5>
                                    <p class="card-text text-truncate"><?php echo $produk['detail'] ?></p>
                                    <p class="card-text text-harga">Rp <?php echo $produk['harga'] ?></p>
                                    <a style="background-color: #CA965C;"
                                        href="produk-detail.php?nama=<?php echo $produk['nama'] ?>"
                                        class="btn text-white">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php require "./component/footer.php" ?>

    <script src=" bootstrap/js/bootstrap.min.js">
    </script>
    <script src="fontawesome/js/all.min.js"></script>
</body>

</html>
