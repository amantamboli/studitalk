-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2022 at 12:59 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `blockreport`
--

CREATE TABLE `blockreport` (
  `reporter_id` int(11) NOT NULL,
  `reported_id` int(11) NOT NULL,
  `reportcount` int(11) NOT NULL,
  `blockstatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blockreport`
--

INSERT INTO `blockreport` (`reporter_id`, `reported_id`, `reportcount`, `blockstatus`) VALUES
(1271872372, 1209399903, 2, 0),
(1209399903, 1271872372, 4, 0),
(1271872372, 481004580, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `receiver_id` int(20) NOT NULL,
  `sender_id` int(20) NOT NULL,
  `msg` varchar(255) DEFAULT NULL,
  `hide` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `receiver_id`, `sender_id`, `msg`, `hide`) VALUES
(45, 796672580, 870773447, 'hi', 1),
(47, 870773447, 796672580, 'salut', NULL),
(48, 796672580, 870773447, 'ho', 1),
(49, 1271872372, 1209399903, 'hi', 1),
(50, 1271872372, 1209399903, 'hello', NULL),
(51, 1271872372, 1209399903, 'hi', 1),
(53, 1271872372, 1209399903, 'jjuj', 1),
(56, 1209399903, 1271872372, 'hi', NULL),
(57, 1209399903, 481004580, 'Hi', NULL),
(58, 481004580, 1209399903, 'hi', NULL),
(59, 1209399903, 1271872372, 'I like python!', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `public_key` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `preferences` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `public_key` int(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `otp` int(11) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `tokenexpired` varchar(255) DEFAULT NULL,
  `preferences` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `otpexp` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `public_key`, `username`, `email`, `password`, `otp`, `token`, `tokenexpired`, `preferences`, `img`, `otpexp`) VALUES
(36, 1209399903, 'seb', 'johnshelby392@gmail.com', '$2y$10$Bp/QO2ylOvSvLZmj/bIzp.hnR4pudAKErSKo8I1mjtWWPgQxK1vj6', 979245, NULL, NULL, 'python html', '1641568255Untitled design.png', '2022-01-11 11:41'),
(37, 1271872372, 'max', 'tommyshelby392@gmail.com', '$2y$10$VF4BJwSt0cb5//UhWGRRs.A.ddjQr/VVA48NpIJFmCgJleITZDLeO', 761628, NULL, NULL, 'python html', '1641553384mx.jpg', '2022-01-12 03:50'),
(38, 481004580, 'Aman', 'amantamboli128@gmail.com', '$2y$10$SZOGgQaY6eE/OQ7EQU79G.8hFlvU/nahwEpQGMrWGkbo098y8/.Im', 348410, NULL, NULL, 'html', '1641924497seb.jpg', '2022-01-11 11:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
