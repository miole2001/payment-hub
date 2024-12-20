-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 10, 2024 at 06:33 PM
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
-- Database: `payment_hub`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(80) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `date_registered` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `image`, `name`, `email`, `password`, `user_type`, `date_registered`) VALUES
(1, 'profile1.webp', 'user dormitory', 'user-dormitory@gmail.com', '1', 'user dormitory', '2024-10-25 16:14:48'),
(2, '', 'boat admin', 'boat@gmail.com', '1', 'boat admin', '2024-10-25 16:24:15'),
(4, '', 'dormitory admin', 'dormitory@gmail.com', '1', 'dormitory admin', '2024-10-25 16:24:15'),
(5, 'profile1.webp', 'user boat', 'user-boat@gmail.com', '1', 'user boat', '2024-10-25 16:14:48'),
(6, '', 'admin payment', 'admin@gmail.com', '1', 'payment admin', '2024-10-25 16:24:15');

-- --------------------------------------------------------

--
-- Table structure for table `boats`
--

CREATE TABLE `boats` (
  `b_id` int(11) NOT NULL,
  `b_name` varchar(35) NOT NULL,
  `b_cpcty` varchar(35) NOT NULL,
  `b_on` varchar(35) NOT NULL,
  `b_img` varchar(255) NOT NULL,
  `b_price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `boats`
--

INSERT INTO `boats` (`b_id`, `b_name`, `b_cpcty`, `b_on`, `b_img`, `b_price`) VALUES
(43, 'ora jackson', '25 Persons', 'rayleigh', '../boat_image/image_2016-02-26-11-33-39_56cfc793b356b.jpg', 3500),
(52, 'barko barko', '25 Persons', 'john dough', '../boat_image/image_2016-02-26-11-33-26_56cfc78667a8b.jpg', 3500),
(53, 'thre', '15 Persons', 'three name', '../boat_image/image_2016-02-26-11-33-58_56cfc7a61410a.jpg', 3000),
(54, 'boat four', '25 Persons', 'four name', '../boat_image/image_2016-02-26-11-34-18_56cfc7ba02940.jpg', 3500),
(55, 'boat five', '15 Persons', 'boat five name', '../boat_image/image_2016-02-26-11-34-36_56cfc7cc8ee91.jpg', 3000),
(56, 'ariana grandi', '30 Persons', 'justin beiber', '../boat_image/image_2016-02-26-11-35-29_56cfc8016ff83.jpg', 4000),
(57, 'idk', '25 Persons', 'luffy', '../boat_image/image_2016-02-26-11-35-54_56cfc81a68825.jpg', 3500),
(58, 'another boat', '15 Persons', 'brook', '../boat_image/image_2016-02-26-11-36-18_56cfc832eb45f.jpg', 3000),
(59, 'ggg', '15 Persons', 'ggg', '../boat_image/image_2016-02-26-11-36-31_56cfc83f7633d.jpg', 3000),
(60, 'hhh', '15 Persons', 'hh', '../boat_image/image_2016-02-26-11-36-42_56cfc84a8f88c.jpg', 3000),
(61, 'jjj', '30 Persons', 'jj', '../boat_image/image_2016-02-26-11-36-50_56cfc85230c90.jpg', 4000),
(62, 'lll', '15 Persons', 'lll', '../boat_image/image_2016-02-26-11-36-58_56cfc85a5d528.jpg', 3000),
(64, 'sakayan', '15 Persons', '11', '../boat_image/image_2016-02-26-11-40-36_56cfc934d9adc.jpg', 3000),
(65, 'no photo', '15 Persons', 'no photo', '../boat_image/image_2016-02-26-13-07-23_56cfdd8b089a9.jpg', 3000),
(66, 'hordy jones', '15 Persons', 'vander decken', '../boat_image/image_2016-02-26-13-07-07_56cfdd7bc03a9.jpg', 3000),
(74, 'SDFSD', '15 Persons', 'SDFSDFSDFSD', '../boat_image/image_2016-02-27-07-40-09_56d144c9c7018.jpg', 3000),
(76, 'price', '25 Persons', 'price', '../boat_image/image_2016-02-27-07-05-24_56d13ca4c57a8.jpg', 3500);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `activity_type` varchar(50) NOT NULL,
  `system_type` varchar(60) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `email`, `activity_type`, `system_type`, `timestamp`) VALUES
(2, 'user-dormitory@gmail.com', 'Login', 'user dormitory', '2024-10-26 18:36:27'),
(4, 'user-boat@gmail.com', 'Login', 'user boat', '2024-10-26 18:36:45'),
(6, 'boat@gmail.com', 'Login', 'boat admin', '2024-10-26 18:36:59'),
(8, 'dormitory@gmail.com', 'Login', 'dormitory admin', '2024-10-26 18:37:14'),
(9, 'admin@gmail.com', 'Login', 'payment admin', '2024-10-26 18:37:14');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `price` int(20) NOT NULL,
  `item` varchar(255) NOT NULL,
  `system_type` varchar(100) NOT NULL,
  `status` varchar(80) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `name`, `email`, `price`, `item`, `system_type`, `status`, `timestamp`) VALUES
(2, 'asa', 'test@gmail.com', 800, 'test', 'boat', 'approved', '2024-10-25 21:16:02'),
(3, 'asa', 'test@gmail.com', 800, 'test', 'dormitory', 'pending', '2024-10-25 21:16:26'),
(5, 'asa', 'test@gmail.com', 800, 'test', 'dormitory', 'approved', '2024-10-25 21:16:26'),
(7, 'asa', 'test@gmail.com', 800, 'test', 'boat', 'pending', '2024-10-25 21:15:49');

-- --------------------------------------------------------

--
-- Table structure for table `payment_list`
--

CREATE TABLE `payment_list` (
  `id` int(30) NOT NULL,
  `account_id` int(30) NOT NULL,
  `month_of` varchar(10) NOT NULL,
  `amount` float(12,2) NOT NULL DEFAULT 0.00,
  `status` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_list`
--

INSERT INTO `payment_list` (`id`, `account_id`, `month_of`, `amount`, `status`, `date_created`, `date_updated`) VALUES
(3, 1, '2022-04', 5000.00, 'pending', '2022-05-07 14:55:37', '2024-11-11 01:13:35'),
(4, 1, '2022-05', 5000.00, 'approved', '2022-05-07 14:58:27', '2024-11-11 01:13:46'),
(5, 2, '2022-05', 3500.00, 'pending', '2022-05-07 14:59:04', '2024-11-11 01:13:53');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `r_id` int(11) NOT NULL,
  `b_id` int(11) NOT NULL,
  `tour_id` int(11) NOT NULL,
  `r_dstntn` varchar(35) NOT NULL,
  `r_date` varchar(35) NOT NULL,
  `r_hr` varchar(35) NOT NULL,
  `r_ampm` varchar(35) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`r_id`, `b_id`, `tour_id`, `r_dstntn`, `r_date`, `r_hr`, `r_ampm`, `status`) VALUES
(1, 58, 6, 'as', '2024-10-29', '1', 'AM', 'approved'),
(2, 58, 6, 'as', '2024-10-29', '1', 'AM', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `tourist`
--

CREATE TABLE `tourist` (
  `tour_id` int(11) NOT NULL,
  `tour_fN` varchar(50) NOT NULL,
  `tour_mN` varchar(50) NOT NULL,
  `tour_lN` varchar(50) NOT NULL,
  `tour_address` varchar(255) NOT NULL,
  `tour_contact` varchar(15) NOT NULL,
  `tour_un` varchar(50) NOT NULL,
  `tour_up` varchar(35) NOT NULL,
  `user_type` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tourist`
--

INSERT INTO `tourist` (`tour_id`, `tour_fN`, `tour_mN`, `tour_lN`, `tour_address`, `tour_contact`, `tour_un`, `tour_up`, `user_type`) VALUES
(2, '', '', '', '', '', 'admin', '21232f297a57a5a743894a0e4a801fc3', '1'),
(6, 'as', 'a', 'as', 'as', '0923231', 'user', '81dc9bdb52d04dc20036dbd8313ed055', '2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `boats`
--
ALTER TABLE `boats`
  ADD PRIMARY KEY (`b_id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_list`
--
ALTER TABLE `payment_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`r_id`),
  ADD KEY `b_id` (`b_id`),
  ADD KEY `tour_id` (`tour_id`);

--
-- Indexes for table `tourist`
--
ALTER TABLE `tourist`
  ADD PRIMARY KEY (`tour_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `boats`
--
ALTER TABLE `boats`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payment_list`
--
ALTER TABLE `payment_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tourist`
--
ALTER TABLE `tourist`
  MODIFY `tour_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
