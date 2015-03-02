-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 02, 2015 at 01:08 AM
-- Server version: 5.5.41
-- PHP Version: 5.4.36-0+deb7u3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `qr`
--

-- --------------------------------------------------------

--
-- Table structure for table `ranks`
--

CREATE TABLE IF NOT EXISTS `ranks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `name` varchar(80) DEFAULT NULL,
  `quote` text,
  `ranktype` varchar(40) DEFAULT NULL,
  `rankvalue` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `ranks`
--

INSERT INTO `ranks` (`id`, `created`, `modified`, `name`, `quote`, `ranktype`, `rankvalue`) VALUES
(4, '2015-03-01 23:28:01', '2015-03-01 23:28:01', 'Slack-jawed', '', 'prefix', 0),
(5, '2015-03-01 23:28:17', '2015-03-01 23:28:17', 'Hillbilly', '', 'prefix', 0),
(6, '2015-03-01 23:28:31', '2015-03-01 23:28:31', 'Wanderer', '', 'title', 0),
(7, '2015-03-01 23:28:40', '2015-03-01 23:28:40', 'Yokel', '', 'title', 0),
(8, '2015-03-01 23:29:08', '2015-03-01 23:29:08', 'You can do it!', 'Keep browsing to increase your rank.', 'quote', 0),
(9, '2015-03-01 23:29:22', '2015-03-01 23:29:22', 'Junior', '', 'prefix', 1),
(10, '2015-03-01 23:29:35', '2015-03-01 23:29:35', 'Novice', '', 'prefix', 1),
(11, '2015-03-01 23:29:48', '2015-03-01 23:29:48', 'Beginner', '', 'prefix', 1),
(12, '2015-03-01 23:30:00', '2015-03-01 23:30:00', 'Dabbler', '', 'title', 1),
(13, '2015-03-01 23:30:11', '2015-03-01 23:30:11', 'Browser', '', 'title', 1),
(14, '2015-03-01 23:30:35', '2015-03-01 23:30:35', 'Buffalo Bill', 'I could never resist the call of the trail.', 'quote', 1),
(15, '2015-03-01 23:30:46', '2015-03-01 23:30:46', 'Aspiring', '', 'prefix', 2),
(16, '2015-03-01 23:30:59', '2015-03-01 23:30:59', 'Versatile', '', 'prefix', 2),
(17, '2015-03-01 23:31:15', '2015-03-01 23:31:15', 'Burgeoning', '', 'prefix', 2),
(18, '2015-03-01 23:31:33', '2015-03-01 23:31:33', 'Sightseer', '', 'title', 2),
(19, '2015-03-01 23:31:45', '2015-03-01 23:31:45', 'Tourist', '', 'title', 2),
(20, '2015-03-01 23:32:03', '2015-03-01 23:32:03', 'Buffalo Bill', 'My restless, roaming spirit would not allow me to remain at home very long.', 'quote', 2),
(21, '2015-03-01 23:32:17', '2015-03-01 23:32:17', 'Experienced', '', 'prefix', 3),
(22, '2015-03-01 23:32:28', '2015-03-01 23:32:28', 'Competent', '', 'prefix', 3),
(23, '2015-03-01 23:32:39', '2015-03-01 23:32:39', 'Adept', '', 'prefix', 3),
(24, '2015-03-01 23:32:48', '2015-03-01 23:32:48', 'Explorer', '', 'title', 3),
(25, '2015-03-01 23:32:55', '2015-03-01 23:32:55', 'Trailhand', '', 'title', 3),
(26, '2015-03-01 23:33:23', '2015-03-01 23:33:23', 'Buffalo Bill', 'I was persuaded now that I was destined to lead a life on the Plains.', 'quote', 3),
(27, '2015-03-01 23:33:35', '2015-03-01 23:33:35', 'Disciplined', '', 'prefix', 4),
(28, '2015-03-01 23:33:50', '2015-03-01 23:33:50', 'Accomplished', '', 'prefix', 4),
(29, '2015-03-01 23:34:00', '2015-03-01 23:34:00', 'Exemplary', '', 'prefix', 4),
(30, '2015-03-01 23:34:11', '2015-03-01 23:34:11', 'Searcher', '', 'title', 4),
(31, '2015-03-01 23:34:22', '2015-03-01 23:34:22', 'Adventurer', '', 'title', 4),
(32, '2015-03-01 23:34:42', '2015-03-01 23:34:42', 'Buffalo Bill', 'It was my effort, in depicting the West, to depict it as it was.', 'quote', 4),
(33, '2015-03-01 23:34:54', '2015-03-01 23:34:54', 'Reverend', '', 'prefix', 5),
(34, '2015-03-01 23:35:02', '2015-03-01 23:35:02', 'Honorable', '', 'prefix', 5),
(35, '2015-03-01 23:35:12', '2015-03-01 23:35:12', 'Grand Master', '', 'prefix', 5),
(36, '2015-03-01 23:35:20', '2015-03-01 23:35:20', 'Curator', '', 'title', 5),
(37, '2015-03-01 23:35:29', '2015-03-01 23:35:29', 'Scout', '', 'title', 5),
(38, '2015-03-01 23:35:59', '2015-03-01 23:35:59', 'Buffalo Bill', 'Frontiersmen good and bad, gunmen as well as inspired prophets of the future, have been my camp companions. Thus, I know the country of which I am about to write as few men now living have known it.', 'quote', 5);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
