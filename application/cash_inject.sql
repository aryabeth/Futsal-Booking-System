-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2016 at 10:13 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `paragon_futsal`
--

-- --------------------------------------------------------

--
-- Table structure for table `cash_inject`
--

CREATE TABLE `cash_inject` (
  `id_inject` int(5) NOT NULL,
  `tgl_waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `nota` enum('PENGEMBALIAN PICKUP','SISA PENGELUARAN','TAMBAH MODAL KASIR','KOREKSI') NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jml` int(8) NOT NULL,
  `keterangan` text NOT NULL,
  `id_operator` int(5) NOT NULL,
  `override` int(5) NOT NULL,
  `status` enum('NEW','UPDATED','CANCELED') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cash_inject`
--

INSERT INTO `cash_inject` (`id_inject`, `tgl_waktu`, `nota`, `nama`, `jml`, `keterangan`, `id_operator`, `override`, `status`) VALUES
(1, '2016-06-12 06:01:11', 'SISA PENGELUARAN', 'Kasir1', 3500000, 'AA', 4, 3, 'NEW'),
(3, '2016-06-04 07:43:48', 'PENGEMBALIAN PICKUP', 'Kasir1', 1300000, 'as', 4, 3, 'NEW'),
(4, '2016-06-12 06:01:11', 'TAMBAH MODAL KASIR', 'Kasir1', 2500000, 'BB', 4, 3, 'NEW'),
(5, '2016-06-09 08:56:41', 'TAMBAH MODAL KASIR', 'ayu', 450000, 'udpated', 3, 1, 'UPDATED'),
(6, '2016-06-07 19:27:27', 'SISA PENGELUARAN', 'ayu', 1234, 'asdasd', 3, 1, 'CANCELED'),
(7, '2016-08-16 17:42:36', 'SISA PENGELUARAN', 'ayu', 15000, 'sdfdsf', 3, 1, 'CANCELED');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cash_inject`
--
ALTER TABLE `cash_inject`
  ADD PRIMARY KEY (`id_inject`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cash_inject`
--
ALTER TABLE `cash_inject`
  MODIFY `id_inject` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
