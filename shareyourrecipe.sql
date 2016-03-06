-- phpMyAdmin SQL Dump
-- version 2.11.8.1deb5+lenny9
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- G�n�r� le : Dim 10 F�vrier 2013 � 16:58
-- Version du serveur: 5.0.51
-- Version de PHP: 5.2.6-1+lenny16

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de donn�es: `SRC1_2011_12_19`
--

-- --------------------------------------------------------

--
-- Structure de la table `commente`
--

CREATE TABLE IF NOT EXISTS `commente` (
  `ID_commentaire` int(11) NOT NULL auto_increment,
  `ID_recette` int(11) default NULL,
  `ID_pseudo` int(11) default NULL,
  `commentaire` text,
  `date` varchar(30) default NULL,
  `heure` varchar(6) default NULL,
  PRIMARY KEY  (`ID_commentaire`),
  KEY `FK_COMMENTE_ID_pseudo` (`ID_pseudo`),
  KEY `FK_COMMENTE_ID_recette` (`ID_recette`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Contenu de la table `commente`
--

INSERT INTO `commente` (`ID_commentaire`, `ID_recette`, `ID_pseudo`, `commentaire`, `date`, `heure`) VALUES
(1, 1, 1, 'Merci grâce à toi je sais ce que je vais manger ce soir :)', 'Lundi 4 Juin 2012', '17:42'),
(2, 1, 2, 'De rien mon amis ! C\\''est rien que pour toi ^^', 'Lundi 4 Juin 2012', '17:43'),
(3, 4, 1, 'Je les ai tester, ils envoient trop la banane !', 'Lundi 4 Juin 2012', '19:33'),
(4, 4, 3, 'Recette bien utile pour calmer les nerfs quand on travail !', 'Lundi 4 Juin 2012', '19:33'),
(5, 5, 4, 'Ne rajoutez pas de sel, ça serait de trop...', 'Lundi 4 Juin 2012', '20:40'),
(10, 7, 6, 'C\\''est goutu, ça a du retour !', 'Mercredi 6 Juin 2012', '00:58'),
(11, 5, 6, 'Avec ça, non seulement tu prends 5 kilos, mais en plus tu dégazes pendant 1 semaine.\r\nJ\\''approuve !', 'Mercredi 6 Juin 2012', '01:08'),
(12, 7, 1, 'Ca à l\\''air bon mais la manière dont on doit le préparé ne me branche pas de trop', 'Mercredi 6 Juin 2012', '14:22'),
(13, 5, 4, 'Mais c\\''est super bon, j\\''ai même entendu dire qu\\''avec un peu de curry ça \\&quot;Currysou\\&quot;, comme ça qu\\''ils disent dans leur Pays et avec du paprika... Caprisou, en tout cas un vrais délice ;)', 'Jeudi 7 Juin 2012', '08:18'),
(16, 9, 3, 'Bonne idée pour cet été!', 'Lundi 11 Juin 2012', '22:04'),
(17, 7, 3, 'Préparation original', 'Lundi 11 Juin 2012', '22:06'),
(18, 4, 14, 'J\\''ai faim...\r\nUne dégustation ?\r\n', 'Mardi 12 Juin 2012', '15:12'),
(19, 9, 14, 'miam', 'Mardi 12 Juin 2012', '15:13');

-- --------------------------------------------------------

--
-- Structure de la table `contient`
--

CREATE TABLE IF NOT EXISTS `contient` (
  `ID_contient` int(11) NOT NULL auto_increment,
  `quantite1` varchar(100) default NULL,
  `quantite2` varchar(100) default NULL,
  `quantite3` varchar(100) default NULL,
  `quantite4` varchar(100) default NULL,
  `quantite5` varchar(100) default NULL,
  `quantite6` varchar(100) default NULL,
  `quantite7` varchar(100) default NULL,
  `quantite8` varchar(100) default NULL,
  `quantite9` varchar(100) default NULL,
  `quantite10` varchar(100) default NULL,
  `image` varchar(200) default NULL,
  `ID_recette` int(11) default NULL,
  `ID_ingredient` int(11) default NULL,
  PRIMARY KEY  (`ID_contient`),
  KEY `FK_contient_ID_recette` (`ID_recette`),
  KEY `FK_contient_ID_ingredient` (`ID_ingredient`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Contenu de la table `contient`
--

INSERT INTO `contient` (`ID_contient`, `quantite1`, `quantite2`, `quantite3`, `quantite4`, `quantite5`, `quantite6`, `quantite7`, `quantite8`, `quantite9`, `quantite10`, `image`, `ID_recette`, `ID_ingredient`) VALUES
(1, '450 grammes', '250 grammes', '250 grammes', '100 grammes', '2', 'Comme vous voulez', 'Un petit peu', 'Une pincée', 'Une pincée', 'Une pincée', 'https://src-projet.pu-pm.univ-fcomte.fr/projets_collectifs/SRC1_2011_2012/SRC1_2011_12_19/SiteFinal/connexion/ajouter_une_recette/medias/image/Gratin_Pates_forestieres_plat.jpg', 1, 1),
(2, '2', ' 5 ou 6 ', '25 cl', '1', '5 ou 6', '', '', '', '', '', 'https://src-projet.pu-pm.univ-fcomte.fr/projets_collectifs/SRC1_2011_2012/SRC1_2011_12_19/SiteFinal/connexion/ajouter_une_recette/medias/image/lasagne-aux-courgettes-et-chevre-frais.jpg', 2, 2),
(3, '1 boîte', '1kg', '1 bouteille', '', '', '', '', '', '', '', 'https://src-projet.pu-pm.univ-fcomte.fr/projets_collectifs/SRC1_2011_2012/SRC1_2011_12_19/SiteFinal/connexion/ajouter_une_recette/medias/image/Mont.JPG', 3, 3),
(4, '80 grammes', '50 grammes', '2', '50 grammes', 'une cuillère à soupe', '', '', '', '', '', 'https://src-projet.pu-pm.univ-fcomte.fr/projets_collectifs/SRC1_2011_2012/SRC1_2011_12_19/SiteFinal/connexion/ajouter_une_recette/medias/image/Fondant.JPG', 4, 4),
(5, '200 grammes', '250 grammes', '', '', '', '', '', '', '', '', 'https://src-projet.pu-pm.univ-fcomte.fr/projets_collectifs/SRC1_2011_2012/SRC1_2011_12_19/SiteFinal/connexion/ajouter_une_recette/medias/image/couennes-cassoulet-cellierduperigord.jpg', 5, 5),
(7, '3 gros', '100g', '1 sachet', '250g', '24', '30g', '30g', '', '', '', 'https://src-projet.pu-pm.univ-fcomte.fr/projets_collectifs/SRC1_2011_2012/SRC1_2011_12_19/SiteFinal/connexion/ajouter_une_recette/medias/image/IMG_3733.JPG', 7, 7),
(9, '2', 'copeaux', '4', '2', '', '', '', '', '', '', 'https://src-projet.pu-pm.univ-fcomte.fr/projets_collectifs/SRC1_2011_2012/SRC1_2011_12_19/SiteFinal/connexion/ajouter_une_recette/medias/image/173164_sans-titre.jpg', 9, 9),
(10, '1', '4', '1/2', '1', '1', '', '', '', '', '', 'https://src-projet.pu-pm.univ-fcomte.fr/projets_collectifs/SRC1_2011_2012/SRC1_2011_12_19/SiteFinal/connexion/ajouter_une_recette/medias/image/Petits-légumes-pour-terrine.jpg', 10, 10),
(11, '3', '150g', '75g', '120g', '', '', '', '', '', '', 'https://src-projet.pu-pm.univ-fcomte.fr/projets_collectifs/SRC1_2011_2012/SRC1_2011_12_19/SiteFinal/connexion/ajouter_une_recette/medias/image/23497287crumble-aux-pommes-caramelisees-417624-1-jpg.jpg', 11, 11),
(12, '1', '1', '1', '1', 'Quantité selon votre goût', '', '', '', '', '', 'https://src-projet.pu-pm.univ-fcomte.fr/projets_collectifs/SRC1_2011_2012/SRC1_2011_12_19/SiteFinal/connexion/ajouter_une_recette/medias/image/cocktail-le-magenta-bar-restaurant.jpg', 12, 12),
(13, '2', '1', '', '', '', '', '', '', '', '', 'https://src-projet.pu-pm.univ-fcomte.fr/projets_collectifs/SRC1_2011_2012/SRC1_2011_12_19/SiteFinal/connexion/ajouter_une_recette/medias/image/Capture d’e�?cran 2011-02-09 à 21.24.43.png', 13, 13);

-- --------------------------------------------------------

--
-- Structure de la table `identite`
--

CREATE TABLE IF NOT EXISTS `identite` (
  `ID_identite` int(11) NOT NULL auto_increment,
  `nom` varchar(30) default NULL,
  `prenom` varchar(50) default NULL,
  `mail` varchar(50) default NULL,
  `date_de_naissance` varchar(30) default NULL,
  `img_profil` varchar(200) default NULL,
  `citation` varchar(150) default NULL,
  `mdp` varchar(50) default NULL,
  `ID_pseudo` int(11) default NULL,
  `statut` varchar(5) default NULL,
  PRIMARY KEY  (`ID_identite`),
  KEY `FK_IDENTITE_ID_pseudo` (`ID_pseudo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Contenu de la table `identite`
--

INSERT INTO `identite` (`ID_identite`, `nom`, `prenom`, `mail`, `date_de_naissance`, `img_profil`, `citation`, `mdp`, `ID_pseudo`, `statut`) VALUES
(1, 'pilloud', 'anthony', 'pilloud.anthony@gmail.com', '14/decembre/1993', 'https://src-projet.pu-pm.univ-fcomte.fr/projets_collectifs/SRC1_2011_2012/SRC1_2011_12_19/SiteFinal/connexion/img_profil/Dainese logo 2.jpg', 'Du paprika sur un steak c\\''est délicieux', 'dc08e1db47e5a765c5caf8127b41eb4c', 1, NULL),
(2, 'Jardot', 'Lionel', 'ljardot@gmail.com', '1/octobre/1990', 'https://src-projet.pu-pm.univ-fcomte.fr/projets_collectifs/SRC1_2011_2012/SRC1_2011_12_19/SiteFinal/connexion/img_profil/IMG_0076.JPG', 'J\\''aime le steack avec de la moutrade et du fromage, le tout au four !', 'b224d517f83a691f910c100919f026b3', 2, NULL),
(3, 'Monnot', 'Adeline', 'monnot.adeline@gmail.com', '5/juillet/1991', 'https://src-projet.pu-pm.univ-fcomte.fr/projets_collectifs/SRC1_2011_2012/SRC1_2011_12_19/SiteFinal/connexion/img_profil/270040_2139057517170_1268121503_2624827_2153084_n.jpg', 'Ajouter un peu de poivre sur du fromage, c\\''est délicieux!', 'dc6fc963206e8a9b040353121af7067b', 3, NULL),
(4, 'Douvile', 'Quentin', 'douville.quentin@gmail.com', '23/septembre/1991', 'https://src-projet.pu-pm.univ-fcomte.fr/projets_collectifs/SRC1_2011_2012/SRC1_2011_12_19/SiteFinal/connexion/img_profil/zob.jpg', 'Il faut bien que quelqu\\''un fasse le sale travail, les couennes ça ne se fabrique pas tout seul!', '753c8ec47506f1546213cff938cd5483', 4, NULL),
(5, 'Claudepierre', 'Julien', 'claudepierre.julien@gmail.com', '10/avril/1991', '', 'zob', '23ed4d2e4f699dcd634d344ab30b0661', 5, NULL),
(6, 'Parisot', 'Joffrey', 'kisskooltagazok@msn.com', '13/septembre/1989', 'https://src-projet.pu-pm.univ-fcomte.fr/projets_collectifs/SRC1_2011_2012/SRC1_2011_12_19/SiteFinal/connexion/img_profil/IMG_5276.JPG', 'Tout est bon dans le cochon !', 'de6fe3b24a53d894521a3f9769b1ab49', 6, NULL),
(12, 'administrateur', 'administrateur', 'shareyourrecipe@gmail.com', '14/decembre/1993', '', '', 'dc08e1db47e5a765c5caf8127b41eb4c', 12, 'admin'),
(13, 'senente', 'xavier ', 'xavier.senente@gmail.com', 'jour/mois/annee', '', '', 'c83663d1c69a2024012428f0cdb2c45b', 13, NULL),
(14, 'M', 'D', 'david.malsot@src-media.com', '18/decembre/1917', 'https://src-projet.pu-pm.univ-fcomte.fr/projets_collectifs/SRC1_2011_2012/SRC1_2011_12_19/SiteFinal/connexion/img_profil/Capture d’e�?cran 2011-02-09 à 21.23.16.png', 'Citation', '096973aa66966580c26a256d89e952c2', 14, NULL),
(16, 'Maillot', 'Lisa', 'lisamaillot@gmail.com', '1/mars/1991', '', '', '7e011966bd1d462cc5952abdfe62c112', 16, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ingredient`
--

CREATE TABLE IF NOT EXISTS `ingredient` (
  `ID_ingredient` int(11) NOT NULL auto_increment,
  `ingredient1` varchar(50) default NULL,
  `ingredient2` varchar(50) default NULL,
  `ingredient3` varchar(50) default NULL,
  `ingredient4` varchar(50) default NULL,
  `ingredient5` varchar(50) default NULL,
  `ingredient6` varchar(50) default NULL,
  `ingredient7` varchar(50) default NULL,
  `ingredient8` varchar(50) default NULL,
  `ingredient9` varchar(50) default NULL,
  `ingredient10` varchar(50) default NULL,
  PRIMARY KEY  (`ID_ingredient`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Contenu de la table `ingredient`
--

INSERT INTO `ingredient` (`ID_ingredient`, `ingredient1`, `ingredient2`, `ingredient3`, `ingredient4`, `ingredient5`, `ingredient6`, `ingredient7`, `ingredient8`, `ingredient9`, `ingredient10`) VALUES
(1, 'Jambon', 'Tagliatelles', 'Crème fraîche', 'Parmesan', 'Oeufs', 'Fromage râpé', 'Chapelure', 'Beurre', 'Poivre', 'Sel'),
(2, 'grosse courgette', ' fromages de chèvre frais', 'lait', 'cuillère à soupe de Maïzena', 'plaques de lasagnes', 'gruyère râpé', 'sel', 'poivre', 'muscade', ''),
(3, 'Mont d\\''or', 'Pomme de terre', 'Arbois ou de Côtes du Jura', 'Ail', 'Poivre', '', '', '', '', ''),
(4, 'Chocolat pâtissier', 'Beurre', 'Oeuf', 'Sucre', 'Farine', '', '', '', '', ''),
(5, 'couennes', 'cassoulet', '', '', '', '', '', '', '', ''),
(7, 'Oeuf', 'Sucre', 'Sucre vanillé', 'Mascarpone', 'Biscuits à la cuillère', 'Café noir', 'Cacao en poudre', '', '', ''),
(9, 'Coeur de laitue', 'Parmsesan', 'Tranches de pain', 'Cuillères a soupe d\\''huile', '', '', '', '', '', ''),
(10, 'Boîte de fonds d\\\\\\''artichauts', 'Grosses carottes', 'Oignon', 'Petit morceau d\\\\\\''ail', 'Boîte de pois chiche', 'Cuillère à café d\\\\\\''huile d\\\\\\''olive', '', '', '', ''),
(11, 'Pommes', 'Farine', 'Beurre', 'Sucre', '', '', '', '', '', ''),
(12, 'Bolée de cidre', 'Cuillère à café de miel', 'Zeste de citron', 'Zeste d\\\\\\''orange', 'Cannelle', '', '', '', '', ''),
(13, 'SRC', 'hachoir', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `moyenne`
--

CREATE TABLE IF NOT EXISTS `moyenne` (
  `ID_moyenne` int(11) NOT NULL auto_increment,
  `ID_recette` int(11) NOT NULL,
  `moyenne` float NOT NULL,
  PRIMARY KEY  (`ID_moyenne`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

--
-- Contenu de la table `moyenne`
--

INSERT INTO `moyenne` (`ID_moyenne`, `ID_recette`, `moyenne`) VALUES
(1, 5, 4.5),
(2, 1, 3),
(3, 2, 2.5),
(4, 3, 4.5),
(5, 4, 2.2),
(7, 6, 2.5),
(8, 7, 3),
(9, 9, 3.8),
(10, 10, 3.5),
(11, 12, 3),
(12, 11, 4),
(13, 13, 5),
(14, 14, 4);

-- --------------------------------------------------------

--
-- Structure de la table `newsletter`
--

CREATE TABLE IF NOT EXISTS `newsletter` (
  `ID_newsletter` int(4) NOT NULL auto_increment,
  `mail` varchar(100) NOT NULL,
  PRIMARY KEY  (`ID_newsletter`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

--
-- Contenu de la table `newsletter`
--

INSERT INTO `newsletter` (`ID_newsletter`, `mail`) VALUES
(1, ''),
(10, 'pilloud.anthony@gmail.com'),
(3, 'monnot.adeline@gmail.com'),
(4, 'maryarduin@gmail.com'),
(5, 'lisamaillot@gmail.com'),
(6, 'rausie@live.fr'),
(7, 'lucas.bollereddat@gmail.com'),
(8, 'valerian.lepeule@gmail.com'),
(9, 'david@malsot.com'),
(23, ''),
(24, 'ljardot@gmail.com'),
(25, 'x69-toto-69x@hotmail.fr');

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

CREATE TABLE IF NOT EXISTS `note` (
  `ID_note` int(11) NOT NULL auto_increment,
  `ID_pseudo` int(11) default NULL,
  `ID_recette` int(11) default NULL,
  `note` float default NULL,
  PRIMARY KEY  (`ID_note`),
  KEY `FK_NOTE_ID_pseudo` (`ID_pseudo`),
  KEY `FK_NOTE_ID_recette` (`ID_recette`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Contenu de la table `note`
--

INSERT INTO `note` (`ID_note`, `ID_pseudo`, `ID_recette`, `note`) VALUES
(1, 1, 1, 3),
(2, 1, 2, 3),
(3, 1, 4, 5),
(4, 1, 3, 4),
(5, 4, 5, 5),
(6, 5, 5, 5),
(7, 4, 4, 0),
(8, 5, 4, 0),
(9, 4, 2, 0),
(10, 1, 5, 3),
(11, 2, 4, 5),
(12, 1, 2, 3),
(25, 6, 7, 5),
(26, 6, 5, 4.5),
(27, 1, 7, 1),
(28, 4, 5, 5),
(30, 1, 9, 5),
(31, 2, 9, 4),
(32, 1, 9, 5),
(33, 3, 9, 5),
(34, 2, 10, 3),
(35, 3, 10, 4),
(36, 12, 2, 4),
(37, 2, 12, 3),
(38, 2, 11, 4),
(39, 14, 4, 1),
(40, 14, 9, 0),
(41, 14, 13, 5);

-- --------------------------------------------------------

--
-- Structure de la table `pseudo`
--

CREATE TABLE IF NOT EXISTS `pseudo` (
  `ID_pseudo` int(11) NOT NULL auto_increment,
  `pseudo` varchar(30) default NULL,
  `ID_identite` int(11) default NULL,
  PRIMARY KEY  (`ID_pseudo`),
  KEY `FK_PSEUDO_ID_identite` (`ID_identite`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Contenu de la table `pseudo`
--

INSERT INTO `pseudo` (`ID_pseudo`, `pseudo`, `ID_identite`) VALUES
(1, 'tonio250', 1),
(2, 'Toto25', 2),
(3, 'Aifeen', 3),
(4, '3psilon', 4),
(5, 'julien', 5),
(6, 'Starkadh', 6),
(12, 'administrateur', 12),
(13, 'xsenente', 13),
(14, 'dmalsot', 14),
(16, 'Titi25', 16);

-- --------------------------------------------------------

--
-- Structure de la table `recette`
--

CREATE TABLE IF NOT EXISTS `recette` (
  `ID_recette` int(11) NOT NULL auto_increment,
  `nom_recette` varchar(50) default NULL,
  `preparation` text,
  `conseil` varchar(255) default NULL,
  `qr_code` blob,
  `ID_pseudo` int(11) default NULL,
  PRIMARY KEY  (`ID_recette`),
  KEY `FK_RECETTE_ID_pseudo` (`ID_pseudo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Contenu de la table `recette`
--

INSERT INTO `recette` (`ID_recette`, `nom_recette`, `preparation`, `conseil`, `qr_code`, `ID_pseudo`) VALUES
(1, 'Gratin de tagliatelle au jambon', 'Cuire les tagliatelles dans de l\\''eau salée (al dente), puis les mettre dans une passoire.\r\n\r\nCoupé les tranches de jambon en bandes fines (de la même forme que les tagliatelles).\r\n\r\nVerser les tagliatelles dans leurs caserolles et ajouter le jambon.\r\n\r\nAjouter du persil finement haché et bien mélanger.\r\n\r\nBeurrer votre plat à gratin et y verser de la chapelure de façon a ne pas voir le fond (secouer le plat pour en avoir sur les côtés).\r\n\r\nVerser dans le plat à gratin la moitié de votre mélange (jambon, tagliatelles, persil) puis saupoudrer de parmesan. Saler, poivrer. Verser par-dessus le reste du mélange.\r\n\r\nDans un bol, battre les oeufs, ajouter la crème fraîche, saler, poivrer et bien battre le tout.\r\n\r\nVerser cette préparation sur le gratin, puis ajouter le frômage râpé.\r\n\r\nCouper le beurre (bien froid) en fines lamelles que l\\''on dispose sur le gratin de façon à le recouvrir de beurre. Laisser reposer 10 mn.\r\n\r\nPréchauffer votre four à 200°C (pendant que votre gratin se repose!).\r\n\r\nMettre au four pendant 40 mn. Bien surveiller la cuisson, baisser la température du four quant le gratin commance à dorer.', '', NULL, 2),
(2, 'Lasagnes aux courgettes et au chèvre', 'Préchauffer le four à thermostat 6 (180°C). \r\n\r\n\r\nLaver les courgettes, les râper avec une grosse grille. Faire revenir 15 mn à feu doux dans une poêle. \r\n\r\nAjouter les chèvres frais, saler et poivrer. \r\nMettre les pâtes à cuire. \r\n\r\nFaire un béchamel légère : porter à ébullition le lait et ajouter la Maïzena, mélanger à feu doux pour que la sauce prenne, saler, poivrer et ajouter la muscade. \r\n\r\nDans un plat, alterner la sauce, les plaques de lasagnes, les courgettes, terminer par la sauce. Parsemer de gruyère. \r\n\r\nEnfourner 20 à 25 mn.', '', NULL, 1),
(3, 'Mont d\\''or', '1      Creuser un trou au milieu du Mont d\\\\\\\\\\\\\\''Or et le remplir de votre vin d\\\\\\\\\\\\\\''Arbois (préférer un vin de cépage Savagnin, Tradition).\r\n\r\n2      Piquer de deux gousses d\\\\\\\\\\\\\\''ail. Poivrer.\r\nEmballer la boîte dans une feuille d\\\\\\\\\\\\\\''aluminium.\r\n\r\n3      Faire gratiner une vingtaine de minutes à thermostat 7.\r\nEn parallèle, faites cuire des pommes de terre à la vapeur.', 'Servir le fromage sur les pommes de terre.', NULL, 3),
(4, 'Fondant au chocolat', '1    Dans un saladier, mélanger le sucre et les oeufs.\r\n\r\n2    Dans une casserole faire fondre le beurre et le chocolat. Une fois la préparation fondue la mélanger dans la préparation sucre+oeufs et ajouter une cuillère à soupe rase de farine.\r\n\r\n3    Beurrer 4 ramequins en aluminium et y verser la préparation. Mettre au four à 180°C pendant 10 minutes.', 'Pour un coeur fondant ajouter avant la cuisson un carré de chocolat pâtissier au-dessus.', NULL, 3),
(5, 'Cassoulet aux couennes de lard fumées', 'Ouvrir une boite de cassoulet, y ajouter les couennes puis mélangez, le tout à petit feu.', 'Prenez le cassoulet (william saurin)', NULL, 4),
(7, 'Tiramisu', '-Prenez les 3 gros œufs. Séparez les blancs des jaunes (rassurez-vous, je ne suis pas raciste)\r\n&lt;br /&gt;\r\n&lt;br /&gt;\r\n-Mélangez les jaunes avec le sucre et le sucre vanillé (Ah, la fusion de deux corps...l\\''un dans l\\''autre, la cuisine c\\''est ça : une alchimie !)\r\n&lt;br /&gt;\r\n&lt;br /&gt;\r\n-Rajoutez la mascarpone au fouet (t\\''aimes ça hein ? Oh oui vas-y !!!)\r\n&lt;br /&gt;\r\n&lt;br /&gt;\r\n-Montez les blancs...en neige (vous y avez cru hein ? Bande de cochonous !)\r\n&lt;br /&gt;\r\n&lt;br /&gt;\r\n-Faites-les pénétrer délicatement au mélange mascarpone/jaunes d’œufs (délicatement j\\''ai dit, sinon ça claque)\r\n&lt;br /&gt;\r\n&lt;br /&gt;\r\n-Trempez la bisco...les biscuits dans le café\r\n&lt;br /&gt;\r\n&lt;br /&gt;\r\n-Crépissez le fond du moule avec les biscuits (et pas autre chose surtout !)\r\n&lt;br /&gt;\r\n&lt;br /&gt;\r\n-Badigeonnez sensuellement et généreusement le mélange sur les biscuit (lisse et glissant, c\\''est bien plus band...séduisant)\r\n&lt;br /&gt;\r\n&lt;br /&gt;\r\n-Alternez les étages : faites un va-et-vient continuel biscuits/mélange...\r\n&lt;br /&gt;\r\n&lt;br /&gt;\r\n-Terminez par une bonne couche de crème bien fraîche (attention ! crème = mélange hein !)\r\n&lt;br /&gt;\r\n&lt;br /&gt;\r\n-Secouez le cacao en poudre au-dessus de la couche blanche (n\\''en mettez pas à côté, ce serait un génocide)\r\n&lt;br /&gt;\r\n&lt;br /&gt;\r\n-Faites durcir tout ça au frigo pendant 4h, mais selon votre préférence (c\\''est mieux dur que mou n\\''est-ce pas ?)\r\n&lt;br /&gt;\r\n&lt;br /&gt;\r\n-Savourez et grimpez au 7ème ciel !', 'Cette recette peut être réalisée dans des verrines, ou à défaut des verres, pour une présentation bien plus stylée.\r\n&lt;br /&gt;\r\n&lt;br /&gt;\r\nVous pouvez aussi ajouter le cacao en poudre entre chaque étage, c\\\\\\''est bien bon !', NULL, 6),
(9, 'Salade césar', 'Faites dorer le pain, coupé en cubes, 3 min dans un peu d\\''huile. \r\n\r\nDéchirez les feuilles de romaine dans un saladier, et ajoutez les croûtons préalablement épongés dans du papier absorbant. \r\n\r\nPréparez la sauce :\r\n\r\nFaites cuire l\\''oeuf 1 min 30 dans l\\''eau bouillante, et rafraîchissez-le. \r\n\r\nCassez-le dans le bol d\\''un mixeur et mixez, avec tous les autres ingrédients; rectifiez l\\''assaissonnement et incorporez à la salade. \r\n\r\nDécorez de copeaux de parmesan, et servez.', '', NULL, 2),
(10, 'Petits légumes équilibrés', 'Dans une poêle anti-adhésive, commencez la cuisson des carottes, puis dès qu\\\\\\''elles commencent à cuire, ajoutez l\\\\\\''oignon, les fonds d\\\\\\''artichaut et les pois chiches pour qu\\\\\\''ils rissolent et s\\\\\\''attendrissent ensemble.', '', NULL, 2),
(11, 'Crumble au pomme', 'Couper les pommes en dés.\r\n\r\nDans un saladier, mélanger la farine au sucre, puis au beurre. Malaxer le tout avec les doigts pour obtenir une pâte sableuse.\r\n\r\nBeurrer le moule, y disposer les pommes tranchées (ou les poires) et placer la pâte par dessus.\r\n\r\nLaisser cuire 25 mn à thermostat 6 (180°C).', 'Servir avec une crème anglaise.', NULL, 3),
(12, 'Cocktail Magenta au cidre', 'Mélangez le cidre avec le miel et la cannelle en poudre. Rajoutez les zests de citron et d’orange.', 'Vous pouvez décorer vos verres avec des bâtons de cannelle. Servez accompagné de croustillantes rondelles de citron séchées.', NULL, 2),
(13, 'SRC tartare', 'Prendre un SRC.\r\nLe hacher longuement en soutenance.\r\nServir saignant !', 'Prendre un SRC propre...\r\n\r\nPossibilité de remplacer le hachoir par un ou deux chars.\r\n', NULL, 14);

--
-- Contraintes pour les tables export�es
--

--
-- Contraintes pour la table `commente`
--
ALTER TABLE `commente`
  ADD CONSTRAINT `FK_COMMENTE_ID_pseudo` FOREIGN KEY (`ID_pseudo`) REFERENCES `pseudo` (`ID_pseudo`),
  ADD CONSTRAINT `FK_COMMENTE_ID_recette` FOREIGN KEY (`ID_recette`) REFERENCES `recette` (`ID_recette`);

--
-- Contraintes pour la table `contient`
--
ALTER TABLE `contient`
  ADD CONSTRAINT `FK_contient_ID_ingredient` FOREIGN KEY (`ID_ingredient`) REFERENCES `ingredient` (`ID_ingredient`),
  ADD CONSTRAINT `FK_contient_ID_recette` FOREIGN KEY (`ID_recette`) REFERENCES `recette` (`ID_recette`);

--
-- Contraintes pour la table `identite`
--
ALTER TABLE `identite`
  ADD CONSTRAINT `FK_IDENTITE_ID_pseudo` FOREIGN KEY (`ID_pseudo`) REFERENCES `pseudo` (`ID_pseudo`);
