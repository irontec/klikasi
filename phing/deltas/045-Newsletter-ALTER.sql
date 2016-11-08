ALTER TABLE `Newsletter` ADD `isEdukia` tinyint(1) NOT NULL DEFAULT '0';
ALTER TABLE `Newsletter` ADD `isIkastegia` tinyint(1) NOT NULL DEFAULT '0';

ALTER TABLE `Newsletter` ADD `edukiakSent` varchar(255) DEFAULT NULL;
ALTER TABLE `Newsletter` ADD `ikastegiakSent` varchar(255) DEFAULT NULL;