<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

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
                        <a class="nav-link" href="pesanan.php">Cek Pesanan Masuk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tambah.php">Tambah Produk Baru</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pelanggan.php">Data Pelanggan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
    </section>
    <!-- akhir navigasi -->
    
    
    <!--data pelanggan -->
    <section class="tambah" style="margin-bottom: 200px">
        <div class="container">
            <div class="col m-5 text-center">
                <h1 class="text-success">Data Pelanggan</h1>
                <hr>
            </div>
            
            <table class="table table-bordered text-center">
                <thead>
                    <th class="text-center">No</th>
                    <th class="text-center">Nama Pelanggan</th>
                    <th class="text-center">Alamat Pelanggan</th>
                    <th class="text-center">Telepon Pelanggan</th>
                    <th class="text-center">Email Pelanggan</th>
                </thead>
                <tbody>
                <?php $nomor = 1; ?>
                <?php
                $ambil = $conn->query("SELECT * FROM pelanggan");?>
                <?php while($pecah = $ambil->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $nomor;?></td>
                        <td><?= $pecah['nama_pelanggan']; ?></td>
                        <td><?= $pecah['alamat_pelanggan']; ?></td>
                        <td><?= $pecah['telepon_pelanggan']; ?></td>
                        <td><?= $pecah['email_pelanggan']; ?></td>
                    </tr>
                <?php $nomor++; ?>
                <?php } ?>
                </tbody>
                
            </table>
            
        </div>
    </section>

    <!-- akhir data pelanggan -->

        </div>
    </section>

    <!-- akhir gallery -->

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
