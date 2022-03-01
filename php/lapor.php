<?php
session_start();

if ( !isset($_SESSION["login"]) ) {
    header ('Location: ./login.php');
    exit;
}

if(isset($_SESSION["guru"])) {
    $guru = "hidden";
    $pelapor = $_SESSION["nip"];
} else {
    $guru = "";
}  

if(isset($_SESSION["osis"])) {
    $osis = "hidden";
    $pelapor = $_SESSION["nis"];
} else {
    $osis = "";
}

if(isset($_SESSION["siswa"])) {
    header("Location: ./data_siswa.php?id=" . $_SESSION["id_siswa"]);
}


require 'functions.php';

$kelas_sekolah = query("SELECT * FROM kelas");
$ket_pelanggaran_keterlambatan = query("SELECT * FROM ket_pelanggaran WHERE jenis_pelanggaran='keterlambatan'");
$ket_pelanggaran_pakaian = query("SELECT * FROM ket_pelanggaran WHERE jenis_pelanggaran='pakaian'");
$ket_pelanggaran_upacara = query("SELECT * FROM ket_pelanggaran WHERE jenis_pelanggaran='upacara'");
$ket_pelanggaran_media_elektronik = query("SELECT * FROM ket_pelanggaran WHERE jenis_pelanggaran='media elektronik'");
$ket_pelanggaran_aksesoris = query("SELECT * FROM ket_pelanggaran WHERE jenis_pelanggaran='aksesoris'");
$ket_pelanggaran_kehadiran = query("SELECT * FROM ket_pelanggaran WHERE jenis_pelanggaran='kehadiran'");
$ket_pelanggaran_lingkungan_sekolah = query("SELECT * FROM ket_pelanggaran WHERE jenis_pelanggaran='lingkungan sekolah'");
$ket_pelanggaran_mencuri = query("SELECT * FROM ket_pelanggaran WHERE jenis_pelanggaran='mencuri'");
$ket_pelanggaran_merokok = query("SELECT * FROM ket_pelanggaran WHERE jenis_pelanggaran='merokok'");
$ket_pelanggaran_pornografi = query("SELECT * FROM ket_pelanggaran WHERE jenis_pelanggaran='pornografi'");
$ket_pelanggaran_senjata_tajam = query("SELECT * FROM ket_pelanggaran WHERE jenis_pelanggaran='senjata tajam'");
$ket_pelanggaran_perkelahian = query("SELECT * FROM ket_pelanggaran WHERE jenis_pelanggaran='perkelahian / tawuran'");
$ket_pelanggaran_narkoba = query("SELECT * FROM ket_pelanggaran WHERE jenis_pelanggaran='narkoba / miras'");
$ket_pelanggaran_kepribadian = query("SELECT * FROM ket_pelanggaran WHERE jenis_pelanggaran='kepribadian'");

if(isset($_POST["submit"])) {
    if(!empty($_POST["kelas"]) && !empty($_POST["jurusan"]) && !empty($_POST["pelanggaran"][0])) {
        if($_POST["nama"] !== "Pilih nama siswa") {
            if(lapor($_POST, $pelapor) > 0 ) {
                
                echo "<script>
                        alert('Berhasil membuat laporan!');
                        document.location.href = '../index.php';
                      </script>";
            }
            else {
                echo "<script>
                        alert('Gagal membuat laporan!');
                        document.location.href = '../index.php';
                      </script>";
            }
        } else {
            echo "<script>
            alert('Semua input wajib diisi!');
            document.location.href = './lapor.php';
            </script>";
        }
    } else {
        echo "<script>
              alert('Semua input wajib diisi!');
              document.location.href = './lapor.php';
              </script>";
    }
}

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

            <form method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="kelas" class="form-label">Kelas</label>
                            <select name="kelas" id="kelas" class="form-select form-select-sm slt_width" required>
                                <option value="">Pilih kelas</option>
                                <?php foreach($kelas_sekolah as $kelas) : ?>
                                <option value="<?= $kelas["id_kelas"]; ?>"><?= $kelas["nama_kelas"]; ?></option>

                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="jurusan" class="form-label">Jurusan</label>
                            <select name="jurusan" id="jurusan" class="form-select form-select-sm slt_width" disabled required>
                                <option value="">Pilih jurusan</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Siswa</label>
                            <select name="nama" id="nama" class="form-select form-select-sm slt_width" required disabled>
                                <option value="">Pilih nama siswa</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6" style="max-height: 237px; overflow-y: auto">
                        <div id="listPelanggaran">
                            <div id="plgr1" class="mb-3">
                                <label for="pelanggaran" class="form-label">Pelanggaran</label>
                                <select name="pelanggaran[]" id="pelanggaran" class="form-select form-select-sm slt_width" required>
                                    <option value="">Pilih pelanggaran</option>
                                    <optgroup label="<?= ucwords($ket_pelanggaran_keterlambatan[0]["jenis_pelanggaran"]); ?>">
                                        <?php foreach($ket_pelanggaran_keterlambatan as $keterlambatan) : ?>
                                        <option value="<?= $keterlambatan["id_pelanggaran"]; ?>"><?= $keterlambatan["det_pelanggaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="<?= ucwords($ket_pelanggaran_pakaian[0]["jenis_pelanggaran"]); ?>">
                                        <?php foreach($ket_pelanggaran_pakaian as $pakaian) : ?>
                                        <option value="<?= $pakaian["id_pelanggaran"]; ?>"><?= $pakaian["det_pelanggaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="<?= ucwords($ket_pelanggaran_upacara[0]["jenis_pelanggaran"]); ?>">
                                        <?php foreach($ket_pelanggaran_upacara as $upacara) : ?>
                                        <option value="<?= $upacara["id_pelanggaran"]; ?>"><?= $upacara["det_pelanggaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="<?= ucwords($ket_pelanggaran_media_elektronik[0]["jenis_pelanggaran"]); ?>">
                                        <?php foreach($ket_pelanggaran_media_elektronik as $media_elektronik) : ?>
                                        <option value="<?= $media_elektronik["id_pelanggaran"]; ?>"><?= $media_elektronik["det_pelanggaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="<?= ucwords($ket_pelanggaran_aksesoris[0]["jenis_pelanggaran"]); ?>">
                                        <?php foreach($ket_pelanggaran_aksesoris as $aksesoris) : ?>
                                        <option value="<?= $aksesoris["id_pelanggaran"]; ?>"><?= $aksesoris["det_pelanggaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="<?= ucwords($ket_pelanggaran_kehadiran[0]["jenis_pelanggaran"]); ?>">
                                        <?php foreach($ket_pelanggaran_kehadiran as $kehadiran) : ?>
                                        <option value="<?= $kehadiran["id_pelanggaran"]; ?>"><?= $kehadiran["det_pelanggaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="<?= ucwords($ket_pelanggaran_lingkungan_sekolah[0]["jenis_pelanggaran"]); ?>">
                                        <?php foreach($ket_pelanggaran_lingkungan_sekolah as $lingkungan_sekolah) : ?>
                                        <option value="<?= $lingkungan_sekolah["id_pelanggaran"]; ?>"><?= $lingkungan_sekolah["det_pelanggaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="<?= ucwords($ket_pelanggaran_mencuri[0]["jenis_pelanggaran"]); ?>">
                                        <?php foreach($ket_pelanggaran_mencuri as $mencuri) : ?>
                                        <option value="<?= $mencuri["id_pelanggaran"]; ?>"><?= $mencuri["det_pelanggaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="<?= ucwords($ket_pelanggaran_merokok[0]["jenis_pelanggaran"]); ?>">
                                        <?php foreach($ket_pelanggaran_merokok as $merokok) : ?>
                                        <option value="<?= $merokok["id_pelanggaran"]; ?>"><?= $merokok["det_pelanggaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="<?= ucwords($ket_pelanggaran_pornografi[0]["jenis_pelanggaran"]); ?>">
                                        <?php foreach($ket_pelanggaran_pornografi as $pornografi) : ?>
                                        <option value="<?= $pornografi["id_pelanggaran"]; ?>"><?= $pornografi["det_pelanggaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="<?= ucwords($ket_pelanggaran_senjata_tajam[0]["jenis_pelanggaran"]); ?>">
                                        <?php foreach($ket_pelanggaran_senjata_tajam as $senjata_tajam) : ?>
                                        <option value="<?= $senjata_tajam["id_pelanggaran"]; ?>"><?= $senjata_tajam["det_pelanggaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="<?= ucwords($ket_pelanggaran_perkelahian[0]["jenis_pelanggaran"]); ?>">
                                        <?php foreach($ket_pelanggaran_perkelahian as $perkelahian) : ?>
                                        <option value="<?= $perkelahian["id_pelanggaran"]; ?>"><?= $perkelahian["det_pelanggaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="<?= ucwords($ket_pelanggaran_narkoba[0]["jenis_pelanggaran"]); ?>">
                                        <?php foreach($ket_pelanggaran_narkoba as $narkoba) : ?>
                                        <option value="<?= $narkoba["id_pelanggaran"]; ?>"><?= $narkoba["det_pelanggaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="<?= ucwords($ket_pelanggaran_kepribadian[0]["jenis_pelanggaran"]); ?>">
                                        <?php foreach($ket_pelanggaran_kepribadian as $kepribadian) : ?>
                                        <option value="<?= $kepribadian["id_pelanggaran"]; ?>"><?= $kepribadian["det_pelanggaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                </select>
                            </div>
                        </div>

                        <div class="my-2 text-center">
                            <button type="button" class="btn btn-outline-primary rounded" onclick="tambahPelanggaran()" id="">+</button>
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

<script>
    let indexPelanggaran = 1
    function tambahPelanggaran() {
        const plgr = document.getElementById("plgr" + indexPelanggaran);
        const element = `<div id="plgr${indexPelanggaran + 1}"  class="mb-3">
                                <label for="pelanggaran" class="form-label">Pelanggaran</label>
                                <select name="pelanggaran[]" id="pelanggaran" class="form-select form-select-sm slt_width" required>
                                    <option value="">Pilih pelanggaran</option>
                                    <optgroup label="<?= ucwords($ket_pelanggaran_keterlambatan[0]["jenis_pelanggaran"]); ?>">
                                        <?php foreach($ket_pelanggaran_keterlambatan as $keterlambatan) : ?>
                                        <option value="<?= $keterlambatan["id_pelanggaran"]; ?>"><?= $keterlambatan["det_pelanggaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="<?= ucwords($ket_pelanggaran_pakaian[0]["jenis_pelanggaran"]); ?>">
                                        <?php foreach($ket_pelanggaran_pakaian as $pakaian) : ?>
                                        <option value="<?= $pakaian["id_pelanggaran"]; ?>"><?= $pakaian["det_pelanggaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="<?= ucwords($ket_pelanggaran_upacara[0]["jenis_pelanggaran"]); ?>">
                                        <?php foreach($ket_pelanggaran_upacara as $upacara) : ?>
                                        <option value="<?= $upacara["id_pelanggaran"]; ?>"><?= $upacara["det_pelanggaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="<?= ucwords($ket_pelanggaran_media_elektronik[0]["jenis_pelanggaran"]); ?>">
                                        <?php foreach($ket_pelanggaran_media_elektronik as $media_elektronik) : ?>
                                        <option value="<?= $media_elektronik["id_pelanggaran"]; ?>"><?= $media_elektronik["det_pelanggaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="<?= ucwords($ket_pelanggaran_aksesoris[0]["jenis_pelanggaran"]); ?>">
                                        <?php foreach($ket_pelanggaran_aksesoris as $aksesoris) : ?>
                                        <option value="<?= $aksesoris["id_pelanggaran"]; ?>"><?= $aksesoris["det_pelanggaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="<?= ucwords($ket_pelanggaran_kehadiran[0]["jenis_pelanggaran"]); ?>">
                                        <?php foreach($ket_pelanggaran_kehadiran as $kehadiran) : ?>
                                        <option value="<?= $kehadiran["id_pelanggaran"]; ?>"><?= $kehadiran["det_pelanggaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="<?= ucwords($ket_pelanggaran_lingkungan_sekolah[0]["jenis_pelanggaran"]); ?>">
                                        <?php foreach($ket_pelanggaran_lingkungan_sekolah as $lingkungan_sekolah) : ?>
                                        <option value="<?= $lingkungan_sekolah["id_pelanggaran"]; ?>"><?= $lingkungan_sekolah["det_pelanggaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="<?= ucwords($ket_pelanggaran_mencuri[0]["jenis_pelanggaran"]); ?>">
                                        <?php foreach($ket_pelanggaran_mencuri as $mencuri) : ?>
                                        <option value="<?= $mencuri["id_pelanggaran"]; ?>"><?= $mencuri["det_pelanggaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="<?= ucwords($ket_pelanggaran_merokok[0]["jenis_pelanggaran"]); ?>">
                                        <?php foreach($ket_pelanggaran_merokok as $merokok) : ?>
                                        <option value="<?= $merokok["id_pelanggaran"]; ?>"><?= $merokok["det_pelanggaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="<?= ucwords($ket_pelanggaran_pornografi[0]["jenis_pelanggaran"]); ?>">
                                        <?php foreach($ket_pelanggaran_pornografi as $pornografi) : ?>
                                        <option value="<?= $pornografi["id_pelanggaran"]; ?>"><?= $pornografi["det_pelanggaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="<?= ucwords($ket_pelanggaran_senjata_tajam[0]["jenis_pelanggaran"]); ?>">
                                        <?php foreach($ket_pelanggaran_senjata_tajam as $senjata_tajam) : ?>
                                        <option value="<?= $senjata_tajam["id_pelanggaran"]; ?>"><?= $senjata_tajam["det_pelanggaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="<?= ucwords($ket_pelanggaran_perkelahian[0]["jenis_pelanggaran"]); ?>">
                                        <?php foreach($ket_pelanggaran_perkelahian as $perkelahian) : ?>
                                        <option value="<?= $perkelahian["id_pelanggaran"]; ?>"><?= $perkelahian["det_pelanggaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="<?= ucwords($ket_pelanggaran_narkoba[0]["jenis_pelanggaran"]); ?>">
                                        <?php foreach($ket_pelanggaran_narkoba as $narkoba) : ?>
                                        <option value="<?= $narkoba["id_pelanggaran"]; ?>"><?= $narkoba["det_pelanggaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="<?= ucwords($ket_pelanggaran_kepribadian[0]["jenis_pelanggaran"]); ?>">
                                        <?php foreach($ket_pelanggaran_kepribadian as $kepribadian) : ?>
                                        <option value="<?= $kepribadian["id_pelanggaran"]; ?>"><?= $kepribadian["det_pelanggaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                </select>
                            </div>`
        
        plgr.insertAdjacentHTML('afterend', element);
        indexPelanggaran++
    }
</script>
</body>
</html>