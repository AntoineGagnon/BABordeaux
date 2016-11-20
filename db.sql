-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Sam 19 Novembre 2016 à 16:37
-- Version du serveur :  10.1.16-MariaDB
-- Version de PHP :  5.6.24

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
  `answerOrder` int(11) NOT NULL,
  `label` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `answers`
--

INSERT INTO `answers` (`id`, `question_id`, `answerOrder`, `label`) VALUES
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

-- --------------------------------------------------------

--
-- Structure de la table `guestbook_submissions`
--

CREATE TABLE `guestbook_submissions` (
  `id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `text` varchar(2048) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `guestbook_submissions`
--

INSERT INTO `guestbook_submissions` (`id`, `username`, `text`) VALUES
(1, 'Antoine', 'texte de test');

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `questionOrder` int(11) NOT NULL,
  `question_group_id` int(11) NOT NULL,
  `isVisible` tinyint(1) NOT NULL DEFAULT '1',
  `questionType` enum('singleChoice','multipleChoice','openAnswer') NOT NULL,
  `label` varchar(512) NOT NULL,
  `isConditional` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `questions`
--

INSERT INTO `questions` (`id`, `questionOrder`, `question_group_id`, `isVisible`, `questionType`, `label`, `isConditional`) VALUES
(1, 0, 1, 1, 'singleChoice', 'Quel âge avez vous ?', 0),
(2, 1, 2, 1, 'multipleChoice', 'Quels sont vos types d''oeuvres préférés ?', 0),
(3, 3, 1, 1, 'openAnswer', 'Que souhaiteriez vous améliorer dans le musée ?', 0),
(4, 2, 2, 0, 'singleChoice', 'Pensez vous que cette question doit exister ?', 0);

-- --------------------------------------------------------

--
-- Structure de la table `question_groups`
--

CREATE TABLE `question_groups` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `question_groups`
--

INSERT INTO `question_groups` (`id`) VALUES
(1),
(2);

-- --------------------------------------------------------

--
-- Structure de la table `submissions`
--

CREATE TABLE `submissions` (
  `id` int(11) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  ADD UNIQUE KEY `questionOrder` (`questionOrder`);

--
-- Index pour la table `question_groups`
--
ALTER TABLE `question_groups`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `submissions`
--
ALTER TABLE `submissions`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `guestbook_submissions`
--
ALTER TABLE `guestbook_submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
