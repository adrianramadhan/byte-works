<nav class="navbar navbar-expand-lg navbar-dark custom-navbar">
    <style>
    .custom-navbar {
        background-color: #1E293B;
    }

    .navbar-collapse {
        display: flex;
        justify-content: flex-end;
    }

    .navbar-nav {
        margin-right: 20px;
    }

    /* Efek hover pada link */
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
        /* Mengatur lebar garis menjadi 0 pada awalnya */
        transition: transform 0.3s;
        /* Efek transisi saat hover */
    }

    .navbar-nav .nav-item .nav-link:hover {
        color: #fff;
        /* Warna teks saat hover */
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

    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="images/byteworks 1.png" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item me-3">
                    <a href="#home" class="nav-link text-white" class="nav-link scrollto"><span><b>Home</b></span></a>
                </li>
                <li class="nav-item me-3">
                    <a href="#about" class="nav-link text-white" class="nav-link scrollto">
                        <span><b>Tentang Kami</b></span>
                    </a>
                </li>
                <li class=" nav-item me-3">
                    <a href="#produk" class="nav-link text-white" class="nav-link scrollto">
                        <span><b>Produk</b></span>
                    </a>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link text-white" href="../../adminpanel/login/login.php"><b>Login</b></a>
                </li>
            </ul>
        </div>
    </div>
</nav>
