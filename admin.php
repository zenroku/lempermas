<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

$kuebasah = query("SELECT * FROM kuebasah ORDER BY id_produk DESC");

if ( isset($_POST['cari']) ) {
        $kuebasah = cari($_POST['keyword']);
}


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


    <!-- cek stok -->
    <section class="cek">
        <div class="container bg-light mt-5">
            <div class="col pt-2 text-center mb-5">
                <h1 class="text-success">Halaman Admin</h1>
                <hr>
            </div>

            <!-- form cari -->
            <form class="form-inline md-form form-sm mb-5 mt-5 w-50 mx-auto" method="post">
                <i class="fas fa-search" aria-hidden="true"></i>
                <input class="form-control form-control-sm ml-3 w-75" type="text" placeholder="Cari Kue"
                    aria-label="Search" name="keyword" autocomplete="off" autofocus>
                <button type="submit" name="cari" class="btn btn-success ml-2">Cari</button>
            </form>
            <!-- akhir form cari -->

            <table class="table table-striped mb-5 mt-5">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Stok</th>
                        <th scope="col">Nama Kue</th>
                        <th scope="col">Harga (Rp.)</th>
                        <th scope="col">Satuan</th>
                        <th scope="col">Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; ?>
                    <?php foreach( $kuebasah as $row ) : ?>
                    <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><img src="img/<?= $row["gambar"];?>" width="50"></td>
                        <td><?= $row["stok"];?></td>
                        <td><?= $row["nama"];?></td>
                        <td><?= $row["harga"];?></td>
                        <td><?= $row["satuan"];?></td>
                        <td>
                        <a href="hapus.php?id=<?= $row["id_produk"];?>" onclick="return confirm('Apakah yakin ingin Dihapus?')">Hapus</a> | 
                        <a href="ubah.php?id=<?= $row["id_produk"];?>">Ubah Data</a></td>
                    </tr>
                    <?php $i++; ?>
                    <?php endforeach; ?>
                    </tbody>
            </table>
        </div>
    </section>

    <!-- akhit cek stok -->



    <!-- footer -->
    <footer class="bg-success text-white w-100 position-static">
        <div class="container p-1">
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