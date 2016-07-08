-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Ven 08 Juillet 2016 à 18:22
-- Version du serveur: 5.5.49-0ubuntu0.14.04.1
-- Version de PHP: 5.5.9-1ubuntu4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `cloud`
--

-- --------------------------------------------------------

--
-- Structure de la table `login_info`
--

CREATE TABLE IF NOT EXISTS `login_info` (
  `login_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(120) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(30) NOT NULL,
  `browser` varchar(60) NOT NULL,
  `login_status` varchar(20) NOT NULL DEFAULT 'successful',
  `Attempts` text NOT NULL,
  `LastLogin` datetime NOT NULL,
  PRIMARY KEY (`login_id`),
  KEY `login_info user_email index` (`user_email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `oc_community`
--

CREATE TABLE IF NOT EXISTS `oc_community` (
  `id_feeds` mediumint(9) NOT NULL AUTO_INCREMENT,
  `user_id` text NOT NULL,
  `text` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `photo` text NOT NULL,
  `user_name` text NOT NULL,
  PRIMARY KEY (`id_feeds`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `oc_share`
--

CREATE TABLE IF NOT EXISTS `oc_share` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `share_type` smallint(6) NOT NULL DEFAULT '0',
  `uid_user` text COLLATE utf8_bin,
  `uid_owner` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `parent` int(11) DEFAULT NULL,
  `item_type` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `item_source` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `item_target` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `file_source` int(11) DEFAULT NULL,
  `file_target` varchar(512) COLLATE utf8_bin DEFAULT NULL,
  `permissions` smallint(6) NOT NULL DEFAULT '0',
  `stime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `accepted` smallint(6) NOT NULL DEFAULT '0',
  `expiration` datetime DEFAULT NULL,
  `token` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_share_type_index` (`item_type`,`share_type`),
  KEY `file_source_index` (`file_source`),
  KEY `token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `oc_split`
--

CREATE TABLE IF NOT EXISTS `oc_split` (
  `id_split` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` text NOT NULL,
  `index` text NOT NULL,
  `file_id` text NOT NULL,
  `user_id` text NOT NULL,
  `hash_file` text NOT NULL,
  PRIMARY KEY (`id_split`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `profile_info`
--

CREATE TABLE IF NOT EXISTS `profile_info` (
  `profile_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `free_size` bigint(20) NOT NULL DEFAULT '1073741824',
  `photo` varchar(500) NOT NULL DEFAULT 'images/flat-avatar.png',
  PRIMARY KEY (`profile_id`),
  KEY `userID foreign2` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `upload_file`
--

CREATE TABLE IF NOT EXISTS `upload_file` (
  `file_id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `mime` text NOT NULL,
  `size` bigint(11) NOT NULL,
  `data` longblob NOT NULL,
  `created` datetime NOT NULL,
  `hash` text NOT NULL,
  `ext` text NOT NULL,
  `splited` text NOT NULL,
  PRIMARY KEY (`file_id`),
  KEY `userid foreign key` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `user_info`
--

CREATE TABLE IF NOT EXISTS `user_info` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(120) NOT NULL,
  `user_name` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `join_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `verify_condition` varchar(20) NOT NULL DEFAULT 'unverified',
  `status` varchar(20) NOT NULL DEFAULT 'online',
  `first_name` varchar(60) NOT NULL DEFAULT 'na',
  `last_name` varchar(60) NOT NULL DEFAULT 'na',
  `mobile_number` varchar(20) NOT NULL DEFAULT 'na',
  `profile_pic` int(120) NOT NULL DEFAULT '0',
  `security_question` varchar(50) NOT NULL DEFAULT 'What is your favourite food item?',
  `security_answer` varchar(60) NOT NULL DEFAULT 'na',
  `check_admin` text NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `login_info`
--
ALTER TABLE `login_info`
  ADD CONSTRAINT `user_email foreign key` FOREIGN KEY (`user_email`) REFERENCES `user_info` (`user_email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `profile_info`
--
ALTER TABLE `profile_info`
  ADD CONSTRAINT `userID foreign2` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `upload_file`
--
ALTER TABLE `upload_file`
  ADD CONSTRAINT `userid foreign key` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
