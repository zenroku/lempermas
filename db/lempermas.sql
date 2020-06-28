-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2020 at 11:32 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lempermas`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(15) NOT NULL,
  `password_admin` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `password_admin`) VALUES
(1, 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `kuebasah`
--

CREATE TABLE `kuebasah` (
  `id_produk` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `satuan` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kuebasah`
--

INSERT INTO `kuebasah` (`id_produk`, `stok`, `nama`, `satuan`, `harga`, `gambar`) VALUES
(1, 10, 'Bolu Gulung', 'Pcs', 2500, 'bolugulung.jpg'),
(2, 5, 'Bolu Kukus', 'Pcs', 3500, 'bolukukus.jpg'),
(3, 12, 'Dadar Gulung', 'Pcs', 1500, 'dadargulung.jpg'),
(4, 11, 'Donat Kentang', 'Pcs', 1500, 'donatkentang.jpg'),
(5, 13, 'Onde Onde', 'Pcs', 2000, 'ondeonde.jpg'),
(6, 4, 'Pisang Molen', 'Pcs', 1500, 'pisangmolen.jpg'),
(20, 12, 'Putri Ayu', 'Pcs', 1500, '5e1369374e427.png'),
(21, 12, 'Pudding', 'Pcs', 1000, '5e14140280326.png');

-- --------------------------------------------------------

--
-- Table structure for table `ongkir`
--

CREATE TABLE `ongkir` (
  `id_ongkir` int(11) NOT NULL,
  `nama_daerah` varchar(50) NOT NULL,
  `tarif` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ongkir`
--

INSERT INTO `ongkir` (`id_ongkir`, `nama_daerah`, `tarif`) VALUES
(1, 'Sekitar Laladon (Gratis)', 0),
(2, 'Pagelaran', 1000),
(4, 'Kreteg', 1500);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `telepon_pelanggan` varchar(12) NOT NULL,
  `password_pelanggan` varchar(25) NOT NULL,
  `email_pelanggan` varchar(50) NOT NULL,
  `alamat_pelanggan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `telepon_pelanggan`, `password_pelanggan`, `email_pelanggan`, `alamat_pelanggan`) VALUES
(1, 'zahir', '08982145868', '123', 'zahir.frahman@gmail.com', ''),
(3, 'Zahirudin', '08982145867', '456', 'zahir.frhmn@gmail.com', 'Bogor Valley  '),
(4, 'Fathur', '08982145866', '789', 'zahir_frahman@yahoo.com', 'Laladon    ');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `id_pelanggan` int(20) NOT NULL,
  `id_ongkir` int(20) NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `total_pembelian` int(20) NOT NULL,
  `nama_daerah` varchar(50) NOT NULL,
  `tarif` int(15) NOT NULL,
  `alamat_pengiriman` text NOT NULL,
  `status_pembelian` varchar(100) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `id_pelanggan`, `id_ongkir`, `tanggal_pembelian`, `total_pembelian`, `nama_daerah`, `tarif`, `alamat_pengiriman`, `status_pembelian`) VALUES
(1, 1, 1, '2019-12-25', 5000, '', 0, '', 'pending'),
(14, 1, 1, '2019-12-26', 4000, 'Sekitar Laladon (Gratis)', 0, 'Jl. Huni No. 5', 'pending'),
(15, 1, 4, '2019-12-26', 7000, 'Kreteg', 1500, 'Kreteg filter', 'pending'),
(16, 1, 1, '2019-12-26', 4000, 'Sekitar Laladon (Gratis)', 0, 'Jl. Huni', 'pending'),
(20, 1, 2, '2019-12-29', 8500, 'Pagelaran', 1000, 'JL. Mahoni no.10                      ', 'Selesai'),
(21, 1, 2, '2019-12-30', 12500, 'Pagelaran', 1000, 'Jl. Beringin no.102           ', 'Dikirim'),
(22, 1, 4, '2019-12-30', 9500, 'Kreteg', 1500, 'Alam Tirta          ', 'Diproses'),
(23, 4, 2, '2020-01-03', 19000, 'Pagelaran', 1000, 'Beringin Hantu', 'Diproses'),
(24, 4, 4, '2020-01-03', 13500, 'Kreteg', 1500, 'Zam Zam Tirta         ', 'pending'),
(25, 3, 2, '2020-01-06', 8500, 'Pagelaran', 1000, 'Jalan Beringas', 'Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_produk`
--

CREATE TABLE `pembelian_produk` (
  `id_pembelian_produk` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(100) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `subharga` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembelian_produk`
--

INSERT INTO `pembelian_produk` (`id_pembelian_produk`, `id_pembelian`, `id_produk`, `jumlah`, `nama`, `harga`, `subharga`) VALUES
(1, 1, 1, 1, '', 0, 0),
(2, 1, 2, 1, '', 0, 0),
(7, 3, 3, 1, '', 0, 0),
(8, 3, 4, 2, '', 0, 0),
(9, 4, 3, 1, '', 0, 0),
(10, 4, 4, 2, '', 0, 0),
(11, 5, 3, 1, '', 0, 0),
(12, 5, 4, 2, '', 0, 0),
(13, 5, 7, 1, '', 0, 0),
(14, 6, 3, 1, '', 0, 0),
(15, 6, 4, 2, '', 0, 0),
(16, 6, 7, 1, '', 0, 0),
(17, 7, 3, 1, '', 0, 0),
(18, 7, 4, 2, '', 0, 0),
(19, 7, 7, 1, '', 0, 0),
(20, 8, 2, 1, '', 0, 0),
(30, 14, 4, 1, 'Donat Kentang', 1500, 1500),
(31, 15, 2, 1, 'Onde Onde', 2000, 2000),
(32, 15, 5, 1, 'Onde Onde', 2000, 2000),
(33, 16, 0, 1, 'Bolu Gulung', 2500, 2500),
(34, 16, 0, 1, 'Pisang Molen', 1500, 1500),
(35, 17, 0, 1, 'Bolu Kukus', 3500, 3500),
(36, 17, 0, 3, 'Bolu Gulung', 2500, 7500),
(37, 17, 0, 1, 'Dadar Gulung', 1500, 1500),
(38, 17, 0, 1, 'Donat Kentang', 1500, 1500),
(39, 17, 0, 1, 'Pisang Molen', 1500, 1500),
(40, 17, 0, 1, 'Onde Onde', 2000, 2000),
(41, 18, 0, 4, 'Bolu Kukus', 3500, 14000),
(42, 18, 0, 1, 'Pisang Molen', 1500, 1500),
(43, 19, 0, 2, 'Onde Onde', 2000, 4000),
(44, 19, 0, 4, 'Pisang Molen', 1500, 6000),
(45, 20, 4, 2, 'Donat Kentang', 1500, 3000),
(46, 20, 3, 3, 'Dadar Gulung', 1500, 4500),
(47, 21, 6, 1, 'Pisang Molen', 1500, 1500),
(48, 21, 5, 5, 'Onde Onde', 2000, 10000),
(49, 22, 7, 1, 'Pudding', 3500, 3500),
(50, 22, 6, 3, 'Pisang Molen', 1500, 4500),
(51, 23, 20, 5, 'Putri Ayu', 1500, 7500),
(52, 23, 2, 3, 'Bolu Kukus', 3500, 10500),
(53, 24, 7, 3, 'Pudding', 3000, 9000),
(54, 24, 4, 2, 'Donat Kentang', 1500, 3000),
(55, 25, 20, 3, 'Putri Ayu', 1500, 4500),
(56, 25, 6, 2, 'Pisang Molen', 1500, 3000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `kuebasah`
--
ALTER TABLE `kuebasah`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`id_ongkir`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indexes for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  ADD PRIMARY KEY (`id_pembelian_produk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kuebasah`
--
ALTER TABLE `kuebasah`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `id_ongkir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  MODIFY `id_pembelian_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
