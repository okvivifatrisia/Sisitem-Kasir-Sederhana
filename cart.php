<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$totalHarga = 0;
?>
<style>
    .qty-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
    }

    .qty-btn {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: #f7a0b8;
        color: white;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }

    .qty-btn:hover {
        background: #e88ca7;
        color: white;
    }

    .qty-value {
        min-width: 25px;
        text-align: center;
        font-weight: 600;
        color: #d46a92;
    }
</style>
<div class="modal fade" id="cartModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Keranjang Belanja</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body" id="cart-body">
                <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
                    <?php foreach ($_SESSION['cart'] as $id => $item): ?>
                        <?php
                        $subtotal = $item['harga'] * $item['qty'];
                        $totalHarga += $subtotal;
                        ?>
                        <div class="row border-bottom py-2 align-items-center">
                            <div class="col-md-4">
                                <?= $item['nama']; ?>
                            </div>
                            <div class="col-md-2">

                                <div class="qty-wrapper">
                                    <a href="#" onclick="updateCart('<?= $id ?>','minus')" class="qty-btn">−</a>

                                    <span class="qty-value">
                                        <?= $item['qty']; ?>
                                    </span>

                                    <a href="#" onclick="updateCart('<?= $id ?>','plus')" class="qty-btn">+</a>
                                </div>

                            </div>
                            <div class="col-md-3">
                                Rp <?= number_format($item['harga'], 0, ',', '.'); ?>
                            </div>
                            <div class="col-md-3 text-end mb-0">
                                <strong>Rp <?= number_format($subtotal, 0, ',', '.'); ?></strong>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="text-center py-4 text-muted">
                        <i class="bi bi-cart-x fs-1 d-block mb-2"></i>
                        Keranjang masih kosong
                    </div>
                <?php endif; ?>
            </div>

            <div class="modal-footer">
                <h5 class="me-auto">
                    Total: <span class="text-danger">Rp <?= number_format($totalHarga, 0, ',', '.'); ?></span>
                </h5>

                <!-- JALUR CHECKOUT DISESUAIKAN -->
                <a href="kasir/checkout.php" class="btn btn-success">Checkout</a>
                <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>

        </div>
    </div>
</div>

<script>
   function updateCart(id, aksi){

    fetch('kasir/update_cart.php?id=' + id + '&aksi=' + aksi)
    .then(res => res.json())
    .then(data => {

        // refresh isi modal saja
        fetch('kasir/cart.php')
        .then(res => res.text())
        .then(html => {

            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');

            document.querySelector('#cartModal .modal-content').innerHTML =
            doc.querySelector('#cartModal .modal-content').innerHTML;

        });

    });

}
</script>