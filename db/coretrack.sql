-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2025 at 07:44 AM
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
-- Database: `coretrack`
--

-- --------------------------------------------------------

--
-- Table structure for table `core_returns`
--

CREATE TABLE `core_returns` (
  `id` int(11) NOT NULL,
  `part_number` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `dealer_code` varchar(20) NOT NULL,
  `return_date` datetime DEFAULT current_timestamp(),
  `status` enum('Pending','Processed') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `core_returns`
--

INSERT INTO `core_returns` (`id`, `part_number`, `quantity`, `dealer_code`, `return_date`, `status`) VALUES
(3, 'XYZ789', 2, 'DLR-999', '2025-03-31 00:32:22', 'Pending'),
(4, 'ABC123', 1, 'DLR-001', '2025-03-31 00:32:34', 'Pending'),
(5, 'XYZ123', 2, 'DLR-001', '2025-03-31 00:40:38', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(20) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `id` int(11) NOT NULL,
  `dealer_code` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `pwd`, `id`, `dealer_code`) VALUES
('admin', '$2y$10$0StF/1GOSWN35zwytzDjZOOjj6PCCzSNCgwzk40Eij.KdoER7XbUq', 10, 'DLR-001'),
('test', '$2y$10$nvSFiNS1MSd/IkAOwYaOBuYJr0sSfpwEfvnVyytY7DWsHyMK0uouG', 13, 'DLR-999');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `core_returns`
--
ALTER TABLE `core_returns`
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
-- AUTO_INCREMENT for table `core_returns`
--
ALTER TABLE `core_returns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
