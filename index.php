<?php
session_start();

if (!isset($_SESSION["login"])) {
    header('Location: ./php/login.php');
    exit;
}

if (isset($_SESSION["guru"])) {
    $guru = "hidden";
    $username = $_SESSION["nip"];
    $id = $_SESSION["id"];
} else {
    $guru = "";
}

if (isset($_SESSION["osis"])) {
    $osis = "hidden";
    $username = $_SESSION["nis"];
    $id = $_SESSION["id_siswa"];
} else {
    $osis = "";
}

if (isset($_SESSION["siswa"])) {
    header("Location: ./php/data_siswa.php?id=" . $_SESSION["id_siswa"]);
}

if (isset($_SESSION["admsis"])) {
    $admin = "hidden";
    $username = $_SESSION["nis"];
    $id = $_SESSION["id_siswa"];
} else {
    $admin = "";
}
if (isset($_SESSION["admgr"])) {
    $admin = "hidden";
    $username = $_SESSION["nip"];
    $id = $_SESSION["id"];
} else {
    $admin = "";
}

require "php/functions.php";

if (isset($_POST["ubah_carousel"])) {
    if (ubah_carousel($_FILES) > 0) {
        echo "<script>
                alert('Foto berhasil diubah')
                // document.location.href = 'index.php';
              </script> ";
    } else {
        echo "<script>
                alert('Foto gagal diubah')
                // document.location.href = 'index.php';
              </script> ";
    }
}

if (isset($_POST["ubah_fotoIndex"])) {
    if (ubah_fotoIndex($_FILES) > 0) {
        echo "<script>
                alert('Foto berhasil diubah')
                // document.location.href = 'index.php';
              </script> ";
    } else {
        echo "<script>
                alert('Foto gagal diubah')
                // document.location.href = 'index.php';
              </script> ";
    }
}

$carousel = mysqli_query($conn, "SELECT * FROM komponen WHERE nama_komponen = 'login_carousel'")->fetch_assoc();
$foto_index = mysqli_query($conn, "SELECT * FROM komponen WHERE nama_komponen = 'foto_index'")->fetch_assoc();

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OSIS SMKN 12 JAKARTA</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./css/umum.css">
    <link rel="icon" href="img/logosmk12.png">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light border-bottom">
        <div class="container-lg">
            <a href="index.php" class="navbar-brand align-items-center ">
                <img src="./img/logosmk12.png" style="width:50px;height:50px">
                <h5 class=" ms-1 d-inline">OSIS SMKN 12 JAKARTA</h5>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav" aria-controls="main-nav" aria-expanded="false" aria-label="Toggle Navigation">
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
                        <a href="./php/ktnpelanggaran.php" class="nav-link">Ketentuan</a>
                    </li>
                    <li class="nav-item dropdown mt-1">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="d-md-none">Menu</span><i class="bi bi-three-dots-vertical"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <?php if (isset($_SESSION["login"])) : ?>
                                    <a href="./php/logout.php" class="dropdown-item">Keluar</a>
                                    <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ganti_pw">Ganti Password</a>
                                    <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ganti_carousel" <?= $guru;
                                                                                                                                $osis; ?>>Ganti Gambar Login</a>
                                    <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ganti_foto_index" <?= $guru;
                                                                                                                                $osis; ?>>Ganti Gambar Index</a>
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
                                    <form action="php/ubah/ubah_password.php?id=<?= $id; ?>" method="post">
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
                <div class="col-md-6 d-none d-lg-block">
                    <div id="mycarousel" class="carousel slide" data-bs-ride="carousel" data-bs-pause="false" data-bs-touch="false">
                        <div class="carousel-inner rounded">
                            <?php $foto = explode(',', $foto_index["isi_komponen"]); ?>
                            <?php if (!empty($foto[0])) { ?>
                                <div class="carousel-item active">
                                    <img src="img/<?= $foto[0]; ?>" class="d-block w-100" style="height: 380px;">
                                </div>
                            <?php }; ?>
                            <?php if (!empty($foto[1])) { ?>
                                <div class="carousel-item">
                                    <img src="img/<?= $foto[1]; ?>" class="d-block w-100" style="height: 380px;">
                                </div>
                                <?php }; ?><?php if (!empty($foto[2])) { ?>
                                <div class="carousel-item">
                                    <img src="img/<?= $foto[2]; ?>" class="d-block w-100" style="height: 380px;">
                                </div>
                                <?php }; ?><?php if (!empty($foto[3])) { ?>
                                <div class="carousel-item">
                                    <img src="img/<?= $foto[3]; ?>" class="d-block w-100" style="height: 380px;">
                                </div>
                                <?php }; ?><?php if (!empty($foto[4])) { ?>
                                <div class="carousel-item">
                                    <img src="img/<?= $foto[4]; ?>" class="d-block w-100" style="height: 380px;">
                                </div>
                            <?php }; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="pt-4 border-top bg-light" style="margin-top: 130px;">
        <div class="container-xl">
            <div class="row">
                <div class="col-12 pb-2 text-center">
                    <img src="img/logosmk12.png" style="width:50px;height:50px">
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

    <!-- Modal ganti carousel login -->
    <div class="modal fade" id="ganti_carousel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="gantiCarousel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="gantiCarousel">Ganti Gambar Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="mb-2">
                            <label for="foto" class="form-label">Pilih Foto <span style="font-size:13px;"> (maksimal 5 foto)</span></label>
                            <input type="file" class="form-control" id="foto" name="foto[]" multiple autocomplete="off" autofocus>
                        </div>
                        <div>
                            <?php $foto = explode(',', $carousel["isi_komponen"]); ?>
                            <?php foreach ($foto as $img) : ?>
                                <img src="img/<?= $img; ?>" alt="" width="70px" height="80px" alt="none">
                            <?php endforeach; ?>
                        </div>
                        <div class="modal-footer mt-2">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary" name="ubah_carousel">Ubah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal ganti foto index -->
    <div class="modal fade" id="ganti_foto_index" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="gantiFotoIndex" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="gantiFotoIndex">Ganti Gambar Beranda</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="mb-2">
                            <label for="foto" class="form-label">Pilih Foto <span style="font-size:13px;"> (maksimal 5 foto)</span></label>
                            <input type="file" class="form-control" id="foto" name="foto[]" multiple autocomplete="off" autofocus>
                        </div>
                        <div>
                            <?php $foto = explode(',', $foto_index["isi_komponen"]); ?>
                            <?php foreach ($foto as $img) : ?>
                                <img src="img/<?= $img; ?>" alt="" width="70px" height="80px" alt="none">
                            <?php endforeach; ?>
                        </div>
                        <div class="modal-footer mt-2">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary" name="ubah_fotoIndex">Ubah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal ganti foto index -->
    <div class="modal fade" id="ganti_foto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="gantiFoto" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="gantiFoto">Ganti Foto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="mb-2">
                            <label for="foto" class="form-label">Pilih Foto <span style="font-size:13px;"> (maksimal 5 foto)</span></label>
                            <input type="file" class="form-control" id="foto" name="foto[]" multiple autocomplete="off" autofocus>
                        </div>
                        <div>
                            <?php foreach ($foto as $img) : ?>
                                <img src="../../img/<?= $img; ?>" alt="" width="70px" height="80px">
                            <?php endforeach; ?>
                        </div>
                        <div class="modal-footer mt-2">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary" name="ubah_foto">Ubah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="js/bootstrap.js"></script>
</body>

</html>