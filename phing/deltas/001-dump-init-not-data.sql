-- MySQL dump

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Aurkezpena`
--

DROP TABLE IF EXISTS `Aurkezpena`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Aurkezpena` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `edukiaId` mediumint(8) unsigned NOT NULL,
  `titulua` varchar(350) DEFAULT NULL,
  `url` varchar(250) NOT NULL,
  `klikKopurua` int(25) NOT NULL DEFAULT '0',
  `sortzeData` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_Aurkezpena_Edukia1_idx` (`edukiaId`),
  CONSTRAINT `fk_Aurkezpena_Edukia1` FOREIGN KEY (`edukiaId`) REFERENCES `Edukia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Bideoa`
--

DROP TABLE IF EXISTS `Bideoa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Bideoa` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `edukiaId` mediumint(8) unsigned NOT NULL,
  `titulua` varchar(350) DEFAULT NULL,
  `url` varchar(250) NOT NULL,
  `klikKopurua` int(25) NOT NULL DEFAULT '0',
  `sortzeData` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_BIdeoa_Edukia1_idx` (`edukiaId`),
  CONSTRAINT `fk_BIdeoa_Edukia1` FOREIGN KEY (`edukiaId`) REFERENCES `Edukia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Edukia`
--

DROP TABLE IF EXISTS `Edukia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Edukia` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `erabiltzaileaId` mediumint(8) unsigned DEFAULT NULL,
  `titulua` varchar(350) NOT NULL,
  `deskribapenLaburra` varchar(140) NOT NULL,
  `deskribapena` mediumtext NOT NULL,
  `bisitaKopurua` int(25) NOT NULL DEFAULT '0',
  `urteakNoiztik` int(25) DEFAULT NULL,
  `urteakNoizarte` int(25) DEFAULT NULL,
  `egoera` varchar(250) NOT NULL DEFAULT 'onartzeko' COMMENT '[enum:onartzeko|onartua]',
  `url` varchar(350) NOT NULL COMMENT '[urlIdentifier:titulua]',
  `sortzeData` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_Edukia_Erabiltzailea1_idx` (`erabiltzaileaId`),
  CONSTRAINT `fk_Edukia_Erabiltzailea1` FOREIGN KEY (`erabiltzaileaId`) REFERENCES `Erabiltzailea` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `EdukiaRelIkastegia`
--

DROP TABLE IF EXISTS `EdukiaRelIkastegia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EdukiaRelIkastegia` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `edukiaId` mediumint(8) unsigned NOT NULL,
  `ikastegiaId` mediumint(8) unsigned NOT NULL,
  `egoera` varchar(250) NOT NULL DEFAULT 'onartzeko' COMMENT '[enum:onartzeko|onartua]',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `edukiaId` (`edukiaId`,`ikastegiaId`),
  KEY `fk_Edukia_has_Ikastetxea_Ikastetxea1_idx` (`ikastegiaId`),
  KEY `fk_Edukia_has_Ikastetxea_Edukia1_idx` (`edukiaId`),
  CONSTRAINT `EdukiaRelIkastegia_ibfk_1` FOREIGN KEY (`edukiaId`) REFERENCES `Edukia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `EdukiaRelIkastegia_ibfk_2` FOREIGN KEY (`ikastegiaId`) REFERENCES `Ikastegia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `EdukiaRelKanpaina`
--

DROP TABLE IF EXISTS `EdukiaRelKanpaina`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EdukiaRelKanpaina` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `kanpainaId` mediumint(8) unsigned NOT NULL,
  `edukiaId` mediumint(8) unsigned NOT NULL,
  `irabazlea` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `batenBakarrik` (`kanpainaId`,`edukiaId`),
  KEY `fk_Kanpaina_has_Edukia_Edukia1_idx` (`edukiaId`),
  KEY `fk_Kanpaina_has_Edukia_Kanpaina1_idx` (`kanpainaId`),
  CONSTRAINT `fk_Kanpaina_has_Edukia_Edukia1` FOREIGN KEY (`edukiaId`) REFERENCES `Edukia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_Kanpaina_has_Edukia_Kanpaina1` FOREIGN KEY (`kanpainaId`) REFERENCES `Kanpaina` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `EdukiaRelKategoria`
--

DROP TABLE IF EXISTS `EdukiaRelKategoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EdukiaRelKategoria` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `edukiaId` mediumint(8) unsigned NOT NULL,
  `kategoriaId` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `edukiaId` (`edukiaId`,`kategoriaId`),
  KEY `fk_Edukia_has_Kategoria_Kategoria1_idx` (`kategoriaId`),
  KEY `fk_Edukia_has_Kategoria_Edukia1_idx` (`edukiaId`),
  CONSTRAINT `fk_Edukia_has_Kategoria_Edukia1` FOREIGN KEY (`edukiaId`) REFERENCES `Edukia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_Edukia_has_Kategoria_Kategoria1` FOREIGN KEY (`kategoriaId`) REFERENCES `Kategoria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `EdukiaRelMaila`
--

DROP TABLE IF EXISTS `EdukiaRelMaila`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EdukiaRelMaila` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `edukiaId` mediumint(8) unsigned NOT NULL,
  `mailaId` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `edukiaId` (`edukiaId`),
  KEY `mailaId` (`mailaId`),
  CONSTRAINT `EdukiaRelMaila_ibfk_1` FOREIGN KEY (`edukiaId`) REFERENCES `Edukia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `EdukiaRelMaila_ibfk_2` FOREIGN KEY (`mailaId`) REFERENCES `Maila` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Erabiltzailea`
--

DROP TABLE IF EXISTS `Erabiltzailea`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Erabiltzailea` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `izena` varchar(250) DEFAULT NULL,
  `abizena` varchar(250) DEFAULT NULL,
  `abizena2` varchar(250) DEFAULT NULL,
  `deskribapena` mediumtext,
  `erabiltzaileIzena` varchar(250) NOT NULL,
  `pasahitza` varchar(250) NOT NULL COMMENT '[password]',
  `posta` varchar(350) NOT NULL,
  `egoera` varchar(250) NOT NULL DEFAULT 'sortua' COMMENT '[enum:sortua|datuakSartuta|aktibatua]',
  `url` varchar(250) NOT NULL COMMENT '[urlIdentifier:erabiltzaileIzena]',
  `jaiotzeData` date NOT NULL,
  `sortzeData` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `altaData` timestamp NULL DEFAULT NULL,
  `superErabiltzailea` tinyint(1) NOT NULL DEFAULT '0',
  `hash` varchar(350) DEFAULT NULL,
  `hashIraungiData` datetime DEFAULT NULL,
  `irudiaId` mediumint(8) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `irudiaId` (`irudiaId`),
  CONSTRAINT `Erabiltzailea_ibfk_1` FOREIGN KEY (`irudiaId`) REFERENCES `ErabiltzaileenIrudiak` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ErabiltzaileaRelEdukia`
--

DROP TABLE IF EXISTS `ErabiltzaileaRelEdukia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ErabiltzaileaRelEdukia` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `edukiaId` mediumint(8) unsigned NOT NULL,
  `erabiltzaileaId` mediumint(8) unsigned NOT NULL,
  `egoera` varchar(250) NOT NULL DEFAULT 'baieztatua' COMMENT '[enum:baieztatzeko|baieztatua]',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `edukiaId` (`edukiaId`,`erabiltzaileaId`),
  KEY `fk_Erabiltzailea_has_Edukia_Edukia1_idx` (`edukiaId`),
  KEY `fk_Erabiltzailea_has_Edukia_Erabiltzailea1_idx` (`erabiltzaileaId`),
  CONSTRAINT `fk_Erabiltzailea_has_Edukia_Edukia1` FOREIGN KEY (`edukiaId`) REFERENCES `Edukia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_Erabiltzailea_has_Edukia_Erabiltzailea1` FOREIGN KEY (`erabiltzaileaId`) REFERENCES `Erabiltzailea` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ErabiltzaileaRelIkastegia`
--

DROP TABLE IF EXISTS `ErabiltzaileaRelIkastegia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ErabiltzaileaRelIkastegia` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `erabiltzaileaId` mediumint(8) unsigned NOT NULL,
  `ikastegiaId` mediumint(8) unsigned NOT NULL,
  `administratzailea` tinyint(1) NOT NULL DEFAULT '0',
  `jabea` tinyint(1) NOT NULL DEFAULT '0',
  `egoera` varchar(45) NOT NULL DEFAULT 'onartzeko' COMMENT '[enum:onartzeko|onartua]',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `erabiltzaileaId` (`erabiltzaileaId`,`ikastegiaId`),
  KEY `fk_Erabiltzailea_has_Ikastetxea_Ikastetxea1_idx` (`ikastegiaId`),
  KEY `fk_Erabiltzailea_has_Ikastetxea_Erabiltzailea1_idx` (`erabiltzaileaId`),
  CONSTRAINT `ErabiltzaileaRelIkastegia_ibfk_1` FOREIGN KEY (`ikastegiaId`) REFERENCES `Ikastegia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_Erabiltzailea_has_Ikastetxea_Erabiltzailea1` FOREIGN KEY (`erabiltzaileaId`) REFERENCES `Erabiltzailea` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ErabiltzaileaRelIrakaslea`
--

DROP TABLE IF EXISTS `ErabiltzaileaRelIrakaslea`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ErabiltzaileaRelIrakaslea` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `erabiltzaileaId` mediumint(8) unsigned NOT NULL,
  `irakasleaId` mediumint(8) unsigned NOT NULL,
  `egoera` varchar(45) NOT NULL DEFAULT 'onartzeko' COMMENT '[enum:onartzeko|onartua]',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `erabiltzaileaId` (`erabiltzaileaId`,`irakasleaId`),
  KEY `fk_Erabiltzailea_has_Erabiltzailea_Erabiltzailea4_idx` (`irakasleaId`),
  KEY `fk_Erabiltzailea_has_Erabiltzailea_Erabiltzailea3_idx` (`erabiltzaileaId`),
  CONSTRAINT `fk_Erabiltzailea_has_Erabiltzailea_Erabiltzailea3` FOREIGN KEY (`erabiltzaileaId`) REFERENCES `Erabiltzailea` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_Erabiltzailea_has_Erabiltzailea_Erabiltzailea4` FOREIGN KEY (`irakasleaId`) REFERENCES `Erabiltzailea` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ErabiltzaileenIrudiak`
--

DROP TABLE IF EXISTS `ErabiltzaileenIrudiak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ErabiltzaileenIrudiak` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `irudiaFileSize` int(11) unsigned NOT NULL COMMENT '[FSO]',
  `irudiaMimeType` varchar(80) NOT NULL,
  `irudiaBaseName` varchar(255) NOT NULL,
  `partekatua` tinyint(1) NOT NULL DEFAULT '0',
  `iden` varchar(350) NOT NULL COMMENT '[urlIdentifier:irudiaBaseName]',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Esteka`
--

DROP TABLE IF EXISTS `Esteka`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Esteka` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `edukiaId` mediumint(8) unsigned NOT NULL,
  `titulua` varchar(350) DEFAULT NULL,
  `url` varchar(250) NOT NULL,
  `klikKopurua` int(25) NOT NULL DEFAULT '0',
  `sortzeData` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_Esteka_Edukia1_idx` (`edukiaId`),
  CONSTRAINT `fk_Esteka_Edukia1` FOREIGN KEY (`edukiaId`) REFERENCES `Edukia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Etiketa`
--

DROP TABLE IF EXISTS `Etiketa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Etiketa` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `izena` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `EtiketaRelEdukia`
--

DROP TABLE IF EXISTS `EtiketaRelEdukia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EtiketaRelEdukia` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `etiketaId` mediumint(8) unsigned NOT NULL,
  `edukiaId` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `etiketaId` (`etiketaId`,`edukiaId`),
  KEY `fk_Etiketa_has_Edukia_Edukia1_idx` (`edukiaId`),
  KEY `fk_Etiketa_has_Edukia_Etiketa1_idx` (`etiketaId`),
  CONSTRAINT `EtiketaRelEdukia_ibfk_1` FOREIGN KEY (`edukiaId`) REFERENCES `Edukia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_Etiketa_has_Edukia_Etiketa1` FOREIGN KEY (`etiketaId`) REFERENCES `Etiketa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Fitxategia`
--

DROP TABLE IF EXISTS `Fitxategia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Fitxategia` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `edukiaId` mediumint(8) unsigned NOT NULL,
  `titulua` varchar(350) DEFAULT NULL,
  `url` varchar(250) DEFAULT NULL,
  `fitxategiaFileSize` int(11) unsigned DEFAULT NULL COMMENT '[FSO]',
  `fitxategiaMimeType` varchar(80) DEFAULT NULL,
  `fitxategiaBaseName` varchar(255) DEFAULT NULL,
  `klikKopurua` int(25) NOT NULL DEFAULT '0',
  `sortzeData` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_Fitxategia_Edukia1_idx` (`edukiaId`),
  CONSTRAINT `fk_Fitxategia_Edukia1` FOREIGN KEY (`edukiaId`) REFERENCES `Edukia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Gustokoa`
--

DROP TABLE IF EXISTS `Gustokoa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Gustokoa` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `edukiaId` mediumint(8) unsigned NOT NULL,
  `erabiltzaileaId` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `edukiaId` (`edukiaId`,`erabiltzaileaId`),
  KEY `fk_Edukia_has_Erabiltzailea_Erabiltzailea1_idx` (`erabiltzaileaId`),
  KEY `fk_Edukia_has_Erabiltzailea_Edukia1_idx` (`edukiaId`),
  CONSTRAINT `fk_Edukia_has_Erabiltzailea_Edukia1` FOREIGN KEY (`edukiaId`) REFERENCES `Edukia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_Edukia_has_Erabiltzailea_Erabiltzailea1` FOREIGN KEY (`erabiltzaileaId`) REFERENCES `Erabiltzailea` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `IkastegiGaiak`
--

DROP TABLE IF EXISTS `IkastegiGaiak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `IkastegiGaiak` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `izena` varchar(350) NOT NULL,
  `url` varchar(350) NOT NULL COMMENT '[urlIdentifier:izena]',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `IkastegiMota`
--

DROP TABLE IF EXISTS `IkastegiMota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `IkastegiMota` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `izena` varchar(250) NOT NULL,
  `url` varchar(350) NOT NULL COMMENT '[urlIdentifier:izena]',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Ikastegia`
--

DROP TABLE IF EXISTS `Ikastegia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Ikastegia` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `izena` varchar(250) NOT NULL,
  `deskribapenLaburra` varchar(250) NOT NULL,
  `deskribapena` varchar(250) DEFAULT NULL,
  `herria` varchar(250) NOT NULL,
  `probintzia` varchar(250) NOT NULL,
  `kokapena` varchar(250) NOT NULL COMMENT '[map]',
  `kokapenaLat` decimal(10,7) NOT NULL,
  `kokapenaLng` decimal(10,7) NOT NULL,
  `mota` varchar(250) NOT NULL DEFAULT 'ikastetxea' COMMENT '[enum:ikastetxea|bestelakoa]',
  `irudiaFileSize` int(11) unsigned DEFAULT NULL COMMENT '[FSO]',
  `irudiaMimeType` varchar(80) DEFAULT NULL,
  `irudiaBaseName` varchar(255) DEFAULT NULL,
  `linkedin` varchar(350) DEFAULT NULL,
  `facebook` varchar(350) DEFAULT NULL,
  `twitter` varchar(350) DEFAULT NULL,
  `google` varchar(350) DEFAULT NULL,
  `youtube` varchar(350) DEFAULT NULL,
  `instagram` varchar(350) DEFAULT NULL,
  `pinterest` varchar(350) DEFAULT NULL,
  `aktibatua` tinyint(1) NOT NULL DEFAULT '0',
  `url` varchar(250) NOT NULL COMMENT '[urlIdentifier:izena]',
  `sortzeData` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `IkastegiaRelGaiak`
--

DROP TABLE IF EXISTS `IkastegiaRelGaiak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `IkastegiaRelGaiak` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ikastegiaId` mediumint(8) unsigned NOT NULL,
  `ikastegiGaiaId` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ikastetxeaId` (`ikastegiaId`),
  KEY `ikastetxeGaiaId` (`ikastegiGaiaId`),
  CONSTRAINT `IkastegiaRelGaiak_ibfk_1` FOREIGN KEY (`ikastegiaId`) REFERENCES `Ikastegia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `IkastegiaRelGaiak_ibfk_2` FOREIGN KEY (`ikastegiGaiaId`) REFERENCES `IkastegiGaiak` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `IkastegiaRelMota`
--

DROP TABLE IF EXISTS `IkastegiaRelMota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `IkastegiaRelMota` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ikastegiaId` mediumint(8) unsigned NOT NULL,
  `ikastegiMotaId` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ikastetxeaId` (`ikastegiaId`),
  KEY `ikastetxeMotaId` (`ikastegiMotaId`),
  CONSTRAINT `IkastegiaRelMota_ibfk_1` FOREIGN KEY (`ikastegiaId`) REFERENCES `Ikastegia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `IkastegiaRelMota_ibfk_2` FOREIGN KEY (`ikastegiMotaId`) REFERENCES `IkastegiMota` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Irudia`
--

DROP TABLE IF EXISTS `Irudia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Irudia` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `edukiaId` mediumint(8) unsigned NOT NULL,
  `titulua` varchar(350) DEFAULT NULL,
  `url` varchar(250) DEFAULT NULL,
  `fitxategiaFileSize` int(11) unsigned DEFAULT NULL COMMENT '[FSO]',
  `fitxategiaMimeType` varchar(80) DEFAULT NULL,
  `fitxategiaBaseName` varchar(255) DEFAULT NULL,
  `klikKopurua` int(25) NOT NULL DEFAULT '0',
  `sortzeData` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_Irudia_Edukia1_idx` (`edukiaId`),
  CONSTRAINT `fk_Irudia_Edukia1` FOREIGN KEY (`edukiaId`) REFERENCES `Edukia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Iruzkina`
--

DROP TABLE IF EXISTS `Iruzkina`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Iruzkina` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `iruzkinaId` mediumint(8) unsigned DEFAULT NULL,
  `edukiaId` mediumint(8) unsigned NOT NULL,
  `erabiltzaileaId` mediumint(8) unsigned NOT NULL,
  `iruzkin` mediumtext NOT NULL,
  `egoera` varchar(250) NOT NULL DEFAULT 'onartzeko' COMMENT '[enum:onartzeko|onartua]',
  `sortzeData` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_Iruzkina_Erabiltzailea1_idx` (`erabiltzaileaId`),
  KEY `fk_Iruzkina_Edukia1_idx` (`edukiaId`),
  KEY `iruzkinaId` (`iruzkinaId`),
  CONSTRAINT `fk_Iruzkina_Edukia1` FOREIGN KEY (`edukiaId`) REFERENCES `Edukia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_Iruzkina_Erabiltzailea1` FOREIGN KEY (`erabiltzaileaId`) REFERENCES `Erabiltzailea` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Iruzkina_ibfk_1` FOREIGN KEY (`iruzkinaId`) REFERENCES `Iruzkina` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Jakinarazpenak`
--

DROP TABLE IF EXISTS `Jakinarazpenak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Jakinarazpenak` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `erabiltzaileaId` mediumint(8) unsigned NOT NULL,
  `idKanpotarra` mediumint(8) NOT NULL,
  `mota` varchar(250) NOT NULL COMMENT '[enum:kolaborazio eskaera|ikasle eskaera|lagun eskaera|eduki berria|iruzkin berria|mezu berria|iradokizun berria|moderazio berria|gustoko berria]',
  `egoera` varchar(250) NOT NULL DEFAULT 'ikusteko' COMMENT '[enum:ikusteko|ikusita]',
  `postazJakinarazi` tinyint(1) DEFAULT '1',
  `sortzeData` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_Jakinarazpenak_Erabiltzailea1_idx` (`erabiltzaileaId`),
  CONSTRAINT `fk_Jakinarazpenak_Erabiltzailea1` FOREIGN KEY (`erabiltzaileaId`) REFERENCES `Erabiltzailea` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Kanpaina`
--

DROP TABLE IF EXISTS `Kanpaina`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Kanpaina` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `izena` varchar(250) NOT NULL,
  `deskribapena` mediumtext NOT NULL COMMENT '[html]',
  `kodea` varchar(250) DEFAULT NULL,
  `irudiaFileSize` int(11) unsigned DEFAULT NULL COMMENT '[FSO]',
  `irudiaMimeType` varchar(80) DEFAULT NULL,
  `irudiaBaseName` varchar(255) DEFAULT NULL,
  `banerraFileSize` int(11) unsigned DEFAULT NULL COMMENT '[FSO]',
  `banerraMimeType` varchar(80) DEFAULT NULL,
  `banerraBaseName` varchar(255) DEFAULT NULL,
  `egoera` tinyint(1) NOT NULL DEFAULT '0',
  `kanpaina` tinyint(1) NOT NULL DEFAULT '0',
  `hasiera` date NOT NULL,
  `bukaera` date NOT NULL,
  `widgetEdukiak` tinyint(1) NOT NULL DEFAULT '0',
  `widgetIkastegiak` tinyint(1) NOT NULL DEFAULT '0',
  `widgetErabiltzaileak` tinyint(1) NOT NULL DEFAULT '0',
  `widgetKategoriak` tinyint(1) NOT NULL DEFAULT '0',
  `url` varchar(250) NOT NULL COMMENT '[urlIdentifier:izena]',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `KanpainaRelEdukiKategoriak`
--

DROP TABLE IF EXISTS `KanpainaRelEdukiKategoriak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `KanpainaRelEdukiKategoriak` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `kanpainaId` mediumint(8) unsigned NOT NULL,
  `kategoriaId` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kategoria` (`kanpainaId`,`kategoriaId`),
  KEY `kanpainaId` (`kanpainaId`),
  KEY `kategoriaId` (`kategoriaId`),
  CONSTRAINT `KanpainaRelEdukiKategoriak_ibfk_1` FOREIGN KEY (`kanpainaId`) REFERENCES `Kanpaina` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `KanpainaRelEdukiKategoriak_ibfk_2` FOREIGN KEY (`kategoriaId`) REFERENCES `Kategoria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `KanpainaRelIkastegiMota`
--

DROP TABLE IF EXISTS `KanpainaRelIkastegiMota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `KanpainaRelIkastegiMota` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `kanpainaId` mediumint(8) unsigned NOT NULL,
  `ikastetxeMotaId` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mota` (`kanpainaId`,`ikastetxeMotaId`),
  KEY `kanpainaId` (`kanpainaId`),
  KEY `ikastokiMotaId` (`ikastetxeMotaId`),
  CONSTRAINT `KanpainaRelIkastegiMota_ibfk_1` FOREIGN KEY (`kanpainaId`) REFERENCES `Kanpaina` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `KanpainaRelIkastegiMota_ibfk_2` FOREIGN KEY (`ikastetxeMotaId`) REFERENCES `IkastegiMota` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `KanpainaRelKategoria`
--

DROP TABLE IF EXISTS `KanpainaRelKategoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `KanpainaRelKategoria` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `kanpainaId` mediumint(8) unsigned NOT NULL,
  `kategoriaId` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kategoria` (`kanpainaId`,`kategoriaId`),
  KEY `kanpainaId` (`kanpainaId`),
  KEY `kategoriaId` (`kategoriaId`),
  CONSTRAINT `KanpainaRelKategoria_ibfk_1` FOREIGN KEY (`kanpainaId`) REFERENCES `Kanpaina` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `KanpainaRelKategoria_ibfk_2` FOREIGN KEY (`kategoriaId`) REFERENCES `Kategoria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Kategoria`
--

DROP TABLE IF EXISTS `Kategoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Kategoria` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `izena` varchar(250) NOT NULL,
  `url` varchar(250) NOT NULL COMMENT '[urlIdentifier:izena]',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `KategoriaGlobala`
--

DROP TABLE IF EXISTS `KategoriaGlobala`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `KategoriaGlobala` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `izena` varchar(350) NOT NULL,
  `url` varchar(350) NOT NULL COMMENT '[urlIdentifier:izena]',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `KategoriakRelKategoriaGlobalak`
--

DROP TABLE IF EXISTS `KategoriakRelKategoriaGlobalak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `KategoriakRelKategoriaGlobalak` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `kategoriaId` mediumint(8) unsigned NOT NULL,
  `kategoriaGlobalaId` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kategoriaBakarra` (`kategoriaId`,`kategoriaGlobalaId`),
  KEY `kategoriaId` (`kategoriaId`),
  KEY `kategoriaGlobalaId` (`kategoriaGlobalaId`),
  CONSTRAINT `KategoriakRelKategoriaGlobalak_ibfk_1` FOREIGN KEY (`kategoriaId`) REFERENCES `Kategoria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `KategoriakRelKategoriaGlobalak_ibfk_2` FOREIGN KEY (`kategoriaGlobalaId`) REFERENCES `KategoriaGlobala` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Kexa`
--

DROP TABLE IF EXISTS `Kexa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Kexa` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `erabiltzaileaId` mediumint(8) unsigned NOT NULL,
  `edukiaId` mediumint(8) unsigned NOT NULL,
  `kexa` mediumtext NOT NULL,
  `ikusita` tinyint(1) NOT NULL DEFAULT '0',
  `konponduta` tinyint(1) NOT NULL DEFAULT '0',
  `sortzeData` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `erabiltzaileaId` (`erabiltzaileaId`),
  KEY `edukiaId` (`edukiaId`),
  CONSTRAINT `Kexa_ibfk_1` FOREIGN KEY (`erabiltzaileaId`) REFERENCES `Erabiltzailea` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Kexa_ibfk_2` FOREIGN KEY (`edukiaId`) REFERENCES `Edukia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `KlearUsers`
--

DROP TABLE IF EXISTS `KlearUsers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `KlearUsers` (
  `userId` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(40) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(70) NOT NULL COMMENT '[password]',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `createdOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`userId`),
  UNIQUE KEY `userId_UNIQUE` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Lagunak`
--

DROP TABLE IF EXISTS `Lagunak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Lagunak` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `erabiltzaileaId` mediumint(8) unsigned NOT NULL,
  `erabiltzaileaId1` mediumint(8) unsigned NOT NULL,
  `egoera` varchar(250) NOT NULL COMMENT '[enum:eskaera|onartua|ukatua]',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_Erabiltzailea_has_Erabiltzailea_Erabiltzailea2_idx` (`erabiltzaileaId1`),
  KEY `fk_Erabiltzailea_has_Erabiltzailea_Erabiltzailea1_idx` (`erabiltzaileaId`),
  CONSTRAINT `fk_Erabiltzailea_has_Erabiltzailea_Erabiltzailea1` FOREIGN KEY (`erabiltzaileaId`) REFERENCES `Erabiltzailea` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_Erabiltzailea_has_Erabiltzailea_Erabiltzailea2` FOREIGN KEY (`erabiltzaileaId1`) REFERENCES `Erabiltzailea` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Laguntza`
--

DROP TABLE IF EXISTS `Laguntza`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Laguntza` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `titulua` varchar(350) NOT NULL,
  `laguntza` mediumtext NOT NULL COMMENT '[html]',
  `iden` varchar(350) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Maila`
--

DROP TABLE IF EXISTS `Maila`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Maila` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `izena` varchar(350) NOT NULL,
  `url` varchar(350) NOT NULL COMMENT '[urlIdentifier:izena]',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Mezuak`
--

DROP TABLE IF EXISTS `Mezuak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Mezuak` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `norkId` mediumint(8) unsigned NOT NULL,
  `noriId` mediumint(8) unsigned NOT NULL,
  `mezua` mediumtext NOT NULL,
  `mota` varchar(250) NOT NULL COMMENT '[enum:iradokizuna|mezua|moderazioa]',
  `ikusita` varchar(250) NOT NULL DEFAULT '0' COMMENT '[enum:0|1]',
  `sortzeData` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_Mezuak_Erabiltzailea1_idx` (`norkId`),
  KEY `fk_Mezuak_Erabiltzailea2_idx` (`noriId`),
  CONSTRAINT `fk_Mezuak_Erabiltzailea1` FOREIGN KEY (`norkId`) REFERENCES `Erabiltzailea` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_Mezuak_Erabiltzailea2` FOREIGN KEY (`noriId`) REFERENCES `Erabiltzailea` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Notifikazioa`
--

DROP TABLE IF EXISTS `Notifikazioa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Notifikazioa` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `titulua` varchar(350) NOT NULL,
  `edukiaHtml` mediumtext NOT NULL COMMENT '[html]',
  `edukiaText` mediumtext NOT NULL,
  `identifikatzailea` varchar(350) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Orrialdea`
--

DROP TABLE IF EXISTS `Orrialdea`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Orrialdea` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `titulua` varchar(250) NOT NULL,
  `edukia` text NOT NULL COMMENT '[html]',
  `publikatua` varchar(45) NOT NULL DEFAULT '0' COMMENT '[enum:0|1]',
  `url` varchar(250) NOT NULL COMMENT '[urlIdentifier:titulua]',
  `sortzeData` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity]';
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
