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
    
    
    <!--data detail produk -->
    <section class="konten">
        <div class="container">
            <div class="col m-5 text-center">
                    <h1 class="text-success">Detail Produk</h1>
                    <hr>
            </div>
            <?php
            $id_produk = $_GET['id'];
            $ambil = $conn->query("SELECT * FROM kuebasah WHERE id_produk = '$id_produk'");
            $detail = $ambil->fetch_assoc();

            ?>
            

            <div class="row">
                <div class="col-md-6">
                    <img src="img/<?= $detail["gambar"];?>" class="img-thumbnail w-75 h-75 float-right">
                </div>
                <div class="col-md-6">
                    <h2><?= $detail['nama']; ?></h2>
                    <h3>Harga : Rp. <?= $detail['harga']; ?>/<?= $detail['satuan'];?></h3>
                    <h3>Stok Tersisa : <?=$detail['stok']; ?> Buah</h3><br>
                    <form method="post">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="number" min="1" max="<?= $detail['stok']?>" class="form-control col-5 mr-3" name="jumlah" placeholder="Jumlah yg diinginkan">
                                    <div class="input group-button">
                                        <button class="btn btn-success" name="beli">Beli Sekarang!</button>
                                    </div>
                            </div>
                        </div>
                    </form>
                    <?php
                    if (isset($_POST['beli'])) {
                        // mendapatkan jumlah yang diinput
                        $jumlah = $_POST['jumlah'];

                        // masukkan jumlah kedalam keranjang belanja
                        $_SESSION['keranjang'][$id_produk] = $jumlah;

                        echo "<script>alert('Produk Sudah masuk kedalam Keranjang Belanja');</script>" ;
                        echo "<script>location='index.php';</script>";
                    }
                    ?>
                    <a href="index.php" class="btn btn-warning">Kembali</a>
                </div>
                
            </div>
        </div>
    </section>

    <!-- akhir data detail produk-->

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