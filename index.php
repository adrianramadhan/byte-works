<?php
// Memanggil file koneksi.php yang berisi script untuk melakukan koneksi ke database
require "koneksi.php";
// Memanggil file navbar.php yang berisi script untuk menampilkan navbar pada halaman
require "component/navbar.php";
// Mengambil data produk dari tabel produk dengan batasan 6 baris
$queryProduk = mysqli_query($conn, "SELECT id, nama, harga, foto, detail FROM produk LIMIT 6");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Byte Works | Home</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
</head>

<body>
    <!-- Banner/Hero Section -->
    <div class="container-fluid banner d-flex align-items-center" id="home">
        <div class="container text-center text-white">
            <h1 class="custom-text1"><b>Your Future Device</b></h1>
            <!-- Inline CSS: Styling untuk elemen dalam halaman -->
            <style>
            .custom-text1 {
                font-size: 50px;
            }

            .banner {
                height: 90vh;
                background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('images/background.jpg');
                background-size: cover;
                background-position: center;
                position: relative;
                top: 0;
            }

            .kategori-VGA {
                background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('images/VGA.png');
                background-size: cover;
                background-position: center;
                cursor: pointer;
            }

            .kategori-CPU {
                background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('images/CPU.png');
                background-size: cover;
                background-position: center;
                cursor: pointer;
            }

            .kategori-keyboard {
                background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('images/keyboard.png');
                background-size: cover;
                background-position: center;
                cursor: pointer;
            }
            </style>
            <h4>Good Device, Good Experience For Your Explore</h4>
            <div class="col-md-8 offset-md-2">
                <!-- Form pencarian produk berdasarkan keyword -->
                <form action="produk.php" method="get">
                    <div class="input-group input-group-lg my-4">
                        <input type="text" class="form-control" placeholder="Cari Barang Kebutuhanmu"
                            aria-label="Recipient's username" aria-describedby="basic-addon2" name="keyword"
                            autocomplete="off">
                        <button style="background-color: #1E293B;" class="btn text-white">Telusuri</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- kategori -->
    <div class="container-fluid py-5">
        <div class="container text-center">
            <h3><b>Kategori Terlaris</b></h3>
        </div>

        <div class="row mt-5">
            <div class="col-md-4 mb-4">
                <a href="produk.php?kategori=VGA" class="no-decoration">
                    <div class="highlighted-kategori kategori-VGA d-flex justify-content-center align-items-center">
                        <h4>VGA</h4>
                    </div>
                </a>

            </div>
            <div class="col-md-4 mb-4">
                <a href="produk.php?kategori=CPU" class="no-decoration">
                    <div class="highlighted-kategori kategori-CPU d-flex justify-content-center align-items-center">
                        <h4>CPU</h4>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="produk.php?kategori=keyboard" class="no-decoration">
                    <div
                        class="highlighted-kategori kategori-keyboard d-flex justify-content-center align-items-center">
                        <h4>Keyboard</h4>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Tentang Kami -->
    <h3 class="mt-3" align="center" id="about"><b>Tentang Kami</b></h3>
    <br>
    <div class="container-fluid warna-3 py-5">
        <div class="container text-center">
            <p class="text">
                <!-- HTML -->
                <b>
                    <span class="custom-text">Byte Works</span>
                </b>

                <!-- CSS -->
                <style>
                .custom-text {
                    font-weight: bold;
                    color: #598EF3;
                    font-size: 20px;
                }

                .text {
                    color: #ffff;
                }

                .mt-3 {
                    color: #000;
                }

                .warna-3 {
                    color: #1E293B;
                }

                .container-fluid.warna-3 {
                    background-color: #1E293B;
                }
                </style>
                adalah platform belanja online yang menawarkan beragam perangkat elektronik dan gadget.
                Disini,pelanggan dapat dengan mudah mencari dan membeli berbagai perangkat,
                seperti smartphone,laptop,tablet,kamera,dan aksesori lainnya. Selain menyediakan produk berkualitas dari
                merek-merek terkenal, kami juga menawarkan layanan pelanggan yang responsif dan pengiriman yang cepat.
                Mari bergabung bersama kami, Byterian !

            </p>
        </div>
    </div>

    <!-- < !-- Produk -->
    <div class="container-fluid py-5" id="produk">
        <div class="container text-center">
            <h3><b>Produk</b></h3>
            <div class="row mt-5"><?php while ($data=mysqli_fetch_array($queryProduk)) {
                        ?><div class="col-sm-6 col-md-4 mb-4">
                    <div class="card"><img style="object-fit: cover; object-position: center;" height="200px"
                            src="images/<?php echo $data['foto']; ?>" class="card-img-top" alt="">
                        <div class="card-body">
                            <h4 class="card-title"><?php echo $data['nama'] ?></h5>
                                <p class="card-text text-truncate"><?php echo $data['detail'] ?></p>
                                <p class="card-text text-center text-harga">Rp <?php echo $data['harga'] ?></p><a
                                    style="background-color:#1E293B;"
                                    href="produk-detail.php?nama=<?php echo $data['nama'] ?>"
                                    class="btn text-white">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                <?php
                    }
                ?>
            </div><a class="btn btn-outline-warning mt-3 p-2" href="produk.php">See More</a>
        </div>
    </div>

    <!-- < !-- Footer -->
    <?php require "component/footer.php"?><script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>

</html>
