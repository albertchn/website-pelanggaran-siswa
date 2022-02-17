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
    header("Location: ../data_siswa.php?id=" . $_SESSION["id_siswa"]);
}

require '../functions.php';

$id = $_GET["id"];

if(!$id) {
    return header("Location: ../siswa.php");
}

$siswa = query("SELECT * FROM siswa WHERE id_siswa = $id")[0];
$kelas_sekolah = query("SELECT * FROM kelas");


if(isset($_POST["ubah"])) {
    if ( ubah_siswa($_POST) > 0 ) {
        echo "
            <script>
                alert('Data berhasil diubah!')
                // redirect versi javascript
                document.location.href = '../data_siswa.php?id=" . $id . "';
                </script>
                ";
            } else {
                echo "
                <script>
                alert('Data gagal diubah!')
                // redirect versi javascript
                document.location.href = '../data_siswa.php?id=" . $id . "';
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
    <title>Ubah Data Siswa</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../css/siswa.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light border-bottom">
        <div class="container-lg">
            <a href="../../index.php" class="navbar-brand align-items-center ">
                <img src="../../img/logosmk12.png" style="width:50px;height:50px">
                <h5 class=" ms-1 d-inline">OSIS SMKN 12 JAKARTA</h5>
            </a>    

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav"
            aria-controls="main-nav" aria-expanded="false" aria-label="Toggle Navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end align-items-center" id="main-nav">
                <ul class="navbar-nav">
                    <li class="navbar-item">
                        <a href="../../index.php" class="nav-link">Beranda</a>
                    </li>
                    <li class="navbar-item">
                        <a href="../siswa.php" class="nav-link active">Siswa</a>
                    </li>
                    <li class="navbar-item">
                        <a href="../guru.php" class="nav-link" <?= $guru; ?>>Guru</a>
                    </li>
                    <li class="navbar-item">
                        <a href="../ktnpelanggaran.php" class="nav-link">Ketentuan Pelanggaran</a>
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
            <h1 class="text-center fs-2">Ketentuan Pelanggaran</h1>
        </div>
        <div class="container-lg">
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $siswa["id_siswa"]; ?>">
                <input type="hidden" name="fotoLama" value="<?= $siswa["foto"]; ?>">
                <div class="row">
                    <div class="col-md-7">
                        <div class="">
                            <label for="kelas" class="form-label">Kelas <span style="font-size: 12px" class="">(wajib isi ulang)</span></label>
                            <select name="kelas" id="kelas" class="form-select form-select-sm slt_width" required value="<?= $siswa["id_kelas"]; ?>">
                                <option value="1">Pilih kelas</option>
                                <option value="1">X</option>
                                <option value="2">XI</option>
                                <option value="3">XII</option>
                            </select>
                        </div>
                        <div class="mt-2">
                            <label for="jurusan" class="form-label">Jurusan <span style="font-size: 12px" class="">(wajib isi ulang)</span></label>
                            <select name="jurusan" id="jurusan" class="form-select form-select-sm slt_width" required value="<?= $siswa["id_jurusan"]; ?>">
                                <option value="1">Pilih jurusan</option>
                            </select>
                        </div>
                        <div class="mt-2">
                            <label for="nis" class="form-label">NIS</label>
                            <input type="number" class="form-control" id="nis" placeholder="5 digit" name="nis" required autocomplete="off" value="<?= $siswa["nis"]; ?>">
                        </div>
                        <div class="mt-2">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" name="nama" required placeholder="nama lengkap" autocomplete="off" value="<?= $siswa["nama_siswa"]; ?>">
                        </div>
                        <div class="mt-2">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required placeholder="email@gmail.com" autocomplete="off" value="<?= $siswa["email"]; ?>">
                        </div>
                        <div class="mt-2">
                            <label for="foto" class="form-label">Foto</label>
                            <div class="row align-items-center">
                                <div class="col">
                                    <input type="file" class="form-control" id="foto" name="foto">
                                </div>
                                <div class="col">
                                    <img src="../../foto_siswa/<?= $siswa["foto"]; ?>" width="50px" height="50px">
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="../data_siswa.php?id=<?= $id; ?>" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary" name="ubah" >Ubah</button>
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
            <p style="text-align:center; font-size:15px">&copy; Copyright 2022, OSIS SMK NEGERI 12 JAKARTA</p>
        </div>
    </footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script>
    $("#kelas").change(function(){
         // value kelas
         const id_kelas = $("#kelas").val();

        // hapus attribute disable
        // $("#jurusan").removeAttr("disabled")

        // mengirim value dan menerima data
        $.ajax({
            type: "POST",
            dataType: "html",
            url: "../data_lapor.php",
            data: "kelas="+id_kelas,
            success: function(data){
                 $("#jurusan").html(data);
            }
        });
    });
</script>
</body>
</html>