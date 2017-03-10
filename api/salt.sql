CREATE TABLE `badge` (
  `id` int(11) NOT NULL,
  `cond` int(11) NOT NULL,
  `name` tinytext NOT NULL,
  `icon` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `badge` (`id`, `cond`, `name`, `icon`) VALUES
(1, 0, 'Beurre doux', 'fpenr'),
(2, 100, 'Demi-sel', 'jsp'),
(3, 500, 'La Baleine', 'feze'),
(4, 1000, 'Morue', 'zef'),
(5, 5000, 'Saumure', 'feze'),
(6, 10000, 'Mer Morte', 'arf'),
(7, 25000, 'Hypertension artérielle', 'zrgeg');

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `related_publication_id` int(11) NOT NULL,
  `publication_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `comment` (`id`, `related_publication_id`, `publication_id`) VALUES
(1, 1, 13);

CREATE TABLE `help` (
  `id` int(11) NOT NULL,
  `publication_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `link` text NOT NULL,
  `type` tinytext NOT NULL,
  `publication_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `media` (`id`, `link`, `type`, `publication_id`) VALUES
(1, 'https://vgy.me/yqYylA.jpg', 'img', 1),
(2, 'https://vgy.me/jxeLyc.jpg', 'img', 2),
(3, 'https://vgy.me/eFCROf.jpg', 'img', 3),
(4, 'https://vgy.me/O7McN9.jpg', 'img', 4),
(5, 'https://vgy.me/iCyAfm.jpg', 'img', 5);

CREATE TABLE `publication` (
  `id` int(11) NOT NULL,
  `text` text NOT NULL,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(14, 'T''as cru que t''avais du style dans ton peau de pêche bleu ??? Haaaan salooooope', '2017-03-08', 6);

CREATE TABLE `rel_tag_publication` (
  `id` int(11) NOT NULL,
  `publication_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `stat` (
  `id` int(11) NOT NULL,
  `name` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  `relaled_element_id` int(11) NOT NULL,
  `related_element_type` int(11) NOT NULL COMMENT '0 = subject, 1 = user'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='0 = sel, 1 = poivre, 2 = humour';

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `title` tinytext NOT NULL,
  `flair` tinytext NOT NULL,
  `type` tinytext NOT NULL,
  `publication_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `tag` (
  `id` int(11) NOT NULL,
  `name` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `mail` tinytext NOT NULL,
  `username` tinytext NOT NULL,
  `password` text NOT NULL,
  `avatar` text NOT NULL,
  `birthDate` date NOT NULL,
  `rank` int(11) NOT NULL,
  `signupDate` date NOT NULL,
  `badge_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `user` (`id`, `mail`, `username`, `password`, `avatar`, `birthDate`, `rank`, `signupDate`, `badge_id`) VALUES
(1, 'jc@gmail.com', 'JC', 'zef54fe6sf6e', 'https://vgy.me/fxOyCd.jpg', '1956-07-05', 0, '2017-03-01', 1),
(2, 'test@titi.toto', 'je_suis_le_test', 'tata', 'https://vgy.me/jONP9b.jpg', '1991-03-13', 2, '2017-03-03', 2),
(3, 'mfruz@lolzone.net', 'mfruz', 'bite', 'https://vgy.me/u7fE3X.jpg', '1997-06-06', 7, '2017-03-06', 4),
(4, 'mattsolbe@radiohead.fr', 'PandaMatthieu', '', 'https://vgy.me/I6kkiY.jpg', '1995-10-18', 5, '2017-03-01', 3),
(5, 'flaive_lacus@laposte.net', 'demon_de_sel', 'cerebos', 'https://vgy.me/BYI9cR.jpg', '1996-05-05', 10, '2017-03-02', 7),
(6, 'aleqs@nd.ru', 'Aleqsandr', 'vvvaves', 'https://vgy.me/SX0a5T.jpg', '1995-12-22', 2, '2017-03-07', 3);

ALTER TABLE `badge`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `related_publication_id` (`related_publication_id`),
  ADD KEY `publication_id` (`publication_id`);

ALTER TABLE `help`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `publication_id` (`publication_id`);

ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `publication_id` (`publication_id`);

ALTER TABLE `publication`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

ALTER TABLE `rel_tag_publication`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `publication_id` (`publication_id`),
  ADD UNIQUE KEY `tag_id` (`tag_id`);

ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `publication_id` (`publication_id`);

ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `badge_id` (`badge_id`);

ALTER TABLE `badge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `help`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `publication`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

ALTER TABLE `rel_tag_publication`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

ALTER TABLE `tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;