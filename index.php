<?php
session_start();

if ( !isset($_SESSION["login"]) ) {
    header ('Location: ./php/login.php');
    exit;
}

if(isset($_SESSION["guru"])) {
    $guru = "hidden";
    $username = $_SESSION["nip"];
    $id = $_SESSION["id"];
} else {
    $guru = "";
}  

if(isset($_SESSION["osis"])) {
    $osis = "hidden";
    $username = $_SESSION["nis"];
    $id = $_SESSION["id"];
} else {
    $osis = "";
}

if(isset($_SESSION["siswa"])) {
    header("Location: ./php/data_siswa.php?id=" . $_SESSION["id_siswa"]);
}

if(isset($_SESSION["admin"])) {
    $admin = "hidden";
}
else {
    $admin = "";
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
                        <a href="./php/guru.php" class="nav-link" <?= $guru; ?><?= $osis; ?>>Guru</a>
                    </li>
                    <li class="navbar-item">
                        <a href="./php/ktnpelanggaran.php" class="nav-link">Ketentuan Pelanggaran</a>
                    </li>
                    <li class="nav-item dropdown mt-1">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="d-md-none">Menu</span><i class="bi bi-three-dots-vertical"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <?php if ( isset($_SESSION["login"]) ) : ?>
                                    <a href="./php/logout.php" class="dropdown-item">Keluar</a>
                                    <a href="#" class="dropdown-item"  data-bs-toggle="modal" data-bs-target="#ganti_pw" <?= $admin; ?>>Ganti Password</a>
                                <?php endif; ?>
                            </li>
                        </ul>
                    </li>
                    <!-- Modal -->
                    <div class="modal fade" id="ganti_pw" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="gantoPw" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="gantoPw">Ganti Password</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="./php/ubah/ubah_password.php?id=<?= $id; ?>" method="post">
                                    <input type="hidden" name="username" value="<?= $username; ?>">
                                    <div class="mb-2">
                                        <label for="pw_lama" class="form-label">Password Lama</label>
                                        <input type="password" class="form-control" id="pw_lama" placeholder="yang mau diganti..." name="pw_lama" required autocomplete="off" autofocus>
                                    </div>
                                    <div class="mb-2">
                                        <label for="pw_baru" class="form-label">Password Baru</label>
                                        <input type="password" class="form-control" id="pw_baru" name="pw_baru" required placeholder="rahasia banget!" autocomplete="off">
                                    </div>
                                    <div class="mb-2">
                                        <label for="con_pw_baru" class="form-label">Konfirmasi Password Baru</label>
                                        <input type="password" class="form-control" id="con_pw_baru" name="con_pw_baru" required placeholder="jangan kasih tau orang!" autocomplete="off">
                                    </div>
                                    <div class="modal-footer mt-2">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary" name="ganti">Ganti</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
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
                    <a href="./php/lapor.php" class="btn btn-warning">Lapor</a>
                    <a href="./php/laporan.php" class="btn btn-outline-success ms-2">Laporan</a>
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