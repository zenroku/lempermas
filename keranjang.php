<?php
session_start();

require 'functions.php';

if (isset($_SESSION['admin'])) {
    header("Location: admin.php");
    exit;
}

if (empty($_SESSION['keranjang']) OR !isset($_SESSION['keranjang'])) {
    echo "<script>alert('Belum memilih Produk sama sekali, silahkan pilih produk terlebih dahulu!');</script>";
    echo "<script>location='index.php';</script>";
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
                        <a class="nav-link" href="index.php">Menu</a>
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
                </ul>
            </div>
        </nav>
    </section>
    <!-- akhir navigasi -->


    <!--data keranjang -->
    <section class="tambah" style="margin-bottom: 250px">
        <div class="container">
            <div class="col m-5 text-center">
                <h1 class="text-success">Keranjang Belanja</h1>
                <hr>
            </div>
            <p class="font-italic">Untuk mengganti jumlah pesanan yg diiinginkan, <br> Silahkan ke menu dan lihat kedalam Detail Kue</p> <br>
            <table class="table table-bordered text-center">
                <thead>
                    <th>No</th>
                    <th>Nama Kue</th>
                    <th>Harga</th>
                    <th>Jumlah Pesan</th>
                    <th>SubHarga</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                <?php $nomor = 1; ?>
                <?php $total_belanja = 0; ?>
                <?php foreach( $_SESSION['keranjang'] as $id_produk => $jumlah ) : ?>
                <?php
                $ambil = $conn->query("SELECT * FROM kuebasah WHERE id_produk = '$id_produk'");
                $pecah = $ambil->fetch_assoc();
                $subharga = $pecah['harga'] * $jumlah;
                ?>
                    <tr>
                        <td><?= $nomor;?></td>
                        <td><?= $pecah['nama']; ?></td>
                        <td>Rp. <?= number_format($pecah['harga']); ?></td>
                        <td><?= $jumlah; ?></td>
                        <td>Rp. <?= number_format($subharga); ?></td>
                        <td>
                            <a href="hapus_keranjang.php?id=<?= $id_produk;?>"class="btn btn-danger btn-xs" onclick="return confirm('Apakah anda yakin menghapus item ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php $nomor++; ?>
                <?php $total_belanja+=$subharga; ?>
                <?php endforeach; ?>
                </tbody>
            </table>
            <a href="index.php" class="btn btn-default">Lanjutkan Pesan</a>
            <a href="checkout.php" class="btn btn-success">Check Out</a>                    
        </div>
    </section>

    <!-- akhir data keranjang -->



    <!-- footer -->
    <footer class="bg-success text-white mt-5 w-100">
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