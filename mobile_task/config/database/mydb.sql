-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2024 at 01:16 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_info`
--

CREATE TABLE `admin_info` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `admin_address` varchar(225) NOT NULL,
  `email` varchar(100) NOT NULL,
  `admin_phno` bigint(11) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` varchar(225) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_info`
--

INSERT INTO `admin_info` (`id`, `name`, `user_name`, `admin_address`, `email`, `admin_phno`, `password`, `created_on`, `created_by`, `updated_on`, `updated_by`) VALUES
(1, 'Ramya', 'Ramya', 'chennai-001', 'ramya@gmail.com', 8845632190, '12', '2024-01-08 21:04:38', 'ramya@gmail.com', '2024-01-25 14:45:10', 'ramya@gmail.com'),
(2, 'Shana', 'Shanam', 'Chennai-008', 'shana@gmail.com', 8877663290, '12', '2024-01-10 11:21:59', 'shana@gmail.com', '2024-01-10 11:22:36', 'shana@gmail.com'),
(3, 'Mahalakshmi', 'Maha123', 'Chennai-007', 'maha@gmail.com', 8899447302, 'Maha@23', '2024-01-25 15:40:48', 'Maha123', '2024-01-25 15:53:25', 'Maha123'),
(4, 'Admin1', 'admin@1', 'Mobile shoppe', 'admin1@gmail.com', 8899447302, 'admin@1', '2024-01-25 15:43:17', 'admin@1', '2024-01-25 15:58:49', 'admin@1');

-- --------------------------------------------------------

--
-- Table structure for table `order_table`
--

CREATE TABLE `order_table` (
  `id` int(11) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `company_mail` varchar(50) NOT NULL,
  `company_phno` bigint(50) NOT NULL,
  `company_address` varchar(50) NOT NULL,
  `product_id` varchar(10) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_price` int(11) NOT NULL,
  `order_id` varchar(10) NOT NULL,
  `seller_id` varchar(5) NOT NULL,
  `seller_name` varchar(50) NOT NULL,
  `seller_phno` bigint(10) NOT NULL,
  `seller_mailid` varchar(255) NOT NULL,
  `seller_address` varchar(255) NOT NULL,
  `order_qty` int(11) NOT NULL,
  `order_price` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `delivery_date` date NOT NULL,
  `order_status` varchar(225) NOT NULL DEFAULT 'Pending',
  `created_by` varchar(225) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_by` varchar(225) NOT NULL,
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_table`
--

INSERT INTO `order_table` (`id`, `company_name`, `company_mail`, `company_phno`, `company_address`, `product_id`, `product_name`, `product_price`, `order_id`, `seller_id`, `seller_name`, `seller_phno`, `seller_mailid`, `seller_address`, `order_qty`, `order_price`, `order_date`, `delivery_date`, `order_status`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(2, 'Shopee Mobile Showroom', 'shopeemobile@gmail.com', 9900563892, 'Chennai-008', 'PRDID2', 'Google pixcel 3', 35000, 'ORDID2', 'SID2', 'Google showroom', 9999444000, 'google@gmail.com', 'Chennai-88', 4, 140000, '2024-01-24', '2024-01-25', 'Delivered', 'ramya@gmail.com', '2024-01-24 15:25:27', '', '2024-01-25 17:23:38'),
(3, 'Shopee Mobile Showroom', 'shopeemobile@gmail.com', 9900563892, 'Chennai-008', 'PRDID3', 'Google pixcel 3', 35000, 'ORDID3', 'SID3', 'Google showroom', 9999444000, 'google@gmail.com', 'Chennai-88', 4, 140000, '2024-01-24', '2024-01-25', 'Delivered', 'ramya@gmail.com', '2024-01-24 15:29:39', 'ramya@gmail.com', '2024-01-25 14:48:23'),
(4, 'Shopee Mobile Showroom', 'shopeemobile@gmail.com', 9900563892, 'Chennai-008', 'PRDID4', 'Google pixcel 3', 35000, 'ORDID4', 'SID4', 'Google showroom', 9999444000, 'google@gmail.com', 'Chennai-88', 4, 140000, '2024-01-24', '2024-01-24', 'Delivered', 'ramya@gmail.com', '2024-01-24 15:29:44', 'ramya@gmail.com', '2024-01-24 16:03:02'),
(5, 'Shopee Mobile Showroom', 'shopeemobile@gmail.com', 9900563892, 'Chennai-008', 'PRDID5', 'Realme_C2', 90000, 'ORDID5', 'SID5', 'Realme showroom', 9999444000, 'redmi@gmail.com', 'Chennai-007', 4, 360000, '2024-01-24', '2024-01-24', 'Delivered', 'ramya@gmail.com', '2024-01-24 15:33:51', 'ramya@gmail.com', '2024-01-24 17:38:44'),
(6, 'Shopee Mobile Showroom', 'shopeemobile@gmail.com', 9900563892, 'Chennai-008', 'PRDID6', 'Mi mix', 40000, 'ORDID6', 'SID6', 'Redmi showroom', 9999444000, 'redmi@gmail.com', 'Chennai-007', 4, 160000, '2024-01-25', '2024-01-25', 'Delivered', 'ramya@gmail.com', '2024-01-25 15:01:47', '', '2024-01-25 17:21:39'),
(7, 'Shopee Mobile Showroom', 'shopeemobile@gmail.com', 9900563892, 'Chennai-008', 'PRDID7', 'Realme_C2', 40000, 'ORDID7', 'SID7', 'Realme showroom', 9999444000, 'redme@gmail.com', 'chennai-006', 4, 160000, '2024-01-25', '2024-01-25', 'Delivered', '', '2024-01-25 17:33:24', '', '2024-01-25 17:33:33');

-- --------------------------------------------------------

--
-- Table structure for table `product_table`
--

CREATE TABLE `product_table` (
  `id` int(11) NOT NULL,
  `product_id` varchar(25) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `phone_ram` varchar(10) NOT NULL,
  `phone_storage` varchar(15) NOT NULL,
  `phone_display_size` varchar(25) NOT NULL,
  `battery` varchar(20) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_total_qty` int(11) NOT NULL,
  `images` varchar(225) NOT NULL,
  `created_by` varchar(225) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_by` varchar(225) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_table`
--

INSERT INTO `product_table` (`id`, `product_id`, `product_name`, `phone_ram`, `phone_storage`, `phone_display_size`, `battery`, `product_price`, `product_total_qty`, `images`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(1, 'PRD1', 'Google pixcel 3', '6 GB', '64 GB', '4.5 inch', '5000 mAh', 35000, 20, '65b0ad0a965b6.png', 'ramya@gmail.com', '2024-01-24 11:54:10', 'ramya@gmail.com', '2024-01-24 17:38:21'),
(2, 'PRD2', 'LG_G4', '4 GB', '64 GB', '4.5 inch', '4000 mAh', 40000, 20, '65b0adb4b765a.png', 'ramya@gmail.com', '2024-01-24 11:57:00', NULL, NULL),
(3, 'PRD3', 'Realme_C2', '6 GB', '128 GB', '5.5 inch', '5000 mAh', 90000, 8, '65b0adce93afc.png', 'ramya@gmail.com', '2024-01-24 11:57:26', NULL, NULL),
(5, 'PRD5', 'OPPO_Reno_10x_Zoom', '6 GB', '128 GB', '5.5 inch', '4000 mAh', 90000, 5, '65b0ae0e77c14.png', 'ramya@gmail.com', '2024-01-24 11:58:30', 'ramya@gmail.com', '2024-01-24 17:26:14'),
(7, 'PRD7', 'Asus_ROG', '4 GB', '64 GB', '4.5 inch', '4000 mAh', 35000, 20, '65b0ae5e04523.png', 'ramya@gmail.com', '2024-01-24 11:59:50', NULL, NULL),
(8, 'PRD8', 'Google pixcel 3', '6 GB', '64 GB', '4.5 inch', '5000 mAh', 35000, 1, '65b0c3a58d216.png', 'ramya@gmail.com', '2024-01-24 13:30:37', NULL, NULL),
(9, 'PRD9', 'Google pixcel 3', '6 GB', '64 GB', '4.5 inch', '5000 mAh', 35000, 9, '65b0c40668df6.png', 'ramya@gmail.com', '2024-01-24 13:32:14', NULL, NULL),
(10, 'PRD10', 'Google pixcel 3', '6 GB', '64 GB', '4.5 inch', '5000 mAh', 35000, 2, '65b0c41c19e39.png', 'ramya@gmail.com', '2024-01-24 13:32:36', NULL, NULL),
(11, 'PRD11', 'Realme_C2', '4 GB', '128 GB', '5.5 inch', '4000 mAh', 40000, 4, '65b0c43e22a1c.png', 'ramya@gmail.com', '2024-01-24 13:33:10', NULL, NULL),
(12, 'PRD12', 'Google pixcel 3', '4 GB', '128 GB', '5.5 inch', '5000 mAh', 35000, 20, '65b0c46e169e4.png', 'ramya@gmail.com', '2024-01-24 13:33:58', NULL, NULL),
(13, 'PRD13', 'Google pixcel 3', '6 GB', '64 GB', '4.5 inch', '5000 mAh', 35000, 3, '65b0c48469cb2.png', 'ramya@gmail.com', '2024-01-24 13:34:20', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `super_admin`
--

CREATE TABLE `super_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `created_by` varchar(225) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_by` varchar(225) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `super_admin`
--

INSERT INTO `super_admin` (`id`, `username`, `password`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(1, 'Maha123', 'Maha@23', 'Maha123', '2024-01-25 07:56:58', 'Maha123', '2024-01-25 15:56:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_info`
--
ALTER TABLE `admin_info`
  ADD UNIQUE KEY `id` (`id`,`admin_phno`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- Indexes for table `order_table`
--
ALTER TABLE `order_table`
  ADD UNIQUE KEY `order_id` (`order_id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `product_table`
--
ALTER TABLE `product_table`
  ADD UNIQUE KEY `id` (`id`,`product_id`);

--
-- Indexes for table `super_admin`
--
ALTER TABLE `super_admin`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_info`
--
ALTER TABLE `admin_info`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_table`
--
ALTER TABLE `order_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_table`
--
ALTER TABLE `product_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `super_admin`
--
ALTER TABLE `super_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
