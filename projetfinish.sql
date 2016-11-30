-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mer 27 Janvier 2016 à 18:22
-- Version du serveur :  10.1.9-MariaDB
-- Version de PHP :  5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projetfinish`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `idArticle` int(6) NOT NULL,
  `titre` varchar(40) NOT NULL,
  `cheminPhoto` varchar(100) NOT NULL,
  `dateParution` date NOT NULL,
  `contenu` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `article`
--

INSERT INTO `article` (`idArticle`, `titre`, `cheminPhoto`, `dateParution`, `contenu`) VALUES
(17, 'Goku sauve le monde', './Vue/Image/imageArticle/gokuArticle.jpg', '2000-01-01', 'Aujourd''hui, premier jour du millénaire.\r\n\r\nSan Goku a sauvé le monde une fois de plus !\r\n\r\nMerci SanGoku'),
(20, 'Dragon Ball Z', './Vue/Image/imageArticle/planeteArticle.png', '2015-01-01', 'Dragon Ball Z se déroule cinq ans après le mariage de Son Goku et de Chichi2. Raditz, un mystérieux guerrier de l''espace, frère de Son Goku, arrive sur Terre pour retrouver Goku. Ce dernier apprend qu''il vient d''une planète de guerriers redoutables dont il ne reste plus que quatre survivants.\r\n'),
(21, 'À la poursuite de Garlic', './Vue/Image/imageArticle/kaioArticle.png', '2015-01-01', 'Garlic Junior, un démon, comme Piccolo, revient d’une autre dimension pour asservir la planète. Désirant réunir les sept boules de cristal, il enlève Son Gohan (coiffé d’un chapeau avec Su Shinchu). Son Goku et Piccolo vont s’allier pour combattre ce nouvel ennemi.\r\n\r\nRejoints par le Tout-Puissant, ils pénètrent dans le palais de Garlic. Pendant que le Tout-Puissant se bat contre Garlic, les autres vont libérer Son Gohan. Puis ils reviennent prêter main forte au Tout-Puissant.'),
(22, 'Battle Of Gods', './Vue/Image/imageArticle/gokuArticle.jpg', '2015-02-02', ' Le dieu de la destruction, suivi par son compagnon de toujours, Whis, vient rendre visite à ce dernier et souhaite rencontrer Son Goku. Lorsque celui-ci lui demande s''il connait le Super Saiyan Divin, Son Goku lui répond que non et propose à Beerus de le défier en combat singulier.'),
(24, 'Baddack contre Freezer', './Vue/Image/imageArticle/planeteArticle.png', '2016-03-02', ' Dragon Ball Z : Une ultime bataille en solitaire : le père du guerrier-Z Son Gokû qui défia Freezer), ou anciennement Dragon Ball Z : Le Père de Sangoku puis Dragon Ball Z : Le Père de Songoku, est un téléfilm d''animation japonais réalisé par Mitsuo Ashimoto, diffusé sur Fuji Television en 1990.');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `idArticle` int(6) NOT NULL,
  `login` varchar(30) NOT NULL,
  `corps` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `commentaire`
--

INSERT INTO `commentaire` (`idArticle`, `login`, `corps`) VALUES
(20, 'alcardot', 'bla<'),
(20, 'Quentin', 'Ah ouais trop bien je savais pas !'),
(21, 'Quentin', 'Oh mon dieu, quel méchant ce Garlic !');

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `login` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(90) NOT NULL,
  `role` varchar(6) NOT NULL DEFAULT 'membre'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `membre`
--

INSERT INTO `membre` (`login`, `password`, `email`, `role`) VALUES
('alcardot', 'password', 'alcardot@hotmail.fr', 'admin'),
('jean-moule', 'filiol', 'filiol@hotmail.fr', 'membre'),
('Quentin', 'password', 'quentin.lpalanche@etu.udamail.fr', 'membre');

-- --------------------------------------------------------

--
-- Structure de la table `personnage`
--

CREATE TABLE `personnage` (
  `idPersonnage` int(6) UNSIGNED NOT NULL,
  `nom` varchar(40) CHARACTER SET utf8 NOT NULL,
  `origine` varchar(60) CHARACTER SET utf8 NOT NULL,
  `detail` varchar(500) CHARACTER SET utf8 NOT NULL,
  `cheminPhoto` varchar(100) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `personnage`
--

INSERT INTO `personnage` (`idPersonnage`, `nom`, `origine`, `detail`, `cheminPhoto`) VALUES
(44, 'Boo', 'Extraterrestre', 'Je suis tout rose et élastique', './Vue/Image/boo.jpg'),
(47, 'Vegeta', 'Planète vegeta', 'Je suis le prince Vegeta', './Vue/Image/vegeta.png'),
(49, 'Champa', 'Planète vegeta', 'Super Mayen', './Vue/Image/Champa.png'),
(50, 'Broly', 'Mars', 'Méchant personnage', './Vue/Image/broly.jpg'),
(51, 'Birus', 'Dieu', 'Dieu de la destruction', './Vue/Image/birus.png'),
(52, 'Bardock', 'Inconnu', 'Personnage qui ressemble à Goku', './Vue/Image/bardock.jpg'),
(53, 'Whis', 'Dieu', 'Inconnu', './Vue/Image/whis.png');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`idArticle`);

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`idArticle`,`login`),
  ADD KEY `commentaire_2` (`login`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`login`);

--
-- Index pour la table `personnage`
--
ALTER TABLE `personnage`
  ADD PRIMARY KEY (`idPersonnage`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `idArticle` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT pour la table `personnage`
--
ALTER TABLE `personnage`
  MODIFY `idPersonnage` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `commentaire_1` FOREIGN KEY (`idArticle`) REFERENCES `article` (`idArticle`),
  ADD CONSTRAINT `commentaire_2` FOREIGN KEY (`login`) REFERENCES `membre` (`login`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
