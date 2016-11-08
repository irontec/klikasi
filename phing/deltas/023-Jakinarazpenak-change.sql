CREATE TABLE JakinarazpenakMota (
    `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
    `izena` varchar(250) NOT NULL,
    `url` varchar(250) NOT NULL COMMENT '[urlIdentifier:izena]',
    PRIMARY KEY (`id`),
    UNIQUE KEY `id_UNIQUE` (`id`)
)  ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COMMENT='[entity]';

TRUNCATE TABLE Jakinarazpenak;
TRUNCATE TABLE JakinarazpenakGroup;

ALTER TABLE Jakinarazpenak DROP `mota`;

ALTER TABLE Jakinarazpenak ADD (
    `motaId` mediumint(8) unsigned NOT NULL,
     KEY `Jakinarazpenak_motaId` (`motaId`),
     CONSTRAINT `Jakinarazpenak_motaId` FOREIGN KEY (`motaId`) REFERENCES `JakinarazpenakMota` (`id`)
);