alter table Jakinarazpenak drop FOREIGN KEY `Jakinarazpenak_thatUserId`;
ALTER TABLE Jakinarazpenak add CONSTRAINT `Jakinarazpenak_thatUserId` FOREIGN KEY (`thatUserId`) REFERENCES `Erabiltzailea` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
