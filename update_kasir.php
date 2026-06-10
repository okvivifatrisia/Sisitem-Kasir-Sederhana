<?php
session_start();

$id = $_GET['id'];
$aksi = $_GET['aksi'];

if (isset($_SESSION['cart'][$id])) {

    if ($aksi == 'tambah') {
        $_SESSION['cart'][$id]['qty']++;
    }

    if ($aksi == 'kurang') {
        $_SESSION['cart'][$id]['qty']--;

        if ($_SESSION['cart'][$id]['qty'] <= 0) {
            unset($_SESSION['cart'][$id]);
        }
    }
}
$_SESSION['open_cart'] = true;

header("Location: ../transaksi.php?cart=open");
exit;
?>