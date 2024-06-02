-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2024 at 02:08 PM
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
-- Database: `dan_tbl`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `p_id` int(11) NOT NULL,
  `p_title` varchar(200) NOT NULL,
  `p_description` text NOT NULL,
  `p_price` double(10,0) NOT NULL,
  `p_rrp` double(10,0) NOT NULL DEFAULT 0,
  `p_quantity` int(11) NOT NULL,
  `p_img` text NOT NULL,
  `p_date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `u_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`p_id`, `p_title`, `p_description`, `p_price`, `p_rrp`, `p_quantity`, `p_img`, `p_date_added`, `u_id`) VALUES
(6, 'Strawberry', 'The fruit is widely appreciated for its characteristic aroma, bright red color, juicy texture, and sweetness', 30, 35, 1, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTF9WAm1-yylcc0heKUgpPd_xIF9Dp0wyGHPg&s', '2024-05-29 18:52:51', 2),
(9, 'Grape', 'Grapes are a type of fruit that grow in clusters of 15 to 300, and can be crimson, black, dark blue, yellow, green, orange, and pink.', 100, 100, 1, 'https://www.organics.ph/cdn/shop/products/grapes-crimson-seedless-500grams-fruits-vegetables-fresh-produce-988757_1024x.jpg?v=1601483999', '2024-05-29 20:35:48', 2),
(10, 'Kiwifruit', 'edible berry of several species of woody vines in the genus Actinidia.', 50, 50, 1, 'https://i.pinimg.com/736x/bb/33/44/bb334484e711d11f94851f129aab3cd6.jpg', '2024-05-29 20:36:05', 2);

-- --------------------------------------------------------

--
-- Table structure for table `userpayments`
--

CREATE TABLE `userpayments` (
  `payment_id` int(11) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `cardholder_name` varchar(255) NOT NULL,
  `card_number` varchar(16) NOT NULL,
  `expiry_date` varchar(7) NOT NULL,
  `cvv` varchar(4) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` varchar(20) NOT NULL,
  `shopping_cart` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userpayments`
--

INSERT INTO `userpayments` (`payment_id`, `payment_method`, `cardholder_name`, `card_number`, `expiry_date`, `cvv`, `amount`, `status`, `shopping_cart`, `created_at`) VALUES
(17, 'Credit Card', 'wq', '1', '11/2025', '1', 1000.00, 'Pending', '{\"6\":{\"quantity\":1,\"price\":35,\"totalPrice\":35}}', '2024-06-02 04:48:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(11) NOT NULL,
  `u_username` varchar(50) NOT NULL,
  `u_password` varchar(255) NOT NULL,
  `u_created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `u_username`, `u_password`, `u_created_at`) VALUES
(2, 'admin', '$2y$10$z0iaOm4KzjbHCKPl8NFVlODDGJJT.WSBaa/02KUVh6wJwPnZ1.Agi', '2024-05-29 18:35:51');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `udetails_id` int(11) NOT NULL,
  `udetails_name` varchar(100) NOT NULL,
  `udetails_address` text NOT NULL,
  `udetails_contact` varchar(20) NOT NULL,
  `udetails_email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`udetails_id`, `udetails_name`, `udetails_address`, `udetails_contact`, `udetails_email`) VALUES
(55, 'q', 'a', '42332', 'danmarkpetalcurin@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `userpayments`
--
ALTER TABLE `userpayments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`udetails_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `userpayments`
--
ALTER TABLE `userpayments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `udetails_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `users` (`u_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
