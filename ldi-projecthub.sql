-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 19, 2014 at 06:25 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ldi-projecthub`
--

-- --------------------------------------------------------

--
-- Table structure for table `BlogPost`
--

CREATE TABLE IF NOT EXISTS `BlogPost` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `postedTimestamp` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4BC03615166D1F9C` (`project_id`),
  KEY `IDX_4BC03615A76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Comment`
--

CREATE TABLE IF NOT EXISTS `Comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `message` longtext COLLATE utf8_unicode_ci NOT NULL,
  `createdTimestamp` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5BC96BF0A76ED395` (`user_id`),
  KEY `IDX_5BC96BF0166D1F9C` (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `DiscussionPost`
--

CREATE TABLE IF NOT EXISTS `DiscussionPost` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `message` longtext COLLATE utf8_unicode_ci NOT NULL,
  `postedTimestamp` datetime NOT NULL,
  `postedBy_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7BC93423B3920A8B` (`postedBy_id`),
  KEY `IDX_7BC93423166D1F9C` (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Project`
--

CREATE TABLE IF NOT EXISTS `Project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `category` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `skills` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:simple_array)',
  `featureImageUrl` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'emptyProject.jpg',
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `likes` int(11) NOT NULL,
  `createdTimestamp` datetime NOT NULL,
  `videoUrl` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fileShareUrl` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `createdBy_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E00EE9723174800F` (`createdBy_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=37 ;

--
-- Dumping data for table `Project`
--

INSERT INTO `Project` (`id`, `title`, `description`, `category`, `skills`, `featureImageUrl`, `status`, `likes`, `createdTimestamp`, `videoUrl`, `fileShareUrl`, `location`, `createdBy_id`) VALUES
(1, 'lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Developing', 70, '0000-00-00 00:00:00', '', '', '', 1),
(2, 'lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Developing', 73, '0000-00-00 00:00:00', '', '', '', 1),
(3, 'lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Developing', 72, '0000-00-00 00:00:00', '', '', '', 1),
(4, 'lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Developing', 74, '0000-00-00 00:00:00', '', '', '', 1),
(5, 'lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Developing', 23, '0000-00-00 00:00:00', '', '', '', 1),
(6, 'lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Developing', 56, '0000-00-00 00:00:00', '', '', '', 1),
(7, 'lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Developing', 74, '0000-00-00 00:00:00', '', '', '', 1),
(8, 'lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Developing', 36, '0000-00-00 00:00:00', '', '', '', 1),
(9, 'lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Developing', 26, '0000-00-00 00:00:00', '', '', '', 1),
(10, 'lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Aspiration', 0, '0000-00-00 00:00:00', '', '', '', 1),
(11, 'lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Aspiration', 8, '0000-00-00 00:00:00', '', '', '', 1),
(12, 'lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Aspiration', 15, '0000-00-00 00:00:00', '', '', '', 1),
(13, 'lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Aspiration', 6, '0000-00-00 00:00:00', '', '', '', 1),
(14, 'lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Aspiration', 3, '0000-00-00 00:00:00', '', '', '', 1),
(15, 'lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Aspiration', 0, '0000-00-00 00:00:00', '', '', '', 1),
(16, 'lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Aspiration', 0, '0000-00-00 00:00:00', '', '', '', 1),
(17, 'lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Aspiration', 35, '0000-00-00 00:00:00', '', '', '', 1),
(18, 'lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Aspiration', 22, '0000-00-00 00:00:00', '', '', '', 1),
(19, 'lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Incubating', 22, '0000-00-00 00:00:00', '', '', '', 1),
(20, 'lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Incubating', 24, '0000-00-00 00:00:00', '', '', '', 1),
(21, 'lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Incubating', 64, '0000-00-00 00:00:00', '', '', '', 1),
(22, 'lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Incubating', 62, '0000-00-00 00:00:00', '', '', '', 1),
(23, 'lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Incubating', 75, '0000-00-00 00:00:00', '', '', '', 1),
(24, 'lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Incubating', 47, '0000-00-00 00:00:00', '', '', '', 1),
(25, 'lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Incubating', 37, '0000-00-00 00:00:00', '', '', '', 1),
(26, 'lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Incubating', 35, '0000-00-00 00:00:00', '', '', '', 1),
(27, 'lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Incubating', 43, '0000-00-00 00:00:00', '', '', '', 1),
(28, 'lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Mature', 100, '0000-00-00 00:00:00', '', '', '', 1),
(29, 'lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Mature', 120, '0000-00-00 00:00:00', '', '', '', 1),
(30, 'lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Mature', 120, '0000-00-00 00:00:00', '', '', '', 1),
(31, 'lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Mature', 120, '0000-00-00 00:00:00', '', '', '', 1),
(32, 'lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Mature', 120, '0000-00-00 00:00:00', '', '', '', 1),
(33, 'lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Mature', 120, '0000-00-00 00:00:00', '', '', '', 1),
(34, 'lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Mature', 120, '0000-00-00 00:00:00', '', '', '', 1),
(35, 'lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Mature', 120, '0000-00-00 00:00:00', '', '', '', 1),
(36, 'lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Mature', 120, '0000-00-00 00:00:00', '', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `project_user`
--

CREATE TABLE IF NOT EXISTS `project_user` (
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`project_id`,`user_id`),
  KEY `IDX_B4021E51166D1F9C` (`project_id`),
  KEY `IDX_B4021E51A76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE IF NOT EXISTS `User` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `blurb` longtext COLLATE utf8_unicode_ci NOT NULL,
  `tags` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:simple_array)',
  `profilePicUrl` longblob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`id`, `blurb`, `tags`, `profilePicUrl`) VALUES
(1, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `BlogPost`
--
ALTER TABLE `BlogPost`
  ADD CONSTRAINT `FK_4BC03615166D1F9C` FOREIGN KEY (`project_id`) REFERENCES `Project` (`id`),
  ADD CONSTRAINT `FK_4BC03615A76ED395` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`);

--
-- Constraints for table `Comment`
--
ALTER TABLE `Comment`
  ADD CONSTRAINT `FK_5BC96BF0166D1F9C` FOREIGN KEY (`project_id`) REFERENCES `Project` (`id`),
  ADD CONSTRAINT `FK_5BC96BF0A76ED395` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`);

--
-- Constraints for table `DiscussionPost`
--
ALTER TABLE `DiscussionPost`
  ADD CONSTRAINT `FK_7BC93423166D1F9C` FOREIGN KEY (`project_id`) REFERENCES `Project` (`id`),
  ADD CONSTRAINT `FK_7BC93423B3920A8B` FOREIGN KEY (`postedBy_id`) REFERENCES `User` (`id`);

--
-- Constraints for table `Project`
--
ALTER TABLE `Project`
  ADD CONSTRAINT `FK_E00EE9723174800F` FOREIGN KEY (`createdBy_id`) REFERENCES `User` (`id`);

--
-- Constraints for table `project_user`
--
ALTER TABLE `project_user`
  ADD CONSTRAINT `FK_B4021E51166D1F9C` FOREIGN KEY (`project_id`) REFERENCES `Project` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_B4021E51A76ED395` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
