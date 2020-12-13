-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2020 at 03:04 PM
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
CREATE DATABASE IF NOT EXISTS `grabify` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `grabify`;
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
  `start_time` varchar(45) DEFAULT NULL,
  `end_time` varchar(45)DEFAULT NULL,
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
   `category` varchar(9) NOT NULL,
  `users_user_id` int(11) NOT NULL,
  `product_product_id` int(11) NOT NULL
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
(6, '2', 'Continued attempts to login using \'f\' after being logged out in db ', '::1', '2020-12-11 13:07:38'),
(7, '2', 'Continued attempts to login using \'bryan\' after being logged out in db ', '::1', '2020-12-11 13:09:15'),
(8, '2', 'Continued attempts to login using \'bryan\' after being logged out in db ', '::1', '2020-12-11 13:10:13'),
(9, '2', 'Continued attempts to login using \'bryan\' after being logged out in db ', '::1', '2020-12-11 13:11:15'),
(10, '2', 'Continued attempts to login using \'bryan\' after being logged out in db ', '::1', '2020-12-11 13:11:17'),
(11, '2', 'Continued attempts to login using \'bryan\' after being logged out in db ', '::1', '2020-12-11 13:12:22'),
(12, '2', 'Continued attempts to login using \'bryan\' after being logged out in db ', '::1', '2020-12-11 13:13:15'),
(13, '2', 'Continued attempts to login using \'bryan\' after being logged out in db ', '::1', '2020-12-11 13:14:11'),
(14, '2', 'Continued attempts to login using \'bryan\' after being logged out in db ', '::1', '2020-12-11 13:14:22'),
(15, '2', 'Continued attempts to login using \'bryan\' after being logged out in db ', '::1', '2020-12-11 13:15:27');

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
(1, 'a@a.com', '0e846eb5299faf5ff50ba237d84406e05ccf347a105d0e66e70a27d74ffe81265b3bb183c945c08cb5a9fb2e9acb1bc062c8b52751580b2022401207dca3106d', '2020-12-10 18:17:39');

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
  `timestamp` datetime DEFAULT NULL,
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
(2, 'bryan', '$2y$10$vRNIn6avh5FP9HjSD2jHwuqSYiPWJqMAK3qWoO1Ap9boGc/lA7IcS', 'bryan', 'bryansim02@gmail.com', 91234124, '123 Tamp St'),
(3, 'veruuuu', '$2y$10$zgqQl7QWLv1r95KcqzIdLOJsNhFxqR7HBdnXfnlXhzFdc5qd.48P.', 'veruuuuuuuuuuuuuuuuuuuuuuuuuuuuuuu', 'verilim3802@gmail.com', 81234123, '81 Tampines St'),
(4, 'b', '$2y$10$l3H5mA4LaZroDRNdExzCHufSGxaHV8k2tMf7mAUv2w4A29InZ0TjW', 'test', 'verilim3802@gmail.com', 81234567, '123 A a'),
(5, 'c', '$2y$10$.p7A2A3645telw5wbIGzLuy2oIHq5SbIV1zwcMCpRgdcZKvBBXVDK', 'c', 'verilim3802@gmail.com', 81234567, '123 C c'),
(6, 'd', '$2y$10$jO3OQffEA7AB7tcsNN5YmO3DQJgRmlPviHdnydvTm7bmuCNN1qB2K', 'd', 'd@d.com', 81234567, '123 D d'),
(8, 'e', '$2y$10$vRNIn6avh5FP9HjSD2jHwuqSYiPWJqMAK3qWoO1Ap9boGc/lA7IcS', 'E', 'bryansim02@gmail.com', 91234123, '123 e E'),
(9, 'vera', '$2y$10$DmfMIxDpTwE/834tjSHJH.Wcv82zp8xUvsAX7Q9gWbG5IzZZQWkke', 'veraaaaaaaaaaaaaaa', 'verilim3802@gmail.com', 91234123, '4 e E'),
(10, 'f', '$2y$10$vRNIn6avh5FP9HjSD2jHwuqSYiPWJqMAK3qWoO1Ap9boGc/lA7IcS', 'f', 'bryansim02@gmail.com', 91234123, '123 F f'),
(11, 'ichika', '$2y$10$owsekvBIHTNdpXM3mAobxO.X46G9cNkUBpRdf3GNFB4W1V3pnrYAO', 'Igarashi Ichika', 'bryansim02@gmail.com', 91234123, '123 Tuas Ave');


INSERT INTO `admin` (`admin_id`, `username`, `password`, `role`) VALUES
(1, 'admin0', '$2y$10$A4or4RkbHD1f5emcyJza2ew3584UDFj77UYtdcX3aJWPR7rEJcUoC', '0'),
(2, 'admin1', '$2y$10$e/98e5Qgj4XX6.HMcgIIbeKt.T4w.ReSWxX28GQ1037l9PieIFaqO', '1'),
(3, 'admin2', '$2y$10$W6k7e4P1HbJ.RlZ2hdJ4Yuri5eTXWHEBVD4vTM1ZTsVsEUkuwHRUG', '2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_id_UNIQUE` (`admin_id`);

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
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `block_user`
--
ALTER TABLE `block_user`
  MODIFY `block_user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `password_reset_temp`
--
ALTER TABLE `password_reset_temp`
  MODIFY `password_reset_temp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `temp_user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
