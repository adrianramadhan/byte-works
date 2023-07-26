<?php
// Memuat file koneksi.php untuk menghubungkan ke database
require "../koneksi.php";
// Memuat file navbar.php yang berisi navigasi
require "component/navbar.php";

// Mengambil data kategori dari tabel kategori dengan menggunakan query SQL
$queryKategori = mysqli_query($conn, "SELECT * FROM kategori");
// Menghitung jumlah kategori dengan menggunakan fungsi mysqli_num_rows()
$jumlahKategori = mysqli_num_rows($queryKategori);

// Mengambil data produk dari tabel produk dengan menggunakan query SQL
$queryProduk = mysqli_query($conn, "SELECT * FROM produk");
// Menghitung jumlah produk dengan menggunakan fungsi mysqli_num_rows()
$jumlahProduk = mysqli_num_rows($queryProduk);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    // Berbagai meta dan link untuk konfigurasi halaman
    <!-- Mendefinisikan charset dokumen sebagai UTF-8 untuk dukungan karakter yang luas -->
    <meta charset="UTF-8">
    <!-- Mendefinisikan viewport untuk mengatur tampilan pada perangkat berbeda -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Judul halaman yang akan ditampilkan pada tab browser -->
    <title>Admin Dashboard</title>
    <!-- Memuat file CSS Bootstrap untuk mengatur tampilan dasar halaman -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Memuat file CSS Font Awesome untuk ikon dan simbol -->
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <!-- Preconnect ke Google Fonts untuk mengoptimalkan pemuatan font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Memuat beberapa font dari Google Fonts untuk digunakan pada halaman -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

</head>

<style>
    /* Berbagai gaya tampilan menggunakan CSS dan Bootstrap */
    /* Gaya untuk elemen dengan class "summary-kategori" */
    .summary-kategori {
        background-color: #0a6b4a; /* Warna latar belakang */
        border-radius: 12px; /* Membuat sudut elemen menjadi melengkung */
    }

    /* Gaya untuk elemen dengan class "summary-produk" */
    .summary-produk {
        background-color: #0a516b; /* Warna latar belakang */
        border-radius: 12px; /* Membuat sudut elemen menjadi melengkung */
    }

    /* Gaya untuk elemen dengan class "export-pdf-btn" */
    .export-pdf-btn {
    position: absolute; /* Menetapkan posisi absolut */
    top: 110px; /* Jarak dari atas ke elemen */
    right: 20px; /* Jarak dari kanan ke elemen */
    z-index: 9999; /* Mengatur lapisan tampilan, semakin besar nilainya semakin tinggi */
}
</style>

<body>
    <!-- Memuat navbar untuk tampilan dashboard admin -->
    <?php
    require "./component/navbar.php"
    ?>

    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="fas fa-home"></i> Home
                </li>
            </ol>
        </nav>

        <!-- button export to pdf -->
        <a href="#" class="btn btn-primary export-pdf-btn">
            <i class="fas fa-file-pdf"></i> Export to PDF</a>

        <!-- section dashboard admin -->
        <h3><b>Dasboard Admin</b></h3>
        <div class="container mt-5">
            <div class="row">
                <!-- Summary informasi kategori -->
                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="summary-kategori p-4">
                        <div class="row">
                            <div class="col-6">
                                <i class="fas fa-align-justify fa-7x text-black-50"></i>
                            </div>
                            <div class="col-6 text-white">
                                <h3 class="fs-2">Kategori</h3>
                                <p class="fs-4"><?php echo $jumlahKategori ?> Kategori</p>
                                <p><a href="./kategori/kategori.php" class="text-white">Lihat Detail</a></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Summary informasi produk -->
                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="summary-produk p-4">
                        <div class="row">
                            <div class="col-6">
                                <i class="fas fa-box fa-7x text-black-50"></i>
                            </div>
                            <div class="col-6 text-white">
                                <h3 class="fs-2">Produk</h3>
                                <p class="fs-4"><?php echo $jumlahProduk ?> Produk</p>
                                <p><a href="./produk/produk.php" class="text-white">Lihat Detail</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Skrip untuk mengatur tampilan dengan Bootstrap dan Font Awesome -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>

</html>
