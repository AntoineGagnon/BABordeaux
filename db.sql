-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost
-- Généré le :  Mar 22 Novembre 2016 à 15:45
-- Version du serveur :  10.1.19-MariaDB
-- Version de PHP :  7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

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
(8, 4, 1, 'NON MAIS HO');

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
(2, 2, 4, 1);

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
(36, 'Anonymous', 'jrjyrejyerzjrz', '2016-11-19 23:00:00', '2016-11-19 23:00:00'),
(37, 'Anonymous', 'zjhterzjyrtzk', '2016-11-19 23:00:00', '2016-11-19 23:00:00'),
(38, 'Anonymous', 'thzkyrkyrz', '2016-11-19 23:00:00', '2016-11-19 23:00:00'),
(39, 'hjyrzkyruzk', 'jykrzjkyrzkyrzkry', '2016-11-19 23:00:00', '2016-11-19 23:00:00'),
(40, 'qgrhrzqhzq', 'hteshtesht', '2016-11-19 23:00:00', '2016-11-19 23:00:00'),
(41, 'jysj', 'jyrsjryskyrskry', '2016-11-20 18:43:57', '2016-11-20 18:43:57'),
(42, '', 'jytrjyerykykeky', '2016-11-21 16:39:28', '2016-11-21 16:39:28'),
(43, '', 'jterzjtjtzjtjz', '2016-11-21 16:41:08', '2016-11-21 16:41:08'),
(44, '', 'jytrjyrejyejyjyrjye', '2016-11-21 16:41:13', '2016-11-21 16:41:13'),
(45, 'Anonymous', 'rtk,urtkutkutrkurt', '2016-11-21 16:41:30', '2016-11-21 16:41:30');

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
(1, 0, 1, 1, 'singleChoice', 'Quel âge avez vous ?', 0, 1),
(2, 1, 2, 1, 'multipleChoice', 'Quels sont vos types d\'oeuvres préférés ?', 0, 1),
(3, 3, 1, 1, 'openAnswer', 'Que souhaiteriez vous améliorer dans le musé ?', 0, 0),
(4, 2, 2, 0, 'singleChoice', 'Pensez vous que cette question doit exister ?', 0, 1);

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
(1, 0),
(2, 1);

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
(1, '2016-11-21 18:02:10', '2016-11-21 18:02:10');

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
(0, 'admin', 0x24327924313024723777554674594e616d4a75543033433655456878757157394f4f362e4c77734b555039566e454b45765138704349794867436b61, 'mCu6TH7FLdZE5dmITTyBxoNL2BUvPfod7uiA48d7lyzcWsMOXUd4s3sI0m1U');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `answers`
--
ALTER TABLE `answers`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `choices`
--
ALTER TABLE `choices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `guestbook_submissions`
--
ALTER TABLE `guestbook_submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT pour la table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `question_groups`
--
ALTER TABLE `question_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `submissions`
--
ALTER TABLE `submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- Contraintes pour la table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `FOREIGN_KEY_QUESTIONS_QUESTION_GROUPS` FOREIGN KEY (`question_group_id`) REFERENCES `question_groups` (`id`);

