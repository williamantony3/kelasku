-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2020 at 11:18 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kelasku`
--

-- --------------------------------------------------------

--
-- Table structure for table `absendetail`
--

CREATE TABLE `absendetail` (
  `Date` date NOT NULL,
  `NIM` varchar(15) NOT NULL,
  `AbsenTime` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `absendetail`
--

INSERT INTO `absendetail` (`Date`, `NIM`, `AbsenTime`) VALUES
('2020-04-08', '2201827704', '08:00:01'),
('2020-04-09', '2201827704', NULL),
('2020-04-09', '2201827705', '07:37:00'),
('2020-04-09', '2201827706', '07:00:00'),
('2020-04-09', '2201827707', '08:00:01');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `NIM` varchar(15) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(25) NOT NULL,
  `Email` varchar(75) NOT NULL,
  `Role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`NIM`, `Name`, `Username`, `Password`, `Email`, `Role`) VALUES
('2201827704', 'Vincent Gunawan', 'lalala', '123', 'sutil@gmail.com', 0),
('2201827707', 'William Anthony', 'fakboy', '123', 'legenda@gmail.com', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absendetail`
--
ALTER TABLE `absendetail`
  ADD PRIMARY KEY (`Date`,`NIM`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`NIM`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
