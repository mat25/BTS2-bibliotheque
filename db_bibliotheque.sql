-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 07 mai 2024 à 11:18
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
(2, 'AD-854961', 'Mateo', 'Jean', 'mateoj@gmail.com', '2023-10-15 09:08:58'),
(21, 'AD-512790', 'mateo', 'Jean', 'mateo@gmail.com', '2021-12-11 13:32:32');

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
(1, 21, 18, '2024-01-08 09:47:20', '2024-01-18 09:47:20', NULL),
(2, 2, 19, '2024-01-08 13:42:11', '2024-01-29 13:42:11', NULL),
(4, 2, 7, '2024-01-08 16:41:21', '2024-01-29 16:41:21', NULL),
(5, 2, 7, '2024-01-08 16:42:18', '2024-01-29 16:42:18', NULL);

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
(7, 'LELI258UN', 'Rudyard Kipling', 102),
(19, '2-7654-1005-4', 'test', 150),
(20, '0-330-28498-3', 'test2', 189);

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
(18, 169, '2004-11-15');

-- --------------------------------------------------------

--
-- Structure de la table `media`
--

CREATE TABLE `media` (
  `id_media` int(11) NOT NULL,
  `titre_media` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL,
  `date_creation` datetime NOT NULL,
  `duree_emprunt` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `media`
--

INSERT INTO `media` (`id_media`, `titre_media`, `status`, `date_creation`, `duree_emprunt`, `type`) VALUES
(7, 'Le Livre de la jungl', 'emprunte', '2023-11-15 10:41:09', 21, 'Livre'),
(18, 'te', 'disponible', '2023-12-11 09:34:14', 10, 'Magazine'),
(19, 'TestLive', 'nouveau', '2023-12-11 13:40:40', 21, 'Livre'),
(20, 'test', 'nouveau', '2022-01-08 13:38:19', 21, 'Livre');

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
  ADD KEY `IDX_F9FD484BC0081CF5` (`id_adherent`),
  ADD KEY `UNIQ_F9FD484B84A9E03C` (`id_media`) USING BTREE;

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
  MODIFY `id_adherent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `emprunt`
--
ALTER TABLE `emprunt`
  MODIFY `id_emprunt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `media`
--
ALTER TABLE `media`
  MODIFY `id_media` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
