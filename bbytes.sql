-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 21, 2021 at 06:58 PM
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
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` int(10) UNSIGNED NOT NULL,
  `cid` int(10) NOT NULL,
  `street` varchar(50) NOT NULL,
  `number` varchar(10) NOT NULL,
  `apt` varchar(10) NOT NULL,
  `city` varchar(30) NOT NULL,
  `state` int(5) NOT NULL,
  `code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_in` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `firstname`, `lastname`, `email`, `phone`, `password`, `pay_method`, `created`, `last_in`) VALUES
(1, 'Valentina', 'Scharpf', 'main@valentinac.com', '123 456 7893', '$2y$10$l3ovMqIZwsRWIDG3ZqZVtOF5Z5xWvHsy8CNmiz0yU4lNZ9vQ2rWM6', 2, '2021-02-21 04:20:32', '2021-02-21 04:20:32');

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
-- Table structure for table `fooditems`
--

CREATE TABLE `fooditems` (
  `id` int(10) UNSIGNED NOT NULL,
  `fooditem_name` varchar(200) NOT NULL
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
  `created` timestamp NOT NULL,
  `pickup` timestamp NOT NULL,
  `delivery` datetime NOT NULL,
  `ads_id` int(10) NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `priority` int(10) NOT NULL DEFAULT '1',
  `completed` tinyint(1) NOT NULL,
  `cancelled` tinyint(1) NOT NULL,
  `ready` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders_extra`
--

CREATE TABLE `orders_extra` (
  `id` int(10) UNSIGNED NOT NULL,
  `o_id` int(10) NOT NULL,
  `fi_id` int(10) NOT NULL,
  `qty` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `sid` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `abb` char(2) NOT NULL,
  `plus` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`sid`, `name`, `abb`, `plus`) VALUES
(1, 'Alabama', 'AL', 0),
(2, 'Alaska', 'AK', 0),
(3, 'Arizona', 'AZ', 0),
(4, 'Arkansas', 'AR', 0),
(5, 'California', 'CA', 0),
(6, 'Colorado', 'CO', 0),
(7, 'Connecticut', 'CT', 0),
(8, 'Delaware', 'DE', 0),
(9, 'District of Columbia', 'DC', 0),
(10, 'Florida', 'FL', 0),
(11, 'Georgia', 'GA', 0),
(12, 'Hawaii', 'HI', 0),
(13, 'Idaho', 'ID', 0),
(14, 'Illinois', 'IL', 0),
(15, 'Indiana', 'IN', 0),
(16, 'Iowa', 'IA', 0),
(17, 'Kansas', 'KS', 0),
(18, 'Kentucky', 'KY', 0),
(19, 'Louisiana', 'LA', 0),
(20, 'Maine', 'ME', 0),
(21, 'Maryland', 'MD', 0),
(22, 'Massachusetts', 'MA', 0),
(23, 'Michigan', 'MI', 0),
(24, 'Minnesota', 'MN', 0),
(25, 'Mississippi', 'MS', 0),
(26, 'Missouri', 'MO', 0),
(27, 'Montana', 'MT', 0),
(28, 'Nebraska', 'NE', 0),
(29, 'Nevada', 'NV', 0),
(30, 'New Hampshire', 'NH', 0),
(31, 'New Jersey', 'NJ', 0),
(32, 'New Mexico', 'NM', 0),
(33, 'New York', 'NY', 0),
(34, 'North Carolina', 'NC', 0),
(35, 'North Dakota', 'ND', 0),
(36, 'Ohio', 'OH', 0),
(37, 'Oklahoma', 'OK', 0),
(38, 'Oregon', 'OR', 0),
(39, 'Pennsylvania', 'PA', 0),
(40, 'Rhode Island', 'RI', 0),
(41, 'South Carolina', 'SC', 0),
(42, 'South Dakota', 'SD', 0),
(43, 'Tennessee', 'TN', 0),
(44, 'Texas', 'TX', 0),
(45, 'Utah', 'UT', 0),
(46, 'Vermont', 'VT', 0),
(47, 'Virginia', 'VA', 0),
(48, 'Washington', 'WA', 0),
(49, 'West Virginia', 'WV', 0),
(50, 'Wisconsin', 'WI', 0),
(51, 'Wyoming', 'WY', 0),
(52, 'American Samoa', 'AS', 1),
(53, 'Federated States of Micronesia', 'FM', 1),
(54, 'Guam', 'GU', 1),
(55, 'Marshall Islands', 'MH', 1),
(56, 'Northern Mariana Islands', 'MP', 1),
(57, 'Palau', 'PW', 1),
(58, 'Puerto Rico', 'PR', 1),
(59, 'Virgin Islands', 'VI', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `fooditems`
--
ALTER TABLE `fooditems`
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
-- Indexes for table `orders_extra`
--
ALTER TABLE `orders_extra`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pay_methods`
--
ALTER TABLE `pay_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`sid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `fooditems`
--
ALTER TABLE `fooditems`
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders_extra`
--
ALTER TABLE `orders_extra`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pay_methods`
--
ALTER TABLE `pay_methods`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
