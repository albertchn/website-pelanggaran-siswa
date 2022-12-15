<?php
include("functions.php");
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$spreadsheet->createSheet();
$sheet = $spreadsheet->getActiveSheet();
$myWorkSheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'My Data');

$sheet->setCellValue('A1', 'Hello World !');

header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header("Content-Disposition: attachment; filename=Laporan-Tanggal.xls");
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');

// $sheet->setCellValue('A1', 'No.');
// $sheet->setCellValue('B1', 'Tanggal');
// $sheet->setCellValue('C1', 'Nama Pelanggar');
// $sheet->setCellValue('D1', 'Pelanggaran');
// $sheet->setCellValue('E1', 'Poin Berkurang');
// $sheet->setCellValue('F1', 'Petugas');

// $tgl_plgr = $_GET["tanggal"];

// $plgr_siswa = query("SELECT * FROM pelanggaran_siswa WHERE waktu_pelanggaran = '$tgl_plgr'");

// $i = 2;
// $no = 1;

// foreach ($plgr_siswa as $row) {
//     $nama = mysqli_query($conn, "SELECT nama_siswa FROM siswa WHERE id_siswa = " . $ROW["id_pelanggar"])->fetch_assoc();
//     // $id_pelanggaran = $row["id_pelanggaran"];
//     // $pelanggaran = mysqli_query($conn, "SELECT det_pelanggaran FROM ket_pelanggaran WHERE id_pelanggaran IN ($id_pelanggaran)");
//     // while ($result = mysqli_fetch_assoc($pelanggaran)) {
//     //     $row[] = $result;
//     // }
//     // $plgr = implode('', $row);
//     // echo $plgr;
//     // die;

//     $sheet->setCellValue('A' . $i, $no++);
//     $sheet->setCellValue('B' . $i, date("d-m-Y", strtotime($row["waktu_pelanggaran"])));
//     $sheet->setCellValue('C' . $i, $nama["nama_siswa"]);
//     $sheet->setCellValue('D' . $i, $row["id_pelanggaran"]);
// }
