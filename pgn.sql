-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 27, 2024 at 04:00 PM
-- Server version: 5.7.36
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pgn`
--

-- --------------------------------------------------------

--
-- Table structure for table `pemakaian`
--

DROP TABLE IF EXISTS `pemakaian`;
CREATE TABLE IF NOT EXISTS `pemakaian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `volume` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemakaian`
--

INSERT INTO `pemakaian` (`id`, `user_id`, `volume`) VALUES
(1, 21, '45555a'),
(3, 21, '45555sss');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_fullname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_username` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_email` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_image_url` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_role` enum('Superadmin','Operator','Pelanggan') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pelanggan',
  `user_is_deleted` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `users_user_username_unique` (`user_username`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_fullname`, `user_username`, `user_email`, `user_phone_number`, `user_password`, `user_image_url`, `user_role`, `user_is_deleted`, `created_at`, `updated_at`, `alamat`) VALUES
(20, 'administrator', 'administrator', 'administrator@gmail.com', NULL, 'f865b53623b121fd34ee5426c792e5c33af8c227', NULL, 'Superadmin', 'No', NULL, NULL, NULL),
(21, 'pelanggan', 'pelanggan', 'pelanggan@gmail.com', NULL, 'f865b53623b121fd34ee5426c792e5c33af8c227', NULL, 'Pelanggan', 'No', NULL, NULL, NULL),
(22, 'asdasd', 'operator', '', NULL, 'f865b53623b121fd34ee5426c792e5c33af8c227', NULL, 'Operator', 'No', NULL, NULL, 'asdasd');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
