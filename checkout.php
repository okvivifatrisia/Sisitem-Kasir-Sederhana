<?php
session_start();
include "../koneksi.php";

if (empty($_SESSION['cart'])) {
    header("Location: ../transaksi.php");
    exit;
}

$total = 0;

foreach ($_SESSION['cart'] as $item) {
    $total += ($item['harga'] * $item['qty']);
}

/*
|--------------------------------------------------------------------------
| Generate ID transaksi
|--------------------------------------------------------------------------
*/

$cek = mysqli_query($koneksi, "
    SELECT TRANSACTION_ID
    FROM transactions
    ORDER BY TRANSACTION_ID DESC
    LIMIT 1
");

$data = mysqli_fetch_assoc($cek);

if ($data) {
    $nomor = (int) substr($data['TRANSACTION_ID'], 3) + 1;
} else {
    $nomor = 1;
}

$transaksi_id = "TRX" . str_pad($nomor, 7, "0", STR_PAD_LEFT);

/*
|--------------------------------------------------------------------------
| Simpan transaksi
|--------------------------------------------------------------------------
*/

mysqli_query(
    $koneksi,
    "INSERT INTO transactions
    (
        TRANSACTION_ID,
        STATUS_ID,
        TRANSACTION_DATE,
        TOTAL_HARGA
    )
    VALUES
    (
        '$transaksi_id',
        'STS01',
        NOW(),
        $total
    )"
);

/*
|--------------------------------------------------------------------------
| Simpan detail transaksi
|--------------------------------------------------------------------------
*/

$detailNo = 1;

$cekDetail = mysqli_query(
    $koneksi,
    "SELECT DETAIL_ID
     FROM transaction_details
     ORDER BY DETAIL_ID DESC
     LIMIT 1"
);

$dataDetail = mysqli_fetch_assoc($cekDetail);

if ($dataDetail) {
    $detailNo = (int)substr($dataDetail['DETAIL_ID'], 2) + 1;
} else {
    $detailNo = 1;
}

foreach ($_SESSION['cart'] as $productId => $item) {

    $qty = (int)$item['qty'];

    $subtotal = $item['harga'] * $qty;

    $detail_id =
        "DT" .
        str_pad($detailNo, 4, "0", STR_PAD_LEFT);

    mysqli_query(
        $koneksi,
        "INSERT INTO transaction_details
        (
            DETAIL_ID,
            TRANSACTION_ID,
            PRODUCT_ID,
            JUMLAH,
            SUBTOTAL
        )
        VALUES
        (
            '$detail_id',
            '$transaksi_id',
            '$productId',
            $qty,
            $subtotal
        )"
    );

    $detailNo++;
}

unset($_SESSION['cart']);

header("Location: payment.php?id=" . $transaksi_id);
exit;