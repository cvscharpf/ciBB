-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 26, 2021 at 02:58 PM
-- Server version: 8.0.16
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bbytes`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `pay_method` int(3) NOT NULL,
  `address` text,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_in` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `firstname`, `lastname`, `email`, `phone`, `password`, `pay_method`, `address`, `created`, `last_in`) VALUES
(1, 'Valentina', 'Scharpf', 'main@valentinac.com', '123 456 7893', '$2y$10$l3ovMqIZwsRWIDG3ZqZVtOF5Z5xWvHsy8CNmiz0yU4lNZ9vQ2rWM6', 1, 'Main St. 123\r\nThe next door from the left\r\nApt 1', '2021-02-21 04:20:32', '2021-02-21 04:20:32');

-- --------------------------------------------------------

--
-- Table structure for table `ffi`
--

CREATE TABLE `ffi` (
  `id` int(10) UNSIGNED NOT NULL,
  `fid` int(10) NOT NULL,
  `iid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `foods`
--

CREATE TABLE `foods` (
  `id` int(10) UNSIGNED NOT NULL,
  `food_name` varchar(200) NOT NULL,
  `food_description` text NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `image` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `on_menu` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `foods`
--

INSERT INTO `foods` (`id`, `food_name`, `food_description`, `price`, `image`, `on_menu`) VALUES
(1, 'Strawberry Cake', '<p>\r\nThis strawberry cake is awesome! \r\n<br /><br />\r\nIt is hard to find really good strawberry cakes, but the one we offer is worth its weight in gold. <br />\r\nWe make this cake using the best igredients. <br />\r\nFrosted with cream cheese or vanilla. Sometimes, a treat, we use chocolate glaze!\r\n</p>\r\n', '15', 'foods/strbCake.PNG', 1),
(2, 'Tiramisu', '<p>\r\nFor a classic Italian dessert, try our Tiramisu! <br />\r\nLadyfingers soaked in espresso and rum and laced with a creamy mascarpone. What can be better? \r\n</p>', '11', 'foods/tiramisu.PNG', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `cust_id` int(10) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `car_description` text,
  `delivery_address` text,
  `timePref` timestamp NOT NULL,
  `deliveryType` varchar(10) NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `priority` int(10) NOT NULL DEFAULT '1',
  `completed` tinyint(1) NOT NULL,
  `cancelled` tinyint(1) NOT NULL,
  `ready` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `cust_id`, `created`, `car_description`, `delivery_address`, `timePref`, `deliveryType`, `total`, `priority`, `completed`, `cancelled`, `ready`) VALUES
(20, 1, '2021-02-25 01:30:04', 'Blue car\r\nNissan', NULL, '2021-02-25 01:35:00', 'pickup', '74', 1, 1, 0, 0),
(23, 1, '2021-02-25 06:33:17', '', 'Main St. 123\r\nThe next door from the left\r\nApt 1', '2021-02-25 06:33:00', 'deliver', '52', 1, 1, 0, 0),
(24, 1, '2021-02-26 17:25:02', '', 'Main St. 123\r\nThe next door from the left\r\nApt 1', '2021-02-26 21:26:00', 'deliver', '15', 1, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders_contents`
--

CREATE TABLE `orders_contents` (
  `id` int(10) UNSIGNED NOT NULL,
  `o_id` int(10) NOT NULL,
  `f_id` int(10) NOT NULL,
  `qty` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders_contents`
--

INSERT INTO `orders_contents` (`id`, `o_id`, `f_id`, `qty`) VALUES
(1, 20, 1, 3),
(2, 20, 2, 5),
(3, 23, 1, 2),
(4, 23, 2, 2),
(5, 24, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pay_methods`
--

CREATE TABLE `pay_methods` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pay_methods`
--

INSERT INTO `pay_methods` (`id`, `name`) VALUES
(1, 'Credit Card'),
(2, 'PayPal'),
(3, 'Cash');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(10) UNSIGNED NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ffi`
--
ALTER TABLE `ffi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_contents`
--
ALTER TABLE `orders_contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pay_methods`
--
ALTER TABLE `pay_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ffi`
--
ALTER TABLE `ffi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `foods`
--
ALTER TABLE `foods`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `orders_contents`
--
ALTER TABLE `orders_contents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pay_methods`
--
ALTER TABLE `pay_methods`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
