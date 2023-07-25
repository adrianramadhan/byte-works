<!-- Navbar Section -->
<nav class="navbar navbar-expand-lg navbar-dark custom-navbar">

    <!-- Style CSS Internal -->
    <style>
    /*Pewarnaan  navbar*/
    .custom-navbar {
        background-color: #1E293B;
    }

    /* responsive navbar */
    .navbar-collapse {
        display: flex;
        justify-content: flex-end;
    }

    /*jarak dari garis tepi elemen  */
    .navbar-nav {
        margin-right: 20px;
    }

    /*efek hover pada link*/
    .navbar-nav .nav-item .nav-link {
        position: relative;
        transition: color 0.3s;
        /* Efek transisi saat hover */
    }

    .navbar-nav .nav-item .nav-link::before {
        content: "";
        position: absolute;
        bottom: -2px;

        /* Posisi garis di bawah link */
        left: 0;
        width: 100%;
        height: 2px;

        /* Lebar garis */
        background-color: #fff;

        /* Warna garis */
        transform: scaleX(0);

        /* Efek transisi saat hover */
        transition: transform 0.3s;
    }

    /* Warna teks saat hover */
    .navbar-nav .nav-item .nav-link:hover {
        color: #fff;
    }

    .navbar-nav .nav-item .nav-link:hover::before {
        transform: scaleX(1);
        /* Mengatur lebar garis menjadi 1 saat hover */
    }

    /* Menambahkan gambar logo di sebelah kiri */
    .navbar-brand img {
        width: 120px;
        /* Sesuaikan ukuran logo sesuai kebutuhan */
        height: 40px;
        margin-right: 10px;
        /* Jarak antara logo dan teks */
    }
    </style>

    <!-- Start: Container -->
    <div class="container">
        <!-- Navbar Brand: Logo -->
        <a class="navbar-brand" href="#">
            <img src="../../../assets/images/byteworks 1.png" alt="Logo">
        </a>

        <!-- Navbar Toggler: Button to toggle the navbar collapse -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Collapse: Contains the actual navigation links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Unordered List to hold the navigation links -->
            <ul class="navbar-nav">
                <!-- Navigation Link: Home -->
                <li class="nav-item me-3">
                    <a class="nav-link text-white" href="../dashboard/index.php"><b>Home</b></a>
                </li>

                <!-- Navigation Link: Produk -->
                <li class="nav-item me-3">
                    <a class="nav-link text-white" href="../client/product/produk.php"><b>Produk</b></a>
                </li>

                <!-- Navigation Link: Tentang Kami -->
                <li class="nav-item me-3">
                    <a class="nav-link text-white" href="../../about.php"><b>Tentang Kami</b></a>
                </li>

                <!-- Navigation Link: Logout -->
                <li class="nav-item me-3">
                    <a class="nav-link text-white" href="../../index.php" id="logoutLink"><b>Logout</b></a>
                </li>
            </ul>
        </div>
    </div>
    <!-- End: Container -->

    </div>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Mengambil referensi elemen tautan Logout
        const logoutLink = document.getElementById("logoutLink");

        // Menambahkan event listener untuk menangani klik pada tautan Logout
        logoutLink.addEventListener("click", function(event) {
            // Menghentikan aksi default dari tautan
            event.preventDefault();

            // Menampilkan konfirmasi alert sebelum benar-benar mengarahkan ke halaman logout
            const confirmLogout = confirm("Apakah Anda yakin ingin keluar?");

            // Jika pengguna mengklik "OK" pada pesan konfirmasi, maka arahkan ke halaman logout
            if (confirmLogout) {
                window.location.href = logoutLink.href;
            }
        });
    });
    </script>

</nav>
