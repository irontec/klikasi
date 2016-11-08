TRUNCATE TABLE ErabiltzaileaRelIrakaslea;
ALTER TABLE ErabiltzaileaRelIrakaslea ADD (
    `ikastegiaId` mediumint(8) unsigned NOT NULL,
     KEY `ErabiltzaileaRelIrakaslea_ikastegiaId` (`ikastegiaId`),
     CONSTRAINT `ErabiltzaileaRelIrakaslea_ikastegiaId` FOREIGN KEY (`ikastegiaId`) REFERENCES `Ikastegia` (`id`)
);
