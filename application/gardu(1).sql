-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 09, 2021 at 11:27 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gardu`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `display_name` varchar(255) NOT NULL DEFAULT '',
  `icon` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `order_by` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `display_name`, `icon`, `parent_id`, `created_at`, `updated_at`, `order_by`) VALUES
(1, 'dashboard', 'Dashboard', 'micon dw dw-house', NULL, '2021-07-30 10:22:10', '2021-07-30 10:22:10', 1),
(2, 'User', 'Management User', 'micon dw dw-calendar1', NULL, '2021-07-30 10:28:42', '2021-07-30 10:28:43', NULL),
(10, 'Setting', 'Setting', 'micon dw dw-settings1', NULL, '2021-07-30 13:52:19', '2021-07-30 13:52:19', NULL),
(11, 'Gardu', 'Input Gardu', 'micon dw dw-calendar1', 28, '2021-07-30 13:52:20', '2021-07-30 13:52:20', NULL),
(17, 'Approval', 'Approval Operational Gardu', 'micon dw dw-calendar1', 28, '2021-07-30 13:52:28', '2021-07-30 13:52:29', NULL),
(28, '#', 'Operational System', 'micon dw dw-shopping-cart-1', NULL, NULL, NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id_akses` int(11) NOT NULL,
  `nama_akses` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id_akses`, `nama_akses`) VALUES
(1, 'administrator'),
(2, 'Approver'),
(3, 'Requestor'),
(4, 'Management');

-- --------------------------------------------------------

--
-- Table structure for table `role_menu`
--

CREATE TABLE `role_menu` (
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role_menu`
--

INSERT INTO `role_menu` (`role_id`, `menu_id`) VALUES
(1, 1),
(1, 2),
(1, 10),
(3, 1),
(3, 11),
(3, 28),
(2, 1),
(2, 17),
(2, 28),
(4, 1),
(4, 11),
(4, 17),
(4, 28);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_operational`
--

CREATE TABLE `tbl_operational` (
  `id_operational` int(11) NOT NULL,
  `date_request` date NOT NULL,
  `nama_gardu` varchar(50) NOT NULL,
  `pekerjaan` varchar(50) DEFAULT NULL,
  `nama_user` varchar(30) NOT NULL,
  `time_in` time DEFAULT NULL,
  `time_out` time DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `approval_status` enum('approved','rejected') DEFAULT NULL,
  `approval_at` timestamp NULL DEFAULT NULL,
  `approval_sp_status` enum('waiting','approved','rejected') NOT NULL DEFAULT 'waiting',
  `approval_sp_at` datetime DEFAULT NULL,
  `action_by` varchar(255) DEFAULT NULL,
  `approval_sp` datetime DEFAULT NULL,
  `time_waiting_cek_out` datetime DEFAULT NULL,
  `waiting_check_out` enum('approved','rejected','wait') NOT NULL DEFAULT 'wait',
  `image` varchar(222) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_operational`
--

INSERT INTO `tbl_operational` (`id_operational`, `date_request`, `nama_gardu`, `pekerjaan`, `nama_user`, `time_in`, `time_out`, `id_user`, `approval_status`, `approval_at`, `approval_sp_status`, `approval_sp_at`, `action_by`, `approval_sp`, `time_waiting_cek_out`, `waiting_check_out`, `image`) VALUES
(441, '2021-11-09', 'Gardu_03-Alamat_3', 'input kabel', '', NULL, NULL, 124, NULL, NULL, 'waiting', NULL, NULL, NULL, NULL, 'wait', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_setting`
--

CREATE TABLE `tbl_setting` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama_perusahaan` varchar(100) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `website` varchar(100) NOT NULL,
  `logo` varchar(200) NOT NULL,
  `logo_admin` varchar(200) DEFAULT NULL,
  `background_admin` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_setting`
--

INSERT INTO `tbl_setting` (`id`, `nama_perusahaan`, `alamat`, `no_telp`, `email`, `website`, `logo`, `logo_admin`, `background_admin`) VALUES
(1, 'Distribution Operational Mobile Apps', 'PT. Cikarang Listrindo di Cikarang: Alamat: Jalan Jababeka Raya Blok R (Kawasan Industri Jababeka), Cikarang, Bekasi.', '(0283) 351093', 'listrindojababeka@yahoo.com', 'http://www.cikaranglistindo.com', '', NULL, 'photo-1613906779779-1b387c2c22e11.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `nip` int(50) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `level` varchar(50) NOT NULL,
  `supervisor_name` varchar(43) NOT NULL,
  `password` varchar(32) NOT NULL,
  `id_akses` varchar(15) NOT NULL,
  `last_login` date NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `nip`, `nama_lengkap`, `username`, `level`, `supervisor_name`, `password`, `id_akses`, `last_login`, `foto`) VALUES
(9, 2147483647, 'admin', 'admin', '', 'taufik   - approver', '202cb962ac59075b964b07152d234b70', '1', '2021-11-09', '4c96c51c27f99dcbf783e07fa86bb982.png'),
(124, 2147483647, 'adnan', 'adnan', 'Staff', 'yuda   - approver', '202cb962ac59075b964b07152d234b70', '3', '2021-11-09', '5cbc50cc40f32934e447a0334e7f0928.jpeg'),
(125, 2147483647, 'yuda', 'yuda', 'Staff', 'yuda   - approver', '202cb962ac59075b964b07152d234b70', '2', '2021-11-05', '24c62b21702bc711e120f33a49230b4e.jpeg'),
(0, 2147483647, 'management_1', 'management_1', '', 'yuda -  - approver', '202cb962ac59075b964b07152d234b70', '4', '2021-11-09', 'c7e55817b741770b056680e4d6ba8f2d.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_akses`);

--
-- Indexes for table `role_menu`
--
ALTER TABLE `role_menu`
  ADD KEY `FK_ROLE` (`role_id`),
  ADD KEY `FK_MENUE` (`menu_id`);

--
-- Indexes for table `tbl_operational`
--
ALTER TABLE `tbl_operational`
  ADD PRIMARY KEY (`id_operational`);

--
-- Indexes for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id_akses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_operational`
--
ALTER TABLE `tbl_operational`
  MODIFY `id_operational` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=442;

--
-- AUTO_INCREMENT for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `role_menu`
--
ALTER TABLE `role_menu`
  ADD CONSTRAINT `FK_MENUE` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_ROLE` FOREIGN KEY (`role_id`) REFERENCES `role` (`id_akses`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
