<?php

session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

$conn = mysqli_connect("localhost", "root", "", "lempermas");

// cek apakah tombol submit sudah ditekan/belum

if ( isset($_POST["submit"]) ) {

    // cek data berhasil ditambah atau tidak
    if ( tambah($_POST) > 0 ) {

        echo "
            <script>
                alert('Data Berhasil Ditambahkan');
                document.location.href = 'admin.php';
            </script>";
        

    } else {

        echo "
            <script>
                alert('Data Gagal Ditambahkan');
                document.location.href = 'admin.php';
            </script>";
        
    }


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


    <!-- form tambah data -->
    <section class="tambah" style="margin-top: 50px;">
        <div class="container">
            <div class="col pt-2 text-center">
                <h1 class="text-success">Tambah Produk Baru</h1>
                <hr>
            </div>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="col-md-4 form-group">
                        <label for="stok">Stok Awal</label>
                        <input type="text" name="stok" class="form-control" id="stok" placeholder="Masukkan Stok Awal..." required>
                    </div>
                    <div class="col-md-5 form-group">
                        <label for="nama">Nama Produk Baru</label>
                        <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama Produk Baru..." required>
                    </div>
                    <div class="col-md-5 form-group">
                        <label for="harga">Harga Rupiah</label>
                        <input type="text" name="harga" class="form-control" id="harga" placeholder="Masukkan Harga..." required>
                    </div>
                    <div class="col-md-5 form-group">
                        <label for="satuan">Satuan</label>
                        <input type="text" name="satuan" class="form-control" id="satuan" placeholder="Masukkan Satuan..." required>
                    </div>
                    <div class="input-group col-md-5 mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Upload Foto</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" name="gambar" class="custom-file-input" id="gambar" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="gambar">Pilih File</label>
                    </div>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary mt-5">Tambah Data</button>
                </form>
        </div>
    </section>

    <!-- akhir form tambah data -->



    <!-- footer -->
    <footer class="bg-success text-white mt-5 w-100 position-static">
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