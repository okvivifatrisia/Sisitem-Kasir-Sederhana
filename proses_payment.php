<?php
session_start();

include dirname(__DIR__) . "/koneksi.php"; 

$id = $_GET['id'] ?? '';
$metode = $_GET['metode'] ?? '';

if (empty($id) || empty($metode)) {
    die("Data transaksi atau metode pembayaran tidak valid.");
}

/*
|--------------------------------------------------------------------------
| Tentukan METHOD_ID
|--------------------------------------------------------------------------
*/
if ($metode == 'cash') {
    $method_id = 'pay01';
} else {
    $method_id = 'pay02';
}

/*
|--------------------------------------------------------------------------
| Ambil data transaksi
|--------------------------------------------------------------------------
*/
// Pastikan variabel koneksi menggunakan yang ada di file koneksi.php Anda (di sini diasumsikan $koneksi)
$queryTrx = mysqli_query(
    $koneksi,
    "SELECT * FROM transactions WHERE TRANSACTION_ID = '$id'"
);

if (!$queryTrx) {
    die("Query Error: " . mysqli_error($koneksi));
}

$trx = mysqli_fetch_assoc($queryTrx);

if (!$trx) {
    die("Transaksi dengan ID $id tidak ditemukan di database.");
}

/*
|--------------------------------------------------------------------------
| Generate PAYMENT_ID
|--------------------------------------------------------------------------
*/
$cek = mysqli_query(
    $koneksi,
    "SELECT PAYMENT_ID FROM payments ORDER BY PAYMENT_ID DESC LIMIT 1"
);

$data = mysqli_fetch_assoc($cek);

if ($data) {
    $nomor = (int) substr($data['PAYMENT_ID'], 3) + 1;
} else {
    $nomor = 1;
}

$paymentId = "PAY" . str_pad($nomor, 3, "0", STR_PAD_LEFT);

/*
|--------------------------------------------------------------------------
| Simpan payment
|--------------------------------------------------------------------------
*/
$totalBayar = $trx['TOTAL_HARGA'];
mysqli_query(
    $koneksi,
    "INSERT INTO payments (
        PAYMENT_ID,
        TRANSACTION_ID,
        METHOD_ID,
        NOMINAL_BAYAR,
        KEMBALIAN
    ) VALUES (
        '$paymentId',
        '$id',
        '$method_id',
        $totalBayar,
        0
    )"
);

/*
|--------------------------------------------------------------------------
| Update transaksi
|--------------------------------------------------------------------------
*/
mysqli_query(
    $koneksi,
    "UPDATE transactions SET
        STATUS_ID = 'STS02',
        PAYMENT_ID = '$paymentId'
     WHERE TRANSACTION_ID = '$id'"
);

header("Location: struk.php?id=$id");

// Kurangi stok produk setelah transaksi berhasil
$detail = mysqli_query(
    $koneksi,
    "SELECT PRODUCT_ID, JUMLAH
     FROM transaction_details
     WHERE TRANSACTION_ID = '$id'"
);

while ($row = mysqli_fetch_assoc($detail)) {

    $productId = $row['PRODUCT_ID'];
    $qty = $row['JUMLAH'];

    mysqli_query(
        $koneksi,
        "UPDATE products
         SET STOK = STOK - $qty
         WHERE PRODUCT_ID = '$productId'"
    );
}
exit;
?>