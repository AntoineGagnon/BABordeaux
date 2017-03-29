-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Lun 27 Mars 2017 à 15:10
-- Version du serveur :  10.1.21-MariaDB
-- Version de PHP :  5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `babordeaux`
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
(1, 1, 0, 'oui'),
(2, 1, 1, 'non'),
(3, 2, 0, 'Parfait'),
(4, 2, 1, 'Acceptable'),
(5, 2, 2, 'A améliorer'),
(6, 2, 3, 'Catastrophique'),
(7, 3, 0, 'Internet'),
(8, 3, 1, 'Presse écrite'),
(9, 3, 2, 'Radio'),
(10, 3, 3, 'Télévision'),
(11, 3, 4, ' Affiches / Tracts'),
(12, 3, 5, 'Bouche à oreille'),
(13, 5, 0, 'Seul'),
(14, 5, 1, 'En couple'),
(15, 5, 2, 'Entre amis'),
(16, 5, 3, 'En famille (adultes)'),
(17, 5, 4, 'En famille (avec enfants)'),
(18, 5, 5, 'Groupe organisé'),
(19, 6, 0, 'Efficace et très agréable'),
(20, 6, 1, 'Correct'),
(21, 6, 2, 'A améliorer'),
(22, 6, 3, 'Inaceptable'),
(23, 7, 0, 'Correspondant à mes attentes'),
(24, 7, 1, 'Perplexe'),
(25, 7, 2, 'Surpris(e)'),
(26, 7, 3, 'Déçu(e)'),
(27, 7, 4, 'Ebloui(e)'),
(28, 7, 5, 'Indifférent(e)'),
(29, 7, 6, 'Content(e)'),
(30, 8, 0, 'Exceptionnels'),
(31, 8, 1, 'Interessants'),
(32, 8, 2, 'Un peu décevants'),
(33, 8, 3, 'Navrants'),
(34, 9, 0, 'Largement suffisant'),
(35, 9, 1, 'Correct'),
(36, 9, 2, 'Insuffisant'),
(37, 9, 3, 'Inexistant'),
(38, 10, 0, 'Moins de 26 ans'),
(39, 10, 1, 'Entre 26 et 45 ans'),
(40, 10, 2, 'Entre 46 et 60 ans'),
(41, 10, 3, 'Plus de 60 ans');
-- --------------------------------------------------------

--
-- Structure de la table `artworks`
--

CREATE TABLE `artworks` (
  `id` int(11) NOT NULL,
  `artist` varchar(40) DEFAULT NULL,
  `born_died` varchar(66) DEFAULT NULL,
  `title` varchar(90) DEFAULT NULL,
  `date` varchar(19) DEFAULT NULL,
  `technique` varchar(106) DEFAULT NULL,
  `location` varchar(63) DEFAULT NULL,
  `image_url` varchar(69) DEFAULT NULL,
  `type` varchar(12) DEFAULT NULL,
  `form` varchar(12) DEFAULT NULL,
  `school` varchar(13) DEFAULT NULL,
  `timeframe` varchar(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `artworks`
--


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
(1, 1, 0, 1, 'singleChoice', 'Est-ce votre première visite au musée ?', 0, 1),
(2, 2, 0, 1, 'singleChoice', 'Estimez votre temps d\'attente au guichet.', 0, 1),
  (3, 3, 0, 1, 'multipleChoice', 'Comment avez-vous connu le musée ?', 0, 1),
(4, 4, 0, 1, 'openAnswer', 'Un dernier avis sur le musée ?', 1, 0),
(5, 5, 0, 1, 'singleChoice', 'Notez le musée', 0, 1),
  (6, 6, 0, 1, 'multipleChoice', 'Avec qui êtes-vous venu ?', 0, 1),
(7, 7, 0, 1, 'singleChoice', 'Comment avez-vous trouvé l\'accueil du personnel ?', 0, 1),
  (8, 8, 0, 1, 'multipleChoice', 'Comment vous êtes-vous senti pendant cette visite ?', 0, 1),
(9, 9, 0, 1, 'singleChoice', 'Comment jugez-vous les oeuvres exposées ?', 0, 1),
  (10, 10, 0, 1, 'multipleChoice', 'Comment jugez-vous les renseignements apportés pendant la visite ? (écritaux, fléchage, ...)', 0, 1),
(11, 11, 0, 1, 'muliChoice', 'Quel est votre age ?', 0, 1);

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
-- Structure de la table `rules`
--

CREATE TABLE `rules` (
  `id` int(11) NOT NULL,
  `label` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Index pour la table `rules`
--
ALTER TABLE `rules`
  ADD PRIMARY KEY (`rules`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1275;
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
-- AUTO_INCREMENT pour la table `rules`
--
ALTER TABLE `rules`
  MODIFY `rules` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `submissions`
--
ALTER TABLE `submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
