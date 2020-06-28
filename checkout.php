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

if (!isset($_SESSION['pelanggan'])) {
    echo "<script>alert('Silahkan Login terlebih Dahulu sebelum Checkout!');</script>";
    echo "<script>location='login.php';</script>";
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
    
    
    <!--data checkout -->
    <section class="tambah" style="margin-bottom: 100px">
        <div class="container">
            <div class="col m-5 text-center">
                <h1 class="text-success">Check Out</h1>
                <hr>
            </div>
            <p class="font-weight-light">Pastikan untuk mengisi alamat pengirimannya</p>
            <table class="table table-bordered text-center">
                <thead>
                    <th class="text-center">No</th>
                    <th class="text-center">Nama Kue</th>
                    <th class="text-center">Harga</th>
                    <th class="text-center">Jumlah Pesan</th>
                    <th class="text-center">SubHarga</th>
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
                        
                    </tr>
                <?php $nomor++; ?>
                <?php $total_belanja += $subharga; ?>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <th class="text-center" colspan="4">Total</th>
                    <th class="text-center">Rp. <?= number_format($total_belanja); ?></th>
                </tfoot>
            </table>
            <form method="POST">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" readonly class="form-control text-center" value="<?= $_SESSION['pelanggan']['nama_pelanggan']; ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" readonly class="form-control text-center" value="<?= $_SESSION['pelanggan']['telepon_pelanggan']; ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <select name="id_ongkir" class="form-control">
                                    <option value="">--Pengiriman Ongkir--</option>
                                    <?php 
                                    $ambil = $conn->query("SELECT * FROM ongkir"); 
                                    while ($perongkir = $ambil->fetch_assoc()) {
                                    ?>
                                        <option value="<?= $perongkir['id_ongkir'];?>"><?= $perongkir['nama_daerah']; ?> - Rp. <?= number_format($perongkir['tarif']); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Alamat Pengiriman</label>
                        <textarea name="alamat_pengiriman" rows="2" class="form-control" style="resize: none;" required>
                        </textarea>
                    </div>
                    <button class="btn btn-success" name="checkout" onclick="return confirm('Apakah anda yakin ingin Checkout?')">Check Out</button> 
            </form>
            <?php
            if (isset($_POST['checkout'])) {
                $id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
                $id_ongkir = $_POST['id_ongkir'];
                $tanggal_pembelian = date("Y-m-d");
                $alamat_pengiriman = $_POST['alamat_pengiriman'];

                $ambil = $conn->query("SELECT * FROM ongkir WHERE id_ongkir = '$id_ongkir'");
                $array_ongkir = $ambil->fetch_assoc();
                $nama_daerah = $array_ongkir['nama_daerah'];
                $tarif = $array_ongkir['tarif'];

                $total_pembelian = $total_belanja + $tarif;

                // menyimpan data ke tabel pembelian
                $conn->query("INSERT INTO pembelian (id_pelanggan, id_ongkir, tanggal_pembelian, total_pembelian, nama_daerah, tarif, alamat_pengiriman) 
                                VALUES ('$id_pelanggan', '$id_ongkir', '$tanggal_pembelian', '$total_pembelian', '$nama_daerah', '$tarif', '$alamat_pengiriman')");

                $id_pembelian_barusan = $conn->insert_id;

                foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) {
                    $ambil2 = $conn->query("SELECT * FROM kuebasah WHERE id_produk = '$id_produk'");
                    $perproduk = $ambil2->fetch_assoc();

                    $nama = $perproduk['nama'];
                    $harga = $perproduk['harga'];
                    $subharga = $perproduk['harga'] * $jumlah;
                    $conn->query("INSERT INTO pembelian_produk (id_pembelian, id_produk, nama, harga, subharga, jumlah) 
                                VALUES ('$id_pembelian_barusan', '$id_produk', '$nama', '$harga', '$subharga', '$jumlah')");

                    $conn->query("UPDATE kuebasah SET stok = stok - $jumlah WHERE id_produk='$id_produk'");
                }

                // mengkosongkan keranjang belanja
                unset($_SESSION['keranjang']);

                echo "<script>alert('Pembelian Sukses');</script>";
                echo "<script>location='nota.php?id=$id_pembelian_barusan';</script>";

                $_SESSION['checkout'] = true;

            }
            ?>
        </div>
    </section>

    <!-- akhir data checkout -->

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