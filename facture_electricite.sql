-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 12 avr. 2022 à 01:30
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `facture_electricite`
--

-- --------------------------------------------------------

--
-- Structure de la table `agent`
--

CREATE TABLE `agent` (
  `Id_Agent` int(11) NOT NULL,
  `cin` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `nom` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `nom_fournisseur` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `agent`
--

INSERT INTO `agent` (`Id_Agent`, `cin`, `nom`, `prenom`, `nom_fournisseur`) VALUES
(17021311, 'LE28998', 'ABDELOUAHAB', 'Ismail', 'E-Nour'),
(17021312, 'LC284456', 'RABIAA', 'Anass', 'E-Nour'),
(17021313, 'K227666', 'BENALLOUCH', 'Mohammed', 'E-Nour'),
(17021314, 'LC556776', 'BAKKALI', 'Abdellah', 'E-Nour');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `Id_Client` int(11) NOT NULL,
  `cin` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `nom` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telephone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `adresse` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ville` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `nom_fournisseur` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`Id_Client`, `cin`, `nom`, `prenom`, `email`, `telephone`, `adresse`, `ville`, `nom_fournisseur`) VALUES
(18031927, 'LE28999', 'ABDELOUAHAB', 'ISMAIL', 'abdelouahab@outlook.fr', '0 6 27 60 44 90', 'HAY AHRIK, AV ADDORA ZKT 2 NR 8', 'Martil', 'E-Nour'),
(18031928, 'LE28998', 'BEN STITOU', 'Hajar', 'hajar.benstitou@gmail.com', '0 6 27 60 44 90', 'Rue des fleures', 'M\'diq', 'E-Nour'),
(18031929, 'LE238778', 'AL ANSARI', 'Ahmed', 'elansari@outlook.fr', '6 44 23 87 66', 'Caffe Mozzart, Av Forces Royales', 'Tetouan', 'E-Nour');

-- --------------------------------------------------------

--
-- Structure de la table `consommation`
--

CREATE TABLE `consommation` (
  `id_Consommation` int(11) NOT NULL,
  `mois_consommation` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `quantite` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `statut` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `Id_Client` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `consommation`
--

INSERT INTO `consommation` (`id_Consommation`, `mois_consommation`, `quantite`, `statut`, `Id_Client`) VALUES
(3, '2022-01', '500', 'En attente', 18031927),
(4, '2022-02', '300', 'Validée', 18031927),
(5, '2022-05', '236', 'Validée', 18031927),
(6, '2022-06', '23', 'Validée', 18031927),
(7, '2022-05', '233', 'Validée', 18031928),
(8, '2022-11', '86', 'Validée', 18031928),
(9, '2022-01', '118', 'Validée', 18031928),
(10, '2022-02', '1324', 'En attente', 18031928);

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

CREATE TABLE `facture` (
  `id_Facture` int(11) NOT NULL,
  `date_facture` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `consommation` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `montant_ht` float NOT NULL,
  `montant_ttc` float NOT NULL,
  `nom_client` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `prenom_client` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `adresse_client` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `id_Consommation` int(11) NOT NULL,
  `nom_fournisseur` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Id_Client` int(11) NOT NULL,
  `etat` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `facture`
--

INSERT INTO `facture` (`id_Facture`, `date_facture`, `consommation`, `montant_ht`, `montant_ttc`, `nom_client`, `prenom_client`, `adresse_client`, `id_Consommation`, `nom_fournisseur`, `Id_Client`, `etat`) VALUES
(15, '2022-01', '500', 560, 638.4, 'ABDELOUAHAB', 'ISMAIL', 'HAY AHRIK, AV ADDORA ZKT 2 NR 8', 3, 'E-Nour', 18031927, 'Non payée'),
(16, '2022-02', '300', 336, 383.04, 'ABDELOUAHAB', 'ISMAIL', 'HAY AHRIK, AV ADDORA ZKT 2 NR 8', 4, 'E-Nour', 18031927, 'Non payée'),
(17, '2022-05', '236', 264.32, 301.325, 'ABDELOUAHAB', 'ISMAIL', 'HAY AHRIK, AV ADDORA ZKT 2 NR 8', 5, 'E-Nour', 18031927, 'Non payée'),
(18, '2022-06', '23', 20.93, 23.8602, 'ABDELOUAHAB', 'ISMAIL', 'HAY AHRIK, AV ADDORA ZKT 2 NR 8', 6, 'E-Nour', 18031927, 'Non payée'),
(19, '2022-05', '233', 260.96, 297.494, 'BEN STITOU', 'Hajar', 'Rue des fleures', 7, 'E-Nour', 18031928, 'Non payée'),
(20, '2022-11', '86', 78.26, 89.2164, 'BEN STITOU', 'Hajar', 'Rue des fleures', 8, 'E-Nour', 18031928, 'Non payée'),
(21, '2022-01', '118', 119.18, 135.865, 'BEN STITOU', 'Hajar', 'Rue des fleures', 9, 'E-Nour', 18031928, 'Non payée'),
(22, '2022-02', '1324', 1482.88, 1690.48, 'BEN STITOU', 'Hajar', 'Rue des fleures', 10, 'E-Nour', 18031928, 'Non payée');

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

CREATE TABLE `fournisseur` (
  `nom_fournisseur` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `adresse_fournisseur` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email_fournisseur` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tel_fournisseur` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `fournisseur`
--

INSERT INTO `fournisseur` (`nom_fournisseur`, `adresse_fournisseur`, `email_fournisseur`, `tel_fournisseur`) VALUES
('E-Nour', 'Chebar,Martil', 'martilgeo@enour.ma', '0522341667');

-- --------------------------------------------------------

--
-- Structure de la table `réclamation`
--

CREATE TABLE `réclamation` (
  `id_Reclamation` int(11) NOT NULL,
  `date_reclamation` datetime NOT NULL,
  `sujet` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `Id_Client` int(11) NOT NULL,
  `reponse` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `réclamation`
--

INSERT INTO `réclamation` (`id_Reclamation`, `date_reclamation`, `sujet`, `description`, `Id_Client`, `reponse`) VALUES
(7, '2022-04-12 00:43:40', 'Facture coûteuse', 'La facture du mois Avril est trop chere', 18031927, 'En attente'),
(8, '2022-04-12 00:45:23', 'انقطاع الكهرباء', 'نعاني من انقطاع يومي للكهرباء، المرجو التدخل لحل هذا المشكل في أقرب وقت', 18031927, 'En attente'),
(9, '2022-04-12 00:52:55', 'Coupure d\'électricité', 'Une coupure d\'electricite a causé la tombe en panne de plusieurs appareils dans la maison.', 18031928, 'En attente'),
(10, '2022-04-12 00:53:28', 'Suje 2', 'Description du sujet 2', 18031928, 'En attente'),
(11, '2022-04-12 00:53:46', 'Sujet 3', 'Description du sujet 3', 18031928, 'En attente'),
(12, '2022-04-12 00:54:15', 'Sujet 4', 'Description du sujet 4', 18031928, 'En attente');

-- --------------------------------------------------------

--
-- Structure de la table `zone_géographique`
--

CREATE TABLE `zone_géographique` (
  `ville` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Id_Agent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `zone_géographique`
--

INSERT INTO `zone_géographique` (`ville`, `Id_Agent`) VALUES
('Martil', 17021311),
('Tetouan', 17021312),
('M\'diq', 17021313),
('Fnideq', 17021314);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `agent`
--
ALTER TABLE `agent`
  ADD PRIMARY KEY (`Id_Agent`),
  ADD KEY `nom_fournisseur` (`nom_fournisseur`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`Id_Client`),
  ADD KEY `ville` (`ville`),
  ADD KEY `nom_fournisseur` (`nom_fournisseur`);

--
-- Index pour la table `consommation`
--
ALTER TABLE `consommation`
  ADD PRIMARY KEY (`id_Consommation`),
  ADD KEY `Id_Client` (`Id_Client`);

--
-- Index pour la table `facture`
--
ALTER TABLE `facture`
  ADD PRIMARY KEY (`id_Facture`),
  ADD KEY `id_Consommation` (`id_Consommation`),
  ADD KEY `nom_fournisseur` (`nom_fournisseur`),
  ADD KEY `Id_Client` (`Id_Client`);

--
-- Index pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  ADD PRIMARY KEY (`nom_fournisseur`);

--
-- Index pour la table `réclamation`
--
ALTER TABLE `réclamation`
  ADD PRIMARY KEY (`id_Reclamation`),
  ADD KEY `Id_Client` (`Id_Client`);

--
-- Index pour la table `zone_géographique`
--
ALTER TABLE `zone_géographique`
  ADD PRIMARY KEY (`ville`),
  ADD UNIQUE KEY `Id_Agent` (`Id_Agent`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `agent`
--
ALTER TABLE `agent`
  MODIFY `Id_Agent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17021315;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `Id_Client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18031930;

--
-- AUTO_INCREMENT pour la table `consommation`
--
ALTER TABLE `consommation`
  MODIFY `id_Consommation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `facture`
--
ALTER TABLE `facture`
  MODIFY `id_Facture` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `réclamation`
--
ALTER TABLE `réclamation`
  MODIFY `id_Reclamation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `agent`
--
ALTER TABLE `agent`
  ADD CONSTRAINT `agent_ibfk_1` FOREIGN KEY (`nom_fournisseur`) REFERENCES `fournisseur` (`nom_fournisseur`);

--
-- Contraintes pour la table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `client_ibfk_1` FOREIGN KEY (`ville`) REFERENCES `zone_géographique` (`ville`),
  ADD CONSTRAINT `client_ibfk_2` FOREIGN KEY (`nom_fournisseur`) REFERENCES `fournisseur` (`nom_fournisseur`);

--
-- Contraintes pour la table `consommation`
--
ALTER TABLE `consommation`
  ADD CONSTRAINT `consommation_ibfk_1` FOREIGN KEY (`Id_Client`) REFERENCES `client` (`Id_Client`);

--
-- Contraintes pour la table `facture`
--
ALTER TABLE `facture`
  ADD CONSTRAINT `facture_ibfk_1` FOREIGN KEY (`id_Consommation`) REFERENCES `consommation` (`id_Consommation`),
  ADD CONSTRAINT `facture_ibfk_2` FOREIGN KEY (`nom_fournisseur`) REFERENCES `fournisseur` (`nom_fournisseur`),
  ADD CONSTRAINT `facture_ibfk_3` FOREIGN KEY (`Id_Client`) REFERENCES `client` (`Id_Client`);

--
-- Contraintes pour la table `réclamation`
--
ALTER TABLE `réclamation`
  ADD CONSTRAINT `réclamation_ibfk_1` FOREIGN KEY (`Id_Client`) REFERENCES `client` (`Id_Client`);

--
-- Contraintes pour la table `zone_géographique`
--
ALTER TABLE `zone_géographique`
  ADD CONSTRAINT `zone_géographique_ibfk_1` FOREIGN KEY (`Id_Agent`) REFERENCES `agent` (`Id_Agent`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
