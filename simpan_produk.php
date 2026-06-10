<?php

include 'koneksi.php';

$id     = $_POST['id_produk'];
$nama   = $_POST['nama_produk'];
$harga  = $_POST['harga'];
$stok   = $_POST['stok'];

// Upload Foto
$foto = $_FILES['foto']['name'];
$tmp  = $_FILES['foto']['tmp_name'];

if($foto != ''){
    
    $namaFoto = time().'_'.$foto;

    move_uploaded_file(
        $tmp,
        "uploads/".$namaFoto
    );

}else{

    $namaFoto = '';

}

$cek = mysqli_query(
    $koneksi,
    "SELECT * FROM products WHERE PRODUCT_ID='$id'"
);

if(mysqli_num_rows($cek) > 0){

    if($namaFoto != ''){

        mysqli_query($koneksi,"
            UPDATE products
            SET
                NAMA_PRODUK='$nama',
                HARGA='$harga',
                STOK='$stok',
                FOTO='$namaFoto'
            WHERE PRODUCT_ID='$id'
        ");

    }else{

        mysqli_query($koneksi,"
            UPDATE products
            SET
                NAMA_PRODUK='$nama',
                HARGA='$harga',
                STOK='$stok'
            WHERE PRODUCT_ID='$id'
        ");

    }

}else{

    mysqli_query($koneksi,"
        INSERT INTO products
        (
            PRODUCT_ID,
            NAMA_PRODUK,
            HARGA,
            STOK,
            FOTO
        )
        VALUES
        (
            '$id',
            '$nama',
            '$harga',
            '$stok',
            '$namaFoto'
        )
    ");

}

header("Location: kelola_produk.php");
exit;
