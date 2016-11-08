CREATE TABLE `NewsletterHash` (
    `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
    `newsletterId` mediumint(8) unsigned DEFAULT NULL,
    `erabiltzaileaId` mediumint(8) unsigned DEFAULT NULL,
    `hash` text,
    PRIMARY KEY (`id`),
    UNIQUE KEY `id_UNIQUE` (`id`),
    KEY `newsletterId` (`newsletterId`),
    KEY `erabiltzaileaId` (`erabiltzaileaId`),
    CONSTRAINT `NewsletterHash_newsletterId` FOREIGN KEY (`newsletterId`) REFERENCES `Newsletter` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
    CONSTRAINT `NewsletterHash_erabiltzaileaId` FOREIGN KEY (`erabiltzaileaId`) REFERENCES `Erabiltzailea` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COMMENT='[entity]';