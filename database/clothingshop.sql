-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2024 at 03:01 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clothingshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(8) NOT NULL,
  `user_id` int(8) UNSIGNED NOT NULL,
  `product_id` int(8) UNSIGNED NOT NULL,
  `qty` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(8) NOT NULL,
  `code` varchar(255) NOT NULL,
  `disount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `disount`) VALUES
(1, 'INDONESIAMANDIRI', 0.9),
(2, 'GRATISONGKIR', 0.1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(3) NOT NULL,
  `product_id` int(3) NOT NULL,
  `user_id` int(3) NOT NULL,
  `qty` int(2) NOT NULL,
  `status` enum('pending','paid') NOT NULL DEFAULT 'pending',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `product_id`, `user_id`, `qty`, `status`, `created_at`, `date`, `total`) VALUES
(1, 2, 8, 3, 'pending', '0000-00-00 00:00:00', '2024-01-14 21:59:16', 540000),
(2, 2, 8, 3, 'pending', '2024-01-10 22:04:04', '2024-01-10 16:03:32', 540000),
(3, 2, 8, 1, 'pending', '2024-01-19 07:10:58', '2024-01-22 07:10:58', 180000),
(4, 2, 8, 5, 'pending', '2024-01-19 07:10:59', '2024-01-22 07:10:59', 900000),
(5, 2, 8, 5, 'pending', '2024-01-19 07:11:01', '2024-01-22 07:11:01', 900000),
(6, 2, 8, 5, 'pending', '2024-01-19 07:11:02', '2024-01-22 07:11:02', 900000),
(7, 2, 8, 1, 'pending', '2024-01-19 07:11:50', '2024-01-22 07:11:50', 180000),
(8, 2, 8, 5, 'pending', '2024-01-19 07:11:51', '2024-01-22 07:11:51', 900000),
(9, 2, 8, 5, 'pending', '2024-01-19 07:11:52', '2024-01-22 07:11:52', 900000),
(10, 2, 8, 5, 'pending', '2024-01-19 07:11:54', '2024-01-22 07:11:54', 900000);

--
-- Triggers `orders`
--
DELIMITER $$
CREATE TRIGGER `add_3_date` BEFORE INSERT ON `orders` FOR EACH ROW BEGIN

SET NEW.date = DATE_ADD(NEW.date, INTERVAL 3 DAY);

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_products` AFTER INSERT ON `orders` FOR EACH ROW BEGIN

UPDATE `products` SET `stock` = `stock` - NEW.qty WHERE `id` = NEW.product_id;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(8) NOT NULL,
  `name` varchar(50) NOT NULL,
  `desc` text NOT NULL,
  `src` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `stock` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `desc`, `src`, `price`, `stock`) VALUES
(2, 'De White Jacket', '<p class=\'text-justify text-gray-500\'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque voluptas nemo sint dolorum. Labore, maxime inventore aliquam praesentium beatae ipsam possimus qui hic? Magni quod, placeat praesentium porro esse vel earum asperiores vero iure saepe vitae sint non quia inventore doloribus unde, voluptate voluptatibus delectus! Illum libero quis perferendis necessitatibus aut. Neque eaque accusantium nisi laborum impedit nulla ullam quos inventore iste harum ipsum sequi ut quo culpa, provident amet voluptatem dolore consequuntur earum reiciendis quasi? Enim, est voluptatibus asperiores mollitia aliquid dolorem eligendi velit placeat cum, aliquam numquam fugit commodi, tenetur sint? Reprehenderit tempore incidunt officia facere dicta corporis!</p>\r\n\r\n<table class=\"w-full\">\r\n<thead>\r\n<tr>\r\n<th>Size</th>\r\n<th>Width</th>\r\n<th>Height</th>\r\n</tr>\r\n</thead>\r\n<tbody>\r\n<tr>\r\n<td>S</td>\r\n<td>58</td>\r\n<td>65</td>\r\n</tr>\r\n</tbody>\r\n</table>', 'product_18.png', 180000, 18);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(8) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `address`) VALUES
(8, 'Cavin Hartono Putra', 'cavin@gmail.com', '$2y$10$QyW9Nf0hjyCjQNJ93rhiBug30..vVBt/tVJ733AMMsAaTlqKyRQBu', 'Bandung');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

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
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
