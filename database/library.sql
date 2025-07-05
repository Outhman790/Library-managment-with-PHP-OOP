-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2025 at 07:59 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

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
  `Borrowing_Date` timestamp NULL DEFAULT current_timestamp(),
  `Borrowing_Return_Date` date DEFAULT NULL,
  `Nickname` varchar(150) NOT NULL,
  `Collection_ID` int(11) NOT NULL,
  `Reservation_ID` int(11) NOT NULL,
  `Status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrowings`
--

INSERT INTO `borrowings` (`Borrowing_ID`, `Borrowing_Date`, `Borrowing_Return_Date`, `Nickname`, `Collection_ID`, `Reservation_ID`, `Status`) VALUES
(33, '2025-07-05 03:36:20', NULL, 'Izabell18', 3, 46, 'Borrowed'),
(34, '2025-07-05 03:36:26', '2025-07-05', 'Alta334', 6, 48, 'Available');

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
('Adrian790', '$2y$10$rJJJthSndQjsdcqFmTVVYuqIBXWrS2sTkpwFVzxIGfTjtmpYaHHVm', '46122 Nelle Meadows', 'fakedata99320@gmail.com', '0770228885', 'Frisco', 'etudiant(e)', 0, '2009-03-10', '2025-06-30', 0),
('Alisa23', '$2y$10$ErrN5WV.ep5v/Hz68QpARuyTlNhiLOfndVpQq4Oa0zrsZibH1qc.y', '400 Dusty Orchard', 'fakedata83778@gmail.com', '0770228841', 'Syracuse', 'etudiant(e)', 0, '1999-03-04', '2025-07-01', 0),
('Alta334', '$2y$10$JI4vkd97tPRG8Tn1KxdQ/.RhqGShVZPrponNOHbklYcAm7r3ewr1K', '201 Yundt Keys', 'akedata16480@gmail.com', '0770224548', 'Youngstown', 'etudiant(e)', 0, '2009-03-07', '2025-06-30', 0),
('Barbara23', '$2y$10$FHf6Lkr5f6n5rRL4TqnkzO/C6eIkCfaBnO5MWfjmSbNxSSocNO1Cm', '761 Jodie Circle', 'fakedata25926@gmail.com', '0770224477', 'Bellingham', 'etudiant(e)', 0, '2025-01-28', '2025-06-30', 0),
('Griffin85156', '$2y$10$M531OnXdYvE3iLBXN7nXmuIsT3v4MXPMEcvF39Lv95cD/Pnwr4hhS', '6960 Brenden Ways', 'fakedata16744@gmail.com', '0710454780', 'Orlando', 'etudiant(e)', 0, '2010-01-10', '2025-07-02', 0),
('Hildegard43', '$2y$10$4DofKgsRyZkyNJXAT62kuuOe9kYINf6tEPPxpb2OZlq0HSosF7cXO', '94923 Amely Hills', 'fakedata13319@gmail.com', '0770228547', 'Portsmouth', 'etudiant(e)', 0, '2006-03-30', '2025-07-01', 0),
('Izabell18', '$2y$10$WjuZHs67OGHIHAfTltjPFuaG80B6bJ4lioDaxaUkBoYOxa.g/tjKS', '4522 Kailey Falls', 'fakedata77821@gmail.com', '0770228808', 'KB457896', 'etudiant(e)', 0, '2002-12-27', '2025-06-30', 0),
('Joe34', '$2y$10$2SySPF685iUzaKpNZy0.N.bkQoFnSiR3N9kfjfLbZ2dKzZ6TV3BSG', '13052 Sanford Harbors', 'fakedata43698@gmail.com', '0712547896', 'Victorville', 'etudiant(e)', 0, '2013-06-24', '2025-07-02', 0),
('Lora23', '$2y$10$2RHaM1fkKEweDStStKGeFuqXd/rXXv1GSU11/ZIIUHdes3SNax2PS', '683 Jerrold Terrace', 'fakedata75394@gmail.com', '0770224414', 'Westminster', 'etudiant(e)', 0, '2002-05-08', '2025-06-30', 0),
('Lowell34', '$2y$10$25lklRB6fWPtYvq2ZEqKuO1LV4JzyLwfcn9MB8IvCENC0tzD8zSH.', '400 Lacy Green', 'fakedata18339@gmail.com', '0770221144', 'Bradenton', 'etudiant(e)', 0, '2010-05-16', '2025-06-30', 0),
('Magnus23', '$2y$10$L/Cj9LqahRXYOnNa2JQaH.CyKeuWGSxeipu9A33deyaj9/xjw/pkS', 'Howe Pines', 'fakedata13259@gmail.com', '0645789514', 'Elmhurst', 'fonctionnaire', 0, '2007-07-25', '2025-06-30', 0),
('Makenzie34', '$2y$10$9a.otWInDFe1Ife9/6L6RuYTBt/3Rdcs1Vcsw6cpDz8GgkG9FhUqi', '23317 Katharina Grove', 'fakedata32818@gmail.com', '0745654741', 'Lynn', 'etudiant(e)', 0, '2012-04-15', '2025-07-02', 0),
('Nina45', '$2y$10$XAZ8TehvC4oXRdGf.ymukuvNz6PDCrjFYo2B4TQ00n/My.K/bcp3y', '61322 Hermann Hollow', 'fakedata97982@gmail.com', '0770228810', 'Lowell', 'etudiant(e)', 0, '2003-04-27', '2025-06-30', 0),
('Outh', '$2y$10$7MATncERcv5gVCwLpPSaG.Rb5d4CKXLiIb.1H1asRnfQm5ZhZ5apG', 'some random adress 790', 'tangerino2011@live.fr', '0770228870', 'az790587', 'etudiant(e)', 0, '2004-06-23', '2025-06-26', 0),
('Outh790', '$2y$10$ynQ7nypPtUH/pR80I1wUe.HgdmOpbKqlZbnOI546dQu3e/Jhy1GWW', 'some random adress 790', 'tangerino2011@gmail.com', '0770228867', 'KB012340', 'fonctionnaire', 0, '1999-08-17', '2025-07-01', 1),
('Outhman790', '$2y$10$OjWOTaZv2blZ4j6wY1TzQeou4sZJmYvTiby5LJnz3z1ryAnFhDtNe', 'ROUTE DE RABAT GZENAYA TANGER', 'tangerino790_2011@live.fr', '0770228867', 'kb206550', 'etudiant(e)', 0, '1999-08-17', '2023-03-23', 0),
('Qasd23', '$2y$10$ACxAWC63I3Wd8wnaWFHEjuwfMN5eUNKNRst0n8OtZm9zL9xZS.fkG', '221 Yundt Keys', 'adasd549@gmail.com', '0770224546', 'Youngstown', 'etudiant(e)', 0, '2009-03-07', '2025-06-30', 0),
('Shemar23', '$2y$10$a8CmxIKSRU.vF2GnWw521.C/vK6ZVBgF/eUJ.aT8OYGE.c0CKH0xy', '753 Schmidt Meadow', 'fakedata50436@gmail.com', '0770224478', 'Fort Myers', 'etudiant(e)', 0, '2004-05-16', '2025-06-30', 0),
('Sonya84', 'Test1234..', '191 Kelton Brook', 'fakedata57912@gmail.com', '0770228810', 'Frisco', 'etudiant(e)', 0, '2002-09-24', '2025-06-26', 0),
('Vergi46', '$2y$10$XQ8aNg3U4bMHG6BpU0Ju3utAr8c1qvI5cufubCdgtCPTnFxSf8Viq', '93150 Pasquale Crescent', 'fakedata72698@gmail.com', '0770224498', 'Loveland', 'etudiant(e)', 0, '2010-10-07', '2025-06-30', 0),
('Zane23', '$2y$10$.ANZ8KRp.JtOmCE6YjuemuOfn1mQOMq/FQj75ZwRh3qvvbmOGMxgS', '3922 Vandervort Trafficway', 'fakedata88092@gmail.com', '0770228112', 'Citrus Heights', 'fonctionnaire', 0, '2008-02-21', '2025-07-01', 0);

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
  `Status` varchar(20) NOT NULL DEFAULT 'Available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `collection`
--

INSERT INTO `collection` (`Collection_ID`, `Type_ID`, `Title`, `Author_Name`, `Cover_Image`, `State`, `Edition_Date`, `Buy_Date`, `Status`) VALUES
(1, 1, 'Rich Dad Poor Dad', 'Robert T.KIYOZAKI', 'RichDad_PoorDad.webp', 'New', '1997-03-04', '2023-03-08', 'Reserved'),
(2, 2, 'breadcrumbs', 'Anne Ursu', 'breadcrumbs.jpg', 'New', '2019-09-03', '2023-03-15', 'Reserved'),
(3, 1, 'ChildOfTheKindred', 'M.T Magee', '686766f4da085_ChildOfTheKindred.jpg', 'Pretty used', '2017-09-10', '2016-03-06', 'Borrowed'),
(5, 1, '1984', 'George Orwell', '1984.webp', 'Used', '1984-03-07', '2023-03-15', 'Reserved'),
(6, 1, 'grave Secret', 'Alice James', 'graveSecret.jpg', 'Used', '2010-02-02', '2023-03-07', 'Available'),
(7, 1, 'Harry Poter', 'J.K Rowling', 'HarryPotter.jpg', 'New', '2007-03-06', '2023-03-21', 'Reserved'),
(10, 1, 'to kill a mockingbird', 'Harper Lee', '68671dce39584_56916837.jpg', 'Used', '1960-07-10', '2025-07-02', 'Available'),
(13, 1, 'Atomic Habits', 'James Clear', '686786c5339a1_686782bfaa427_0735211299.01._SCLZZZZZZZ_SX500_.jpg', 'Pretty used', '2018-10-16', '2025-07-01', 'Available');

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
(44, '2025-07-05 05:08:22', '2025-07-06 05:08:22', 1, 'Izabell18'),
(45, '2025-07-05 05:09:03', '2025-07-06 05:09:03', 2, 'Izabell18'),
(46, '2025-07-05 05:32:04', '2025-07-06 05:32:04', 3, 'Izabell18'),
(47, '2025-07-05 05:35:29', '2025-07-06 05:35:29', 5, 'Alta334'),
(48, '2025-07-05 05:35:36', '2025-07-06 05:35:36', 6, 'Alta334'),
(49, '2025-07-05 05:35:41', '2025-07-06 05:35:41', 7, 'Alta334');

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
  MODIFY `Borrowing_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `collection`
--
ALTER TABLE `collection`
  MODIFY `Collection_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `Reservation_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

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
