<?php
session_start();
require 'functions.php';

if ( isset($_COOKIE["id"]) && isset($_COOKIE["ku"]) ) {
    $id = $_COOKIE["id"];
    $ku = $_COOKIE["ku"];

    $result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    if ( $ku === hash('gost', $row["username"]) ) {
        $_SESSION["login"] = true;
    }

}

if ( isset($_SESSION["login"]) ) {
    header('Location: ../index.php');
    exit;
}

if ( isset($_POST["login"]) ) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

    if ( mysqli_num_rows($result) === 1 ) {
        $row = mysqli_fetch_assoc($result);

        if ( password_verify($password, $row["password"]) ) {
            $_SESSION["login"] = true;

        if ( isset($_POST["remember"]) ) {
            setcookie('id', $row["id"], time() + 60 * 10);
            setcookie('ku', hash('gost', $row["username"]), time() + 60 * 10);
        }

            header('Location: ../index.php');
            exit;
        }
    }
    $error = true;
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk | RS Marsudirini</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <nav class="navbar navbar-light border-bottom">
        <div class="container-xl">
            <a href="../index.php" class="navbar-brand align-items-center ">
                <img src="../img/rs/RS Logo.png" style="width:50px;height:50px">
                <h5 class="d-inline">Rumah Sakit Marsudirini</h5>
            </a>
            <div class="navbar-item align-items-center d-none d-md-inline">
                <i class="bi bi-telephone-fill me-1"></i>
                <span class="fs-5" >(021) 123 4567</span>
            </div>
    </nav>

    <section class="login" style="margin:80px 0 100px 0">
        <div class="container-lg">
            <div class="row justify-content-center mb-5 g-3">
                <div class="col-10 col-md-5 justify-items-start">
                    <h2 class="mb-4" style="margin-top:-10px">Halaman Masuk</h2>

                    <?php if ( isset($error) ) : ?>
                        <p style="color:red; font-style:italic; font-size:15px;">username / password salah!</p>
                    <?php endif; ?>

                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" id="username" required autofocus autocomplete="off" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" required class="form-control"> 
                        </div>
                        <div class="mb-3" class="form-check">
                            <input type="checkbox" name="remember" id="remember" class="form-check-input">
                            <label for="remember" class="form-check-label">Remember</label>
                        </div>  
                        <button type="submit" name="login" class="btn btn-outline-secondary mb-3">Masuk</button>
                        <p class="mb-5">Belum punya akun?<a href="registrasi.php"> Daftar</a></p>
                    </form>
                </div>

                <div class="col-md-5 d-none d-md-block image">
                    <div id="mycarousel" class="carousel slide" data-bs-ride="carousel" data-bs-pause="false" data-bs-touch="false">
                        <div class="carousel-inner rounded">
                            <div class="carousel-item active" >
                                <img src="../img/rs/gedung rs.jpg" class="d-block w-100">
                            </div>
                            <div class="carousel-item">
                                <img src="../img/rs/emergency.jpg" class="d-block w-100">
                            </div>
                            <div class="carousel-item">
                                <img src="../img/rs/ruangan rs.png" class="d-block w-100">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="pt-4 border-top bg-light">
        <div class="container-xl">
            <div class="row justify-content-center">
                <div class="col-auto pb-2">
                    <img src="../img/rs/RS Logo.png" style="width:50px;height:50px">
                    <h5 class="d-inline">Rumah Sakit Marsudirini</h5>
                </div>
            </div>
            <div class="row" style="margin: 30px 30px 50px 30px">
                <div class="col-5 col-md-3">
                    <a href="#" class="text-decoration-none d-block">
                        <i class="bi bi-meta text-primary"></i>
                        <span class="meta">Meta</span>
                    </a>
                    <a href="#" class="text-decoration-none text-bla d-block">
                        <i class="bi bi-instagram"></i>
                        <span class="insta">Instagram</span>
                    </a>
                    <a href="#" class="text-decoration-none text-danger">
                        <i class="bi bi-youtube"></i>
                        <span class="yt">Youtube</span>
                    </a>
                </div>
                <div class="col-5 col-md-3">
                    <a href="#" class="d-block">Tentang Kami</a>
                    <a href="#" class="d-block">Karir</a>
                    <a href="#" class="">FAQs</a>
                </div>
            </div>
            <hr>
            <p style="text-align:center; font-size:15px">&copy; Copyright 2021, Rumah Sakit Marsudirini</p>
        </div>
    </footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>