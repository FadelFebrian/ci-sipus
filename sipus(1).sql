-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2018 at 08:18 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sipus`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE IF NOT EXISTS `anggota` (
  `anggota_id` int(11) NOT NULL AUTO_INCREMENT,
  `anggota_code` varchar(10) NOT NULL DEFAULT '''''',
  `anggota_nama` varchar(50) DEFAULT '''''',
  `anggota_pass` varchar(225) NOT NULL DEFAULT '''''',
  PRIMARY KEY (`anggota_id`),
  UNIQUE KEY `anggota_code` (`anggota_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`anggota_id`, `anggota_code`, `anggota_nama`, `anggota_pass`) VALUES
(8, '2014470028', 'Fadel F', '2014470028'),
(9, '2014470040', 'Hatim', '1234'),
(11, '2014470037', 'Khairil', '2014470037'),
(12, '2014470056', 'Ryan', '2014470056'),
(13, '2014470015', 'Basril', '2014470015'),
(14, '2014470068', 'Opal', '2014470068'),
(15, '2014470070', 'Angga', '2014470070');

-- --------------------------------------------------------

--
-- Table structure for table `base`
--

CREATE TABLE IF NOT EXISTS `base` (
  `base_id` int(11) NOT NULL AUTO_INCREMENT,
  `base_code` varchar(12) NOT NULL DEFAULT '''''',
  `base_nama` varchar(18) NOT NULL DEFAULT '''''',
  `base_content` text NOT NULL,
  `base_img` varchar(50) NOT NULL DEFAULT '''''',
  PRIMARY KEY (`base_id`),
  UNIQUE KEY `base_code` (`base_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `base`
--

INSERT INTO `base` (`base_id`, `base_code`, `base_nama`, `base_content`, `base_img`) VALUES
(1, 'PROFILE', 'Profile', 'selamat datang di perpustakaan UMJ', ''''''),
(4, 'ANGGOTA', 'Anggota', 'tatacara jadi anggota baru', '''''');

-- --------------------------------------------------------

--
-- Table structure for table `koleksi`
--

CREATE TABLE IF NOT EXISTS `koleksi` (
  `koleksi_id` int(11) NOT NULL AUTO_INCREMENT,
  `koleksi_code` varchar(8) NOT NULL DEFAULT '''''',
  `koleksi_judul` text NOT NULL,
  `koleksi_tipe` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 Buku, 1 Jurnal, 2 Skripsi, 3 e-Book',
  `koleksi_penulis` text NOT NULL,
  `koleksi_penerbit` varchar(50) NOT NULL DEFAULT '''''',
  `koleksi_tahun` year(4) NOT NULL,
  `koleksi_sinopsis` text NOT NULL,
  `koleksi_ratting` int(1) NOT NULL DEFAULT '0',
  `koleksi_sampul` varchar(55) NOT NULL DEFAULT '''''',
  `koleksi_file` varchar(55) NOT NULL DEFAULT '''''',
  PRIMARY KEY (`koleksi_id`),
  UNIQUE KEY `koleksi_code` (`koleksi_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `koleksi`
--

INSERT INTO `koleksi` (`koleksi_id`, `koleksi_code`, `koleksi_judul`, `koleksi_tipe`, `koleksi_penulis`, `koleksi_penerbit`, `koleksi_tahun`, `koleksi_sinopsis`, `koleksi_ratting`, `koleksi_sampul`, `koleksi_file`) VALUES
(25, 'BK-A25', 'Pengantar Tata Kelola Inernet', 0, 'Subro', 'ABC', 2017, '', 4, 'C_BKA251532235661', ''''''),
(26, 'BK-A26', 'Strategi Kewirausahaan Digital', 0, 'Suprapto', 'ABC', 2017, '\r\n', 4, 'C_DEF', ''''''),
(27, 'BK-A27', 'Membuat Aplikasi Sederhana Menggunakan Java', 0, 'Samuel', 'ABC', 2017, '', 4, 'C_DEF', ''''''),
(28, 'BK-A28', 'MySQL dan JAVA Database Connectivity', 0, 'Wahyu', 'ABC', 2017, '', 2, 'C_DEF', ''),
(35, 'BK-A35', 'suka suka', 3, 'Wahyu', 'aja', 2018, '', 3, 'C_BKA351532237081', 'F_BKA351532237007'),
(36, 'JR-A36', 'Bebas', 1, 'candra', 'candra', 2016, '', 4, 'C_DEF', '''''');

-- --------------------------------------------------------

--
-- Table structure for table `ratting`
--

CREATE TABLE IF NOT EXISTS `ratting` (
  `ratting_id` int(11) NOT NULL AUTO_INCREMENT,
  `anggota_key` varchar(12) NOT NULL DEFAULT '''''',
  `koleksi_key` varchar(12) NOT NULL DEFAULT '''''',
  `ratting_val` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ratting_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `ratting`
--

INSERT INTO `ratting` (`ratting_id`, `anggota_key`, `koleksi_key`, `ratting_val`) VALUES
(36, '2014470028', 'BK-A25', 4),
(37, '2014470028', 'BK-A26', 3),
(38, '2014470040', 'BK-A25', 4),
(39, '2014470040', 'BK-A26', 5),
(40, '2014470040', 'BK-A27', 4),
(41, '2014470040', 'BK-A28', 2),
(42, '2014470013', 'BK-A25', 4),
(43, '2014470013', 'BK-A26', 2),
(44, '2014470013', 'BK-A27', 3),
(45, '2014470037', 'BK-A25', 1),
(46, '2014470037', 'BK-A28', 2),
(47, '2014470056', 'BK-A25', 4),
(48, '2014470056', 'BK-A26', 5),
(49, '2014470056', 'BK-A28', 2),
(50, '2014470015', 'BK-A26', 1),
(51, '2014470015', 'BK-A27', 3),
(52, '2014470068', 'BK-A35', 1),
(53, '2014470068', 'BK-A25', 5),
(54, '2014470040', 'BK-A35', 3),
(55, '2014470070', 'JR-A36', 4),
(56, '2014470070', 'BK-A35', 5);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `staff_id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_code` varchar(12) NOT NULL DEFAULT '''''',
  `staff_nama` varchar(50) NOT NULL DEFAULT '''''',
  `staff_jabatan` varchar(20) NOT NULL DEFAULT '''''',
  `staff_foto` varchar(20) NOT NULL,
  `staff_pass` varchar(225) NOT NULL,
  `admin` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`staff_id`),
  UNIQUE KEY `staff_code` (`staff_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `staff_code`, `staff_nama`, `staff_jabatan`, `staff_foto`, `staff_pass`, `admin`) VALUES
(1, '1231231230', 'Joko Widodo', 'Kepala Perpustakaan', '1532238918', '123456', 1),
(2, '123123123', 'Fadel F', 'Staff Perpustakaan', '1532239031', '123', 0),
(3, '1231231231', 'Bagus', 'Staff Perpustakaan', '', '1231231231', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
