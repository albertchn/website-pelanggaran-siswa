<?php
session_start();

if ( !isset($_SESSION["login"]) ) {
    header('Location: login.php');
    exit;
}


require 'functions.php';

$id_pasien = $_GET["id"];

$pasien = query("SELECT * FROM pasien_rs WHERE id_pasien = $id_pasien")[0];
$keluhan = query("SELECT keluhan FROM pelayanan_rs WHERE id_pasien = $id_pasien")[0];

if ( isset($_POST["batal"]) ) {
    header('Location: data-pasien.php?id='. $id_pasien);
}

if ( isset($_POST["ubah"]) ) {
    
    if ( ubah($_POST) > 0 ) {
        echo "
            <script>
                alert('Data berhasil diubah!')
                document.location.href = 'pasien.php';
            </script>
        ";
    }
    else {
        echo "
            <script>
                alert('Data gagal diubah!')
                document.location.href = 'pasien.php';
            </script>
        ";
    }
    
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah data | <?= $pasien["nama_pasien"]; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/ubah.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light border-bottom">
        <div class="container-xl">
            <a href="../index.php" class="navbar-brand align-items-center ">
                <img src="../img/rs/RS Logo.png" style="width:50px;height:50px">
                <h5 class="d-inline">Rumah Sakit Marsudirini</h5>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav"
            aria-controls="main-nav" aria-expanded="false" aria-label="Toggle Navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="main-nav">
                <ul class="navbar-nav">
                    <li class="navbar-item">
                        <a href="../index.php" class="nav-link">Beranda</a>
                    </li>
                    <li class="navbar-item">
                        <a href="pasien.php" class="nav-link">Pasien</a>
                    </li>
                    <li class="navbar-item">
                        <a href="jadwal-dokter.php" class="nav-link">Jadwal Dokter</a>
                    </li>
                    <li class="navbar-item">
                        <a href="fasilitas.php" class="nav-link">Fasilitas</a>
                    </li>
                    <li class="navbar-item">
                        <a href="profil.php" class="nav-link">Profil</a>
                    </li>
                    <li class="navbar-item d-md-none">
                        <a href="logout.php" class="nav-link">Keluar</a>
                    </li>
                    <li class="navbar-item ms-2 d-none d-md-inline">
                        <a href="logout.php" class="btn btn-outline-secondary">Keluar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <section>
        <div class="container-fluid mt-4 mb-4">
            <h1 class="text-center fs-2">Ubah Data Pasien</h1>
        </div>
        <div class="container-lg mt-5">

            <form action="" method="POST">
                <input type="hidden" name="id" value="<?= $id_pasien; ?>">

                <div class="bg-warning p-1 mt-3 mb-3">
                    <h3 class="text-center bg-warning">Data Pasien</h3>
                </div>
                
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label" for="nama">Nama Lengkap</label>
                            <input class="form-control" type="text" name="nama" id="nama" required autocomplete="off" value="<?= $pasien["nama_pasien"]; ?>" autofocus>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="alamat">Alamat</label>
                            <input class="form-control" type="text" name="alamat" id="alamat" required autocomplete="off" value="<?= $pasien["alamat"]; ?>" autofocus>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="agama">Agama</label>
                            <input class="form-control" type="text" name="agama" id="agama" required autocomplete="off" value="<?= $pasien["agama"]; ?>" autofocus>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="tmp_lahir">Tempat Lahir</label>
                            <input class="form-control" type="text" name="tmp_lahir" id="tmp_lahir" required autocomplete="off" value="<?= $pasien["tempat_lahir"]; ?>" autofocus>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="keluhan">Keluhan :</label>
                            <input class="form-control" type="text" name="keluhan" id="keluhan" required value="<?= $keluhan["keluhan"]; ?>" autofocus autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label class="form-label" for="tgl_lahir">Tanggal Lahir</label>
                            <input class="form-control" type="date" name="tgl_lahir" id="tgl_lahir" required autocomplete="off" value="<?= $pasien["tanggal_lahir"]; ?>" autofocus>
                        </div>
                        <div class="jk">
                            <label class="form-label d-block" for="jenis_kelamin">Jenis Kelamin</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki" value="Laki - Laki" required autocomplete="off" checked default>
                                <label class="form-check-label" for="laki">Laki - Laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="Perempuan" required autocomplete="off">
                                <label class="form-check-label" for="perempuan">Perempuan</label>
                            </div>
                        </div>
                        <div>
                            <label class="form-label" for="goldar">Golongan Darah</label>
                            <select class="form-select" name="goldar" id="goldar">
                                <option value="O" default>O</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="AB">AB</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <button class="btn btn-outline-danger me-2" type="submit" name="batal">Batal</button>
                    <button type="submit" name="ubah" class="btn btn-warning">Ubah</button>
                </div>  
            </form>
        </div>
    </section>

    <footer class="pt-4 border-top bg-light" style="margin:100px 0 0 0;">
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
