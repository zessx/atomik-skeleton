-- Dumping structure for table atomik_db.clients
DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id_client` int(10) NOT NULL AUTO_INCREMENT,
  `raison_sociale` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nom` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prenom` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `adresse` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code_postal` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ville` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telephone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_client`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping structure for table atomik_db.employes
DROP TABLE IF EXISTS `employes`;
CREATE TABLE IF NOT EXISTS `employes` (
  `id_employe` int(10) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prenom` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` enum('administrateur','utilisateur') COLLATE utf8_unicode_ci DEFAULT NULL,
  `identifiant` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mot_de_passe` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sel` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_employe`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table atomik_db.employes: ~3 rows (environ)
DELETE FROM `employes`;
/*!40000 ALTER TABLE `employes` DISABLE KEYS */;
INSERT INTO `employes` (`id_employe`, `nom`, `prenom`, `role`, `identifiant`, `mot_de_passe`, `sel`) VALUES
	(1, 'Administrateur', 'M.', 'administrateur', 'admin', '4dcdd763e140ca7fabf4ecf12ccb8383bf164d59', '21232f297a57a5a743894a0e4a801fc3'),
	(2, 'Utilisateur', 'M.', 'utilisateur', 'user', '5e0f76b90574332a6aaad1a09c9d64885c86dc50', 'ee11cbb19052e40b07aac0ca060c23ee');
/*!40000 ALTER TABLE `employes` ENABLE KEYS */;

-- Dumping structure for table loccapi_db.logs
DROP TABLE IF EXISTS `logs`;
CREATE TABLE IF NOT EXISTS `logs` (
  `id_log` int(10) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `employe` int(10) DEFAULT NULL,
  `objet` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_objet` int(11) DEFAULT NULL,
  `action` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `commentaire` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id_log`),
  KEY `employe` (`employe`),
  KEY `id_objet` (`id_objet`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
