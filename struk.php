<?php
// Mengamankan jalur file koneksi menggunakan dirname(__DIR__) agar tidak salah alamat
if (!isset($koneksi)) {
    include_once dirname(__DIR__) . "/koneksi.php"; 
}

$id = $_GET['id'] ?? '';

$data = mysqli_fetch_assoc(
    mysqli_query(
        $koneksi,
        "SELECT
            t.*,
            pm.NAMA_METODE
         FROM transactions t
         LEFT JOIN payments p
            ON t.PAYMENT_ID = p.PAYMENT_ID
         LEFT JOIN payment_methods pm
            ON p.METHOD_ID = pm.METHOD_ID
         WHERE t.TRANSACTION_ID = '$id'"
    )
);

if (!$data) {
    die("Transaksi tidak ditemukan");
}

$detail = mysqli_query(
    $koneksi,
    "SELECT
        td.*,
        p.NAMA_PRODUK
     FROM transaction_details td
     JOIN products p
        ON td.PRODUCT_ID = p.PRODUCT_ID
     WHERE td.TRANSACTION_ID = '$id'"
);

$statusMap = [
    'STS01' => 'Pending',
    'STS02' => 'Success',
    'STS03' => 'Cancelled'
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Pembelian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0">
                <div class="card-body p-4">

                    <div class="text-center mb-4">
                        <h3 class="fw-bold">🌸 Toko Bunga</h3>
                        <p class="text-muted mb-0">Struk Pembelian</p>
                    </div>

                    <hr>

                    <div class="mb-3">
                        <p class="mb-1"><strong>No Transaksi:</strong> <?= htmlspecialchars($data['TRANSACTION_ID']) ?></p>
                        <p class="mb-1"><strong>Status:</strong> <?= $statusMap[$data['STATUS_ID']] ?? $data['STATUS_ID'] ?></p>
                        <p class="mb-1"><strong>Metode:</strong> <?= htmlspecialchars($data['NAMA_METODE'] ?? '-') ?></p>
                        <p class="mb-0"><strong>Tanggal:</strong> <?= date('d M Y H:i') ?></p>
                    </div>

                    <hr>

                    <h5 class="mb-3">Detail Pesanan</h5>

                    <?php
                    $total = 0;
                    while ($d = mysqli_fetch_assoc($detail)):
                        $total += $d['SUBTOTAL'];
                    ?>

                    <div class="d-flex justify-content-between mb-2">
                        <div>
                            <?= htmlspecialchars($d['NAMA_PRODUK']) ?>
                            <small class="text-muted">(<?= $d['JUMLAH'] ?>x)</small>
                        </div>
                        <div>Rp <?= number_format($d['SUBTOTAL'], 0, ',', '.') ?></div>
                    </div>

                    <?php endwhile; ?>

                    <hr>

                    <div class="d-flex justify-content-between">
                        <strong>Total</strong>
                        <strong>Rp <?= number_format($total, 0, ',', '.') ?></strong>
                    </div>

                    <div class="text-center mt-4">
                        <p class="text-muted small mb-3">Terima kasih telah berbelanja 🌷</p>

                        <a href="../transaksi.php" class="btn btn-success w-100">
                            Kembali ke Halaman Transaksi
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>