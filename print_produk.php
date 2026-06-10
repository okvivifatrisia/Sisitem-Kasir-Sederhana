<?php
include 'koneksi.php';

$data = mysqli_query($koneksi, "SELECT * FROM products ORDER BY PRODUCT_ID ASC");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Laporan Data Produk</title>

    <style>
        body{
            font-family: Arial, sans-serif;
            margin:30px;
        }
        
        .sidebar-brand .brand-text {
    font-family: 'Poppins', sans-serif !important;
    font-weight: 400;
    color: #ffffff !important;
}    

        h2{
            text-align:center;
            margin-bottom:5px;
        }

        p{
            text-align:center;
            margin-top:0;
            margin-bottom:20px;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        table, th, td{
            border:1px solid #000;
        }

        th{
            background:#f2f2f2;
        }

        th, td{
            padding:8px;
            text-align:center;
        }

        img{
            width:60px;
            height:60px;
            object-fit:cover;
        }

        .ttd{
            width:250px;
            margin-left:auto;
            margin-top:50px;
            text-align:center;
        }

        @media print{
            body{
                margin:15px;
            }
        }
    </style>
</head>

<body>

    <h2>LAPORAN DATA PRODUK</h2>
    <p>Toko Bunga</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID Produk</th>
                <th>Foto</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Stok</th>
            </tr>
        </thead>

        <tbody>

            <?php
            $no = 1;

            while($d = mysqli_fetch_array($data)){
            ?>

            <tr>
                <td><?= $no++; ?></td>

                <td><?= $d['PRODUCT_ID']; ?></td>

                <td>
                    <?php if(!empty($d['FOTO'])){ ?>
                        <img src="uploads/<?= $d['FOTO']; ?>">
                    <?php }else{ ?>
                        -
                    <?php } ?>
                </td>

                <td><?= $d['NAMA_PRODUK']; ?></td>

                <td>
                    Rp <?= number_format($d['HARGA'],0,',','.'); ?>
                </td>

                <td><?= $d['STOK']; ?></td>
            </tr>

            <?php } ?>

        </tbody>
    </table>

    <div class="ttd">
        <p>Sidoarjo, <?= date('d-m-Y'); ?></p>
        <br><br><br>

        <b>Admin</b>
    </div>

    <script>
        window.onload = function(){
            window.print();
        }
    </script>

</body>

</html>