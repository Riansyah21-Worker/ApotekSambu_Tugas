-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2024 at 09:32 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apoteksambu2`
--

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `id` int(11) NOT NULL,
  `nama_obat` varchar(255) DEFAULT NULL,
  `supplier` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `stock` varchar(255) DEFAULT NULL,
  `harga_satuan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id`, `nama_obat`, `supplier`, `updated_by`, `stock`, `harga_satuan`) VALUES
(16, 'OSKADON', 'SAMBU', 'admin', '998', 'Rp 5.000'),
(17, 'PARACETAMOL', 'KARA', 'admin', '196', 'Rp 8.000'),
(18, 'PARAMEX', 'SAMBU', 'admin', '15', 'Rp 3.000'),
(20, 'AMOCXILIN', 'PT PSG', 'admin', '295', 'Rp 10.000'),
(21, 'KOMIX', 'PT PULAU BURUNG', 'admin', '939', 'Rp 15.000');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `keluhan` text DEFAULT NULL,
  `obat` varchar(255) DEFAULT NULL,
  `jumlah_pcs` int(11) NOT NULL,
  `harga_satuan` varchar(255) DEFAULT NULL,
  `total_harga` varchar(255) DEFAULT NULL,
  `tanggal_transaksi` datetime DEFAULT current_timestamp(),
  `id_supplier` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `nama`, `keluhan`, `obat`, `jumlah_pcs`, `harga_satuan`, `total_harga`, `tanggal_transaksi`, `id_supplier`) VALUES
(66, 'RIAN', 'SAKIT KEPALA', '1', 1, '3000', '3000', '2024-12-28 00:36:26', NULL),
(67, 'RANDI', 'SAKIT KEPALA', '1', 5, '3000', '15000', '2024-12-28 00:38:39', NULL),
(68, 'VINA', 'SAKIT KEPALA', '1', 4, '3000', '12000', '2024-12-28 00:41:46', NULL),
(69, 'GUSTI', 'SAKIT KEPALA', '1', 56, '3000', '168000', '2024-12-28 00:42:51', NULL),
(70, 'ISLAH', 'SAKIT KEPALA', '1', 55, '3000', '165000', '2024-12-28 00:43:50', NULL),
(71, 'RIAN', 'SAKIT KEPALA', '1', 1, '3000', '3000', '2024-12-28 00:47:39', NULL),
(72, 'RIAN', 'SAKIT KEPALA', '1', 5, '3000', '15000', '2024-12-28 00:52:10', NULL),
(73, 'RIAN', 'SAKIT KEPALA', '1', 5, '3000', '15000', '2024-12-28 00:57:01', NULL),
(85, 'RIAN', 'SAKIT KEPALA', 'PARAMEX', 5, '3000', '15000', '2024-12-28 01:28:24', NULL),
(86, 'RIAN', 'SAKIT KEPALA', 'PARAMEX', 5, '3000', '15000', '2024-12-28 01:45:47', NULL),
(87, 'RIAN', 'SAKIT PERUT', 'PARACETAMOL', 300, '8000', '2400000', '2024-12-28 02:51:45', NULL),
(89, 'RIAN', 'SAKIT KEPALA', 'PARAMEX', 5, '3000', '15000', '2024-12-28 03:04:01', NULL),
(91, 'RIAN', 'SAKIT PINGGANG', 'AMOCXILIN', 5, '10000', '50000', '2024-12-28 03:09:29', NULL),
(92, 'RANDI', 'DEMAM', 'PARACETAMOL', 4, '8000', '32000', '2024-12-28 03:14:41', NULL),
(93, 'RISKI', 'SAKIT PERUT', 'KOMIX', 5, '15000', '75000', '2024-12-28 03:28:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `jenis_kelamin` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `telp` varchar(128) NOT NULL,
  `alamat` varchar(256) NOT NULL,
  `kota` varchar(128) NOT NULL,
  `perusahaan` varchar(128) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `jenis_kelamin`, `username`, `password`, `email`, `telp`, `alamat`, `kota`, `perusahaan`, `role_id`, `is_active`) VALUES
(4, 'admin', 'laki-laki', 'admin', '$2y$10$fR2vMyhrpXv9RNPm06.ww.XjcQvPepIjYQtGRCRPAnV3qt4lj24/q', 'admin@gmail.com', '080000000000', 'adminhouse', 'admin', 'admin', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` varchar(128) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `is_active`) VALUES
(1, '1', 'Dashboard', 'C_dashboard', 1),
(2, '1', 'Pesanan', 'C_pesan_mobil/baru', 1),
(3, '1', 'Kota Tujuan', 'C_kota_tujuan', 1),
(4, '1', 'Mobil', 'C_mobil', 1),
(5, '1', 'Kelola Pelanggan', 'C_riwayat_pesan', 1),
(6, '2', 'Pesan', 'C_pesan_mobil', 2),
(7, '2', 'Riwayat Pesan', 'C_riwayat_pesan', 2),
(8, '2', 'Katalog Barang', 'user', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
