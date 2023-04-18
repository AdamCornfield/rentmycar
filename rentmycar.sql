-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 18, 2023 at 05:44 AM
-- Server version: 8.0.31
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rentmycar`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `PASSWORD` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address1` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address2` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address3` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postcode` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_blob` longblob,
  `profile_url` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `PASSWORD`, `title`, `first_name`, `last_name`, `gender`, `address1`, `address2`, `address3`, `postcode`, `description`, `email`, `telephone`, `profile_blob`, `profile_url`) VALUES
(10, 'adam', '$2y$10$DeDZSCprf74SEDVYO1ECveHV1vP9aQHZbL/NFWqaXngHxRudAJN.W', 'Mr', 'Adam', 'Cornfield', 'Male', '2 wood lane', '', '', 'pl242ps', NULL, 'adam@cornfield.dev', '01726819609', NULL, NULL),
(11, 'test', '$2y$10$OICmk.GPGuO2yVb4gtVL...XhcvCje3MhQl9u2SZ08xjS3J9gDVK2', 'Mr', 'test', 'test', 'Other', 'test', '', '', 'pl242ps', NULL, 'test@test.test', '01726815292', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_details`
--

DROP TABLE IF EXISTS `vehicle_details`;
CREATE TABLE IF NOT EXISTS `vehicle_details` (
  `vehicle_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `vehicle_make` varchar(50) CHARACTER SET latin1 NOT NULL,
  `vehicle_model` varchar(100) CHARACTER SET latin1 NOT NULL,
  `vehicle_bodytype` varchar(500) CHARACTER SET latin1 NOT NULL,
  `fuel_type` varchar(100) CHARACTER SET latin1 NOT NULL,
  `mileage` varchar(100) CHARACTER SET latin1 NOT NULL,
  `location` varchar(100) CHARACTER SET latin1 NOT NULL,
  `year` varchar(5) CHARACTER SET latin1 NOT NULL,
  `num_doors` int NOT NULL,
  `video_url` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `image_url` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`vehicle_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicle_details`
--

INSERT INTO `vehicle_details` (`vehicle_id`, `user_id`, `vehicle_make`, `vehicle_model`, `vehicle_bodytype`, `fuel_type`, `mileage`, `location`, `year`, `num_doors`, `video_url`, `image_url`) VALUES
(33, 10, 'Vauxhall', 'Corsa', 'Hatchback', 'Petrol', '100000', 'Cardiff', '2005', 5, NULL, '/public/img/uploads/643e1c1618603.png'),
(34, 10, 'Lamborghini', 'Fast', 'Sports', 'Petrol', '20000', 'Ereford', '2017', 2, NULL, '/public/img/uploads/643e1bd6afca4.png'),
(35, 10, 'Mini', 'Small', 'Micro', 'Petrol', '10000', 'London', '2014', 3, NULL, '/public/img/uploads/643e1cd729be1.png'),
(36, 10, 'Mazarati', 'Speedy', 'Sports', 'Diesel', '100000', 'Frome', '2022', 5, NULL, '/public/img/uploads/643e1d0f6821c.png'),
(37, 10, 'Jeep', 'ATV', 'Tall', 'Diesel', '150000', 'Bodmin', '2011', 5, NULL, '/public/img/uploads/643e1d3ee73a0.png'),
(38, 11, 'Mustang', 'Old', 'Slick', 'Diesel', '200000', 'York', '1985', 3, NULL, '/public/img/uploads/643e1dd59c7f1.png');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `vehicle_details`
--
ALTER TABLE `vehicle_details`
  ADD CONSTRAINT `vehicle_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
