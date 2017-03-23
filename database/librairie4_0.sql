-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 23 Mars 2017 à 13:09
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
(1, 'Hugo', 'Victor'),
(2, 'Camus', 'Albert'),
(3, 'Zola', 'Emile');

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
(1, 'Client', 'Client'),
(2, 'Clientpro', 'Clientpro'),
(3, 'Fournisseur', 'Fournisseur'),
(4, 'Fournisseur', 'Fournisseur');

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
(1, 1, '23-03-2017', 'VALIDE'),
(2, 2, '23-03-2017', 'ANNULE'),
(3, 2, '23-03-2017', 'EN ATTENTE DE VALIDATION'),
(4, 2, NULL, 'EN COURS'),
(5, 3, NULL, 'EN COURS'),
(6, 4, NULL, 'EN COURS'),
(7, 4, NULL, 'EN COURS'),
(8, 4, NULL, 'EN COURS'),
(9, 4, NULL, 'EN COURS'),
(10, 4, NULL, 'EN COURS'),
(11, 1, '23-03-2017', 'VALIDE'),
(12, 1, '23-03-2017', 'REFUSE'),
(13, 1, '23-03-2017', 'EN ATTENTE DE VALIDATION'),
(14, 1, '23-03-2017', 'EN ATTENTE DE VALIDATION'),
(15, 1, NULL, 'EN COURS');

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
  `ADRESSE` text COMMENT 'adresse',
  `CODE_POSTALE` int(11) DEFAULT NULL COMMENT 'code postale',
  `VILLE` varchar(40) DEFAULT NULL COMMENT 'ville'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `compte`
--

INSERT INTO `compte` (`NUMERO_COMPTE`, `ADRESSE_MAIL`, `MOT_DE_PASSE`, `ADMIN`, `NUMERO_TELEPHONE`, `IDENTIFIANT`, `ADRESSE`, `CODE_POSTALE`, `VILLE`) VALUES
(0, 'admin@mail.fr', '81dc9bdb52d04dc20036dbd8313ed055', NULL, NULL, 'admin', '', 0, ''),
(1, 'Client.client@client.fr', '81dc9bdb52d04dc20036dbd8313ed055', NULL, 606060606, 'client', '678 rue des essarts', 27520, 'Bourgtheroulde'),
(2, 'client.pro@clientpro.fr', '81dc9bdb52d04dc20036dbd8313ed055', NULL, 606060606, 'clientPro', '6 rue Anton tchekov', 14123, 'Ifs'),
(3, 'Fournisseur@fourni.fr', '81dc9bdb52d04dc20036dbd8313ed055', NULL, 606060606, 'Fournisseur', '3 rue Anton Tchekov', 14123, 'Ifs'),
(4, 'Fournisseur@fourni.fr', '81dc9bdb52d04dc20036dbd8313ed055', NULL, 606060606, 'Fournisseur1', '8 rue Anton Tchekhov', 14123, 'Ifs'),
(5, NULL, '4a742ecc002db059e1500ebd73d8dce1', NULL, NULL, 'gerant_1', NULL, NULL, NULL),
(6, NULL, '05a0bd68d7e33148fa2d51fc8b2bb99e', NULL, NULL, 'gerant_2', NULL, NULL, NULL),
(7, NULL, '81dc9bdb52d04dc20036dbd8313ed055', NULL, NULL, 'Gerant', NULL, NULL, NULL);

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
(2, 12345678910123, 0);

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
(NULL, 578963, 'Edition du Chameau', 0),
(NULL, 896541, 'Atlas', 0),
(NULL, 897486, 'Nathan', 0);

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
(5),
(6),
(7);

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
(1, 9782917437520, 1, '10.00'),
(1, 9782917437605, 1, '15.00'),
(3, 9782917437520, 1, '10.00'),
(3, 9782917437742, 1, '14.00'),
(11, 9782917437520, 2, '10.00'),
(12, 9782917437742, 35, '14.00'),
(13, 9782917437605, 1, '15.00'),
(14, 9782917437520, 8, '10.00');

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

CREATE TABLE `note` (
  `NUMERO_COMPTE` int(11) NOT NULL,
  `TEXT` varchar(255) NOT NULL,
  `DATE_NOTE` varchar(15) NOT NULL,
  `SUPPR` tinyint(1) NOT NULL DEFAULT '0',
  `NUM_NOTE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `note`
--

INSERT INTO `note` (`NUMERO_COMPTE`, `TEXT`, `DATE_NOTE`, `SUPPR`, `NUM_NOTE`) VALUES
(7, 'Bonjour le Campus 3', '23/3/2017', 0, 1);

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
(9782917437742, 3),
(9782917437773, 4);

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
