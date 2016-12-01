-- phpMyAdmin SQL Dump
-- version 4.2.5
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Dec 01, 2016 at 10:29 AM
-- Server version: 5.5.38
-- PHP Version: 5.5.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `CodeStrikers16`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
`idArticle` int(6) NOT NULL,
  `titre` varchar(40) NOT NULL,
  `cheminPhoto` varchar(100) NOT NULL,
  `dateParution` date NOT NULL,
  `contenu` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`idArticle`, `titre`, `cheminPhoto`, `dateParution`, `contenu`) VALUES
(1, 'Lorem ipsum', './Vue/Image/imageArticle/gokuArticle.jpg', '2000-01-01', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'),
(2, 'John Doe', './Vue/Image/imageArticle/planeteArticle.png', '2015-01-01', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'),
(3, 'John Appleseed', './Vue/Image/imageArticle/kaioArticle.png', '2015-01-01', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.');

-- --------------------------------------------------------

--
-- Table structure for table `commentaire`
--

CREATE TABLE `commentaire` (
  `idArticle` int(6) NOT NULL,
  `login` varchar(30) NOT NULL,
  `corps` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `membre`
--

CREATE TABLE `membre` (
  `login` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(90) NOT NULL,
  `role` enum('membre','admin') NOT NULL DEFAULT 'membre'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `membre`
--

INSERT INTO `membre` (`login`, `password`, `email`, `role`) VALUES
('alcardot', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'alcardot@hotmail.fr', 'admin'),
('jean-moule', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'filiol@hotmail.fr', 'membre'),
('Jérémy', 'ed4dff1ba3c8ddffae81d223409ef80ce55bca76', 'jeremy.petit@insa-cvl.fr', 'membre'),
('Quentin', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'quentin.laplanche@insa-cvl.fr', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
 ADD PRIMARY KEY (`idArticle`);

--
-- Indexes for table `commentaire`
--
ALTER TABLE `commentaire`
 ADD PRIMARY KEY (`idArticle`,`login`), ADD KEY `commentaire_2` (`login`);

--
-- Indexes for table `membre`
--
ALTER TABLE `membre`
 ADD PRIMARY KEY (`login`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
MODIFY `idArticle` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `commentaire`
--
ALTER TABLE `commentaire`
ADD CONSTRAINT `commentaire_1` FOREIGN KEY (`idArticle`) REFERENCES `article` (`idArticle`),
ADD CONSTRAINT `commentaire_2` FOREIGN KEY (`login`) REFERENCES `membre` (`login`);
