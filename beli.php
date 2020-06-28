<?php

session_start();

require 'functions.php';

// mendapatkan id url dan jumlah pesanan
$id_kue = $_GET['id'];

$avstok = $conn->query("SELECT * FROM kuebasah WHERE id_produk = '$id_kue'");
$detailstok = $avstok->fetch_assoc();


if ( $detailstok['stok'] == 0 ) {
    echo "<script>alert('Produk ini sudah habis, silahkan pesan yang masih tersedia')</script>";
    echo "<script>location='index.php'</script>";
}

else if ( isset($_SESSION['keranjang'][$id_kue]) ) {
        $_SESSION['keranjang'][$id_kue] += 1;
} 
else {
    $_SESSION['keranjang'][$id_kue] = 1;
}



// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";

echo "<script>alert('Produk telah masuk ke daftar pesan anda')</script>";
echo "<script>location='index.php'</script>";



?>