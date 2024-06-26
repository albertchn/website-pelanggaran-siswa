<?php
session_start();

if (!isset($_SESSION["login"])) {
    header('Location: ./login.php');
    exit;
}

if (isset($_SESSION["guru"])) {
    header("Location: ./../index.php");
}

if (isset($_SESSION["osis"])) {
    header("Location: './../index.php");
}

if (isset($_SESSION["siswa"])) {
    header("Location: ./data_siswa.php?id=" . $_SESSION["id_siswa"]);
}

if (isset($_SESSION["admin"])) {
    $admin = "hidden";
} else {
    $admin = "";
}

$id = $_GET["id"];

if (!isset($_GET["id"])) {
    header("Location: ./guru.php");
}

require "./functions.php";

$guru = query("SELECT * FROM guru_pembina WHERE id_guru = $id")[0];


?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Guru | <?= $guru["nama_guru"]; ?></title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/umum.css">
    <link rel="icon" href="../img/logosmk12.png">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light border-bottom">
        <div class="container-lg">
            <a href="../index.php" class="navbar-brand align-items-center ">
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
                        <a href="./guru.php" class="nav-link active">Guru</a>
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
                                    <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ganti_pw" <?= $admin; ?>>Ganti Password</a>
                                <?php endif; ?>
                            </li>
                        </ul>
                    </li>
                    <!-- Modal -->
                    <div class="modal fade" id="ganti_pw" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="gantiPw" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="gantiPw">Ganti Password</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="./ubah/ubah_password.php?id=<?= $id; ?>" method="post">
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

    <section>
        <div class="container-fluid  mb-4 bg-warning p-1">
            <h1 class="text-center fs-2">Data Guru</h1>
        </div>
        <div class="container-lg">
            <div class="row">
                <div class="col-md-8">

                    <table border="0" class="table table-borderless fs-6">
                        <tbody>
                            <tr>
                                <td style="width: 165px;">Nama</td>
                                <td style="width: 10px;">:</td>
                                <td style="width: 400px;"><?= $guru["nama_guru"]; ?></td>
                            </tr>
                            <tr>
                                <td>NIP / NUPTK</td>
                                <td>:</td>
                                <td><?= $guru["nip"]; ?></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td><?= $guru["email"]; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <footer class="pt-4 border-top bg-light" style="margin-top: 160px;">
        <div class="container-xl">
            <div class="row">
                <div class="col-12 pb-2 text-center">
                    <img src="../img/logosmk12.png" style="width:50px;height:50px">
                    <h5 class="d-inline text-center">OSIS SMK NEGERI 12 JAKARTA</h5>
                </div>
            </div>
            <div class="row justify-content-center align-items-center mx-auto">
                <div class="col-12 col-md-2 text-center">
                    <a href="https://instagram.com/osis12jakarta?igshid=YmMyMTA2M2Y=" target="_blank" class="text-decoration-none d-block">
                        <i class="bi bi-instagram" class=""></i>
                        <span class="insta">Instagram</span>
                    </a>
                </div>
                <div class="col-12 col-md-2 text-center">
                    <a href="https://youtube.com/channel/UC1ne1ftRWTNQk4dvarllnbg" target="_blank" class="text-decoration-none text-danger">
                        <i class="bi bi-youtube"></i>
                        <span class="yt">Youtube</span>
                    </a>
                </div>
            </div>
        </div>
        <hr>
        <p style="text-align:center; font-size:15px" class="mb-0">&copy; Copyright 2022, RPL A0204</p>>
    </footer>

    <script src="../js/bootstrap.js"></script>
</body>

</html>