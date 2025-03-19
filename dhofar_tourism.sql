-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2025 at 04:49 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dhofar_tourism`
--

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `FeedbackID` int(11) NOT NULL,
  `PlaceID` int(11) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Comment` text DEFAULT NULL,
  `Rating` int(11) DEFAULT NULL CHECK (`Rating` between 1 and 5),
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`FeedbackID`, `PlaceID`, `UserID`, `Comment`, `Rating`, `CreatedAt`) VALUES
(1, 3, 1, 'good', 1, '2025-03-18 03:21:27'),
(2, 6, 1, 'nice', 2, '2025-03-18 03:22:06'),
(3, 1, 1, 'ala', 5, '2025-03-18 03:22:53'),
(4, 2, 1, 'aaaaa', 5, '2025-03-18 03:23:28'),
(5, 7, 1, 'ffff', 5, '2025-03-18 03:23:53'),
(6, 7, 1, 'very nice place', 3, '2025-03-18 03:46:53');

-- --------------------------------------------------------

--
-- Table structure for table `mytrip`
--

CREATE TABLE `mytrip` (
  `TripId` int(11) NOT NULL,
  `UserId` int(11) DEFAULT NULL,
  `PlaceId` int(11) DEFAULT NULL,
  `DateOfVisit` date DEFAULT NULL,
  `Feedback` text DEFAULT NULL,
  `Recommendation` enum('Yes','No') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mytrip`
--

INSERT INTO `mytrip` (`TripId`, `UserId`, `PlaceId`, `DateOfVisit`, `Feedback`, `Recommendation`) VALUES
(2, 3, 2, '2024-03-10', 'A peaceful and spiritual experience.', 'Yes'),
(3, 4, 3, '2024-01-20', 'Loved the waterfalls and hiking trails.', 'Yes'),
(4, 5, 4, '2024-02-25', 'Great place to buy traditional Omani items.', 'Yes'),
(5, 1, 5, '2024-03-05', 'A nice shopping mall with various brands.', 'No'),
(6, 3, 6, '2024-03-12', 'Loved the food, authentic and delicious.', 'Yes'),
(7, 4, 7, '2024-01-30', 'Very comfortable stay, excellent service.', 'Yes'),
(9, 1, 3, '2025-03-18', NULL, NULL),
(10, 1, 4, '2025-03-18', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

CREATE TABLE `places` (
  `Id` int(11) NOT NULL,
  `Place` varchar(100) NOT NULL,
  `Description` text DEFAULT NULL,
  `MainPhoto` varchar(255) DEFAULT NULL,
  `Location` varchar(255) DEFAULT NULL,
  `Category` enum('Landscapes','Ayoons','Historical','Markets','Malls','Restaurants','Hotels') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`Id`, `Place`, `Description`, `MainPhoto`, `Location`, `Category`) VALUES
(1, 'Al Mughsail Beach', 'A beautiful beach with blowholes and golden sand.', 'images/1.jpg', 'Salalah, Oman', 'Landscapes'),
(2, 'Sultan Qaboos Mosque', 'One of the most magnificent mosques in Oman.', 'images/2.jpg', 'Salalah, Oman', 'Historical'),
(3, 'Wadi Darbat', 'A stunning valley with waterfalls and lush greenery.', 'images/3.jpg', 'Dhofar, Oman', 'Ayoons'),
(4, 'Al Husn Souq', 'A traditional market known for frankincense and Omani handicrafts.', 'images/4.jpg', 'Salalah, Oman', 'Markets'),
(5, 'Gardens Mall', 'A modern shopping center with international brands.', 'images/5.jpg', 'Salalah, Oman', 'Malls'),
(6, 'Darbat Restaurant', 'A famous local restaurant offering Omani cuisine.', 'images/3.jpg', 'Salalah, Oman', 'Restaurants'),
(7, 'Hilton Salalah', 'A luxurious hotel with a beachfront view.', 'images/2.jpg', 'Salalah, Oman', 'Hotels');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `Name`, `Email`, `Password`) VALUES
(1, 'ahmad', 'chahmad2004@gmail.com', '$2y$10$byNJFU9LmdkoOvFpEXTWZ.I.Ymflf4cyHQcmnPGZ7Db55iGR9BEFG'),
(3, 'Ali Al-Muqbali', 'ali@example.com', 'hashedpassword1'),
(4, 'Sara Al-Rashdi', 'sara@example.com', 'hashedpassword2'),
(5, 'Omar Al-Balushi', 'omar@example.com', 'hashedpassword3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`FeedbackID`),
  ADD KEY `PlaceID` (`PlaceID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `mytrip`
--
ALTER TABLE `mytrip`
  ADD PRIMARY KEY (`TripId`),
  ADD KEY `UserId` (`UserId`),
  ADD KEY `PlaceId` (`PlaceId`);

--
-- Indexes for table `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `FeedbackID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mytrip`
--
ALTER TABLE `mytrip`
  MODIFY `TripId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `places`
--
ALTER TABLE `places`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`PlaceID`) REFERENCES `places` (`Id`),
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `users` (`Id`);

--
-- Constraints for table `mytrip`
--
ALTER TABLE `mytrip`
  ADD CONSTRAINT `mytrip_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `users` (`Id`),
  ADD CONSTRAINT `mytrip_ibfk_2` FOREIGN KEY (`PlaceId`) REFERENCES `places` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
