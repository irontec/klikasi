truncate table JakinarazpenakGroup;

ALTER TABLE JakinarazpenakGroup ADD (
    KEY `JakinarazpenakGroup_jakinarazpenakId` (`jakinarazpenakId`),
    CONSTRAINT `JakinarazpenakGroup_jakinarazpenakId` FOREIGN KEY (`jakinarazpenakId`) REFERENCES `Jakinarazpenak` (`id`)
);