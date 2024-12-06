-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2024 at 04:31 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `drippy`
--

-- --------------------------------------------------------

--
-- Table structure for table `chatbot`
--

CREATE TABLE `chatbot` (
  `chatbot_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chatbot`
--

INSERT INTO `chatbot` (`chatbot_id`, `question`, `answer`) VALUES
(1, 'What kind of products does Drippy sell?', 'Drippy specializes in trendy and stylish clothing, including T-shirts, hoodies, jackets, and accessories to elevate your drip!'),
(2, 'Are your products unisex?', 'Yes! Drippy offers unisex designs that cater to all genders with a wide range of sizes and styles'),
(3, 'Do you restock sold-out items?', 'Popular items are often restocked, but availability may vary. Stay updated by following us on social media!'),
(4, 'How can I place an order?', 'Simply browse our products, add your favorite items to the cart, and proceed to checkout. It\'s that easy!'),
(5, 'Do I need an account to shop on Drippy?', 'Yes, you do need an account. This lets you track orders and enjoy a personalized experience.');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `photo_1` varchar(100) DEFAULT NULL,
  `photo_2` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `quantity`, `price`, `photo_1`, `photo_2`, `created_at`, `updated_at`) VALUES
(1, 'FLOW T-SHIRT', 200, 68.00, 'assets/products/flow_white_tshirt.png', 'assets/products/flow_black_tshirt.png', '2024-12-05 03:27:23', '2024-12-06 00:14:23'),
(2, 'FLOW LONG SLEEVE', 200, 82.00, 'assets/products/flow_white_longsleeve.png', 'assets/products/flow_black_longsleeve.png', '2024-12-05 03:27:23', '2024-12-06 00:14:23'),
(3, 'FLOW HOODIE WHITE VER', 200, 50.00, 'assets/products/flow_white_hoodie_front.png', 'assets/products/flow_white_hoodie_back.png', '2024-12-05 03:27:23', '2024-12-06 00:14:23'),
(4, 'FLOW HOODIE BLACK VER', 200, 50.00, 'assets/products/flow_black_hoodie_front.png', 'assets/products/flow_black_hoodie_back.png', '2024-12-05 03:27:23', '2024-12-06 00:14:23'),
(5, 'FLOW CAP', 200, 46.00, 'assets/products/flow_white_cap.png', 'assets/products/flow_black_cap.png', '2024-12-05 03:27:23', '2024-12-06 00:14:23'),
(6, 'HAI! DESSUU! T-SHIRT', 200, 68.00, 'assets/products/haidessuu_white_tshirt.png', 'assets/products/haidessuu_black_tshirt.png', '2024-12-05 03:27:23', '2024-12-06 00:14:23'),
(7, 'HAI! DESSUU! LONG SLEEVE', 200, 82.00, 'assets/products/haidessuu_white_longsleeve.png', 'assets/products/haidessuu_black_longsleeve.png', '2024-12-05 03:27:23', '2024-12-06 00:14:23'),
(8, 'HAI! DESSUU! HOODIE WHITE VER', 200, 50.00, 'assets/products/haidessuu_white_hoodie_front.png', 'assets/products/haidessuu_white_hoodie_back.png', '2024-12-05 03:27:23', '2024-12-06 00:14:23'),
(9, 'HAI! DESSUU! HOODIE BLACK VER', 200, 50.00, 'assets/products/haidessuu_black_hoodie_front.png', 'assets/products/haidessuu_black_hoodie_back.png', '2024-12-05 03:27:23', '2024-12-06 00:14:23'),
(10, 'HAI! DESSUU! CAP', 200, 46.00, 'assets/products/haidessuu_white_cap.png', 'assets/products/haidessuu_black_cap.png', '2024-12-05 03:27:23', '2024-12-06 00:14:23'),
(11, 'X-PRESS T-SHIRT', 200, 68.00, 'assets/products/xpress_white_tshirt.png', 'assets/products/xpress_black_tshirt.png', '2024-12-05 03:27:23', '2024-12-06 00:14:23'),
(12, 'X-PRESS LONG SLEEVE', 200, 82.00, 'assets/products/xpress_white_longsleeve.png', 'assets/products/xpress_black_longsleeve.png', '2024-12-05 03:27:23', '2024-12-06 00:14:23'),
(13, 'X-PRESS HOODIE WHITE VER', 200, 50.00, 'assets/products/xpress_white_hoodie_front.png', 'assets/products/xpress_white_hoodie_back.png', '2024-12-05 03:27:23', '2024-12-06 00:14:23'),
(14, 'X-PRESS HOODIE BLACK VER', 200, 50.00, 'assets/products/xpress_black_hoodie_front.png', 'assets/products/xpress_black_hoodie_back.png', '2024-12-05 03:27:23', '2024-12-06 00:14:23'),
(15, 'X-PRESS CAP', 200, 46.00, 'assets/products/xpress_white_cap.png', 'assets/products/xpress_black_cap.png', '2024-12-05 03:27:23', '2024-12-06 00:14:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('customer','admin') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `level`, `created_at`, `updated_at`) VALUES
(6, 'admin', '$2y$10$EE45WAx1Ml3ZRN3/UQPtgew8foiJEhekW0c1.4RYIpb28MLfo5Piq', 'admin', '2024-12-06 01:51:44', '2024-12-06 01:55:59'),
(7, 'flinrzqlh', '$2y$10$Y2Q.H7QsgpgwwxJtH5RAB.cNK09duZfafyhgumolyQfTIZi8itj2m', 'customer', '2024-12-06 01:57:42', '2024-12-06 01:57:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chatbot`
--
ALTER TABLE `chatbot`
  ADD PRIMARY KEY (`chatbot_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chatbot`
--
ALTER TABLE `chatbot`
  MODIFY `chatbot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
