<?php
    // Membuat koneksi ke server MySQL dengan host "localhost", username "root", password "" (tidak menggunakan password), dan memilih database "byte_works"
    $conn = mysqli_connect("localhost", "root", "", "byte_works");

    // Memeriksa apakah koneksi berhasil
    if (mysqli_connect_errno()) {
        // Jika koneksi gagal, tampilkan pesan error beserta informasi kesalahan menggunakan fungsi mysqli_connect_error()
        echo "Failed to connect to MySQL : " . mysqli_connect_error();
        // Menghentikan eksekusi script lebih lanjut dengan fungsi exit()
        exit();
    }
?>
