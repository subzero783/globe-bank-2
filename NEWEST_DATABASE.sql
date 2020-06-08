-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 08, 2020 at 07:44 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qasrep_dev`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `level` int(11) NOT NULL DEFAULT '1',
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `hashed_password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `level`, `first_name`, `last_name`, `email`, `username`, `hashed_password`) VALUES
(1, 1, 'Gustavo', 'Amezcua', 'contact@hiperstudio.org', 'gus893', '$1$0ajkzgpV$ab5f/q4/fmGrUq8wRqIIz1');

-- --------------------------------------------------------

--
-- Table structure for table `bids`
--

CREATE TABLE `bids` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bid_name` varchar(255) DEFAULT NULL,
  `sell` tinyint(1) NOT NULL DEFAULT '1',
  `visible` tinyint(1) DEFAULT NULL,
  `offer_price` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bids`
--

INSERT INTO `bids` (`id`, `user_id`, `bid_name`, `sell`, `visible`, `offer_price`) VALUES
(1, 0, 'RFP - Integrated Electronic Security System', 1, 0, ''),
(2, 0, 'BASE OPERATIONS SUPPORT SERVICES AT MARINE CORPS BASE CAMP PENDLETON, CALIFORNIA', 1, 0, ''),
(18, 0, 'QS22 -- Mobile MRI Service and PET/CT Atlanta VA Medical Center', 1, 0, ''),
(28, 0, 'FY20 Repair Taxiway Foxtrot and Golf at Mountain Home AFB, ID', 1, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `page_name` varchar(255) DEFAULT NULL,
  `page_slug` varchar(255) NOT NULL,
  `position` int(11) NOT NULL,
  `title` text,
  `visible` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `page_name`, `page_slug`, `position`, `title`, `visible`) VALUES
(1, 'Bids', 'bids', 1, '<h1>This is the bids page</h1>', 1),
(5, 'Contact', 'contact', 2, '<h1>This is the contact page</h1>', 1),
(6, 'About', 'about', 4, '<h1>This is the about page</h1>', 1),
(10, 'Profile', 'profile', 3, '<h1>This is the profile page</h1>', 1),
(11, NULL, '', 0, 'Content', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `level` int(11) NOT NULL DEFAULT '1',
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `hashed_password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `level`, `first_name`, `last_name`, `email`, `username`, `hashed_password`) VALUES
(1, 1, 'Gustavo', 'Amezcua', 'contact@hiperstudio.org', 'gus893', '$1$0ajkzgpV$ab5f/q4/fmGrUq8wRqIIz1'),
(2, 2, 'Gustavo', 'Amezcua', 'gusta1296@gmail.com', 'gus894', '$1$0ajkzgpV$ab5f/q4/fmGrUq8wRqIIz1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_username` (`username`);

--
-- Indexes for table `bids`
--
ALTER TABLE `bids`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bids`
--
ALTER TABLE `bids`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
