<?php
session_start();
include "../koneksi.php";

$id = $_GET['id'] ?? '';
$aksi = $_GET['aksi'] ?? '';

if (!isset($_SESSION['cart'][$id])) {
    header("Location: ../transaksi.php");
    exit;
}

if ($aksi == 'plus') {

    $produk = mysqli_fetch_assoc(
        mysqli_query(
            $koneksi,
            "SELECT STOK
             FROM products
             WHERE PRODUCT_ID='$id'"
        )
    );

    if ($_SESSION['cart'][$id]['qty'] < $produk['STOK']) {
        $_SESSION['cart'][$id]['qty']++;
    }

} elseif ($aksi == 'minus') {

    $_SESSION['cart'][$id]['qty']--;

    if ($_SESSION['cart'][$id]['qty'] <= 0) {
        unset($_SESSION['cart'][$id]);
    }
}

echo json_encode([
    'success' => true,
    'cart' => $_SESSION['cart']
]);
exit;