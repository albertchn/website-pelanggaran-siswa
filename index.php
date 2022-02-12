<?php
session_start();

if ( isset($_SESSION["login"]) ) {
    $login = true;
} else {
    // header ('Location: ./php/login.php');
    // exit;
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OSIS SMKN 12 JAKARTA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./css/siswa.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light border-bottom">
        <div class="container-lg">
            <a href="index.php" class="navbar-brand align-items-center ">
                <img src="./img/logosmk12.png" style="width:50px;height:50px">
                <h5 class=" ms-1 d-inline">OSIS SMKN 12 JAKARTA</h5>
            </a>    

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav"
            aria-controls="main-nav" aria-expanded="false" aria-label="Toggle Navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end align-items-center" id="main-nav">
                <ul class="navbar-nav">
                    <li class="navbar-item">
                        <a href="index.php" class="nav-link active">Beranda</a>
                    </li>
                    <li class="navbar-item">
                        <a href="./php/siswa.php" class="nav-link">Siswa</a>
                    </li>
                    <li class="navbar-item">
                        <a href="./php/guru.php" class="nav-link">Guru</a>
                    </li>
                    <li class="navbar-item">
                        <a href="./php/ktnpelanggaran.php" class="nav-link">Ketentuan Pelanggaran</a>
                    </li>
                    <li class="nav-item dropdown mt-1">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="d-md-none">Menu</span><i class="bi bi-three-dots-vertical"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <?php if ( isset($login) ) : ?>
                                    <a href="php/logout.php" class="dropdown-item">Keluar</a>
                                <?php endif; ?>
                            </li>
                            <li><a class="dropdown-item" href="#">Impor Data</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="mt-md-5">
        <div class="container-lg">
            <div class="row justify-content-center mx-auto">
                <div class="col-md-6">
                    <h1 class="display-5 fw-bold mt-5">Hai, Selamat datang</h1>
                    <p class="text-muted me-4 lh my-4">Betapa indahnya sekolah yang tertib dan disiplin, mari wujudkan kedisiplinan dan ketertiban di <strong>SMKN 12 JAKARTA</strong></p>
                    <a href="./php/lapor.php" class="btn btn-warning">Laporkan</a>
                    <a href="./php/laporan.php" class="btn btn-outline-success ms-2">Report</a>
                </div>
                <div class="col-md-6">
                    <img src="./img/welcome.png" class="d-none d-md-block mx-auto" width="400px">
                </div>
            </div>
        </div>
    </section>

    <footer class="pt-4 border-top bg-light" style="margin:100px 0 0 0;">
        <div class="container-xl">
            <div class="row justify-content-center">
                <div class="col-auto pb-2">
                    <img src="./img/logosmk12.png" style="width:50px;height:50px">
                    <h5 class="d-inline">OSIS SMK NEGERI 12 JAKARTA</h5>
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
                    <a href="#" class="">FAQs</a>
                </div>
            </div>
            <hr>
            <p style="text-align:center; font-size:15px">&copy; Copyright 2022, OSIS SMK NEGERI 12 JAKARTA</p>
        </div>
    </footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>