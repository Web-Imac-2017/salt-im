﻿
DROP TABLE IF EXISTS `badge`;
CREATE TABLE IF NOT EXISTS `badge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cond` int(11) NOT NULL,
  `name` tinytext NOT NULL,
  `icon` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;


INSERT INTO `badge` (`id`, `cond`, `name`, `icon`) VALUES
(1, 1, 'Noob', 'dedededededed');


DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `related_publication_id` int(11) NOT NULL,
  `publication_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `related_publication_id` (`related_publication_id`),
  KEY `publication_id` (`publication_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `comment` (`id`, `related_publication_id`, `publication_id`) VALUES
(1, 1, 13);

DROP TABLE IF EXISTS `help`;
CREATE TABLE IF NOT EXISTS `help` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `publication_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `publication_id` (`publication_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `media`;
CREATE TABLE IF NOT EXISTS `media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` text NOT NULL,
  `type` tinytext NOT NULL,
  `publication_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `publication_id` (`publication_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `media` (`id`, `link`, `type`, `publication_id`) VALUES
(1, 'https://vgy.me/yqYylA.jpg', 'img', 1);

DROP TABLE IF EXISTS `publication`;
CREATE TABLE IF NOT EXISTS `publication` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

INSERT INTO `publication` (`id`, `text`, `date`, `user_id`) VALUES
(1, 'Jeune emo en quête de reconnaissance sociale, Alexandre a décidé de faire valoir son art sur des réseaux plus mainstream', '2017-03-02', 1),
(2, 'd', '2017-03-01', 1),
(3, 'ton post m''a donné la malaria', '2017-03-06', 1),
(4, 'p', '2017-01-01', 1),
(5, 'p', '2017-01-01', 1),
(6, 'p', '2017-01-01', 1),
(7, 'p', '2017-01-01', 1),
(8, 'Waah ton post c''est de la grosse merde gros', '2017-07-03', 1),
(9, 'Waah ton post c''est de la grosse merde gros', '2017-07-03', 1),
(10, 'Waah ton post c''est de la grosse merde gros', '2017-07-03', 1),
(11, 'Waah ton post c''est de la grosse merde gros', '2017-07-03', 1),
(12, 'T''es tellement peu salÃ© gros mÃªme l''eau est plus Ã©picÃ©e ', '2017-07-03', 1),
(13, 'T''es tellement peu salÃ© gros mÃªme l''eau est plus Ã©picÃ©e ', '2017-07-03', 1);

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

INSERT INTO `stat` (`id`, `name`, `value`, `related_element_id`) VALUES
(3, 'sel', 0, 6),
(4, 'poivre', 0, 6),
(5, 'humour', 0, 6),
(6, 'sel', 0, 7),
(7, 'poivre', 0, 7),
(8, 'humour', 0, 7),
(9, 'sel', 0, 8),
(10, 'poivre', 0, 8),
(11, 'humour', 0, 8),
(12, 'sel', 0, 9),
(13, 'poivre', 0, 9),
(14, 'humour', 0, 9),
(15, 'sel', 0, 10),
(16, 'poivre', 0, 10),
(17, 'humour', 0, 10),
(18, 'sel', 0, 11),
(19, 'poivre', 0, 11),
(20, 'humour', 0, 11),
(21, 'sel', 0, 13),
(22, 'poivre', 0, 13),
(23, 'humour', 0, 13);

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

INSERT INTO `subject` (`id`, `title`, `flair`, `type`, `publication_id`) VALUES
(1, 'gg', 'g', 'g', 1),
(3, 'u', 'u', 'u', 4),
(4, 'u', 'u', 'u', 5),
(5, 'u', 'u', 'u', 6),
(6, 'u', 'u', 'u', 7),
(7, '', '', '', 8),
(8, '', '', '', 9),
(9, '', '', '', 10),
(10, '', '', '', 11);

DROP TABLE IF EXISTS `tag`;
CREATE TABLE IF NOT EXISTS `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

ALTER TABLE `help`
  ADD CONSTRAINT `help_ibfk_1` FOREIGN KEY (`publication_id`) REFERENCES `publication` (`id`);

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