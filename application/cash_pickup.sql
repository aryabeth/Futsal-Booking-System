-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2016 at 10:14 PM
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
-- Table structure for table `cash_pickup`
--

CREATE TABLE `cash_pickup` (
  `id_pickup` int(5) NOT NULL,
  `tgl_waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_nota` int(5) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jml` int(8) NOT NULL,
  `keterangan` text NOT NULL,
  `id_operator` int(5) NOT NULL,
  `override` int(5) NOT NULL,
  `status` enum('NEW','UPDATED','CANCELED') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cash_pickup`
--

INSERT INTO `cash_pickup` (`id_pickup`, `tgl_waktu`, `id_nota`, `nama`, `jml`, `keterangan`, `id_operator`, `override`, `status`) VALUES
(4, '2016-05-06 11:30:50', 2016050004, 'Johan', 100000, 'Keterangan 1', 3, 1, 'NEW'),
(6, '2016-05-11 11:31:19', 2016050006, 'Juan', 250000, 'Keterangan 2', 3, 1, 'NEW'),
(15, '2016-05-15 11:31:37', 2016050022, 'Surya', 300000, 'Keterangan 3', 3, 1, 'NEW'),
(39, '2016-05-18 11:31:48', 2016050039, 'Yoas', 320000, 'Keterangan 4', 3, 1, 'NEW'),
(44, '2016-05-20 11:31:58', 2016050044, 'Arya', 225000, 'Keterangan 5', 3, 1, 'NEW'),
(48, '2016-08-18 16:33:55', 2016080001, 'ayu', 450000, 'cek', 3, 1, 'CANCELED'),
(49, '2016-08-10 17:11:16', 2016080001, 'ayu', 230000, 'keterangan 4', 3, 1, 'UPDATED');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cash_pickup`
--
ALTER TABLE `cash_pickup`
  ADD PRIMARY KEY (`id_pickup`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cash_pickup`
--
ALTER TABLE `cash_pickup`
  MODIFY `id_pickup` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
