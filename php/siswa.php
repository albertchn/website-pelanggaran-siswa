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
    header("Location: ./data_siswa.php?id=" . $_SESSION["id_siswa"]);
}

require 'functions.php';

$siswa_sekolah = query("SELECT siswa.id_siswa, siswa.id_kelas, siswa.id_jurusan, siswa.nis, siswa.nama_siswa, siswa.jmlh_poin, kelas.nama_kelas FROM siswa INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas ORDER BY jmlh_poin , nama_kelas  LIMIT 72");
$kelas_sekolah = query("SELECT * FROM kelas");

if(isset($_POST["tambah"])) {
    if(tambah_siswa($_POST) > 0) {
        echo "<script>
              alert('Data berhasil ditambahkan!');
            //   document.location.href = './siswa.php';
              </script>";
    } else {
        echo "<script>
              document.location.href = './siswa.php';
              </script>";
    }

}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siswa | SMKN 12 JAKARTA</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../js/siswa.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/siswa.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light border-bottom">
        <div class="container-lg">
            <a href="./../index.php" class="navbar-brand align-items-center ">
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
                        <a href="./siswa.php" class="nav-link active">Siswa</a>
                    </li>
                    <li class="navbar-item">
                        <a href="./guru.php" class="nav-link" <?= $guru; ?><?= $osis; ?>>Guru</a>
                    </li>
                    <li class="navbar-item">
                        <a href="./ktnpelanggaran.php" class="nav-link">Ketentuan Pelanggaran</a>
                    </li>
                    <li class="nav-item dropdown mt-1" id="navdd">
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
    
    <section class="mt-4">
        <div class="container-lg">
            <div class="row mb-4">
                <div class="col-12">
                    <h1 class="text-center">Daftar Siswa</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-8 col-md-6">
                    
                    <botton class="btn btn-primary fw-bold mb-2" data-bs-toggle="modal" data-bs-target="#tambah_siswa" <?= $osis; ?>>Tambah Siswa Baru</botton>

                    <form action="" method="post" class="form-cari mt-3">
                        <input type="text" name="keyword" placeholder="Cari ...." autofocus autocomplete="off" class="keyword form-control mt-2">
                    </form>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="tambah_siswa" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="tambahSiswa" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahSiswa">Tambah Siswa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="">
                                <label for="kelas" class="form-label">Kelas</label>
                                <select name="kelas" id="kelas" class="form-select form-select-sm slt_width" required>
                                    <option>Pilih kelas</option>
                                    <?php foreach($kelas_sekolah as $kelas) : ?>
                                    <option value="<?= $kelas["id_kelas"]; ?>"><?= $kelas["nama_kelas"]; ?></option>

                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mt-2">
                                <label for="jurusan" class="form-label">Jurusan</label>
                                <select name="jurusan" id="jurusan" class="form-select form-select-sm slt_width" disabled required>
                                    <option>Pilih jurusan</option>
                                </select>
                            </div>
                            <div class="mt-2">
                                <label for="nis" class="form-label">NIS</label>
                                <input type="number" class="form-control" id="nis" placeholder="5 digit" name="nis" required autocomplete="off" autofocus>
                            </div>
                            <div class="mt-2">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama" name="nama" required placeholder="nama lengkap" autocomplete="off">
                            </div>
                            <div class="mt-2">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required placeholder="email@gmail.com" autocomplete="off">
                            </div>
                            <div class="mt-2">
                                <label for="foto" class="form-label">Foto</label>
                                <input type="file" class="form-control" id="foto" name="foto">
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

    <section>
        <div class="container-lg mt-3" id="container_siswa">
            <div class="table-responsive-sm">
                <table border="1" cellpadding="10" cellspacing="0" class="table table-bordered table-hover text-center">
                    <thead class="table-light">
                        <th>No.</th>
                        <th <?= $osis; ?>>NIS</th>
                        <th>Nama</th>
                        <th>Poin</th>
                        <th>Kelas</th>
                    </thead>
                    <?php $i = 1; ?>
                    <?php foreach( $siswa_sekolah as $siswa) : ?>
                    <?php $jurusan = query("SELECT kode_jurusan FROM jurusan WHERE id_jurusan=". $siswa['id_jurusan'])[0];
                        $jmlh_poin = intval($siswa["jmlh_poin"]);
                    ?>
                    <tbody>
                        <th><?= $i; ?></th>
                        <td <?= $osis; ?>><?= $siswa["nis"]; ?><?= $osis; ?></td>
                        <td class="text-start ps-3"><a href="./data_siswa.php?id=<?= $siswa["id_siswa"]; ?>"><?= $siswa["nama_siswa"]; ?></a></td>
                        <td>
                            <?php if($jmlh_poin > 0 ) : ?>
                                <?= $siswa["jmlh_poin"]; ?>
                            <?php else : ?>
                                    Drop Out
                            <?php endif; ?>
                        </td>
                        <td><?= $siswa["nama_kelas"]; ?> <?= $jurusan["kode_jurusan"]; ?></td>
                    </tbody>
                    <?php $i++ ?>
                    <?php endforeach; ?>
                </table>
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

<script>
    $("#kelas").change(function(){
         // value kelas
         const id_kelas = $("#kelas").val();

        // hapus attribute disable
        $("#jurusan").removeAttr("disabled")

        // mengirim value dan menerima data
        $.ajax({
            type: "POST",
            dataType: "html",
            url: "./data_lapor.php",
            data: "kelas="+id_kelas,
            success: function(data){
                 $("#jurusan").html(data);
            }
        });
    });
</script>

</body>
</html>