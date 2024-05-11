-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 11 mai 2024 à 11:31
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db_bibliotheque`
--

-- --------------------------------------------------------

--
-- Structure de la table `adherent`
--

CREATE TABLE `adherent` (
  `id_adherent` int(11) NOT NULL,
  `numero_adherent` varchar(10) NOT NULL,
  `prenom_adherent` varchar(50) NOT NULL,
  `nom_adherent` varchar(50) NOT NULL,
  `email_adherent` varchar(100) NOT NULL,
  `date_adhesion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `adherent`
--

INSERT INTO `adherent` (`id_adherent`, `numero_adherent`, `prenom_adherent`, `nom_adherent`, `email_adherent`, `date_adhesion`) VALUES
(1, 'AD-385111', 'mateo', 'jean', 'mateojean25660@gmail.com', '2024-01-03 21:56:52'),
(2, 'AD-697373', 'lucas', 'bleau', 'lulubleau39@gmail.com', '2024-01-03 21:57:09'),
(3, 'AD-873296', 'john', 'doe', 'johndoe@gmail.com', '2024-01-04 18:29:16');

-- --------------------------------------------------------

--
-- Structure de la table `bluray`
--

CREATE TABLE `bluray` (
  `id_media` int(11) NOT NULL,
  `realisateur` varchar(20) NOT NULL,
  `duree` double NOT NULL,
  `annee_de_sortie` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `emprunt`
--

CREATE TABLE `emprunt` (
  `id_emprunt` int(11) NOT NULL,
  `id_adherent` int(11) DEFAULT NULL,
  `id_media` int(11) DEFAULT NULL,
  `dateEmprunt` datetime NOT NULL,
  `dateRetourEstime` datetime NOT NULL,
  `dateRetour` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `emprunt`
--

INSERT INTO `emprunt` (`id_emprunt`, `id_adherent`, `id_media`, `dateEmprunt`, `dateRetourEstime`, `dateRetour`) VALUES
(1, 1, 3, '2024-01-04 21:50:36', '2024-01-25 21:50:36', NULL),
(2, 1, 4, '2024-05-11 11:03:16', '2024-06-01 11:03:16', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `livre`
--

CREATE TABLE `livre` (
  `id_media` int(11) NOT NULL,
  `isbn` varchar(40) NOT NULL,
  `auteur` varchar(20) NOT NULL,
  `nbr_page` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `livre`
--

INSERT INTO `livre` (`id_media`, `isbn`, `auteur`, `nbr_page`) VALUES
(1, '2-7654-1005-4', 'Jane Austen', 150),
(3, '978-2-7654-1005-8', 'Emily Bronte', 140),
(4, '978-3-16-148410-0', 'George Orwell', 147);

-- --------------------------------------------------------

--
-- Structure de la table `magazine`
--

CREATE TABLE `magazine` (
  `id_media` int(11) NOT NULL,
  `numero_magazine` int(11) NOT NULL,
  `date_publication` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `magazine`
--

INSERT INTO `magazine` (`id_media`, `numero_magazine`, `date_publication`) VALUES
(2, 5, '2000-01-01'),
(5, 8, '1982-01-15');

-- --------------------------------------------------------

--
-- Structure de la table `media`
--

CREATE TABLE `media` (
  `id_media` int(11) NOT NULL,
  `titre_media` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL,
  `date_creation` datetime NOT NULL,
  `duree_emprunt` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `media`
--

INSERT INTO `media` (`id_media`, `titre_media`, `status`, `date_creation`, `duree_emprunt`, `type`) VALUES
(1, 'Orgueil et préjugés', 'nouveau', '2024-01-03 21:39:09', 21, 'Livre'),
(2, 'Télérama', 'nouveau', '2024-01-03 21:52:53', 10, 'Magazine'),
(3, 'Les Hauts de Hurle-Vent', 'disponible', '2024-01-05 21:54:25', 21, 'Livre'),
(4, '1984', 'disponible', '2024-01-04 18:32:08', 21, 'Livre'),
(5, 'Télérama', 'nouveau', '2024-05-11 10:58:00', 10, 'Magazine');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `adherent`
--
ALTER TABLE `adherent`
  ADD PRIMARY KEY (`id_adherent`);

--
-- Index pour la table `bluray`
--
ALTER TABLE `bluray`
  ADD PRIMARY KEY (`id_media`);

--
-- Index pour la table `emprunt`
--
ALTER TABLE `emprunt`
  ADD PRIMARY KEY (`id_emprunt`),
  ADD UNIQUE KEY `UNIQ_F9FD484B84A9E03C` (`id_media`),
  ADD KEY `IDX_F9FD484BC0081CF5` (`id_adherent`);

--
-- Index pour la table `livre`
--
ALTER TABLE `livre`
  ADD PRIMARY KEY (`id_media`);

--
-- Index pour la table `magazine`
--
ALTER TABLE `magazine`
  ADD PRIMARY KEY (`id_media`);

--
-- Index pour la table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id_media`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `adherent`
--
ALTER TABLE `adherent`
  MODIFY `id_adherent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `emprunt`
--
ALTER TABLE `emprunt`
  MODIFY `id_emprunt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `media`
--
ALTER TABLE `media`
  MODIFY `id_media` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `bluray`
--
ALTER TABLE `bluray`
  ADD CONSTRAINT `FK_C976A98684A9E03C` FOREIGN KEY (`id_media`) REFERENCES `media` (`id_media`) ON DELETE CASCADE;

--
-- Contraintes pour la table `emprunt`
--
ALTER TABLE `emprunt`
  ADD CONSTRAINT `FK_F9FD484B84A9E03C` FOREIGN KEY (`id_media`) REFERENCES `media` (`id_media`),
  ADD CONSTRAINT `FK_F9FD484BC0081CF5` FOREIGN KEY (`id_adherent`) REFERENCES `adherent` (`id_adherent`);

--
-- Contraintes pour la table `livre`
--
ALTER TABLE `livre`
  ADD CONSTRAINT `FK_6DA2609D84A9E03C` FOREIGN KEY (`id_media`) REFERENCES `media` (`id_media`) ON DELETE CASCADE;

--
-- Contraintes pour la table `magazine`
--
ALTER TABLE `magazine`
  ADD CONSTRAINT `FK_CEFA4DB284A9E03C` FOREIGN KEY (`id_media`) REFERENCES `media` (`id_media`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
