-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2016 at 07:16 PM
-- Server version: 10.1.8-MariaDB
-- PHP Version: 5.6.14

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
-- Table structure for table `cashflow`
--

CREATE TABLE `cashflow` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `penanggungjawab` varchar(50) NOT NULL,
  `jumlah` int(15) NOT NULL,
  `keterangan` varchar(500) NOT NULL,
  `operator` varchar(50) NOT NULL,
  `override` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(2, '2016-08-31 06:43:25', 'HandOver (HDO)', 123123454, 'Kasir1', 525000, 'keterangan', 3, 1, 'NEW'),
(4, '2016-09-12 15:52:34', 'Mandiri (MDR)', 1232456, 'ayu', 340000, 'asd', 3, 1, 'NEW'),
(5, '2016-09-12 15:52:38', 'Mandiri (MDR)', 3456456, 'ayu', 120000, 'fdgfd', 3, 1, 'NEW'),
(6, '2016-08-31 06:43:40', 'Mandiri (MDR)', 23456, 'ayu', 47000, 'cek', 3, 1, 'NEW'),
(7, '2016-08-11 12:05:05', 'Mandiri (MDR)', 45432, 'ayu', 65000, 'sdfsdf', 3, 1, 'NEW'),
(8, '2016-10-04 13:25:14', 'HandOver (HDO)', 2147483647, 'ayu', 110000, 'udah', 3, 1, 'NEW');

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
(5, '2016-08-31 06:44:10', 'TAMBAH MODAL KASIR', 'ayu', 450000, 'udpated', 3, 1, 'NEW'),
(6, '2016-09-12 15:52:26', 'SISA PENGELUARAN', 'ayu', 45000, 'asdasd', 3, 1, 'NEW'),
(7, '2016-08-31 06:44:22', 'SISA PENGELUARAN', 'ayu', 15000, 'sdfdsf', 3, 1, 'NEW'),
(8, '2016-08-31 06:44:28', 'TAMBAH MODAL KASIR', 'ayu', 25000, 'coba', 3, 1, 'NEW'),
(9, '2016-10-04 13:24:23', 'TAMBAH MODAL KASIR', 'ayu', 120000, 'udah', 3, 1, 'NEW');

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
(15, '2016-08-31 06:44:40', 2016050022, 'Surya', 300000, 'Keterangan 3', 3, 1, 'NEW'),
(39, '2016-05-18 11:31:48', 2016050039, 'Yoas', 320000, 'Keterangan 4', 3, 1, 'NEW'),
(44, '2016-05-20 11:31:58', 2016050044, 'Arya', 225000, 'Keterangan 5', 3, 1, 'NEW'),
(48, '2016-08-31 06:44:49', 2016080001, 'ayu', 450000, 'cek', 3, 1, 'NEW'),
(49, '2016-08-31 06:44:57', 2016080001, 'ayu', 230000, 'keterangan 44', 3, 1, 'NEW'),
(50, '2016-08-31 06:45:05', 2016080002, 'ayu', 35000, 'jgghjhgf', 3, 1, 'NEW'),
(51, '2016-08-31 06:45:13', 2016080002, 'ayu', 120000, 'keterangan selanjutnya', 3, 1, 'NEW'),
(52, '2016-10-04 13:23:37', 2016100001, 'ayu', 240000, 'cek', 3, 1, 'NEW');

-- --------------------------------------------------------

--
-- Table structure for table `data_barang`
--

CREATE TABLE `data_barang` (
  `id_barang` varchar(8) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `harga_beli` int(8) NOT NULL,
  `harga_jual` int(8) NOT NULL,
  `stok` int(4) NOT NULL,
  `keterangan` text NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_barang`
--

INSERT INTO `data_barang` (`id_barang`, `nama_barang`, `harga_beli`, `harga_jual`, `stok`, `keterangan`, `status`) VALUES
('12', 'indo mie', 4500, 5000, 20, '', 0),
('123', 'sponge', 5000, 6000, 23, '', 0),
('123213', 'Juice', 6000, 10000, 64, '', 0),
('16358', 'es jeruk', 3000, 2000, 49, '', 0),
('304758', 'aqua', 2000, 3000, 4, '', 0),
('304814', 'mizone', 2000, 5000, -1, '', 0),
('34333', 'Molto', 2000, 1500, 98, '', 0),
('7629', 'bengbeng', 2000, 4000, 24, '-', 0);

-- --------------------------------------------------------

--
-- Table structure for table `koreksi_barang`
--

CREATE TABLE `koreksi_barang` (
  `id_nota` varchar(15) NOT NULL,
  `tanggal_koreksi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `nama_barang` varchar(25) NOT NULL,
  `kode_barang` varchar(15) NOT NULL,
  `jumlah` int(3) NOT NULL,
  `keterangan` varchar(75) NOT NULL,
  `operator` varchar(20) NOT NULL,
  `override` varchar(20) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `koreksi_barang`
--

INSERT INTO `koreksi_barang` (`id_nota`, `tanggal_koreksi`, `nama_barang`, `kode_barang`, `jumlah`, `keterangan`, `operator`, `override`, `status`) VALUES
('KB-2016090001', '2016-09-01 05:29:32', 'aqua', '304758', 10000, 'test', 'kasir', 'admin', 0),
('KB-2016090002', '2016-09-01 05:31:00', 'sponge', '123', 5, 'test1', 'kasir', 'admin', 0),
('KB-2016090003', '2016-09-01 05:31:20', 'aqua', '304758', 40, 'coeg', 'kasir', 'admin', 0),
('KB-2016090004', '2016-09-13 08:46:02', 'aqua', '304758', 3, 'hilang', 'kasir', 'admin', 0);

-- --------------------------------------------------------

--
-- Table structure for table `koreksi_cash`
--

CREATE TABLE `koreksi_cash` (
  `id_nota` varchar(15) NOT NULL,
  `transaksi` varchar(30) NOT NULL,
  `tanggal_koreksi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `jumlah` int(10) NOT NULL,
  `keterangan` varchar(75) NOT NULL,
  `operator` varchar(20) NOT NULL,
  `override` varchar(20) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `koreksi_cash`
--

INSERT INTO `koreksi_cash` (`id_nota`, `transaksi`, `tanggal_koreksi`, `jumlah`, `keterangan`, `operator`, `override`, `status`) VALUES
('KC-2016090001', 'Lapangan', '2016-09-12 18:09:00', 2000, 'test', 'kasir', 'admin', 0),
('KC-2016090002', 'F&B Penjualan', '2016-09-12 18:09:14', 40000, 'salah hitung', 'kasir', 'admin', 0),
('KC-2016090003', 'F&B Penjualan', '2016-09-13 08:44:33', 30000, 'mmammam', 'kasir', 'admin', 0);

-- --------------------------------------------------------

--
-- Table structure for table `nota_lapangan`
--

CREATE TABLE `nota_lapangan` (
  `id_nota_lapangan` int(5) NOT NULL,
  `bayar_dp` int(8) NOT NULL,
  `tgl_dp` date NOT NULL,
  `bayar_lunas` int(8) DEFAULT NULL,
  `tgl_lunas` date DEFAULT NULL,
  `diskon` int(8) DEFAULT NULL,
  `override` varchar(30) DEFAULT NULL,
  `total_bayar` int(8) NOT NULL,
  `id_customer` varchar(13) NOT NULL,
  `lapangan` enum('Rumput 1','Rumput 2','Ava Court') NOT NULL,
  `tgl_main` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `bonus` varchar(35) DEFAULT NULL,
  `keterangan` text,
  `id_operator` int(5) NOT NULL,
  `status` enum('DP','PELUNASAN DP','LUNAS','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nota_lapangan`
--

INSERT INTO `nota_lapangan` (`id_nota_lapangan`, `bayar_dp`, `tgl_dp`, `bayar_lunas`, `tgl_lunas`, `diskon`, `override`, `total_bayar`, `id_customer`, `lapangan`, `tgl_main`, `jam_mulai`, `jam_selesai`, `bonus`, `keterangan`, `id_operator`, `status`) VALUES
(2, 10000, '0000-00-00', NULL, NULL, 0, '1', 0, '081804425393', '', '0000-00-00', '00:00:10', '00:00:11', '0', '', 1, ''),
(3, 20000, '0000-00-00', NULL, NULL, 0, '1', 0, '123192401', '', '0000-00-00', '00:00:08', '00:00:09', '0', '-Ini nyoba', 1, ''),
(4, 20000, '0000-00-00', NULL, NULL, 0, '0', 0, '081804425393', '', '0000-00-00', '00:00:06', '00:00:10', '0', '', 2, ''),
(5, 20000, '2016-05-03', NULL, NULL, 0, '0', 0, '081804425393', 'Rumput 1', '2016-05-04', '00:00:10', '00:00:12', '0', '', 1, ''),
(6, 10000, '2016-05-04', NULL, NULL, 0, '0', 0, '081804425393', 'Ava Court', '2016-05-09', '00:00:08', '00:00:10', '0', 'Nyobain bossh', 1, ''),
(7, 20000, '2016-05-07', NULL, NULL, 0, '0', 100000, '081804425393', 'Rumput 2', '2016-05-09', '00:00:08', '00:00:10', '0', 'Ini percobaan', 1, ''),
(8, 20000, '2016-05-10', NULL, NULL, 0, '0', 100000, '081804425393', 'Rumput 2', '2016-05-12', '20:00:00', '22:00:00', '0', 'Percobaan 2', 1, ''),
(9, 20000, '2016-05-23', NULL, NULL, 0, 'Admin Poen', 100000, '02139231809', 'Rumput 1', '2016-05-23', '14:00:00', '16:00:00', '0', '', 1, ''),
(10, 20000, '2016-05-26', NULL, NULL, 0, '2', 100000, '02139231809', 'Rumput 1', '2016-05-27', '13:00:00', '15:00:00', '0', '', 1, ''),
(11, 10000, '2016-06-01', NULL, NULL, 10000, '2', 40000, '081804425393', 'Rumput 1', '2016-06-01', '15:00:00', '16:00:00', '0', 'Nyoba fitur baru', 1, 'DP');

-- --------------------------------------------------------

--
-- Table structure for table `nota_parkir`
--

CREATE TABLE `nota_parkir` (
  `id_nota` varchar(10) NOT NULL,
  `tgl_nota` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `nama_penyetor` varchar(30) NOT NULL,
  `jml` int(8) NOT NULL,
  `keterangan` text NOT NULL,
  `status` enum('NEW','UPDATED','CANCELED') NOT NULL,
  `id_operator` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nota_parkir`
--

INSERT INTO `nota_parkir` (`id_nota`, `tgl_nota`, `nama_penyetor`, `jml`, `keterangan`, `status`, `id_operator`) VALUES
('2016080003', '2016-08-19 05:04:46', 'yoas', 2000, '', 'NEW', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nota_penjualan_barang`
--

CREATE TABLE `nota_penjualan_barang` (
  `id_nota` varchar(15) NOT NULL,
  `tgl_jual` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_barang` varchar(8) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `harga_jual` int(10) NOT NULL,
  `jml` int(5) NOT NULL,
  `disc` int(8) NOT NULL,
  `keterangan` text NOT NULL,
  `id_operator` int(5) NOT NULL,
  `status` enum('NEW','UPDATED','CANCELED') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nota_penjualan_barang`
--

INSERT INTO `nota_penjualan_barang` (`id_nota`, `tgl_jual`, `id_barang`, `nama`, `harga_jual`, `jml`, `disc`, `keterangan`, `id_operator`, `status`) VALUES
('2016090001', '2016-07-20 12:26:20', '16358', 'es jeruk', 2000, 2, 0, 'tes', 1, 'NEW'),
('2016090002', '2016-07-20 12:27:06', '304758', 'aqua', 3000, 5, 0, 'beli aqua ', 1, 'NEW'),
('2016090003', '2016-09-12 14:49:30', '123', 'sponge', 1233, 1, 0, '', 1, 'NEW'),
('2016090004', '2016-09-12 14:49:39', '34333', 'Molto', 1500, 1, 0, '', 1, 'NEW'),
('2016090005', '2016-09-12 18:27:53', '123213', 'Juice', 10000, 1, 0, '', 2, 'NEW'),
('PJ-2016100001', '2016-10-04 16:53:13', '304814', 'mizone', 5000, 2, 0, '', 1, 'NEW');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id` int(5) NOT NULL,
  `tanggal_pembelian` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `nota` varchar(20) NOT NULL,
  `kode` varchar(8) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `hargabeli` int(8) NOT NULL,
  `jumlah` int(8) NOT NULL,
  `disc` int(8) NOT NULL,
  `tgl_retur` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `retur` int(4) DEFAULT NULL,
  `operator_id` varchar(30) NOT NULL,
  `override` varchar(30) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id`, `tanggal_pembelian`, `nota`, `kode`, `nama`, `hargabeli`, `jumlah`, `disc`, `tgl_retur`, `retur`, `operator_id`, `override`, `status`) VALUES
(38, '2016-10-04 17:13:03', '2016100001', '12', 'indo mie', 4500, 1, 0, '2016-10-04 17:13:10', NULL, 'admin', 'admin', 0),
(39, '2016-10-04 17:13:03', '2016100001', '123213', 'Juice', 6000, 10, 0, '2016-10-04 17:13:10', NULL, 'admin', 'admin', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pembelianbayarnota`
--

CREATE TABLE `pembelianbayarnota` (
  `id` int(4) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `nota` varchar(20) NOT NULL,
  `nota_bayar` varchar(20) NOT NULL,
  `bayar` int(8) NOT NULL,
  `keterangan` text,
  `operator` varchar(15) NOT NULL,
  `override` varchar(15) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelianbayarnota`
--

INSERT INTO `pembelianbayarnota` (`id`, `tanggal`, `nota`, `nota_bayar`, `bayar`, `keterangan`, `operator`, `override`, `status`) VALUES
(71, '2016-10-04 17:13:03', '2016100001', '2016100001-1', 64500, '', 'admin', 'admin', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pembeliannota`
--

CREATE TABLE `pembeliannota` (
  `id` int(5) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `nota` varchar(20) NOT NULL,
  `grosstotal` int(8) NOT NULL,
  `jmlitem` int(8) NOT NULL,
  `discbelitotal` int(8) NOT NULL,
  `keterangan` text NOT NULL,
  `operator` varchar(35) NOT NULL,
  `override` varchar(35) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembeliannota`
--

INSERT INTO `pembeliannota` (`id`, `tanggal`, `nota`, `grosstotal`, `jmlitem`, `discbelitotal`, `keterangan`, `operator`, `override`, `status`) VALUES
(24, '2016-10-04 17:13:03', '2016100001', 64500, 11, 0, '', 'admin', 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pembeliantemp`
--

CREATE TABLE `pembeliantemp` (
  `id` int(5) NOT NULL,
  `kode` varchar(8) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `hargabeli` int(8) NOT NULL,
  `jumlah` int(8) NOT NULL,
  `disc` int(8) NOT NULL,
  `operator_id` varchar(30) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sewatempat`
--

CREATE TABLE `sewatempat` (
  `id_nota` int(10) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `penyewa` varchar(40) NOT NULL,
  `jumlah` int(8) NOT NULL,
  `ket` varchar(100) NOT NULL,
  `status` enum('NEW','UPDATED','CANCELED') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sewatempat`
--

INSERT INTO `sewatempat` (`id_nota`, `tanggal`, `penyewa`, `jumlah`, `ket`, `status`) VALUES
(2016080002, '2016-08-19 05:15:50', 'budi', 3000, 'tes', 'NEW'),
(2016080003, '2016-08-19 07:49:05', 'yoas', 2000, 'tes', 'NEW');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(30) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` int(1) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `username`, `password`, `level`, `status`) VALUES
(1, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 0, 0),
(2, 'tes', 'kasir', 'c7911af3adbd12a035b289556d96470a', 3, 0),
(3, 'ayu', 'kasir2', '8c86013d8ba23d9b5ade4d6463f81c45', 2, 0),
(4, 'Budi Paragon', 'budi', '00dfc53ee86af02e742515cdcf075ed3', 1, 0),
(5, 'cok', 'cok', '595aa739fc58403c7c62cc2840d0b7fb', 3, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cashflow`
--
ALTER TABLE `cashflow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cash_deposit`
--
ALTER TABLE `cash_deposit`
  ADD PRIMARY KEY (`id_deposit`),
  ADD KEY `id_operator` (`id_operator`);

--
-- Indexes for table `cash_inject`
--
ALTER TABLE `cash_inject`
  ADD PRIMARY KEY (`id_inject`);

--
-- Indexes for table `cash_pickup`
--
ALTER TABLE `cash_pickup`
  ADD PRIMARY KEY (`id_pickup`);

--
-- Indexes for table `data_barang`
--
ALTER TABLE `data_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `koreksi_barang`
--
ALTER TABLE `koreksi_barang`
  ADD PRIMARY KEY (`id_nota`);

--
-- Indexes for table `koreksi_cash`
--
ALTER TABLE `koreksi_cash`
  ADD PRIMARY KEY (`id_nota`);

--
-- Indexes for table `nota_lapangan`
--
ALTER TABLE `nota_lapangan`
  ADD PRIMARY KEY (`id_nota_lapangan`);

--
-- Indexes for table `nota_parkir`
--
ALTER TABLE `nota_parkir`
  ADD PRIMARY KEY (`id_nota`);

--
-- Indexes for table `nota_penjualan_barang`
--
ALTER TABLE `nota_penjualan_barang`
  ADD PRIMARY KEY (`id_nota`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembelianbayarnota`
--
ALTER TABLE `pembelianbayarnota`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembeliannota`
--
ALTER TABLE `pembeliannota`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembeliantemp`
--
ALTER TABLE `pembeliantemp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sewatempat`
--
ALTER TABLE `sewatempat`
  ADD PRIMARY KEY (`id_nota`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cashflow`
--
ALTER TABLE `cashflow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cash_deposit`
--
ALTER TABLE `cash_deposit`
  MODIFY `id_deposit` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `cash_inject`
--
ALTER TABLE `cash_inject`
  MODIFY `id_inject` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `cash_pickup`
--
ALTER TABLE `cash_pickup`
  MODIFY `id_pickup` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `nota_lapangan`
--
ALTER TABLE `nota_lapangan`
  MODIFY `id_nota_lapangan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `pembelianbayarnota`
--
ALTER TABLE `pembelianbayarnota`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT for table `pembeliannota`
--
ALTER TABLE `pembeliannota`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `pembeliantemp`
--
ALTER TABLE `pembeliantemp`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
