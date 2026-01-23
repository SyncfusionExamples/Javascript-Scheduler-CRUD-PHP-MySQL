-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2026 at 10:30 AM
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
-- Database: `scheduledb`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `Id` int(11) NOT NULL,
  `Subject` varchar(200) DEFAULT NULL,
  `StartTime` datetime NOT NULL,
  `EndTime` datetime NOT NULL,
  `StartTimezone` varchar(200) DEFAULT NULL,
  `EndTimezone` varchar(200) DEFAULT NULL,
  `Location` varchar(200) DEFAULT NULL,
  `Description` varchar(200) DEFAULT NULL,
  `IsAllDay` bit(1) NOT NULL,
  `RecurrenceID` int(11) DEFAULT NULL,
  `FollowingID` int(11) DEFAULT NULL,
  `RecurrenceRule` varchar(200) DEFAULT NULL,
  `RecurrenceException` varchar(200) DEFAULT NULL,
  `IsReadonly` bit(1) DEFAULT NULL,
  `IsBlock` bit(1) DEFAULT NULL,
  `RoomID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`Id`, `Subject`, `StartTime`, `EndTime`, `StartTimezone`, `EndTimezone`, `Location`, `Description`, `IsAllDay`, `RecurrenceID`, `FollowingID`, `RecurrenceRule`, `RecurrenceException`, `IsReadonly`, `IsBlock`, `RoomID`) VALUES
(1, 'Meeting', '2026-01-16 00:00:00', '2026-01-17 00:00:00', NULL, NULL, '', '', b'1', NULL, NULL, 'FREQ=DAILY;INTERVAL=1;', '20221213T183000Z', NULL, NULL, 4),
(2, 'edited', '2026-01-15 00:00:00', '2026-01-16 00:00:00', NULL, NULL, '', '', b'1', NULL, NULL, NULL, NULL, NULL, NULL, 4),
(3, 'Edited event', '2026-01-17 00:00:00', '2026-01-18 00:00:00', NULL, NULL, '', '', b'1', NULL, NULL, NULL, NULL, NULL, NULL, 4);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
