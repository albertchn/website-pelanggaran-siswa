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

function tambah_guru($data) {
    global $conn;
    
    $nip = htmlspecialchars($data["nip"]);
    $nama = htmlspecialchars(ucwords($data["nama"]));
    $email = htmlspecialchars($data["email"]);

    $query = "INSERT INTO guru_pembina (`nip`, `nama_guru`, `email`, `role`, `password`) VALUES ('$nip', '$nama', '$email', 'guru', '$nip')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

}

function tambah_siswa($data) {
    global $conn;

    $kelas = $data["kelas"];
    $jurusan = $data["jurusan"];
    $nis = htmlspecialchars($data["nis"]);
    $nama = htmlspecialchars(ucwords($data["nama"]));
    $email = htmlspecialchars($data["email"]);

    $cek_nis = mysqli_query($conn, "SELECT * FROM siswa WHERE nis = $nis");

    if(mysqli_num_rows($cek_nis) > 0){
        echo "<script>
              alert('NIS sudah dipakai');
              </script>";
        return false;
    }
    
    $foto = upload();

    if ( !$foto ) {
        return false;
    }

    mysqli_query($conn, "INSERT INTO siswa (`id_kelas`, `id_jurusan`, `nis`, `nama_siswa`, `email`, `jmlh_poin`, `role`, `foto`, `password`) VALUES ('$kelas', '$jurusan', '$nis', '$nama', '$email', '50', 'siswa', '$foto', '$nis')");

    return mysqli_affected_rows($conn);
}

function upload() {
    
    $namaFile = $_FILES["foto"]["name"];
    $ukuranFile = $_FILES["foto"]["size"];
    $error = $_FILES["foto"]["error"];
    $tmpName = $_FILES["foto"]["tmp_name"];

    if ( $error === 4 ) {
        echo "<script>
              alert('Foto siswa wajib ada!');
              </script>";
        return false; // agar fungsi tambah tidak dijalankan
    }

    $ekstensiFotoValid = ['jpg', 'jpeg', 'png'];
    $ekstensiFoto = explode(".", $namaFile);
    $ekstensiFoto = strtolower(end($ekstensiFoto));

    // fungsi in_array untuk mencari suatu kata di dalam array yang akan menghasilkan false jika tidak ada dan true jika ada
    if ( !in_array($ekstensiFoto, $ekstensiFotoValid) ) {
        echo "<script>
              alert('Jenis file dilarang!');
              </script>";
        return false; // agar fungsi tambah tidak dijalankan
    }

    // cek ukuran gambar
    if ( $ukuranFile > 2048000 ) {
        echo "<script>
              alert('Ukuran file foto terlalu besar!');
              </script>";
        return false; // agar fungsi tambah tidak dijalankan
    }

    // file lolos pengecekan, gambar siap diupload
    // generate nama gambar baru agar tidak ada yg sama
    // menggunakan function uniqid() yang mengembalikan string random
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiFoto;

    // destinasinya relatif terhadap file functions ini
    move_uploaded_file($tmpName, './../foto_siswa/' . $namaFileBaru);

    // mengembalikan nama filenya untuk ditamngkap $gambar di function tambah() agar namanya disimpan di database
    return $namaFileBaru;
}