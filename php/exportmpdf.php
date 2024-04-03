<?php
session_start();

if (!isset($_SESSION["login"])) {
    header('Location: ./login.php');
    exit;
}

if (isset($_SESSION["siswa"])) {
    header("Location: data_siswa.php?id=" . $_SESSION["id_siswa"]);
}

if (!isset($_POST["ekspor"])) {
    header("Location: laporan.php");
}

include("functions.php");
require '../vendor/autoload.php';

$tglAwal = $_POST["tanggalAwal"];
$tglAkhir = $_POST["tanggalAkhir"];

$mpdf = new \Mpdf\Mpdf(['orientation' => 'L']);

$plgr_siswa = query("SELECT * FROM pelanggaran_siswa WHERE waktu_pelanggaran BETWEEN '$tglAwal' AND '$tglAkhir'");
$nomor = 1;


$html = '
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pelanggaran</title>
</head>

<body>
    <h1 style="text-align:center;">Laporan Pelanggaran <br> <span style="font-size: 20px">' . date('d-M-Y', strtotime($tglAwal)) . ' sd ' . date('d-M-Y', strtotime($tglAwal)) . '</span></h1>
    <div style="margin-left: 0px;">
        <table border="1" cellpadding="10" cellspacing="0" style="text-align:center;">
            <thead>
                <tr>
                    <th">No.</th>
                    <th style="min-width: 100px">Tanggal</th>
                    <th style="min-width: 150px">Nama Pelanggar</th>
                    <th style="min-width: 500px">Pelanggaran</th>
                    <th style="min-width: 40px">Poin Berkurang</th>
                    <th style="min-width: 150px">Petugas</th>
                </tr>
            </thead>';

foreach ($plgr_siswa as $plgr) {
    $nama = mysqli_query($conn, "SELECT nama_siswa FROM siswa WHERE id_siswa = " . $plgr["id_pelanggar"])->fetch_assoc();
    $tanggal = date("d-m-Y", strtotime($plgr["waktu_pelanggaran"]));
    $id_pelanggaran = $plgr["id_pelanggaran"];
    $pelanggaran = query("SELECT det_pelanggaran FROM ket_pelanggaran WHERE id_pelanggaran IN ($id_pelanggaran)");
    $id_pelapor = $plgr["id_pelapor"];
    if (strlen($id_pelapor) === 5) :
        $pelapor = mysqli_query($conn, "SELECT nama_siswa FROM siswa WHERE nis = $id_pelapor")->fetch_assoc();
        $petugas = $pelapor["nama_siswa"];
    else :
        $pelapor = mysqli_query($conn, "SELECT nama_guru FROM guru_pembina WHERE nip = $id_pelapor")->fetch_assoc();
        $petugas = $pelapor["nama_guru"];
    endif;

    $html .= '<tr>
        <td style="vertical-align: center;">' . $nomor++ . '</td>
        <td style="vertical-align: center;">' . $tanggal . '</td>
        <td style="vertical-align: center;">' . $nama["nama_siswa"] . '</td>
        <td style="vertical-align: center;text-align: start;">
            <ol>';
    foreach ($pelanggaran as $data) {
        $html .= '<li>' . $data["det_pelanggaran"] . '</li>';
    }
    $html .= '</ol>
        </td>
        <td style="vertical-align: center;">' . $plgr["poin_berkurang"] . '</td>
        <td  style="vertical-align: center;">' . $petugas . '</td>
    </tr>';
}


$html .= '</table>
    </div>

</body>

</html>
';

$mpdf->WriteHTML($html);
$$this->response->setHeader('Content-Type', 'application/pdf');
$mpdf->Output('Laporan Pelanggaran ' . date('d-M-Y', strtotime($tglAwal)) . ' sd ' . date('d-M-Y', strtotime($tglAwal)) . '.pdf', "D");

header("Location: laporan.php");
