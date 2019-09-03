-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2019 at 01:21 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phone_book`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`) VALUES
(1, 'Doctor'),
(2, 'Sportsperson'),
(4, 'Engineer'),
(5, 'Police'),
(6, 'Programmer'),
(7, 'Politician'),
(8, 'Professor'),
(9, 'Actor'),
(10, 'Army Person'),
(11, 'Accounts Officer'),
(12, 'Bank Officer');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `c_id` int(11) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `l_name` varchar(255) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `phone_no` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `creator` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`c_id`, `f_name`, `l_name`, `cat_id`, `gender`, `phone_no`, `email`, `address`, `creator`, `status`) VALUES
(1, 'ahmed', 'khan', 2, 'male', 32, 'khan123', 'gfh', '', 1),
(6, 'jamal', 'kamal', 1, 'male', 3232, 'jamal123', 'rawalpindi', '', 1),
(7, 'jamal', 'ahmed', 4, 'male', 3232, 'jamal123', 'multan', '', 1),
(9, 'jimi', 'ahmed', 1, 'male', 1222, 'jimi123', 'bwp', '', 1),
(10, 'haris', 'noor', 1, 'male', 3232352, 'haris123', 'multan', 'user', 1),
(11, 'ayeza', 'hassan', 1, 'female', 454, 'ayeza123', 'rawalpindi', 'user', 1),
(84, 'Niaz', 'Ahmed', 4, 'male', 2321, 'niaz123', 'multan matital', 'user', 1),
(85, 'Niaz', 'Ahmed', 4, 'male', 2147483647, 'niaz123', 'Multan Budlasanat ', 'user', 1),
(86, 'Rashid', 'Ameen', 2, 'male', 2147483647, 'rashid123', 'Multan', 'user', 1),
(87, 'Abdual', 'Rahman', 1, 'male', 2147483647, 'rahman123', 'Islamabad', 'user', 0),
(88, 'Atiq', 'Ahmed', 4, 'male', 2147483647, 'atiq123', 'Bhoray wala', 'user', 0);

-- --------------------------------------------------------

--
-- Table structure for table `test_tbl`
--

CREATE TABLE `test_tbl` (
  `id` int(11) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `l_name` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `phone_no` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test_tbl`
--

INSERT INTO `test_tbl` (`id`, `f_name`, `l_name`, `gender`, `phone_no`, `email`, `address`) VALUES
(37, 'ahmed', 'khan', 'male', '32', 'khan123', 'gfh'),
(38, 'jamal', 'kamal', 'male', '3232', 'jamal123', 'rawalpindi'),
(39, 'jamal', 'ahmed', 'male', '3232', 'jamal123', 'multan'),
(40, 'jimi', 'ahmed', 'male', '1222', 'jimi123', 'bwp'),
(41, 'haris', 'noor', 'male', '3232352', 'haris123', 'multan'),
(42, 'ayeza', 'hassan', 'female', '454', 'ayeza123', 'rawalpindi');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(11) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `l_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `resg_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `f_name`, `l_name`, `email`, `password`, `role`, `status`, `resg_date`) VALUES
(1, 'ahmed', 'khan', 'khan123', '123', 'user', 1, '0000-00-00 00:00:00'),
(2, 'Muhammad', 'Aamir', 'admin', 'admin', 'admin', 1, '2019-06-27 00:00:00'),
(4, 'Muhammad', 'Ameer Hamza', 'hamza123', '123', 'user', 0, '0000-00-00 00:00:00'),
(5, 'ahmed', 'khan', 'jimi123', '123', 'user', 0, '0000-00-00 00:00:00'),
(6, 'hashir', 'khan', 'hashir', '111', 'user', 0, '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `test_tbl`
--
ALTER TABLE `test_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `test_tbl`
--
ALTER TABLE `test_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
