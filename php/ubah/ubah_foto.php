<?php
$id = $_GET["id"];

if (!$id) {
    return header("Location: ../../index.php");
}

require '../functions.php';

if (isset($_POST["ganti"])) {
    if (ubah_foto($_POST, $id) > 0) {
        echo "<script>
                alert('Foto berhasil diubah!')
                // redirect versi javascript
                document.location.href = '../data_siswa.php?id=" . $id . "';
            </script>
            ";
    } else {
        echo mysqli_error($conn);
        echo "<script>
                alert('Gagal diubah!')
                // redirect versi javascript
                document.location.href = '../data_siswa.php?id=" . $id . "';
            </script>
            ";
    }
}
