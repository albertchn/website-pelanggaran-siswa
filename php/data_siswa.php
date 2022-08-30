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
    header("Location: ./siswa.php");
}

if (isset($_SESSION["siswa"])) {
    $hide_siswa = "hidden";
    $link = "./data_siswa.php?id=" . $_SESSION["id_siswa"];
    $username = $_SESSION["nis"];
} else {
    $hide_siswa = "";
    $link = "./../index.php";
}

if (isset($_SESSION["admin"])) {
    $admin = "hidden";
} else {
    $admin = "";
}

include('./functions.php');
$id = $_GET["id"];

if (!$id) {
    header("Location: ./guru.php");
}

$siswa = query("SELECT `id_kelas`, `id_jurusan`, `nis`, `nama_siswa`, `jmlh_poin`, `role`,`foto` FROM siswa WHERE id_siswa = $id")[0];
$kelas = query("SELECT nama_kelas FROM kelas WHERE id_kelas =" . $siswa["id_kelas"])[0];
$jurusan = query("SELECT nama_jurusan FROM jurusan WHERE id_jurusan = " . $siswa["id_jurusan"])[0];
$pelanggaran_siswa = query("SELECT * FROM pelanggaran_siswa WHERE id_pelanggar = $id");
$prestasi_siswa  = query("SELECT * FROM prestasi_siswa WHERE id_siswa = $id");
$ket_prestasi = query("SELECT * FROM ket_prestasi");

if (isset($_POST["tambah_prestasi"])) {
    if (tambah_prestasi($_POST, $id) > 0) {
        echo "<script>
        alert('Data berhasil ditambahkan!');
        document.location.href = 'data_siswa.php?id=" . $id . "';
        </script>";
    } else {
        echo "<script>
        alert('Data gagal ditambahkan!');
        document.location.href = 'data_siswa.php?id=" . $id . "';
        </script>";
    }
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa | <?= $siswa["nama_siswa"]; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/umum.css">
    <link rel="icon" href="../img/logosmk12.png">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light border-bottom">
        <div class="container-lg">
            <a href="<?= $link; ?>" class="navbar-brand align-items-center ">
                <img src="./../img/logosmk12.png" style="width:50px;height:50px">
                <h5 class=" ms-1 d-inline">OSIS SMKN 12 JAKARTA</h5>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav" aria-controls="main-nav" aria-expanded="false" aria-label="Toggle Navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end align-items-center" id="main-nav">
                <ul class="navbar-nav">
                    <li class="navbar-item">
                        <a href="./../index.php" class="nav-link" <?= $hide_siswa; ?>>Beranda</a>
                    </li>
                    <li class="navbar-item">
                        <a href="./siswa.php" class="nav-link active" <?= $hide_siswa; ?>>Siswa</a>
                    </li>
                    <li class="navbar-item">
                        <a href="./guru.php" class="nav-link" <?= $guru; ?><?= $hide_siswa; ?>>Guru</a>
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
                                    <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ganti_pw" <?= $guru; ?><?= $admin; ?>>Ganti Password</a>
                                    <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ganti_foto" <?= $guru; ?>>Ganti Foto</a>
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
            <div class="row align-items-center">
                <div class="col-md-8">

                    <table border="0" class="table table-borderless fs-6">
                        <tbody>
                            <tr>
                                <td style="width: 165px;">Nama</td>
                                <td style="width: 10px;">:</td>
                                <td style="width: 400px;"><?= $siswa["nama_siswa"]; ?></td>
                            </tr>
                            <tr>
                                <td>NIS</td>
                                <td>:</td>
                                <td><?= $siswa["nis"]; ?></td>
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
                                <td>Poin dimiliki</td>
                                <td>:</td>
                                <td><?= $siswa["jmlh_poin"]; ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="mb-2 ms-2">
                        <a href="./ubah/ubah_siswa.php?id=<?= $id; ?>" class="btn btn-primary btn-sm me-2 mt-2" <?= $hide_siswa ?>>Ubah data</a>
                        <a href="./hapus/hapus_siswa.php?id=<?= $id; ?>" onclick="return confirm('Hapus data?')" class="btn btn-danger btn-sm me-2 mt-2" <?= $hide_siswa ?>>Hapus Data</a>

                        <?php if ($siswa["role"] === "siswa") : ?>
                            <a href="./ubah/ubah_role.php?role=siswa&sk=<?= $id; ?>" onclick="return confirm('Jadikan osis?')" class="btn btn-success btn-sm me-2 mt-2" <?= $hide_siswa; ?>>Jadikan OSIS</a>
                        <?php else : ?>
                            <a href="./ubah/ubah_role.php?role=osis&sk=<?= $id; ?>" onclick="return confirm('Jadikan siswa?')" class="btn btn-success btn-sm me-2 mt-2" <?= $hide_siswa; ?>>Jadikan Siswa</a>
                        <?php endif; ?>
                        <a href="" class="btn btn-warning btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#tambah_prestasi" <?= $hide_siswa; ?>>Tambah Prestasi</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <?php if (!$siswa["foto"]) : ?>
                        <img src="./../img/LOGO SMKN 12.png" width="250" height="250" class="img-fluid d-none d-md-block" title="<?= $siswa["nama_siswa"]; ?>">
                    <?php else : ?>
                        <img src="./../foto_siswa/<?= $siswa["foto"]; ?>" width="250" height="250" class="img-fluid d-none d-md-block" title="<?= $siswa["nama_siswa"]; ?>">
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <section style="min-height: 200px">
        <div class="container-fluid mt-4 mb-4 bg-warning p-1">
            <h1 class="text-center fs-2">Prestasi</h1>
        </div>
        <div class="container-lg">
            <div class="row">
                <?php if ($prestasi_siswa) :
                    foreach ($prestasi_siswa as $prestasi) {
                ?>
                        <div class="col-md-6 mb-3" style="line-height: 8px;">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-8">
                                            <h6 class="card-subtitle">Tanggal Lomba: <span class="fw-bold"><?= $prestasi["tgl_prestasi"]; ?></span></h6>
                                        </div>
                                        <div class="col-4 text-end">
                                            <a href="hapus/hapus_prestasiSiswa.php?id_prestasi=<?= $prestasi["id_prestasi_siswa"]; ?>&id_siswa=<?= $id; ?>" onclick="return confirm('Hapus Prestasi?')" <?= $hide_siswa; ?>><i class="bi bi-x-lg"></i></a>
                                        </div>
                                    </div>
                                    <p class="card-text">
                                    <p class="">Keterangan :</p>
                                    <ul class="ms-2" style="line-height: 15px;">
                                        <?php $ket = mysqli_query($conn, "SELECT det_prestasi FROM ket_prestasi WHERE id_prestasi = " . $prestasi["id_prestasi"])->fetch_assoc(); ?>
                                        <li><?= $ket["det_prestasi"]; ?></li>
                                    </ul>
                                    </p>
                                    <div class="row">
                                        <div class="col-4 col-md-2">
                                            <a href="../dokumen/<?= $prestasi["bukti"]; ?>" target="_blank">Bukti <i class="bi bi-patch-check-fill text-primary"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php else : ?>
                    <h5 class="text-muted">Kosong</h5>
                <?php endif; ?>
            </div>
    </section>

    <section class="mt-4 data-plgr">
        <div class="container-fluid  mb-4 bg-warning p-1">
            <h1 class="text-center fs-2">Pelanggaran</h1>
        </div>
        <div class="container-lg">
            <div class="row">
                <?php if ($pelanggaran_siswa) :
                    foreach ($pelanggaran_siswa as $plgr) {
                ?>
                        <div class="col-md-6 mb-3" style="line-height: 8px;">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-8">
                                            <h6 class="card-subtitle">Tanggal : <span class="fw-bold"><?= $plgr["waktu_pelanggaran"]; ?></span></h6>
                                        </div>
                                        <div class="col-4 text-end">
                                            <a href="hapus/hapus_plgrSiswa.php?id_plgr=<?= $plgr["id_pelanggaran_siswa"]; ?>&id_siswa=<?= $id; ?>&poin=<?= $plgr["poin_berkurang"]; ?>" onclick="return confirm('Hapus Pelanggaran?')" <?= $hide_siswa; ?>><i class="bi bi-x-lg"></i></a>
                                        </div>
                                    </div>
                                    <p class="card-text">
                                    <p class="">Pelanggaran :</p>
                                    <ol class="ms-2" style="line-height: 20px;margin: -10px 0 8px 0">
                                        <?php
                                        $id_plgr = $plgr["id_pelanggaran"];
                                        $pelanggaran = query("SELECT det_pelanggaran FROM ket_pelanggaran WHERE id_pelanggaran in ($id_plgr)");
                                        foreach ($pelanggaran as $det_plgr) :
                                        ?>
                                            <li><?= $det_plgr["det_pelanggaran"]; ?></li>
                                        <?php endforeach; ?>
                                    </ol>
                                    <p class="">Poin berkurang : <?= $plgr["poin_berkurang"]; ?></p>
                                    <?php
                                    if (strlen($plgr["id_pelapor"]) === 5) {
                                        $pelapor = mysqli_query($conn, "SELECT nama_siswa FROM siswa WHERE nis =" . $plgr["id_pelapor"])->fetch_assoc()["nama_siswa"];
                                    } else {
                                        $pelapor = mysqli_query($conn, "SELECT nama_guru FROM guru_pembina WHERE nip =" . $plgr["id_pelapor"])->fetch_assoc()["nama_guru"];
                                    }
                                    ?>
                                    <p class="" <?= $hide_siswa; ?>>Petugas : <?= $pelapor; ?></p>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php else : ?>
                    <h5 class="text-muted">Siswa teladan</h5>
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
            <p style="text-align:center; font-size:15px">&copy; Copyright 2022, RPL A0204</p>
        </div>
    </footer>

    <!-- Modal ganti password -->
    <div class="modal fade" id="ganti_pw" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="gantoPw" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="gantoPw">Ganti Password</h5>
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
    </div>

    <!-- Modal ganti foto -->
    <div class="modal fade" id="ganti_foto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="gantiFoto" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="gantiFoto">Ganti Foto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="./ubah/ubah_foto.php?id=<?= $id; ?>" method="post" enctype="multipart/form-data">
                        <input type="hiddden" name="fotoLama" value="<?= $siswa["foto"]; ?>">
                        <div class="">
                            <label for="foto" class="form-label">Foto</label>
                            <input type="file" class="form-control" id="foto" name="foto">
                        </div>
                        <div class="modal-footer mt-1">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary" name="ganti">Ganti</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal tambah prestasi -->
    <div class="modal fade" id="tambah_prestasi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="tambahPrestasi" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahPrestasi">Tambah Prestasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="">
                            <label for="prestasi" class="form-label">Prestasi</label>
                            <select name="prestasi" id="prestasi" class="form-select">
                                <option value="">Pilih Prestasi</option>
                                <?php foreach ($ket_prestasi as $prestasi) : ?>
                                    <option value="<?= $prestasi["id_prestasi"]; ?>"><?= $prestasi["det_prestasi"]; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mt-2">
                            <label for="tgl_lomba" class="form-label">Tanggal Prestasi</label>
                            <input type="date" id="tgl_lomba" name="tgl_prestasi" class="form-control" required autocomplete="off">
                        </div>
                        <div class="mt-2">
                            <label for="bukti" class="form-label">Bukti</label>
                            <input type="file" class="form-control" id="bukti" name="dok" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary" name="tambah_prestasi">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>