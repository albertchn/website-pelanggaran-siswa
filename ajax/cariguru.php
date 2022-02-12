<?php
require '../php/functions.php';

$keyword = $_GET["keyword"];

$query = "SELECT id_guru, nip, nama_guru, email FROM guru_pembina WHERE
          nip LIKE '$keyword%' OR
          nama_guru LIKE '%$keyword%'
          LIMIT 5
          ";

$guru_sekolah = query($query);

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guru | SMKN 12 JAKARTA</title>
</head>
<body>  
    <section style="margin: 0 -12px 0 -12px">
        <div class="container-lg" id="container_guru">
            <div class="table-responsive-sm">
                <table border="1" cellpadding="10" cellspacing="0" class="table table-bordered table-hover text-center">
                    <thead class="table-light">
                        <th>No.</th>
                        <th>Nama</th>
                        <th>NIP</th>
                    </thead>
                    <?php $i = 1; ?>
                    <?php foreach( $guru_sekolah as $guru) : ?>
                    <tbody>
                        <th><?= $i; ?></th>
                        <td class=""><a href="data_guru.php?id=<?= $guru["id_guru"]; ?>"><?= $guru["nama_guru"]; ?></a></td>
                        <td><?= $guru["nip"]; ?></td>
                    </tbody>
                    <?php $i++ ?>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </section>

</body>
</html>