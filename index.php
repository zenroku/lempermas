<?php
session_start();

require 'functions.php';

$kuebasah = query("SELECT * FROM kuebasah ORDER BY id_produk DESC");


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
                    <?php if (isset($_SESSION['pelanggan']) OR isset($_SESSION['admin'])) : ?>
                        <li class="nav-item">
                        <a class="nav-link" href="logout.php" onclick="return confirm('Apakah anda yakin ingin Logout?')">Logout</a>
                    </li>
                    <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <?php endif ?>
                    <?php if (isset($_SESSION['admin'])) : ?>
                        <li class="nav-item">
                        <a class="nav-link" href="admin.php">ADMIN</a>
                    </li>
                    <?php else: ?>
                    <li class="nav-item">
                    <a class="nav-link" href="checkout.php">Check Out</a>
                    </li>
                    <?php endif ?>
                </ul>
            </div>
        </nav>
    </section>
    <!-- akhir navigasi -->

    <!-- about lempermas -->
    <section class="about">
        <div class="jumbotron rounded-0">
            <div class="container">
                <h1 class="display-4">Toko Kue Lempermas</h1>
                <p class="lead">Menjual Aneka Ragam Kue Basah</p>
            </div>
        </div>
    </section>
    <!-- akhir about -->

    <!-- gallery -->

    <section class="gallery">
        <div class="container bg-light mb-5">
            <div class="col pt-2 text-center">
                <h1 class="text-success">Menu</h1>
                <hr>
            </div>
            <p class="font-italic">Untuk memesan, silahkan pilih kue mana yang ingin dibeli<br>Kemudian masukkan jumlah pesanan yg diinginkan di Detail Kue</p>
            <div class="row">
                <?php foreach( $kuebasah as $row ) : ?>
                
                <div class="col-md-3 mb-3">
                    <div class="thumbnail">
                        <img src="img/<?= $row["gambar"];?>" class="img-fluid img-thumbnail" alt="">
                        <div class="caption">
                            <h3><?= $row["nama"];?></h3>
                            <h5>Rp. <?= $row["harga"];?>/<?= $row["satuan"];?></h5>
                            <a href="detail.php?id=<?= $row["id_produk"];?>" class="btn btn-primary">Detail Kue</a>
                            <a href="beli.php?id=<?= $row["id_produk"];?>" class="btn btn-success">Beli</a>
                        </div>
                    </div>
                </div>
                
                <?php endforeach; ?>
                
            </div>
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