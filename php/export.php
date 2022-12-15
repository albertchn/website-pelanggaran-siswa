<?php
require "functions.php";

$tgl_plgr = $_GET["tanggal"];

$plgr_siswa = query("SELECT * FROM pelanggaran_siswa WHERE waktu_pelanggaran = '$tgl_plgr'");

header("Content-Type: application/vdn-ms-excel");
header("Content-Disposition: attachment; filename=Laporan-Tanggal ($tgl_plgr).xls");
header("Cache-Control: max-age=0");
?>

<p style="font-weight:bold;font-size:28px;">Laporan Pelanggaran Siswa</p>

<table border="1" align="center">
    <thead>
        <th>No.</th>
        <th>Tanggal</th>
        <th>Nama Pelanggar</th>
        <th>Pelanggaran</th>
        <th>Poin Berkurang</th>
        <th>Petugas</th>
    </thead>
    <tbody>
        <?php $nomor = 1; ?>
        <?php foreach ($plgr_siswa as $plgr) : ?>
            <tr style="vertical-align: middle; text-align:center;">
                <td><?= $nomor++; ?></td>
                <td><?= date("d-m-Y", strtotime($plgr["waktu_pelanggaran"])); ?></td>
                <td>
                    <?php $nama = mysqli_query($conn, "SELECT nama_siswa FROM siswa WHERE id_siswa = " . $plgr["id_pelanggar"])->fetch_assoc(); ?>
                    <?= $nama["nama_siswa"]; ?>
                </td>
                <td>
                    <?php $id_pelanggaran = $plgr["id_pelanggaran"]; ?>
                    <?php $pelanggaran = query("SELECT det_pelanggaran FROM ket_pelanggaran WHERE id_pelanggaran IN ($id_pelanggaran)"); ?>
                    <ol>
                        <?php foreach ($pelanggaran as $data) : ?>
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