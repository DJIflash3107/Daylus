-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2024 at 02:59 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `daylus`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`id`, `name`, `description`, `created_at`, `user_id`) VALUES
(1708239857, 'Random', 'An album with random pictures that i found on the internet', '2024-02-18 14:04:17', 1708239651),
(1708240288, 'Cars', 'Album with pics of cool cars', '2024-02-18 14:11:28', 1708240188);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `picture_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `picture_id`, `user_id`, `content`, `created_at`) VALUES
(1708241013, 1708239811, 1708240188, 'Reminds me of my home...', '2024-02-18 14:23:33'),
(1708241958, 1708239811, 1708239651, 'Thank you @satria', '2024-02-18 14:39:18'),
(1708321128, 1708317443, 1708240188, 'HEEEEELLLLLPPPP MEEEEEEEEEEEEEEE!!!!!! (PLEASE)', '2024-02-19 12:38:48'),
(1708341831, 1708317443, 1708240188, 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', '2024-02-19 18:23:51'),
(1708417145, 1708361561, 1708239651, 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', '2024-02-20 15:19:05'),
(1708444793, 1708433092, 1708239651, 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', '2024-02-20 22:59:53'),
(1708445692, 1708317443, 1708239651, 'YAHAHAHAHHAHAHAHAH', '2024-02-20 23:14:52');

-- --------------------------------------------------------

--
-- Table structure for table `like`
--

CREATE TABLE `like` (
  `id` int(11) NOT NULL,
  `picture_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `like`
--

INSERT INTO `like` (`id`, `picture_id`, `user_id`, `created_at`) VALUES
(1708240124, 1708239811, 1708239651, '2024-02-18 14:08:44'),
(1708243919, 1708240328, 1708239651, '2024-02-18 15:11:59'),
(1708244604, 1708240328, 1708244576, '2024-02-18 15:23:24'),
(1708342543, 1708317443, 1708240188, '2024-02-19 18:35:43'),
(1708417153, 1708361561, 1708239651, '2024-02-20 15:19:13'),
(1708433148, 1708433092, 1708239651, '2024-02-20 19:45:48'),
(1708447438, 1708433092, 1708240188, '2024-02-20 23:43:58');

-- --------------------------------------------------------

--
-- Table structure for table `picture`
--

CREATE TABLE `picture` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL,
  `file_location` varchar(255) NOT NULL,
  `album_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `picture`
--

INSERT INTO `picture` (`id`, `title`, `description`, `created_at`, `file_location`, `album_id`, `user_id`) VALUES
(1708239811, 'My home', 'Home sweet home...', '2024-02-18 14:03:31', 'assets/images/65d1abc3f25547.99511889.jpg', NULL, 1708239651),
(1708240328, 'Really radical car', 'The car lit up in the dark', '2024-02-18 14:12:08', 'assets/images/65d1adc8443df3.88186166.jpg', 1708240288, 1708240188),
(1708317443, 'A tower in the middle of nowhere', 'I spotted this tower while walking around on a mountain', '2024-02-19 11:37:23', 'assets/images/65d2db03d92908.66331513.jpg', NULL, 1708240188),
(1708361561, 'Pic goes so hard, feel free to screenshot', 'I found this pic on randomly generated web', '2024-02-19 23:52:41', 'assets/images/65d387590a8db6.72236271.jpg', 1708239857, 1708239651),
(1708431275, 'A family of peanuts', 'I dont even know what is this', '2024-02-20 19:14:35', 'assets/images/65d497abdb3926.29722901.jpg', 1708239857, 1708239651),
(1708433092, 'Weird statues', 'These statues looks so uncanny', '2024-02-20 19:44:52', 'assets/images/65d49ec4d6c6c0.09473830.jpg', 1708239857, 1708239651);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `fullname`, `address`) VALUES
(1708239651, 'DJIflash3107', '$2y$10$vicNDkDNUYNtK.Tm6J0ffOYtxXurO2hoP4SgcnP6ICGXrXO2jnNPC', 'djiflash3107@gmail.com', 'DJI Flash', 'Indonesia'),
(1708240188, 'satria', '$2y$10$0uU22w5hEFhu7e54k./ocuLHMGsaqjaKo5UHvPoUDym/7orasyQgG', 'satria@gmail.com', 'Satria Kurnia', 'Kampung Jua'),
(1708244576, 'adam', '$2y$10$ksc.If4GMahStILNMbhaxeN8I28TLDSqWtR0w6TMbattTqnV89EVW', 'adam@gmail.com', 'adam', 'venus');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `picture_id` (`picture_id`);

--
-- Indexes for table `like`
--
ALTER TABLE `like`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `picture_id` (`picture_id`);

--
-- Indexes for table `picture`
--
ALTER TABLE `picture`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `album_id` (`album_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `album_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`picture_id`) REFERENCES `picture` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `like`
--
ALTER TABLE `like`
  ADD CONSTRAINT `like_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `like_ibfk_2` FOREIGN KEY (`picture_id`) REFERENCES `picture` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `picture`
--
ALTER TABLE `picture`
  ADD CONSTRAINT `picture_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `picture_ibfk_2` FOREIGN KEY (`album_id`) REFERENCES `album` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
