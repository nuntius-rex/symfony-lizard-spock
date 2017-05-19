-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 19, 2017 at 02:56 AM
-- Server version: 5.5.55-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lizard_spock`
--

-- --------------------------------------------------------

--
-- Table structure for table `game_info`
--

CREATE TABLE IF NOT EXISTS `game_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `game_explanation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `challenge_msg` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `game_info`
--

INSERT INTO `game_info` (`id`, `name`, `code`, `game_explanation`, `challenge_msg`) VALUES
(1, 'Rock-Paper-Scissors-Lizard-Spock Code Demo', 'Symfony Framework - PHP', 'Explanation: This is a Symfony Framework (PHP) version of the game Rock-Paper-Scissors-Lizard-Spock, invented by Sam Kass and Karen Bryla, and made popular by the Big Bang Theory. ', 'Click Your Gesture to Challenge the Machine!');

-- --------------------------------------------------------

--
-- Table structure for table `game_stats`
--

CREATE TABLE IF NOT EXISTS `game_stats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `player` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `outcome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gesture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;


--
-- Table structure for table `gestures`
--

CREATE TABLE IF NOT EXISTS `gestures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `font_awesome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `action1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `action2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `list_order` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `gestures`
--

INSERT INTO `gestures` (`id`, `name`, `font_awesome`, `action1`, `action2`, `list_order`) VALUES
(1, 'Scissors', 'fa fa-hand-scissors-o fa-5x', 'cuts', 'decapitates', '3'),
(2, 'Paper', 'fa fa-hand-paper-o fa-5x', 'covers', 'disproves', '2'),
(3, 'Rock', 'fa fa-hand-rock-o fa-5x', 'crushes', 'crushes', '1'),
(4, 'Lizard', 'fa fa-hand-lizard-o fa-5x', 'poisons', 'eats', '4'),
(5, 'Spock', 'fa fa-hand-spock-o fa-5x', 'smashes', 'vaporizes', '5');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
