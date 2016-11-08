CREATE TABLE `ErabiltzaileaSettings` (
    `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
    `erabiltzaileaId` mediumint(8) unsigned NOT NULL,
    `moderazioBerria` tinyint(1) DEFAULT '0',
    `ikastegiakBerria` tinyint(1) DEFAULT '0',
    `ikasleEskaera` tinyint(1) DEFAULT '0',
    `kolaborazioEskaera` tinyint(1) DEFAULT '0',
    `edukiBerria` tinyint(1) DEFAULT '0',
    `iruzkinBerria` tinyint(1) DEFAULT '0',
    `iradokizunBerria` tinyint(1) DEFAULT '0',
    `gustokoBerria` tinyint(1) DEFAULT '0',
    `atseginDut` tinyint(1) DEFAULT '0',
    `edukiariSalaketa` tinyint(1) DEFAULT '0',
    PRIMARY KEY (`id`),
    KEY `ErabiltzaileaSettings_erabiltzaileaId` (`erabiltzaileaId`),
    CONSTRAINT `ErabiltzaileaSettings_erabiltzaileaId` FOREIGN KEY (`erabiltzaileaId`) REFERENCES `Erabiltzailea` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COMMENT='[entity]';
