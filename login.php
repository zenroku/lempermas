<?php

session_start();

require 'functions.php';

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style/style.css">


    <title>Lempermas</title>
</head>

<body>

    <!-- navigasi -->
    <section class="nav">
        <nav class="navbar navbar-expand-lg navbar-dark bg-success w-100 p-3">
            <a class="navbar-brand font-weight-bold" href="index.php">Toko Kue Lempermas</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse ml-5" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="keranjang.php">Keranjang Anda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cekstok.php">Cek Ketersediaan</a>
                    </li>
                    <?php if (isset($_SESSION['pelanggan'])) : ?>
                        <li class="nav-item">
                        <a class="nav-link" href="logout.php" onclick="return confirm('Apakah anda yakin ingin Logout?')">Logout</a>
                    </li>
                    <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <?php endif ?>
                    <li class="nav-item">
                        <a class="nav-link" href="checkout.php">Check Out</a>
                    </li>
                </ul>
            </div>
        </nav>
    </section>
    <!-- akhir navigasi -->

    <!-- login -->
    <section class="login" style="height:500px; margin-top:200px;">
        <div class="container">
            <div class="col pt-2 text-center">
                <h1 class="text-success">Login</h1>
                <hr>
            </div>
            <form method="POST">
                <div class="mx-auto mt-5">
                    <div class="form-group row">
                        <div class="col-md-4"></div>
                        <label class="col-md-1 col-form-label">NomorHP</label>
                        <div class="col-md-3">
                        <input type="text" name="nomorhp" class="form-control" placeholder="Nomor HP">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4"></div>
                        <label class="col-md-1 col-form-label">Password</label>
                        <div class="col-md-3">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>
                    </div>
                    <div class="col text-center">
                    <button class="btn btn-primary btn-lg col-md-4" name="login">
                        Login
                    </button>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4"></div>
                        <p> &nbsp;&nbsp;&nbsp; Belum Punya Akun ? <a href="daftar.php" style="text-decoration: none;"><b>Daftar Disini!</b></a></p>
                    </div>
                </div>
            </form>
            <?php
            if (isset($_POST['login'])) {
                $nomorhp = $_POST['nomorhp'];
                $password = $_POST['password'];

                $ambil = $conn->query("SELECT * FROM pelanggan WHERE telepon_pelanggan = '$nomorhp' AND password_pelanggan = '$password'");
                $akun_cocok = $ambil->num_rows;

                $ambil2 = $conn->query("SELECT * FROM admin WHERE nama_admin = '$nomorhp' AND password_admin = '$password'");
                $akun_cocok2 = $ambil2->num_rows;

                if ($akun_cocok2 == 1) {
                    $_SESSION['admin'] = true;
                    echo "<script>
                            alert('Selamat Datang Admin!');
                            document.location.href = 'admin.php';
                        </script>";
                }

                if ($akun_cocok == 1) {
                    $akun = $ambil->fetch_assoc();

                    $_SESSION['pelanggan'] = $akun;
                    echo "<script>
                            alert('Login Berhasil');
                            document.location.href = 'index.php';
                        </script>";
                } else {
                    echo "<script>
                            alert('Login Gagal! Periksa kembali No.HP dan Password Anda');
                            document.location.href = 'login.php';
                        </script>";
                }
            }
            
            ?>        
        </div>
    </section>

    <!-- akhir login-->

    <!-- footer -->
    <footer class="bg-success text-white w-100 position-static">
        <div class="container p-3">
            <div class="row">
                <div class="col-sm-4">
                    <h4>Alamat</h4>
                    <p>Jl. Kamojang No.2
                        RT.2/RW.6<br>
                        Komplek Laladon Indah<br>
                        Ciomas, Bogor<br>
                        Jawa Barat 16610</p>
                </div>
                <div class="col-sm-4">
                    <h4>Kontak</h4>
                    <p>
                        Whatsapp :<br>
                        0898-2145-868
                    </p>
                </div>
                <div class="col-sm-4">
                    <p class="mt-5 pt-5">Copyright 2019 &copy; Warung Lempermas</p>
                </div>
            </div>
        </div>
    </footer>
    <!-- akhir footer -->
























    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="bootstrap-4.4.1-dist/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script> -->
</body>

</html>