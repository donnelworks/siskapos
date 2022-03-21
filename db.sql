-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 13, 2022 at 09:27 PM
-- Server version: 10.2.43-MariaDB-cll-lve
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sisy1114_asa`
--

-- --------------------------------------------------------

--
-- Table structure for table `konsumen`
--

CREATE TABLE `konsumen` (
  `id` double NOT NULL,
  `kode` varchar(100) NOT NULL,
  `pin` int(4) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kota` varchar(100) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `no_pesanan` varchar(100) NOT NULL,
  `detail_angsuran` varchar(200) DEFAULT NULL,
  `ctt` varchar(200) DEFAULT NULL,
  `id_produk` double NOT NULL,
  `nominal` double NOT NULL,
  `id_sales` double NOT NULL,
  `komisi_sales` double NOT NULL,
  `id_db` double NOT NULL,
  `komisi_db` double NOT NULL,
  `id_kurir` double NOT NULL,
  `komisi_kurir` double NOT NULL,
  `status` int(11) NOT NULL COMMENT '0:aktif; 1:tidak aktif',
  `dibuat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `konsumen`
--

INSERT INTO `konsumen` (`id`, `kode`, `pin`, `nama`, `kota`, `alamat`, `no_hp`, `no_pesanan`, `detail_angsuran`, `ctt`, `id_produk`, `nominal`, `id_sales`, `komisi_sales`, `id_db`, `komisi_db`, `id_kurir`, `komisi_kurir`, `status`, `dibuat`) VALUES
(7, '001', 1234, 'Suhandi', 'Tangerang', 'Jl. Kediri 3', '083813154405', '1', NULL, NULL, 36, 100000, 21, 150000, 19, 100000, 23, 100000, 0, '2022-01-25 15:56:34'),
(8, '002', 1234, 'Randi', 'Tangerang', 'Jl. Pepaya Raya Bumi Asri', '083813154404', '2', NULL, NULL, 37, 150000, 20, 50000, 19, 50000, 23, 50000, 0, '2022-01-26 14:18:18'),
(14, 'p001', 1234, 'Ibu Reni', 'tgr', 'Poris', '0889898', '001', 'blender 130x8', NULL, 37, 130000, 20, 100000, 19, 50000, 23, 10000, 0, '2022-03-04 16:15:05');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` double NOT NULL,
  `nomor` varchar(50) NOT NULL,
  `tgl` date NOT NULL,
  `id_tagihan_list` double NOT NULL,
  `nominal` double NOT NULL,
  `id_user` double NOT NULL,
  `dibuat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `nomor`, `tgl`, `id_tagihan_list`, `nominal`, `id_user`, `dibuat`) VALUES
(39, 'PBY-202203040001', '2022-03-04', 258, 130000, 22, '2022-03-04 16:17:02');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` double NOT NULL,
  `kode` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `deskripsi` varchar(500) DEFAULT NULL,
  `detail_angsuran` varchar(500) DEFAULT NULL,
  `foto` varchar(200) DEFAULT NULL,
  `status` int(1) NOT NULL COMMENT '0:aktif; 1:tidak aktif',
  `dibuat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `kode`, `nama`, `deskripsi`, `detail_angsuran`, `foto`, `status`, `dibuat`) VALUES
(36, '002', 'Panci Presto', NULL, NULL, 'produk-20211216-71f6fede17.jpg', 0, '2021-10-04 15:40:05'),
(37, '001', 'Blender Turbo Uk. 2 Liter', 'Blender dengan 5 mata pisau melumat bahan dengan cepat. Dan memiliki kapasitas ukuran 2 liter. Berbahan Gelas Plastik tidak mudah pecah', 'Rp. 130.000 x 8 Bulan', 'produk-20220210-308a2a40d0.jpg', 0, '2021-10-04 15:40:53'),
(51, '003', 'mejikom motif wayang', 'mejikom motif wayang', '100.000 x 8 bulan', 'produk-20220224-8bd129b2bc.jpg', 0, '2022-02-24 16:03:52');

-- --------------------------------------------------------

--
-- Table structure for table `tagihan`
--

CREATE TABLE `tagihan` (
  `id` double NOT NULL,
  `id_user` double NOT NULL,
  `nomor` varchar(50) NOT NULL,
  `tgl` date DEFAULT NULL,
  `ket` varchar(200) DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT '0:proses; 1:selesai',
  `dibuat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tagihan`
--

INSERT INTO `tagihan` (`id`, `id_user`, `nomor`, `tgl`, `ket`, `status`, `dibuat`) VALUES
(106, 17, 'TGH-202203040001', '2022-03-04', 'Angsuran Pertama 130.000', 1, '2022-03-04 16:15:11');

-- --------------------------------------------------------

--
-- Table structure for table `tagihan_list`
--

CREATE TABLE `tagihan_list` (
  `id` double NOT NULL,
  `id_tagihan` double NOT NULL,
  `id_konsumen` double NOT NULL,
  `kode_konsumen` varchar(100) NOT NULL,
  `nama_konsumen` varchar(100) NOT NULL,
  `angsuran` double NOT NULL,
  `nominal` double NOT NULL,
  `ket` varchar(200) DEFAULT NULL,
  `id_sales` double NOT NULL,
  `id_db` double NOT NULL,
  `id_kurir` double DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT '0:Belum Bayar; 1:Bayar',
  `dibuat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tagihan_list`
--

INSERT INTO `tagihan_list` (`id`, `id_tagihan`, `id_konsumen`, `kode_konsumen`, `nama_konsumen`, `angsuran`, `nominal`, `ket`, `id_sales`, `id_db`, `id_kurir`, `status`, `dibuat`) VALUES
(258, 106, 14, 'p001', 'Ibu Reni', 1, 130000, NULL, 20, 19, 23, 1, '2022-03-04 16:15:26');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` double NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `no_hp_user` varchar(20) NOT NULL,
  `pass_user` varchar(100) NOT NULL,
  `level_user` int(11) NOT NULL,
  `foto_user` varchar(200) DEFAULT NULL,
  `dibuat_user` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `no_hp_user`, `pass_user`, `level_user`, `foto_user`, `dibuat_user`) VALUES
(1, 'Super Admin', '083813154407', '5025a31aed9028c83e86944be69aa0c2', 1, 'user-20220305-de39094cd4.jpg', '2022-03-05 07:23:05'),
(17, 'admin', '081293537319', 'a05e943dadef571c06f58e5492c5eb25', 1, NULL, '2022-03-04 04:19:18'),
(18, 'defa', '089636613414', 'a05e943dadef571c06f58e5492c5eb25', 1, NULL, '2022-03-04 04:21:12'),
(19, 'Raju', '081298348577', '202cb962ac59075b964b07152d234b70', 2, NULL, '2022-03-04 04:21:57'),
(20, 'Maki', '085782940657', '202cb962ac59075b964b07152d234b70', 3, NULL, '2022-03-04 04:22:45'),
(21, 'Rizki', '087703557106', '202cb962ac59075b964b07152d234b70', 3, NULL, '2022-03-04 04:23:09'),
(22, 'Alwi', '085772436773', '202cb962ac59075b964b07152d234b70', 4, NULL, '2022-03-04 04:23:38'),
(23, 'Yanto', '081316537635', '202cb962ac59075b964b07152d234b70', 5, NULL, '2022-03-04 04:24:06'),
(24, 'Yoko', '08812149331', '202cb962ac59075b964b07152d234b70', 3, NULL, '2022-03-04 04:24:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `konsumen`
--
ALTER TABLE `konsumen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tagihan`
--
ALTER TABLE `tagihan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tagihan_list`
--
ALTER TABLE `tagihan_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `konsumen`
--
ALTER TABLE `konsumen`
  MODIFY `id` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `tagihan`
--
ALTER TABLE `tagihan`
  MODIFY `id` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `tagihan_list`
--
ALTER TABLE `tagihan_list`
  MODIFY `id` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=265;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
