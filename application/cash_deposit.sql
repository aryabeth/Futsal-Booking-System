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
-- Table structure for table `cash_deposit`
--

CREATE TABLE `cash_deposit` (
  `id_deposit` int(5) NOT NULL,
  `tgl_waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `nama_bank` enum('Mandiri (MDR)','HandOver (HDO)') NOT NULL,
  `no_transaksi` int(12) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `jml` int(8) NOT NULL,
  `keterangan` text NOT NULL,
  `id_operator` int(5) NOT NULL,
  `override` int(5) NOT NULL,
  `status` enum('NEW','UPDATED','CANCELED') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cash_deposit`
--

INSERT INTO `cash_deposit` (`id_deposit`, `tgl_waktu`, `nama_bank`, `no_transaksi`, `nama`, `jml`, `keterangan`, `id_operator`, `override`, `status`) VALUES
(1, '2016-06-02 06:26:10', 'Mandiri (MDR)', 1324532, 'Kasir1', 4500000, 'a', 4, 3, 'NEW'),
(2, '2016-06-02 17:09:52', 'HandOver (HDO)', 123123454, 'Kasir1', 525000, 'fdghf', 4, 3, 'NEW'),
(4, '2016-06-09 17:09:52', 'Mandiri (MDR)', 1232456, 'ayu', 32456789, 'asd', 3, 1, 'NEW'),
(5, '2016-08-17 17:23:41', 'Mandiri (MDR)', 3456456, 'ayu', 345643, 'fdgfd', 3, 1, 'CANCELED');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cash_deposit`
--
ALTER TABLE `cash_deposit`
  ADD PRIMARY KEY (`id_deposit`),
  ADD KEY `id_operator` (`id_operator`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cash_deposit`
--
ALTER TABLE `cash_deposit`
  MODIFY `id_deposit` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
