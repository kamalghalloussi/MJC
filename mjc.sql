-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 08 avr. 2022 à 09:06
-- Version du serveur : 8.0.27
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mjc`
--

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

DROP TABLE IF EXISTS `membres`;
CREATE TABLE IF NOT EXISTS `membres` (
  `id_jeune` int NOT NULL AUTO_INCREMENT,
  `nom_jeune` varchar(255) NOT NULL,
  `prenom_jeune` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `date_inscription` datetime NOT NULL,
  `téléphone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `étude` varchar(255) NOT NULL,
  PRIMARY KEY (`id_jeune`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `membres`
--

INSERT INTO `membres` (`id_jeune`, `nom_jeune`, `prenom_jeune`, `photo`, `date_inscription`, `téléphone`, `email`, `age`, `étude`) VALUES
(2, 'MACHIN', 'Victor', 'assets/imgimg1.jpg', '2022-03-25 00:00:00', '0712546746', 'victor.hugo@mail.fr', '15 ans ', 'Collége,3éme'),
(4, 'Veil', 'Lilou', 'assets/img/4.jpg', '2022-03-22 10:19:49', '0624654327', 'lilou@mail.fr', '6 ans', 'Maternelle'),
(5, 'Séréna', 'Delacroix', 'assets/imgimage_preview.jpg', '2022-03-23 00:00:00', '0738283746', 'delacroix@mail.fr', '17 ans', 'Première S');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_user`, `email`, `password`) VALUES
(5, 'Kamal.ghalloussi@gmail.com', '1111');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
