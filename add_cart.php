<?php
session_start();

$id = $_POST['id'];
$nama = $_POST['nama'];
$harga = $_POST['harga'];

if (isset($_SESSION['cart'][$id])) {
    $_SESSION['cart'][$id]['qty']++;
} else {
    $_SESSION['cart'][$id] = [
        'id' => $id,
        'nama' => $nama,
        'harga' => $harga,
        'qty' => 1
    ];
}

header("Location: ../transaksi.php");
exit;
?>