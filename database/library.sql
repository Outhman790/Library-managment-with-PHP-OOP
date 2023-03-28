-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2023 at 12:51 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `borrowings`
--

CREATE TABLE `borrowings` (
  `Borrowing_ID` int(11) NOT NULL,
  `Borrowing_Date` datetime DEFAULT current_timestamp(),
  `Borrowing_Return_Date` datetime DEFAULT NULL,
  `Nickname` varchar(150) NOT NULL,
  `Collection_ID` int(11) NOT NULL,
  `Reservation_ID` int(11) NOT NULL,
  `Status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrowings`
--

INSERT INTO `borrowings` (`Borrowing_ID`, `Borrowing_Date`, `Borrowing_Return_Date`, `Nickname`, `Collection_ID`, `Reservation_ID`, `Status`) VALUES
(14, '2023-03-06 03:14:38', '2023-03-26 03:24:35', 'Outhman790', 3, 30, 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `Nickname` varchar(150) NOT NULL,
  `Password` varchar(150) DEFAULT NULL,
  `Address` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Phone` varchar(100) DEFAULT NULL,
  `CIN` varchar(50) DEFAULT NULL,
  `Occupation` varchar(50) DEFAULT NULL,
  `Penalty_Count` int(11) DEFAULT 0,
  `Birth_Date` date DEFAULT NULL,
  `Creation_Date` date DEFAULT current_timestamp(),
  `Admin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`Nickname`, `Password`, `Address`, `Email`, `Phone`, `CIN`, `Occupation`, `Penalty_Count`, `Birth_Date`, `Creation_Date`, `Admin`) VALUES
('Outhman790', '$2y$10$Inv4Iau0DLEWWh46gI1lCe/TUqXkT0AS5noeo75sns.YgKmsHR/IS', 'Aut ut voluptas volu', 'tangerino790_2011@live.fr', '89', 'KB987456', 'fonctionnaire', 3, '1990-06-05', '2023-03-09', 0),
('Outhman99', '$2y$10$hTB8KOPvA83P9n6T44PK6eL0kNxWPP4tkmrYDrRU1CG9y/5hvVDvS', 'complexe hassani nora 1 n2', 'Outhman99@gmail.com', '0660549596', 'kb123456', 'fonctionnaire', NULL, '1999-08-17', '2023-03-15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `collection`
--

CREATE TABLE `collection` (
  `Collection_ID` int(11) NOT NULL,
  `Type_ID` int(11) NOT NULL,
  `Title` varchar(50) DEFAULT NULL,
  `Author_Name` varchar(100) DEFAULT NULL,
  `Cover_Image` varchar(100) DEFAULT NULL,
  `State` varchar(100) DEFAULT NULL,
  `Edition_Date` date DEFAULT NULL,
  `Buy_Date` date DEFAULT NULL,
  `Status` varchar(150) DEFAULT 'Available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `collection`
--

INSERT INTO `collection` (`Collection_ID`, `Type_ID`, `Title`, `Author_Name`, `Cover_Image`, `State`, `Edition_Date`, `Buy_Date`, `Status`) VALUES
(1, 1, 'Rich Dad Poor Dad', 'Robert T.KIYOZAKI', 'RichDad_PoorDad.webp', 'New', '1997-03-04', '2023-03-08', 'Available'),
(2, 2, 'breadcrumbs', 'Anne Ursu', 'breadcrumbs.jpg', 'New', '2019-09-03', '2023-03-15', 'Available'),
(3, 1, 'ChildOfTheKindred', 'M.T Magee', 'ChildOfTheKindred.jpg', 'Used', '2017-09-10', '2023-03-06', 'Available'),
(5, 1, '1985', 'George Orwell', 'TheCompoundEffect-by-DarrenHardy.jpg', 'Used', '1984-03-07', '2023-03-15', 'Available'),
(6, 1, 'grave Secret', 'Alice James', 'graveSecret.jpg', 'Used', '2010-02-02', '2023-03-07', 'Available'),
(7, 1, 'Harry Poter', 'J.K Rowling', 'HarryPotter.jpg', 'New', '2007-03-06', '2023-03-21', 'Available'),
(9, 1, 'Compound effect', 'Darren Hardy', '64166daf9ef9a_TheCompoundEffect-by-DarrenHardy.jpg', 'New', '2010-04-02', '2012-01-05', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `Reservation_ID` int(11) NOT NULL,
  `Reservation_Date` datetime DEFAULT NULL,
  `Reservation_Expiration_Date` datetime DEFAULT NULL,
  `Collection_ID` int(11) NOT NULL,
  `Nickname` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`Reservation_ID`, `Reservation_Date`, `Reservation_Expiration_Date`, `Collection_ID`, `Nickname`) VALUES
(28, '2023-03-26 05:13:50', '2023-03-27 05:13:50', 1, 'Outhman790'),
(29, '2023-03-26 05:13:55', '2023-03-27 05:13:55', 2, 'Outhman790'),
(30, '2023-03-26 05:14:07', '2023-03-27 05:14:07', 3, 'Outhman790');

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `Type_ID` int(11) NOT NULL,
  `Type_Name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`Type_ID`, `Type_Name`) VALUES
(1, 'Book'),
(2, 'CD'),
(4, 'DVD'),
(5, 'Roman'),
(6, 'magazine');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `borrowings`
--
ALTER TABLE `borrowings`
  ADD PRIMARY KEY (`Borrowing_ID`),
  ADD UNIQUE KEY `Reservation_ID` (`Reservation_ID`),
  ADD KEY `Collection_ID` (`Collection_ID`),
  ADD KEY `Nickname` (`Nickname`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`Nickname`);

--
-- Indexes for table `collection`
--
ALTER TABLE `collection`
  ADD PRIMARY KEY (`Collection_ID`),
  ADD KEY `Type_ID` (`Type_ID`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`Reservation_ID`),
  ADD KEY `Collection_ID` (`Collection_ID`),
  ADD KEY `Nickname` (`Nickname`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`Type_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `borrowings`
--
ALTER TABLE `borrowings`
  MODIFY `Borrowing_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `collection`
--
ALTER TABLE `collection`
  MODIFY `Collection_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `Reservation_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `Type_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrowings`
--
ALTER TABLE `borrowings`
  ADD CONSTRAINT `borrowings_ibfk_1` FOREIGN KEY (`Collection_ID`) REFERENCES `collection` (`Collection_ID`),
  ADD CONSTRAINT `borrowings_ibfk_2` FOREIGN KEY (`Nickname`) REFERENCES `client` (`Nickname`),
  ADD CONSTRAINT `borrowings_ibfk_3` FOREIGN KEY (`Reservation_ID`) REFERENCES `reservation` (`Reservation_ID`);

--
-- Constraints for table `collection`
--
ALTER TABLE `collection`
  ADD CONSTRAINT `collection_ibfk_1` FOREIGN KEY (`Type_ID`) REFERENCES `types` (`Type_ID`);

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`Collection_ID`) REFERENCES `collection` (`Collection_ID`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`Nickname`) REFERENCES `client` (`Nickname`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
