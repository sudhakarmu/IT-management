-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 22, 2021 at 07:30 PM
-- Server version: 8.0.22-0ubuntu0.20.04.3
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bug_tracking`
--
CREATE DATABASE IF NOT EXISTS `bug_tracking` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `bug_tracking`;

-- --------------------------------------------------------

--
-- Table structure for table `bugs`
--

CREATE TABLE `bugs` (
  `id` int NOT NULL,
  `description` varchar(500) NOT NULL,
  `module_id` int NOT NULL,
  `priority` enum('Low','Medium','High','') NOT NULL DEFAULT 'Low',
  `status` enum('Active','Inactive','Resolved','Deleted','Ignored') NOT NULL DEFAULT 'Active',
  `raised_by` int NOT NULL,
  `assigned_to` int NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bugs`
--

INSERT INTO `bugs` (`id`, `description`, `module_id`, `priority`, `status`, `raised_by`, `assigned_to`, `created_on`, `modified_on`) VALUES
(1, 'Test Bug', 2, 'Medium', 'Active', 1, 2, '2021-01-22 08:20:49', '2021-01-22 13:50:49'),
(2, 'test bug 2', 1, 'Low', 'Active', 1, 2, '2021-01-22 11:32:48', '2021-01-22 17:02:48'),
(3, 'sdsdsd', 1, 'Low', 'Active', 2, 1, '2021-01-22 11:44:16', '2021-01-22 17:14:16'),
(4, ' test 3', 1, 'Medium', 'Active', 1, 2, '2021-01-22 11:44:33', '2021-01-22 17:14:33'),
(5, ' test edit', 5, 'Medium', 'Active', 1, 2, '2021-01-22 12:58:11', '2021-01-22 18:28:11'),
(6, ' test edit 3', 5, 'Medium', 'Active', 1, 2, '2021-01-22 13:03:21', '2021-01-22 18:33:21'),
(7, ' sdccscsc', 3, 'Medium', 'Active', 1, 2, '2021-01-22 13:25:27', '2021-01-22 18:55:27'),
(8, 'scscs', 3, 'Medium', 'Active', 1, 2, '2021-01-22 13:25:56', '2021-01-22 18:55:56');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_by` int NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `name`, `status`, `created_by`, `created_on`) VALUES
(1, 'Module 1', 'Active', 1, '2021-01-22 09:43:35'),
(2, 'Module 2', 'Active', 1, '2021-01-22 09:43:57'),
(3, 'Module 3', 'Active', 1, '2021-01-22 09:43:57'),
(4, 'Module 4', 'Active', 1, '2021-01-22 09:43:57'),
(5, 'Module 5', 'Active', 1, '2021-01-22 09:43:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_by` int NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `status`, `created_by`, `created_on`) VALUES
(1, 'Amit Raj', 'Active', 1, '2021-01-22 09:43:02'),
(2, 'Guru Prasad', 'Active', 1, '2021-01-22 09:43:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bugs`
--
ALTER TABLE `bugs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
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
-- AUTO_INCREMENT for table `bugs`
--
ALTER TABLE `bugs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
