-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 14, 2020 at 05:02 AM
-- Server version: 10.3.21-MariaDB-log
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sia_penjualan_piutang`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `harga` double NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `tanggal_input` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `nama`, `harga`, `stock`, `tanggal_input`) VALUES
(1, 'Sumsang Solar X', 4250000, 0, '2020-05-02 01:49:53'),
(3, 'HP Mixiao 4GB Ram', 2500000, 2, '2020-05-05 17:28:47'),
(4, 'Nueta 4 S', 3000000, 1, '2020-05-05 17:29:03');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `no_hp` varchar(25) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `no_hp`, `alamat`) VALUES
(1, 'Vincen', '0877263261213', 'Jalan Kita Masih Panjang'),
(2, 'Ari', '08727362631', 'Jalan in aja dulu, siapa tau cocok'),
(3, 'Onet', '088273273721', 'Jalan yang pernah kita lalui'),
(4, 'Denia', '08232771371', 'Jalan Kenangan Manis');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `penjualan_id` int(11) NOT NULL,
  `nominal` double NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `penjualan_id`, `nominal`, `tanggal`) VALUES
(8, 12, 200000, '2020-05-14 17:00:00'),
(9, 13, 2250000, '2020-05-14 17:00:00'),
(10, 13, 2000000, '2020-05-21 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id` int(11) NOT NULL,
  `kode` varchar(150) NOT NULL,
  `pelanggan_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `harga` double NOT NULL,
  `qty` smallint(6) NOT NULL,
  `total` double NOT NULL,
  `tanggal_jatuh_tempo` timestamp NULL DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `tanggal` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id`, `kode`, `pelanggan_id`, `barang_id`, `harga`, `qty`, `total`, `tanggal_jatuh_tempo`, `status`, `tanggal`) VALUES
(12, 'TRN-20200514', 4, 4, 3000000, 1, 3000000, '2020-05-27 17:00:00', 'BELUM LUNAS', '2020-05-13 21:42:11'),
(13, 'TRN-20200514', 1, 1, 4250000, 1, 4250000, '2020-05-29 17:00:00', 'LUNAS', '2020-05-13 21:54:55'),
(14, 'TRN-20200514', 2, 3, 2500000, 2, 5000000, '2020-05-30 17:00:00', 'BELUM LUNAS', '2020-05-13 21:59:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
