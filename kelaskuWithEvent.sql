-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2020 at 07:47 AM
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
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `EventID` int(11) NOT NULL,
  `EventTitle` varchar(50) NOT NULL,
  `StartDate` datetime NOT NULL,
  `EndDate` datetime NOT NULL,
  `Place` varchar(255) NOT NULL,
  `Note` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`EventID`, `EventTitle`, `StartDate`, `EndDate`, `Place`, `Note`) VALUES
(1, 'Panitia Party', '2020-04-24 09:00:00', '2020-04-24 12:00:00', 'BLI', 'Urgent'),
(2, 'Bukber', '2020-04-24 18:00:00', '2020-04-24 18:00:00', 'Udayana', 'Selagi Corona'),
(4, 'Panitia Outing', '2020-04-21 18:00:00', '2020-04-21 09:00:00', 'Home', 'Urgent'),
(5, 'Boleh pulang', '2020-04-16 09:00:00', '2020-04-16 10:00:00', 'Bandara', 'Selagi Corona'),
(6, 'Kuy sate', '2020-04-28 09:00:00', '2020-04-28 09:00:00', 'BLI', 'Selagi Corona'),
(8, 'Pacaran', '2020-04-28 09:00:00', '2020-04-28 10:00:00', 'BLI', 'Gaskun'),
(9, 'Hunting Pacar Orang', '2020-04-02 18:00:00', '2020-04-02 18:00:00', 'BLI', 'Selagi Corona'),
(10, 'Hunting Pacar Orang2', '2020-04-03 18:00:00', '2020-04-03 18:00:00', 'BLI', 'Selagi Corona');

-- --------------------------------------------------------

--
-- Table structure for table `eventdetail`
--

CREATE TABLE `eventdetail` (
  `EventID` int(11) NOT NULL,
  `NIM` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `eventdetail`
--

INSERT INTO `eventdetail` (`EventID`, `NIM`) VALUES
(1, '2201827704'),
(2, '2201827704'),
(3, '2201827704'),
(4, '2201827703'),
(8, '2201827704'),
(8, '2201827707'),
(9, '2201827704'),
(9, '2201827707'),
(10, '2201827704'),
(10, '2201827707');

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `FileID` int(11) NOT NULL,
  `FileName` varchar(200) NOT NULL,
  `Path` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `file`
--

INSERT INTO `file` (`FileID`, `FileName`, `Path`) VALUES
(1, '2201827704-1. Hidden Markov Model.pptx', 'C:/xampp/htdocs/uploads/HCI/2201827704-1. Hidden Markov Model.pptx'),
(2, '2201827707-[Rev] Normalization Session 03.docx', 'C:/xampp/htdocs/uploads/HCI/2201827707-[Rev] Normalization Session 03.docx'),
(3, '2201827704-107832.jpg', 'C:/xampp/htdocs/kelasku/uploads/HCI/2201827704-107832.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `filehistory`
--

CREATE TABLE `filehistory` (
  `FileID` int(11) NOT NULL,
  `NIM` varchar(15) NOT NULL,
  `UploadTime` datetime NOT NULL,
  `ActionType` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `filehistory`
--

INSERT INTO `filehistory` (`FileID`, `NIM`, `UploadTime`, `ActionType`) VALUES
(1, '2201827704', '2020-04-11 11:23:08', 0),
(2, '2201827707', '2020-04-11 12:20:06', 0),
(3, '2201827704', '2020-04-11 12:27:16', 0);

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
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`EventID`);

--
-- Indexes for table `eventdetail`
--
ALTER TABLE `eventdetail`
  ADD PRIMARY KEY (`EventID`,`NIM`);

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`FileID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`NIM`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `EventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `FileID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
