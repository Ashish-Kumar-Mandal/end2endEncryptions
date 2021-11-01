-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2021 at 09:19 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `end2endencryptions`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `usr_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `mobile` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`usr_id`, `name`, `mobile`, `password`) VALUES
(1, 'QnhIU1l2N1BZMGdaR21wZUJrMnpVUT09OjrSIzlk3DFynQS2zkEPOmmC', 'MUw4cm5SeTZ1WnV4dnFMeWFDaWtyUT09OjoRxMMENfBaN0JvlHBH7alw', '$2y$10$kY6dfkGiVKEpcQQvA/ZNPeGmnkagV7DhLAZ1/G9Y5XWX8lWWG07we'),
(2, 'NmpDSE54bjY4SXkzd0oyeVZCRU9kUT09Ojrj4CuDtB5WrSKGcHHHmgSe', 'Q1ltOURKMWlNcUZlUHptc3lkN0NuUT09OjqZWhQSQttBzkt8AxW/n4v5', '$2y$10$QuUxW9dHSY8LFtK2LyhyTuU9CJcIohEK2i1mS6cOfggLsDTq/lqBm'),
(3, 'UVQ3b0U0RnpYMkhFRFFGTm9HNURZUT09OjrPkXEehImrrIUb4vSXZGgh', 'NlFiMTd5TkIzbUFQcW8yNE55NjNldz09OjpNQaElaVUiYjD5m09BZI3J', '$2y$10$/5y8Y6r4k1xbFZzTDO8RXu8eijlxsctr60HHGhJIZ4QeIMN4ziVNG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usr_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `usr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
