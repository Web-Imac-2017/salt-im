-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 15 Mars 2017 à 17:03
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `badge`
--

INSERT INTO `badge` (`id`, `cond`, `name`, `icon`) VALUES
(1, 1, 'Noob', 'dedededededed');

-- --------------------------------------------------------

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

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
(16, 'Ceci est un commentaire de commentaire de commentaire', '2017-06-12', 1),
(17, 'a', '2017-03-15', 1);

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

-- --------------------------------------------------------

--
-- Structure de la table `stat`
--

DROP TABLE IF EXISTS `stat`;
CREATE TABLE IF NOT EXISTS `stat` (
  `id` int(11) NOT NULL,
  `name` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  `related_user_id` int(11) DEFAULT NULL,
  `related_publication_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `related_user_id` (`related_user_id`),
  KEY `related_publication_id` (`related_publication_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

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
(10, 'Julien Rousset est sur Tinder !', 'fermé', 'post', 11),
(11, 'a', 'a', 'post', 17);

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

DROP TABLE IF EXISTS `tag`;
CREATE TABLE IF NOT EXISTS `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` tinytext NOT NULL,
  `img_url` text NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `tag`
--

INSERT INTO `tag` (`id`, `name`, `img_url`, `description`) VALUES
(1, 'Esipe vs IMAC', 'esipevsimag.jpg', 'L''éternel combat entre ceux qui font de la mécanique et de la maçonnerie et ceux qui dessinent.'),
(2, 'Marais salant', 'maraissalnt.jpg', 'La fleur de sel des posts.'),
(3, 'Amour', 'amour.jpg', 'What is love? Baby don''t hurt, don''t hurt me, no more.'),
(4, 'Potes', 'potes.jpg', 'Quoi de plus affectueux que d''afficher publiquement ses potes sur Internet et de les exposer à une magnifique tempête de sel ? Rien.'),
(5, 'Sexe', 'sexe.jpg', 'N''oubliez pas de rajouter un peu de sel sur vos saucisses ou vos moules.'),
(6, 'Twitter', 'twitter.jpg', 'Le saint patron.'),
(7, 'Facebook', 'facebook.jpg', 'Bref.'),
(8, 'IMAC 1', 'imac1.jpg', 'Un concentré de NaCl.'),
(9, 'Flavie', 'flavie.jpg', 'Salty Queen.'),
(10, 'Malaise TV', 'malaisetv.jpg', 'On connait tous un Malaise TV.');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` tinytext NOT NULL,
  `password` text NOT NULL,
  `mail` tinytext NOT NULL,
  `avatar` text NOT NULL,
  `birthDate` date NOT NULL,
  `rank` int(11) NOT NULL,
  `signupDate` date NOT NULL,
  `badge_id` int(11) NOT NULL,
  `token` tinytext NOT NULL COMMENT '60 random chars',
  PRIMARY KEY (`id`),
  KEY `badge_id` (`badge_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `mail`, `avatar`, `birthDate`, `rank`, `signupDate`, `badge_id`, `token`) VALUES
(1, 'DaphnÃ©', '958c588b2075b4294ded151fd458188e99ceb734', 'daphnegm.rose@gmail.com', 'daphne.jpg', '1996-12-31', 0, '2017-03-12', 1, ''),
(2, 'DaphnÃ©', '958c588b2075b4294ded151fd458188e99ceb734', 'daphnegm.rose@gmail.com', 'daphne.jpg', '1996-12-31', 0, '2017-03-12', 1, ''),
(3, 'petitecolierdelu', 'f3bbbd66a63d4bf1747940578ec3d0103530e21d', 'bonjour@mail.com', 'lu.jpg', '2000-03-08', 0, '2017-03-13', 1, 'T8wfHN8C6Yy8q4Ex4ZgiT1ON11395fV1M9MQfvkw56171K01v3v3y8S5L41o'),
(4, 'Miguel', 'f3bbbd66a63d4bf1747940578ec3d0103530e21d', 'buenos@dias.es', 'hola.jpg', '1999-03-01', 0, '2017-03-01', 1, '6M1bPF3Ge961NnmV5qr11ku9w0ByK59Q66Z0As7Aq9xD8aoPjl968v1H43wl');

-- --------------------------------------------------------

--
-- Structure de la table `vote`
--

DROP TABLE IF EXISTS `vote`;
CREATE TABLE IF NOT EXISTS `vote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `publication_id` int(11) NOT NULL,
  `name` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `publication_id` (`publication_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_ibfk_1` FOREIGN KEY (`publication_id`) REFERENCES `publication` (`id`);

--
-- Contraintes pour la table `rel_tag_publication`
--
ALTER TABLE `rel_tag_publication`
  ADD CONSTRAINT `rel_tag_publication_ibfk_1` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`),
  ADD CONSTRAINT `rel_tag_publication_ibfk_2` FOREIGN KEY (`publication_id`) REFERENCES `publication` (`id`);

--
-- Contraintes pour la table `stat`
--
ALTER TABLE `stat`
  ADD CONSTRAINT `stat_ibfk_1` FOREIGN KEY (`related_user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `stat_ibfk_2` FOREIGN KEY (`related_publication_id`) REFERENCES `publication` (`id`);

--
-- Contraintes pour la table `vote`
--
ALTER TABLE `vote`
  ADD CONSTRAINT `vote_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `vote_ibfk_2` FOREIGN KEY (`publication_id`) REFERENCES `publication` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
