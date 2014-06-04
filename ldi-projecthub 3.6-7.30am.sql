-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 03, 2014 at 07:36 AM
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
(1, 2, 2, 'This is a test', 'I really wish mysql had a lorem ipsum function', '2014-05-28 01:41:08'),
(2, 2, 7, 'Yet another test', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2014-05-28 01:41:56');

-- --------------------------------------------------------

--
-- Table structure for table `Comments`
--

CREATE TABLE IF NOT EXISTS `Comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `content` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `postedTimestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `IDX_5BC96BF0A76ED395` (`user_id`),
  KEY `IDX_5BC96BF0166D1F9C` (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `Comments`
--

INSERT INTO `Comments` (`id`, `user_id`, `project_id`, `content`, `postedTimestamp`) VALUES
(1, 2, 2, 'I would love to park my bike on the edge of the botanic gardens!', '0000-00-00 00:00:00'),
(2, 1, 2, 'Lets do this!', '0000-00-00 00:00:00'),
(10, 1, 2, 'TEst TESTFred likes to test', '0000-00-00 00:00:00'),
(12, 1, 2, 'I am writing a comment', '0000-00-00 00:00:00'),
(13, 1, 2, 'wheeeeee', '0000-00-00 00:00:00');

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
  `createdTimestamp` datetime NOT NULL,
  `videoUrl` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fileShareUrl` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `createdBy_id` int(11) DEFAULT NULL,
  `published` tinyint(1) NOT NULL,
  `featured` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E00EE9723174800F` (`createdBy_id`),
  KEY `category` (`category`),
  FULLTEXT KEY `title` (`title`,`summary`,`description`,`category`,`stage`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=53 ;

--
-- Dumping data for table `Projects`
--

INSERT INTO `Projects` (`id`, `title`, `summary`, `description`, `category`, `skills`, `featureImageUrl`, `stage`, `createdTimestamp`, `videoUrl`, `fileShareUrl`, `location`, `createdBy_id`, `published`, `featured`) VALUES
(1, 'LDI ProjectHub', 'This very site you''re using!', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Implementation', '0000-00-00 00:00:00', '', '', '', 1, 1, 0),
(2, 'More Bike Parking', 'We''re campaigning to convince QUT to install easier access bicycle parking!', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', 'Social &amp; Global Change Project', '', 'emptyProject.jpg', 'Aspiration', '0000-00-00 00:00:00', '', '', '', 1, 1, 1),
(3, 'Implementaion', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Implementation', '0000-00-00 00:00:00', '', '', '', 1, 1, 0),
(8, 'Boats race for refugees', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', 'Social Enterprise', '', 'emptyProject.jpg', 'Implementation', '0000-00-00 00:00:00', '', '', '', 1, 1, 0),
(9, 'lorem ipsum', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', 'Personal Development Project', '', 'emptyProject.jpg', 'Implementation', '0000-00-00 00:00:00', '', '', '', 1, 1, 0),
(18, 'lorem ipsum', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', 'Personal Development Project', '', 'emptyProject.jpg', 'Aspiration', '0000-00-00 00:00:00', '', '', '', 1, 1, 0),
(19, 'LFG', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Incubation', '0000-00-00 00:00:00', '', '', '', 1, 1, 0),
(20, 'Incubating eggs!', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Incubation', '0000-00-00 00:00:00', '', '', '', 1, 1, 0),
(21, 'lorem ipsum', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', 'Personal Development Project', '', 'emptyProject.jpg', 'Incubation', '0000-00-00 00:00:00', '', '', '', 1, 1, 0),
(34, 'We did it, we''re mature', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Maturation', '0000-00-00 00:00:00', '', '', '', 1, 1, 0),
(35, 'Maturation is da bomb', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', 'Personal Development Project', '', 'emptyProject.jpg', 'Maturation', '0000-00-00 00:00:00', '', '', '', 1, 1, 0),
(36, 'lorem ipsum', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', '', '', 'emptyProject.jpg', 'Maturation', '0000-00-00 00:00:00', '', '', '', 1, 1, 0),
(37, 'Test', 'I like biscuits', 'lets open a biscuit factoryWords', 'personal excellence', 'tag1,tag2', 'emptyProject.jpg', 'Aspiration', '0000-00-00 00:00:00', '', '', 'url', 1, 1, 0),
(51, 'LDI Candy Store', 'You love candy right! Lets get our own&nbsp;candy store :D&nbsp;', 'A little bit of context[Set the scene. Zoom right out and set the scene for your audience. Many of them will already know this, but it moves their brain into the right frame to introduce what youâ€™re doing.]But thereâ€™s a problem[Explain what the problem is in the current context. Normally thereâ€™s something broken in the current context or thereâ€™s an opportunity â€“ whichever it is, tell people what the issue is, before you tell them how youâ€™re going to solve (or take advantage of) it.]Hereâ€™s what weâ€™re doing about it[What are you doing to solve the issue? This is where you talk about what youâ€™re going to do. Keep it simple and specific.]                        And what you hope to achieve[How will what you do change the world? Hereâ€™s where you talk about how what youâ€™re doing will make a difference.]You can join us[Every leader needs followers, encourage people to join you! Explain briefly what people can expect to put in and get out]', 'Student/Campus Community Project', '', '', 'Aspiration', '0000-00-00 00:00:00', '', '', 'GP', 1, 1, 0),
(52, 'LDI Candy Store', 'You love candy right! Lets get our own&nbsp;candy store :D&nbsp;', 'A little bit of context[Set the scene. Zoom right out and set the scene for your audience. Many of them will already know this, but it moves their brain into the right frame to introduce what youâ€™re doing.]But thereâ€™s a problem[Explain what the problem is in the current context. Normally thereâ€™s something broken in the current context or thereâ€™s an opportunity â€“ whichever it is, tell people what the issue is, before you tell them how youâ€™re going to solve (or take advantage of) it.]Hereâ€™s what weâ€™re doing about it[What are you doing to solve the issue? This is where you talk about what youâ€™re going to do. Keep it simple and specific.]                        And what you hope to achieve[How will what you do change the world? Hereâ€™s where you talk about how what youâ€™re doing will make a difference.]You can join us[Every leader needs followers, encourage people to join you! Explain briefly what people can expect to put in and get out]', 'Business Enterprise', '', '', 'Aspiration', '0000-00-00 00:00:00', '', '', 'GP', 1, 1, 0);

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
(2, 1),
(15, 1),
(35, 1),
(37, 1),
(2, 7);

-- --------------------------------------------------------

--
-- Table structure for table `project_requests`
--

CREATE TABLE IF NOT EXISTS `project_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `project_requests`
--

INSERT INTO `project_requests` (`id`, `project_id`, `role_id`, `user_id`, `message`, `timestamp`) VALUES
(1, 2, 0, 1, 'dsfsdfdsfsd', '2014-06-02 21:34:41');

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
(1, 2, 'Developer', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et, omnis, consectetur, perferendis molestias at a unde tenetur atque voluptas sequi nam earum alias aliquid soluta fugiat in consequatur cum minus.', 'php,mysql,html/css', 2),
(2, 2, 'Designer', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. ', 'photoshop,design,watercolours', 7),
(3, 2, 'Database Engineer', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.', 'mysql,sql,db normalisation', NULL),
(4, 2, 'Photographer', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.', 'photography,photoshop', NULL),
(5, 2, 'Developer', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et, omnis, consectetur, perferendis molestias at a unde tenetur atque voluptas sequi nam earum alias aliquid soluta fugiat in consequatur cum minus.', 'php,mysql,html/css', 7);

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
(2, 2),
(2, 7);

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
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tag` (`tag`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `tag`, `project_id`, `user_id`, `role_id`) VALUES
(1, 'accounting', 51, 0, 0),
(2, 'sales', 51, 0, 0),
(3, 'marketing', 51, 0, 0),
(4, 'love-of-candy', 51, 0, 0);

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
  `student_number` int(8) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `email_2` (`email`),
  FULLTEXT KEY `tags` (`tags`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `blurb`, `tags`, `profilePicUrl`, `active`, `is_admin`, `created_timestamp`, `student_number`) VALUES
(1, 'Jimi', 'Bursaw', 'jimi@ldi.org.au', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, quas aspernatur ipsam numquam magnam minima officia nesciunt deleniti sunt impedit!', 'leadership,project-management', 'jimi.jpg', 1, 1, '2014-06-02 21:26:33', 0),
(2, 'Fred', 'Stark', 'coagmano@gmail.com', 'ea6b06c5e0f6688bc8a749f5c0cda8b44e2ba74a', 'From Winterfell', 'words,ldi,qut', 'fred.jpg', 1, 0, '2014-05-29 01:31:32', 0),
(7, 'Yancie', 'Ng', 'yancie@fake.com', '', '', '', 'none.png', 1, 0, '2014-05-29 01:32:48', 0),
(8, 'Fred', 'Stark', 'test@test.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'words', '', '', 0, 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_whitelist`
--

CREATE TABLE IF NOT EXISTS `user_whitelist` (
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
