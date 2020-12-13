-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2020 at 08:26 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grabify`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(128) NOT NULL,
  `role` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`, `role`) VALUES
(1, 'admin0', '$2y$10$A4or4RkbHD1f5emcyJza2ew3584UDFj77UYtdcX3aJWPR7rEJcUoC', '0'),
(2, 'admin1', '$2y$10$e/98e5Qgj4XX6.HMcgIIbeKt.T4w.ReSWxX28GQ1037l9PieIFaqO', '1'),
(3, 'admin2', '$2y$10$W6k7e4P1HbJ.RlZ2hdJ4Yuri5eTXWHEBVD4vTM1ZTsVsEUkuwHRUG', '2');

-- --------------------------------------------------------

--
-- Table structure for table `block_user`
--

CREATE TABLE `block_user` (
  `block_user_id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `blockTime` datetime NOT NULL,
  `token` varchar(255) NOT NULL,
  `tryAgain` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_id` int(11) NOT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `users_user_id` int(11) NOT NULL,
  `product_product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `business`
--

CREATE TABLE `business` (
  `business_id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `company_name` varchar(45) NOT NULL,
  `email` varchar(128) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact_number` int(11) NOT NULL,
  `active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `favorite`
--

CREATE TABLE `favorite` (
  `fav_id` int(11) NOT NULL,
  `users_user_id` int(11) NOT NULL,
  `product_product_id` int(11) NOT NULL,
  `category` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `log_id` int(11) NOT NULL,
  `log_type` varchar(16) NOT NULL,
  `log_content` varchar(255) NOT NULL,
  `log_ip` varchar(32) NOT NULL,
  `log_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`log_id`, `log_type`, `log_content`, `log_ip`, `log_time`) VALUES
(16, '0', 'Unauthorised access on /grabify/php/adminlogsfn.php', '::1', '2020-12-11 15:11:13'),
(17, '2', 'Multiple failed login attempts to login to \'bryan\' account', '::1', '2020-12-11 15:24:01'),
(18, '2', 'Unauthorised access on /swap-test/profile.php', '::1', '2020-12-11 15:30:51'),
(19, '2', 'Unauthorised access on /swap-test/profile.php', '::1', '2020-12-11 15:40:19'),
(20, '2', 'Unauthorised access on /grabify/profile.php', '::1', '2020-12-11 16:02:34'),
(21, '2', 'Unauthorised access on /grabify/2fa.php', '::1', '2020-12-11 16:02:37'),
(22, '2', 'Unauthorised access on /grabify/activateaccount.php', '::1', '2020-12-11 16:02:43'),
(23, '2', 'Unauthorised access on /grabify/activate_login.php', '::1', '2020-12-11 16:02:48'),
(24, '2', 'Unauthorised access on /grabify/new_password.php', '::1', '2020-12-11 16:02:56'),
(25, '2', 'Unauthorised access on /grabify/check.php', '::1', '2020-12-11 16:03:09'),
(26, '2', 'Unauthorised access on /swap-mylittlepony/profile.php', '::1', '2020-12-11 18:28:49'),
(27, '2', 'Unauthorised access on /grabify/profile.php', '::1', '2020-12-13 04:09:38'),
(28, '2', 'Unauthorised access on /grabify/profile.php', '::1', '2020-12-13 04:10:34'),
(29, '2', 'Unauthorised access on /grabify/profile.php', '::1', '2020-12-13 04:10:52'),
(30, '2', 'Unauthorised access on /grabify/profile.php', '::1', '2020-12-13 04:10:52'),
(31, '2', 'Unauthorised access on /grabify/profile.php', '::1', '2020-12-13 04:10:52'),
(32, '2', 'Unauthorised access on /grabify/profile.php', '::1', '2020-12-13 04:10:53'),
(33, '2', 'Unauthorised access on /grabify/profile.php', '::1', '2020-12-13 04:10:53'),
(34, '2', 'Unauthorised access on /grabify/profile.php', '::1', '2020-12-13 04:11:40'),
(35, '2', 'Unauthorised access on /grabify/profile.php', '::1', '2020-12-13 04:12:01'),
(36, '2', 'Unauthorised access on /grabify/profile.php', '::1', '2020-12-13 04:12:02'),
(37, '2', 'Unauthorised access on /grabify/profile.php', '::1', '2020-12-13 04:12:02'),
(38, '2', 'Unauthorised access on /grabify/profile.php', '::1', '2020-12-13 04:12:02'),
(39, '2', 'Unauthorised access on /grabify/profile.php', '::1', '2020-12-13 04:12:02'),
(40, '2', 'Unauthorised access on /grabify/profile.php', '::1', '2020-12-13 04:12:02'),
(41, '2', 'Unauthorised access on /grabify/profile.php', '::1', '2020-12-13 04:12:03'),
(42, '2', 'Unauthorised access on /grabify/profile.php', '::1', '2020-12-13 04:12:03'),
(43, '2', 'Unauthorised access on /grabify/profile.php', '::1', '2020-12-13 04:12:03'),
(44, '2', 'Unauthorised access on /grabify/profile.php', '::1', '2020-12-13 04:12:03'),
(45, '2', 'Unauthorised access on /grabify/profile.php', '::1', '2020-12-13 04:12:03'),
(46, '2', 'Unauthorised access on /grabify/profile.php', '::1', '2020-12-13 04:14:34'),
(47, '2', 'Unauthorised access on /grabify/profile.php', '::1', '2020-12-13 04:18:00'),
(48, '2', 'Unauthorised access on /grabify/profile.php', '::1', '2020-12-13 04:19:21'),
(49, '2', 'Unauthorised access on /grabify/profile.php', '::1', '2020-12-13 04:19:45'),
(50, '2', 'Unauthorised access on /grabify/profile.php', '::1', '2020-12-13 04:20:52'),
(51, '2', 'Unauthorised access on /grabify/profile.php', '::1', '2020-12-13 04:21:37'),
(52, '2', 'Unauthorised access on /grabify/profile.php', '::1', '2020-12-13 04:21:38'),
(53, '2', 'Unauthorised access on /grabify/profile.php', '::1', '2020-12-13 04:28:49'),
(54, '2', 'Unauthorised access on /grabify/profile.php', '::1', '2020-12-13 04:28:50'),
(55, '2', 'Unauthorised access on /grabify/profile.php', '::1', '2020-12-13 04:29:03'),
(56, '2', 'Unauthorised access on /grabify/profile.php', '::1', '2020-12-13 04:29:04'),
(57, '2', 'Unauthorised access on /grabify/profile.php', '::1', '2020-12-13 04:30:29'),
(58, '2', 'Unauthorised access on /grabify/profile.php', '::1', '2020-12-13 04:30:43'),
(59, '2', 'Unauthorised access on /grabify/profile.php', '::1', '2020-12-13 04:33:35'),
(60, '2', 'Unauthorised access on /grabify/profile.php', '::1', '2020-12-13 04:38:07'),
(61, '2', 'Unauthorised access on /grabify/profile.php', '::1', '2020-12-13 04:38:08'),
(62, '2', 'Unauthorised access on /grabify/profile.php', '::1', '2020-12-13 04:38:08'),
(63, '2', 'Unauthorised access on /grabify/profile.php', '::1', '2020-12-13 04:38:09'),
(64, '2', 'Unauthorised access on /grabify/profile.php', '::1', '2020-12-13 04:39:26'),
(65, '2', 'Unauthorised access on /grabify/profile.php', '::1', '2020-12-13 04:39:28'),
(66, '2', 'Unauthorised access on /grabify/profile.php', '::1', '2020-12-13 04:39:28'),
(67, '2', 'Unauthorised access on /grabify/profile.php', '::1', '2020-12-13 04:40:49'),
(68, '2', 'Unauthorised access on /swap-mylittlepony/profile.php', '::1', '2020-12-13 04:50:54'),
(69, '2', 'Unauthorised access on /swap-mylittlepony/profile.php', '::1', '2020-12-13 04:51:21'),
(70, '2', 'Unauthorised access on /swap-mylittlepony/profile.php', '::1', '2020-12-13 04:51:32');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_temp`
--

CREATE TABLE `password_reset_temp` (
  `password_reset_temp_id` int(11) NOT NULL,
  `email` varchar(45) NOT NULL,
  `csrfToken` varchar(250) NOT NULL,
  `exp_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `password_reset_temp`
--

INSERT INTO `password_reset_temp` (`password_reset_temp_id`, `email`, `csrfToken`, `exp_date`) VALUES
(1, 'a@a.com', '0e846eb5299faf5ff50ba237d84406e05ccf347a105d0e66e70a27d74ffe81265b3bb183c945c08cb5a9fb2e9acb1bc062c8b52751580b2022401207dca3106d', '2020-12-10 18:17:39'),
(2, 'bryansim02@gmail.com', '1f5899d6ad9458c84ec10b5444ffa3b7b80dec6dbebbe1aa3f24dbac27cf7376', '2020-12-14 08:11:54');

-- --------------------------------------------------------

--
-- Table structure for table `payment_info`
--

CREATE TABLE `payment_info` (
  `payment_info_id` int(11) NOT NULL,
  `Card_name` varchar(64) NOT NULL,
  `Card_number` int(16) NOT NULL,
  `expiry` varchar(5) NOT NULL,
  `users_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `price` double NOT NULL,
  `description` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `business_business_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `timestamp` datetime DEFAULT CURRENT_TIMESTAMP,
  `users_user_id` int(11) NOT NULL,
  `product_product_id` int(11) NOT NULL,
  `business_business_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `temp_user`
--

CREATE TABLE `temp_user` (
  `temp_user_id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(45) NOT NULL,
  `mobile_number` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `temp_user`
--

INSERT INTO `temp_user` (`temp_user_id`, `username`, `password`, `name`, `email`, `mobile_number`, `address`, `token`) VALUES
(9, 'a', '$2y$10$RqImFDETc1x7uDGgmitMTexDW5aPYq.kE9E80PEjLSp06kAU31/YK', 'a', 'a@a.a', 91234123, '123 e E', '8ae24dee6d4a99a3f90ddbff2ffcc79cdfd026b12bbf4e289813a6112ad40219');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(45) NOT NULL,
  `mobile_number` int(11) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `name`, `email`, `mobile_number`, `address`) VALUES
(2, 'bryan', '$2y$10$KouGCQ5cbrRPCdOiNniqweNekWxRNdFEwPX7K3TX3KpFfhssQ1LlS', 'bryan', 'bryansim02@gmail.com', 91234124, '123 Tamp St'),
(3, 'veruuuu', '$2y$10$zgqQl7QWLv1r95KcqzIdLOJsNhFxqR7HBdnXfnlXhzFdc5qd.48P.', 'veruuuuuuuuuuuuuuuuuuuuuuuuuuuuuuu', 'verilim3802@gmail.com', 81234123, '81 Tampines St'),
(4, 'b', '$2y$10$Y1cQt2O1SVkNRcPozbuFYOr9QdgeZCg.SHHz1pc7MDS2o5mdjsp16', 'test', 'bryansim02@gmail.com', 81234567, '123 A a'),
(6, 'd', '$2y$10$jO3OQffEA7AB7tcsNN5YmO3DQJgRmlPviHdnydvTm7bmuCNN1qB2K', 'd', 'd@d.com', 81234567, '123 D d'),
(9, 'vera', '$2y$10$DmfMIxDpTwE/834tjSHJH.Wcv82zp8xUvsAX7Q9gWbG5IzZZQWkke', 'veraaaaaaaaaaaaaaa', 'verilim3802@gmail.com', 91234123, '4 e E'),
(11, 'ichika', '$2y$10$Y1cQt2O1SVkNRcPozbuFYOr9QdgeZCg.SHHz1pc7MDS2o5mdjsp16', 'Igarashi Ichika', 'bryansim02@gmail.com', 91234123, '123 Tuas Ave');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_id_UNIQUE` (`admin_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `block_user`
--
ALTER TABLE `block_user`
  ADD PRIMARY KEY (`block_user_id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`),
  ADD UNIQUE KEY `booking_id_UNIQUE` (`booking_id`),
  ADD KEY `fk_booking_users1_idx` (`users_user_id`),
  ADD KEY `fk_booking_product1_idx` (`product_product_id`);

--
-- Indexes for table `business`
--
ALTER TABLE `business`
  ADD PRIMARY KEY (`business_id`),
  ADD UNIQUE KEY `business_id_UNIQUE` (`business_id`);

--
-- Indexes for table `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`fav_id`),
  ADD UNIQUE KEY `fav_id_UNIQUE` (`fav_id`),
  ADD KEY `fk_favorite_users1_idx` (`users_user_id`),
  ADD KEY `fk_favorite_product1_idx` (`product_product_id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `password_reset_temp`
--
ALTER TABLE `password_reset_temp`
  ADD PRIMARY KEY (`password_reset_temp_id`);

--
-- Indexes for table `payment_info`
--
ALTER TABLE `payment_info`
  ADD PRIMARY KEY (`payment_info_id`),
  ADD UNIQUE KEY `payment_info_id_UNIQUE` (`payment_info_id`),
  ADD KEY `fk_payment_info_users1_idx` (`users_user_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `product_id_UNIQUE` (`product_id`),
  ADD KEY `fk_product_business1_idx` (`business_business_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`),
  ADD UNIQUE KEY `review_id_UNIQUE` (`review_id`),
  ADD KEY `fk_review_users_idx` (`users_user_id`),
  ADD KEY `fk_review_product1_idx` (`product_product_id`),
  ADD KEY `fk_review_business1_idx` (`business_business_id`);

--
-- Indexes for table `temp_user`
--
ALTER TABLE `temp_user`
  ADD PRIMARY KEY (`temp_user_id`),
  ADD KEY `temp_user_id` (`temp_user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `idusers_UNIQUE` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `block_user`
--
ALTER TABLE `block_user`
  MODIFY `block_user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `business`
--
ALTER TABLE `business`
  MODIFY `business_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favorite`
--
ALTER TABLE `favorite`
  MODIFY `fav_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `password_reset_temp`
--
ALTER TABLE `password_reset_temp`
  MODIFY `password_reset_temp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment_info`
--
ALTER TABLE `payment_info`
  MODIFY `payment_info_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `temp_user`
--
ALTER TABLE `temp_user`
  MODIFY `temp_user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `fk_booking_product1` FOREIGN KEY (`product_product_id`) REFERENCES `product` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_booking_users1` FOREIGN KEY (`users_user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `favorite`
--
ALTER TABLE `favorite`
  ADD CONSTRAINT `fk_favorite_product1` FOREIGN KEY (`product_product_id`) REFERENCES `product` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_favorite_users1` FOREIGN KEY (`users_user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `payment_info`
--
ALTER TABLE `payment_info`
  ADD CONSTRAINT `fk_payment_info_users1` FOREIGN KEY (`users_user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_product_business1` FOREIGN KEY (`business_business_id`) REFERENCES `business` (`business_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `fk_review_business1` FOREIGN KEY (`business_business_id`) REFERENCES `business` (`business_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_review_product1` FOREIGN KEY (`product_product_id`) REFERENCES `product` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_review_users` FOREIGN KEY (`users_user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
