<?php
include "../koneksi.php";

$id = $_GET['id'] ?? '';

mysqli_query(
    $koneksi,
    "DELETE FROM transaction_details
     WHERE TRANSACTION_ID = '$id'"
);

mysqli_query(
    $koneksi,
    "DELETE FROM transactions
     WHERE TRANSACTION_ID = '$id'"
);

header("Location: ../transaksi.php");
exit;