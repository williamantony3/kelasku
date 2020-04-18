-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2020 at 02:10 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

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
  `NIM` varchar(10) NOT NULL,
  `AbsenTime` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `absendetail`
--

INSERT INTO `absendetail` (`Date`, `NIM`, `AbsenTime`) VALUES
('2020-04-10', '2201828070', '07:00:00'),
('2020-04-11', '2201827673', '07:49:00'),
('2020-04-11', '2201827963', '08:02:00'),
('2020-04-11', '2201828064', '07:00:00'),
('2020-04-11', '2201828070', '07:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Date` date NOT NULL,
  `Time` time NOT NULL,
  `Place` varchar(50) NOT NULL,
  `Note` text NOT NULL,
  `NIM` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`ID`, `Name`, `Date`, `Time`, `Place`, `Note`, `NIM`) VALUES
(8, 'Lari Pagi', '2020-04-23', '07:00:00', 'Taman Venesia Sentul', 'Ayo lari', '2201827673'),
(9, 'Bukber', '2020-05-01', '18:30:00', 'Stall', 'Makan', '2201827673');

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `ID` int(11) NOT NULL,
  `Path` text NOT NULL,
  `NIM` varchar(10) NOT NULL,
  `UploadTime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `file`
--

INSERT INTO `file` (`ID`, `Path`, `NIM`, `UploadTime`) VALUES
(1, 'materials/HCI', '2201827673', '2020-04-18 03:01:14'),
(2, 'materials/HCI/Pert10-Prototype.pptx', '2201827673', '2020-04-18 03:02:04'),
(3, 'assignments/SL 1 HCI', '2201827673', '2020-04-18 03:03:12'),
(4, 'assignments/SL 1 HCI/2201827673.zip', '2201827673', '2020-04-18 03:03:26'),
(5, 'assignments/SL 1 HCI/2201827674.zip', '2201827673', '2020-04-18 03:04:04'),
(6, 'assignments/SL 1 HCI/2201827673.zip', '2201827673', '2020-04-18 03:04:22'),
(7, 'materials/ASD', '2201827673', '2020-04-18 09:12:13'),
(8, 'materials/ASD/20181106133822_2nd ASD - Introduction to Scrum - R1.pptx', '2201827673', '2020-04-18 09:41:22'),
(9, 'materials/ASD/20181106133822_2nd ASD - Introduction to Scrum - R1.pptx', '2201827673', '2020-04-18 09:41:22'),
(10, 'materials/ASD/20181011135326_Task ASD 1.docx', '2201827673', '2020-04-18 09:41:48'),
(11, 'materials/ASD/20181011135326_Task ASD 1.docx', '2201827673', '2020-04-18 09:41:48'),
(12, 'materials/ASD/20181011135354_Task ASD 2.docx', '2201827673', '2020-04-18 09:43:44'),
(13, 'materials/ASD/20181011135424_Task ASD 3.docx', '2201827673', '2020-04-18 09:44:24'),
(14, 'materials/ASD/20181011135455_Task ASD 4.docx', '2201827673', '2020-04-18 09:45:14'),
(15, 'materials/ASD/20181011135455_Task ASD 4.docx', '2201827673', '2020-04-18 09:45:59'),
(16, 'materials/ASD/ProductBacklog.zip', '2201827673', '2020-04-18 09:49:36'),
(17, 'materials/ASD/.docx', '2201827673', '2020-04-18 09:51:40'),
(18, 'assignments/SL 5 HCI', '2201827673', '2020-04-18 10:18:40'),
(19, 'assignments/SL 5 HCI/2201827673.zip', '2201827673', '2020-04-18 10:22:55'),
(20, 'assignments/SL 5 HCI/2201827674.zip', '2201827673', '2020-04-18 10:23:05'),
(21, 'assignments/SL 5 HCI/2201827673.zip', '2201827673', '2020-04-18 10:26:11'),
(22, 'assignments/SL 1 HCI/2201827856.zip', '2201827856', '2020-04-18 11:32:08'),
(23, 'assignments/SL 1 HCI/2201827674.zip', '2201827673', '2020-04-18 11:33:59'),
(24, 'assignments/SL 5 HCI/2201827673.zip', '2201827673', '2020-04-18 11:34:56'),
(25, 'assignments/SL 6 HCI', '2201827673', '2020-04-18 11:44:31'),
(26, 'assignments/SL 7 HCI', '2201827673', '2020-04-18 11:45:21'),
(27, 'assignments/SL 6 HCI/2201827673.zip', '2201827673', '2020-04-18 11:45:50'),
(28, 'assignments/SL 7 HCI/2201827673.zip', '2201827673', '2020-04-18 11:46:08'),
(29, 'assignments/SL 7 HCI/2201827674.zip', '2201827673', '2020-04-18 11:46:29'),
(30, 'assignments/SL 7 HCI/2201827673.zip', '2201827673', '2020-04-18 11:46:38'),
(31, 'materials/OS', '2201827673', '2020-04-18 11:49:23'),
(32, 'materials/OS/pert5.zip', '2201827673', '2020-04-18 11:49:38'),
(33, 'materials/OS/canvas.zip', '2201827673', '2020-04-18 11:50:08'),
(34, 'materials/OS/canvass.zip', '2201827673', '2020-04-18 11:50:18'),
(35, 'materials/OS', '2201827673', '2020-04-18 12:06:45'),
(36, 'materials/HCI', '2201827673', '2020-04-18 12:06:50'),
(37, 'materials/ASD', '2201827673', '2020-04-18 12:06:56'),
(38, 'materials/HCI/canvas.zip', '2201827673', '2020-04-18 12:07:09');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `ID` int(11) NOT NULL,
  `NIM` varchar(10) NOT NULL,
  `Message` text NOT NULL,
  `Type` int(11) NOT NULL,
  `Content` text NOT NULL,
  `Time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`ID`, `NIM`, `Message`, `Type`, `Content`, `Time`) VALUES
(1, '2201827673', 'asdasdasd', 0, 'materials/Human Computer Interaction/00_KAK_SayembaraUIUX_JabarProv.pdf', '2020-04-14 08:54:27'),
(2, '2201827673', 'Halo ini ada materi baru nih', 0, 'materials/Human Computer Interaction/bandung.docx', '2020-04-14 09:41:10'),
(3, '2201827673', 'ada materi lagi gais', 0, 'materials/Human Computer Interaction/biaya lomba findit.xlsx', '2020-04-14 10:52:28'),
(4, '2201827673', 'Materi dari bu Zulfany', 0, 'materials/ASD/20181106133822_2nd ASD - Introduction to Scrum - R1.pptx', '2020-04-14 15:30:58'),
(5, '2201827736', 'materi lagi gais ASD', 0, 'materials/ASD/20181106133822_2nd ASD - Introduction to Scrum - R1.pptx', '2020-04-14 15:41:19'),
(6, '2201827736', 'Materi ASD nih', 0, 'materials/ASD/20181106144351_1st ASD - Introduction to Agile Approach - R1.pptx', '2020-04-14 15:48:28'),
(7, '2201827843', 'ada materi dari bu Zulfany', 0, 'materials/ASD/20181011135326_Task ASD 1 tes.docx', '2020-04-14 15:48:56'),
(11, '2201827673', 'Ayo lari', 1, '8', '2020-04-17 17:00:43'),
(12, '2201827673', 'Ini nih PPT dari Ibu Irene!', 0, 'materials/HCI/Pert10-Prototype.pptx', '2020-04-18 03:02:04'),
(15, '2201827673', 'Makan', 1, '9', '2020-04-18 08:53:14'),
(20, '2201827673', 'testset', 0, 'materials/ASD/20181106133822_2nd ASD - Introduction to Scrum - R1.pptx', '2020-04-18 09:41:22'),
(21, '2201827673', 'testset', 0, 'materials/ASD/20181106133822_2nd ASD - Introduction to Scrum - R1.pptx', '2020-04-18 09:41:22'),
(22, '2201827673', 'ter', 0, 'materials/ASD/.docx', '2020-04-18 09:41:48'),
(23, '2201827673', 'ter', 0, 'materials/ASD/.docx', '2020-04-18 09:41:48'),
(24, '2201827673', 'asdas', 0, 'materials/ASD/20181011135354_Task ASD 2.docx', '2020-04-18 09:43:44'),
(25, '2201827673', 'dasdasdas', 0, 'materials/ASD/20181011135424_Task ASD 3.docx', '2020-04-18 09:44:24'),
(26, '2201827673', 'sfsdfsdf', 0, 'materials/ASD/20181011135455_Task ASD 4.docx', '2020-04-18 09:45:14'),
(27, '2201827673', 'dasdasdasddasdasd', 0, 'materials/ASD/20181011135455_Task ASD 4.docx', '2020-04-18 09:45:59'),
(28, '2201827673', 'dasd', 0, 'materials/ASD/ProductBacklog.zip', '2020-04-18 09:49:36'),
(33, '2201827673', 'dasdas', 0, 'materials/OS/pert5.zip', '2020-04-18 11:49:38'),
(34, '2201827673', 'saSAs', 0, 'materials/OS/canvass.zip', '2020-04-18 11:50:07'),
(36, '2201827673', 'Ada materi baru nih', 0, 'materials/HCI/canvas.zip', '2020-04-18 12:07:09');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `NIM` varchar(10) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Role` int(11) NOT NULL,
  `SeatNumber` int(11) NOT NULL,
  `ProfilePicture` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`NIM`, `Name`, `Username`, `Password`, `Email`, `Role`, `SeatNumber`, `ProfilePicture`) VALUES
('2201827641', 'Nathanael Geordie', 'nathanael', 'd27ba11620b07630f8d301a2af03d956', 'nathanael@gmail.com', 0, 4, ''),
('2201827654', 'Renaldy Gunivon', 'renaldy', '52aa83b5329cf6cdcd51685bd7c92cf6', 'renaldy@gmail.com', 0, 11, ''),
('2201827660', 'Choirunnisa Putri', 'choirunnisa', 'd41816b06365f92c7cdbe28d4ab60044', 'choirunnisa@gmail.com', 0, 38, ''),
('2201827673', 'William Antony', 'william', 'fd820a2b4461bddd116c1518bc4b0f77', 'williamantony@ymail.com', 1, 32, 'users/2201827673.jpg'),
('2201827686', 'Widya Indriani', 'widya', 'widya', 'widya@gmail.com', 0, 22, ''),
('2201827692', 'Vincentius Gandhi', 'vincentius', '2d25a31c64ed579df9a64a7225971310', 'vincentius@gmail.com', 0, 6, ''),
('2201827704', 'Vincent Gunawan', 'vincent', 'b15ab3f829f0f897fe507ef548741afb', 'vincent@binus.ac.id', 0, 33, ''),
('2201827710', 'Verina Armelia', 'verina', 'd30b8aec1899bb680de370c9b4df9acd', 'verina@gmail.com', 0, 23, ''),
('2201827723', 'Timothy Nathanael', 'timothy', 'ecb97d53d2d35b8ba98cf82a8d78cad9', 'timothy@gmail.com', 0, 18, ''),
('2201827736', 'Steven Lavinske', 'steven', '6ed61d4b80bb0f81937b32418e98adca', 'steven@gmail.com', 1, 21, ''),
('2201827742', 'Sharen Sugiarto', 'sharen', '2d47e600e1958b2341e7b46ca67be0e5', 'sharen@gmail.com', 0, 26, ''),
('2201827755', 'Rosayanti Efata', 'rosayanti', 'e96ad9325984667a032d12c31a3706da', 'rosayanti@gmail.com', 0, 14, ''),
('2201827761', 'Rendi', 'rendi', 'd209fc47646bba5e5fdc3d3bbaad4b9c', 'rendi@gmail.com', 0, 3, ''),
('2201827774', 'Prasmadhani', 'prasmadhani', 'bd36d7ae34913ec78348a02aed24ae8d', 'prasmadhani@gmail.com', 0, 24, ''),
('2201827780', 'Nico Ardian', 'nico', '410ec15153a6dff0bed851467309bcbd', 'nico@gmail.com', 0, 25, ''),
('2201827793', 'Natasha Wijaya', 'natasha', '6275e26419211d1f526e674d97110e15', 'natasha@gmail.com', 0, 16, ''),
('2201827805', 'Marcel Julian', 'marcel', '24dde05168c24253ce9fec0fddd1e48d', 'marcel@gmail.com', 0, 42, ''),
('2201827811', 'Kevin Lesmana', 'kevin', '9d5e3ecdeb4cdb7acfd63075ae046672', 'kevin@gmail.com', 0, 7, ''),
('2201827824', 'Kelvin Chandra', 'kelvin', 'b2c6de510d584484d74c9aa9f8fa9f04', 'kelvin@gmail.com', 0, 35, ''),
('2201827830', 'Jovan Reynardo', 'jovan', 'b59c6e9b344bae1a36fe427a42889265', 'jovan@gmail.com', 0, 8, ''),
('2201827843', 'Jason Yonathan', 'jason', '2b877b4b825b48a9a0950dd5bd1f264d', 'jason@gmail.com', 1, 1, ''),
('2201827856', 'Harry Wijaya', 'harry', '3b87c97d15e8eb11e51aa25e9a5770e9', 'harry@gmail.com', 0, 5, ''),
('2201827862', 'Gede Ananta Puspayoga', 'gede', '13ad65cc032d4b04927943c33673a65d', 'gede@gmail.com', 0, 41, ''),
('2201827875', 'Gabrielle Daniella', 'gabrielle', '01b4aa2504786a6abb782dfd5d59f689', 'gabrielle@gmail.com', 0, 20, ''),
('2201827881', 'Febi Mettasari', 'febi', 'bd039fb0c1e7345572582b0cfde4c132', 'febi@gmail.com', 0, 12, ''),
('2201827894', 'Edrio', 'edrio', 'c536e15b19ed00cc636ce5e112c745d6', 'edrio@gmail.com', 0, 27, ''),
('2201827906', 'Edgar Mananta', 'edgar', '6b1d24ff83a319070db95c6c84b9be31', 'edgar@gmail.com', 0, 34, ''),
('2201827912', 'Deka Thomas', 'deka', '57ef16a773d505292b52918bcd6d8d29', 'deka@gmail.com', 0, 13, ''),
('2201827925', 'David Aditya', 'david', '172522ec1028ab781d9dfd17eaca4427', 'david@gmail.com', 0, 19, ''),
('2201827931', 'Cindy Priscilla', 'cindy', 'cc4b2066cfef89f2475de1d4da4b29c7', 'cindy@gmail.com', 0, 37, ''),
('2201827944', 'Christian Bryan', 'christian', '7ff135854376850e9711bd75ce942e07', 'christian@gmail.com', 0, 43, ''),
('2201827950', 'Chandra Halim', 'chandra', 'ad845a24a47deecbfa8396e90db75c6a', 'chandra@gmail.com', 0, 39, ''),
('2201827963', 'Candra Wijaya', 'candra', '2614ae3c375c3095dc536283672548bd', 'candra@gmail.com', 0, 40, ''),
('2201827976', 'Calvin', 'calvin', 'e6e66b8981c1030d5650da159e79539a', 'calvin@gmail.com', 0, 10, ''),
('2201827982', 'Billie Johannes Lee', 'billie', '984fe689d52f9b1259f559975d5fbeb1', 'billie@gmail.com', 0, 29, ''),
('2201827995', 'Angelica Halim', 'angelica', '5903d9e9a8884c8c04ad16559446735a', 'angelica@gmail.com', 0, 17, ''),
('2201828000', 'Andrew Osmond', 'andrew', 'd914e3ecf6cc481114a3f534a5faf90b', 'andrew@gmail.com', 0, 30, ''),
('2201828026', 'Alvin Tanjaya', 'alvin', '9573534ee6a886f4831ac5bcdfe85565', 'alvin@gmail.com', 0, 31, ''),
('2201828032', 'Alexius Pangestu', 'alexius', '670d7294e8349de0a5034739dd1246a4', 'alexius@gmail.com', 0, 36, ''),
('2201828045', 'Alexander Agung', 'alexander', 'dd22141acb5ea065acd5ed773729c98f', 'alexander@gmail.com', 0, 2, ''),
('2201828051', 'Aldi', 'aldi', '5cf15fc7e77e85f5d525727358c0ffc9', 'aldi@gmail.com', 0, 28, ''),
('2201828064', 'Adhika Nandatio', 'adhika', '7915cbc884216e0d84f1c50941fbb2f6', 'adhika@binus.ac.id', 0, 9, ''),
('2201828070', 'Abednego Frami', 'abednego', '81895dbc8c783edfb7f8a2ce39afae5e', 'abednego@gmail.com', 0, 15, '');

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
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`ID`);

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
