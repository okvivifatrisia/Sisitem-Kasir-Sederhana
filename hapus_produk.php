<?php

include 'koneksi.php';

$id = $_GET['id'];

// Ambil data produk
$query = mysqli_query(
    $koneksi,
    "SELECT FOTO FROM products WHERE PRODUCT_ID='$id'"
);

$data = mysqli_fetch_assoc($query);

// Hapus file foto dari folder uploads
if (!empty($data['FOTO'])) {

    $path_foto = "uploads/" . $data['FOTO'];

    if (file_exists($path_foto)) {
        unlink($path_foto);
    }
}

// Hapus data dari database
mysqli_query(
    $koneksi,
    "DELETE FROM products WHERE PRODUCT_ID='$id'"
);

header("location:kelola_produk.php");
exit;