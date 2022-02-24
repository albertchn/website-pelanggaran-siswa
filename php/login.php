<?php
session_start();
require 'functions.php';

if ( isset($_COOKIE["gk"]) && isset($_COOKIE["gu"]) && isset($_COOKIE["gr"]) ) {
    $gk = $_COOKIE["gk"];
    $gu = $_COOKIE["gu"];
    $gr = $_COOKIE["gr"];

    $query = mysqli_query($conn, "SELECT nip FROM guru_pembina WHERE id_guru = $gk");
    $result = mysqli_fetch_assoc($query);

    if ( $gu === hash('gost', $result["nip"]) ) {
        $_SESSION["login"] = true;
        $_SESSION["$gr"] = true;
    }
}

if ( isset($_COOKIE["sk"]) && isset($_COOKIE["su"]) && isset($_COOKIE["sr"])) {
    $sk = $_COOKIE["sk"];
    $su = $_COOKIE["su"];
    $sr = $_COOKIE["sr"];

    $query = mysqli_query($conn, "SELECT nis FROM siswa WHERE id_siswa = $sk");
    $result = mysqli_fetch_assoc($query);

    if ( $su === hash('gost', $result["nis"]) ) {
        $_SESSION["login"] = true;
        $_SESSION["$sr"] = true;
    }
}

if ( isset($_SESSION["login"]) ) {
    header('Location: ./../index.php');
    exit;
}

if ( isset($_POST["login"]) ) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    if(strlen($username) === 16 || strlen($username) === 18) {
        $query = mysqli_query($conn, "SELECT `id_guru`, `nip`, `nama_guru`, `role` FROM guru_pembina WHERE nip = '$username' AND password = '$password'");

        if(mysqli_num_rows($query) === 1) {
            $result = mysqli_fetch_assoc($query);

            $_SESSION["login"] = true;
            $_SESSION["guru"] = true;
            $_SESSION["id"] = $result["id_guru"];
            $_SESSION["nip"] = $result["nip"];

            
            $ip = $_SERVER['REMOTE_ADDR'];
            $role = $result["role"];
            $nama_user = $result["nama_guru"];
            
            if(isset($_POST["remember"])) {
                setcookie('gk', $result["id_guru"], time() + 60 * 1);
                setcookie('gu', hash('gost', $username), time() + 60 * 1);
                setcookie('gr', $role, time() + 60 * 1);
            }
            mysqli_query($conn, "INSERT INTO `user_log` (`ip_user`, `username`, `nama_user`, `role`) VALUES ('$ip', '$username', '$nama_user', '$role')");
            header('Location: ./../index.php');
        }
        else {
            $error = true;
        }
    }
    elseif(strlen($username) === 5) {
        $query = mysqli_query($conn, "SELECT `id_siswa`, `nis`, `nama_siswa`, `role` FROM siswa WHERE nis = '$username' AND password = '$password'");

        if(mysqli_num_rows($query) === 1) {
            $result = mysqli_fetch_assoc($query);
            
            $_SESSION["login"] = true;
            $_SESSION["nis"] = $result["nis"];

            $id_siswa = $result["id_siswa"];
            $ip = $_SERVER['REMOTE_ADDR'];
            $role = $result["role"];
            $nama_user = $result["nama_siswa"];
            $role = $result["role"];

            if($role === "osis") {
                $_SESSION["osis"] = true;
                $_SESSION["id"] = $id_siswa;
            }
            
            if($role === "siswa") {
                $_SESSION["siswa"] = true;
                $_SESSION["id_siswa"] = $id_siswa;
            }

            if(isset($_POST["remember"])) {
                setcookie('sk', $id_siswa, time() + 60 * 1);
                setcookie('su', hash('gost', $username), time() + 60 * 1);
                setcookie('sr', $role, time() + 60 * 1);
            }

            mysqli_query($conn, "INSERT INTO `user_log` (`ip_user`, `username`, `nama_user`, `role`) VALUES ('$ip', '$username', '$nama_user', '$role')");
            if(isset($_SESSION["siswa"])) {
                header("Location: ./data_siswa.php?id=$id_siswa");
            } else {
                header('Location: ./../index.php');
            }
        }
        else {
            $error = true;
        }
    }
    
    elseif($username === "smkn12" && $password === "Smkn12jkt") {
        $_SESSION["login"] = true;
        $_SESSION["admin"] = true;
        header("Location: ./../index.php");
    }
    
    $invalid = true;
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk | OSIS SMKN 12 JAKARTA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <nav class="navbar navbar-light border-bottom">
        <div class="container-xl">
        <a href="index.php" class="navbar-brand align-items-center mx-auto">
                <img src="./../img/logosmk12.png" style="width:50px;height:50px">
                <h5 class=" ms-1 d-inline">OSIS SMKN 12 JAKARTA</h5>
            </a> 
    </nav>

    <section class="login" style="margin:80px 0 100px 0">
        <div class="container-lg">
            <div class="row justify-content-center mb-5 g-3">
                <div class="col-10 col-md-5 justify-items-start">
                    <h1 class="mb-4" style="margin-top:-10px">Halaman Masuk</h1>

                    <?php if ( isset($error) ) : ?>
                        <p style="color:red; font-style:italic; font-size:15px;">username / password salah!</p>
                    <?php endif; ?>

                    <?php if ( isset($invalid) ) : ?>
                        <p style="color:red; font-style:italic; font-size:15px;">Invalid username!</p>
                    <?php endif; ?>

                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" id="username" required autofocus autocomplete="off" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" required class="form-control" autocomplete="off> 
                        </div>
                        <div class="mb-3" class="form-check">
                            <input type="checkbox" name="remember" id="remember" class="form-check-input">
                            <label for="remember" class="form-check-label">Remember</label>
                        </div>  
                        <button type="submit" name="login" class="btn btn-outline-secondary mb-3">Masuk</button>
                    </form>
                </div>

                <div class="col-md-5 d-none d-md-block image">
                    <div id="mycarousel" class="carousel slide" data-bs-ride="carousel" data-bs-pause="false" data-bs-touch="false">
                        <div class="carousel-inner rounded">
                            <div class="carousel-item active" >
                                <img src="../img/rs/gedung rs.jpg" class="d-block w-100">
                            </div>
                            <div class="carousel-item">
                                <img src="../img/rs/emergency.jpg" class="d-block w-100">
                            </div>
                            <div class="carousel-item">
                                <img src="../img/rs/ruangan rs.png" class="d-block w-100">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="pt-4 border-top bg-light" style="margin:100px 0 0 0;">
        <div class="container-xl">
            <div class="row justify-content-center">
                <div class="col-auto pb-2">
                    <img src="./../img/logosmk12.png" style="width:50px;height:50px">
                    <h5 class="d-inline">OSIS SMK NEGERI 12 JAKARTA</h5>
                </div>
            </div>
            <div class="row" style="margin: 30px 30px 50px 30px">
                <div class="col-5 col-md-3">
                    <a href="#" class="text-decoration-none d-block">
                        <i class="bi bi-meta text-primary"></i>
                        <span class="meta">Meta</span>
                    </a>
                    <a href="#" class="text-decoration-none text-bla d-block">
                        <i class="bi bi-instagram"></i>
                        <span class="insta">Instagram</span>
                    </a>
                    <a href="#" class="text-decoration-none text-danger">
                        <i class="bi bi-youtube"></i>
                        <span class="yt">Youtube</span>
                    </a>
                </div>
                <div class="col-5 col-md-3">
                    <a href="#" class="d-block">Tentang Kami</a>
                    <a href="#" class="">FAQs</a>
                </div>
            </div>
            <hr>
            <p style="text-align:center; font-size:15px">&copy; Copyright 2022, OSIS SMK NEGERI 12 JAKARTA</p>
        </div>
    </footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></>


</body>
</html>