-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2024 at 12:56 AM
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
-- Database: `botsbakers`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `address` varchar(80) NOT NULL,
  `num_orders` int(11) NOT NULL,
  `representative` varchar(120) DEFAULT NULL,
  `credit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `contact`, `address`, `num_orders`, `representative`, `credit`) VALUES
(1, 'Wits Business School', 'wits@mail.com', '21 Rockridge rd, Parktown, 2193', 8, NULL, 0),
(2, 'kkkkkk', '010010001', 'k1 south, 9100, ', 2, NULL, 0),
(3, 'Steven Williams', 'stevewilliams@mail.c', '101 Vendor Street, Rosebank, Johannesburg, ', 11, 'Mike', 799);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `full_name` varchar(120) NOT NULL,
  `role` varchar(60) NOT NULL,
  `start_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `Client` varchar(60) NOT NULL,
  `Description` varchar(220) NOT NULL,
  `Amount` int(11) NOT NULL,
  `Discount` int(11) NOT NULL,
  `Amount_Paid` int(11) NOT NULL,
  `Date_Issued` date NOT NULL,
  `Due_Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `Client`, `Description`, `Amount`, `Discount`, `Amount_Paid`, `Date_Issued`, `Due_Date`) VALUES
(1, 'Kevin', '3xBrownBread', 24, 0, 0, '2023-01-04', '2023-01-11'),
(2, 'Sentha', '50xWhiteBread,12xSoftis,11xBurgerBuns', 840, 0, 0, '2023-01-04', '2023-01-12'),
(3, 'Wits Business School', '97xBrownBread, 96xWhiteBread', 1833, 0, 0, '2023-04-30', '2023-05-05'),
(4, 'ooo', '14xBurgerBuns', 192, 0, 0, '2024-06-11', '2024-06-13'),
(5, 'kkkkkk', '6xRolls', 78, 0, 0, '2024-06-11', '2024-06-19'),
(6, 'kkkkkk', '300xSoftis', 5100, 0, 0, '2024-06-13', '2024-06-30'),
(7, 'Wits Business School', '100xWhiteBread, 100xBrownBread, 70xRolls', 2810, 0, 0, '2024-06-21', '2024-11-30'),
(8, 'Steven Williams', '200xSoftis', 3400, 0, 0, '2024-06-26', '2025-01-27'),
(9, 'Steven Williams', '250xRolls', 3250, 0, 0, '2024-06-26', '2024-12-26'),
(10, 'Steven Williams', '150xBurgerBuns, 100xWhiteBread, 100xBrownBread', 3850, 0, 0, '2024-06-26', '2024-12-26'),
(11, 'Steven Williams', '70xWhiteBread', 700, 0, 0, '2024-06-26', '2025-01-26'),
(12, 'Wits Business School', '120xWhiteBread', 1200, 0, 0, '2024-06-27', '2024-12-27'),
(13, 'kkkkkk', '80xBrownBread', 720, 0, 0, '2024-07-07', '2024-10-23'),
(14, 'Steven Williams', '150xWhiteBread', 1500, 0, 0, '2024-07-07', '2024-07-31'),
(15, 'Steven Williams', '355xSoftis', 6035, 0, 0, '2024-07-07', '2024-07-31'),
(16, 'Steven Williams', '200xBurgerBuns', 2600, 0, 0, '2024-07-07', '2024-07-31'),
(17, 'Steven Williams', '170xSoftis', 2890, 0, 0, '2024-07-07', '2024-07-31'),
(18, 'Steven Williams', '50xRolls, 70xBrownBread', 1280, 0, 0, '2024-07-07', '2024-07-31'),
(19, 'Wits Business School', '158xWhiteBread', 1580, 0, 0, '2024-07-20', '2024-09-26'),
(20, 'Wits Business School', '177xSoftis', 3009, 0, 0, '2024-07-21', '2024-07-23'),
(21, 'Wits Business School', '130xRolls', 1690, 0, 0, '2024-07-21', '2024-07-23'),
(22, 'Wits Business School', '158xSoftis, 20xWhiteBread, 29xBrownBread', 3147, 0, 0, '2024-07-21', '2024-07-23'),
(23, 'Wits Business School', '99xBrownBread', 891, 0, 0, '2024-07-21', '2024-07-30'),
(24, 'Steven Williams', '184xWhiteBread', 1840, 0, 0, '2024-08-21', '2024-08-30');

-- --------------------------------------------------------

--
-- Table structure for table `login_tokens`
--

CREATE TABLE `login_tokens` (
  `id` int(11) UNSIGNED NOT NULL,
  `token` char(64) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `login_tokens`
--

INSERT INTO `login_tokens` (`id`, `token`, `user_id`) VALUES
(1, '7e7d7d4e666dbcb81bce6bbd6730ae6798b08bd9', 1),
(2, 'b2761f5b56bb6874e5eb8e4af6fe73ef60a153a5', 1),
(3, '4b5b155dd033e4cc7437017460b3445f0e731ded', 1),
(4, '47f3755e7e89fe7c315314beb976001cb52d7e88', 2),
(5, '601039d18bb8b787ad8777b19ee22aeee2ad76c0', 2),
(6, '58ebdcb4dd6af2bb9df92fed0388b2d9432a670f', 2),
(7, '602898d49c6b46a257850018ec082a9868f03e8e', 2),
(8, '318d7b08aa808d8ae6ab97327e95e426b50f1a42', 2),
(9, '77fa726be84c9b173adbfe0748dd003700677323', 2),
(12, 'ee1100d1bc850e20c206b46c0d218012e90c61f4', 2),
(13, '4ba27e1736565b172367eddda58c5d7eb90520ec', 2),
(14, '05c2058657619a2982b8992ab2159dc35779743d', 2),
(15, '86f028e5f62d338bce350a150f8ce166f7f27575', 2),
(16, '6821e74a813982750e5f8ecb7989d8e80cc7a170', 2),
(17, 'ba39a8a3a0f025da35e4990809291e97bb56ad5a', 2),
(18, '6196064c0698eb25199fe69aa13edef1f1f220c2', 2),
(19, 'a2051044e98f9f626c1d3b434d9894ce54c0ae88', 2),
(20, 'fb3050a33d0bf320fcde19dc4fb16b403298bce5', 2),
(22, '045bb4ece63c81822f0b27b0ed8fe5e9759c01cd', 2),
(23, 'ad4e5cfb2216c088c92fe804030fe645fb225507', 2),
(24, 'e45c2bfbe3cca0ddbbee4c18a6621f6ad5526d26', 2),
(28, '00d289a0a240b8d48e14e31a449b3272767f6ce0', 2),
(29, '79bdb97a1b8e828967ca1bb0912b4a7f9f5cb193', 2),
(30, '50d420dd6597a38f6a2e5087fb6079a424ca7849', 2),
(31, 'e430825745b012bb1ad99d81db84f8ed45133a70', 2),
(32, '8f9a365e4abcbef7274c0268cd4800a5edbc022f', 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Client` varchar(100) NOT NULL,
  `BrownBread` int(11) NOT NULL,
  `WhiteBread` int(11) NOT NULL,
  `Rolls` int(11) NOT NULL,
  `Softis` int(11) NOT NULL,
  `BurgerBuns` int(11) NOT NULL,
  `Amount` decimal(11,0) NOT NULL,
  `Discount` decimal(11,0) DEFAULT NULL,
  `Delivery_Fee` decimal(11,0) DEFAULT NULL,
  `Total_Amount` int(11) NOT NULL,
  `Payment` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `Date`, `Client`, `BrownBread`, `WhiteBread`, `Rolls`, `Softis`, `BurgerBuns`, `Amount`, `Discount`, `Delivery_Fee`, `Total_Amount`, `Payment`) VALUES
(1, '2023-01-04', 'Sentha', 0, 50, 0, 0, 11, '840', '0', NULL, 840, 'Invoice'),
(2, '2023-04-28', 'POS', 4, 10, 0, 6, 5, '220', NULL, NULL, 220, 'Cash'),
(3, '2023-04-30', 'POS', 6, 9, 7, 4, 2, '319', NULL, NULL, 319, 'Cash'),
(4, '2023-04-30', 'Wits Business School', 97, 96, 0, 0, 0, '1833', '0', NULL, 1833, 'INV3'),
(5, '2023-05-18', 'POS', 5, 4, 0, 0, 9, '166', NULL, NULL, 166, 'Card'),
(6, '2024-06-11', 'POS', 0, 4, 0, 4, 2, '88', NULL, NULL, 88, 'Cash'),
(7, '2024-06-11', 'kkkkkk', 0, 0, 6, 0, 0, '78', '0', NULL, 78, 'INV5'),
(8, '2024-06-13', 'kkkkkk', 0, 0, 0, 0, 0, '5100', '0', NULL, 5100, 'INV6'),
(9, '2024-06-21', 'Wits Business School', 100, 100, 70, 0, 0, '2810', '0', NULL, 2810, 'INV7'),
(10, '2024-06-26', 'Steven Williams', 0, 0, 0, 0, 0, '3400', '0', NULL, 3400, 'INV8'),
(11, '2024-06-26', 'Steven Williams', 0, 0, 250, 0, 0, '3250', '0', NULL, 3250, 'INV9'),
(12, '2024-06-26', 'Steven Williams', 100, 100, 0, 0, 150, '3850', '0', NULL, 3850, 'INV10'),
(13, '2024-06-26', 'Steven Williams', 0, 70, 0, 0, 0, '700', '0', NULL, 700, 'INV11'),
(14, '2024-06-27', 'Wits Business School', 0, 120, 0, 0, 0, '1200', '0', NULL, 1200, 'INV12'),
(15, '2024-07-07', 'kkkkkk', 80, 0, 0, 0, 0, '720', '0', NULL, 720, 'INV13'),
(16, '2024-07-07', 'Steven Williams', 0, 150, 0, 0, 0, '1500', '0', NULL, 1500, 'INV14'),
(17, '2024-07-07', 'Steven Williams', 0, 0, 0, 0, 0, '6035', '0', NULL, 6035, 'INV15'),
(18, '2024-07-07', 'Steven Williams', 0, 0, 0, 0, 200, '2600', '0', NULL, 2600, 'INV16'),
(19, '2024-07-07', 'Steven Williams', 0, 0, 0, 0, 0, '2890', '0', NULL, 2890, 'INV17'),
(20, '2024-07-07', 'Steven Williams', 70, 0, 50, 0, 0, '1280', '0', NULL, 1280, 'INV18'),
(21, '2024-07-20', 'Wits Business School', 0, 158, 0, 0, 0, '1580', '0', NULL, 1580, 'INV19'),
(22, '2024-07-21', 'Wits Business School', 0, 0, 0, 0, 0, '3009', '0', NULL, 3009, 'INV20'),
(23, '2024-07-21', 'Wits Business School', 0, 0, 130, 0, 0, '1690', '0', NULL, 1690, 'INV21'),
(24, '2024-07-21', 'Wits Business School', 29, 20, 0, 0, 0, '3147', '0', NULL, 3147, 'INV22'),
(25, '2024-07-21', 'Wits Business School', 99, 0, 0, 0, 0, '891', '0', NULL, 891, 'INV23'),
(26, '2024-08-21', 'Steven Williams', 0, 184, 0, 0, 0, '1840', '0', NULL, 1840, 'INV24');

-- --------------------------------------------------------

--
-- Table structure for table `productorder`
--

CREATE TABLE `productorder` (
  `order_date` date NOT NULL,
  `payment_method` varchar(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `units` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `Product` varchar(60) NOT NULL,
  `Unit_Price` decimal(11,0) NOT NULL,
  `Unit_Cost` decimal(11,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `Product`, `Unit_Price`, `Unit_Cost`) VALUES
(1, 'WhiteBread', '9', NULL),
(2, 'BrownBread', '8', NULL),
(3, 'Rolls', '9', NULL),
(4, 'Softis', '8', NULL),
(5, 'BurgerBuns', '10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(32) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `email` text DEFAULT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `verified`) VALUES
(1, 'Nthabeleng Mofamere', '$2y$10$xrakLKQbbXp/mx5A5m0s7OtBGhBBtfebVW6.9GTw7yhIl259EpFw2', 'nthabeleng@gmail.com', 1),
(2, 'admin', '$2y$10$ygwX4C6GfHJJCsGJEqKeVuck9Da4M446JiaUM/k4bAAI4dwaxKgoe', NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_tokens`
--
ALTER TABLE `login_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`),
  ADD KEY `user_id` (`user_id`) USING BTREE;

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productorder`
--
ALTER TABLE `productorder`
  ADD PRIMARY KEY (`order_date`,`payment_method`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `login_tokens`
--
ALTER TABLE `login_tokens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `productorder`
--
ALTER TABLE `productorder`
  ADD CONSTRAINT `productorder_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
