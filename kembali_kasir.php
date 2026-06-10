<?php
session_start();
include dirname(__DIR__) . "/koneksi.php"; 

$id = $_GET['id'] ?? '';

$detail = mysqli_query(
    $koneksi,
    "SELECT
        td.*,
        p.NAMA_PRODUK,
        p.HARGA
     FROM transaction_details td
     JOIN products p
        ON td.PRODUCT_ID = p.PRODUCT_ID
     WHERE td.TRANSACTION_ID='$id'"
);

$_SESSION['cart'] = [];

while($row = mysqli_fetch_assoc($detail))
{
    $_SESSION['cart'][$row['PRODUCT_ID']] = [
        'nama' => $row['NAMA_PRODUK'],
        'harga' => $row['HARGA'],
        'qty' => $row['JUMLAH']
    ];
}

mysqli_query(
    $koneksi,
    "DELETE FROM transaction_details
     WHERE TRANSACTION_ID='$id'"
);

mysqli_query(
    $koneksi,
    "DELETE FROM transactions
     WHERE TRANSACTION_ID='$id'"
);

header("Location: ../transaksi.php?cart=open");
exit;