<?php
require "functions.php";

if(isset($_POST["submit"])) {
    var_dump($_FILES);
    exit;
    if(($_FILES["foto"]["error"] === 4)){
        echo "<script>
              alert('File foto wajib ada!');
              document.location.href = './test.php';
              </script>";
    }

    if($_FILES["foto"]["size"] > 2048000 ) {
        echo "<script>
              alert('Ukuran foto terlalu besar!');
              document.location.href = './test.php';
              </script>";
    }

    if(tambah_siswa($_POST, $_FILES) > 0) {
        echo "<script>
              alert('Data berhasil ditambahkan!');
              document.location.href = './test.php';
              </script>";
    } else {
        echo mysqli_error($conn);
        // $invalidext = true;
        // echo "<script>
        // alert('Data gagal ditambahkan!');
        // document.location.href = './guru.php';
        // </script>";
    }
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test</title>
</head>
<body>
    
    <form action="" method="post" enctype="multipart/form-data">
        <div>
            <label for="kelas">Kelas</label>
            <select name="kelas" id="kelas" required>
                <option value="1">X</option>
                <option value="2">XI</option>
                <option value="3">XII</option>
            </select>
        </div>
        <div>
            <label for="jurusan">Jurusan</label>
            <select name="jurusan" id="jurusan" required>
                <option value="1">AKL</option>
                <option value="2">BDP</option>
                <option value="3">OTKP</option>
                <option value="3">RPL</option>
            </select>
        </div>
        <div>
            <label for="nis">NIS</label>
            <input type="number" id="nis" name="nis" required>
        </div>
        <div>
            <label for="nama">Nama Lengkap</label>
            <input type="text" id="nama" name="nama" required>
        </div>
        <div>
            <label for="email">Email Lengkap</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="foto">Foto</label>
            <input type="file" name="foto" id="foto">
        </div>
        <div>
            <button type="submit" name="submit">submit!</button>
        </div>
    </form>
</body>
</html>