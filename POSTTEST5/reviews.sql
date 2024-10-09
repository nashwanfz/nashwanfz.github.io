-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2024 at 05:51 PM
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
-- Database: `reviews`
--

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `ID_User` int(11) NOT NULL,
  `Game` varchar(100) NOT NULL,
  `User` varchar(200) NOT NULL,
  `Review` varchar(255) NOT NULL,
  `Rating` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`ID_User`, `Game`, `User`, `Review`, `Rating`) VALUES
(1, 'Valorant', 'Nashwan', 'ojiwjijij', '1'),
(2, 'Valorant', 'Nashwan', 'ojiwjijij', '1'),
(3, 'Valorant', 'Nashwan', 'game memek', '1'),
(4, 'Valorant', 'Nashwan', 'keren', '10'),
(5, 'Valorant', 'Nashwan', 'n', '10'),
(6, 'Valorant', 'Nashwan', '10', '1'),
(7, 'Valorant', 'Nashwan', '11111', '10'),
(8, 'Valorant', 'Nashwan', '132', '9'),
(9, 'Valorant', 'Nashwan', '10', '1'),
(10, 'Valorant', 'Nashwan', '11', '2'),
(11, '1', '1', '1', '1'),
(12, '1', '1', '1', '1'),
(13, '1', '1', '1', '1'),
(14, '1', '1', '1', '1'),
(15, '1', '1', '1', '1'),
(16, '1', '1', '1', '1'),
(17, '1', '1', '1', '1'),
(18, '1', '1', '1', '1'),
(19, 'Valorant', 'Nashwan', '11', '1'),
(20, '1', '1', '1', '1'),
(21, '1', '1', '1', '1'),
(22, '1', '1', '2', '1'),
(23, '2', 'Nashwan', '3', '4'),
(24, '1', '1', '1', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`ID_User`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `ID_User` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
