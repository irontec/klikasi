TRUNCATE Jakinarazpenak;
ALTER TABLE Jakinarazpenak ADD (
    `thatUserId` mediumint(8) unsigned NOT NULL,
    KEY `Jakinarazpenak_thatUserId` (`thatUserId`),
    CONSTRAINT `Jakinarazpenak_thatUserId` FOREIGN KEY (`thatUserId`) REFERENCES `Erabiltzailea` (`id`)
);
