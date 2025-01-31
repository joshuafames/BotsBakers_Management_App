-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2025 at 06:58 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `business_management_app`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `contact`, `address`, `num_orders`, `representative`, `credit`) VALUES
(1, 'Wits Business School', 'wits@mail.com', '21 Rockridge rd, Parktown, 2193', 8, NULL, 0),
(2, 'kkkkkk', '010010001', 'k1 south, 9100, ', 2, NULL, 0),
(3, 'Steven Williams', 'stevewilliams@mail.c', '101 Vendor Street, Rosebank, Johannesburg, ', 11, 'Mike', 799);

-- --------------------------------------------------------

--
-- Table structure for table `daily_sales`
--

CREATE TABLE `daily_sales` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `product_id` int(11) NOT NULL,
  `amount` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `daily_sales`
--

INSERT INTO `daily_sales` (`id`, `date`, `product_id`, `amount`) VALUES
(27, '2025-01-27', 1008, 9901.00),
(28, '2025-01-27', 1004, 2601.00),
(29, '2025-01-28', 1001, 305.20),
(30, '2025-01-28', 1007, 43.10);

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
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `item_name` varchar(64) NOT NULL,
  `cost` decimal(11,2) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `item_name`, `cost`, `count`) VALUES
(1, 'Econo Russian', 50.00, 20);

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `client` varchar(60) NOT NULL,
  `description` varchar(220) NOT NULL,
  `amount` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `amount_paid` int(11) NOT NULL,
  `date_issued` date NOT NULL,
  `due_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `client`, `description`, `amount`, `discount`, `amount_paid`, `date_issued`, `due_date`) VALUES
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
  `token` text NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_tokens`
--

INSERT INTO `login_tokens` (`id`, `token`, `user_id`) VALUES
(1, '6f9600c3c6b4779b0c1805e382e22a49538b8b41be34e712a6c018a556344d41', 7),
(3, 'f74c51b2ff9490434567eee1fe911df2f6a6e8d7bcc0c2de997fbe817527b0d9', 6),
(4, '5aa1f6e2d796ffbef547722fa3cd2126abc54b764fcedfcdd5e7b2a5a0591d61', 6),
(5, '2283ad4afe6b1be36167684521a7bd8b5ff318c75a74f2adc846c41b5724e2dc', 6);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `unit_price` decimal(11,0) NOT NULL,
  `unit_cost` decimal(11,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `unit_price`, `unit_cost`) VALUES
(1001, 'Kota variant_1', 25, NULL),
(1002, 'Kota variant_2', 30, NULL),
(1003, 'Kota variant_3', 35, NULL),
(1004, 'Chips small', 20, NULL),
(1005, 'Chips medium', 30, NULL),
(1006, 'Chips large', 40, NULL),
(1007, 'drum stick', 20, NULL),
(1008, 'achaar', 20, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_ingredients`
--

CREATE TABLE `product_ingredients` (
  `product_id` int(11) NOT NULL,
  `inventory_item` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(32) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `names` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `names`) VALUES
(3, 'dummy', '$2y$10$0pdCVgDmwqdaQctkI9iZwuYoeweZ5v2yIQcSs7pPJYyrUJcjku7I2', 'dummy account'),
(4, 'mordecai', '$2y$10$SGx5sXYrXUkNKCKkDIu6A.4aEWVCs9eiW87tLa0aHu.ylZfjzmxCK', 'Mordecai'),
(5, 'stacy', '$2y$10$qTwY1ozGVB9chnXNGR5TgO/lpb64H4oBjpvkeC0xg2Twsi9.tdHjK', 'stacy account'),
(6, 'admin', '$2y$10$D3Yt.5.KpvDmcigV8rILs.hhNo9FufBw/Hn5UIEGZURm1SwRTC8ny', 'admin account'),
(7, 'admin2', '$2y$10$yVBFWstQj14tsDXJS4CsXuMxrotogm.gB4yfKL4c7b47tgwKIWASq', 'admin2 account');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daily_sales`
--
ALTER TABLE `daily_sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
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
  ADD UNIQUE KEY `token` (`token`) USING HASH,
  ADD KEY `user_id` (`user_id`) USING BTREE;

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_ingredients`
--
ALTER TABLE `product_ingredients`
  ADD PRIMARY KEY (`product_id`,`inventory_item`),
  ADD KEY `inventory_item` (`inventory_item`);

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
-- AUTO_INCREMENT for table `daily_sales`
--
ALTER TABLE `daily_sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `login_tokens`
--
ALTER TABLE `login_tokens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1009;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `daily_sales`
--
ALTER TABLE `daily_sales`
  ADD CONSTRAINT `daily_sales_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `product_ingredients`
--
ALTER TABLE `product_ingredients`
  ADD CONSTRAINT `product_ingredients_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_ingredients_ibfk_2` FOREIGN KEY (`inventory_item`) REFERENCES `inventory` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
