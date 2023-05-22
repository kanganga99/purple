-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2023 at 07:37 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `receipt`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(128) NOT NULL,
  `companyname` varchar(255) NOT NULL,
  `phonenumber` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `companyid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `companyname`, `phonenumber`, `email`, `password`, `companyid`) VALUES
(1, 'testing', '0702345678', 'testing@gmail.com', '9ad574806427070b94735f216e9abdc1', '517951');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(255) NOT NULL,
  `classname` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `companyid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `classname`, `level`, `companyid`) VALUES
(7, 'Three West', 'FirstTerm', '517951'),
(8, 'Four North', 'Third Term', '517951'),
(9, 'Eight South', '2nd Term', '517951');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(255) NOT NULL,
  `companyname` varchar(255) DEFAULT NULL,
  `companyid` varchar(255) DEFAULT NULL,
  `phonenumber` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `companyname`, `companyid`, `phonenumber`, `created_at`) VALUES
(7, 'testing', '517951', '0702345678', '2023-03-27 14:49:58');

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `id` int(255) NOT NULL,
  `class_id` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `classname` varchar(255) NOT NULL,
  `companyid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fees`
--

INSERT INTO `fees` (`id`, `class_id`, `description`, `amount`, `classname`, `companyid`) VALUES
(1, '7', 'tuition', '5000', 'Three West', '517951'),
(2, '8', 'dede', '600', 'Four North', '517951'),
(3, '8', 'ddede', '4500', 'Four North', '517951'),
(4, '7', 'dental clinic', '450', 'Three West', '517951'),
(5, '9', 'reasdr', '590', 'Eight South', '517951');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `studentname` varchar(255) NOT NULL,
  `religion` varchar(255) NOT NULL,
  `phonenumber` varchar(255) NOT NULL,
  `student_id` varchar(25) NOT NULL,
  `class_id` int(255) NOT NULL,
  `uploads` varchar(255) NOT NULL,
  `classname` varchar(255) NOT NULL,
  `companyid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `studentname`, `religion`, `phonenumber`, `student_id`, `class_id`, `uploads`, `classname`, `companyid`) VALUES
(14, 'Tom', 'Christian', '0741770747', '5299', 7, '[\"../assets/images/Invoice20_03763 (4).pdf\"]', 'Three West', '517951'),
(15, 'kanganga', 'Christian', '0712204319', '4343', 9, '[\"../assets/images/6767tttt.pdf\"]', 'Eight South', '517951');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(255) NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `class_id` int(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `companyid` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `student_id`, `class_id`, `amount`, `remarks`, `companyid`, `date_created`) VALUES
(19, '5299', 7, '6000', 'fee', '517951', '2023-03-27 15:00:34'),
(20, '5299', 7, '6000', 'redasde', '517951', '2023-04-17 10:21:52'),
(21, '5299', 7, '500', 'wws', '517951', '2023-04-17 10:22:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fees`
--
ALTER TABLE `fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`,`student_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
