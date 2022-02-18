<?php
// koneksi ke database
$conn = mysqli_connect("172.17.1.77", "mariadb", "password", "osis_website_pelanggaran_siswa");

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ( $row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function lapor($data,$poin, $pelapor) {
    global $conn;
    
    $id_pelanggar = $data["nama"];
    $id_pelanggaran1 = $data["pelanggaran1"];
    $id_pelanggaran2 = $data["pelanggaran2"];
    $id_pelanggaran3 = $data["pelanggaran3"];
    $waktu_pelanggaran = date("Y-m-d");
    
    $jmlh_poin = query("SELECT jmlh_poin FROM siswa WHERE id_siswa=$id_pelanggar")[0]["jmlh_poin"];;

    $query = "INSERT INTO pelanggaran_siswa VALUES ('','$id_pelanggar', '$pelapor', '$id_pelanggaran1', '$id_pelanggaran2', '$id_pelanggaran3', '$waktu_pelanggaran')";

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

    mysqli_query($conn, "INSERT INTO siswa (`id_kelas`, `id_jurusan`, `nis`, `nama_siswa`, `email`, `jmlh_poin`, `role`, `foto`, `password`) VALUES ('$kelas', '$jurusan', '$nis', '$nama', '$email', '100', 'siswa', '$foto', '$nis')");

    return mysqli_affected_rows($conn);
}

function tambah_pelanggaran($data) {
    global $conn;

    $jenis_plgr = htmlspecialchars(strtolower($data["jenis_plgr"]));
    $det_plgr = htmlspecialchars(ucfirst($data["det_plgr"]));
    $poin_plgr = htmlspecialchars($data["poin"]);

    mysqli_query($conn, "INSERT INTO ket_pelanggaran (`jenis_pelanggaran`, `det_pelanggaran`, `poin_pelanggaran`) VALUES ('$jenis_plgr', '$det_plgr', '$poin_plgr')");

    return mysqli_affected_rows($conn);
}

function hapus_plgr($id) {
    global $conn;

    mysqli_query($conn, "DELETE FROM ket_pelanggaran WHERE id_pelanggaran = $id");

    return mysqli_affected_rows($conn);
}

function hapus_guru($id) {
    global $conn;

    mysqli_query($conn, "DELETE FROM guru_pembina WHERE id_guru = $id");

    return mysqli_affected_rows($conn);
}

function hapus_siswa($id) {
    global $conn;
    
    mysqli_query($conn, "DELETE FROM pelanggaran_siswa WHERE id_pelanggar = $id");
    mysqli_query($conn, "DELETE FROM siswa WHERE id_siswa = $id");

    return mysqli_affected_rows($conn);
}

function ubah_plgr($data) {
    global $conn;

    $id = $data["id"];
    $jenis_plgr = htmlspecialchars(ucwords($data["jenis_plgr"]));
    $det_plgr = htmlspecialchars($data["det_plgr"]);
    $poin = htmlspecialchars($data["poin"]);

    mysqli_query($conn, "UPDATE ket_pelanggaran SET 
                 jenis_pelanggaran = '$jenis_plgr',
                 det_pelanggaran = '$det_plgr', 
                 poin_pelanggaran = '$poin'
                 WHERE id_pelanggaran = $id
                 ");
    
    return mysqli_affected_rows($conn);
}

function ubah_guru($data) {
    global $conn;

    $id = $_POST["id"];
    $nip = htmlspecialchars($data["nip"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);


    mysqli_query($conn, "UPDATE guru_pembina SET 
                 nip = '$nip',
                 nama_guru = '$nama', 
                 email = '$email'
                 WHERE id_guru = $id
                 ");
    
    return mysqli_affected_rows($conn);
}

function ubah_siswa($data) {
    global $conn;

    $id = $data["id"];
    $kelas = $data["kelas"];
    $jurusan = $data["jurusan"];
    $nis = htmlspecialchars($data["nis"]);
    $nama = htmlspecialchars(ucwords($data["nama"]));
    $email = htmlspecialchars($data["email"]);
    $fotoLama = $data["fotoLama"];

    if($_FILES["foto"]["error"] === 4) {
        $foto = $fotoLama;
    } else {
        $foto = upload();
    }

    if ( !$foto ) {
        return false;
    }

    mysqli_query($conn, "UPDATE siswa SET
                 id_kelas = '$kelas',
                 id_jurusan = '$jurusan',
                 nis = '$nis',
                 nama_siswa = '$nama',
                 email = '$email',
                 foto = '$foto'
                 WHERE id_siswa = $id
                 ");

    return mysqli_affected_rows($conn);

}

function ubah_password($data, $id) {
    global $conn;

    $pw_lama = htmlspecialchars($data["pw_lama"]);
    $pw_baru = htmlspecialchars($data["pw_baru"]);
    $con_pw_baru = htmlspecialchars($data["con_pw_baru"]);

    $passwordLama = mysqli_query($conn, "SELECT `password` FROM siswa WHERE id_siswa = $id")->fetch_assoc();

    if($pw_lama === $passwordLama["password"]){
        if($pw_baru === $con_pw_baru) {
            mysqli_query($conn, "UPDATE siswa SET `password` = $pw_baru WHERE id_siswa = $id");
        }
        else {
            echo "<script>
              alert('Konfirmasi password baru berbeda!');
              </script>";
        return false;
        }
    } 
    else {
        echo "<script>
              alert('Password lama salah!');
              </script>";
        return false;
    }

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
    // $namaFileBaru = uniqid();
    // $namaFileBaru .= '.';
    // $namaFileBaru .= $ekstensiFoto;

    // destinasinya relatif terhadap file functions ini
    move_uploaded_file($tmpName, './../foto_siswa/' . $namaFile);

    // mengembalikan nama filenya untuk ditamngkap $gambar di function tambah() agar namanya disimpan di database
    return $namaFile;
}
