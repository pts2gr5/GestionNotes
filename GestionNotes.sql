-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Ven 28 Juin 2013 à 22:38
-- Version du serveur: 5.5.29
-- Version de PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `GestionNotes`
--

-- --------------------------------------------------------

--
-- Structure de la table `nodes`
--

DROP TABLE IF EXISTS `nodes`;
CREATE TABLE `nodes` (
  `node_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `node_title` varchar(35) NOT NULL,
  `node_type` smallint(5) unsigned NOT NULL,
  `parent_node_id` int(10) unsigned NOT NULL DEFAULT '0',
  `coefficient` float unsigned DEFAULT NULL,
  PRIMARY KEY (`node_id`),
  UNIQUE KEY `node_uniq` (`node_title`,`node_type`,`parent_node_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

-- --------------------------------------------------------

--
-- Structure de la table `notes`
--

DROP TABLE IF EXISTS `notes`;
CREATE TABLE `notes` (
  `note_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `node_id` int(10) unsigned NOT NULL,
  `coefficient` float unsigned NOT NULL DEFAULT '1',
  `title` varchar(35) NOT NULL,
  PRIMARY KEY (`note_id`),
  UNIQUE KEY `UNIQUE_note` (`coefficient`,`title`,`node_id`),
  KEY `module_id_idx` (`node_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

-- --------------------------------------------------------

--
-- Structure de la table `student_notes`
--

DROP TABLE IF EXISTS `student_notes`;
CREATE TABLE `student_notes` (
  `student_note_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `note_id` int(10) unsigned NOT NULL,
  `student_note` float unsigned NOT NULL,
  PRIMARY KEY (`student_note_id`),
  UNIQUE KEY `note_idx` (`user_id`,`note_id`),
  UNIQUE KEY `user_id` (`user_id`,`note_id`),
  KEY `node_id_idx` (`note_id`),
  KEY `user_id_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8  ;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(32) NOT NULL,
  `password_salt` varchar(14) DEFAULT NULL,
  `type` smallint(3) unsigned NOT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `apogee_code` varchar(45) DEFAULT NULL,
  `formation_id` int(10) unsigned DEFAULT NULL,
  `followed_students` text,
  PRIMARY KEY (`user_id`),
  KEY `formation_id_idx` (`formation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8  ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
