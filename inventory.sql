-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2021 at 06:09 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `pay_status` enum('paid','not paid') DEFAULT NULL,
  `method` enum('credit','debit','cod') DEFAULT NULL,
  `amt` double(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`id`, `customer_id`, `pay_status`, `method`, `amt`) VALUES
(100, 1, 'paid', 'cod', 140.00),
(101, 2, 'paid', 'debit', 135.00),
(102, 3, 'paid', 'debit', 263.30),
(103, 4, 'paid', 'cod', 515.63),
(104, 5, 'paid', 'cod', 12609.00),
(105, 6, 'paid', 'cod', 391.50),
(106, 7, 'paid', 'debit', 1501.10),
(107, 8, 'paid', 'cod', 244.80),
(108, 2, 'paid', 'cod', 255.50);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `phone` char(10) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `uname` varchar(20) DEFAULT NULL,
  `pwd` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `phone`, `email`, `uname`, `pwd`) VALUES
(1, 'Customer1', '9818278356', 'abc@gmail.com', 'cust1', 'cust1'),
(2, 'Customer2', '9818277656', 'def@gmail.com', 'cust2', 'cust2'),
(3, 'Rohan Sharma', '8208790654', 'rs@gmail.com', 'rsharma', 'gaxuv360'),
(4, 'Milind Topale', '9081763891', 'mt@gmail.com', 'mtopale', 'thisismt'),
(5, 'Raj Kaneria', '9818092567', 'rk@gmail.com', 'rkane', 'abcd49'),
(6, 'Grace Alex Toppo', '9810192437', 'ga@gmail.com', 'galex', 'efgh92'),
(7, 'K Balamurali', '8118672500', 'kb@gmail.com', 'bala', 'ijkl54'),
(8, 'Gadadhar Mathur', '9018094578', 'gm@gmail.com', 'gada_m', 'mnop12');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` char(5) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `phone` char(10) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `address` varchar(80) DEFAULT NULL,
  `salary` int(11) DEFAULT NULL,
  `datejoined` date DEFAULT NULL,
  `designation` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `name`, `phone`, `email`, `address`, `salary`, `datejoined`, `designation`) VALUES
('00001', 'Uday Kumar', '9123466457', 'ukumar@gmail.com', 'Address1', 28000, '2014-12-01', 'Godown Manager'),
('00002', 'Prashit Khandelwal', '9167245376', 'pkhand@gmail.com', 'Address2', 20000, '2015-01-12', 'Godown Manager'),
('00003', 'Soham Bhattacharyya', '9163703610', 'dbl.soham@gmail.com', '34/3, Kumirjala Road, Serampore, WB', 20000, '2020-08-12', 'Godown worker'),
('00004', 'Rohan Bhardwaj', '9163703650', 'roh_bdj@gmail.com', '47A, Agrasain Lane, Liluah, WB', 20000, '2020-08-12', 'Godown 00002 worker');

-- --------------------------------------------------------

--
-- Table structure for table `godown`
--

CREATE TABLE `godown` (
  `id` char(5) NOT NULL,
  `location` varchar(100) DEFAULT NULL,
  `manager` char(5) DEFAULT NULL,
  `capacity` decimal(6,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `godown`
--

INSERT INTO `godown` (`id`, `location`, `manager`, `capacity`) VALUES
('00001', 'Address1', '00001', '2506.03'),
('00002', '21/1, Raj Gali, Barracpore, WB', '00002', '2500.00');

-- --------------------------------------------------------

--
-- Table structure for table `inwards`
--

CREATE TABLE `inwards` (
  `id` int(11) NOT NULL,
  `product_id` char(5) DEFAULT NULL,
  `invoice` varchar(16) DEFAULT NULL,
  `product_name` varchar(50) DEFAULT NULL,
  `supp_name` varchar(50) DEFAULT NULL,
  `supp_phone` char(10) DEFAULT NULL,
  `supp_email` varchar(50) DEFAULT NULL,
  `supp_date` date DEFAULT NULL,
  `quantity` decimal(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inwards`
--

INSERT INTO `inwards` (`id`, `product_id`, `invoice`, `product_name`, `supp_name`, `supp_phone`, `supp_email`, `supp_date`, `quantity`) VALUES
(2, '00001', '214235', 'Product1', 'Supp1', '9806457891', 'suppemail1@gmail.com', '2015-02-15', '100.00'),
(3, '00002', '2131035', 'Product2', 'Supp2', '7856471634', 'suppemail2@gmail.com', '2015-02-10', '200.00'),
(5, '00004', '12345', 'SmartPhone XYZ', 'Manoj Giri', '9163707567', 'm_giri@gmail.com', '2020-09-27', '200.00'),
(6, '00003', '56391', 'Product3', 'Falguni Deb', '9816789025', 'faldeb_23@gmail.com', '2020-08-13', '250.00'),
(7, '00005', '10002', 'HECC Calculator', 'Ganesh Tharu', '9289016758', 'gan_tharu@gmail.com', '2020-09-01', '50.00'),
(8, '00006', '12890', 'Ossum KitchenWare', 'Falguni Deb', '9212345198', 'faldeb_23@gmail.com', '2020-09-11', '20.00');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `content` longtext NOT NULL,
  `created_by` char(5) NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `content`, `created_by`, `date_time`) VALUES
(1, 'Godown 00001 has reached full capacity', '00001', '2020-10-01 12:02:43');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `bill_id` int(11) DEFAULT NULL,
  `product_id` char(5) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `date_ordered` date DEFAULT NULL,
  `order_status` enum('outward','delivered','not delivered') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `bill_id`, `product_id`, `quantity`, `date_ordered`, `order_status`) VALUES
(100, 100, '00002', 2, '2020-09-06', 'delivered'),
(101, 101, '00002', 1, '2020-08-01', 'delivered'),
(102, 101, '00001', 1, '2020-08-01', 'delivered'),
(103, 102, '00003', 2, '2020-09-09', 'delivered'),
(104, 103, '00001', 1, '2020-09-09', 'delivered'),
(105, 103, '00005', 1, '2020-09-09', 'delivered'),
(106, 104, '00004', 1, '2020-09-28', 'delivered'),
(107, 105, '00003', 3, '2020-09-28', 'delivered'),
(108, 106, '00006', 1, '2020-10-01', 'delivered'),
(109, 107, '00001', 4, '2020-10-01', 'delivered'),
(110, 108, '00001', 1, '2020-10-01', 'delivered'),
(111, 108, '00002', 1, '2020-10-01', 'delivered'),
(112, 108, '00003', 1, '2020-10-01', 'delivered');

-- --------------------------------------------------------

--
-- Table structure for table `outward`
--

CREATE TABLE `outward` (
  `id` int(11) NOT NULL,
  `product_id` char(5) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `bill_id` int(11) DEFAULT NULL,
  `outward_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `outward`
--

INSERT INTO `outward` (`id`, `product_id`, `quantity`, `bill_id`, `outward_date`) VALUES
(100, '00002', 2, 100, '2020-09-07'),
(101, '00002', 1, 101, '2020-08-02'),
(102, '00001', 1, 101, '2020-08-02'),
(103, '00003', 2, 102, '2020-09-10'),
(104, '00001', 1, 103, '2020-09-12'),
(105, '00005', 1, 103, '2020-09-12'),
(106, '00004', 1, 104, '2020-09-30'),
(107, '00003', 3, 105, '2020-10-01'),
(108, '00006', 1, 106, '2020-10-02'),
(109, '00001', 4, 107, '2020-10-03'),
(110, '00001', 1, 108, '2020-10-03'),
(111, '00002', 1, 108, '2020-10-03'),
(112, '00003', 1, 108, '2020-10-03');

-- --------------------------------------------------------

--
-- Table structure for table `password`
--

CREATE TABLE `password` (
  `accessTo` varchar(10) NOT NULL,
  `pwd` varchar(15) DEFAULT NULL,
  `admin_pwd` varchar(20) NOT NULL,
  `manager` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `password`
--

INSERT INTO `password` (`accessTo`, `pwd`, `admin_pwd`, `manager`) VALUES
('employee', '19bce1199', '19bce1199', 'Admin'),
('godown', '19bce1199', '19bce1199', 'Admin'),
('inwards', '19bce1199', '19bce1199', 'Admin,00001,00002'),
('main', '19bce1199', '19bce1199', 'Admin'),
('orders', '19bce1199', '19bce1199', 'Admin,00001,00002'),
('stock', '19bce1199', '19bce1199', 'Admin,00001,00002');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` char(5) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `cp_per_unit` decimal(10,2) DEFAULT NULL,
  `sp_per_unit` decimal(10,2) DEFAULT NULL,
  `units` int(11) DEFAULT NULL,
  `threshold` int(11) NOT NULL,
  `godown_id` char(5) DEFAULT NULL,
  `remarks` varchar(70) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `name`, `cp_per_unit`, `sp_per_unit`, `units`, `threshold`, `godown_id`, `remarks`) VALUES
('00001', 'Product1', '50.00', '60.00', 200, 20, '00001', 'red colour'),
('00002', 'Product2', '55.00', '65.00', 200, 10, '00001', 'style1'),
('00003', 'Product3', '100.00', '130.00', 250, 20, '00002', 'plain'),
('00004', 'SmartPhone XYZ', '9000.00', '12600.00', 200, 10, '00002', 'Metallic Blue colour'),
('00005', 'HECC Calculator', '120.00', '450.00', 50, 30, '00001', 'Model: cc5432'),
('00006', 'Ossum KitchenWare', '900.00', '1500.00', 9, 10, '00002', '10 items');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkey9` (`customer_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq2` (`uname`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq1` (`email`),
  ADD UNIQUE KEY `uniq2` (`phone`);

--
-- Indexes for table `godown`
--
ALTER TABLE `godown`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkey1` (`manager`);

--
-- Indexes for table `inwards`
--
ALTER TABLE `inwards`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq4` (`invoice`),
  ADD KEY `fkey3` (`product_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq2` (`bill_id`,`product_id`),
  ADD KEY `fkey11` (`product_id`);

--
-- Indexes for table `outward`
--
ALTER TABLE `outward`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkey7` (`product_id`),
  ADD KEY `fkey8` (`bill_id`);

--
-- Indexes for table `password`
--
ALTER TABLE `password`
  ADD PRIMARY KEY (`accessTo`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkey4` (`godown_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `inwards`
--
ALTER TABLE `inwards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `outward`
--
ALTER TABLE `outward`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `fkey9` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`);

--
-- Constraints for table `godown`
--
ALTER TABLE `godown`
  ADD CONSTRAINT `fkey1` FOREIGN KEY (`manager`) REFERENCES `employee` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inwards`
--
ALTER TABLE `inwards`
  ADD CONSTRAINT `fkey3` FOREIGN KEY (`product_id`) REFERENCES `stock` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fkey10` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`id`),
  ADD CONSTRAINT `fkey11` FOREIGN KEY (`product_id`) REFERENCES `stock` (`id`);

--
-- Constraints for table `outward`
--
ALTER TABLE `outward`
  ADD CONSTRAINT `fkey7` FOREIGN KEY (`product_id`) REFERENCES `stock` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkey8` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `fkey4` FOREIGN KEY (`godown_id`) REFERENCES `godown` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
