CREATE TABLE `JakinarazpenakGroup` (
    `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
    `jakinarazpenakId` mediumint(8) unsigned NOT NULL,
    `erabiltzaileaId` mediumint(8) unsigned NOT NULL,
    `sortzeData` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `id_UNIQUE` (`id`),
    KEY `JakinarazpenakGroup_erabiltzaileaId` (`erabiltzaileaId`),
    CONSTRAINT `JakinarazpenakGroup_erabiltzaileaId` FOREIGN KEY (`erabiltzaileaId`) REFERENCES `Erabiltzailea` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COMMENT='[entity]';


CREATE TABLE `EmailHistory` (
    `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
    `erabiltzaileaId` mediumint(8) unsigned NOT NULL,
    `type` varchar(250) NOT NULL COMMENT '[enum:jakinarazpenak|izena-eman|pasahitza-berreskuratu]',
    `sortzeData` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `id` (`id`),
    KEY `EmailHistory_erabiltzaileaId` (`erabiltzaileaId`),
    CONSTRAINT `EmailHistory_erabiltzaileaId` FOREIGN KEY (`erabiltzaileaId`) REFERENCES `Erabiltzailea` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COMMENT='[entity]';
