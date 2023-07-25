-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2023 at 11:19 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ssms`
--

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `history_id` int(11) NOT NULL,
  `os_id` int(11) DEFAULT NULL,
  `ts_id` int(11) DEFAULT NULL,
  `tor_id` int(11) DEFAULT NULL,
  `history_quantity` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `history_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`history_id`, `os_id`, `ts_id`, `tor_id`, `history_quantity`, `user_id`, `status`, `modified_by`, `history_date`) VALUES
(1, 3, NULL, NULL, 10, 8, 'approved', 1, '2023-05-25 16:08:23'),
(2, 2, NULL, NULL, 5, 8, 'approved', 1, '2023-05-25 16:18:36'),
(3, NULL, 18, NULL, 2, 8, 'approved', 1, '2023-05-25 16:19:24'),
(4, NULL, 18, NULL, 1, 8, 'approved', 1, '2023-05-25 16:25:33'),
(5, 4, NULL, NULL, 1, 8, 'approved', 1, '2023-05-25 16:47:19'),
(6, 1, NULL, NULL, 10, 8, 'approved', 1, '2023-05-26 06:08:04'),
(7, 2, NULL, NULL, 10, 8, 'approved', 1, '2023-05-26 06:08:20'),
(8, 12, NULL, NULL, 6, 8, 'pending', NULL, '2023-05-26 06:08:29'),
(9, 12, NULL, NULL, 10, 7, 'pending', NULL, '2023-05-26 06:12:18'),
(10, 11, NULL, NULL, 2, 1, 'approved', 1, '2023-05-26 06:15:00'),
(11, NULL, 18, NULL, 2, 8, 'approved', 1, '2023-05-26 06:15:30'),
(12, NULL, 18, NULL, 2, 8, 'approved', 1, '2023-05-26 06:16:10'),
(13, 2, NULL, NULL, 10, 8, 'pending', NULL, '2023-06-22 21:21:18');

-- --------------------------------------------------------

--
-- Table structure for table `office_supplies`
--

CREATE TABLE `office_supplies` (
  `os_id` int(11) NOT NULL,
  `os_name` varchar(255) NOT NULL,
  `os_brand` varchar(255) NOT NULL,
  `os_uom` varchar(20) NOT NULL,
  `os_quantity` int(11) NOT NULL,
  `os_location` varchar(255) NOT NULL,
  `os_img` varchar(255) NOT NULL,
  `os_desc` varchar(255) DEFAULT NULL,
  `status` varchar(100) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_last_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `office_supplies`
--

INSERT INTO `office_supplies` (`os_id`, `os_name`, `os_brand`, `os_uom`, `os_quantity`, `os_location`, `os_img`, `os_desc`, `status`, `date_added`, `date_last_modified`, `modified_by`) VALUES
(1, 'Bond Paper A4 asdda', 'Hard Copy', 'Ream', 4990, 'Stock Room A', 'IMG_63df6b5dc14611.72142433.png', 'Short / A4 / Long Size 70gsm, 500Sheets/ream', 'enabled', '2022-11-01 00:00:00', '2023-05-26 06:13:16', 1),
(2, 'Stapler', 'HBW', 'Pack', 2874, 'Stock Room B', 'IMG_63e4b19f9aacc6.30884197.jpg', '[DKI ENTERPRISES] HBW STAPLER #35 BIG', 'enabled', '2022-10-15 00:00:00', '2023-05-26 06:13:35', 1),
(3, 'DC 25 Pcs Panda Crystal Ballpen', 'Panda', 'Pack', 10, 'Stock Room B', 'IMG_63e4b222e48453.00468175.jpg', 'Black Red Blue Authentic Brand Tech Pen Water Gel', 'enabled', '2022-09-01 00:00:00', '2023-05-25 16:09:28', 1),
(4, 'Mead Spiral Notebook', 'Mead', 'Piece', 0, 'Stock Room A', 'IMG_63e4b692a296e1.09573559.jpg', '1 Subject, Wide Ruled, 70 Sheets, 10 1/2\" x 7 1/2\", 12 Pack', 'enabled', '2022-08-01 00:00:00', '2023-05-25 16:47:58', 1),
(5, 'Vinyl Coated Paper Clips', 'ABCD', 'Ream', 83, 'Stock Room C', 'IMG_63e3d377560c34.31624730.jpg', 'HBWOffice Vinyl Coated Paper Clips, 50mm / 100 PCS / Assorted Color 031-010', 'enabled', '2023-02-09 00:53:11', '2023-05-25 15:46:22', 1),
(6, 'ASDASDA', 'test', 'ADASD', 3, 'DASDSA', 'IMG_646f11fc018b37.10407027.png', 'test', 'enabled', '2023-05-18 00:08:49', '2023-05-25 15:45:13', 1),
(7, 'test', 'test', 'test', 1, 'test', 'IMG_6464fc20389578.69112606.png', 'test', 'enabled', '2023-05-18 00:09:04', '2023-05-18 00:09:04', 1),
(8, 'test', 'test', 'test', 24, 'test', 'IMG_6464fc2cf02010.84939666.png', 'test', 'enabled', '2023-05-18 00:09:16', '2023-05-26 06:27:36', 1),
(9, 'test', 'test', 'test', 1, 'test', 'IMG_6464fc3899b443.90417703.png', 'test', 'enabled', '2023-05-18 00:09:28', '2023-05-18 00:09:28', 1),
(10, 'test', 'test', 'test', 1, 'test', 'IMG_6464fc430e2394.51724789.png', 'test', 'enabled', '2023-05-18 00:09:39', '2023-05-18 00:09:39', 1),
(11, 'test (page 2)', 'test', 'test', 10, 'test', 'IMG_6464fc4eb6ed62.08198102.png', 'test', 'enabled', '2023-05-18 00:09:50', '2023-05-26 06:15:11', 1),
(12, 'test', 'test', 'test', 27, 'test', 'IMG_646510fec22d21.51293748.png', 'test', 'enabled', '2023-05-18 01:38:06', '2023-05-18 23:10:22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `report_id` int(11) NOT NULL,
  `os_id` int(11) DEFAULT NULL,
  `ts_id` int(11) DEFAULT NULL,
  `report_description` varchar(255) NOT NULL,
  `report_by` int(11) NOT NULL,
  `report_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`report_id`, `os_id`, `ts_id`, `report_description`, `report_by`, `report_date`) VALUES
(4, 1, NULL, 'damaged papers', 1, '2023-02-07 05:52:29'),
(5, 1, NULL, 'crumpled sheets', 1, '2023-02-09 05:52:29'),
(13, NULL, 4, 'The stand has a crack', 1, '2023-02-09 13:20:02'),
(14, 3, NULL, 'Some pens inside the pack are not working', 1, '2023-02-09 13:20:19'),
(15, NULL, 3, 'Something wrong with wiring', 1, '2023-02-09 13:51:24'),
(16, NULL, 7, 'Defective', 3, '2023-02-09 14:29:52'),
(17, 1, NULL, 'There are some crumpled ones', 3, '2023-02-09 14:30:13'),
(18, 4, NULL, 'Torn in the corners', 3, '2023-02-09 14:55:05'),
(19, 1, NULL, 'Very good quality', 3, '2023-02-09 15:22:22'),
(20, NULL, 3, 'gjgjfgjy', 8, '2023-06-22 21:35:28');

-- --------------------------------------------------------

--
-- Table structure for table `restocks`
--

CREATE TABLE `restocks` (
  `restock_id` int(11) NOT NULL,
  `ts_id` int(11) DEFAULT NULL,
  `os_id` int(11) DEFAULT NULL,
  `restock_quantity` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `restock_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `restocks`
--

INSERT INTO `restocks` (`restock_id`, `ts_id`, `os_id`, `restock_quantity`, `user_id`, `restock_date`) VALUES
(1, 1, NULL, 10, 1, '2023-01-16 00:00:00'),
(2, NULL, 1, 500, 1, '2023-01-16 00:00:00'),
(3, NULL, 2, 100, 1, '2023-01-17 00:00:00'),
(4, 3, NULL, 2, 3, '2023-02-06 10:14:25'),
(5, 3, NULL, 3, 3, '2023-02-06 18:26:10'),
(6, 5, NULL, 1, 1, '2023-02-09 14:06:59'),
(7, 5, NULL, 2, 1, '2023-02-09 14:07:27'),
(8, 5, NULL, 2, 1, '2023-02-09 14:09:54'),
(9, 5, NULL, 2, 1, '2023-02-09 14:10:02'),
(10, 3, NULL, 2, 3, '2023-02-09 14:14:38'),
(11, 1, NULL, 2, 3, '2023-02-09 14:14:48'),
(12, 4, NULL, 1, 3, '2023-02-09 14:15:00'),
(13, NULL, 4, 1, 3, '2023-02-09 14:16:47'),
(14, NULL, 4, 1, 3, '2023-02-09 14:29:30'),
(15, 1, NULL, 1, 1, '2023-04-04 18:49:41'),
(16, NULL, 1, 1, 1, '2023-04-04 18:50:00'),
(17, NULL, 1, 2, 1, '2023-04-04 18:50:24'),
(18, NULL, 2, 2, 1, '2023-04-06 17:28:06'),
(19, NULL, 2, 3, 1, '2023-04-06 17:28:19'),
(20, NULL, 12, 25, 1, '2023-05-18 23:10:22'),
(21, 17, NULL, 500, 1, '2023-05-18 23:12:44'),
(22, 16, NULL, 50, 1, '2023-05-18 23:12:49'),
(23, 1, NULL, 1, 1, '2023-05-21 23:19:36'),
(24, NULL, 1, 5000, 1, '0000-00-00 00:00:00'),
(25, NULL, 11, 4, 1, '2023-05-25 15:45:32'),
(26, NULL, 11, 7, 1, '2023-05-25 15:45:54'),
(27, NULL, 5, 81, 1, '2023-05-25 15:46:22'),
(28, 18, NULL, 2, 1, '2023-05-26 06:26:43'),
(29, NULL, 8, 23, 1, '2023-05-26 06:27:36');

-- --------------------------------------------------------

--
-- Table structure for table `technology_supplies`
--

CREATE TABLE `technology_supplies` (
  `ts_id` int(11) NOT NULL,
  `ts_name` varchar(255) NOT NULL,
  `ts_model` varchar(255) NOT NULL,
  `ts_brand` varchar(255) NOT NULL,
  `ts_category` varchar(255) NOT NULL,
  `ts_quantity` int(11) NOT NULL,
  `ts_location` varchar(255) NOT NULL,
  `ts_img` varchar(255) NOT NULL,
  `ts_desc` varchar(255) DEFAULT NULL,
  `status` varchar(100) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_last_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `technology_supplies`
--

INSERT INTO `technology_supplies` (`ts_id`, `ts_name`, `ts_model`, `ts_brand`, `ts_category`, `ts_quantity`, `ts_location`, `ts_img`, `ts_desc`, `status`, `date_added`, `date_last_modified`, `modified_by`) VALUES
(1, 'LaserJet Printer M110we', 'M110we', 'HP', 'Printers', 16, 'Stock Room A', 'IMG_63dfbb338c9349.90771381.png', 'Model Color White', 'enabled', '2022-11-01 00:00:00', '2023-05-25 09:24:52', 1),
(2, 'Inkjet Printer', 'C11CJ60203', 'Epson', 'Printers', 6, 'Stock Room A', 'IMG_63df696386cef2.84183225.png', 'Color White', 'enabled', '2022-10-15 00:00:00', '0000-00-00 00:00:00', 1),
(3, 'EcoTank', 'L15160 A3', 'Epson', 'Printers', 5, 'Stock Room B', 'IMG_63e3c35cda5586.19911267.jpg', 'A3 Wi-Fi Duplex All-in-One Ink Tank Printer', 'disabled', '2022-09-01 00:00:00', '2023-06-22 21:29:05', 1),
(4, 'Office Monitor', '20E1H', 'AOC', 'Monitors', 11, 'Stock Room D', 'IMG_63e3d606d0f6a4.24132029.jpg', 'Colour Black Screen Size: 19.5″ Maximum Resolution 1600×900 Refresh Rate: 60Hz', 'disabled', '2022-08-01 00:00:00', '2023-05-18 23:07:40', 1),
(5, 'Inspiron ', 'Inspiron 14', 'Dell', 'Laptops', 2, 'Stock Room D', 'IMG_63e3d7e0a22842.34882388.avif', 'Platinum Silver, 512 GB, 16 GB, 2 x 8 GB, DDR4, 3200 MHz', 'enabled', '2022-07-01 00:00:00', '2023-02-09 14:07:27', 1),
(6, 'EB-2155W WXGA', 'WXGA 3LCD Projector', 'Epson', 'Projectors', 8, 'Stock Room B', 'IMG_63e4b410799ec8.57663324.jpg', 'White and Colour Light Output at 5,000 lumens\r\nGesture Presenter\r\nMulti-PC Projection', 'enabled', '2022-06-01 00:00:00', '0000-00-00 00:00:00', 1),
(7, 'Yoga 300-11IBR', 'Yoga', 'Lenovo', 'Laptop', 15, 'Stock Room C', 'IMG_63e4b4fd514948.90108267.jfif', 'Color Black', 'enabled', '2022-05-01 00:00:00', '2023-05-18 23:06:50', 1),
(11, 'LS920WU', 'LS920WU', 'ViewSonic', 'Projectors', 3, 'Stock Room D', 'IMG_63e4b5d991da78.95914181.jpg', 'Dual HDMI 2.0b Wide H/V lens shift and 1.6x optical zoom', 'enabled', '2023-02-08 23:29:34', '0000-00-00 00:00:00', 1),
(12, 'test', 'test', 'test', 'test', 1, 'test', 'IMG_646511ebbabc44.38792127.jpg', 'test', 'disabled', '2023-05-18 01:42:03', '2023-05-18 23:08:22', 1),
(13, 'test', 'test', 'test', 'test', 1, 'test', 'IMG_646511f9973529.77694581.jpg', 'test', 'enabled', '2023-05-18 01:42:17', '2023-05-18 23:07:52', 1),
(14, 'test', 'test', 'test', 'test', 0, 'test', 'IMG_646512072d95a2.26961077.jpg', 'test', 'enabled', '2023-05-18 01:42:31', '2023-05-18 01:45:19', 1),
(15, 'test', 'test', 'test', 'test', 0, 'test', 'IMG_64663fb12075d6.19904562.png', 'test1121311', 'enabled', '2023-05-18 23:09:37', '2023-05-18 23:10:03', 1),
(16, 'test low stock', 'tes', 'test', 'test', 60, 'test', 'IMG_6466400472d2d3.95478379.jpg', 'test', 'enabled', '2023-05-18 23:11:00', '2023-05-18 23:12:49', 1),
(17, 'testt new', 'test', 'test', 'test', 501, 'test', 'IMG_6466401f8557d7.62138558.png', 'test', 'enabled', '2023-05-18 23:11:27', '2023-05-18 23:12:44', 1),
(18, 'SDASF', 'SAFSA', 'ASFSV', 'DFDZ', 0, 'FGVZVZ', 'IMG_646f127c155371.93740381.jpg', 'GXGXCX ', 'enabled', '2023-05-25 15:47:08', '2023-05-26 06:26:58', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tor`
--

CREATE TABLE `tor` (
  `id` int(11) NOT NULL,
  `tor_id` varchar(255) NOT NULL,
  `tor_user` int(11) DEFAULT NULL,
  `tor_date` datetime NOT NULL,
  `date_last_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tor`
--

INSERT INTO `tor` (`id`, `tor_id`, `tor_user`, `tor_date`, `date_last_modified`, `modified_by`) VALUES
(1, '1820001-1820100', 1, '2023-06-14 07:46:19', '2023-06-15 14:51:54', 3),
(2, '1820101-1820200', 3, '2023-06-15 07:46:19', '2023-06-15 14:51:54', 6),
(3, '1820201-1820300', NULL, '2023-06-15 07:46:19', '2023-06-15 14:51:54', 1),
(4, '1820301-1820400', NULL, '2023-06-16 07:46:19', '2023-06-15 14:51:54', 1),
(5, '1820401-1820500', NULL, '2023-06-30 06:20:00', '2023-06-15 14:51:54', 1),
(7, '112222', NULL, '2023-07-25 17:06:15', '2023-07-25 17:06:15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_img` varchar(255) NOT NULL,
  `user_category` enum('user','admin') NOT NULL,
  `user_status` varchar(255) NOT NULL,
  `user_date` datetime NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `date_last_modified` datetime NOT NULL,
  `code` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_firstname`, `user_lastname`, `user_password`, `user_email`, `user_img`, `user_category`, `user_status`, `user_date`, `modified_by`, `date_last_modified`, `code`) VALUES
(1, 'SSMS', 'Admin', '$2y$10$LjYc6mSTJkElcDomvaA8XOodmWhj1FeAZ/lAP1pdh2bGsNU22rdRO', 'storagesupplyms@gmail.com', '', 'admin', 'active', '0000-00-00 00:00:00', 3, '2023-02-08 11:21:39', '0'),
(2, 'Daryll', 'Gabitan', '$2y$10$LjYc6mSTJkElcDomvaA8XOodmWhj1FeAZ/lAP1pdh2bGsNU22rdRO', 'Daryllgabitan@gmail.com', 'IMG_63e0c8ab435ce7.66823335.jpg', 'user', 'active', '2023-01-16 00:00:00', 3, '2023-02-08 03:44:03', '0'),
(3, 'Raphael Jake', 'Napay', '$2y$10$LjYc6mSTJkElcDomvaA8XOodmWhj1FeAZ/lAP1pdh2bGsNU22rdRO', 'napay.j.bsinfotech@gmail.com', 'IMG_63e49f60e5cd65.40019239.png', 'user', 'active', '2023-01-22 17:26:08', 3, '2023-02-09 15:23:12', '4838'),
(4, 'Arajane', 'Dimaunahan', '$2y$10$LjYc6mSTJkElcDomvaA8XOodmWhj1FeAZ/lAP1pdh2bGsNU22rdRO', 'dimaunahan.a.bsinfotech@gmail.com', '', 'user', 'inactive', '2023-02-06 18:31:54', 1, '2023-02-09 13:53:37', '0'),
(5, 'Renzo', 'Dogoy', '$2y$10$LjYc6mSTJkElcDomvaA8XOodmWhj1FeAZ/lAP1pdh2bGsNU22rdRO', 'dogoy.r.bsinfotech@gmail.com', 'IMG_63e4221a3518f0.19412966.jpg', 'user', 'inactive', '2023-02-09 02:54:11', 5, '2023-02-09 06:28:42', '3662'),
(6, 'Divine Rayne', 'Gutay', '$2y$10$LjYc6mSTJkElcDomvaA8XOodmWhj1FeAZ/lAP1pdh2bGsNU22rdRO', 'gutay.drc.bsinfotech@gmail.com', '', 'user', 'inactive', '2023-02-09 13:58:30', 1, '2023-02-09 13:59:07', ''),
(7, 'Maki', 'Napay', '$2y$10$ak7Bl/hYO712loLaY5ZuIeAnpHNbztZ4vPHtaV1VxqiQ8lBl98H6G', 'makimakario@gmail.com', '', 'user', 'active', '2023-04-06 17:01:58', 1, '2023-05-26 06:08:52', '5881'),
(8, 'Jakezsds', 'napay', '$2y$10$S5/C1nMojNRVaHLqn3fJH.GaDZscH3nvQhWsMLBEnUHBmNchXbnee', 'jakemantesnapay@gmail.com', '', 'user', 'active', '2023-05-19 05:13:49', NULL, '2023-06-22 21:42:52', '5201');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`history_id`),
  ADD KEY `history_ibfk_1` (`os_id`),
  ADD KEY `history_ibfk_2` (`ts_id`),
  ADD KEY `history_ibfk_3` (`user_id`),
  ADD KEY `history_ibfk_4` (`modified_by`),
  ADD KEY `history_ibfk_5` (`tor_id`);

--
-- Indexes for table `office_supplies`
--
ALTER TABLE `office_supplies`
  ADD PRIMARY KEY (`os_id`),
  ADD KEY `modifiy` (`modified_by`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `reports_ibfk_2` (`os_id`),
  ADD KEY `reports_ibfk_3` (`ts_id`),
  ADD KEY `reports_ibfk_1` (`report_by`);

--
-- Indexes for table `restocks`
--
ALTER TABLE `restocks`
  ADD PRIMARY KEY (`restock_id`),
  ADD KEY `restocks_ibfk_1` (`ts_id`),
  ADD KEY `restocks_ibfk_2` (`os_id`),
  ADD KEY `restocks_ibfk_3` (`user_id`);

--
-- Indexes for table `technology_supplies`
--
ALTER TABLE `technology_supplies`
  ADD PRIMARY KEY (`ts_id`),
  ADD KEY `modified_by` (`modified_by`);

--
-- Indexes for table `tor`
--
ALTER TABLE `tor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tor_user` (`tor_user`),
  ADD KEY `fk_tor_modified_by` (`modified_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_created_by` (`modified_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `office_supplies`
--
ALTER TABLE `office_supplies`
  MODIFY `os_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `restocks`
--
ALTER TABLE `restocks`
  MODIFY `restock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `technology_supplies`
--
ALTER TABLE `technology_supplies`
  MODIFY `ts_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tor`
--
ALTER TABLE `tor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `history_ibfk_1` FOREIGN KEY (`os_id`) REFERENCES `office_supplies` (`os_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `history_ibfk_2` FOREIGN KEY (`ts_id`) REFERENCES `technology_supplies` (`ts_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `history_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `history_ibfk_4` FOREIGN KEY (`modified_by`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `history_ibfk_5` FOREIGN KEY (`tor_id`) REFERENCES `tor` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `office_supplies`
--
ALTER TABLE `office_supplies`
  ADD CONSTRAINT `modifiy` FOREIGN KEY (`modified_by`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`report_by`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `reports_ibfk_2` FOREIGN KEY (`os_id`) REFERENCES `office_supplies` (`os_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `reports_ibfk_3` FOREIGN KEY (`ts_id`) REFERENCES `technology_supplies` (`ts_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `restocks`
--
ALTER TABLE `restocks`
  ADD CONSTRAINT `restocks_ibfk_1` FOREIGN KEY (`ts_id`) REFERENCES `technology_supplies` (`ts_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `restocks_ibfk_2` FOREIGN KEY (`os_id`) REFERENCES `office_supplies` (`os_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `restocks_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `technology_supplies`
--
ALTER TABLE `technology_supplies`
  ADD CONSTRAINT `modified_by` FOREIGN KEY (`modified_by`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `tor`
--
ALTER TABLE `tor`
  ADD CONSTRAINT `fk_tor_modified_by` FOREIGN KEY (`modified_by`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tor_user` FOREIGN KEY (`tor_user`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `user_created_by` FOREIGN KEY (`modified_by`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
