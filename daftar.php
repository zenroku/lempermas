<?php
session_start();

require'functions.php'

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

    <!-- daftar -->
    <section class="login" style="height:800px; margin-top:100px;">
        <div class="container">
            <div class="col pt-2 text-center">
                <h1 class="text-success">Daftar</h1>
                <hr>
            </div>
            <form method="POST">
                <div class="mx-auto mt-5">
                    <div class="form-group row">
                        <div class="col-md-3"></div>
                        <label class="col-md-1 col-form-label">Nama</label>
                        <div class="col-md-4">
                        <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap Anda" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3"></div>
                        <label class="col-md-1 col-form-label">Email</label>
                        <div class="col-md-4">
                        <input type="text" name="email" class="form-control" placeholder="Masukkan Email" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3"></div>
                        <label class="col-md-1 col-form-label">Password</label>
                        <div class="col-md-4">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3"></div>
                        <label class="col-md-1 col-form-label">Konfirmasi Password</label>
                        <div class="col-md-4">
                        <input type="password" name="password2" class="form-control" placeholder="Konfirmasi Password" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3"></div>
                        <label class="col-md-1 col-form-label">Alamat</label>
                        <div class="col-md-4">
                        <textarea name="alamat" rows="2" class="form-control" required>
                        </textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3"></div>
                        <label class="col-md-1 col-form-label">NomorHP</label>
                        <div class="col-md-4">
                        <input type="text" name="telepon" class="form-control" placeholder="Ingat ini Sebagai Login anda nanti" required>
                        </div>
                    </div>
                    <br>
                    <div class="col text-center">
                    <button class="btn btn-primary btn-lg col-md-4" name="daftar">
                        Daftar
                    </button>
                    </div>
                </div>
            </form>
            <?php
            if (isset($_POST['daftar'])) {
                $nama = $_POST['nama'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $password2 = $_POST['password2'];
                $alamat = $_POST['alamat'];
                $telepon = $_POST['telepon'];

                // cek email sudah dipakai dan nomor hp sudah dipakai atau belum
                $ambil = $conn->query("SELECT * FROM pelanggan WHERE email_pelanggan = '$email'");
                $cocok = $ambil->num_rows;

                $ambil2 = $conn->query("SELECT * FROM pelanggan WHERE telepon_pelanggan = '$telepon'");
                $cocok2 = $ambil2->num_rows;

                if ($cocok == 1) {
                    echo "<script>alert('Pendaftaran Gagal! Email Sudah Dipakai. Silahkan pakai Email Lain');</script>";
                    echo "<script>location='daftar.php';</script>";
                } elseif ($password != $password2) {
                    echo "<script>alert('Pendaftaran Gagal! Password Tidak Cocok. Masukkan konfirmasinya dengan benar!');</script>";
                    echo "<script>location='daftar.php';</script>";
                } elseif ($cocok2 == 1) {
                    echo "<script>alert('Pendaftaran Gagal! NomorHP Sudah Dipakai. Silahkan Pakai Nomor Lain');</script>";
                    echo "<script>location='daftar.php';</script>";
                } else {
                    // memasukkan data kedalam database
                    $conn->query("INSERT INTO pelanggan(nama_pelanggan, telepon_pelanggan, password_pelanggan, email_pelanggan, alamat_pelanggan)
                    VALUES('$nama', '$telepon', '$password', '$email', '$alamat')
                    ");
                    echo "<script>alert('Pendaftaran Berhasil, Silahkan Login');</script>";
                    echo "<script>location='login.php';</script>";
                }

            }
            
            ?>        
        </div>
    </section>

    <!-- akhir daftar-->

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
    
</body>

</html>