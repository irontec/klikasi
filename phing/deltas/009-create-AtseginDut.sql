CREATE TABLE `AtseginDut` (
    `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
    `edukiaId` mediumint(8) unsigned NOT NULL,
    `erabiltzaileaId` mediumint(8) unsigned NOT NULL,
    PRIMARY KEY (`id`),
    KEY `AtseginDut_edukiaId` (`edukiaId`),
    KEY `AtseginDut_erabiltzaileaId` (`erabiltzaileaId`),
    CONSTRAINT `AtseginDut_edukiaId` FOREIGN KEY (`edukiaId`) REFERENCES `Edukia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `AtseginDut_erabiltzaileaId` FOREIGN KEY (`erabiltzaileaId`) REFERENCES `Erabiltzailea` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
