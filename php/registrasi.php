<?php
require 'functions.php';

if ( isset($_POST["registrasi"]) ) {
    if ( registrasi($_POST) > 0 ) {
        echo "<script>
                alert('Akun berhasil didaftarkan!');
                // redirect versi javascript
                document.location.href = 'login.php';
              </script>";
    } else {
        echo "<script>
                alert('Akun gagal didaftarkan!');
                // redirect versi javascript
                document.location.href = 'login.php';
              </script>";
    }
};
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar | RS Marsudirini</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/login.css">
    <style>
        label {
            display:block;
        }
    </style>
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

    <section class="login" style="margin:60px 0 50px 0">
        <div class="container-lg">
            <div class="row justify-content-center mb-5 g-3">
                <div class="col-10 col-md-5 justify-items-start">
                    <h2 class="mb-4" style="margin-top:-10px">Halaman Registrasi</h2>
                    <form action="" method="post">
                    <div class="mb-3">
                        <label class="form-label" for="email">Email</label>
                        <input class="form-control" type="email" name="email" id="email"  autofocus requires autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="username">Username</label>
                        <input class="form-control" type="text" name="username" id="usern ame" requires autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="password1">Password</label>
                        <input class="form-control" type="password" name="password1" id=" password1" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="password2">Konfirmasi Password</label>
                        <input class="form-control" type="password" name="password2" id=" password2" required> 
                    </div>
                    <button type="submit" name="registrasi" class="btn btn-outline-secondary mb-3">Masuk</button>
                    <p class="mb-5">Sudah punya akun?<a href="login.php"> Masuk</a></p>
                    </form>
                </div>

                <div class="col-md-5 d-none d-md-block image mt-5">
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