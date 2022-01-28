-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2022 at 04:26 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oer`
--

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `n` int(11) NOT NULL,
  `id` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `venue` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`n`, `id`, `name`, `venue`, `image`) VALUES
(1, '1234', 'crdb', 'mlimani city', '1643182783.jpg'),
(4, '96f8d078e3', 'CRDB', 'somewhere', '1643279287.PNG');

-- --------------------------------------------------------

--
-- Table structure for table `form_list`
--

CREATE TABLE `form_list` (
  `id` int(11) NOT NULL,
  `form_code` varchar(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `form_setting`
--

CREATE TABLE `form_setting` (
  `event_id` varchar(100) NOT NULL,
  `field_1` mediumtext NOT NULL DEFAULT '',
  `field_2` mediumtext NOT NULL DEFAULT '',
  `field_3` mediumtext NOT NULL DEFAULT '',
  `field_4` mediumtext NOT NULL DEFAULT '',
  `field_5` mediumtext NOT NULL DEFAULT '',
  `field_6` mediumtext NOT NULL DEFAULT '',
  `field_7` mediumtext NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `form_setting`
--

INSERT INTO `form_setting` (`event_id`, `field_1`, `field_2`, `field_3`, `field_4`, `field_5`, `field_6`, `field_7`) VALUES
('96f8d078e3', '{\"name\":\"Name\",\"hint\":\"enter name\",\"type\":\"text\"}', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `responses`
--

CREATE TABLE `responses` (
  `id` int(11) NOT NULL,
  `rl_id` int(30) NOT NULL,
  `meta_field` varchar(255) NOT NULL,
  `meta_value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `response_list`
--

CREATE TABLE `response_list` (
  `id` int(11) NOT NULL,
  `form_code` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'massawe', '', '81dc9bdb52d04dc20036dbd8313ed055'),
(2, 'massawe', 'ramadhanimassawe14@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055'),
(3, 'Kijuba', 'kijubamkwayu@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`n`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `form_list`
--
ALTER TABLE `form_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form_setting`
--
ALTER TABLE `form_setting`
  ADD UNIQUE KEY `event_id` (`event_id`);

--
-- Indexes for table `responses`
--
ALTER TABLE `responses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `response_list`
--
ALTER TABLE `response_list`
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
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `n` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `form_list`
--
ALTER TABLE `form_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `responses`
--
ALTER TABLE `responses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `response_list`
--
ALTER TABLE `response_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
