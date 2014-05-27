-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 28, 2014 at 03:14 AM
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
-- Table structure for table `BlogPosts`
--

CREATE TABLE IF NOT EXISTS `BlogPosts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `postedTimestamp` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4BC03615166D1F9C` (`project_id`),
  KEY `IDX_4BC03615A76ED395` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `BlogPosts`
--

INSERT INTO `BlogPosts` (`id`, `project_id`, `user_id`, `title`, `content`, `postedTimestamp`) VALUES
(1, 10, 2, 'This is a test', 'I really wish mysql had a lorem ipsum function', '2014-05-28 01:41:08'),
(2, 10, 7, 'Yet another test', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2014-05-28 01:41:56');

-- --------------------------------------------------------

--
-- Table structure for table `Comments`
--

CREATE TABLE IF NOT EXISTS `Comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `content` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `postedTimestamp` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5BC96BF0A76ED395` (`user_id`),
  KEY `IDX_5BC96BF0166D1F9C` (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `Comments`
--

INSERT INTO `Comments` (`id`, `user_id`, `project_id`, `content`, `postedTimestamp`) VALUES
(1, 2, 10, 'I would love to park my bike on the edge of the botanic gardens!', '2014-05-26 02:27:03'),
(2, 1, 10, 'Lets do this!', '2014-05-27 11:10:03');

-- --------------------------------------------------------

--
-- Table structure for table `DiscussionPosts`
--

CREATE TABLE IF NOT EXISTS `DiscussionPosts` (
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
-- Table structure for table `Projects`
--

CREATE TABLE IF NOT EXISTS `Projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `summary` text COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `category` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `skills` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:simple_array)',
  `featureImageUrl` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'emptyProject.jpg',
  `stage` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `likes` int(11) NOT NULL,
  `createdTimestamp` datetime NOT NULL,
  `videoUrl` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fileShareUrl` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `createdBy_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E00EE9723174800F` (`createdBy_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=38 ;

--
-- Dumping data for table `Projects`
--

INSERT INTO `Projects` (`id`, `title`, `summary`, `description`, `category`, `skills`, `featureImageUrl`, `stage`, `likes`, `createdTimestamp`, `videoUrl`, `fileShareUrl`, `location`, `createdBy_id`) VALUES
(1, 'LDI ProjectHub', 'This very site you''re using!', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Developing', 70, '0000-00-00 00:00:00', '', '', '', 1),
(2, 'lorem ipsum', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Developing', 73, '0000-00-00 00:00:00', '', '', '', 1),
(3, 'lorem ipsum', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Developing', 72, '0000-00-00 00:00:00', '', '', '', 1),
(4, 'lorem ipsum', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Developing', 74, '0000-00-00 00:00:00', '', '', '', 1),
(5, 'lorem ipsum', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Developing', 23, '0000-00-00 00:00:00', '', '', '', 1),
(6, 'lorem ipsum', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Developing', 56, '0000-00-00 00:00:00', '', '', '', 1),
(7, 'lorem ipsum', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Developing', 74, '0000-00-00 00:00:00', '', '', '', 1),
(8, 'lorem ipsum', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Developing', 36, '0000-00-00 00:00:00', '', '', '', 1),
(9, 'lorem ipsum', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Developing', 26, '0000-00-00 00:00:00', '', '', '', 1),
(10, 'More Bike Parking', 'We''re campaigning to convince QUT to install easier access bicycle parking!', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Aspiration', 15, '0000-00-00 00:00:00', '', '', '', 1),
(11, 'lorem ipsum', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Aspiration', 8, '0000-00-00 00:00:00', '', '', '', 1),
(12, 'lorem ipsum', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Aspiration', 15, '0000-00-00 00:00:00', '', '', '', 1),
(13, 'lorem ipsum', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Aspiration', 6, '0000-00-00 00:00:00', '', '', '', 1),
(14, 'lorem ipsum', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Aspiration', 3, '0000-00-00 00:00:00', '', '', '', 1),
(15, 'lorem ipsum', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Aspiration', 0, '0000-00-00 00:00:00', '', '', '', 1),
(16, 'lorem ipsum', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Aspiration', 0, '0000-00-00 00:00:00', '', '', '', 1),
(17, 'lorem ipsum', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Aspiration', 35, '0000-00-00 00:00:00', '', '', '', 1),
(18, 'lorem ipsum', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Aspiration', 22, '0000-00-00 00:00:00', '', '', '', 1),
(19, 'lorem ipsum', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Incubating', 22, '0000-00-00 00:00:00', '', '', '', 1),
(20, 'lorem ipsum', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Incubating', 24, '0000-00-00 00:00:00', '', '', '', 1),
(21, 'lorem ipsum', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Incubating', 64, '0000-00-00 00:00:00', '', '', '', 1),
(22, 'lorem ipsum', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Incubating', 62, '0000-00-00 00:00:00', '', '', '', 1),
(23, 'lorem ipsum', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Incubating', 75, '0000-00-00 00:00:00', '', '', '', 1),
(24, 'lorem ipsum', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Incubating', 47, '0000-00-00 00:00:00', '', '', '', 1),
(25, 'lorem ipsum', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Incubating', 37, '0000-00-00 00:00:00', '', '', '', 1),
(26, 'lorem ipsum', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Incubating', 35, '0000-00-00 00:00:00', '', '', '', 1),
(27, 'lorem ipsum', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Incubating', 43, '0000-00-00 00:00:00', '', '', '', 1),
(28, 'lorem ipsum', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Mature', 100, '0000-00-00 00:00:00', '', '', '', 1),
(29, 'lorem ipsum', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Mature', 120, '0000-00-00 00:00:00', '', '', '', 1),
(30, 'lorem ipsum', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Mature', 120, '0000-00-00 00:00:00', '', '', '', 1),
(31, 'lorem ipsum', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Mature', 120, '0000-00-00 00:00:00', '', '', '', 1),
(32, 'lorem ipsum', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Mature', 120, '0000-00-00 00:00:00', '', '', '', 1),
(33, 'lorem ipsum', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Mature', 120, '0000-00-00 00:00:00', '', '', '', 1),
(34, 'lorem ipsum', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Mature', 120, '0000-00-00 00:00:00', '', '', '', 1),
(35, 'lorem ipsum', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Mature', 120, '0000-00-00 00:00:00', '', '', '', 1),
(36, 'lorem ipsum', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Mature', 120, '0000-00-00 00:00:00', '', '', '', 1),
(37, 'Test', 'I like biscuits', 'lets open a biscuit factoryWords', 'personal excellence', 'tag1,tag2', 'url', 'Aspiration', 0, '0000-00-00 00:00:00', '', '', 'url', 1);

-- --------------------------------------------------------

--
-- Table structure for table `project_likes`
--

CREATE TABLE IF NOT EXISTS `project_likes` (
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`project_id`,`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `project_likes`
--

INSERT INTO `project_likes` (`project_id`, `user_id`) VALUES
(10, 1),
(10, 7);

-- --------------------------------------------------------

--
-- Table structure for table `project_roles`
--

CREATE TABLE IF NOT EXISTS `project_roles` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `title` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `blurb` text COLLATE utf8_unicode_ci,
  `tags` text COLLATE utf8_unicode_ci NOT NULL,
  `filled_by` int(11) DEFAULT NULL COMMENT 'user_id',
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  KEY `project_id_2` (`project_id`),
  KEY `filled_by` (`filled_by`),
  FULLTEXT KEY `tags` (`tags`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `project_roles`
--

INSERT INTO `project_roles` (`id`, `project_id`, `title`, `blurb`, `tags`, `filled_by`) VALUES
(1, 10, 'Developer', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et, omnis, consectetur, perferendis molestias at a unde tenetur atque voluptas sequi nam earum alias aliquid soluta fugiat in consequatur cum minus.', 'php,mysql,html/css', 2),
(2, 10, 'Designer', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. ', 'photoshop,design,watercolours', NULL),
(3, 10, 'Database Engineer', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.', 'mysql,sql,db normalisation', NULL),
(4, 10, 'Photographer', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.', 'photography,photoshop', NULL),
(5, 10, 'Developer', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et, omnis, consectetur, perferendis molestias at a unde tenetur atque voluptas sequi nam earum alias aliquid soluta fugiat in consequatur cum minus.', 'php,mysql,html/css', 7);

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

--
-- Dumping data for table `project_user`
--

INSERT INTO `project_user` (`project_id`, `user_id`) VALUES
(10, 2),
(10, 7);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `session_id` int(11) NOT NULL,
  `session_data` text COLLATE utf8_unicode_ci NOT NULL,
  `session_start` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `blurb` longtext COLLATE utf8_unicode_ci NOT NULL,
  `tags` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:simple_array)',
  `profilePicUrl` varchar(225) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'images/profile/none.png',
  `active` tinyint(1) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `created_timestamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `email_2` (`email`),
  FULLTEXT KEY `tags` (`tags`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `blurb`, `tags`, `profilePicUrl`, `active`, `is_admin`, `created_timestamp`) VALUES
(1, 'Jimi', 'Bursaw', 'jimi@ldi.org.au', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', 'images/profile/jimi.jpg', 1, 1, '2014-05-27 08:37:39'),
(2, 'Fred', 'Stark', 'coagmano@gmail.com', 'ea6b06c5e0f6688bc8a749f5c0cda8b44e2ba74a', 'From Winterfell', 'words,ldi,qut', 'images/profile/fred.jpg', 0, 0, '2014-05-27 08:35:11'),
(7, 'Yancie', 'Ng', 'yancie@fake.com', '', '', '', 'images/profile/none.png', 0, 0, '2014-05-27 08:38:53');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `project_likes`
--
ALTER TABLE `project_likes`
  ADD CONSTRAINT `project_likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project_roles`
--
ALTER TABLE `project_roles`
  ADD CONSTRAINT `project_roles_ibfk_1` FOREIGN KEY (`filled_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `project_user`
--
ALTER TABLE `project_user`
  ADD CONSTRAINT `project_user_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
