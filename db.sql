-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:8080
-- Généré le :  Jeu 09 Mars 2017 à 15:25
-- Version du serveur :  5.6.33
-- Version de PHP :  7.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `BABordeaux`
--

-- --------------------------------------------------------

--
-- Structure de la table `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer_order` int(11) NOT NULL,
  `label` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `answers`
--

INSERT INTO `answers` (`id`, `question_id`, `answer_order`, `label`) VALUES
(1, 1, 0, '0-25 ans'),
(2, 1, 1, '25-50 ans'),
(3, 1, 2, '50+ ans'),
(4, 2, 0, 'Peinture'),
(5, 2, 1, 'Sculpture'),
(6, 2, 2, 'Autre'),
(7, 4, 0, 'NON'),
(8, 4, 1, 'NON MAIS HO'),
(16, 13, 0, 'Oui'),
(17, 13, 1, 'Non'),
(18, 13, 2, 'Peut-être'),
(19, 24, 0, 'edded');

-- --------------------------------------------------------

--
-- Structure de la table `artworks`
--

CREATE TABLE `artworks` (
  `id` int(11) NOT NULL,
  `artwork_name` varchar(255) NOT NULL,
  `artist` varchar(255) NOT NULL,
  `date` year(4) DEFAULT NULL,
  `movement` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `artworks`
--

INSERT INTO `artworks` (`id`, `artwork_name`, `artist`, `date`, `movement`) VALUES
(1, 'guerilla.jpg', 'Picasso', 1937, '');

-- --------------------------------------------------------

--
-- Structure de la table `choices`
--

CREATE TABLE `choices` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer_id` int(11) NOT NULL,
  `submission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `choices`
--

INSERT INTO `choices` (`id`, `question_id`, `answer_id`, `submission_id`) VALUES
(1, 1, 2, 1),
(2, 2, 4, 1),
(3, 1, 3, 2),
(4, 13, 16, 2);

-- --------------------------------------------------------

--
-- Structure de la table `guestbook_submissions`
--

CREATE TABLE `guestbook_submissions` (
  `id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `guestbook_submissions`
--

INSERT INTO `guestbook_submissions` (`id`, `username`, `text`, `created_at`, `updated_at`) VALUES
(36, 'Anonymous', 'c\'est bien', '2016-12-05 16:58:18', '2016-11-19 23:00:00'),
(37, 'Anonymous', 'c\'est pas bien', '2016-12-05 16:58:22', '2016-11-19 23:00:00'),
(38, 'Anonymous', 'trop cool !', '2016-12-05 16:58:29', '2016-11-19 23:00:00'),
(39, 'Henri', 'j\'aime bien le musée', '2016-12-05 16:58:43', '2016-11-19 23:00:00'),
(40, 'Jacques', 'plaisant', '2016-12-05 16:58:47', '2016-11-19 23:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question_order` int(11) NOT NULL,
  `question_group_id` int(11) NOT NULL,
  `isVisible` tinyint(1) NOT NULL DEFAULT '1',
  `questionType` enum('singleChoice','multipleChoice','openAnswer') NOT NULL,
  `label` varchar(512) NOT NULL,
  `isConditional` tinyint(1) DEFAULT '0',
  `isRequired` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `questions`
--

INSERT INTO `questions` (`id`, `question_order`, `question_group_id`, `isVisible`, `questionType`, `label`, `isConditional`, `isRequired`) VALUES
(9, 1, 4, 1, 'openAnswer', 'Question test', 0, 1),
(12, 3, 4, 0, 'singleChoice', 'ddd', 0, 0),
(15, 1, 4, 1, 'multipleChoice', '2', 0, 1),
(16, 0, 4, 1, 'singleChoice', 'testetest', 0, 1),
(17, 1, 5, 1, 'openAnswer', 'ca marche', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `question_groups`
--

CREATE TABLE `question_groups` (
  `id` int(11) NOT NULL,
  `group_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `question_groups`
--

INSERT INTO `question_groups` (`id`, `group_order`) VALUES
(4, 1),
(5, 2);

-- --------------------------------------------------------

--
-- Structure de la table `submissions`
--

CREATE TABLE `submissions` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `submissions`
--

INSERT INTO `submissions` (`id`, `created_at`, `updated_at`) VALUES
(1, '2016-11-21 18:02:10', '2016-11-21 18:02:10'),
(2, '2016-11-24 21:03:21', '2016-11-24 21:03:21');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` binary(60) NOT NULL,
  `remember_token` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `remember_token`) VALUES
(0, 'admin', 0x24327924313024723777554674594e616d4a75543033433655456878757157394f4f362e4c77734b555039566e454b45765138704349794867436b61, 'NfNG1U8qPnASMlqXRvMOdkhC6xWjU1h7K5fitDujuosCsZLPLcmgutNiZpl6');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `artworks`
--
ALTER TABLE `artworks`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `choices`
--
ALTER TABLE `choices`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `guestbook_submissions`
--
ALTER TABLE `guestbook_submissions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FOREIGN_KEY_QUESTIONS_QUESTION_GROUPS` (`question_group_id`);

--
-- Index pour la table `question_groups`
--
ALTER TABLE `question_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `group_order` (`group_order`);

--
-- Index pour la table `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT pour la table `artworks`
--
ALTER TABLE `artworks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `choices`
--
ALTER TABLE `choices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `guestbook_submissions`
--
ALTER TABLE `guestbook_submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT pour la table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT pour la table `question_groups`
--
ALTER TABLE `question_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `submissions`
--
ALTER TABLE `submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `FOREIGN_KEY_QUESTIONS_QUESTION_GROUPS` FOREIGN KEY (`question_group_id`) REFERENCES `question_groups` (`id`);
