-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2019 at 12:09 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chat_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE `chat_messages` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `c_read` tinyint(1) NOT NULL,
  `c_seen` tinyint(1) NOT NULL,
  `c_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chat_messages`
--

INSERT INTO `chat_messages` (`id`, `message`, `sender`, `receiver`, `c_read`, `c_seen`, `c_date`) VALUES
(1, 'first mes', 5, 6, 0, 0, '2018-11-09 08:50:48'),
(2, 'second message', 5, 6, 0, 0, '2018-11-09 08:53:27'),
(3, 'my own first message', 6, 5, 0, 0, '2018-11-09 08:54:47'),
(4, 'Second mes form me', 6, 5, 0, 0, '2018-11-09 09:27:51'),
(5, 'mznckzjnckjasdcjum jcnk', 5, 6, 0, 0, '2018-12-25 05:49:36'),
(6, 'message receive in good condition.....tnx', 6, 5, 0, 0, '2018-12-25 11:50:06'),
(7, 'am a new user here...i need help getting along', 16, 6, 0, 0, '2018-12-26 09:34:34'),
(8, 'message to new user', 5, 16, 0, 0, '2019-01-03 08:37:16'),
(9, 'ok. lets get more message in', 5, 6, 0, 0, '2019-01-03 08:38:59'),
(10, 'alryt, that will make sense.', 6, 5, 0, 0, '2019-01-03 08:39:48'),
(11, 'yea...it sure will..', 5, 6, 0, 0, '2019-01-03 08:40:22'),
(12, 'so how\'s the learning process going?', 6, 5, 0, 0, '2019-01-03 08:41:55'),
(13, 'its been great so far', 5, 6, 0, 0, '2019-01-03 08:42:34'),
(14, 'a new message', 5, 6, 0, 0, '2019-01-21 06:58:11'),
(15, 'new new message', 5, 6, 0, 0, '2019-01-21 07:08:45'),
(16, 'ok this is a new message', 5, 6, 0, 0, '2019-01-22 10:37:16'),
(17, 'ok, now a recent mes.', 5, 6, 0, 0, '2019-01-22 10:59:13'),
(18, 'a more recent mes', 5, 6, 0, 0, '2019-01-22 11:00:16'),
(19, 'Newer mes', 5, 6, 0, 0, '2019-01-22 11:03:32'),
(20, 'lets do this again', 5, 6, 0, 0, '2019-01-22 11:04:44'),
(21, 'ok one more timw', 5, 6, 0, 0, '2019-01-22 11:05:37'),
(22, 'its not bad to try again', 5, 6, 0, 0, '2019-01-22 11:08:24'),
(23, 'ok..let me try', 6, 5, 0, 0, '2019-01-22 05:15:43'),
(24, 'let me try again', 6, 5, 0, 0, '2019-01-22 05:19:04'),
(25, 'let me also try', 5, 6, 0, 0, '2019-01-22 05:20:18'),
(26, 'let me also try again and again', 5, 6, 0, 0, '2019-01-22 05:20:49'),
(27, 'yea...this getting better', 6, 5, 0, 0, '2019-01-22 05:23:49'),
(28, 'and am loving it......dude', 6, 5, 0, 0, '2019-01-22 05:24:08'),
(29, 'yea sure..me too', 5, 6, 0, 0, '2019-01-22 05:24:30'),
(30, 'so whats next?', 5, 6, 0, 0, '2019-01-22 05:24:55'),
(31, 'you tell me.', 6, 5, 0, 0, '2019-01-22 05:25:07'),
(32, 'another message', 6, 5, 0, 0, '2019-01-22 05:35:24'),
(33, 'another message', 6, 5, 0, 0, '2019-01-22 05:35:24'),
(34, 'alryt, new mes', 5, 6, 0, 0, '2019-01-22 06:32:27'),
(35, 'hello', 5, 6, 0, 0, '2019-03-20 12:18:36'),
(36, 'how u doing today', 5, 16, 0, 0, '2019-03-20 12:18:58');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `permission` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(64) NOT NULL,
  `sort` varchar(32) NOT NULL,
  `logged_in` tinyint(1) NOT NULL,
  `r_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `email`, `password`, `sort`, `logged_in`, `r_date`) VALUES
(5, 'kigbua', 'Kigbu Amekalo', 'kigbua@gmail.com', '$2y$10$mqO1waYcNcSB3bsRavetZOEkQDts98coffsVgzmHVPUL4LqQ2umSu', 'nill', 0, '2018-11-08 11:40:18'),
(6, 'Jamii', 'James Kigbu', 'james@gmail.com', '$2y$10$Wyj8waUbNp2u/ehARYC/suGsrMmm8/fczM.JzI4381M.XyRMzHhSi', 'nill', 1, '2018-11-09 02:04:42'),
(7, 'timo', 'Tim Zinwota', 'tim@gmail.com', '$2y$10$7DLvwrieW6pkvkSEHTjgBuvmpm864tNNN1g/QwEudfDnlOfwaZCku', 'Null', 0, '2018-11-29 12:02:01'),
(13, 'paul', 'Paul T', 'paul@gmailcom', '$2y$10$dy4wM.lLxBVesp6VC4qSP.yVSqu09ZJsRUQtfn9DmYhddF/VGilAW', 'Null', 0, '2018-12-06 02:53:57'),
(15, 'janz', 'Janz Mann', 'janz@gmailcom', '$2y$10$pY0a55.Ee1iwqbh1pD6uMude/RRqcKhC3SKwuI9DAcTnvIEQgwG.G', 'Null', 0, '2018-12-06 03:13:00'),
(16, 'Zablaq', 'Paul TK', 'paultk@gmail.com', '$2y$10$/18628.iowZhFH9qgBgJHeWhb8.LV4YdYddd306HtmO2wvgUwqsxS', 'nill', 1, '2018-12-26 09:32:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
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
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
