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
    
    
    <!--data detail pesanan -->
    <section class="tambah" style="margin-bottom: 200px">
        <div class="container">
            <div class="col m-5 text-center">
                <h1 class="text-success">Detail Pesanan</h1>
                <hr>
            </div>
            <?php
            $ambil = $conn->query("SELECT * FROM pembelian JOIN pelanggan 
            ON pembelian.id_pelanggan = pelanggan.id_pelanggan 
            WHERE pembelian.id_pembelian = '$_GET[id]'");
            $detail = $ambil->fetch_assoc();
            ?>           
            <div class="row">
                <div class="col-md-4">
                    <h3>Pembelian</h3>
                    <strong>No. Pembelian : <?= $detail['id_pembelian']; ?></strong><br>
                    <strong>Tanggal : <?= $detail['tanggal_pembelian']; ?></strong><br>
                    <strong>Total : Rp. <?= number_format($detail['total_pembelian']); ?></strong><br><br>
                    <strong>Status : <?= $detail['status_pembelian']; ?></strong>
                </div>
                <div class="col-md-4">
                    <h3>Pelanggan</h3>
                    <strong>Nama : <?= $detail['nama_pelanggan']; ?></strong><br>
                    Telepon : <?= $detail['telepon_pelanggan']; ?> <br>
                    Email : <?= $detail['email_pelanggan']; ?>
                </div>
                <div class="col-md-4">
                    <h3>Pengiriman</h3>
                    <strong>Tujuan : <?= $detail['nama_daerah']; ?> </strong><br>
                    Ongkir : Rp. <?= number_format($detail['tarif']); ?><br>
                    Alamat : <?= $detail['alamat_pengiriman']; ?>
                </div>
            </div> <br>
            
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama Kue</th>
                        <th class="text-center">Harga</th>
                        <th class="text-center">Jumlah</th>
                        <th class="text-center">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $nomor = 1; ?>
                    <?php $ambil = $conn->query("SELECT * FROM pembelian_produk JOIN kuebasah 
                                                ON pembelian_produk.id_produk = kuebasah.id_produk
                                                WHERE pembelian_produk.id_pembelian = '$_GET[id]'");?>
                    <?php while($pecah = $ambil->fetch_assoc()) { ?>                    
                    <tr>
                        <td><?= $nomor; ?></td>
                        <td><?= $pecah['nama']; ?></td>
                        <td>Rp. <?= number_format($pecah['harga']); ?></td>
                        <td><?= $pecah['jumlah']; ?></td>
                        <td>Rp. <?= number_format($pecah['harga'] * $pecah['jumlah']); ?></td>
                    </tr>
                    <?php $nomor++; ?>
                    <?php } ?>
                </tbody>
            </table>     
        </div>
    </section>

    <!-- akhir data detail pesanan -->

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