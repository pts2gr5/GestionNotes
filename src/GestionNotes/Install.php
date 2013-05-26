<?php
/*
-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Dim 26 Mai 2013 à 18:36
-- Version du serveur: 5.5.29
-- Version de PHP: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données: `GestionNotes`
--

-- --------------------------------------------------------

--
-- Structure de la table `nodes`
--

CREATE TABLE IF NOT EXISTS `nodes` (
  `node_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `node_title` varchar(35) NOT NULL,
  `node_type` smallint(5) unsigned NOT NULL,
  `parent_node_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`node_id`),
  UNIQUE KEY `UNIQUE_node` (`node_title`,`node_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `nodes`
--

INSERT INTO `nodes` (`node_id`, `node_title`, `node_type`, `parent_node_id`) VALUES
(1, 'Département INFO', 1, NULL),
(2, 'DUT Informatique', 2, 1),
(3, 'Semestre 2', 3, 2);

-- --------------------------------------------------------

--
-- Structure de la table `notes`
--

CREATE TABLE IF NOT EXISTS `notes` (
  `note_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `module_id` int(10) unsigned NOT NULL,
  `coefficient` float unsigned NOT NULL DEFAULT '1',
  `title` varchar(35) NOT NULL,
  PRIMARY KEY (`note_id`),
  UNIQUE KEY `UNIQUE_note` (`coefficient`,`title`,`module_id`),
  KEY `module_id_idx` (`module_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `student_notes`
--

CREATE TABLE IF NOT EXISTS `student_notes` (
  `student_note_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `note_id` int(10) unsigned NOT NULL,
  `student_note` float unsigned NOT NULL,
  PRIMARY KEY (`student_note_id`),
  UNIQUE KEY `note_idx` (`user_id`,`note_id`),
  KEY `node_id_idx` (`note_id`),
  KEY `user_id_idx` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `password_salt`, `type`, `first_name`, `last_name`, `apogee_code`, `formation_id`, `followed_students`) VALUES
(2, 'admin', 'admin@example.net', 'ebf796a9310b6e886f26bfc6eb4874b2', '5172b9f2b0287', 1, NULL, NULL, NULL, NULL, NULL);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `module_id` FOREIGN KEY (`module_id`) REFERENCES `nodes` (`node_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `formation_id` FOREIGN KEY (`formation_id`) REFERENCES `nodes` (`node_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
*/