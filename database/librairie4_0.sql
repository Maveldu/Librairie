-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 08 Février 2017 à 23:07
-- Version du serveur :  10.1.19-MariaDB
-- Version de PHP :  5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `librairie4.0`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `ISBN_ISSN` bigint(13) NOT NULL,
  `ID_EDITEUR` bigint(4) NOT NULL,
  `TITRE` char(255) DEFAULT NULL,
  `QUANTITE_STOCK` int(3) DEFAULT '1',
  `NOM_EDITEUR` varchar(255) DEFAULT NULL,
  `COLLECTION` char(255) DEFAULT NULL,
  `DATE_PARUTION` date DEFAULT NULL,
  `NUMERO_COLLECTION` int(3) DEFAULT NULL,
  `EDITION` char(255) DEFAULT NULL,
  `PRIX` decimal(5,2) DEFAULT NULL,
  `RESUME` char(255) DEFAULT NULL,
  `NOTE_GERANT` char(255) DEFAULT NULL,
  `SUPPORT` char(255) DEFAULT 'papier',
  `Couverture` char(255) NOT NULL,
  `MOTCLES` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `article`
--

INSERT INTO `article` (`ISBN_ISSN`, `ID_EDITEUR`, `TITRE`, `QUANTITE_STOCK`, `NOM_EDITEUR`, `COLLECTION`, `DATE_PARUTION`, `NUMERO_COLLECTION`, `EDITION`, `PRIX`, `RESUME`, `NOTE_GERANT`, `SUPPORT`, `Couverture`, `MOTCLES`) VALUES
(9782917437520, 917437, 'Ces cris gravés', 50, 'Éditions du Chameau', 'Éditions du Chameau', '2016-01-06', 1, 'Éditions du Chameau', '10.00', 'Dans le château de Thunder-ten-tronckh, Pangloss, le maître de Candide, lui enseigne que tout va pour le mieux dans le meilleur des mondes. Candide le croit, mais se fait chasser du château pour un baiser donné à sa cousine Cunégonde.', '', 'choix2', '', 'photographie, dessin,texte'),
(9782917437605, 917437, 'Slams', 3, 'Éditions du Chameau', 'Éditions du Chameau', '2016-01-08', 1, 'Éditions du Chameau', '15.00', '1815. Alors que tous les aubergistes de la ville l''ont chassé, le bagnard Jean Valjean est hébergé par Mgr Myriel ( que les pauvres ont baptisé, d''après l''un de ses prénoms, Mgr Bienvenu). L''évêque de la ville de Digne, l''accueille avec bienveillance, le', 'Bon livre apprécié par notre équipe', 'papier', '', ''),
(9782917437742, 917437, 'Pourquoi y a t-il...?', 42, 'Éditions du chameau', 'Éditions du chameau', '2016-12-01', 125, 'Éditions du chameau', '14.00', 'Une femme un peu étrange qui balaye un théâtre, mais pas trop, qui parle, beaucoup, qui s’interroge, se scandalise et s’émerveille de l’absurde logique qui semble régir les hommes...', NULL, 'papier', '', ''),
(9782917437773, 917437, 'Le goût des hommes', 25, 'Éditions du chameau', 'Éditions du chameau', '2016-12-01', 125, 'Éditions du chameau', '15.00', '« Je ne savais pas que ce goût serait si difficile à vivre et encore plus difficile à assumer » écrit Janine Mesnildrey dès la première page de son roman.', NULL, 'papier', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `auteur`
--

CREATE TABLE `auteur` (
  `ID_AUTEUR` int(4) NOT NULL,
  `NOM_AUTEUR` char(255) DEFAULT NULL,
  `PRENOM_AUTEUR` char(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `auteur`
--

INSERT INTO `auteur` (`ID_AUTEUR`, `NOM_AUTEUR`, `PRENOM_AUTEUR`) VALUES
(1, 'Thouroude', 'Simonne'),
(2, 'kendji', 'Jirac'),
(3, 'lol', 'lol');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `NUMERO_COMPTE` int(11) NOT NULL,
  `NOM` char(255) DEFAULT NULL,
  `PRENOM` char(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `client`
--

INSERT INTO `client` (`NUMERO_COMPTE`, `NOM`, `PRENOM`) VALUES
(4, 'lucas', 'lucas'),
(5, 'gabin', 'ventrinponte'),
(9, 'BOISEAU', 'ADRIEN'),
(10, 'savary', 'lucas'),
(11, 'editeur', 'profe'),
(12, 'editeur', 'profe'),
(13, 'pro', 'fesse'),
(14, 'clent', 'client'),
(15, 'Livre', 'JeanMichel'),
(16, 'test', 'tes'),
(17, 'jeanmichel', 'panier'),
(18, 'commande', 'commande'),
(19, 'Client', 'Clientpre'),
(20, 'Clientpro', 'clientpropre'),
(21, 'testrei', 'testreifez'),
(23, 'glout', 'glout'),
(24, 'glouto', 'glouto'),
(25, 'glout', 'glout'),
(26, 'testd', 'Glouton'),
(27, 'Gabin', 'Glouton');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `NUMERO_COMMANDE` bigint(4) NOT NULL,
  `NUMERO_COMPTE` int(4) NOT NULL,
  `DATE_COMMANDE` char(10) DEFAULT NULL,
  `ETAT_COMMANDE` char(255) DEFAULT 'EN COURS'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `commande`
--

INSERT INTO `commande` (`NUMERO_COMMANDE`, `NUMERO_COMPTE`, `DATE_COMMANDE`, `ETAT_COMMANDE`) VALUES
(1, 15, NULL, NULL),
(2, 16, NULL, 'REFUSE'),
(3, 12, NULL, 'REFUSE'),
(4, 10, NULL, 'REFUSE'),
(5, 6, NULL, 'REFUSE'),
(6, 4, NULL, 'REFUSE'),
(7, 3, NULL, 'REFUSE'),
(12, 2, NULL, 'REFUSE'),
(16, 18, '0000-00-00', 'VALIDE'),
(17, 8, NULL, 'EN COURS'),
(199, 0, '2017-01-04', 'EN COURS'),
(218, 17, '20-01-2017', 'EN ATTENTE DE VALIDATION'),
(219, 21, '20-01-2017', 'REFUSE'),
(221, 17, '20-01-2017', 'EN ATTENTE DE VALIDATION'),
(222, 17, '20-01-2017', 'EN ATTENTE DE VALIDATION'),
(223, 17, '20-01-2017', 'EN ATTENTE DE VALIDATION'),
(224, 17, '20-01-2017', 'EN ATTENTE DE VALIDATION'),
(225, 17, '20-01-2017', 'EN ATTENTE DE VALIDATION'),
(226, 17, '20-01-2017', 'EN ATTENTE DE VALIDATION'),
(227, 17, '20-01-2017', 'EN ATTENTE DE VALIDATION'),
(228, 17, '20-01-2017', 'EN ATTENTE DE VALIDATION'),
(229, 17, '20-01-2017', 'EN ATTENTE DE VALIDATION'),
(230, 17, '20-01-2017', 'EN ATTENTE DE VALIDATION'),
(231, 17, '20-01-2017', 'ANNULE'),
(232, 17, '30-01-2017', 'EN ATTENTE DE VALIDATION'),
(233, 17, NULL, 'EN COURS'),
(234, 22, NULL, 'EN COURS'),
(235, 23, NULL, 'EN COURS'),
(236, 24, NULL, 'EN COURS'),
(237, 25, NULL, 'EN COURS'),
(238, 26, NULL, 'EN COURS'),
(239, 27, NULL, 'EN COURS');

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

CREATE TABLE `compte` (
  `NUMERO_COMPTE` int(4) NOT NULL,
  `ADRESSE_MAIL` char(255) DEFAULT NULL,
  `MOT_DE_PASSE` char(255) DEFAULT NULL,
  `ADMIN` tinyint(1) DEFAULT NULL,
  `NUMERO_TELEPHONE` bigint(10) DEFAULT NULL,
  `IDENTIFIANT` char(255) DEFAULT NULL,
  `ADRESSE` text NOT NULL COMMENT 'adresse',
  `CODE_POSTALE` int(11) NOT NULL COMMENT 'code postale',
  `VILLE` varchar(40) NOT NULL COMMENT 'ville'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `compte`
--

INSERT INTO `compte` (`NUMERO_COMPTE`, `ADRESSE_MAIL`, `MOT_DE_PASSE`, `ADMIN`, `NUMERO_TELEPHONE`, `IDENTIFIANT`, `ADRESSE`, `CODE_POSTALE`, `VILLE`) VALUES
(0, 'admin@mail.fr', '81dc9bdb52d04dc20036dbd8313ed055', NULL, NULL, 'admin', '', 0, ''),
(2, 'adrien-97@hotmail.fr', '098f6bcd4621d373cade4e832627b4f6', NULL, NULL, 'ashuni', '', 0, ''),
(3, 'didi@gmail.com', 'c19c8f9b6caad92726f88434d1493ad5', NULL, NULL, 'didi', '', 0, ''),
(4, 'lucas@lucas.com', 'dc53fc4f621c80bdc2fa0329a6123708', NULL, NULL, 'lucas', '', 0, ''),
(5, 'gabin@gabin.com', 'dccf81a70fc86319028bc7ecb7dfb8cb', NULL, NULL, 'gabin', '', 0, ''),
(6, 'test@gmail.com', '098f6bcd4621d373cade4e832627b4f6', NULL, NULL, 'testpseudo', '', 0, ''),
(7, 'adrien@hotmail.fr', 'd2104a400c7f629a197f33bb33fe80c0', NULL, NULL, 'ashunibis', '15ruedelamer', 14000, 'caen'),
(8, 'adrien@hotmail.fr', '54e66c5b67ad13dbc100aa399aae51be', NULL, NULL, 'ashunibBIS24', '15ruedelamer', 14000, 'caen'),
(9, 'adrien@hotmail.fr', '5541c7b5a06c39b267a5efae6628e003', NULL, NULL, 'ashunibBIS25', '15 rue de la mer', 14000, 'caen'),
(10, 'adrizfetereen@hotmail.fr', '99a30df0f2488360cdd46b4b88e5f5f0', NULL, NULL, 'ashunibBIS26', '15 rue salvador', 14000, 'caen'),
(11, 'test@gmail.com', 'c51fe5626772cb3db97b22601e76023a', NULL, 202020202, 'editpro', 'editeur', 50000, 'professionnel'),
(12, 'editeur@pro.com', 'a25e0e62a4702353f399953579424997', NULL, 265983265, 'editeurpro2', 'editeur', 20202, 'prof'),
(13, 'onnel@gmail.com', 'd450c5dbcc10db0749277efc32f15f9f', NULL, 2365412563, 'Editeur', 'porfitude', 52052, 'profe'),
(14, 'client@gmail.com', '62608e08adc29a8d6dbc9754e659f125', NULL, 2365410254, 'jeustclient', 'client', 12345, 'clientville'),
(15, 'jeanmichel@livre.com', '81dc9bdb52d04dc20036dbd8313ed055', NULL, 606060606, 'TestPanier', 'Adr test', 0, 'Villetest'),
(16, 'test@test.com', '81dc9bdb52d04dc20036dbd8313ed055', NULL, 606060606, 'test', 'test', 0, 'test'),
(17, 'jmp@panier.fr', '81dc9bdb52d04dc20036dbd8313ed055', NULL, 606060606, 'panier', 'add', 0, 'ville'),
(18, 'commande@gmail.com', '52dd5812b32192d0e93eb0dee465ca88', NULL, 569457684, 'commande', '1 rue de la commande', 15000, 'Commande'),
(19, 'client@gmail.com', '62608e08adc29a8d6dbc9754e659f125', NULL, 909090909, 'client', '1 rue du client', 14000, 'Client'),
(20, 'clientpro@gmail.com', 'af92d15dc1abab16cc30ff1bea92c6fb', NULL, 559694868, 'clientpro', '1 rue du clientpro', 14500, 'ClientPro'),
(21, 'reiaze@gmail.com', 'aa3731263eab09d0768daaaedc22b680', NULL, 6574859034, 'testredi', '1 testredi', 14000, 'Caen'),
(22, 'glouton@leroi.com', 'f06549a927164a3f2e336977a41794c8', NULL, 606060504, 'glouton36', 'lemanoir', 50430, 'angoville'),
(23, 'glout@gmail.com', 'f06549a927164a3f2e336977a41794c8', NULL, 321456789, 'glouton2', 'glout', 12345, 'gloutville'),
(24, 'glout52@gmail.com', 'f06549a927164a3f2e336977a41794c8', NULL, 321456787, 'glouton3', 'glout', 50430, 'gloutville'),
(25, 'glouty@gmail.com', '7d2e67351b1fac82968f09e85d672374', NULL, 865327412, 'glouton4', 'glouty', 25361, 'gloutville'),
(26, 'glout@gmail.com', '0cff9905497743137ed5c2aeb6189cac', NULL, 321456789, 'testd', 'testd', 12356, 'gloutville'),
(27, 'leroiglouton@gmail.com', 'c275fb3307a3f36d9fbd249035e31c7c', NULL, 653241526, 'leroiglouton', 'monamis', 50430, 'gloutville'),
(28, NULL, '81dc9bdb52d04dc20036dbd8313ed055', NULL, NULL, 'Testsousadmin', '', 0, '');

-- --------------------------------------------------------

--
-- Structure de la table `compte_client_pro`
--

CREATE TABLE `compte_client_pro` (
  `NUMERO_COMPTE` int(11) NOT NULL,
  `NUMERO_PRO` bigint(14) DEFAULT NULL,
  `valide` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `compte_client_pro`
--

INSERT INTO `compte_client_pro` (`NUMERO_COMPTE`, `NUMERO_PRO`, `valide`) VALUES
(5, 123456789, 0),
(11, 12345678912346, 1),
(13, 12345678985241, 0),
(20, 12345678901234, 0);

-- --------------------------------------------------------

--
-- Structure de la table `compte_fournisseur`
--

CREATE TABLE `compte_fournisseur` (
  `NUMERO_COMPTE` int(4) DEFAULT NULL,
  `ID_EDITEUR` bigint(4) NOT NULL,
  `NOM_EDITEUR` varchar(255) NOT NULL,
  `VALIDE` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `compte_fournisseur`
--

INSERT INTO `compte_fournisseur` (`NUMERO_COMPTE`, `ID_EDITEUR`, `NOM_EDITEUR`, `VALIDE`) VALUES
(27, 654123, 'glout', 0),
(25, 666666, 'Glouton', 0),
(23, 666667, 'Glouton', 0),
(NULL, 917437, 'Éditions du Chameau', 1);

-- --------------------------------------------------------

--
-- Structure de la table `compte_gerant`
--

CREATE TABLE `compte_gerant` (
  `NUMERO_COMPTE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `compte_gerant`
--

INSERT INTO `compte_gerant` (`NUMERO_COMPTE`) VALUES
(3),
(28);

-- --------------------------------------------------------

--
-- Structure de la table `compte_gerantp`
--

CREATE TABLE `compte_gerantp` (
  `NUMERO_COMPTE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `compte_gerantp`
--

INSERT INTO `compte_gerantp` (`NUMERO_COMPTE`) VALUES
(0);

-- --------------------------------------------------------

--
-- Structure de la table `ecrire`
--

CREATE TABLE `ecrire` (
  `ID_AUTEUR` int(11) NOT NULL,
  `ISBN_ISSN` bigint(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `ecrire`
--

INSERT INTO `ecrire` (`ID_AUTEUR`, `ISBN_ISSN`) VALUES
(1, 9782917437605);

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

CREATE TABLE `facture` (
  `NUMERO_FACTURE` int(4) NOT NULL,
  `NUMERO_COMMANDE` bigint(4) NOT NULL,
  `ADRESSE_CLIENT` char(255) DEFAULT NULL,
  `NOM_CLIENT` char(255) DEFAULT NULL,
  `DATE_FACTURE` date DEFAULT NULL,
  `QUANTITE_ARTICLE_REGLE` int(4) DEFAULT NULL,
  `DESIGNATION_ARTICLE` char(255) DEFAULT NULL,
  `PRIX_UNITAIRE` decimal(5,2) DEFAULT NULL,
  `TAXE` decimal(4,2) DEFAULT NULL,
  `REDUCTION` decimal(4,2) DEFAULT NULL,
  `FRAIS_PORT` decimal(4,2) DEFAULT NULL,
  `DATE_COMMANDE` date DEFAULT NULL,
  `moyen_paiement` varchar(255) DEFAULT NULL,
  `date_acquittement` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `lig_cde`
--

CREATE TABLE `lig_cde` (
  `NUMERO_COMMANDE` bigint(4) NOT NULL,
  `ISBN_ISSN` bigint(13) NOT NULL,
  `QTE_CMDEE` int(3) DEFAULT NULL,
  `PRIX_UNIT` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `lig_cde`
--

INSERT INTO `lig_cde` (`NUMERO_COMMANDE`, `ISBN_ISSN`, `QTE_CMDEE`, `PRIX_UNIT`) VALUES
(2, 9782917437520, 1, '10.00'),
(3, 9782917437520, 5, '10.00'),
(3, 9782917437605, 3, '15.00'),
(4, 9782917437520, 1, '10.00'),
(5, 9782917437520, 1, '10.00'),
(6, 9782917437520, 1, '10.00'),
(7, 9782917437520, 1, '10.00'),
(12, 9782917437520, 1, '10.00'),
(14, 9782917437520, 2, '10.00'),
(16, 9782917437605, 1, '15.00'),
(17, 9782917437520, 1, '10.00'),
(19, 9782917437520, 1, '10.00'),
(21, 9782917437605, 1, '15.00'),
(22, 9782917437520, 1, '10.00'),
(200, 9782917437773, 1, '15.00'),
(201, 9782917437520, 1, '10.00'),
(202, 9782917437742, 1, '14.00'),
(203, 9782917437520, 1, '10.00'),
(204, 9782917437520, 1, '10.00'),
(205, 9782917437773, 1, '15.00'),
(206, 9782917437520, 1, '10.00'),
(207, 9782917437520, 1, '10.00'),
(208, 9782917437520, 1, '10.00'),
(209, 9782917437520, 1, '10.00'),
(210, 9782917437520, 1, '10.00'),
(211, 9782917437520, 1, '10.00'),
(212, 9782917437520, 1, '10.00'),
(213, 9782917437520, 1, '10.00'),
(214, 9782917437520, 1, '10.00'),
(215, 9782917437520, 1, '10.00'),
(216, 9782917437742, 1, '14.00'),
(216, 9782917437773, 4, '15.00'),
(217, 9782917437520, 1, '10.00'),
(218, 9782917437520, 1, '10.00'),
(219, 9782917437520, 1, '10.00'),
(219, 9782917437605, 1, '15.00'),
(232, 9782917437520, 4, '10.00');

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

CREATE TABLE `note` (
  `NUMERO_COMPTE` int(11) NOT NULL,
  `TEXT` varchar(255) NOT NULL,
  `DATE` date NOT NULL,
  `SUPPR` tinyint(1) NOT NULL DEFAULT '0',
  `NUM_NOTE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `vitrine`
--

CREATE TABLE `vitrine` (
  `ISBN_ISSN` bigint(13) NOT NULL,
  `NUM` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `vitrine`
--

INSERT INTO `vitrine` (`ISBN_ISSN`, `NUM`) VALUES
(9782917437520, 1),
(9782917437605, 2),
(9782917437773, 3),
(9782917437742, 4),
(9782917437520, 5),
(9782917437520, 6),
(9782917437520, 7),
(9782917437520, 8),
(9782917437520, 9);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`ISBN_ISSN`),
  ADD KEY `FK_ARTICLE_EDITEUR` (`ID_EDITEUR`);

--
-- Index pour la table `auteur`
--
ALTER TABLE `auteur`
  ADD PRIMARY KEY (`ID_AUTEUR`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`NUMERO_COMPTE`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`NUMERO_COMMANDE`),
  ADD KEY `FK_commande` (`NUMERO_COMPTE`);

--
-- Index pour la table `compte`
--
ALTER TABLE `compte`
  ADD PRIMARY KEY (`NUMERO_COMPTE`),
  ADD UNIQUE KEY `IDENTIFIANT` (`IDENTIFIANT`);

--
-- Index pour la table `compte_client_pro`
--
ALTER TABLE `compte_client_pro`
  ADD PRIMARY KEY (`NUMERO_COMPTE`);

--
-- Index pour la table `compte_fournisseur`
--
ALTER TABLE `compte_fournisseur`
  ADD PRIMARY KEY (`ID_EDITEUR`),
  ADD KEY `FK_NUMERO_COMPTE` (`NUMERO_COMPTE`);

--
-- Index pour la table `compte_gerant`
--
ALTER TABLE `compte_gerant`
  ADD PRIMARY KEY (`NUMERO_COMPTE`);

--
-- Index pour la table `compte_gerantp`
--
ALTER TABLE `compte_gerantp`
  ADD PRIMARY KEY (`NUMERO_COMPTE`);

--
-- Index pour la table `ecrire`
--
ALTER TABLE `ecrire`
  ADD PRIMARY KEY (`ID_AUTEUR`,`ISBN_ISSN`),
  ADD KEY `FK_ECRIRE_ARTICLE` (`ISBN_ISSN`);

--
-- Index pour la table `facture`
--
ALTER TABLE `facture`
  ADD PRIMARY KEY (`NUMERO_FACTURE`),
  ADD KEY `I_FK_FACTURE_COMMANDE` (`NUMERO_COMMANDE`);

--
-- Index pour la table `lig_cde`
--
ALTER TABLE `lig_cde`
  ADD PRIMARY KEY (`NUMERO_COMMANDE`,`ISBN_ISSN`),
  ADD KEY `FK_LIG_CDE_ARTICLE` (`ISBN_ISSN`);

--
-- Index pour la table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`NUM_NOTE`),
  ADD UNIQUE KEY `NUM_NOTE` (`NUM_NOTE`),
  ADD KEY `NUM_NOTE_2` (`NUM_NOTE`),
  ADD KEY `NUMERO_COMPTE` (`NUMERO_COMPTE`);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`ID_EDITEUR`) REFERENCES `editeur` (`ID_EDITEUR`);

--
-- Contraintes pour la table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `client_ibfk_1` FOREIGN KEY (`NUMERO_COMPTE`) REFERENCES `compte` (`NUMERO_COMPTE`);

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `fk_commande` FOREIGN KEY (`NUMERO_COMPTE`) REFERENCES `compte` (`NUMERO_COMPTE`);

--
-- Contraintes pour la table `compte_client_pro`
--
ALTER TABLE `compte_client_pro`
  ADD CONSTRAINT `compte_client_pro_ibfk_1` FOREIGN KEY (`NUMERO_COMPTE`) REFERENCES `client` (`NUMERO_COMPTE`);

--
-- Contraintes pour la table `compte_gerant`
--
ALTER TABLE `compte_gerant`
  ADD CONSTRAINT `compte_gerant_ibfk_1` FOREIGN KEY (`NUMERO_COMPTE`) REFERENCES `compte` (`NUMERO_COMPTE`),
  ADD CONSTRAINT `compte_gÃ©rant_ibfk_1` FOREIGN KEY (`NUMERO_COMPTE`) REFERENCES `compte` (`NUMERO_COMPTE`);

--
-- Contraintes pour la table `compte_gerantp`
--
ALTER TABLE `compte_gerantp`
  ADD CONSTRAINT `compte_gerant++` FOREIGN KEY (`NUMERO_COMPTE`) REFERENCES `compte` (`NUMERO_COMPTE`);

--
-- Contraintes pour la table `ecrire`
--
ALTER TABLE `ecrire`
  ADD CONSTRAINT `ecrire_ibfk_1` FOREIGN KEY (`ID_AUTEUR`) REFERENCES `auteur` (`ID_AUTEUR`),
  ADD CONSTRAINT `ecrire_ibfk_2` FOREIGN KEY (`ISBN_ISSN`) REFERENCES `article` (`ISBN_ISSN`);

--
-- Contraintes pour la table `facture`
--
ALTER TABLE `facture`
  ADD CONSTRAINT `C_N_commande` FOREIGN KEY (`NUMERO_COMMANDE`) REFERENCES `commande` (`NUMERO_COMMANDE`);

--
-- Contraintes pour la table `lig_cde`
--
ALTER TABLE `lig_cde`
  ADD CONSTRAINT `lig_cde_ibfk_2` FOREIGN KEY (`ISBN_ISSN`) REFERENCES `article` (`ISBN_ISSN`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
