-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql113.epizy.com
-- Generation Time: Jul 25, 2023 at 05:13 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epiz_33456032_ssms`
--

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `history_id` int(11) NOT NULL,
  `os_id` int(11) DEFAULT NULL,
  `ts_id` int(11) DEFAULT NULL,
  `history_quantity` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `history_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`history_id`, `os_id`, `ts_id`, `history_quantity`, `user_id`, `status`, `modified_by`, `history_date`) VALUES
(1, 1, NULL, 2, 1, 'approved', 1, '2023-01-16 00:00:00'),
(36, 1, NULL, 1, 13, 'approved', 1, '2023-04-14 11:38:34'),
(37, 25, NULL, 1, 1, 'approved', 1, '2023-05-15 14:38:06'),
(38, 34, NULL, 1, 1, 'approved', 1, '2023-05-18 02:01:10'),
(39, 101, NULL, 1, 1, 'approved', 1, '2023-05-18 20:26:23'),
(40, 1, NULL, 2, 1, 'approved', 1, '2023-05-18 18:08:17'),
(41, 12, NULL, 1, 21, 'approved', 1, '2023-05-18 21:58:53'),
(42, 1, NULL, 1, 21, 'approved', 1, '2023-05-18 22:20:56'),
(43, 8, NULL, 1, 1, 'approved', 1, '2023-05-21 23:03:49'),
(44, 8, NULL, 1, 1, 'approved', 1, '2023-05-22 05:24:47');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `office_supplies`
--

INSERT INTO `office_supplies` (`os_id`, `os_name`, `os_brand`, `os_uom`, `os_quantity`, `os_location`, `os_img`, `os_desc`, `status`, `date_added`, `date_last_modified`, `modified_by`) VALUES
(1, 'Paper Clip (50mm)', 'Joy', 'Box', 46, 'Storage C', 'IMG_642a7f3f677350.45102473.jpg', 'Vinyl Coated, 100pcs, 50mm', 'enabled', '2022-11-02 00:00:00', '2023-05-19 10:31:31', 1),
(2, 'Paper Clip (33mm)', 'Joy', 'Box', 13, 'Storage C', 'IMG_642a82e4b47590.58349048.jpg', 'Vinyl Coated, 100pcs, 33mm', 'enabled', '2022-10-15 00:00:00', '2023-05-15 12:08:02', 1),
(3, 'Paper Clip (No. 22, 33mm)', 'Prince', 'Box', 208, 'Storage C', 'IMG_642a83aec92a88.44070350.jpg', 'Vinyl Coated, No. 22, 33mm, 50gms', 'enabled', '2022-09-01 00:00:00', '2023-05-15 12:08:21', 1),
(4, 'Paper Clip (50mm)', 'Prince', 'Box', 164, 'Storage C', 'IMG_642a84673c4814.60310102.jpg', 'Vinyl Coated, 50mm, 120gms', 'enabled', '2022-08-01 00:00:00', '2023-05-15 12:08:59', 1),
(5, 'Binder Clip (1 inch)', 'Joy', 'Box', 2, 'Storage C', 'IMG_642a85826824b4.20928073.jpg', 'Black, 1 inch', 'enabled', '2023-02-09 00:53:11', '2023-05-15 12:09:21', 1),
(6, 'Binder Clip (3/4 inch)', 'Joy', 'Box', 10, 'Storage C', 'IMG_642a861c7f3252.54572461.jpg', 'Black, 3/4 inch', 'enabled', '2023-04-03 15:54:04', '2023-05-15 12:09:36', 1),
(7, 'Furniture Polish', 'Splenda', 'Piece', 9, 'Storage C', 'IMG_642a86de146a65.51168581.jpg', 'Repels dust, Lemon, 330ml', 'enabled', '2023-04-03 15:57:18', '2023-05-15 12:09:55', 1),
(8, 'Highlighter', 'Dixon', 'Piece', 20, 'Storage C', 'IMG_6453595db8f4e0.06677909.png', 'Yellow, green, orange, 100m approx.', 'enabled', '2023-05-04 15:06:05', '2023-05-22 17:40:32', 1),
(9, 'Permanent Marker', 'Deli', 'Box', 4, 'Storage C', 'IMG_645359a8408811.34759057.png', 'Black, 1.5mm bullet', 'enabled', '2023-05-04 15:07:20', '2023-05-15 12:11:31', 1),
(10, 'Binder Clips (1 1/4 inch)', 'Joy', 'Box', 8, 'Storage C', 'IMG_64535a19208d81.28365405.png', '12pcs per box, Black, 1 1/4 inch', 'enabled', '2023-05-04 15:09:13', '2023-05-15 12:11:45', 1),
(11, 'Permanent Marker', 'Deli', 'Box', 3, 'Storage C', 'IMG_64535ac6a9b7f0.50341379.png', 'Blue, 1.5 bullet', 'disabled', '2023-05-04 15:12:06', '2023-05-15 12:11:59', 1),
(12, 'Printer Ink (Black, 790BK)', 'Canon', 'Piece', 16, 'Storage C', 'IMG_64588974830883.85285110.png', 'Black, 790 BK', 'enabled', '2023-05-08 13:32:36', '2023-05-19 09:58:54', 21),
(13, 'Rubber Band', 'Pointer', 'Box', 24, 'Storage C', 'IMG_645889e3ba2097.94124664.png', 'No. 18, Multi-purpose', 'enabled', '2023-05-08 13:34:27', '2023-05-15 14:40:24', 1),
(14, 'Rubber Band', 'M.O', 'Box', 14, 'Storage C', 'IMG_64588a63aa2418.97210163.png', 'No. 18, 350 gms, Economical', 'enabled', '2023-05-08 13:36:35', '2023-05-15 14:40:45', 1),
(15, 'Alkaline Batteries', 'Kodak', 'Pack', 21, 'Storage C', 'IMG_64588ab1925275.84894952.png', 'Pile alkaline, 1.5V, KD2', 'enabled', '2023-05-08 13:37:53', '2023-05-15 14:41:14', 1),
(16, 'Staples (26/6)', 'Printo', 'Box', 17, 'Storage C', 'IMG_64588b7a4185a3.89833843.png', 'Chisel Point, 26/6, 5000 wires', 'enabled', '2023-05-08 13:41:14', '2023-05-15 14:41:46', 1),
(17, 'Staples (Standard)', 'Ace', 'Box', 5, 'Storage C', 'IMG_64588bb9f169f3.80637989.png', 'Chisel Point, standard, 5000 Staples', 'enabled', '2023-05-08 13:42:17', '2023-05-15 14:42:00', 1),
(18, 'Correction Tape (8m, k-508, Pet tape)', 'Champion', 'Piece', 17, 'Storage C', 'IMG_64588c64be3f03.17823233.png', '8m, k-508, Pet tape', 'enabled', '2023-05-08 13:45:08', '2023-05-15 14:42:16', 1),
(19, 'Printer Ink (Cyan, 790m)', 'Cannon', 'Piece', 17, 'Storage C', 'IMG_64588cc0014295.13761826.png', 'Cyan, 790C', 'enabled', '2023-05-08 13:46:40', '2023-05-15 14:42:36', 1),
(20, 'Printer Ink (Magenta, 790M)', 'Cannon', 'Piece', 17, 'Storage C', 'IMG_64588e8b2f2c67.54752507.png', 'Magenta, 790M', 'enabled', '2023-05-08 13:54:19', '2023-05-15 14:42:52', 1),
(21, 'Permanent Marker (Red)', 'Baoke', 'Box', 3, 'Storage C', 'IMG_64589544713f47.48645817.png', 'Red, MP2903A', 'enabled', '2023-05-08 14:23:00', '2023-05-15 14:43:25', 1),
(22, 'Permanent Marker (Blue)', 'Baoke', 'Box', 1, 'Storage C', 'IMG_6458958c192449.83494688.png', 'Blue, MP2903A', 'enabled', '2023-05-08 14:24:12', '2023-05-15 14:43:08', 1),
(23, 'White Board Marker (Black)', 'Monami', 'Box', 4, 'Storage C', 'IMG_64589607ae4d07.12557671.png', 'Liquid blue, A25A', 'enabled', '2023-05-08 14:25:31', '2023-05-15 14:44:15', 1),
(24, 'Printer Ink (Yellow)', 'Cannon', 'Piece', 15, 'Storage C', 'IMG_64589d4d708e01.58283682.png', 'Yellow, 790Y', 'enabled', '2023-05-08 14:57:17', '2023-05-15 14:44:37', 1),
(25, 'Highlighter (Yellow, Orange, Green)', 'Monami', 'Pack', 17, 'Storage C', 'IMG_64589db556ce21.00508281.png', 'Yellow, Orange, Green, 60m', 'enabled', '2023-05-08 14:59:01', '2023-05-15 14:45:03', 1),
(26, 'Gel Ink Pen (Black)', 'Dixon', 'Box', 7, 'Storage C', 'IMG_64589e683bc3a9.89163497.png', 'GA-172804, Black', 'enabled', '2023-05-08 15:02:00', '2023-05-15 14:45:45', 1),
(27, 'Gel Ink Pen (Red)', 'Dixon', 'Box', 5, 'Storage C', 'IMG_64589eb058ab87.36815779.png', 'GA-172804, Red', 'enabled', '2023-05-08 15:03:12', '2023-05-15 14:46:19', 1),
(28, 'Gel Ink Pen (Blue)', 'Dixon', 'Box', 7, 'Storage C', 'IMG_64589ef54fe517.07332661.png', 'GA-172804, Blue', 'enabled', '2023-05-08 15:04:21', '2023-05-15 14:46:39', 1),
(29, 'Permanent Marker (Blue)', 'Deli', 'Box', 2, 'Storage C', 'IMG_64589f69d796a6.30261757.png', '1.5mm bullet, Blue, waterproof', 'enabled', '2023-05-08 15:06:17', '2023-05-15 14:47:26', 1),
(30, 'White Glue', 'Kippy', 'Piece', 14, 'Storage C', 'IMG_6458a4e0017d19.39273236.png', 'Multi-purpose, dry clear', 'enabled', '2023-05-08 15:29:36', '2023-05-15 14:47:42', 1),
(31, 'Laser Jet Print Cartridge (35A)', 'HP', 'Box', 34, 'Storage B', 'IMG_645d8ca7e3d905.30428152.png', 'CB435A, HP, Laser Jet, Black', 'enabled', '2023-05-12 08:47:35', '2023-05-18 09:27:52', 1),
(33, 'Toner Cartridge (hp)', 'HP', 'Box', 11, 'Storage B', 'IMG_645d8d8378d551.58323053.png', 'W1107A, MFP 135/137, Black', 'enabled', '2023-05-12 08:51:15', '2023-05-12 08:55:07', 1),
(34, 'Toner Cartridge (SC)', 'Static Control', 'Box', 12, 'Storage B', 'IMG_645d8e4db938c7.56142903.png', 'TCC-85A, 1102, M1132, 1212NF', 'enabled', '2023-05-12 08:54:37', '2023-05-18 02:01:10', 1),
(35, 'Toner Cartridge (SC)', 'Static Control', 'Box', 10, 'Storage B', 'IMG_645d8f53debed6.99709213.png', 'TCC-05A, P2035N, P2055', 'enabled', '2023-05-12 08:58:59', '2023-05-12 08:58:59', 1),
(36, 'DeskJet Toner (hp)', 'HP', 'Box', 4, 'Storage B', 'IMG_645d8fb74fbe97.76666205.png', 'No.22, Tricolor', 'enabled', '2023-05-12 09:00:39', '2023-05-12 09:00:39', 1),
(37, 'Laser Jet Print Cartridge (79A)', 'HP', 'Box', 6, 'Storage B', 'IMG_645d9053d36f82.50562324.png', 'CF279A, M12, MFP, M26, Black', 'enabled', '2023-05-12 09:03:15', '2023-05-18 09:28:15', 1),
(38, 'DeskJet Toner (hp)', 'HP', 'Box', 4, 'Storage B', 'IMG_645d9174ca6255.30781257.png', 'No.21, Black', 'enabled', '2023-05-12 09:08:04', '2023-05-12 09:08:04', 1),
(39, 'LaserJet Print Cartridge (CE505AC)', 'HP', 'Box', 16, 'Storage B', 'IMG_645d923fb96925.12699865.png', 'CE505AC, P2035, P2055, Black', 'enabled', '2023-05-12 09:11:27', '2023-05-18 09:29:03', 1),
(40, 'LaserJet Toner Cartridge (hp)', 'HP', 'Box', 2, 'Storage B', 'IMG_645d96a191a6b8.22209780.png', 'CE505A, P2035, Black', 'enabled', '2023-05-12 09:30:09', '2023-05-12 09:30:09', 1),
(41, 'Laser Jet Print Cartridge (hp)', 'HP', 'Box', 38, 'Storage B', 'IMG_645d977dbd3922.69953670.png', 'CE505A, P2035, P2055, Black', 'enabled', '2023-05-12 09:33:49', '2023-05-12 09:33:49', 1),
(42, 'Straw Rope', 'Omega', 'Piece', 4, 'Storage C', 'IMG_645d9900d171e4.47957913.png', 'Plastic Twine, Best Quality', 'enabled', '2023-05-12 09:40:16', '2023-05-15 14:48:44', 1),
(43, 'Mop Head', 'Penguin', 'Piece', 3, 'Storage C', 'IMG_645d99a7d50b64.30043073.png', 'Heavy Duty, Twisted Rayon', 'enabled', '2023-05-12 09:43:03', '2023-05-15 14:49:03', 1),
(44, 'Safety Fastener', 'Apple', 'Box', 3, 'Storage C', 'IMG_645d9ae76b36d1.26520296.png', 'Non Sharp Stainless, 2 inch thick, Hole to hole: 7cm', 'enabled', '2023-05-12 09:48:23', '2023-05-15 14:54:24', 1),
(45, 'Safety Prong Fastener', 'Pointer', 'Box', 20, 'Storage C', 'IMG_645d9b5ebd53d6.92079048.png', 'Rust free, Non sharp, Stainnless', 'enabled', '2023-05-12 09:50:22', '2023-05-22 17:35:28', 1),
(46, 'Quality Stamp Pad', 'Joy', 'Box', 12, 'Storage C', 'IMG_645d9be8200551.52565017.png', 'Clear Stamp, No.2', 'enabled', '2023-05-12 09:52:40', '2023-05-15 14:54:53', 1),
(47, 'Cel-U-Tab', 'Tiger', 'Box', 5, 'Storage C', 'IMG_645d9ca7299c10.03093498.png', 'Index tabs, 5ft, Orange, Blue, Clear', 'enabled', '2023-05-12 09:55:51', '2023-05-15 14:55:19', 1),
(48, 'Staples', 'Joy', 'Box', 25, 'Storage C', 'IMG_645d9de929f447.90333788.png', 'No.35, 26/6, Fits in all standard staplers', 'enabled', '2023-05-12 10:01:13', '2023-05-15 14:55:59', 1),
(49, 'Staples', 'Ace', 'Box', 5, 'Storage C', 'IMG_645d9ec7f259e7.98924033.png', 'Standard, 76001, 5000 staples', 'enabled', '2023-05-12 10:04:55', '2023-05-15 14:55:39', 1),
(50, 'Ruler', 'Printo', 'Piece', 1, 'Storage C', 'IMG_645da027db2240.13405648.png', '18 inch, 45cm', 'enabled', '2023-05-12 10:10:47', '2023-05-15 15:02:39', 1),
(51, 'Cleanser', 'Zim', 'Piece', 1, 'Storage C', 'IMG_645da265d75279.30481826.png', 'Active Germicides Baking Soda', 'enabled', '2023-05-12 10:20:21', '2023-05-15 15:02:54', 1),
(52, 'Staple', 'Etona', 'Pcs', 5, 'Storage C', 'IMG_64619b5b770e05.77759828.png', '23/13(Â½\")', 'enabled', '2023-05-15 10:39:23', '2023-05-15 15:03:28', 1),
(53, 'Permanent Marker (Black)', 'Dixon', 'Box', 1, 'Storage C', 'IMG_64619b691bb9f8.13777856.png', 'Ink Refillable, Fast Drying ', 'enabled', '2023-05-15 10:39:37', '2023-05-15 15:03:43', 1),
(54, 'Notarial Seal', 'Aclem Paper Mills', 'Box', 20, 'Storage C', 'IMG_64619c31100130.80278935.png', 'No. 23 Gold\r\n20 Boxes of 40 pcs', 'enabled', '2023-05-15 10:42:57', '2023-05-15 15:04:03', 1),
(55, 'White Board Marker', 'Monami', 'Box', 1, 'Storage C', 'IMG_64619ca267bd44.79888675.png', 'Blue, Liquid', 'enabled', '2023-05-15 10:44:50', '2023-05-15 15:04:35', 1),
(56, 'Copy 80 Multi-Colour (Yellow)', 'Nappco', 'Ream', 1150, 'Storage C', 'IMG_64619cb2378f57.76717216.png', '8.5 x 13 inch, Yellow', 'enabled', '2023-05-15 10:45:06', '2023-05-15 15:05:03', 1),
(57, 'Multipurpose Paper (A4 Size)', 'Emerson', 'Ream', 25, 'Storage A', 'IMG_64619d941400a4.57534880.png', 'A4, 210mm x 297mm,\r\nWHITE / 70gsm', 'enabled', '2023-05-15 10:48:52', '2023-05-26 09:25:42', 1),
(58, 'Laminating', 'JHC', 'Box', 13, 'Storage C', 'IMG_64619dfd01e382.36221485.png', 'Transparent white 3A-32 100 sheets, size 125 mic x 70m/m x 100m/m', 'enabled', '2023-05-15 10:50:37', '2023-05-15 10:50:37', 1),
(59, 'Documentary Envelope', 'Centurian', 'Pcs', 500, 'Storage A', 'IMG_64619e14dd6320.33127852.png', '254mm x 381mm, \r\nKraft, 150 gsm', 'enabled', '2023-05-15 10:51:00', '2023-05-15 10:51:00', 1),
(60, 'Copy 80 Multi-Colour (Blue)', 'Nappco', 'Ream', 110, 'Storage A', 'IMG_64619e38a55ca5.00696890.png', '8.5 x 13 inch, Blue', 'enabled', '2023-05-15 10:51:36', '2023-05-15 10:51:36', 1),
(61, 'Laminating Film', 'N/A', 'Pack', 27, 'Storage C', 'IMG_64619e4ce37c57.13192336.png', 'Transparent white', 'enabled', '2023-05-15 10:51:56', '2023-05-15 10:51:56', 1),
(63, 'Copy 80 Multi-Colour (Pink)', 'Nappco', 'Ream', 140, 'Storage A', 'IMG_64619f58a2a232.94440954.png', '8.5 x 13 inch, Pink', 'enabled', '2023-05-15 10:56:24', '2023-05-15 10:56:24', 1),
(64, 'Copy 80 Multi-Colour (Green)', 'Nappco ', 'Ream', 80, 'Storage A', 'IMG_64619f99f056b3.46423315.png', '8.5 x 13 inch, Green', 'enabled', '2023-05-15 10:57:29', '2023-05-15 10:57:29', 1),
(65, 'Notarial Seal with Adhesive', 'Stick-Rite', 'Pack', 523, 'Storage A', 'IMG_646584979455b8.65266298.png', 'H23-2*(40 pcs / pk)', 'enabled', '2023-05-15 10:58:11', '2023-05-18 09:51:26', 1),
(67, 'Multipurpose Paper', 'iCopy', 'Ream', 45, 'Storage A', 'IMG_6461a08bbcad48.15492050.png', 'A4, 210 mm x 297 mm', 'enabled', '2023-05-15 11:01:31', '2023-05-26 09:04:54', 1),
(68, 'Laser Toner Cartridge', 'Premium Compatible', 'Box', 20, 'Storage B', 'IMG_6461d8dc17f9f6.07217847.png', 'Premium Compatible, MFP 130, MFP 135', 'enabled', '2023-05-15 15:01:48', '2023-05-15 15:01:48', 1),
(69, 'Multi-Copy Paper', 'Copy One', 'Ream', 100, 'Storage A', 'IMG_6461f12e428f74.95185996.png', 'A4, 210mm x 297mm, white, 80gsm', 'enabled', '2023-05-15 16:45:34', '2023-05-15 16:45:34', 1),
(70, 'Cellulose Tabs', 'Speed O', 'Box', 1, 'Storage C', 'IMG_64657126360364.86670621.png', '5 feet, Green', 'enabled', '2023-05-18 08:28:22', '2023-05-18 16:30:45', 1),
(71, 'Index Tabs (Clear)', 'Speed O', 'Box', 6, 'Storage C', 'IMG_646571bae4f817.35934903.png', '5ft,clear', 'enabled', '2023-05-18 08:30:50', '2023-05-18 10:17:09', 1),
(72, 'File Tab Divider', 'Pointer', 'Pack', 4, 'Storage A', 'IMG_646572edd1c8b5.60620065.png', 'Legal size', 'enabled', '2023-05-18 08:35:57', '2023-05-18 08:35:57', 1),
(73, 'Document Envelopes (Short)', 'Genius', 'Piece', 4500, 'Storage A', 'IMG_646574395998e6.52768173.png', 'Short, 9 x 12 3/4, 500pcs/box', 'enabled', '2023-05-18 08:41:29', '2023-05-18 08:41:29', 1),
(74, 'Expanding Envelope', 'NAPPCO', 'Piece', 300, 'Storage A', 'IMG_646574d46275c5.24413957.png', '2inch expansion, Legal size, 100pcs/box', 'enabled', '2023-05-18 08:44:04', '2023-05-18 08:44:50', 1),
(75, 'Office Pro Multi Purpose', 'LAMCO Paper', 'Ream', 20, 'Storage A', 'IMG_6465760250c737.53248906.png', 'A4,Size 210mm x 297mm, 70gsm', 'enabled', '2023-05-18 08:49:06', '2023-05-18 08:49:06', 1),
(77, 'Documentary Envelope', 'Paper Fox', 'Piece', 500, 'Storage A', 'IMG_64657b66193909.45931569.png', 'A4, 229mm, x 324mm, Goldenkraft, 150gsm ', 'enabled', '2023-05-18 09:12:06', '2023-05-18 09:12:06', 1),
(78, 'Copy Paper (A4)', 'Advance', 'Ream', 40, 'Storage A', 'IMG_64657c108fa0e4.69717480.png', 'A4, 8 1/4 x 11 3/4', 'enabled', '2023-05-18 09:14:56', '2023-05-18 09:14:56', 1),
(80, 'Bond Paper (A4)', 'Perfect Print', 'Ream', 115, 'Storage A', 'IMG_646582b24d4354.31893169.png', '70gsm, 210 x 297mm, A4', 'enabled', '2023-05-18 09:43:14', '2023-05-18 09:43:14', 1),
(81, 'Document Envelopes (Short)', 'OfficeMAX', 'Piece', 500, 'Storage A', 'IMG_64658426275fb8.06262893.png', '9 X 12, Short', 'enabled', '2023-05-18 09:49:26', '2023-05-18 09:49:26', 1),
(82, 'Transparent Folder', 'Green Life', 'Ream', 30, 'Storage A', 'IMG_64658745e7cf99.90699406.png', 'Short, transparent', 'enabled', '2023-05-18 10:02:45', '2023-05-18 10:02:45', 1),
(83, 'Index Tabs (Blue)', 'Speed O', 'Box', 2, 'Storage C', 'IMG_64658af1bbd0c4.68269427.png', '5feet, blue', 'enabled', '2023-05-18 10:18:25', '2023-05-18 10:18:25', 1),
(84, 'Index Tabs (Red)', 'Speed O', 'Box', 1, 'Storage C', 'IMG_64658b53290fa8.60805279.png', '5feet, Red', 'enabled', '2023-05-18 10:20:03', '2023-05-18 10:20:03', 1),
(85, 'Folder (Transparent)', 'Bindermax', 'Ream', 7, 'Storage A', 'IMG_64658ccdb8ea87.84343318.png', 'Transparent', 'enabled', '2023-05-18 10:26:21', '2023-05-18 10:26:21', 1),
(86, 'Staple No. 0013', 'Joy', 'Box', 4, 'Storage C', 'IMG_64658e2e29cdc1.87923469.png', 'Size 23/13, 10boxes', 'enabled', '2023-05-18 10:32:14', '2023-05-18 10:32:14', 1),
(87, 'Protective Paper (Green)', 'Unicover Flex', 'Piece', 6, 'Storage A', 'IMG_64659219eb0b64.03680620.png', 'Dark Green', 'enabled', '2023-05-18 10:48:57', '2023-05-18 10:48:57', 1),
(88, 'Protective Paper (Dark Blue)', 'Unicover Flex', 'Piece', 18, 'Storage A', 'IMG_6465928beb0541.35722485.png', 'Dark Blue', 'enabled', '2023-05-18 10:50:51', '2023-05-18 10:50:51', 1),
(89, 'Clearbook (Red)', 'King', 'Piece', 10, 'Storage A', 'IMG_646593ba12c559.09265719.png', 'Long, Red', 'enabled', '2023-05-18 10:55:54', '2023-05-18 10:55:54', 1),
(90, 'Clearbook (Blue)', 'King', 'Piece', 10, 'Storage A', 'IMG_646593f84ee522.04407101.png', 'Blue, Long', 'enabled', '2023-05-18 10:56:56', '2023-05-18 10:56:56', 1),
(91, 'Clearbook (Yellow)', 'King', 'Piece', 2, 'Storage A', 'IMG_6465944cab3b74.93147157.png', 'Short, Yellow', 'enabled', '2023-05-18 10:58:20', '2023-05-18 10:58:20', 1),
(92, 'Clearbook (Black)', 'King', 'Piece', 1, 'Storage A', 'IMG_646594769a0ef3.15617464.png', 'Long, Black', 'enabled', '2023-05-18 10:59:02', '2023-05-18 10:59:02', 1),
(93, 'Clearbook (Black)', 'King', 'Piece', 1, 'Storage A', 'IMG_646594c4d714d3.46853589.png', 'Short, Black', 'enabled', '2023-05-18 11:00:20', '2023-05-18 11:00:20', 1),
(94, 'Sticker Paper (Yellow)', 'Lumina', 'Ream', 6, 'Storage A', 'IMG_646595e606f709.56375963.png', 'Yellow,10sets', 'enabled', '2023-05-18 11:05:10', '2023-05-18 11:05:10', 1),
(95, 'Sticker Paper (Orange)', 'Lumina', 'Ream', 2, 'Storage A', 'IMG_646596451065b6.49211598.png', '10sets, Orange', 'enabled', '2023-05-18 11:06:45', '2023-05-18 11:06:45', 1),
(96, 'Sticker Paper (Green)', 'Lumina', 'Piece', 9, 'Storage A', 'IMG_64659678244923.02778384.png', 'Green, 10 sets', 'enabled', '2023-05-18 11:07:36', '2023-05-18 11:07:36', 1),
(97, 'Expanded Envelope (Green)', 'King', 'Piece', 1, 'Storage A', 'IMG_6465970fba6580.68847530.png', 'Legal Size,Green', 'enabled', '2023-05-18 11:10:07', '2023-05-18 14:20:47', 1),
(98, 'Expanded Folder (White)', 'N/A', 'Piece', 23, 'Storage A', 'IMG_6465c2b7e6ee07.58909461.png', 'Long, White', 'enabled', '2023-05-18 14:16:23', '2023-05-18 14:18:50', 1),
(99, 'Expanded Folder (Green)', 'N/A', 'Piece', 67, 'Storage A', 'IMG_6465c3313335e2.17777931.png', 'Long,Green', 'enabled', '2023-05-18 14:18:25', '2023-05-18 14:18:25', 1),
(100, 'Expanded Organizer (Green)', 'King', 'Piece', 1, 'Storage A', 'IMG_6465c42d12cca5.49647454.png', 'Green, Long', 'enabled', '2023-05-18 14:22:37', '2023-05-18 14:22:37', 1),
(101, 'Certificate Holder', 'N/A', 'Piece', 1, 'Storage A', 'IMG_6465c692f26c82.94246839.png', 'Green, 240mm x 320mm (9.50inchx 12.50inch)', 'enabled', '2023-05-18 14:32:50', '2023-05-18 11:32:48', 1),
(102, 'Color Ribbon', 'DataCard', 'Box', 68, 'Storage D', 'IMG_646ea87059d0e2.03820414.png', 'Reliable and High Quality card, Print four color, Print ribbon - Blck', 'enabled', '2023-05-25 08:14:40', '2023-05-25 08:14:40', 1),
(103, 'Printer Ribbon (Retransfer)', 'DataCard', 'Box', 145, 'Storage D', 'IMG_646ea9149bb8f8.40143469.png', 'Optimized for used with datacard, RP and SR series Retransfer, Retransfer film', 'enabled', '2023-05-25 08:17:24', '2023-05-25 08:17:24', 1),
(104, 'Blank Cards', 'AVLS', 'Box', 97, 'Storage D', 'IMG_646eaa3686ad40.81125154.png', '2209 - 0670, 250pcs. per box', 'enabled', '2023-05-25 08:22:14', '2023-05-25 08:22:14', 1),
(105, 'Groundwood Mimeo', 'Advance', 'Ream', 95, 'Storage A', 'IMG_646eacd7703093.95579661.png', '18 sub, 480 sheets', 'enabled', '2023-05-25 08:33:27', '2023-05-25 12:17:09', 1),
(106, 'White Wove Mimeo', 'Polar', 'Ream', 5, 'Storage A', 'IMG_646eae5f60c711.84443812.png', 'Substance 70gsmx 480sheets, 216mm x 330mm', 'enabled', '2023-05-25 08:39:59', '2023-05-25 08:39:59', 1),
(107, 'Ground Mimeo (Box)', 'NAPPCO', 'Box', 1, 'Storage A', 'IMG_646eafa11dcb49.00631948.png', '5reams/BOL, 8 1/2X 13, 60gsm sheets', 'enabled', '2023-05-25 08:45:21', '2023-05-25 09:07:32', 1),
(108, 'White Envelope', 'Classic', 'Box', 2, 'Storage A', 'IMG_646eb051386882.55398004.png', '500pcs, XX, Standard', 'enabled', '2023-05-25 08:48:17', '2023-05-25 08:48:17', 1),
(109, 'White Envelope (Nappco, Box)', 'NAPPCO', 'Box', 3, 'Storage A', 'IMG_646eb18ad50983.77755166.png', 'Bond quality, 500pcs', 'enabled', '2023-05-25 08:53:30', '2023-05-25 09:28:04', 1),
(110, 'Colored Paper', 'Avia', 'Ream', 24, 'Storage A', 'IMG_646eb306029500.79131995.png', 'Premium Colored Paper, 250sheets/legal, 80gsm, 8 1/2 inch x 13 inch', 'enabled', '2023-05-25 08:59:50', '2023-05-25 08:59:50', 1),
(112, 'File Folder (OJI)', 'OJI', 'Ream', 7, 'Storage A', 'IMG_646eb5c7b3c496.07727223.png', '14pts (100pcs),365mm, legal', 'enabled', '2023-05-25 09:11:35', '2023-05-26 10:48:47', 1),
(113, 'Mailing Long Window Envelope', 'Paper Fox', 'Box', 2, 'Storage A', 'IMG_646eb8d6d73ad8.21155393.png', '105mm x 241mm, bond, 70gsm, 500pcs per box', 'enabled', '2023-05-25 09:24:38', '2023-05-25 09:24:38', 1),
(114, 'File Folder (System)', 'System', 'Ream', 2, 'Storage A', 'IMG_646ebb6a631448.35794487.png', '14PTS (100pcs)', 'enabled', '2023-05-25 09:35:38', '2023-05-25 09:35:38', 1),
(115, 'File Folder (Emerson)', 'Emerson', 'Ream', 3, 'Storage A', 'IMG_646ebbadd851f0.45742446.png', '14pts, A4 size, (100pcs)', 'enabled', '2023-05-25 09:36:45', '2023-05-26 10:55:27', 1),
(116, 'Permafilm', 'Pegasus', 'Ream', 1, 'Storage A', 'IMG_646ebd6fb5c1c8.10476400.png', '100 sheets', 'enabled', '2023-05-25 09:44:15', '2023-05-25 09:44:15', 1),
(117, 'Stencil Paper', 'Prince', 'Ream', 1, 'Storage A', 'IMG_646ec3d4692937.81198135.png', '8 1/4 inch x 1 1/4 inch, black, 100sheets', 'enabled', '2023-05-25 10:11:32', '2023-05-25 10:11:32', 1),
(118, 'Sliding Folder (Violet)', 'Advance', 'Ream', 4, 'Storage A', 'IMG_646ec43a8758c9.78952815.png', 'Violet, 50pcs.', 'enabled', '2023-05-25 10:13:14', '2023-05-25 10:13:14', 1),
(119, 'Sliding Folder (Orange)', 'Advance', 'Ream', 1, 'Storage A', 'IMG_646ec5d329f788.99554637.png', 'Orange, 50pcs.', 'enabled', '2023-05-25 10:20:03', '2023-05-25 10:20:03', 1),
(120, 'Stencil', 'Gestetner', 'Ream', 3, 'Storage A', 'IMG_646ec70643e657.34954323.png', 'DO62RL50', 'enabled', '2023-05-25 10:25:10', '2023-05-25 10:25:10', 1),
(121, 'Film Carbon', 'CLUB', 'Ream', 1, 'Storage A', 'IMG_646ec7c1de2777.28974057.png', '210 x 298gsm', 'enabled', '2023-05-25 10:28:17', '2023-05-25 10:28:17', 1),
(122, 'Multi Copy OfficePro', 'LAMCO Paper', 'Ream', 5, 'Storage A', 'IMG_6470039d5c61c5.26675186.png', 'Legal size, 216mm x 330mm, 80gsm', 'enabled', '2023-05-26 08:55:57', '2023-05-26 08:55:57', 1),
(123, 'Multi Purpose Copy Paper', 'Advance', 'Ream', 75, 'Storage A', 'IMG_6470047ba30032.44071177.png', 'Legal, 8 1/2, x 13, 70gsm', 'enabled', '2023-05-26 08:59:39', '2023-05-26 08:59:39', 1),
(124, 'Copy Paper (MPCPC)', 'MPCPC', 'Ream', 10, 'Storage A', 'IMG_6470050e2941c6.52490161.png', 'A4, 70gsm, 210mm x 297mm', 'enabled', '2023-05-26 09:02:06', '2023-05-26 11:00:07', 1),
(125, 'Multi Copy Paper (Cactus)', 'Cactus', 'Ream', 5, 'Storage A', 'IMG_6470074e84d9c7.27905911.png', 'A4, 210mm x 297mm, 80gsm', 'enabled', '2023-05-26 09:11:42', '2023-05-26 09:11:42', 1),
(126, 'Multi Copy Paper (Cactus)', 'Cactus', 'Ream', 10, 'Storage A', 'IMG_647007d895d990.49459809.png', 'Legal size, 216mm x 330mm, 80gsm', 'enabled', '2023-05-26 09:14:00', '2023-05-26 09:14:00', 1),
(127, 'Multi-Copy Paper 24', 'Copy One', 'Ream', 20, 'Storage A', 'IMG_647008d12d9580.44906423.png', '216mm x 330mm, White, 80gsm', 'enabled', '2023-05-26 09:18:09', '2023-05-26 09:18:09', 1),
(128, 'Copy Paper (Legal size)', 'Emerson', 'Ream', 5, 'Storage A', 'IMG_6470098c244177.90750981.png', 'Legal size, 70gsm, 216mm x 330mm', 'enabled', '2023-05-26 09:21:16', '2023-05-26 09:21:16', 1),
(129, 'Multi Purpose Paper (Legal)', 'Emerson', 'Ream', 10, 'Storage A', 'IMG_64700a04e83216.90577828.png', 'Legal size, 70gsm, 216mm x 330mm', 'enabled', '2023-05-26 09:23:16', '2023-05-26 09:23:16', 1),
(130, 'Total Multi-Purpose Copy ', 'NAPPCO', 'Ream', 40, 'Storage A', 'IMG_64700c1f71c8e7.78779007.png', 'A4, 210mm x 297mm, White, 500 sheets', 'enabled', '2023-05-26 09:32:15', '2023-05-26 09:32:15', 1),
(131, 'Multi Purpose Paper (Eagle20)', 'Eagle20', 'Ream', 100, 'Storage A', 'IMG_64701003996b43.04379268.png', '216mm x 330mm, White, 80gsm', 'enabled', '2023-05-26 09:48:51', '2023-05-26 09:48:51', 1),
(132, 'Multi Purpose Paper (Cactus)', 'Cactus', 'Ream', 5, 'Storage A', 'IMG_647016a3b26896.90522009.png', 'Legal size, 70gsm, 216mm x 330mm', 'enabled', '2023-05-26 10:17:07', '2023-05-26 10:17:07', 1),
(133, 'Plastofoil', 'Pegasus', 'Ream', 12, 'Storage A', 'IMG_64701911c9a265.63205637.png', 'Black 100s, Lightweight, 216mm x 330mm', 'enabled', '2023-05-26 10:27:29', '2023-05-26 10:27:29', 1),
(135, 'Record Book', 'N/A', 'Piece', 54, 'Storage A', 'IMG_647019ff10c1d2.45499961.png', '500pages', 'enabled', '2023-05-26 10:31:27', '2023-05-26 10:31:27', 1),
(136, 'Record Book (VECO)', 'VECO', 'Piece', 4, 'Storage A', 'IMG_64701a3a79cd83.72288064.png', '304pages', 'enabled', '2023-05-26 10:32:26', '2023-05-26 10:32:26', 1),
(137, 'Record Book (M.O.)', 'M.O.', 'Piece', 8, 'Storage A', 'IMG_64701a6d0f9b93.61529352.png', '300pages', 'enabled', '2023-05-26 10:33:17', '2023-05-26 10:33:17', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`report_id`, `os_id`, `ts_id`, `report_description`, `report_by`, `report_date`) VALUES
(4, 1, NULL, 'damaged papers', 1, '2023-02-07 05:52:29'),
(5, 1, NULL, 'crumpled sheets', 1, '2023-02-09 05:52:29'),
(13, NULL, 4, 'The stand has a crack', 1, '2023-02-09 13:20:02'),
(14, 3, NULL, 'Some pens inside the pack are not working', 1, '2023-02-09 13:20:19'),
(15, NULL, 3, 'Something wrong with wiring', 1, '2023-02-09 13:51:24');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `restocks`
--

INSERT INTO `restocks` (`restock_id`, `ts_id`, `os_id`, `restock_quantity`, `user_id`, `restock_date`) VALUES
(1, 1, NULL, 10, 1, '2023-01-16 00:00:00'),
(2, NULL, 1, 500, 1, '2023-01-16 00:00:00'),
(3, NULL, 2, 100, 1, '2023-01-17 00:00:00'),
(4, 3, NULL, 2, 1, '2023-02-06 10:14:25'),
(5, 3, NULL, 3, 1, '2023-02-06 18:26:10'),
(6, 5, NULL, 1, 1, '2023-02-09 14:06:59'),
(7, 5, NULL, 2, 1, '2023-02-09 14:07:27'),
(8, 5, NULL, 2, 1, '2023-02-09 14:09:54'),
(9, 5, NULL, 2, 1, '2023-02-09 14:10:02'),
(10, 3, NULL, 2, 1, '2023-02-09 14:14:38'),
(11, 1, NULL, 2, 1, '2023-02-09 14:14:48'),
(12, 4, NULL, 1, 1, '2023-02-09 14:15:00'),
(13, NULL, 4, 1, 1, '2023-02-09 14:16:47'),
(14, NULL, 4, 1, 1, '2023-02-09 14:29:30'),
(15, NULL, 1, 15, 1, '2023-02-13 13:43:35'),
(16, NULL, 4, 15, 1, '2023-02-13 13:44:46'),
(17, NULL, 2, 5, 1, '2023-02-13 13:45:25'),
(18, 1, NULL, 2, 1, '2023-02-16 14:08:13'),
(19, NULL, 5, 2, 1, '2023-02-16 14:08:51'),
(20, 1, NULL, 1, 1, '2023-02-16 14:26:52'),
(21, 1, NULL, 2, 1, '2023-03-31 07:17:20'),
(22, 1, NULL, 2, 1, '2023-03-31 07:17:43'),
(23, 2, NULL, 5, 1, '2023-03-31 07:24:18'),
(24, 2, NULL, 6, 1, '2023-03-31 07:25:15'),
(25, 4, NULL, 1, 1, '2023-03-31 07:37:19'),
(26, 6, NULL, 2, 1, '2023-03-31 07:43:59'),
(27, 11, NULL, 1, 1, '2023-03-31 07:58:28'),
(28, NULL, 1, 35, 1, '2023-04-03 15:25:48'),
(29, NULL, 1, 1, 1, '2023-04-03 15:26:29'),
(30, NULL, 1, 2, 1, '2023-04-03 15:35:22'),
(31, NULL, 1, 44, 1, '2023-04-03 15:35:55'),
(32, NULL, 2, 61, 1, '2023-04-03 15:42:12'),
(33, NULL, 3, 100, 1, '2023-04-03 15:45:08'),
(34, NULL, 3, 47, 1, '2023-04-03 15:45:16'),
(35, NULL, 4, 100, 1, '2023-04-03 15:48:14'),
(36, NULL, 4, 49, 1, '2023-04-03 15:48:20'),
(37, NULL, 101, 1, 1, '2023-05-18 20:27:20'),
(38, NULL, 1, 1, 1, '2023-05-19 10:22:02'),
(39, NULL, 1, 45, 1, '2023-05-19 10:31:31');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `technology_supplies`
--

INSERT INTO `technology_supplies` (`ts_id`, `ts_name`, `ts_model`, `ts_brand`, `ts_category`, `ts_quantity`, `ts_location`, `ts_img`, `ts_desc`, `status`, `date_added`, `date_last_modified`, `modified_by`) VALUES
(1, '2035 LaserJet Printer Ow', '2035', 'HP', 'Printer', 2, 'Mae / Rai', 'IMG_6426174c0c5a90.36265075.jpg', 'Model Color White - (TCC-05A) (CE505AC)\r\nassign to: Mae / Rai', 'enabled', '2022-11-01 00:00:00', '2023-05-25 09:28:58', 1),
(2, '1102 HP LaserJet Pro', 'P1102', 'HP', 'Printer', 6, 'Athan / Che / Cyril / Grace / Karen / Tin ', 'IMG_642619b45b6169.36760609.gif', 'Color White - 85A\r\nassign to: Athan / Che / Cyril / Grace / Karen / Tin ', 'enabled', '2022-10-15 00:00:00', '2023-05-06 14:06:20', 1),
(3, 'M12a HP LaserJet Pro', 'M12a', 'HP', 'Printer', 1, 'Hannah', 'IMG_64261bb65750f0.43287160.png', '79A \r\nassign to: Hannah', 'enabled', '2022-09-01 00:00:00', '2023-05-06 14:06:01', 1),
(4, '1006 HP LaserJet', 'P1006', 'HP', 'Printer', 2, 'Dina /  Josh', 'IMG_64261c891f6e62.82732436.gif', 'Colour Black - 35A\r\nassign to: Dina / Josh', 'enabled', '2022-08-01 00:00:00', '2023-05-06 14:04:51', 1),
(5, '107 HP Laser', '107A', 'HP', 'Printer', 2, 'Athan / Dina / Tin (3)', 'IMG_64261d8ac03c77.19572054.png', '107a\r\nassign to: Athan / Dina / Tin (3)', 'enabled', '2022-07-01 00:00:00', '2023-05-22 15:52:02', 1),
(6, 'ID Printer', 'SR300e 600', 'Entrust ', 'ID Printer', 3, 'Joel', 'IMG_64261ea30c2928.12094458.jpg', 'Retransfer Duplex ID Card Printer\r\nassign to: Joel', 'enabled', '2022-06-01 00:00:00', '2023-05-06 14:05:21', 1),
(7, 'FUJI XEROX ', 'S2110', 'FUJI', 'XEROX', 2, 'Mezzanine', 'IMG_64262001027794.50202601.png', 'FUJI XEROX A3 MFD DOCUCENTRE S2110', 'enabled', '2022-05-01 00:00:00', '2023-05-06 14:02:10', 1),
(11, 'M402 LaserJet Pro', 'M402', 'HP', 'Printer', 1, 'Transfer_Tech c/o Karen', 'IMG_64262213f13648.93869138.png', 'Transfer_Tech_by:EKCGubaton', 'enabled', '2023-02-08 23:29:34', '2023-05-06 14:05:34', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_firstname`, `user_lastname`, `user_password`, `user_email`, `user_img`, `user_category`, `user_status`, `user_date`, `modified_by`, `date_last_modified`, `code`) VALUES
(1, 'SSMS', 'Admin', '$2y$10$mDftrycCKhiQCFNampH13.Gn4S5mU665eoAx2nXC9rlUacBzXw1ju', 'storagesupplyms@gmail.com', '', 'admin', 'active', '0000-00-00 00:00:00', NULL, '2023-02-08 11:21:39', '4640'),
(12, 'joevy', 'fajardo', '$2y$10$dry4pRgOgmXFpk9xXbMguO9O/mfUFXSS8kOhE/xEs1Lej8VY/sIci', 'joevyfajardowaje@gmail.com', '', 'admin', 'active', '2023-03-30 14:31:50', 1, '2023-05-04 14:52:58', ''),
(13, 'Julie ann', 'Espiritu', '$2y$10$/iBTk7UyYFlCTZZ.XkYUaek6SplZRKZRfeKwVpjbpzABjQhaiU8Ea', 'espiritu.julieann.jae@gmail.com', '', 'admin', 'active', '0000-00-00 00:00:00', 1, '2023-05-04 14:53:09', ''),
(14, 'Raian', 'Yano', '$2y$10$Kkj8gumWw.xaLSxvsmtsHeVU.m0OnX3zXk2d.kBriLruuYgRlX8be', 'rbyano@earist.ph.education', '', 'user', 'active', '0000-00-00 00:00:00', 1, '2023-05-04 16:41:19', ''),
(15, 'MAE', 'SOLIS', '$2y$10$YDJsgVcYGGtirRkSxQHnveqF6h1YRaC5ZQ0TvlcdR6t0VngrwcpZ2', 'mmsolis@earist.ph.education', '', 'user', 'active', '0000-00-00 00:00:00', 1, '2023-05-04 16:41:36', ''),
(16, 'Cherry', 'Nacion', '$2y$10$gKNRRGnLz3xKNL37KeocMOtxWiPiQ7oGZdjPZOiH29uLmWFs35uWK', 'cnacion@earist.ph.education', '', 'user', 'active', '0000-00-00 00:00:00', 1, '2023-05-04 16:41:49', ''),
(17, 'Mary Grace', 'Salcedo', '$2y$10$uoCRURzB3w1rqc7f5fIrE.uwdbLm4HDC50GLN3t4pDzgvzNUvAz9S', 'mcsalcedo@earist.ph.education', '', 'user', 'active', '0000-00-00 00:00:00', 1, '2023-05-04 16:42:27', ''),
(18, 'Hannah Lorraine', 'Casuga', '$2y$10$zfbhHbiBGR88rJ5tuietxOy8JISCFMp7SGN4VQuGW2qmAgNvnLb2u', 'hacasuga@earist.ph.education', '', 'user', 'active', '0000-00-00 00:00:00', 1, '2023-05-04 16:42:19', ''),
(19, 'Dina ', 'NuÃ±ez ', '$2y$10$/ubv7xQgUV8w8nDNvRQ2xeVMbXOgKmIy//3W6kz6NgQVEVR9Dtc8S', 'denunez@earist.ph.education', '', 'user', 'active', '0000-00-00 00:00:00', 1, '2023-05-04 16:42:37', ''),
(20, 'JONATHAN', 'TORZAR', '$2y$10$CgnclNTv1s0QO6OnT6eXDezKDV0xFEJBTas4kgQJ2hy2Q7Y5k0CS2', 'jmtorzar@earist.ph.education', '', 'user', 'active', '0000-00-00 00:00:00', 1, '2023-05-04 16:43:04', ''),
(21, 'Jake', 'Napay', '$2y$10$8ytAjN5ft/A8E7F9Zn9mTeEjSj2XmBp5BoMhx0sURSSKAOC2S3vWO', 'jakemantesnapay@gmail.com', '', 'user', 'active', '0000-00-00 00:00:00', 1, '2023-05-25 13:26:08', '3500');

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
  ADD KEY `modified_by` (`modified_by`);

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
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `office_supplies`
--
ALTER TABLE `office_supplies`
  MODIFY `os_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `restocks`
--
ALTER TABLE `restocks`
  MODIFY `restock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `technology_supplies`
--
ALTER TABLE `technology_supplies`
  MODIFY `ts_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

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
  ADD CONSTRAINT `history_ibfk_4` FOREIGN KEY (`modified_by`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

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
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `user_created_by` FOREIGN KEY (`modified_by`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
