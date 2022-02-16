<?php
require '../php/functions.php';

if(isset($_GET["keyword"])){
    $keyword = $_GET["keyword"];
    $keyword = explode(" ", $keyword);
    if(count($keyword) == 2) {
        $query = "SELECT siswa.id_siswa, siswa.id_kelas, siswa.id_jurusan, siswa.nis, 
              siswa.nama_siswa, kelas.nama_kelas, jurusan.kode_jurusan FROM siswa 
              INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas 
              INNER JOIN jurusan ON siswa.id_jurusan=jurusan.id_jurusan WHERE
              nama_kelas LIKE '%$keyword[0]' AND kode_jurusan LIKE '%$keyword[1]%' LIMIT 72
              ";
        
    } else {
        $query = "SELECT siswa.id_siswa, siswa.id_kelas, siswa.id_jurusan, siswa.nis, 
              siswa.nama_siswa, kelas.nama_kelas, jurusan.kode_jurusan FROM siswa 
              INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas 
              INNER JOIN jurusan ON siswa.id_jurusan=jurusan.id_jurusan WHERE
              id_siswa LIKE '%$keyword[0]%' OR
              nis LIKE '%$keyword[0]%' OR
              nama_siswa LIKE '%$keyword[0]%' OR
              nama_kelas LIKE '$keyword[0]%' OR
              kode_jurusan LIKE '$keyword[0]%' LIMIT 72
              ";
    }

    $siswa_sekolah = query($query);
} else {

}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siswa | SMKN 12 JAKARTA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/siswa.css">
</head>
<body>
    <section style="margin: 0 -12px 0 -12px">
        <div class="container-lg" id="container_siswa">
            <div class="table-responsive-sm">
                <table border="1" cellpadding="10" cellspacing="0" class="table table-bordered table-hover text-center">
                    <thead class="table-light">
                        <th>No.</th>
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                    </thead>
                    <?php $i = 1; ?>
                    <?php foreach( $siswa_sekolah as $siswa) : ?>
                    <?php $jurusan = query("SELECT kode_jurusan FROM jurusan WHERE id_jurusan=". $siswa['id_jurusan'])[0] ?>
                    <tbody>
                        <th><?= $i; ?></th>
                        <td><?= $siswa["nis"]; ?></td>
                        <td class="text-start ps-3"><a href="./data_siswa.php?id=<?= $siswa["id_siswa"]; ?>"><?= $siswa["nama_siswa"]; ?></a></td>
                        <td><?= $siswa["nama_kelas"]; ?> <?= $jurusan["kode_jurusan"]; ?></td>
                    </tbody>
                    <?php $i++ ?>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
    