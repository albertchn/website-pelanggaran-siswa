<?php
session_start();

if ( !isset($_SESSION["login"]) ) {
    header ('Location: ./php/login.php');
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

$kelas_sekolah = query("SELECT * FROM kelas");
$ket_pelanggaran_kedisiplinan = query("SELECT * FROM ket_pelanggaran WHERE jenis_pelanggaran='kedisiplinan'");
$ket_pelanggaran_kerapian = query("SELECT * FROM ket_pelanggaran WHERE jenis_pelanggaran='kerapian'");
$ket_pelanggaran_kelengkapan = query("SELECT * FROM ket_pelanggaran WHERE jenis_pelanggaran='kelengkapan'");

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lapor | SMKN 12 JAKARTA</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./../css/siswa.css">
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

    <section class="mt-3">
        <div class="container-lg">
            <h2 class="text-center mb-4">Laporkan Pelanggaran</h2>

            <form action="" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="kelas" class="form-label">Kelas</label>
                            <select name="kelas" id="kelas" class="form-select form-select-sm slt_width" required>
                                <option>Pilih kelas</option>
                                <?php foreach($kelas_sekolah as $kelas) : ?>
                                <option value="<?= $kelas["id_kelas"]; ?>"><?= $kelas["nama_kelas"]; ?></option>

                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="jurusan" class="form-label">Jurusan</label>
                            <select name="jurusan" id="jurusan" class="form-select form-select-sm slt_width" disabled required>
                                <option>Pilih jurusan</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Siswa</label>
                            <select name="nama" id="nama" class="form-select form-select-sm slt_width" required disabled>
                                <option>Pilih nama siswa</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="pelanggaran1" class="form-label">Pelanggaran 1</label>
                            <select name="pelanggaran1" id="pelanggaran1" class="form-select form-select-sm slt_width" required>
                                <option value="">Pilih pelanggaran</option>
                                <optgroup label="Kedisiplinan">
                                    <?php foreach($ket_pelanggaran_kedisiplinan as $kedisiplinan) : ?>
                                    <option value="<?= $kedisiplinan["id_pelanggaran"]; ?>"><?= $kedisiplinan["det_pelanggaran"]; ?></option>
                                    <?php endforeach; ?>
                                </optgroup>
                                <optgroup label="Kerapian">
                                    <?php foreach($ket_pelanggaran_kerapian as $kerapian) : ?>
                                    <option value="<?= $kerapian["id_pelanggaran"]; ?>"><?= $kerapian["det_pelanggaran"]; ?></option>
                                    <?php endforeach; ?>
                                </optgroup>
                                <optgroup label="Kelengkapan">
                                    <?php foreach($ket_pelanggaran_kelengkapan as $kelengkapan) : ?>
                                    <option value="<?= $kelengkapan["id_pelanggaran"]; ?>"><?= $kelengkapan["det_pelanggaran"]; ?></option>
                                    <?php endforeach; ?>
                                </optgroup>
                            </select>
                        </div>

                        <div class="mb-3" id="plgr2" hidden>
                            <label for="pelanggaran2" class="form-label">Pelanggaran 2</label>
                            <select name="pelanggaran2" id="pelanggaran2" class="form-select form-select-sm slt_width">
                                <option value="">Pilih pelanggaran</option>
                                <optgroup label="Kedisiplinan">
                                    <?php foreach($ket_pelanggaran_kedisiplinan as $kedisiplinan) : ?>
                                    <option value="<?= $kedisiplinan["id_pelanggaran"]; ?>"><?= $kedisiplinan["det_pelanggaran"]; ?></option>
                                    <?php endforeach; ?>
                                </optgroup>
                                <optgroup label="Kerapian">
                                    <?php foreach($ket_pelanggaran_kerapian as $kerapian) : ?>
                                    <option value="<?= $kerapian["id_pelanggaran"]; ?>"><?= $kerapian["det_pelanggaran"]; ?></option>
                                    <?php endforeach; ?>
                                </optgroup>
                                <optgroup label="Kelengkapan">
                                    <?php foreach($ket_pelanggaran_kelengkapan as $kelengkapan) : ?>
                                    <option value="<?= $kelengkapan["id_pelanggaran"]; ?>"><?= $kelengkapan["det_pelanggaran"]; ?></option>
                                    <?php endforeach; ?>
                                </optgroup>
                            </select>
                        </div>

                        <div class="my-2 text-center">
                            <?php $no="2" ?>
                            <button type="button" class="btn btn-outline-primary rounded" onclick="tambahPelanggaran2()" id="btn_plgr2">+</button>
                        </div>

                        <div class="mb-3" id="plgr3" hidden>
                            <label for="pelanggaran3" class="form-label">Pelanggaran 3</label>
                            <select name="pelanggaran3" id="pelanggaran3" class="form-select form-select-sm slt_width">
                                <option value="">Pilih pelanggaran</option>
                                <optgroup label="Kedisiplinan">
                                    <?php foreach($ket_pelanggaran_kedisiplinan as $kedisiplinan) : ?>
                                    <option value="<?= $kedisiplinan['id_pelanggaran']; ?>"><?= $kedisiplinan['det_pelanggaran']; ?></option>
                                    <?php endforeach; ?>
                                </optgroup>
                                <optgroup label="Kerapian">
                                    <?php foreach($ket_pelanggaran_kerapian as $kerapian) : ?>
                                    <option value="<?= $kerapian['id_pelanggaran']; ?>"><?= $kerapian['det_pelanggaran']; ?></option>
                                    <?php endforeach; ?>
                                </optgroup>
                                <optgroup label="Kelengkapan">
                                    <?php foreach($ket_pelanggaran_kelengkapan as $kelengkapan) : ?>
                                    <option value="<?= $kelengkapan['id_pelanggaran']; ?>"><?= $kelengkapan['det_pelanggaran']; ?></option>
                                    <?php endforeach; ?>
                                </optgroup>
                            </select>
                        </div>

                        <div class="my-2 text-center">
                            <button type="button" class="btn btn-outline-primary rounded d-none" onclick="tambahPelanggaran3()" id="btn_plgr3">+</button>
                        </div>

                    </div>
                </div>
                
                <div class="mt-2">
                    <button type="submit" name="submit" class="btn btn-warning">Laporkan</button>
                </div>
            </form>
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
<script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
<script src="../js/lapor.js"></script>
<script src="../js/action.js"></script>
<script>
    <?php
    if(isset($_POST['submit'])) {
        $id_pelanggaran1= $_POST["pelanggaran1"];
        $id_pelanggaran2= $_POST["pelanggaran2"];
        $id_pelanggaran3= $_POST["pelanggaran3"];
            
        $poin_pelanggaran1 = query("SELECT poin_pelanggaran FROM ket_pelanggaran WHERE id_pelanggaran=$id_pelanggaran1")[0]["poin_pelanggaran"];

        if(!empty($_POST["pelanggaran2"])) {
            $poin_pelanggaran2 = query("SELECT poin_pelanggaran FROM ket_pelanggaran WHERE id_pelanggaran=$id_pelanggaran2")[0]["poin_pelanggaran"];
        } else {$poin_pelanggaran2=0;}
        
        if(!empty($_POST["pelanggaran3"])) {
            $poin_pelanggaran3 = query("SELECT poin_pelanggaran FROM ket_pelanggaran WHERE id_pelanggaran=$id_pelanggaran3")[0]["poin_pelanggaran"];
        } else {$poin_pelanggaran3=0;}

        $poin1 = intval($poin_pelanggaran1);
        $poin2 = intval($poin_pelanggaran2);
        $poin3 = intval($poin_pelanggaran3);

        $poin = $poin1+$poin2+$poin3;
        if(lapor($_POST, $poin) > 0 ) echo "berhasil()";
        else echo "gagal()";
        // else echo mysqli_error($conn);
    } 
    ?>
</script>
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

    $("#jurusan").change(function(){
        // value jurusan
        const id_jurusan = $("#jurusan").val();
        const id_kelas = $("#kelas").val();

        // hapus attribute disable
        $("#nama").removeAttr("disabled")

        // mengirim value dan menerima data
        $.ajax({
            type: "POST",
            dataType: "html",
            url: "./data_lapor.php",
            data: "jurusan="+id_jurusan,
            success: function(data){
                 $("#nama").html(data);
            }
        });

    });
</script>
</body>
</html>