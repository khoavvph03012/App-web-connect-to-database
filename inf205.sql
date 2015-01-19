-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2015 at 03:35 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `inf205`
--
-- --------------------------------------------------------

--
-- Table structure for table `khachhang`
--

CREATE TABLE IF NOT EXISTS `khachhang` (
  `MaKH` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `TenKH` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `DiaChi` text COLLATE utf8_unicode_ci,
  `Email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY(MaKH)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `khachhang`
--

INSERT INTO `khachhang` (`MaKH`, `TenKH`, `DiaChi`, `Email`) VALUES
('KH01', 'Võ Văn Khoa', 'Hà Nội', 'khoazero123@gmail.com'),
('KH02', 'Phạm Viết Bảo', 'Nghệ An', 'phambao@gmail.com'),
('KH03', 'Trần Văn Công', 'Nghệ An', 'trancong@gmail.com'),
('KH04', 'Trần Văn Thức', 'Đống Đa, Hà Nội', 'thuc@yahoo.com'),
('KH05', 'Nguyễn Văn Toàn', 'Từ Liêm, Hà Nội', 'toan@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `loaisanpham`
--

CREATE TABLE IF NOT EXISTS `loaisanpham` (
  `MaLoaiSP` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `MoTa` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY(MaLoaiSP)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `loaisanpham`
--

INSERT INTO `loaisanpham` (`MaLoaiSP`, `MoTa`) VALUES
('L01', 'Chăn, ga, gối, đệm'),
('L02', 'Điện dân dụng'),
('L03', 'Quần áo'),
('L04', 'Giày dép'),
('L05', 'Trang sức');

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

CREATE TABLE IF NOT EXISTS `sanpham` (
  `MaSP` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `TenSP` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `MaLoaiSP` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Gia` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY(MaSP),
  FOREIGN KEY(MaLoaiSP) REFERENCES loaisanpham(MaLoaiSP)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`MaSP`, `TenSP`, `MaLoaiSP`, `Gia`) VALUES
('SP01', 'Áo sơ mi', 'L03', '120000'),
('SP02', 'Quần bò', 'L03', '200000'),
('SP03', 'Vòng đeo tay', 'L05', '110000'),
('SP04', 'Bàn là', 'L02', '250000'),
('SP05', 'Bếp điện', 'L02', '490000'),
('SP06', 'Áo thun', 'L03', '90000'),
('SP07', 'Giày thể thao', 'L04', '300000'),
('SP08', 'Giầy cao gót', 'L04', '320000'),
('SP09', 'Quần lót', 'L03', '50000'),
('SP10', 'Chăn', 'L01', '330000');

--
-- Table structure for table `hoadon`
--


CREATE TABLE IF NOT EXISTS `hoadon` (
  `MaHD` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `NgayHD` date NOT NULL,
  `MaKH` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `GiaTriHD` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY(MaHD),
  FOREIGN KEY(MaKH) REFERENCES khachhang(MaKH)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hoadon`
--

INSERT INTO `hoadon` (`MaHD`, `NgayHD`, `MaKH`, `GiaTriHD`) VALUES
('HD01', '2015-01-18', 'KH01', '310000'),
('HD02', '2015-01-18', 'KH02', '120000'),
('HD03', '2015-01-17', 'KH03', '740000'),
('HD04', '2015-01-16', 'KH04', '430000'),
('HD05', '2015-01-17', 'KH05', '310000');


--
-- Table structure for table `cthoadon`
--

CREATE TABLE IF NOT EXISTS `cthoadon` (
  `MaHD` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `MaSP` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `SLSP` int(50) NOT NULL DEFAULT '1',
  `GiaSP` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Comment` text COLLATE utf8_unicode_ci,
    FOREIGN KEY(MaSP) REFERENCES sanpham(MaSP),
    FOREIGN KEY(MaHD) REFERENCES hoadon(MaHD)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cthoadon`
--

INSERT INTO `cthoadon` (`MaHD`, `MaSP`, `SLSP`, `GiaSP`, `Comment`) VALUES
('HD01', 'SP02', 1, '200000', NULL),
('HD01', 'SP03', 2, '110000', NULL),
('HD02', 'SP01', 3, '120000', NULL),
('HD03', 'SP05', 2, '490000', NULL),
('HD03', 'SP04', 3, '250000', NULL),
('HD05', 'SP03', 2, '110000', NULL),
('HD04', 'SP01', 10, '120000', NULL),
('HD05', 'SP02', 2, '200000', NULL),
('HD04', 'SP03', 1, '110000', NULL),
('HD04', 'SP02', 2, '200000', NULL);
-- --------------------------------------------------------



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
