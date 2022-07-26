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
    $osis = "hidden";
} else {
    $osis = "";
}

if(isset($_SESSION["siswa"])) {
    header("Location: ./php/data_siswa.php?id=" . $_SESSION["id_siswa"]);
}

include('./functions.php');

$pelanggaran_siswa = query("SELECT * FROM pelanggaran_siswa");
if(empty($pelanggaran_siswa)){$kosong = true;}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pelanggaran</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/umum.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light border-bottom">
        <div class="container-lg">
            <a href="../index.php" class="navbar-brand align-items-center ">
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
                        <a href="../index.php" class="nav-link">Beranda</a>
                    </li>
                    <li class="navbar-item">
                        <a href="./siswa.php" class="nav-link">Siswa</a>
                    </li>
                    <li class="navbar-item">
                        <a href="./guru.php" class="nav-link" <?= $guru; ?><?= $osis; ?>>Guru</a>
                    </li>
                    <li class="navbar-item">
                        <a href="./ktnpelanggaran.php" class="nav-link">Ketentuan Pelanggaran</a>
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
        <div class="container-lg">
            <div class="my-4">
                <h1 class="text-center">Laporan Pelanggaran Siswa</h1>
            </div>

            <div>
                <form action="cari_plgr.php" method="post">
                    <div class="d-flex align-items-center">
                        <label class="me-1" for="tanggal" class="form-label">Tanggal :</label>
                        <input class="me-1" type="date" id="tanggal" name="tanggal" autofocus autocomplete="off" class="form-control">
                        <button class="btn btn-sm btn-success" type="submit">Cari</button>
                    </div>
                </form>
            </div>

            <div id="laporan">
                <?php
                    if(isset($_POST["tanggal"])) {$tanggal = $_POST["tanggal"];} else {$tanggal = date("Y-m-d");}
                    $plgr_siswa = query("SELECT * FROM pelanggaran_siswa WHERE waktu_pelanggaran = '$tanggal'");
                ?>
            <?php if(isset($kosong)) : ?>
                <h4 class="text-center text-muted">Tidak Ada Data!</h4>
            <?php else : ?>
                <div class="table-responsive-sm">
                    <table border="1" cellpadding="10" cellspacing="0" class="table table-bordered table-hover text-center">
                        <thead class="table-light">
                            <th>No.</th>
                            <th>Tanggal</th>
                            <th>Nama Pelanggar</th>
                            <th>Pelanggaran</th>
                            <th>Poin Berkurang</th>
                            <th>Petugas</th>
                            <!-- <th><i class="bi bi-caret-down-fill"></i></th> -->
                        </thead>
                        <tbody>
                            <?php $nomor = 1; ?>
                            <?php foreach($plgr_siswa as $plgr) :?>
                                <tr>
                                    <td><?= $nomor++; ?></td>
                                    <td><?= date("d-m-Y", strtotime($plgr["waktu_pelanggaran"])); ?></td>
                                    <td>
                                        <?php $nama = mysqli_query($conn, "SELECT nama_siswa FROM siswa WHERE id_siswa = ". $plgr["id_pelanggar"])->fetch_assoc(); ?>
                                        <?= $nama["nama_siswa"]; ?>
                                    </td>
                                    <td>
                                        <?php $id_pelanggaran = $plgr["id_pelanggaran"]; ?>
                                        <?php $pelanggaran = query("SELECT det_pelanggaran FROM ket_pelanggaran WHERE id_pelanggaran in ($id_pelanggaran)"); ?>
                                        <ol>
                                            <?php foreach($pelanggaran as $data): ?>
                                            <li>
                                                <?= $data["det_pelanggaran"]; ?>
                                            </li>    
                                            <?php endforeach; ?>
                                        </ol>
                                    </td>
                                    <td>
                                        <?= $plgr["poin_berkurang"]; ?>
                                    </td>
                                    <td>
                                        <?php $id_pelapor = $plgr["id_pelapor"]; ?>
                                        <?php if(strlen($id_pelapor) === 5 ) :?>
                                            <?php $pelapor = mysqli_query($conn, "SELECT nama_siswa FROM siswa WHERE nis = $id_pelapor")->fetch_assoc(); ?>
                                            <?= $pelapor["nama_siswa"]; ?>
                                        <?php else : ?>
                                            <?php $pelapor = mysqli_query($conn, "SELECT nama_guru FROM guru_pembina WHERE nip = $id_pelapor")->fetch_assoc(); ?>
                                            <?= $pelapor["nama_guru"]; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>

                                                    
            </div>
            
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
            <p style="text-align:center; font-size:15px">&copy; Copyright 2022, OSIS SMK NEGERI 12 JAKARTA</p>
        </div>
    </footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>

<script>
    const tanggal = $("#tanggal").val();

    $.ajax({
        type: "POST",
        dataType: "html",
        url: "./data_laporan.php",
        data: "tanggal=" + tanggal,
        success: function(data) {
            $("#laporan").html(data);
        }
    });
</script>
