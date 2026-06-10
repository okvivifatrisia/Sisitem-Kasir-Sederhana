-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Jun 2026 pada 04.53
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasir`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `payments`
--

CREATE TABLE `payments` (
  `PAYMENT_ID` char(6) NOT NULL,
  `TRANSACTION_ID` char(10) DEFAULT NULL,
  `METHOD_ID` char(6) DEFAULT NULL,
  `NOMINAL_BAYAR` decimal(10,0) DEFAULT NULL,
  `KEMBALIAN` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `payments`
--

INSERT INTO `payments` (`PAYMENT_ID`, `TRANSACTION_ID`, `METHOD_ID`, `NOMINAL_BAYAR`, `KEMBALIAN`) VALUES
('PAY001', 'TRX0000003', 'pay01', 6000, 0),
('PAY002', 'TRX0000004', 'pay02', 5000, 0),
('PAY003', 'TRX0000005', 'pay02', 6000, 0),
('PAY004', 'TRX0000006', 'pay01', 6000, 0),
('PAY005', 'TRX0000007', 'pay02', 10000, 0),
('PAY006', 'TRX0000008', 'pay01', 64000, 0),
('PAY007', 'TRX0000009', 'pay01', 18000, 0),
('PAY008', 'TRX0000010', 'pay01', 17000, 0),
('PAY009', 'TRX0000011', 'pay01', 12000, 0),
('PAY010', 'TRX0000012', 'pay02', 5000, 0),
('PAY011', 'TRX0000013', 'pay02', 49500, 0),
('PAY012', 'TRX0000015', 'pay02', 6000, 0),
('PAY013', 'TRX0000016', 'pay01', 5000, 0),
('PAY014', 'TRX0000017', 'pay02', 5000, 0),
('PAY015', 'TRX0000018', 'pay02', 18000, 0),
('PAY016', 'TRX0000019', 'pay02', 48000, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `payment_methods`
--

CREATE TABLE `payment_methods` (
  `METHOD_ID` char(6) NOT NULL,
  `NAMA_METODE` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `payment_methods`
--

INSERT INTO `payment_methods` (`METHOD_ID`, `NAMA_METODE`) VALUES
('pay01', 'cash'),
('pay02', 'qris');

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `PRODUCT_ID` char(6) NOT NULL,
  `NAMA_PRODUK` varchar(50) DEFAULT NULL,
  `HARGA` decimal(10,0) DEFAULT NULL,
  `STOK` int(11) DEFAULT NULL,
  `FOTO` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`PRODUCT_ID`, `NAMA_PRODUK`, `HARGA`, `STOK`, `FOTO`) VALUES
('B001', 'Mawar Pink', 5000, 900, '1780334188_mawar.jpg'),
('B002', 'Mawar Merah', 6000, 12, '1780334380_mawar merah.jpg'),
('B003', 'Mawar Putih', 6000, 4, '1780334511_mawar putih.jpg'),
('B004', 'Tulip Kuning', 12000, 8, '1780334893_tulip kuning.jpg'),
('B005', 'Tulip Merah', 12000, 7, '1780335135_tulip merah.jpg'),
('B006', 'Anggrek Putih', 25000, 5, '1780335207_anggrek putih.jpg'),
('B007', 'Anggrek Ungu', 28000, 4, '1780335464_tulip ungu.jpg'),
('B008', 'Melati', 3000, 30, '1780335769_melati.jpg'),
('B009', 'Eucalyptus', 8000, 25, '1780336072_eucalyptus.jpg'),
('B010', 'Lavender', 15000, 10, '1780336173_lavender.jpg'),
('B011', 'Lily Putih', 18000, 9, '1780336216_lily putih.jpg'),
('B012', 'Lily Orange', 18000, 8, '1780336386_lily oren.jpg'),
('B013', 'Krisan Kuning', 7000, 20, '1780336448_krian kuning.jpg'),
('B014', 'Krisan Putih', 7000, 18, '1780336522_krisan putih.jpg'),
('B015', 'Bunga Matahari', 10000, 12, '1780336562_bunga matahari.jpg'),
('B016', 'Bougenville', 8000, 14, '1780336650_Bougenville.jpg'),
('B017', 'Ranunculus Pink', 20000, 11, '1780336847_Ranunculus Pink.jpg'),
('B018', 'Ranunculus Putih', 20000, 10, '1780336937_ranunculus Putih.jpg'),
('B019', 'Gerbera Pink', 8500, 15, '1780336989_Gerbera Pink.jpg'),
('B020', 'Gerbera Kuning', 8500, 15, '1780337027_Gerbera Kuning.jpg'),
('B021', 'Hortensia Biru', 22000, 6, '1780337074_Hortensia Biru.jpg'),
('B022', 'Hortensia Pink', 22000, 6, '1780337120_Hortensia Pink.jpg'),
('B023', 'Peony Pink', 30000, 4, '1780337162_peony pink.jpg'),
('B024', 'Peony Putih', 30000, 4, '1780337247_peony putih.jpg'),
('B025', 'Daisy Putih', 6500, 16, '1780337289_daisy.jpg'),
('B026', 'Daisy Kuning', 6500, 16, '1780337390_daisy kuning.jpg'),
('B027', 'Sedap Malam', 5000, 20, '1780337584_sedap malam.jpg'),
('B028', 'Anyelir Merah', 11000, 10, '1780337623_Anyelir Merah.jpg'),
('B029', 'Anyelir Pink', 11000, 10, '1780337664_Anyelir Pink.jpg'),
('B030', 'Baby Breath', 13000, 8, '1780337749_Baby Breath.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions`
--

CREATE TABLE `transactions` (
  `TRANSACTION_ID` char(10) NOT NULL,
  `PAYMENT_ID` char(6) DEFAULT NULL,
  `STATUS_ID` char(6) DEFAULT NULL,
  `USER_ID` char(6) DEFAULT NULL,
  `TRANSACTION_DATE` datetime DEFAULT NULL,
  `TOTAL_HARGA` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transactions`
--

INSERT INTO `transactions` (`TRANSACTION_ID`, `PAYMENT_ID`, `STATUS_ID`, `USER_ID`, `TRANSACTION_DATE`, `TOTAL_HARGA`) VALUES
('TRX0000001', NULL, 'STS01', NULL, '2026-06-08 16:35:18', 40000),
('TRX0000002', NULL, 'STS01', NULL, '2026-06-08 16:35:57', 5000),
('TRX0000003', 'PAY001', 'STS02', NULL, '2026-06-08 16:42:33', 6000),
('TRX0000004', 'PAY002', 'STS02', NULL, '2026-06-08 17:20:53', 5000),
('TRX0000005', 'PAY003', 'STS02', NULL, '2026-06-08 17:22:21', 6000),
('TRX0000006', 'PAY004', 'STS02', NULL, '2026-06-08 17:43:26', 6000),
('TRX0000007', 'PAY005', 'STS02', NULL, '2026-06-08 17:43:52', 10000),
('TRX0000008', 'PAY006', 'STS02', NULL, '2026-06-08 17:45:17', 64000),
('TRX0000009', 'PAY007', 'STS02', NULL, '2026-06-08 17:48:32', 18000),
('TRX0000010', 'PAY008', 'STS02', NULL, '2026-06-09 17:56:20', 17000),
('TRX0000011', 'PAY009', 'STS02', NULL, '2026-06-09 17:56:44', 12000),
('TRX0000012', 'PAY010', 'STS02', NULL, '2026-06-09 17:57:42', 5000),
('TRX0000013', 'PAY011', 'STS02', NULL, '2026-06-09 18:06:46', 45000),
('TRX0000014', NULL, 'STS01', NULL, '2026-06-09 18:10:35', 5000),
('TRX0000015', 'PAY012', 'STS02', NULL, '2026-06-09 18:14:06', 6000),
('TRX0000016', 'PAY013', 'STS02', NULL, '2026-06-09 18:20:18', 5000),
('TRX0000017', 'PAY014', 'STS02', NULL, '2026-06-09 18:22:08', 5000),
('TRX0000018', 'PAY015', 'STS02', NULL, '2026-06-09 19:15:18', 18000),
('TRX0000019', 'PAY016', 'STS02', NULL, '2026-06-10 01:51:14', 48000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction_details`
--

CREATE TABLE `transaction_details` (
  `DETAIL_ID` char(6) NOT NULL,
  `TRANSACTION_ID` char(10) DEFAULT NULL,
  `PRODUCT_ID` char(6) DEFAULT NULL,
  `JUMLAH` int(11) DEFAULT NULL,
  `SUBTOTAL` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaction_details`
--

INSERT INTO `transaction_details` (`DETAIL_ID`, `TRANSACTION_ID`, `PRODUCT_ID`, `JUMLAH`, `SUBTOTAL`) VALUES
('DT0001', 'TRX0000001', 'B001', 8, 40000),
('DT0002', 'TRX0000002', 'B001', 1, 5000),
('DT0003', 'TRX0000003', 'B002', 1, 6000),
('DT0004', 'TRX0000004', 'B001', 1, 5000),
('DT0005', 'TRX0000005', 'B003', 1, 6000),
('DT0006', 'TRX0000006', 'B003', 1, 6000),
('DT0007', 'TRX0000007', 'B001', 2, 10000),
('DT0008', 'TRX0000008', 'B001', 1, 5000),
('DT0009', 'TRX0000008', 'B006', 1, 25000),
('DT0010', 'TRX0000008', 'B003', 1, 6000),
('DT0011', 'TRX0000008', 'B007', 1, 28000),
('DT0012', 'TRX0000009', 'B003', 1, 6000),
('DT0013', 'TRX0000009', 'B004', 1, 12000),
('DT0014', 'TRX0000010', 'B002', 1, 6000),
('DT0015', 'TRX0000010', 'B001', 1, 5000),
('DT0016', 'TRX0000010', 'B003', 1, 6000),
('DT0017', 'TRX0000011', 'B002', 1, 6000),
('DT0018', 'TRX0000011', 'B003', 1, 6000),
('DT0019', 'TRX0000012', 'B001', 1, 5000),
('DT0020', 'TRX0000013', 'B010', 1, 15000),
('DT0021', 'TRX0000013', 'B023', 1, 30000),
('DT0022', 'TRX0000014', 'B001', 1, 5000),
('DT0023', 'TRX0000015', 'B003', 1, 6000),
('DT0024', 'TRX0000016', 'B001', 1, 5000),
('DT0025', 'TRX0000017', 'B001', 1, 5000),
('DT0026', 'TRX0000018', 'B002', 3, 18000),
('DT0027', 'TRX0000019', 'B003', 8, 48000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction_status`
--

CREATE TABLE `transaction_status` (
  `STATUS_ID` char(6) NOT NULL,
  `NAMA_STATUS` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaction_status`
--

INSERT INTO `transaction_status` (`STATUS_ID`, `NAMA_STATUS`) VALUES
('STS01', 'Pending'),
('STS02', 'Success'),
('STS03', 'Cancelled');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `USER_ID` char(6) NOT NULL,
  `NAMA` varchar(50) DEFAULT NULL,
  `USERNAME` varchar(30) DEFAULT NULL,
  `PASSWORD` varchar(60) DEFAULT NULL,
  `ROLE` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`USER_ID`, `NAMA`, `USERNAME`, `PASSWORD`, `ROLE`) VALUES
('usr001', 'Tasya Sinaga', 'Tasya', '123', 'admin'),
('usr002', 'Novel Siahaan', 'Novel', 'Novel123', 'kasir');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`PAYMENT_ID`),
  ADD KEY `FK_DIGUNAKAN` (`METHOD_ID`),
  ADD KEY `FK_MEMILIKI` (`TRANSACTION_ID`);

--
-- Indeks untuk tabel `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`METHOD_ID`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`PRODUCT_ID`);

--
-- Indeks untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`TRANSACTION_ID`),
  ADD KEY `FK_DIPAKAI` (`STATUS_ID`),
  ADD KEY `FK_MEMILIKI2` (`PAYMENT_ID`),
  ADD KEY `FK_MENGELOLA` (`USER_ID`);

--
-- Indeks untuk tabel `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD PRIMARY KEY (`DETAIL_ID`),
  ADD KEY `FK_MUNCUL` (`PRODUCT_ID`),
  ADD KEY `FK_TERDAPAT` (`TRANSACTION_ID`);

--
-- Indeks untuk tabel `transaction_status`
--
ALTER TABLE `transaction_status`
  ADD PRIMARY KEY (`STATUS_ID`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`USER_ID`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `FK_DIGUNAKAN` FOREIGN KEY (`METHOD_ID`) REFERENCES `payment_methods` (`METHOD_ID`),
  ADD CONSTRAINT `FK_MEMILIKI` FOREIGN KEY (`TRANSACTION_ID`) REFERENCES `transactions` (`TRANSACTION_ID`);

--
-- Ketidakleluasaan untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `FK_DIPAKAI` FOREIGN KEY (`STATUS_ID`) REFERENCES `transaction_status` (`STATUS_ID`),
  ADD CONSTRAINT `FK_MEMILIKI2` FOREIGN KEY (`PAYMENT_ID`) REFERENCES `payments` (`PAYMENT_ID`),
  ADD CONSTRAINT `FK_MENGELOLA` FOREIGN KEY (`USER_ID`) REFERENCES `users` (`USER_ID`);

--
-- Ketidakleluasaan untuk tabel `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD CONSTRAINT `FK_MUNCUL` FOREIGN KEY (`PRODUCT_ID`) REFERENCES `products` (`PRODUCT_ID`),
  ADD CONSTRAINT `FK_TERDAPAT` FOREIGN KEY (`TRANSACTION_ID`) REFERENCES `transactions` (`TRANSACTION_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
