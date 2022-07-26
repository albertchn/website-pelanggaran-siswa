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
    $siswa = "hidden";
    $link = "./data_siswa.php?id=". $_SESSION["id_siswa"];
} else {
    $siswa = "";
    $link = "./../index.php";
}

if(isset($_SESSION["admin"])) {
    $admin = "hidden";
}
else {
    $admin = "";
}

include('./functions.php');

$ktnpelanggaran = query("SELECT * FROM ket_pelanggaran");

if(isset($_POST["tambah"])) {
    if(tambah_pelanggaran($_POST) > 0) {
        echo "<script>
              alert('Data berhasil ditambahkan!');
              document.location.href = './ktnpelanggaran.php';
              </script>";
    }
    else {
        echo "<script>
             alert('Data gagal ditambahkan!');
             document.location.href = './ktnpelanggaran.php';
             </script>";
    }
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ketentuan Pelanggaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/umum.css">
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
                        <a href="./../index.php" class="nav-link" <?= $siswa; ?>>Beranda</a>
                    </li>
                    <li class="navbar-item">
                        <a href="./siswa.php" class="nav-link" <?= $siswa; ?>>Siswa</a>
                    </li>
                    <li class="navbar-item">
                        <a href="./guru.php" class="nav-link" <?= $guru; ?><?= $osis; ?><?= $siswa; ?>>Guru</a>
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
        <div class="container-lg">
            <div class="my-4">
                <h1 class="text-center">Ketentuan Pelanggaran</h1>
            </div>
            <div>
                <button class="btn btn-primary fw-bold mb-3" data-bs-toggle="modal" data-bs-target="#tambah_ket" <?= $osis; ?><?= $siswa; ?>>Tambah Ketentuan Baru</button>
            </div>
            <div class="table-responsive-sm mt-3">
                <table class="table table-sm table-bordered text-center table-align-center">
                    <thead class="table-light">
                        <th>No.</th>
                        <th>Jenis Pelanggaran</th>
                        <th>Pelanggaran</th>
                        <th>Poin</th>
                        <th <?= $osis; ?><?= $siswa; ?>><i class="bi bi-caret-down-fill"></i></th>
                    </thead>
                    <?php
                        $batas = 20;
                        $halaman = isset($_GET["halaman"])?(int)$_GET["halaman"] : 1;
                        $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;
                        $previous = $halaman - 1;
                        $next = $halaman + 1;

                        $jumlah_data = count($ktnpelanggaran);
                        $total_halaman = ceil($jumlah_data/$batas);

                        $data_kntplgr = query("SELECT * FROM ket_pelanggaran LIMIT $halaman_awal, $batas");
                        $nomor = $halaman_awal+1;
                    ?>
                    <?php foreach ( $data_kntplgr as $plgr ) : ?>
                    <tbody>
                        <th><?= $nomor++; ?></th>
                        <td><?= ucwords($plgr["jenis_pelanggaran"]); ?></td>
                        <td class="text-start ps-2"><?= ucfirst($plgr["det_pelanggaran"]); ?></td>
                        <td><?= $plgr["poin_pelanggaran"]; ?></td>
                        <td style="width:3rem;" <?= $osis; ?><?= $siswa; ?>>
                            <div class="dropdown">
                                <button class="btn" type="button" id="actionMenu" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="actionMenu">
                                    <li><a class="dropdown-item" href="./hapus/hapus_plgr.php?id=<?= $plgr["id_pelanggaran"]; ?>" onclick="return confirm('Hapus data?')">Hapus</a></li>
                                    <li><a class="dropdown-item" href="./ubah/ubah_plgr.php?id=<?= $plgr["id_pelanggaran"]; ?>">Ubah</a></li>
                                </ul>
                            </div>
                        </td>
                    </tbody>    
                    <?php endforeach; ?>                                                            
                </table>
                <nav class="mt-4">
                    <ul class="pagination justify-content-center">
                        <li class="page-item">
                            <a  class="page-link text-dark" <?php if($halaman > 1){echo "href='?halaman=$previous'";} ?>><span aria-hidden="true">&laquo;</span></a>
                        </li>
                        <?php for($i=1;$i<=$total_halaman;$i++) : ?>
                            <li class="page-item">
                                <a href="?halaman=<?= $i; ?>" class="page-link text-dark"><?= $i; ?></a>
                            </li>
                        <?php endfor; ?>
                        <li class="page-item">
                            <a class="page-link text-dark" <?php if($halaman < $total_halaman){echo "href='?halaman=$next'";} ?>><span aria-hidden="true">&raquo;</span></a>
                        </li>
                    </ul>
                </nav>
            </div>

            <!-- tambah Modal -->
            <div class="modal fade" id="tambah_ket" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="taambahKetBaru" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="taambahKetBaru">Tambah Ketentuan Pelanggaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <div>
                                <label for="jenis_plgr" class="form-label">Jenis Pelanggaran</label>
                                <input type="text" class="form-control" id="jenis_plgr" placeholder="kedisiplinan, kerapian ..." name="jenis_plgr" required autocomplete="off" autofocus>
                            </div>
                            <div class="mt-2">
                                <label for="det_plgr" class="form-label">Detail Pelanggaran</label>
                                <input type="text" class="form-control" id="det_plgr" name="det_plgr" required placeholder="datang terlambat ..." autocomplete="off">
                            </div>
                            <div class="mt-2">
                                <label for="poin" class="form-label">Poin Pelanggaran</label>
                                <input type="number" class="form-control" id="poin" name="poin" required placeholder="1 / 2 / ..." autocomplete="off">
                            </div>
                            <div class="modal-footer mt-1">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary" name="tambah" >Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
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