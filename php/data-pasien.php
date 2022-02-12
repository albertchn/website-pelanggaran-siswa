<?php
session_start();

if ( !isset($_SESSION["login"]) ) {
    header('Location: login.php');
    exit;
}

require 'functions.php';

$id = $_GET["id"];

$pasien = query("SELECT * FROM pasien_rs WHERE id_pasien=$id")[0];
$pelayanan = query("SELECT * FROM pelayanan_rs WHERE id_pasien=$id")[0];
$id_dokter = $pelayanan["id_dokter"];
$dokter = query("SELECT nama_dokter, spesialis FROM dokter WHERE id_dokter= $id_dokter")[0];
$id_kunjungan = $pelayanan["id_kunjungan"];
$rekam_medis = query("SELECT tgl_rekam FROM rekam_medis WHERE id_kunjungan= $id_kunjungan");


?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pasien | <?= ucwords($pasien["nama_pasien"]); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/data_pasien.css">
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
        <div class="container-fluid  mb-4 bg-warning p-1">
            <h1 class="text-center fs-2">Data Pasien RS Marsudirini</h1>
        </div>
        <div class="container-lg">
            <div class="mb-2 ms-2">
                <a href="ubah.php?id=<?= $id; ?>"><i class="bi bi-pencil-square"></i> Ubah data</a>
            </div>
            <div class="row">
                <div class="col-md-6">

                    <table border="0" class="table table-borderless fs-6">
                        <tbody>
                            <tr>
                                <td style="width: 165px;">Nama</td>
                                <td style="width: 10px;">:</td>
                                <td style="width: 400px;"><?= $pasien["nama_pasien"]; ?></td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>:</td>
                                <td><?= $pasien["jenis_kelamin"]; ?></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td><?= $pasien["alamat"]; ?></td>
                            </tr>
                            <tr>
                                <td>Agama</td>
                                <td>:</td>
                                <td><?= $pasien["agama"]; ?></td>
                            </tr>
                            <tr>
                                <td>Tempat Lahir</td>
                                <td>:</td>
                                <td><?= $pasien["tempat_lahir"]; ?></td>
                            </tr>
                            <tr>
                                <td>Tanggal Lahir</td>
                                <td>:</td>
                                <td><?= date('d - m - Y', strtotime($pasien["tanggal_lahir"])); ?></td>
                            </tr>
                            <tr>
                                <td>Golongan Darah</td>
                                <td>:</td>
                                <td><?= $pasien["golongan_darah"]; ?></td>
                            </tr>
                            <tr>
                                <td>Keluhan</td>
                                <td>:</td>
                                <td><?= $pelayanan["keluhan"]; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container-fluid  mb-4 bg-warning p-1">
            <h1 class="text-center fs-2">Rekam Medis</h1>
        </div>
        <div class="container-lg">
            <ul>
                <li>
                    <?php if ( count($rekam_medis) === 1 ) : ?>
                        <a href="rekam_medis.php?id_pasien=<?= $id; ?>&id_kunjungan=<?= $id_kunjungan; ?>" class="fw-bold"><?= date('d-m-Y', strtotime($rekam_medis[0]["tgl_rekam"])); ?></a>
                    <?php else : ?>
                        <a href="rekam-medis.php">Tambah Rekam Medis</a>
                    <?php endif; ?>
                </li>

            </ul>
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