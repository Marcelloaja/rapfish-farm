-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2024 at 04:15 AM
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
-- Database: `finfantasy`
--

-- --------------------------------------------------------

--
-- Table structure for table `md_role`
--

CREATE TABLE `md_role` (
  `ID_ROLE` int(11) NOT NULL,
  `ROLE` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `md_role`
--

INSERT INTO `md_role` (`ID_ROLE`, `ROLE`) VALUES
(1, 'Admin'),
(2, 'Pengguna');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID_USER` varchar(25) NOT NULL,
  `NAMA_USER` text NOT NULL,
  `EMAIL` varchar(150) NOT NULL,
  `PASSWORD` text NOT NULL,
  `ID_ROLE` int(11) NOT NULL DEFAULT 2,
  `LOG_TIME` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID_USER`, `NAMA_USER`, `EMAIL`, `PASSWORD`, `ID_ROLE`, `LOG_TIME`) VALUES
('USR_DMNdb7', 'admin', 'admin@gmail.com', '1sampai8', 1, '2024-06-27 14:23:44'),
('USR_MRCLa2f', 'Marcello', 'marcello@gmail.com', 'marcello', 2, '2024-06-27 06:53:42'),
('USR_SR653', 'user123', 'user123@gmail.com', '1sampai8', 2, '2024-06-27 14:45:38'),
('USR_SRe86', 'user', 'user@gmail.com', 'user', 2, '2024-06-27 14:45:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `md_role`
--
ALTER TABLE `md_role`
  ADD PRIMARY KEY (`ID_ROLE`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID_USER`),
  ADD KEY `user_ID_USER_IDX` (`ID_USER`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `md_role`
--
ALTER TABLE `md_role`
  MODIFY `ID_ROLE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
