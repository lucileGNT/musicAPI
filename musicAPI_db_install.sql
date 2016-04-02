-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mar 05 Mai 2015 à 00:14
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `musicapi_db`
--
CREATE DATABASE `musicapi_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `musicapi_db`;

-- --------------------------------------------------------

--
-- Structure de la table `favorite_songs`
--

CREATE TABLE IF NOT EXISTS `favorite_songs` (
  `song_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`song_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `favorite_songs`
--

INSERT INTO `favorite_songs` (`song_id`, `user_id`) VALUES
(1, 1),
(1, 3),
(2, 3),
(3, 1),
(3, 2),
(4, 2),
(5, 1),
(5, 2);

-- --------------------------------------------------------

--
-- Structure de la table `song`
--

CREATE TABLE IF NOT EXISTS `song` (
  `song_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `duration` int(11) NOT NULL,
  PRIMARY KEY (`song_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `song`
--

INSERT INTO `song` (`song_id`, `title`, `duration`) VALUES
(1, 'Pharell Williams - Get Lucky', 250),
(2, 'Rihanna - Diamonds', 341),
(3, 'Lilly Wood and The Prick - Prayer in C', 325),
(4, 'Mark Ronson - Uptown Funk', 387),
(5, 'Sia - Chandelier', 275);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`user_id`, `name`, `email`) VALUES
(1, 'Pierre', 'pierre@mail.com'),
(2, 'Paul', 'paul@mail.fr'),
(3, 'Jacques', 'jacques@monmail.fr');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
