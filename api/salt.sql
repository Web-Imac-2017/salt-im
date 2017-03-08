-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 08 Mars 2017 à 15:34
-- Version du serveur :  10.1.8-MariaDB
-- Version de PHP :  5.5.30

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

CREATE TABLE `badge` (
  `id` int(11) NOT NULL,
  `cond` int(11) NOT NULL,
  `name` tinytext NOT NULL,
  `icon` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `badge`
--

INSERT INTO `badge` (`id`, `cond`, `name`, `icon`) VALUES
(1, 1, 'Noob', 'dedededededed');

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `related_publication_id` int(11) NOT NULL,
  `publication_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `comment`
--

INSERT INTO `comment` (`id`, `related_publication_id`, `publication_id`) VALUES
(1, 1, 12),
(2, 2, 13),
(3, 11, 2),
(4, 9, 5),
(5, 13, 4);

-- --------------------------------------------------------

--
-- Structure de la table `help`
--

CREATE TABLE `help` (
  `id` int(11) NOT NULL,
  `publication_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `media`
--

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `link` text NOT NULL,
  `type` tinytext NOT NULL,
  `publication_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `media`
--

INSERT INTO `media` (`id`, `link`, `type`, `publication_id`) VALUES
(1, 'https://vgy.me/yqYylA.jpg', 'img', 4),
(2, 'https://vgy.me/wpqzlR.jpg', 'img', 3),
(3, 'https://s2.qwant.com/thumbr/0x0/4/4/353a77e3db0d10f9fda552c9d05314/b_1_q_0_p_0.jpg?u=http%3A%2F%2Fmedias.unifrance.org%2Fmedias%2F127%2F20%2F5247%2Fformat_page%2Frrrrrrr.jpg&q=0&b=1&p=0&a=1', 'img', 2),
(4, 'http://www.supercartoons.net/images/cartoons/cat-and-dupli-cat.jpg', 'img', 1),
(5, 'https://vgy.me/GU5ViF.png', 'img', 10),
(6, 'https://vgy.me/z11cX5.png', 'img', 7),
(7, 'https://vgy.me/GmueTO.jpg', 'img', 9),
(8, 'https://youtu.be/Nar9q5G_nm8', 'video', 5);

-- --------------------------------------------------------

--
-- Structure de la table `publication`
--

CREATE TABLE `publication` (
  `id` int(11) NOT NULL,
  `text` text NOT NULL,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `publication`
--

INSERT INTO `publication` (`id`, `text`, `date`, `user_id`) VALUES
(1, 'Jeune emo en quête de reconnaissance sociale, Alexandre a décidé de faire valoir son art sur des réseaux plus mainstream', '2017-03-02', 1),
(2, 'Ceci est un commentaire', '2017-03-01', 1),
(3, 'Ta mère est tellement laide que j''ai pas de chute à cette blague', '2017-03-06', 1),
(4, 'Ce commentaire répond à un commentaire', '2017-01-01', 1),
(5, 'Sans commentaire', '2017-01-01', 1),
(6, 'J''voudrais qu''il m''appelle Madame Bip, mais commentaire ?', '2017-01-01', 1),
(7, 'Bonjour, j''ai besoin d''aide parce que j''ai pas de répartie (signé mflouze)', '2017-01-01', 1),
(8, 'Waah ton post c''est de la grosse merde gros', '2017-07-03', 1),
(9, 'Waah ton post c''est VRAIMENT de la grosse merde gros', '2017-07-03', 1),
(10, 'On dirait une blague de Bessol', '2017-07-03', 1),
(11, 'Nan mais je rêve ???', '2017-07-03', 1),
(12, 'T''es tellement peu salé gros même l''eau est plus épicée ', '2017-07-03', 1),
(13, 'Moi ça m''excite', '2017-07-03', 1);

-- --------------------------------------------------------

--
-- Structure de la table `rel_tag_publication`
--

CREATE TABLE `rel_tag_publication` (
  `id` int(11) NOT NULL,
  `publication_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `stat`
--

CREATE TABLE `stat` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `value` int(11) NOT NULL,
  `related_element_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `stat`
--

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

-- --------------------------------------------------------

--
-- Structure de la table `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `title` tinytext NOT NULL,
  `flair` tinytext NOT NULL,
  `type` tinytext NOT NULL,
  `publication_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `tag` (
  `id` int(11) NOT NULL,
  `name` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `mail` tinytext NOT NULL,
  `username` tinytext NOT NULL,
  `password` text NOT NULL,
  `avatar` text NOT NULL,
  `birthDate` date NOT NULL,
  `rank` int(11) NOT NULL,
  `signupDate` date NOT NULL,
  `badge_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `mail`, `username`, `password`, `avatar`, `birthDate`, `rank`, `signupDate`, `badge_id`) VALUES
(1, 'jc@gmail.com', 'JC', 'zef54fe6sf6e', 'jc.jpg', '1956-07-05', 0, '2017-03-01', 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `badge`
--
ALTER TABLE `badge`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `related_publication_id` (`related_publication_id`),
  ADD KEY `publication_id` (`publication_id`);

--
-- Index pour la table `help`
--
ALTER TABLE `help`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `publication_id` (`publication_id`);

--
-- Index pour la table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `publication_id` (`publication_id`);

--
-- Index pour la table `publication`
--
ALTER TABLE `publication`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `rel_tag_publication`
--
ALTER TABLE `rel_tag_publication`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `publication_id` (`publication_id`),
  ADD UNIQUE KEY `tag_id` (`tag_id`);

--
-- Index pour la table `stat`
--
ALTER TABLE `stat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `related_element_id` (`related_element_id`);

--
-- Index pour la table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `publication_id` (`publication_id`);

--
-- Index pour la table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `badge_id` (`badge_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `badge`
--
ALTER TABLE `badge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `help`
--
ALTER TABLE `help`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `publication`
--
ALTER TABLE `publication`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `rel_tag_publication`
--
ALTER TABLE `rel_tag_publication`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `stat`
--
ALTER TABLE `stat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT pour la table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `help`
--
ALTER TABLE `help`
  ADD CONSTRAINT `help_ibfk_1` FOREIGN KEY (`publication_id`) REFERENCES `publication` (`id`);

--
-- Contraintes pour la table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_ibfk_1` FOREIGN KEY (`publication_id`) REFERENCES `publication` (`id`);

--
-- Contraintes pour la table `publication`
--
ALTER TABLE `publication`
  ADD CONSTRAINT `publication_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

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
  ADD CONSTRAINT `stat_ibfk_2` FOREIGN KEY (`related_element_id`) REFERENCES `publication` (`id`);

--
-- Contraintes pour la table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `subject_ibfk_1` FOREIGN KEY (`publication_id`) REFERENCES `publication` (`id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`badge_id`) REFERENCES `badge` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
