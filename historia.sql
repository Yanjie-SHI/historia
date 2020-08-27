-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 27 août 2020 à 19:51
-- Version du serveur :  10.4.13-MariaDB
-- Version de PHP : 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `historia`
--
CREATE DATABASE IF NOT EXISTS `historia` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `historia`;

-- --------------------------------------------------------

--
-- Structure de la table `archive`
--

CREATE TABLE `archive` (
  `a_reference` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `demande`
--

CREATE TABLE `demande` (
  `d_fk_utilisateur_mail` varchar(255) NOT NULL,
  `d_fk_archive_reference` varchar(255) NOT NULL,
  `d_jeton` char(23) NOT NULL,
  `d_datetime_demande` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `possession`
--

CREATE TABLE `possession` (
  `p_fk_utilisateur_mail` varchar(255) NOT NULL,
  `p_fk_archive_reference` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `strike`
--

CREATE TABLE `strike` (
  `s_identifiant` int(10) UNSIGNED NOT NULL,
  `s_gravite` char(1) NOT NULL,
  `s_datetime_debut` datetime NOT NULL,
  `s_datetime_fin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `u_mail` varchar(255) NOT NULL,
  `u_mot_de_passe` varchar(255) NOT NULL,
  `u_pseudo` varchar(255) NOT NULL,
  `u_nb_offres` int(10) UNSIGNED NOT NULL,
  `u_nb_demandes` int(10) UNSIGNED NOT NULL,
  `u_jeton` char(23) NOT NULL,
  `u_etat` char(1) NOT NULL,
  `u_fk_strike_identifiant` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `archive`
--
ALTER TABLE `archive`
  ADD PRIMARY KEY (`a_reference`);

--
-- Index pour la table `demande`
--
ALTER TABLE `demande`
  ADD PRIMARY KEY (`d_fk_utilisateur_mail`,`d_fk_archive_reference`),
  ADD UNIQUE KEY `d_jeton` (`d_jeton`),
  ADD KEY `d_fk_archive_reference` (`d_fk_archive_reference`);

--
-- Index pour la table `possession`
--
ALTER TABLE `possession`
  ADD PRIMARY KEY (`p_fk_utilisateur_mail`,`p_fk_archive_reference`),
  ADD KEY `p_fk_archive_reference` (`p_fk_archive_reference`);

--
-- Index pour la table `strike`
--
ALTER TABLE `strike`
  ADD PRIMARY KEY (`s_identifiant`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`u_mail`),
  ADD UNIQUE KEY `u_jeton` (`u_jeton`),
  ADD KEY `u_fk_strike_identifiant` (`u_fk_strike_identifiant`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `strike`
--
ALTER TABLE `strike`
  MODIFY `s_identifiant` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `demande`
--
ALTER TABLE `demande`
  ADD CONSTRAINT `d_fk_archive_reference` FOREIGN KEY (`d_fk_archive_reference`) REFERENCES `archive` (`a_reference`),
  ADD CONSTRAINT `d_fk_utilisateur_mail` FOREIGN KEY (`d_fk_utilisateur_mail`) REFERENCES `utilisateur` (`u_mail`);

--
-- Contraintes pour la table `possession`
--
ALTER TABLE `possession`
  ADD CONSTRAINT `p_fk_archive_reference` FOREIGN KEY (`p_fk_archive_reference`) REFERENCES `archive` (`a_reference`),
  ADD CONSTRAINT `p_fk_utilisateur_mail` FOREIGN KEY (`p_fk_utilisateur_mail`) REFERENCES `utilisateur` (`u_mail`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `u_fk_strike_identifiant` FOREIGN KEY (`u_fk_strike_identifiant`) REFERENCES `strike` (`s_identifiant`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
