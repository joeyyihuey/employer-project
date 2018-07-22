-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2018 at 03:46 PM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `veecotech`
--

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_no` int(100) NOT NULL,
  `image_name` varchar(1000) DEFAULT NULL,
  `country` varchar(100) NOT NULL,
  `contact_name` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `role` varchar(100) DEFAULT 'company',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `company_name`, `address`, `email`, `phone_no`, `image_name`, `country`, `contact_name`, `pass`, `role`, `is_deleted`) VALUES
(7, 'Quas app', '16,Lorong 66,Taman Patani Jaya,08000,Sungai Petani,Kedah', 'Quas@gmail.com', 2147483647, '16.jpg', 'Malaysia', 'han', '123456', 'company', 0),
(8, 'Intel', '16,Lorong 66,Taman Patani Jaya,08000,Sungai Petani,Kedah', 'intel@gmail.com', 174353910, '8.jpg', 'Malaysia', 'gaga', '123456', 'company', 0),
(9, 'Keysite', '16,Lorong 66,Taman Patani Jaya, ,08000,Sungai Petani,', 'keysite@gmail.com', 174353910, '9.jpg', 'Malaysia', 'han', '123456', 'company', 0),
(10, 'Quas app', '16,Lorong 66,Taman Patani Jaya,08000,Sungai Petani,Kedah', 'Quas@gmail.comd', 174353910, NULL, 'Malaysia', 'han', '123456', 'company', 0);

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `invoice_no` int(100) NOT NULL,
  `total_amount` int(100) NOT NULL,
  `balance` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `image_name` varchar(100) DEFAULT NULL,
  `status` varchar(100) NOT NULL,
  `tax` float NOT NULL,
  `description` varchar(1000) NOT NULL,
  `price` float DEFAULT NULL,
  `company_id` int(100) DEFAULT NULL,
  `is_deleted` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `image_name`, `status`, `tax`, `description`, `price`, `company_id`, `is_deleted`) VALUES
(1, 'Harry Potter And The Sorceror Stone', '1.jpg', 'In Stock', 10, 'Harry Potter ....', 200, 6, 0),
(2, 'Harry Potter And The chamber of secret', '2.PNG', 'In Stock', 10, 'Harry Potter ....', 200, 7, 0),
(3, 'gaga', '3.jpg', 'In Stock', 22, 'picture', 1000, 7, 0),
(4, 'gaga', '4.jpg', 'In Stock', 22, 'picture', 200, 7, 0),
(5, 'gaga', '5.PNG', 'In Stock', 22, 'picture', 1000, 7, 0),
(6, 'gaga', '6.jpg', 'In Stock', 22, 'picture', 200, 7, 0),
(7, 'gaga', '7.jpg', 'In Stock', 22, 'picture', 200, 7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `quotation`
--

CREATE TABLE `quotation` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `expired_on` date DEFAULT NULL,
  `quotation_no` varchar(100) DEFAULT NULL,
  `customer` varchar(100) DEFAULT NULL,
  `amount` int(100) DEFAULT NULL,
  `status` varchar(100) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  `subheading` varchar(1000) DEFAULT NULL,
  `footer` varchar(1000) DEFAULT NULL,
  `memo` varchar(1000) DEFAULT NULL,
  `P_O_S_O` varchar(100) DEFAULT NULL,
  `subtotal` int(100) DEFAULT NULL,
  `total` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quotation`
--

INSERT INTO `quotation` (`id`, `date`, `expired_on`, `quotation_no`, `customer`, `amount`, `status`, `company_id`, `is_deleted`, `subheading`, `footer`, `memo`, `P_O_S_O`, `subtotal`, `total`) VALUES
(4, '2018-07-01', '2018-07-02', 'A3540', 'Cheam Hau Han', 2022, 'saved', 7, 0, 'Subheading', 'Footer', 'Memo', '212', 2022, 2022),
(5, '2018-07-01', '2018-07-09', 'A1364', 'Joey Teh Yi Huei', 410, 'saved', 7, 0, 'Subheading', 'Footer', 'Memo', '2', 410, 410),
(6, '2018-07-01', '2018-07-09', 'A2541', 'Joey Teh Yi Huei', 410, 'saved', 7, 0, 'Subheading', 'Footer', 'Memo', '122', 410, 410);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `image_name` varchar(1000) DEFAULT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL DEFAULT 'user',
  `pass` varchar(100) DEFAULT NULL,
  `phone_no` int(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `age` int(100) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  `companies_id` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `image_name`, `first_name`, `last_name`, `email`, `role`, `pass`, `phone_no`, `address`, `age`, `is_deleted`, `companies_id`) VALUES
(16, '16.jpg', 'Ang', 'Li Jie', 'admin@gmail.com', 'admin', '123456', 174353910, '16,Lorong 66,Taman Patani Jaya,08000,Sungai Petani,Kedah', 21, 0, 0),
(17, '17.jpg', 'Joey', 'Teh Yi Huei', 'gaga1993@live.com', 'user', NULL, 174353910, '16,Lorong 66,Taman Patani Jaya,08000,Sungai Petani,Kedah', 21, 0, 7),
(18, '18.jpg', 'Cheam', 'Hau Han', 'test@gmail.com', 'user', NULL, 174353910, '16,Lorong 66,Taman Patani Jaya,08000,Sungai Petani,Kedah', 21, 0, 7),
(19, '19.jpg', 'Loh', 'Ba Ba', 'ff@gmail.com', 'user', NULL, 174353910, '16,Lorong 66,Taman Patani Jaya,08000,Sungai Petani,Kedah', 21, 0, 7),
(20, '20.jpg', 'gaga', 'dsa', 'gaga@gmail.com', 'user', NULL, 174353910, '16,Lorong 66,Taman Patani Jaya, ,08000,Sungai Petani,', 23, 0, 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotation`
--
ALTER TABLE `quotation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `quotation`
--
ALTER TABLE `quotation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
