<?php
session_start();

if (!isset($_SESSION["login"])) {
    header('Location: ../login.php');
    exit;
}

if (isset($_SESSION["guru"])) {
    $guru = "hidden";
} else {
    $guru = "";
}

if (isset($_SESSION["osis"])) {
    header("Location: '../ktnpelanggaran.php");
}

if (isset($_SESSION["siswa"])) {
    header("Location: ../data_siswa.php?id=" . $_SESSION["id_siswa"]);
}

require '../functions.php';

$id = $_GET["id"];

if (!$id) {
    return header("Location: ../ktnpelanggaran.php");
}

$ktnprestasi = query("SELECT * FROM ket_prestasi WHERE id_prestasi = $id")[0];

if (isset($_POST["ubah"])) {
    if (ubah_ketprestasi($_POST) > 0) {
        echo "
            <script>
                alert('Data berhasil diubah!')
                // redirect versi javascript
                document.location.href = '../ktnpelanggaran.php';
                </script>
                ";
    } else {
        echo "
                <script>
                alert('Data gagal diubah!')
                // redirect versi javascript
                document.location.href = '../ktnpelanggaran.php';
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
    <title>Ubah Ketentuan Prestasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../css/umum.css">
    <link rel="icon" href="../../img/logosmk12.png">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light border-bottom">
        <div class="container-lg">
            <a href="../../index.php" class="navbar-brand align-items-center ">
                <img src="../../img/logosmk12.png" style="width:50px;height:50px">
                <h5 class=" ms-1 d-inline">OSIS SMKN 12 JAKARTA</h5>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav" aria-controls="main-nav" aria-expanded="false" aria-label="Toggle Navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end align-items-center" id="main-nav">
                <ul class="navbar-nav">
                    <li class="navbar-item">
                        <a href="../../index.php" class="nav-link">Beranda</a>
                    </li>
                    <li class="navbar-item">
                        <a href="../siswa.php" class="nav-link">Siswa</a>
                    </li>
                    <li class="navbar-item">
                        <a href="../guru.php" class="nav-link" <?= $guru; ?>>Guru</a>
                    </li>
                    <li class="navbar-item">
                        <a href="../ktnpelanggaran.php" class="nav-link active">Ketentuan</a>
                    </li>
                    <li class="nav-item dropdown mt-1">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="d-md-none">Menu</span><i class="bi bi-three-dots-vertical"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <?php if (isset($_SESSION["login"])) : ?>
                                    <a href="../logout.php" class="dropdown-item">Keluar</a>
                                <?php endif; ?>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section>
        <div class="container-fluid  mb-4 bg-warning p-1">
            <h1 class="text-center fs-2">Ketentuan Prestasi</h1>
        </div>
        <div class="container-lg">
            <form action="" method="post">
                <input type="hidden" name="id" value="<?= $ktnprestasi["id_prestasi"]; ?>">
                <div class="row">
                    <div class="col-md-7">
                        <div class="mt-2">
                            <label for="det_prestasi" class="form-label">Detail Prestasi</label>
                            <input type="text" class="form-control" id="det_prestasi" name="det_prestasi" required placeholder="Juara Lomba..." autocomplete="off" value="<?= $ktnprestasi["det_prestasi"]; ?>">
                        </div>
                        <div class="mt-2">
                            <label for="poin" class="form-label">Poin Prestasi</label>
                            <input type="number" class="form-control" id="poin" name="poin" required placeholder="1 / 2 / ..." autocomplete="off" value="<?= $ktnprestasi["poin_prestasi"]; ?>">
                        </div>
                        <div class="mt-4">
                            <a href="../ktnpelanggaran.php" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary ms-2" name="ubah">Ubah</button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </section>

    <footer class="pt-4 border-top bg-light" style="margin:100px 0 0 0;">
        <div class="container-xl">
            <div class="row justify-content-center">
                <div class="col-auto pb-2">
                    <img src="../../img/logosmk12.png" style="width:50px;height:50px">
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
</body>

</html>