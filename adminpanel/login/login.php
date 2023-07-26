<?php
require "../../koneksi.php"; // Mengimpor file koneksi yang diperlukan untuk menghubungkan ke database.
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Memuat berkas CSS eksternal untuk bootstrap dan login.css -->
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="login.css">
    <!-- Menambahkan link untuk font Google Inter dan Poppins yang akan digunakan di halaman ini -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

</head>


<body>
    <!-- Bagian utama untuk konten form login -->
    <div class="login-title">
        <img src="../../images/byteworks_2.svg" alt="logo">
        <p>
            Login
        </p>
    </div>
    <div class="main d-flex justify-content-center">
        <div class="login-box p-5 shadow">
            <!-- Form untuk login, mengarahkan action ke "post-login.php" menggunakan method POST -->
            <form action="post-login.php" method="post">
                <div>
                    <label for="username">Username</label>
                    <!-- Input untuk memasukkan username -->
                    <input type="text" class="form-control" name="username" id="username">
                </div>
                <div>
                    <label for="password">Password</label>
                    <!-- Input untuk memasukkan password -->
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <div>
                    <!-- Tombol untuk melakukan login -->
                    <button class="btn form-control mt-3" id="login-btn" type="submit" name="login">Login</button>
                </div>
                <div id="alert-container" class="mt-2">
                    <!-- Bagian untuk menampilkan pesan kesalahan dari GET parameter "message" -->
                    <?php
                    if (isset($_GET['message'])) {
                        $code = $_GET['message'];
                        switch ($code) {
                            case 'credential_error':
                                $message = 'Username atau password yang kamu gunakan salah';
                                break;
                            case 'user_not_found':
                                $message = 'User tidak ditemukan';
                                break;
                        }
                        if (isset($message)) {
                            // Menampilkan pesan kesalahan dalam bentuk kotak peringatan (alert)
                            echo "<div class='alert alert-danger' role='alert'>$message</div>";
                        }
                    }
                    ?>
                </div>
            </form>
        </div>
    </div>

    <!-- Memuat berkas JavaScript eksternal untuk login.js dan bootstrap.min.js -->
    <script src="login.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
