<?php
session_start();

unset($_SESSION['cart']); 

header("Location: ../transaksi.php?cart=open");
exit;
?>