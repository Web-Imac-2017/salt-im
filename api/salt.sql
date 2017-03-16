-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 16 Mars 2017 à 19:30
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
(1, 1, 13),
(2, 13, 15),
(3, 15, 16);

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
(1, 'https://vgy.me/yqYylA.jpg', 'img', 1);

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
(17, 'a', '2017-03-15', 1),
(18, 'Ceci est un post.', '2017-03-15', 1),
(19, 'Ceci est un post.', '2017-03-15', 1),
(20, 'Ceci est un post.', '2017-03-15', 1),
(21, 'Ceci est un post.', '2017-03-15', 1);

-- --------------------------------------------------------

--
-- Structure de la table `rel_tag_publication`
--

CREATE TABLE `rel_tag_publication` (
  `id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `publication_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `rel_tag_publication`
--

INSERT INTO `rel_tag_publication` (`id`, `tag_id`, `publication_id`) VALUES
(1, 11, 15),
(2, 12, 15);

-- --------------------------------------------------------

--
-- Structure de la table `stat`
--

CREATE TABLE `stat` (
  `id` int(11) NOT NULL,
  `name` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  `related_user_id` int(11) DEFAULT NULL,
  `related_publication_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `stat`
--

INSERT INTO `stat` (`id`, `name`, `value`, `related_user_id`, `related_publication_id`) VALUES
(1, 0, 10, NULL, 1),
(2, 1, 15, NULL, 1),
(3, 2, 20, NULL, 1),
(4, 0, 25, 1, NULL),
(5, 1, 30, 1, NULL),
(6, 2, 35, 1, NULL),
(7, 0, 78, NULL, 18),
(8, 1, 0, NULL, 18),
(9, 2, 0, NULL, 18),
(10, 0, 19654, NULL, 19),
(11, 1, 0, NULL, 19),
(12, 2, 0, NULL, 19),
(13, 0, 25000, NULL, 20),
(14, 1, 0, NULL, 20),
(15, 2, 0, NULL, 20),
(16, 0, 1250, NULL, 21),
(17, 1, 0, NULL, 21),
(18, 2, 0, NULL, 21);

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
(10, 'Julien Rousset est sur Tinder !', 'fermé', 'post', 11),
(11, 'a', 'a', 'post', 17),
(12, 'a', 'flair', 'post', 18),
(13, 'a', 'flair', 'post', 19),
(14, 'a', 'flair', 'post', 20),
(15, 'a', 'flair', 'post', 21);

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

CREATE TABLE `tag` (
  `id` int(11) NOT NULL,
  `name` tinytext NOT NULL,
  `img_url` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(10, 'Malaise TV', 'malaisetv.jpg', 'On connait tous un Malaise TV.'),
(11, 'lol', '', ''),
(12, 'despair', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` tinytext NOT NULL,
  `password` text NOT NULL,
  `mail` tinytext NOT NULL,
  `avatar` text NOT NULL,
  `birthDate` date NOT NULL,
  `rank` int(11) NOT NULL,
  `signupDate` date NOT NULL,
  `badge_id` int(11) NOT NULL,
  `token` tinytext NOT NULL COMMENT '60 random chars'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `vote` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `publication_id` int(11) NOT NULL,
  `name` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  ADD KEY `tag_id` (`tag_id`),
  ADD KEY `publication_id` (`publication_id`);

--
-- Index pour la table `stat`
--
ALTER TABLE `stat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `related_user_id` (`related_user_id`),
  ADD KEY `related_publication_id` (`related_publication_id`);

--
-- Index pour la table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `publication_id` (`publication_id`),
  ADD KEY `publication_id_2` (`publication_id`);

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
  ADD KEY `badge_id` (`badge_id`);

--
-- Index pour la table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `publication_id` (`publication_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `publication`
--
ALTER TABLE `publication`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT pour la table `rel_tag_publication`
--
ALTER TABLE `rel_tag_publication`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `stat`
--
ALTER TABLE `stat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT pour la table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT pour la table `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `vote`
--
ALTER TABLE `vote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
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
