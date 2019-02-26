-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2019 at 09:47 PM
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
-- Database: `ppk`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(6) NOT NULL,
  `answer` varchar(50) NOT NULL,
  `question_id` int(11) NOT NULL,
  `is_correct` tinyint(1) NOT NULL DEFAULT '0',
  `insert_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `answer`, `question_id`, `is_correct`, `insert_date`) VALUES
(1, 'Personal Homepage', 1, 0, '2019-02-26 01:07:29'),
(2, 'PHP: Hypertext Preprocessor', 1, 1, '2019-02-26 01:07:36'),
(3, 'New line', 2, 0, '2019-02-26 01:07:39'),
(4, ';', 2, 1, '2019-02-26 01:07:42'),
(5, 'end', 2, 0, '2019-02-26 01:07:47'),
(6, 'echo \'Hello World\';;', 3, 0, '2019-02-26 01:07:50'),
(7, 'echo \'Hello World\';', 3, 1, '2019-02-26 01:07:52'),
(8, 'Hello World', 3, 0, '2019-02-26 01:07:55'),
(9, 'World Hello', 3, 0, '2019-02-26 01:07:57'),
(10, 'Hello', 3, 0, '2019-02-26 01:08:01'),
(11, '<html></html>', 4, 1, '2019-02-26 01:08:03'),
(12, '<h></h>', 4, 0, '2019-02-26 01:08:05');

-- --------------------------------------------------------

--
-- Table structure for table `enrolled`
--

CREATE TABLE `enrolled` (
  `id` int(6) NOT NULL,
  `user` varchar(50) NOT NULL,
  `test_id` int(6) NOT NULL,
  `attempt` int(4) NOT NULL,
  `insert_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `enrolled`
--

INSERT INTO `enrolled` (`id`, `user`, `test_id`, `attempt`, `insert_date`) VALUES
(1, 'martins', 1, 1, '2019-02-26 01:10:23'),
(2, 'martins', 1, 2, '2019-02-26 19:50:39');

-- --------------------------------------------------------

--
-- Table structure for table `enrolled_answers`
--

CREATE TABLE `enrolled_answers` (
  `id` int(6) NOT NULL,
  `question_id` int(6) NOT NULL,
  `answer_id` int(6) NOT NULL,
  `correct_answer` int(6) NOT NULL,
  `correct` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int(6) NOT NULL,
  `insert_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `enrolled_answers`
--

INSERT INTO `enrolled_answers` (`id`, `question_id`, `answer_id`, `correct_answer`, `correct`, `user_id`, `insert_date`) VALUES
(1, 1, 2, 2, 1, 1, '2019-02-26 01:10:25'),
(2, 2, 4, 4, 1, 1, '2019-02-26 01:10:27'),
(3, 3, 7, 7, 1, 1, '2019-02-26 01:10:30'),
(4, 1, 2, 2, 1, 2, '2019-02-26 19:50:43'),
(5, 2, 4, 4, 1, 2, '2019-02-26 19:50:45'),
(6, 3, 7, 7, 1, 2, '2019-02-26 19:50:47');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(6) NOT NULL,
  `question` varchar(100) NOT NULL,
  `test_id` int(11) NOT NULL,
  `insert_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `test_id`, `insert_date`) VALUES
(1, 'What does PHP stand for?', 1, '2019-02-26 01:03:44'),
(2, 'What is the correct way to end a PHP statement?\r\n\r\n', 1, '2019-02-26 01:03:51'),
(3, 'How do you write \"Hello World\" in PHP?', 1, '2019-02-26 01:03:54'),
(4, 'What is HTML tag?', 2, '2019-02-26 01:03:57'),
(5, 'Is HTML Programming language?', 2, '2019-02-26 01:05:43');

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `id` int(6) NOT NULL,
  `test_name` varchar(50) NOT NULL,
  `insert_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`id`, `test_name`, `insert_date`) VALUES
(1, 'PHP Quiz', '2019-02-26 01:03:07'),
(2, 'HTML Quiz', '2019-02-26 01:03:12'),
(3, 'SQL Quiz', '2019-02-26 01:03:15'),
(4, 'JavaScript Quiz', '2019-02-26 01:03:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrolled`
--
ALTER TABLE `enrolled`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrolled_answers`
--
ALTER TABLE `enrolled_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `test_name` (`test_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `enrolled`
--
ALTER TABLE `enrolled`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `enrolled_answers`
--
ALTER TABLE `enrolled_answers`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
