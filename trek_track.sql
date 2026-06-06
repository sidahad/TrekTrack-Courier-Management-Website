-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2024 at 02:47 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trek_track`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cid` int(11) NOT NULL,
  `cname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cid`, `cname`) VALUES
(1, 'Aeroplane'),
(2, 'Ship'),
(3, 'Truck');

-- --------------------------------------------------------

--
-- Table structure for table `courier_orders`
--

CREATE TABLE `courier_orders` (
  `order_id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `sname` varchar(255) NOT NULL,
  `semail` varchar(255) NOT NULL,
  `sphone` varchar(20) NOT NULL,
  `scountry` varchar(100) NOT NULL,
  `scity` varchar(100) NOT NULL,
  `saddress` text NOT NULL,
  `rname` varchar(255) NOT NULL,
  `remail` varchar(255) NOT NULL,
  `rphone` varchar(20) NOT NULL,
  `rcountry` varchar(100) NOT NULL,
  `rcity` varchar(100) NOT NULL,
  `raddress` text NOT NULL,
  `dmethod` varchar(50) NOT NULL,
  `tweight` decimal(10,2) NOT NULL,
  `totalprice` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courier_orders`
--

INSERT INTO `courier_orders` (`order_id`, `uid`, `pid`, `sname`, `semail`, `sphone`, `scountry`, `scity`, `saddress`, `rname`, `remail`, `rphone`, `rcountry`, `rcity`, `raddress`, `dmethod`, `tweight`, `totalprice`) VALUES
(7, 3, NULL, 'ahad', 'ahad@gmail.com', '87686576', 'pakistan', 'karachi', '11A', 'zaheer', 'zaheer@gmail.com', '6999890', 'UK', 'Birmingham', 'abcroadstreet4', 'aeroplane', 4.00, 40000.00),
(8, 2, NULL, 'ahad', 'ahad@gmail.com', '87686576', 'pakistan', 'karachi', '11A', 'shayan', 'shayan@gmail.com', '6999890', 'UK', 'Birmingham', 'abcroadstreet4', 'aeroplane', 1.00, 10000.00);

-- --------------------------------------------------------

--
-- Table structure for table `dash_user`
--

CREATE TABLE `dash_user` (
  `u_id` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `First_Name` varchar(255) NOT NULL,
  `Last_Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Pass` varchar(255) NOT NULL,
  `upimg` varchar(255) NOT NULL,
  `ucimg` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dash_user`
--

INSERT INTO `dash_user` (`u_id`, `Username`, `First_Name`, `Last_Name`, `Email`, `Pass`, `upimg`, `ucimg`) VALUES
(1, 'Muhammad AHAD ', 'MUHAMMAD', 'ahad', 'ahadkind324@gmail.com', '123', 'ahad.jpg', 'slider2.webp');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `card_type` varchar(20) DEFAULT NULL,
  `card_number` varchar(16) DEFAULT NULL,
  `card_holder_name` varchar(100) DEFAULT NULL,
  `expiration_date` date DEFAULT NULL,
  `cvv` varchar(3) DEFAULT NULL,
  `transaction_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `order_id`, `card_type`, `card_number`, `card_holder_name`, `expiration_date`, `cvv`, `transaction_date`) VALUES
(5, 3, 7, 'mastercard', '454678798909', 'ahad', '0000-00-00', '456', '2024-09-30 09:01:13'),
(6, 2, 8, 'mastercard', '4568899900', 'ahad', '0000-00-00', '354', '2024-09-30 09:46:16');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pid` int(11) NOT NULL,
  `oid` varchar(255) NOT NULL,
  `pimg` varchar(255) NOT NULL,
  `pcategory` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `oid`, `pimg`, `pcategory`) VALUES
(34, '1', 'living-room-with-white-couch-lamp.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `Username` varchar(150) NOT NULL,
  `First_Name` varchar(150) NOT NULL,
  `Last_Name` varchar(150) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Pass` varchar(150) NOT NULL,
  `upimg` varchar(255) NOT NULL,
  `ucimg` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `Username`, `First_Name`, `Last_Name`, `Email`, `Pass`, `upimg`, `ucimg`) VALUES
(1, 'ahad', 'MUHAMMAD', 'ahad', 'ahmedkind324@gmail.com', '123', 'ahad.jpg', 'slider2.webp'),
(2, 'sid', 'MUHAMMAD', 'ahad', 'ahadkind324@gmail.com', '123', 'ahad.jpg', 'slider3.jpg'),
(3, 'admin', 'MUHAMMAD', 'ahad', 'ahadkind324@gmail.com', '123', 'Snapchat-725852207.jpg', 'IMG-20181220-WA0029.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `courier_orders`
--
ALTER TABLE `courier_orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `dash_user`
--
ALTER TABLE `dash_user`
  ADD PRIMARY KEY (`u_id`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `FK_products_categories` (`pcategory`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `courier_orders`
--
ALTER TABLE `courier_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `dash_user`
--
ALTER TABLE `dash_user`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courier_orders`
--
ALTER TABLE `courier_orders`
  ADD CONSTRAINT `courier_orders_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`) ON DELETE CASCADE,
  ADD CONSTRAINT `courier_orders_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `products` (`pid`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`uid`),
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `courier_orders` (`order_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `FK_products_categories` FOREIGN KEY (`pcategory`) REFERENCES `categories` (`cid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
