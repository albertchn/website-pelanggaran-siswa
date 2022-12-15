<?php
session_start();

if (!isset($_SESSION["login"])) {
    header('Location: ./login.php');
    exit;
}

if (isset($_SESSION["guru"])) {
    $guru = "hidden";
} else {
    $guru = "";
}

if (isset($_SESSION["osis"])) {
    $osis = "hidden";
} else {
    $osis = "";
}

if (isset($_SESSION["siswa"])) {
    header("Location: data_siswa.php?id=" . $_SESSION["id_siswa"]);
}

include('./functions.php');

$pelanggaran_siswa = query("SELECT * FROM pelanggaran_siswa");
if (empty($pelanggaran_siswa)) {
    $kosong = true;
}

if (isset($_POST["tgl_plgr"])) {
    $tgl_plgr = $_POST["tanggal"];
    $plgr_siswa = query("SELECT * FROM pelanggaran_siswa WHERE waktu_pelanggaran = '$tgl_plgr'");
} else {
    $tgl_plgr = date("Y-m-d");
    $plgr_siswa = query("SELECT * FROM pelanggaran_siswa WHERE waktu_pelanggaran = '$tgl_plgr'");
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pelanggaran</title>
    <script src="../js/ajax.js"></script>
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
                        <a href="../index.php" class="nav-link">Beranda</a>
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

    <section>
        <div class="container-lg">
            <div class="my-4">
                <h1 class="text-center">Laporan Pelanggaran Siswa</h1>
            </div>

            <div class="row">
                <div class="col-6">
                    <form action="" method="post">
                        <div class="d-flex align-items-center">
                            <label class="me-1" for="tanggal" class="form-label">Tanggal :</label>
                            <input class="me-1" type="date" id="tanggal" name="tanggal" autocomplete="off" class="form-control" value="<?= $tgl_plgr; ?>">
                            <button class="btn btn-sm btn-success" type="submit" name="tgl_plgr">Cari</button>
                            <!-- <a href="export.php?tanggal=<?= $tgl_plgr; ?>" class="btn btn-sm btn-info fw-bold">Ekspor PDF</a> -->
                        </div>
                    </form>
                </div>
                <div class="col-6 text-end">
                    <button class="btn btn-sm btn-info fw-bold" data-bs-toggle="modal" data-bs-target="#ekspor">Ekspor PDF</button>
                </div>
            </div>

            <div id="laporan" class="mt-4">
                <?php if (isset($kosong)) : ?>
                    <h4 class="text-center text-muted">Tidak Ada Data!</h4>
                <?php else : ?>
                    <div class="table-responsive-md">
                        <table border="1" cellpadding="10" cellspacing="0" class="table table-bordered table-hover text-center">
                            <thead class="table-light">
                                <th class="align-middle" style="min-width: 40px">No.</th>
                                <th class="align-middle" style="min-width: 100px">Tanggal</th>
                                <th class="align-middle" style="min-width: 150px">Nama Pelanggar</th>
                                <th class="align-middle" style="min-width: 500px">Pelanggaran</th>
                                <th class="align-middle" style="min-width: 40px">Poin Berkurang</th>
                                <th class="align-middle" style="min-width: 150px">Petugas</th>
                                <!-- <th><i class="bi bi-caret-down-fill"></i></th> -->
                            </thead>
                            <tbody>
                                <?php $nomor = 1; ?>
                                <?php foreach ($plgr_siswa as $plgr) : ?>
                                    <tr>
                                        <td class="align-middle"><?= $nomor++; ?></td>
                                        <td class="align-middle"><?= date("d-m-Y", strtotime($plgr["waktu_pelanggaran"])); ?></td>
                                        <td class="align-middle">
                                            <?php $nama = mysqli_query($conn, "SELECT nama_siswa FROM siswa WHERE id_siswa = " . $plgr["id_pelanggar"])->fetch_assoc(); ?>
                                            <?= $nama["nama_siswa"]; ?>
                                        </td>
                                        <td class="align-middle">
                                            <?php $id_pelanggaran = $plgr["id_pelanggaran"]; ?>
                                            <?php $pelanggaran = query("SELECT det_pelanggaran FROM ket_pelanggaran WHERE id_pelanggaran IN ($id_pelanggaran)"); ?>
                                            <ol>
                                                <?php foreach ($pelanggaran as $data) : ?>
                                                    <li class="text-start">
                                                        <?= $data["det_pelanggaran"]; ?>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ol>
                                        </td>
                                        <td class="align-middle">
                                            <?= $plgr["poin_berkurang"]; ?>
                                        </td>
                                        <td class="align-middle">
                                            <?php $id_pelapor = $plgr["id_pelapor"]; ?>
                                            <?php if (strlen($id_pelapor) === 5) : ?>
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

    <footer class="pt-4 border-top bg-light" style="margin-top: 130px;">
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

    <!-- Modal ekspor -->
    <div class="modal fade" id="ekspor" tabindex="-1" aria-labelledby="EksporPDF" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="EksporPDF">Ekspor PDF</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="exportmpdf.php" method="post">
                        <div class="mb-3">
                            <label for="tanggalAwal" class="form-label">Tanggal Awal</label>
                            <input type="date" id="tanggalAwal" class="form-control" name="tanggalAwal" required>
                        </div>
                        <div class="mb-3">
                            <label for="tanggalAkhir" class="form-label">Tanggal Akhir</label>
                            <input type="date" id="tanggalAkhir" class="form-control" name="tanggalAkhir" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="ekspor">Ekspor</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/bootstrap.js"></script>
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