﻿-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 10 Mars 2017 à 10:16
-- Version du serveur :  5.7.9
-- Version de PHP :  5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `salt`
--

-- --------------------------------------------------------

--
-- Structure de la table `badge`
--
DROP TABLE IF EXISTS `badge`;
CREATE TABLE IF NOT EXISTS `badge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cond` int(11) NOT NULL,
  `name` tinytext NOT NULL,
  `icon` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

INSERT INTO `badge` (`id`, `cond`, `name`, `icon`) VALUES
(1, 1, 'Noob', 'dedededededed');

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `related_publication_id` int(11) NOT NULL,
  `publication_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `related_publication_id` (`related_publication_id`),
  KEY `publication_id` (`publication_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `comment`
--

INSERT INTO `comment` (`id`, `related_publication_id`, `publication_id`) VALUES
(1, 1, 13),
(2, 13, 15),
(3, 15, 16);

-- --------------------------------------------------------
--
-- Structure de la table `media`
--
DROP TABLE IF EXISTS `media`;
CREATE TABLE IF NOT EXISTS `media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` text NOT NULL,
  `type` tinytext NOT NULL,
  `publication_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `publication_id` (`publication_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `media`
--

INSERT INTO `media` (`id`, `link`, `type`, `publication_id`) VALUES
(1, 'https://vgy.me/yqYylA.jpg', 'img', 1);

-- --------------------------------------------------------

--
-- Structure de la table `publication`
--

DROP TABLE IF EXISTS `publication`;
CREATE TABLE IF NOT EXISTS `publication` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;



--
-- Contenu de la table `publication`
--

INSERT INTO `publication` (`id`, `text`, `date`, `user_id`) VALUES
(1, 'Jeune emo en quête de reconnaissance sociale, Alexandre a décidé de faire valoir son art sur des réseaux plus mainstream', '2017-03-02', 1),
(2, 'Ceci est un commentaire', '2017-03-01', 2),
(3, 'Ta mère est tellement laide que j''ai pas de chute à cette blague', '2017-03-06', 3),
(4, 'Ce commentaire répond à un commentaire', '2017-01-01', 2),
(5, 'Sans commentaire', '2017-01-01', 1),
(6, 'J''voudrais qu''il m''appelle Madame Bip, mais commentaire ?', '2017-01-01', 1),
(7, 'Bonjour, j''ai besoin d''aide parce que j''ai pas de répartie (signé mflouze)', '2017-01-01', 1),
(8, 'Waah ton post c''est de la grosse merde gros', '2017-07-03', 3),
(9, 'Waah ton post c''est VRAIMENT de la grosse merde gros', '2017-07-03', 3),
(10, 'On dirait une blague de Bessol', '2017-07-03', 1),
(11, 'Nan mais je rêve ???', '2017-07-03', 5),
(12, 'T''es tellement peu salé gros même l''eau est plus épicée ', '2017-07-03', 5),
(13, 'Moi ça m''excite', '2017-07-03', 4),
(14, 'T''as cru que t''avais du style dans ton peau de pêche bleu ??? Haaaan salooooope', '2017-03-08', 6),
(15, 'Ceci est un commentaire de commentaire', '2017-03-09', 1),
(16, 'Ceci est un commentaire de commentaire de commentaire', '2017-06-12', 1);

-- --------------------------------------------------------

--
-- Structure de la table `rel_tag_publication`
--

DROP TABLE IF EXISTS `rel_tag_publication`;
CREATE TABLE IF NOT EXISTS `rel_tag_publication` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `publication_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `publication_id` (`publication_id`),
  UNIQUE KEY `tag_id` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `stat`;
CREATE TABLE IF NOT EXISTS `stat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `value` int(11) NOT NULL,
  `related_element_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `related_element_id` (`related_element_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Structure de la table `stat`
--

DROP TABLE IF EXISTS `stat`;
CREATE TABLE IF NOT EXISTS `stat` (
  `id` int(11) NOT NULL,
  `name` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  `relaled_element_id` int(11) NOT NULL,
  `related_element_type` int(11) NOT NULL COMMENT '0 = subject, 1 = user'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='0 = sel, 1 = poivre, 2 = humour';

-- --------------------------------------------------------

--
-- Structure de la table `subject`
--

DROP TABLE IF EXISTS `subject`;
CREATE TABLE IF NOT EXISTS `subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` tinytext NOT NULL,
  `flair` tinytext NOT NULL,
  `type` tinytext NOT NULL,
  `publication_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `publication_id` (`publication_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `subject`
--

INSERT INTO `subject` (`id`, `title`, `flair`, `type`, `publication_id`) VALUES
(1, 'Un p''tit café salé ?', '', 'post', 1),
(2, 'Vous connaissez ma femme ?', 'edit', 'post', 13),
(3, 'Il boit du Sprite sa mère', '', 'post', 4),
(4, 'Le salage de Carthage par les Romains', '', 'post', 5),
(5, 'Salt is best, put Cerebos to the test', 'fermé', 'help', 6),
(6, 'Coucou Matthieu, ceci est un titre', 'edit', 'help', 7),
(7, 'Aidez-moi, j''suis coincée !', '', 'help', 8),
(8, 'Bouhou, il est triste', '', 'help', 9),
(9, 'Aluminium', '', 'post', 10),
(10, 'Julien Rousset est sur Tinder !', 'fermé', 'post', 11);

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

DROP TABLE IF EXISTS `tag`;
CREATE TABLE IF NOT EXISTS `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tag`
--

INSERT INTO `tag` (`id`, `name`) VALUES
(1, 'Esipe vs IMAC'),
(2, 'Marais salant'),
(3, 'Amour'),
(4, 'Potes'),
(5, 'Sexe'),
(6, 'Twitter'),
(7, 'Facebook'),
(8, 'IMAC 1'),
(9, 'Flavie'),
(10, 'Malaise TV');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mail` tinytext NOT NULL,
  `username` tinytext NOT NULL,
  `password` text NOT NULL,
  `avatar` text NOT NULL,
  `birthDate` date NOT NULL,
  `rank` int(11) NOT NULL,
  `signupDate` date NOT NULL,
  `badge_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `badge_id` (`badge_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `user` (`id`, `mail`, `username`, `password`, `avatar`, `birthDate`, `rank`, `signupDate`, `badge_id`) VALUES
(1, 'jc@gmail.com', 'JC', 'zef54fe6sf6e', 'jc.jpg', '1956-07-05', 0, '2017-03-01', 1);

ALTER TABLE `media`
  ADD CONSTRAINT `media_ibfk_1` FOREIGN KEY (`publication_id`) REFERENCES `publication` (`id`);

ALTER TABLE `publication`
  ADD CONSTRAINT `publication_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

ALTER TABLE `rel_tag_publication`
  ADD CONSTRAINT `rel_tag_publication_ibfk_1` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`),
  ADD CONSTRAINT `rel_tag_publication_ibfk_2` FOREIGN KEY (`publication_id`) REFERENCES `publication` (`id`);

ALTER TABLE `stat`
  ADD CONSTRAINT `stat_ibfk_2` FOREIGN KEY (`related_element_id`) REFERENCES `publication` (`id`);

ALTER TABLE `subject`
  ADD CONSTRAINT `subject_ibfk_1` FOREIGN KEY (`publication_id`) REFERENCES `publication` (`id`);

ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`badge_id`) REFERENCES `badge` (`id`);
  `badge_id` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `badge_id` (`badge_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `mail`, `username`, `password`, `avatar`, `birthDate`, `rank`, `signupDate`, `badge_id`) VALUES
(1, 'jc@gmail.com', 'JC', 'zef54fe6sf6e', 'https://vgy.me/fxOyCd.jpg', '1956-07-05', 0, '2017-03-01', 1),
(2, 'test@titi.toto', 'je_suis_le_test', 'tata', 'https://vgy.me/jONP9b.jpg', '1991-03-13', 2, '2017-03-03', 2),
(3, 'mfruz@lolzone.net', 'mfruz', 'bite', 'https://vgy.me/u7fE3X.jpg', '1997-06-06', 7, '2017-03-06', 4),
(4, 'mattsolbe@radiohead.fr', 'PandaMatthieu', '', 'https://vgy.me/I6kkiY.jpg', '1995-10-18', 5, '2017-03-01', 3),
(5, 'flaive_lacus@laposte.net', 'demon_de_sel', 'cerebos', 'https://vgy.me/BYI9cR.jpg', '1996-05-05', 10, '2017-03-02', 7),
(6, 'aleqs@nd.ru', 'Aleqsandr', 'vvvaves', 'https://vgy.me/SX0a5T.jpg', '1995-12-22', 2, '2017-03-07', 3);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
