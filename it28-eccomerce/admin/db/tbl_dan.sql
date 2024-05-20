-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2024 at 11:43 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tbl_dan`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `salary` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_thumbnail_link` varchar(255) DEFAULT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_description` varchar(100) NOT NULL,
  `product_retail_price` varchar(255) NOT NULL,
  `product_date_added` date NOT NULL,
  `product_updated_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_thumbnail_link`, `product_name`, `product_description`, `product_retail_price`, `product_date_added`, `product_updated_date`) VALUES
(9, '', 'qqq', 'dsa', '1313', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', '$2y$10$h2WY/cxcopwA6Rz4i.gnZeaqcTtFa5OU6vmdrZmz/3Vk6t8F3pFUi', '2024-04-29 21:19:46'),
(2, 'qq', '$2y$10$ArzMuqFixs8IfON0R2/iH.26gJ5J7CFuvllBKLfhTcw6ohpYQt0vS', '2024-04-29 21:20:22'),
(3, 'ee', '$2y$10$7GpSfu7b8anSC1lqTYWQXuo0cvwnfX56Akg/aM7rzTKk06psBctCm', '2024-04-29 21:21:25'),
(4, 'a', '$2y$10$zMPgCgyTG72/IVva.Mb43OfG6Smua6DwgFVJv1Yf/9L4QVHC8uWmq', '2024-04-29 22:09:27'),
(5, 'w', '$2y$10$QJZVb6PmG9nUM7AGlmdVQe8jy.Bj922xXXP5ZBL4ngYruDKPXhMK6', '2024-04-29 22:12:38'),
(6, 'e', '$2y$10$njFOdttZUWJAGiHsSutxbezMHcRMpTAIJqFDXUg./gorEKG5F1wt6', '2024-04-29 22:12:59'),
(7, 'f', '$2y$10$4/bCL1JPKP1rRuyDcGouWufekZqmr27gQIsGhvHCy0srOwuUpSUhi', '2024-04-30 10:44:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
