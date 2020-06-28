<?php
// <!-- koneksi database -->

$conn = mysqli_connect("localhost", "root", "", "lempermas");

// fungsi query
function query ($query) {

    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }

    return $rows;
}


function tambah ($data) {

    global $conn;

    // ambil data disetiap elemen form
    $stok = htmlspecialchars($data["stok"]);
    $nama = htmlspecialchars($data["nama"]);
    $harga = htmlspecialchars($data["harga"]);
    $satuan = htmlspecialchars($data["satuan"]);
    

    // upload gambar
    $gambar = upload();
    if ( !$gambar ) {
        return false;
    }

    // query insert data

    $query = "INSERT INTO kuebasah
                VALUES
                ('', '$stok', '$nama', '$satuan', '$harga', '$gambar')
            ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);


}

function upload() {
    
    $namaFile = $_FILES["gambar"]['name'];
    $ukuranFIle = $_FILES["gambar"]['size'];
    $error = $_FILES["gambar"]['error'];
    $tmpName = $_FILES["gambar"]['tmp_name'];


    // cek user apakah mengupload gambar atau tidak
    if ( $error === 4 ) {
        echo "<script>
                alert('pilih gambar terlebih dahulu');
            </script>";
        return false;
    }

    // cek user harus mengupload hanya gambar
    $ekstensiGambarValid = ['jpg','png','jpeg'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    // $format = pathinfo($namaFile, PATHINFO_EXTENSION);

    if ( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
        echo "<script>
                alert('yang anda upload bukan gambar!');
            </script>";
        return false;
    }

    if ( $ukuranFIle > 2000000 ) {
        echo "<script>
                alert('ukuran gambar yg anda upload terlalu besar!');
            </script>";

        return false;
    }

    // lulus pengecekan, data gambar akan diupload
    // buat nama file menggunakan pembangkit random string number
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName,'img/'.$namaFileBaru);

    return $namaFileBaru;
}

function hapus ($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM kuebasah WHERE id_produk = $id");
    return mysqli_affected_rows($conn);

}

function ubah ($data) {

    global $conn;

    // ambil data disetiap elemen form
    $id = $data["id"];
    $stok = htmlspecialchars($data["stok"]);
    $nama = htmlspecialchars($data["nama"]);
    $harga = htmlspecialchars($data["harga"]);
    $satuan = htmlspecialchars($data["satuan"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    // fungsi upload gambar
    if ( $_FILES['gambar']['error'] === 4 ){
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    // query insert data

    $query = "UPDATE kuebasah SET
                stok = '$stok',
                nama = '$nama',
                harga = '$harga',
                satuan = '$satuan',
                gambar = '$gambar'
                WHERE id_produk = $id
            ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

}

function cari ($keyword) {
    $query = "SELECT * FROM kuebasah
                WHERE
                nama LIKE '%$keyword%' OR
                harga LIKE '%$keyword%'

            ";
    
    return query($query);

}









?>