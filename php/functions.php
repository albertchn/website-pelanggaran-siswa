<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "pelanggaran_siswa");

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ( $row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function lapor($data,$poin) {
    global $conn;
    
    $id_pelanggar = $data["nama"];
    $id_pelapor = $data["nama"];
    $id_pelanggaran1 = $data["pelanggaran1"];
    $id_pelanggaran2 = $data["pelanggaran2"];
    $id_pelanggaran3 = $data["pelanggaran3"];
    $waktu_pelanggaran = date("Y-m-d");
    
    $jmlh_poin = query("SELECT jmlh_poin FROM siswa WHERE id_siswa=$id_pelanggar")[0]["jmlh_poin"];;

    $query = "INSERT INTO pelanggaran_siswa VALUES ('','$id_pelanggar', '$id_pelapor', '$id_pelanggaran1', '$id_pelanggaran2', '$id_pelanggaran3', '$waktu_pelanggaran')";

    $poin_akhir = $jmlh_poin-$poin;
    
    mysqli_query($conn, $query);
    mysqli_query($conn, "UPDATE siswa SET jmlh_poin=$poin_akhir WHERE id_siswa=$id_pelanggar");

    return mysqli_affected_rows($conn);
}