<?php
require "../../koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="login/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

</head>


<body>

    <div class="login-title">
        <img src="../../assets/images/byteworks_2.svg" alt="logo">
        <p>
            Login
        </p>
    </div>
    <div class="main d-flex justify-content-center">
        <div class="login-box p-5 shadow">
            <form action="./login/post-login.php" method="post">
                <div>
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" id="username">
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <div>
                    <button class="btn form-control mt-3" id="login-btn" type="submit" name="login">Login</button>
                </div>
                <div id="alert-container" class="mt-2">
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
                            echo "<div class='alert alert-danger' role='alert'>$message</div>";
                        }
                    }
                    ?>
                </div>
            </form>
        </div>
    </div>


    <script src="login/login.js"></script>
    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>