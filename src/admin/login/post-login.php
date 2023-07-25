<?php
//menggunakan berkas koneksi.php
require '../../../koneksi.php';

//mendapatkan data request
$username = $_POST['username'];
$password = $_POST['password'];
//memuat data login
$login_result = mysqli_query($conn, "select * from user where username = '$username'");
//menguji nilai kembalian query
if (mysqli_num_rows($login_result) > 0) {
    $row = $login_result->fetch_assoc();
    //menguji nilai credential yang digunakan
    if ($row['password'] == $password) {
        //menetapkan status login
        $_SESSION['username'] = $username;
        $_SESSION['status'] = 'login';
        //mengalihkan halaman
        header('location:../dashboard/index.php');
    } else {
        //mengalihkan halaman
        header('location:login.php?message=credential_error');
    }
} else {
    //mengalihkan halaman
    header('location:login.php?message=user_not_found');
}

//menutup koneksi
mysqli_close($conn);
