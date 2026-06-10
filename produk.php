<?php
if (!isset($koneksi)) {
    include_once dirname(__DIR__) . "/koneksi.php";
}

$produk = mysqli_query(
    $koneksi,
    "SELECT * FROM products"
);
?>

<style>
    .section-produk-kasir,
    .section-produk-kasir * {
        font-family: 'Poppins', sans-serif !important;
        color: black !important;
    }

    @media (min-width: 992px) {
        .col-lg-2-4 {
            flex: 0 0 auto;
            width: 20%;
        }
    }

    .card-produk {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        border: 1px solid #eee;
        border-radius: 10px;
        overflow: hidden;
        font-size: 0.85rem;
        background-color: white;
    }

    .card-produk:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(247, 160, 184, 0.15) !important;
        border-color: #f7a0b8;
    }

    .img-wrapper {
        position: relative;
        overflow: hidden;
        background-color: #fcfcfc;
        height: 140px;
    }

    .badge-stok {
        position: absolute;
        top: 8px;
        right: 8px;
        z-index: 2;
        font-size: 0.65rem;
        padding: 3px 8px;
        border-radius: 30px;
        font-weight: 600;
    }

    .harga-produk {
        font-size: 0.95rem;
        color: #dc3545 !important;
        /* Keep original red alert style for price */
    }

    .card-title-compact {
        font-size: 0.85rem;
        min-height: 38px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        line-height: 1.3;
        margin-bottom: 5px !important;
    }

    .btn-sm-custom {
        padding: 5px 10px;
        font-size: 0.8rem;
        border-radius: 8px;
    }

    .btn-pink-custom {
        background-color: #f7a0b8 !important;
        border-color: #f7a0b8 !important;
        color: white !important;
    }

    .btn-pink-custom:hover {
        background-color: white !important;
        border-color: #f7a0b8 !important;
        color: #f7a0b8 !important;
    }

    .btn-pink-custom i {
        color: inherit !important;
    }

    .custom-dataTables-filter input {
        border: 1px solid #f7a0b8;
        padding: 6px 12px;
        border-radius: 4px;
        font-size: 0.875rem;
        width: 100%;
    }

    .custom-dataTables-filter input:focus {
        border-color: #f7a0b8 !important;
        box-shadow: none !important;
        outline: none !important;
    }

    /* Pagination exact copy style */
    .pagination-produk .page-link {
        background-color: #f7a0b8 !important;
        border-color: #f7a0b8 !important;
        color: white !important;
        padding: 6px 12px;
        font-size: 0.875rem;
        cursor: pointer;
    }

    .pagination-produk .page-link:hover,
    .pagination-produk .page-link:focus {
        background-color: white !important;
        border-color: #f7a0b8 !important;
        color: #f7a0b8 !important;
        box-shadow: none !important;
        outline: none !important;
    }

    .pagination-produk .page-item.active .page-link {
        background-color: white !important;
        border-color: #f7a0b8 !important;
        color: #f7a0b8 !important;
        font-weight: 600;
    }



    /* Info text layout */
    .custom-dataTables-info {
        font-size: 0.875rem;
        color: black !important;
    }
</style>

<section class="py-0 section-produk-kasir">
    <div class="container-fluid px-2">

        <div class="row mb-3 justify-content-end">
            <div class="col-md-4 col-sm-12 text-end">
                <div
                    class="custom-dataTables-filter d-flex align-items-center justify-content-md-end justify-content-center">
                    <span class="me-2 d-none d-sm-inline">Search:</span>
                    <input type="text" id="internalSearchProduk" placeholder="Cari transaksi...">
                </div>
            </div>
        </div>

        <div class="row g-3" id="pembungkusCardProduk">
            <?php while ($item = mysqli_fetch_assoc($produk)): ?>
                <div class="col-6 col-md-4 col-lg-2-4 item-card-produk">
                    <div class="card h-100 card-produk shadow-sm">

                        <div class="img-wrapper">
                            <?php if ($item['STOK'] <= 0): ?>
                                <span class="badge bg-secondary badge-stok text-white">Habis</span>
                            <?php elseif ($item['STOK'] <= 5): ?>
                                <span class="badge bg-warning badge-stok text-dark">Sisa <?= $item['STOK']; ?></span>
                            <?php else: ?>
                                <span class="badge bg-pink badge-stok text-white"
                                    style="background-color: #f7a0b8 !important;">Ready</span>
                            <?php endif; ?>

                            <?php if (!empty($item['FOTO'])): ?>
                                <img src="uploads/<?= $item['FOTO']; ?>" class="card-img-top w-100"
                                    style="height:140px; object-fit:cover;">
                            <?php else: ?>
                                <div class="d-flex align-items-center justify-content-center text-muted bg-light"
                                    style="height:140px;">
                                    <i class="bi bi-image fs-2 opacity-20" style="color: #6c757d !important;"></i>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="card-body d-flex flex-column p-2">
                            <small class="text-muted mb-0 d-block"
                                style="font-size: 0.7rem; color: #6c757d !important;"><?= htmlspecialchars($item['KODE_PRODUK'] ?? ''); ?></small>

                            <h6 class="card-title fw-semibold card-title-compact">
                                <?= $item['NAMA_PRODUK']; ?>
                            </h6>

                            <div class="mb-2">
                                <div class="harga-produk fw-bold">
                                    Rp <?= number_format($item['HARGA'], 0, ',', '.'); ?>
                                </div>
                                <small style="font-size: 0.75rem;">Stok: <strong><?= $item['STOK']; ?></strong></small>
                            </div>

                            <form action="kasir/add_cart.php" method="POST" class="mt-auto">
                                <input type="hidden" name="id" value="<?= $item['PRODUCT_ID']; ?>">
                                <input type="hidden" name="nama" value="<?= $item['NAMA_PRODUK']; ?>">
                                <input type="hidden" name="harga" value="<?= $item['HARGA']; ?>">

                                <button
                                    class="btn <?= ($item['STOK'] <= 0) ? 'btn-secondary' : 'btn-pink-custom'; ?> w-100 fw-medium btn-sm-custom shadow-sm"
                                    <?= ($item['STOK'] <= 0) ? 'disabled' : ''; ?>>
                                    <?php if ($item['STOK'] <= 0): ?>
                                        <i class="bi bi-x-circle me-1"></i> Habis
                                    <?php else: ?>
                                        <i class="bi bi-cart-plus me-1"></i> Add
                                    <?php endif; ?>
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <div class="row mt-4 align-items-center">
            <div class="col-md-6 col-sm-12 text-md-start text-center mb-3 mb-md-0">
                <div class="custom-dataTables-info" id="internalInfoProduk">
                </div>
            </div>
            <div class="col-md-6 col-sm-12 d-flex justify-content-md-end justify-content-center">
                <nav>
                    <ul class="pagination pagination-produk mb-0" id="internalPaginationProduk">
                    </ul>
                </nav>
            </div>
        </div>

    </div>
</section>

<script>
    window.addEventListener('DOMContentLoaded', function () {
        if (typeof jQuery !== 'undefined') {
            (function ($) {
                const cardSelector = '.item-card-produk';
                const itemsPerPage = 10;
                let currentPage = 1;
                let filteredItems = $(cardSelector);

                function showPage(page) {
                    currentPage = page;
                    const totalItems = filteredItems.length;

                    const start = (page - 1) * itemsPerPage;
                    const end = Math.min(start + itemsPerPage, totalItems);

                    $(cardSelector).hide();
                    filteredItems.slice(start, end).show();

                    // Render Info Text (Menampilkan 1 sampai 10 dari X data)
                    if (totalItems === 0) {
                        $('#internalInfoProduk').text("Menampilkan 0 sampai 0 dari 0 data");
                    } else {
                        $('#internalInfoProduk').text(`Menampilkan ${start + 1} sampai ${end} dari ${totalItems} data`);
                    }

                    renderPagination();
                }

                function renderPagination() {
                    const totalPages = Math.ceil(filteredItems.length / itemsPerPage);
                    let paginationHtml = '';

                    if (totalPages > 1) {
                        // Previous (Menggunakan tanda << persis DataTables kamu)
                        paginationHtml += `<li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                            <a class="page-link" data-page="${currentPage - 1}">&lt;&lt;</a>
                        </li>`;

                        // Angka Halaman
                        for (let i = 1; i <= totalPages; i++) {
                            paginationHtml += `<li class="page-item ${currentPage === i ? 'active' : ''}">
                                <a class="page-link" data-page="${i}">${i}</a>
                            </li>`;
                        }

                        // Next (Menggunakan tanda >> persis DataTables kamu)
                        paginationHtml += `<li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
                            <a class="page-link" data-page="${currentPage + 1}">&gt;&gt;</a>
                        </li>`;
                    }

                    $('#internalPaginationProduk').html(paginationHtml);
                }

                // Live Search Input Tracker
                $('#internalSearchProduk').on('keyup', function () {
                    const searchTerm = $(this).val().toLowerCase();

                    filteredItems = $(cardSelector).filter(function () {
                        return $(this).text().toLowerCase().indexOf(searchTerm) > -1;
                    });

                    if (searchTerm === '') {
                        filteredItems = $(cardSelector);
                    }

                    showPage(1);
                });

                // Klik Event halaman pagination
                $(document).on('click', '#internalPaginationProduk .page-link', function (e) {
                    e.preventDefault();
                    const targetPage = $(this).data('page');
                    if (targetPage && !$(this).parent().hasClass('disabled') && !$(this).parent().hasClass('active')) {
                        showPage(targetPage);
                    }
                });

                // Start engine
                showPage(1);
            })(jQuery);
        }
    });
</script>