-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2018 at 05:40 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assignment`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `article_id` int(6) NOT NULL,
  `email_id` varchar(45) NOT NULL,
  `heading` varchar(400) NOT NULL,
  `image_link` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='assignment ';

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`article_id`, `email_id`, `heading`, `image_link`) VALUES
(0, 'lrk2529@gmail.com', 'Choosing a non-relational database; why we migrated from MySQL to MongoDB', '3.jpg'),
(1, 'lrk2529@gmail.com', '6 Essential Tips on How to Become a Full Stack Developer', '1.png'),
(2, 'lrk2529@gmail.com', 'A Guide to Becoming a Full-Stack Developer in 2018', '2.png');

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `article_id` int(6) NOT NULL,
  `email_id` varchar(45) NOT NULL,
  `heading` varchar(400) NOT NULL,
  `image_link` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='assignment ';

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`article_id`, `email_id`, `heading`, `image_link`) VALUES
(1, 'lrk2529@gmail.com', '6 Essential Tips on How to Become a Full Stack Developer', '1.png'),
(2, 'lrk2529@gmail.com', 'A Guide to Becoming a Full-Stack Developer in 2018', '2.png'),
(3, 'lrk2529@gmail.com', 'Choosing a non-relational database; why we migrated from MySQL to MongoDB', '3.jpg'),
(4, 'lrk2529@gmail.com', 'Notes from a production MongoDB deployment', '4.jpg'),
(5, 'lrk2529@gmail.com', 'Save new articles by the New York Times articles to MySQL rows', '5.png'),
(6, 'raman22bca@gmail.com', 'How to Knock Your Next Interview Out of the Park', '6.png'),
(7, 'ohm2393@gmail.com', 'How to Feel Like You Rocked the Interview Every Time', '7.jpg'),
(8, 'ohm2393@gmail.com', 'HOW TO WRITE AN INTERVIEW ASSIGNMENT? ', '8.png'),
(9, 'ohm2393@gmail.com', 'Job Interview Question: Why Do You Want This Job?', '9.jpg'),
(10, 'ohm2393@gmail.com', 'Talent and growth in the Indian SME sector', '10.jpg'),
(11, 'ohm2393@gmail.com', 'The Qualities of a Good Judge', '11.jpg'),
(12, 'diwakar2393@gmail.com', 'Good Friends Forever', '12.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `article_id` int(6) NOT NULL,
  `email_id` varchar(60) NOT NULL,
  `comment` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`article_id`, `email_id`, `comment`) VALUES
(2, 'diwakar2393@gmail.com', '  image is nice!'),
(2, 'diwakar2393@gmail.com', '  image is nice!'),
(2, 'diwakar2393@gmail.com', 'Color combination is marvelous!'),
(12, 'lrk2529@gmail.com', '  Nice topic'),
(2, 'lrk2529@gmail.com', '  color combination is good..');

-- --------------------------------------------------------

--
-- Table structure for table `like_info`
--

CREATE TABLE `like_info` (
  `article_id` int(6) NOT NULL,
  `email_id` varchar(60) NOT NULL,
  `type` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `like_info`
--

INSERT INTO `like_info` (`article_id`, `email_id`, `type`) VALUES
(12, 'diwakar2393@gmail.com', '1'),
(2, 'lrk2529@gmail.com', '1'),
(12, 'lrk2529@gmail.com', '1');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `name` varchar(45) NOT NULL,
  `email_id` varchar(60) NOT NULL,
  `password` varchar(45) NOT NULL,
  `pic_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='login_based_upon minimum requirement';

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`name`, `email_id`, `password`, `pic_name`) VALUES
('Diwakar kumar', 'diwakar2393@gmail.com', 'diwakar', 'diwakar2393@gmail.com.jpg'),
('raman', 'lrk2529@gmail.com', 'raman', '1.png'),
('OHM', 'ohm2393@gmail.com', 'abcde12345', 'ohm2393@gmail.com.jpg'),
('Raman kumar', 'raman22bca@gmail.com', '8730852612', '23.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`article_id`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`article_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`email_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
