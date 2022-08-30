<?php
session_start();

if (!isset($_SESSION["login"])) {
    header('Location: ./login.php');
    exit;
}

if (isset($_SESSION["admsis"])) {
    $admin = "hidden";
    $pelapor =  $_SESSION["nis"];
} else {
    $admin = "";
}

if (isset($_SESSION["admgr"])) {
    $admin = "hidden";
    $pelapor =  $_SESSION["nip"];
} else {
    $admin = "";
}

if (isset($_SESSION["guru"])) {
    $guru = "hidden";
    $pelapor = $_SESSION["nip"];
} else {
    $guru = "";
}

if (isset($_SESSION["osis"])) {
    $osis = "hidden";
    $pelapor = $_SESSION["nis"];
} else {
    $osis = "";
}

if (isset($_SESSION["siswa"])) {
    header("Location: ./data_siswa.php?id=" . $_SESSION["id_siswa"]);
}


require 'functions.php';

$kelas_sekolah = query("SELECT * FROM kelas");
$ket_pelanggaran_keterlambatan = query("SELECT * FROM ket_pelanggaran WHERE jenis_pelanggaran='keterlambatan'");
$ket_pelanggaran_pakaian = query("SELECT * FROM ket_pelanggaran WHERE jenis_pelanggaran='pakaian'");
$ket_pelanggaran_upacara = query("SELECT * FROM ket_pelanggaran WHERE jenis_pelanggaran='upacara'");
$ket_pelanggaran_media_elektronik = query("SELECT * FROM ket_pelanggaran WHERE jenis_pelanggaran='media elektronik'");
$ket_pelanggaran_aksesoris = query("SELECT * FROM ket_pelanggaran WHERE jenis_pelanggaran='aksesoris'");
$ket_pelanggaran_kehadiran = query("SELECT * FROM ket_pelanggaran WHERE jenis_pelanggaran='kehadiran'");
$ket_pelanggaran_lingkungan_sekolah = query("SELECT * FROM ket_pelanggaran WHERE jenis_pelanggaran='lingkungan sekolah'");
$ket_pelanggaran_mencuri = query("SELECT * FROM ket_pelanggaran WHERE jenis_pelanggaran='mencuri'");
$ket_pelanggaran_merokok = query("SELECT * FROM ket_pelanggaran WHERE jenis_pelanggaran='merokok'");
$ket_pelanggaran_pornografi = query("SELECT * FROM ket_pelanggaran WHERE jenis_pelanggaran='pornografi'");
$ket_pelanggaran_senjata_tajam = query("SELECT * FROM ket_pelanggaran WHERE jenis_pelanggaran='senjata tajam'");
$ket_pelanggaran_perkelahian = query("SELECT * FROM ket_pelanggaran WHERE jenis_pelanggaran='perkelahian / tawuran'");
$ket_pelanggaran_narkoba = query("SELECT * FROM ket_pelanggaran WHERE jenis_pelanggaran='narkoba / miras'");
$ket_pelanggaran_kepribadian = query("SELECT * FROM ket_pelanggaran WHERE jenis_pelanggaran='kepribadian'");

if (isset($_POST["submit"])) {
    if (!empty($_POST["kelas"]) && !empty($_POST["jurusan"]) && !in_array("0", $_POST["pelanggaran"]) && $_POST["nama"] !== "0") {
        if (lapor($_POST, $pelapor) > 0) {
            echo "<script>
                        alert('Berhasil membuat laporan!');
                        document.location.href = '../index.php';
                        </script>";
        } else {
            echo "<script>
                        alert('Gagal membuat laporan!');
                        document.location.href = '../index.php';
                        </script>";
            // echo mysqli_error($conn);
        }
    } else {
        echo "<script>
              alert('Semua input wajib diisi!');
              document.location.href = './lapor.php';
              </script>";
    }
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lapor | SMKN 12 JAKARTA</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./../css/umum.css">
    <link rel="icon" href="../img/logosmk12.png">
    <style>
        /* .short,
        .slt-width {
            width: 500px;
        } */
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light border-bottom">
        <div class="container-lg">
            <a href="./../index.php" class="navbar-brand align-items-center ">
                <img src="./../img/logosmk12.png" style="width:50px;height:50px">
                <h5 class=" ms-1 d-inline">OSIS SMKN 12 JAKARTA</h5>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav" aria-controls="main-nav" aria-expanded="false" aria-label="Toggle Navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end align-items-center" id="main-nav">
                <ul class="navbar-nav">
                    <li class="navbar-item">
                        <a href="./../index.php" class="nav-link">Beranda</a>
                    </li>
                    <li class="navbar-item">
                        <a href="./siswa.php" class="nav-link">Siswa</a>
                    </li>
                    <li class="navbar-item">
                        <a href="./guru.php" class="nav-link" <?= $guru; ?><?= $osis; ?>>Guru</a>
                    </li>
                    <li class="navbar-item">
                        <a href="./ktnpelanggaran.php" class="nav-link">Ketentuan</a>
                    </li>
                    <li class="nav-item dropdown mt-1">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="d-md-none">Menu</span><i class="bi bi-three-dots-vertical"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <?php if (isset($_SESSION["login"])) : ?>
                                    <a href="./logout.php" class="dropdown-item">Keluar</a>
                                <?php endif; ?>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="mt-3">
        <div class="container-lg">
            <h2 class="text-center mb-4">Laporkan Pelanggaran</h2>

            <form method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="kelas" class="form-label">Kelas</label>
                            <select name="kelas" id="kelas" class="form-select form-select-sm slt_width" required>
                                <option value="">Pilih kelas</option>
                                <?php foreach ($kelas_sekolah as $kelas) : ?>
                                    <option value="<?= $kelas["id_kelas"]; ?>"><?= $kelas["nama_kelas"]; ?></option>

                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="jurusan" class="form-label">Jurusan</label>
                            <select name="jurusan" id="jurusan" class="form-select form-select-sm" disabled required>
                                <option value="">Pilih jurusan</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Siswa</label>
                            <select name="nama" id="nama" class="form-select form-select-sm" required disabled>
                                <option value="0">Pilih nama siswa</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6" style="max-height: 237px; overflow-y: auto">
                        <div id="listPelanggaran">
                            <div id="plgr1" class="mb-3">
                                <label for="pelanggaran" class="form-label">Pelanggaran</label>
                                <select name="pelanggaran[]" id="pelanggaran" class="form-select form-select-sm slt_width" required>
                                    <option value="0">Pilih pelanggaran</option>
                                    <optgroup label="<?= ucwords($ket_pelanggaran_keterlambatan[0]["jenis_pelanggaran"]); ?>">
                                        <?php foreach ($ket_pelanggaran_keterlambatan as $keterlambatan) : ?>
                                            <option class="short" data-limit="" value="<?= $keterlambatan["id_pelanggaran"]; ?>"><?= $keterlambatan["det_pelanggaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="<?= ucwords($ket_pelanggaran_pakaian[0]["jenis_pelanggaran"]); ?>">
                                        <?php foreach ($ket_pelanggaran_pakaian as $pakaian) : ?>
                                            <option class="short" data-limit="" value="<?= $pakaian["id_pelanggaran"]; ?>"><?= $pakaian["det_pelanggaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="<?= ucwords($ket_pelanggaran_upacara[0]["jenis_pelanggaran"]); ?>">
                                        <?php foreach ($ket_pelanggaran_upacara as $upacara) : ?>
                                            <option class="short" data-limit="" value="<?= $upacara["id_pelanggaran"]; ?>"><?= $upacara["det_pelanggaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="<?= ucwords($ket_pelanggaran_media_elektronik[0]["jenis_pelanggaran"]); ?>">
                                        <?php foreach ($ket_pelanggaran_media_elektronik as $media_elektronik) : ?>
                                            <option class="short" data-limit="" value="<?= $media_elektronik["id_pelanggaran"]; ?>"><?= $media_elektronik["det_pelanggaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="<?= ucwords($ket_pelanggaran_aksesoris[0]["jenis_pelanggaran"]); ?>">
                                        <?php foreach ($ket_pelanggaran_aksesoris as $aksesoris) : ?>
                                            <option class="short" data-limit="" value="<?= $aksesoris["id_pelanggaran"]; ?>"><?= $aksesoris["det_pelanggaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="<?= ucwords($ket_pelanggaran_kehadiran[0]["jenis_pelanggaran"]); ?>">
                                        <?php foreach ($ket_pelanggaran_kehadiran as $kehadiran) : ?>
                                            <option class="short" data-limit="" value="<?= $kehadiran["id_pelanggaran"]; ?>"><?= $kehadiran["det_pelanggaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="<?= ucwords($ket_pelanggaran_lingkungan_sekolah[0]["jenis_pelanggaran"]); ?>">
                                        <?php foreach ($ket_pelanggaran_lingkungan_sekolah as $lingkungan_sekolah) : ?>
                                            <option class="short" data-limit="" value="<?= $lingkungan_sekolah["id_pelanggaran"]; ?>"><?= $lingkungan_sekolah["det_pelanggaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="<?= ucwords($ket_pelanggaran_mencuri[0]["jenis_pelanggaran"]); ?>">
                                        <?php foreach ($ket_pelanggaran_mencuri as $mencuri) : ?>
                                            <option class="short" data-limit="" value="<?= $mencuri["id_pelanggaran"]; ?>"><?= $mencuri["det_pelanggaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="<?= ucwords($ket_pelanggaran_merokok[0]["jenis_pelanggaran"]); ?>">
                                        <?php foreach ($ket_pelanggaran_merokok as $merokok) : ?>
                                            <option class="short" data-limit="" value="<?= $merokok["id_pelanggaran"]; ?>"><?= $merokok["det_pelanggaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="<?= ucwords($ket_pelanggaran_pornografi[0]["jenis_pelanggaran"]); ?>">
                                        <?php foreach ($ket_pelanggaran_pornografi as $pornografi) : ?>
                                            <option class="short" data-limit="" value="<?= $pornografi["id_pelanggaran"]; ?>"><?= $pornografi["det_pelanggaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="<?= ucwords($ket_pelanggaran_senjata_tajam[0]["jenis_pelanggaran"]); ?>">
                                        <?php foreach ($ket_pelanggaran_senjata_tajam as $senjata_tajam) : ?>
                                            <option class="short" data-limit="" value="<?= $senjata_tajam["id_pelanggaran"]; ?>"><?= $senjata_tajam["det_pelanggaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="<?= ucwords($ket_pelanggaran_perkelahian[0]["jenis_pelanggaran"]); ?>">
                                        <?php foreach ($ket_pelanggaran_perkelahian as $perkelahian) : ?>
                                            <option class="short" data-limit="" value="<?= $perkelahian["id_pelanggaran"]; ?>"><?= $perkelahian["det_pelanggaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="<?= ucwords($ket_pelanggaran_narkoba[0]["jenis_pelanggaran"]); ?>">
                                        <?php foreach ($ket_pelanggaran_narkoba as $narkoba) : ?>
                                            <option class="short" data-limit="" value="<?= $narkoba["id_pelanggaran"]; ?>"><?= $narkoba["det_pelanggaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="<?= ucwords($ket_pelanggaran_kepribadian[0]["jenis_pelanggaran"]); ?>">
                                        <?php foreach ($ket_pelanggaran_kepribadian as $kepribadian) : ?>
                                            <option class="short" data-limit="" value="<?= $kepribadian["id_pelanggaran"]; ?>"><?= $kepribadian["det_pelanggaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                </select>
                            </div>
                        </div>

                        <div class="my-2 text-center">
                            <button type="button" class="btn btn-outline-primary rounded addPlgr" name="tmbPlgr">+</button>
                        </div>

                    </div>
                </div>

                <div class="mt-2">
                    <button type="submit" name="submit" class="btn btn-warning">Laporkan</button>
                </div>
            </form>
        </div>
    </section>

    <footer class="pt-4 border-top bg-light" style="margin:100px 0 0 0;">
        <div class="container-xl">
            <div class="row justify-content-center">
                <div class="col-auto pb-2">
                    <img src="../img/logosmk12.png" style="width:50px;height:50px">
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
            <p style="text-align:center; font-size:15px">&copy; Copyright 2022, RPL A0204</p>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            screenWidth();
        });

        let btn = document.querySelector('.addPlgr');
        btn.onclick = function() {
            tambahPelanggaran();
            screenWidth();
            shortString(".short");
        }
    </script>
    <script>
        $("#kelas").change(function() {
            // value kelas
            const id_kelas = $("#kelas").val();

            // hapus attribute disable
            $("#jurusan").removeAttr("disabled")

            // mengirim value dan menerima data
            $.ajax({
                type: "POST",
                dataType: "html",
                url: "./data_lapor.php",
                data: "kelas=" + id_kelas,
                success: function(data) {
                    $("#jurusan").html(data);
                }
            });
        });

        $("#jurusan").change(function() {
            // value jurusan
            const id_jurusan = $("#jurusan").val();
            const id_kelas = $("#kelas").val();

            // hapus attribute disable
            $("#nama").removeAttr("disabled")

            // mengirim value dan menerima data
            $.ajax({
                type: "POST",
                dataType: "html",
                url: "./data_lapor.php",
                data: "jurusan=" + id_jurusan,
                success: function(data) {
                    $("#nama").html(data);
                }
            });

        });
    </script>

    <script>
        let indexPelanggaran = 1

        function tambahPelanggaran() {
            const plgr = document.getElementById("plgr" + indexPelanggaran);
            const element = `<div id="plgr${indexPelanggaran + 1}"  class="mb-3">
                                <label for="pelanggaran" class="form-label">Pelanggaran</label>
                                <select name="pelanggaran[]" id="pelanggaran" class="form-select form-select-sm slt_width" required>
                                    <option value="0">Pilih pelanggaran</option>
                                    <optgroup label="<?= ucwords($ket_pelanggaran_keterlambatan[0]["jenis_pelanggaran"]); ?>">
                                        <?php foreach ($ket_pelanggaran_keterlambatan as $keterlambatan) : ?>
                                        <option class="short" data-limit="" value="<?= $keterlambatan["id_pelanggaran"]; ?>"><?= $keterlambatan["det_pelanggaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="<?= ucwords($ket_pelanggaran_pakaian[0]["jenis_pelanggaran"]); ?>">
                                        <?php foreach ($ket_pelanggaran_pakaian as $pakaian) : ?>
                                        <option class="short" data-limit="" value="<?= $pakaian["id_pelanggaran"]; ?>"><?= $pakaian["det_pelanggaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="<?= ucwords($ket_pelanggaran_upacara[0]["jenis_pelanggaran"]); ?>">
                                        <?php foreach ($ket_pelanggaran_upacara as $upacara) : ?>
                                        <option class="short" data-limit="" value="<?= $upacara["id_pelanggaran"]; ?>"><?= $upacara["det_pelanggaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="<?= ucwords($ket_pelanggaran_media_elektronik[0]["jenis_pelanggaran"]); ?>">
                                        <?php foreach ($ket_pelanggaran_media_elektronik as $media_elektronik) : ?>
                                        <option class="short" data-limit="" value="<?= $media_elektronik["id_pelanggaran"]; ?>"><?= $media_elektronik["det_pelanggaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="<?= ucwords($ket_pelanggaran_aksesoris[0]["jenis_pelanggaran"]); ?>">
                                        <?php foreach ($ket_pelanggaran_aksesoris as $aksesoris) : ?>
                                        <option class="short" data-limit="" value="<?= $aksesoris["id_pelanggaran"]; ?>"><?= $aksesoris["det_pelanggaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="<?= ucwords($ket_pelanggaran_kehadiran[0]["jenis_pelanggaran"]); ?>">
                                        <?php foreach ($ket_pelanggaran_kehadiran as $kehadiran) : ?>
                                        <option class="short" data-limit="" value="<?= $kehadiran["id_pelanggaran"]; ?>"><?= $kehadiran["det_pelanggaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="<?= ucwords($ket_pelanggaran_lingkungan_sekolah[0]["jenis_pelanggaran"]); ?>">
                                        <?php foreach ($ket_pelanggaran_lingkungan_sekolah as $lingkungan_sekolah) : ?>
                                        <option class="short" data-limit="" value="<?= $lingkungan_sekolah["id_pelanggaran"]; ?>"><?= $lingkungan_sekolah["det_pelanggaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="<?= ucwords($ket_pelanggaran_mencuri[0]["jenis_pelanggaran"]); ?>">
                                        <?php foreach ($ket_pelanggaran_mencuri as $mencuri) : ?>
                                        <option class="short" data-limit="" value="<?= $mencuri["id_pelanggaran"]; ?>"><?= $mencuri["det_pelanggaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="<?= ucwords($ket_pelanggaran_merokok[0]["jenis_pelanggaran"]); ?>">
                                        <?php foreach ($ket_pelanggaran_merokok as $merokok) : ?>
                                        <option class="short" data-limit="" value="<?= $merokok["id_pelanggaran"]; ?>"><?= $merokok["det_pelanggaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="<?= ucwords($ket_pelanggaran_pornografi[0]["jenis_pelanggaran"]); ?>">
                                        <?php foreach ($ket_pelanggaran_pornografi as $pornografi) : ?>
                                        <option class="short" data-limit="" value="<?= $pornografi["id_pelanggaran"]; ?>"><?= $pornografi["det_pelanggaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="<?= ucwords($ket_pelanggaran_senjata_tajam[0]["jenis_pelanggaran"]); ?>">
                                        <?php foreach ($ket_pelanggaran_senjata_tajam as $senjata_tajam) : ?>
                                        <option class="short" data-limit="" value="<?= $senjata_tajam["id_pelanggaran"]; ?>"><?= $senjata_tajam["det_pelanggaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="<?= ucwords($ket_pelanggaran_perkelahian[0]["jenis_pelanggaran"]); ?>">
                                        <?php foreach ($ket_pelanggaran_perkelahian as $perkelahian) : ?>
                                        <option class="short" data-limit="" value="<?= $perkelahian["id_pelanggaran"]; ?>"><?= $perkelahian["det_pelanggaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="<?= ucwords($ket_pelanggaran_narkoba[0]["jenis_pelanggaran"]); ?>">
                                        <?php foreach ($ket_pelanggaran_narkoba as $narkoba) : ?>
                                        <option class="short" data-limit="" value="<?= $narkoba["id_pelanggaran"]; ?>"><?= $narkoba["det_pelanggaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="<?= ucwords($ket_pelanggaran_kepribadian[0]["jenis_pelanggaran"]); ?>">
                                        <?php foreach ($ket_pelanggaran_kepribadian as $kepribadian) : ?>
                                        <option class="short" data-limit="" value="<?= $kepribadian["id_pelanggaran"]; ?>"><?= $kepribadian["det_pelanggaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                </select>
                            </div>`

            plgr.insertAdjacentHTML('afterend', element);
            indexPelanggaran++
            screenWidth();
            shortString();
        }
    </script>
    <script>
        function screenWidth() {
            let w = $(window).width();
            if (w > 900) {
                $(".short").attr("data-limit", "70");
            } else if (w > 800 && w <= 900) {
                $(".short").attr("data-limit", "50");
            } else if (w >= 768 && w <= 800) {
                $(".short").attr("data-limit", "48");
            } else if (w > 700 && w <= 767) {
                $(".short").attr("data-limit", "95");
            } else if (w > 650 && w <= 700) {
                $(".short").attr("data-limit", "93");
            } else if (w > 600 && w <= 650) {
                $(".short").attr("data-limit", "90");
            } else if (w <= 600 && w >= 550) {
                $(".short").attr("data-limit", "75");
            } else if (w < 550 && w >= 500) {
                $(".short").attr("data-limit", "65");
            } else if (w < 500 && w >= 450) {
                $(".short").attr("data-limit", "60");
            } else if (w < 450 && w >= 400) {
                $(".short").attr("data-limit", "52");
            } else if (w < 400) {
                $(".short").attr("data-limit", "47");
            }
        }
    </script>
    <script>
        function shortString(selector) {
            const elements = document.querySelectorAll(selector);
            const tail = '...';
            if (elements && elements.length) {
                for (const element of elements) {
                    let text = element.innerText;
                    if (element.hasAttribute('data-limit')) {
                        if (text.length > element.dataset.limit) {
                            element.innerText = `${text.substring(0, element.dataset.limit - tail.length).trim()}${tail}`;
                        }
                    } else {
                        throw Error('Cannot find attribute \'data-limit\'');
                    }
                }
            }
        }

        window.onload = function() {
            shortString('.short');
        };
    </script>
</body>

</html>