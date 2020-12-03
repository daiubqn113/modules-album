-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2020 at 05:52 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `album`
--

-- --------------------------------------------------------

--
-- Table structure for table `nv4_album`
--

CREATE TABLE `nv4_album` (
  `id` int(11) NOT NULL,
  `title_album` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Tên album',
  `img` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'file ảnh',
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Nội dung ảnh',
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT 'Hiển thị 1: ẩn 0',
  `weight` tinyint(4) NOT NULL DEFAULT 1 COMMENT 'Sắp xếp',
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Thời gian tạo',
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'thơi gian cập nhật'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `nv4_album`
--
ALTER TABLE `nv4_album`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title_album` (`title_album`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
