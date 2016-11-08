CREATE TABLE `Hobekuntzak` (
    `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
    `erabiltzaileaId` mediumint(8) unsigned NOT NULL,
    `edukiaId` mediumint(8) unsigned NOT NULL,
    `hobekuntzak` text NOT NULL,
    `sortzeData` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `erabiltzaileaId` (`erabiltzaileaId`),
  KEY `edukiaId` (`edukiaId`),
  CONSTRAINT `Hobekuntzak_erabiltzaileaId` FOREIGN KEY (`erabiltzaileaId`) REFERENCES `Erabiltzailea` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Hobekuntzak_edukiaId` FOREIGN KEY (`edukiaId`) REFERENCES `Edukia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity]';