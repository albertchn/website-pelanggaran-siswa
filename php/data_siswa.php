<?php
session_start();

if ( !isset($_SESSION["login"]) ) {
    header ('Location: ./login.php');
    exit;
}

if(isset($_SESSION["guru"])) {
    $guru = "hidden";
} else {
    $guru = "";
}

if(isset($_SESSION["osis"])) {
    header("Location: ./siswa.php");
}

if(isset($_SESSION["siswa"])) {
    $siswa = "hidden";
    $link = "";
} else {
    $link = "./../index.php";
    $siswa = "";
}

include('./functions.php');
$id = $_GET["id"];

$siswa = query("SELECT `id_kelas`, `id_jurusan`, `nis`, `nama_siswa`, `email`, `jmlh_poin`, `foto` FROM siswa WHERE id_siswa = $id")[0];
$kelas = query("SELECT nama_kelas FROM kelas WHERE id_kelas =" .$siswa["id_kelas"])[0];
$jurusan = query("SELECT nama_jurusan FROM jurusan WHERE id_jurusan = " .$siswa["id_jurusan"])[0];
// $pelanggaran_siswa = query("SELECT * FROM pelanggaran_siswa WHERE id_pelanggar = $id");
// if(!$pelanggaran_siswa) {
//     $anak_baik = true;
// }
// else {
//     $pelanggaran1 = query("SELECT * FROM ket_pelanggaran WHERE id_pelanggaran = " .$pelanggaran_siswa[0]["id_pelanggaran1"])[0];
//     $pelanggaran2 = mysqli_query($conn, "SELECT * FROM ket_pelanggaran WHERE id_pelanggaran = " .$pelanggaran_siswa[0]["id_pelanggaran2"]);
//     if(mysqli_num_rows($pelanggaran2) > 0) {
//         $pelanggaran2 = mysqli_fetch_assoc($pelanggaran2);
//         $show_plgr2 = true;
//         $poin2 = $pelanggaran2["poin_pelanggaran"];
//     } else {
//         $pelanggaran2 = '';
//         $poin2 = 0;
        
//     }
//     var_dump($pelanggaran1);
//     var_dump($pelanggaran2);
//     exit;
//     $pelanggaran3 = mysqli_query($conn, "SELECT * FROM ket_pelanggaran WHERE id_pelanggaran = " .$pelanggaran_siswa[0]["id_pelanggaran3"]);
//     if(mysqli_num_rows($pelanggaran3) > 0) {
//         $pelanggaran3 = mysqli_fetch_assoc($pelanggaran3);
//         $show_plgr3 = true;
//         $poin3 = $pelanggaran3["poin_pelanggaran"];
//     } else {
//         $pelanggaran3 = '';
//         $poin3 = 0;
//     }
//     $poin1 = $pelanggaran1["poin_pelanggaran"];
//     $min_poin = $poin1+$poin2+$poin3;   
// }




?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=3.0">
    <title>Data Siswa | <?= $siswa["nama_siswa"]; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/siswa.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light border-bottom">
        <div class="container-lg">
            <a href="<?= $link; ?>" class="navbar-brand align-items-center ">
                <img src="./../img/logosmk12.png" style="width:50px;height:50px">
                <h5 class=" ms-1 d-inline">OSIS SMKN 12 JAKARTA</h5>
            </a>    

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav"
            aria-controls="main-nav" aria-expanded="false" aria-label="Toggle Navigation">
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
                        <a href="./guru.php" class="nav-link" <?= $guru; ?>>Guru</a>
                    </li>
                    <li class="navbar-item">
                        <a href="./ktnpelanggaran.php" class="nav-link active">Ketentuan Pelanggaran</a>
                    </li>
                    <li class="nav-item dropdown mt-1">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="d-md-none">Menu</span><i class="bi bi-three-dots-vertical"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <?php if ( isset($_SESSION["login"]) ) : ?>
                                    <a href="./logout.php" class="dropdown-item">Keluar</a>
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
            <h1 class="text-center fs-2">Data Siswa</h1>
        </div>
        <div class="container-lg">
            <div class="mb-2 ms-2">
                <a href="./ubah/ubah_siswa.php?id=<?= $id; ?>" class="btn btn-primary btn-sm">Ubah data</a>
                <a href="./hapus/hapus_siswa.php?id=<?= $id; ?>" onclick="return confirm('Hapus data?')" class="btn btn-danger btn-sm ms-2">Hapus Data</a>
            </div>
            <div class="row">
                <div class="col-md-8">

                    <table border="0" class="table table-borderless fs-6">
                        <tbody>
                            <tr>
                                <td style="width: 165px;">Nama</td>
                                <td style="width: 10px;">:</td>
                                <td style="width: 400px;"><?= $siswa["nama_siswa"]; ?></td>
                            </tr>
                            <tr>
                                <td>Kelas</td>
                                <td>:</td>
                                <td><?= $kelas["nama_kelas"]; ?></td>
                            </tr>
                            <tr>
                                <td>Jurusan</td>
                                <td>:</td>
                                <td><?= $jurusan["nama_jurusan"]; ?></td>
                            </tr>
                            <tr>
                                <td>email</td>
                                <td>:</td>
                                <td><?= $siswa["email"]; ?></td>
                            </tr>
                            <tr>
                                <td>Poin dimiliki</td>
                                <td>:</td>
                                <td><?= $siswa["jmlh_poin"]; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-4">
                    <img src="./../foto_siswa/<?= $siswa["foto"]; ?>" width="150" height="150" class="img-fluid d-none d-md-block" title="<?= $siswa["nama_siswa"]; ?>">
                </div>
            </div>
        </div>
    </section>

    <section class="mt-4">
        <div class="container-fluid  mb-4 bg-warning p-1">
            <h1 class="text-center fs-2">Pelanggaran</h1>
        </div>

        <!-- <div class="container-lg">
            <?php if(isset($anak_baik)) : ?>
                <p class="fs-5"><?= ucwords($siswa["nama_siswa"]); ?> anak baik-baik!</p>
            <?php endif; ?>
            <ol>
            <?php foreach($pelanggaran_siswa as $plgr) :?>
                <li style="line-height: 5px;">
                    <p>Tanggal : <b class="ms-1"><?= $plgr["waktu_pelanggaran"]; ?></b></p>
                    <p>Pelanggaran :</p>
                    <div class="row">
                        <div class="col">
                            <ul style="line-height: 17px;">
                                <li>
                                    <p><?= $pelanggaran1["jenis_pelanggaran"]; ?> : <?= $pelanggaran1["det_pelanggaran"]; ?></p>
                                </li>
                                <?php if(isset($show_plgr2)) :?>
                                <li>
                                    <p><?= $pelanggaran2["jenis_pelanggaran"]; ?> : <?= $pelanggaran2["det_pelanggaran"]; ?></p>
                                </li>
                                <?php endif; ?>
                                <?php if(isset($show_plgr3)) :?>
                                <li>
                                    <p><?= $pelanggaran3["jenis_pelanggaran"]; ?> : <?= $pelanggaran3["det_pelanggaran"]; ?></p>    
                                </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                    <p class="mb-4">Poin berkurang : -<?= $min_poin; ?></p>
                </li>
            <?php endforeach; ?>
            </ol>
        </div> -->
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
            <p style="text-align:center; font-size:15px">&copy; Copyright 2022, OSIS SMK NEGERI 12 JAKARTA</p>
        </div>
    </footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>