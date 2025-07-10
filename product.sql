-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 14, 2024 at 07:43 AM
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
-- Database: `mysql`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `prodId` int(4) NOT NULL,
  `prodName` varchar(30) NOT NULL,
  `prodPicNameSmall` varchar(100) NOT NULL,
  `prodPicNameLarge` varchar(100) NOT NULL,
  `prodDescripShort` varchar(1000) DEFAULT NULL,
  `prodDescripLong` varchar(3000) DEFAULT NULL,
  `prodPrice` decimal(6,2) NOT NULL,
  `prodQuantity` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`prodId`, `prodName`, `prodPicNameSmall`, `prodPicNameLarge`, `prodDescripShort`, `prodDescripLong`, `prodPrice`, `prodQuantity`) VALUES
(1, 'Laptop', 'laptop_small.jpg', 'laptop_large.jpg', 'High-performance laptop', 'This laptop is equipped with the latest technology and powerful specs, making it ideal for both work and entertainment purposes.', 999.99, 50),
(2, 'Smartphone', 'phone_small.jpg', 'phone_large.jpg', 'Sleek and stylish smartphone', 'Stay connected on the go with this feature-packed smartphone. Capture stunning photos, stream your favorite content, and more.', 599.99, 100),
(3, 'Tablet', 'tablet_small.jpg', 'tablet_large.jpg', 'Versatile tablet for productivity and entertainment', 'Experience the convenience of a tablet with powerful performance and a stunning display. Perfect for work or play.', 349.99, 75),
(4, 'Smartwatch', 'watch_small.jpg', 'watch_large.jpg', 'Stay connected with a smartwatch', 'Track your fitness goals, receive notifications, and more with this stylish and functional smartwatch.', 199.99, 50),
(5, 'Wireless Headphones', 'headphones_small.jpg', 'headphones_large.jpg', 'Immersive audio experience', 'Enjoy crystal-clear sound and wireless convenience with these premium headphones. Perfect for music lovers.', 149.99, 80),
(6, 'Gaming Console', 'console_small.jpg', 'console_large.jpg', 'Next-gen gaming experience', 'Experience the latest in gaming technology with this powerful console. Dive into immersive worlds and enjoy hours of entertainment.', 499.99, 30),
(7, 'Bluetooth Speaker', 'speaker_small.jpg', 'speaker_large.jpg', 'Portable sound solution', 'Take your music anywhere with this compact and powerful Bluetooth speaker. Enjoy rich, high-quality sound wherever you go.', 79.99, 120),
(8, 'Digital Camera', 'camera_small.jpg', 'camera_large.jpg', 'Capture lifes moments in stunning detail', 'Preserve your memories with this high-quality digital camera. With advanced features and easy-to-use controls, capturing beautiful photos has never been easier.', 399.99, 40);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`prodId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `prodId` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
