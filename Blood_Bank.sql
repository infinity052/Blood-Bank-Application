-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2020 at 04:47 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blood_bank`
--
CREATE DATABASE IF NOT EXISTS `blood_bank` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `blood_bank`;

-- --------------------------------------------------------

--
-- Table structure for table `blood_samples`
--

CREATE TABLE `blood_samples` (
  `id` int(11) NOT NULL,
  `type` varchar(3) NOT NULL,
  `hospital_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blood_samples`
--

INSERT INTO `blood_samples` (`id`, `type`, `hospital_id`) VALUES
(12, 'B+', 1),
(13, 'O+', 1),
(19, 'AB+', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hospitals`
--

CREATE TABLE `hospitals` (
  `id` int(11) NOT NULL,
  `userid` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `name` varchar(200) CHARACTER SET utf8mb4 NOT NULL,
  `address` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hospitals`
--

INSERT INTO `hospitals` (`id`, `userid`, `password`, `name`, `address`) VALUES
(1, 'max@123', '$2y$10$GTd1aezQeX/cefXt..bSKuZcfFY.1aBnET90p3j8VENDttBgBVr7W', 'Max hospital', 'Shalimar Bagh'),
(2, 'fortis@123', '$2y$10$dltqfXicyl2sj2wRwiqMuORRMnVJy8wRt0ToMf.joLDEe06tN1Gye', 'Fortis Hospital', 'shalimar bagh');

-- --------------------------------------------------------

--
-- Table structure for table `receivers`
--

CREATE TABLE `receivers` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `firstname` varchar(200) DEFAULT NULL,
  `lastname` varchar(200) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `blood_group` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `receivers`
--

INSERT INTO `receivers` (`id`, `username`, `password`, `firstname`, `lastname`, `email`, `blood_group`) VALUES
(3, 'aayushhjain23', '$2y$10$ZD76eOAQ..faW4g603CwFu2jOo8zI/VzpE1fFIl7F6Alz0AbdJjCS', 'Ayush', 'Jain', 'aayushhjain23@gmail.com', 'B+'),
(4, 'sadsad', '$2y$10$/QrThgk64c9yrSejdOODTO8gRnvqyMcVthQx606HGB8Agg.6X4zUe', 'asds', 'sadsad', 'asdas', 'O-');

-- --------------------------------------------------------

--
-- Table structure for table `sample_requests`
--

CREATE TABLE `sample_requests` (
  `id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `sample_id` int(11) NOT NULL,
  `hospital_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sample_requests`
--

INSERT INTO `sample_requests` (`id`, `receiver_id`, `sample_id`, `hospital_id`) VALUES
(18, 3, 12, 1),
(19, 3, 13, 1),
(20, 3, 12, 1),
(22, 3, 12, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blood_samples`
--
ALTER TABLE `blood_samples`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hospitals`
--
ALTER TABLE `hospitals`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userid` (`userid`);

--
-- Indexes for table `receivers`
--
ALTER TABLE `receivers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `sample_requests`
--
ALTER TABLE `sample_requests`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blood_samples`
--
ALTER TABLE `blood_samples`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `hospitals`
--
ALTER TABLE `hospitals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `receivers`
--
ALTER TABLE `receivers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sample_requests`
--
ALTER TABLE `sample_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
