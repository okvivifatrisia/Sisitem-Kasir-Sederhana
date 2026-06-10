<?php

include 'koneksi.php';

$id = $_POST['id_produk'];
$nama = $_POST['nama_produk'];
$harga = $_POST['harga'];
$stok = $_POST['stok'];

// Ambil data lama
$query = mysqli_query(
    $koneksi,
    "SELECT * FROM products WHERE PRODUCT_ID='$id'"
);

$data = mysqli_fetch_array($query);

$foto_lama = $data['FOTO'];

// Jika ada foto baru diupload
if ($_FILES['foto']['name'] != '') {

    $nama_file = time() . '_' . $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];

    move_uploaded_file($tmp, "uploads/" . $nama_file);

    // Hapus foto lama
    if (!empty($foto_lama) && file_exists("uploads/" . $foto_lama)) {
        $path_foto_lama = __DIR__ . "/uploads/" . $foto_lama;

        if (!empty($foto_lama) && file_exists($path_foto_lama)) {
            unlink($path_foto_lama);
        }
    }

    mysqli_query(
        $koneksi,
        "UPDATE products
        SET
            NAMA_PRODUK='$nama',
            HARGA='$harga',
            STOK='$stok',
            FOTO='$nama_file'
        WHERE PRODUCT_ID='$id'"
    );

} else {

    mysqli_query(
        $koneksi,
        "UPDATE products
        SET
            NAMA_PRODUK='$nama',
            HARGA='$harga',
            STOK='$stok'
        WHERE PRODUCT_ID='$id'"
    );

}

header("location:kelola_produk.php");
exit;