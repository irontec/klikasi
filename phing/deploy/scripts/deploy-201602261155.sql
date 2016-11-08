-- Fragment begins: 60 --
INSERT INTO changelog
                                (change_number, delta_set, start_dt, applied_by, description) VALUES (60, 'Main', NOW(), 'dbdeploy', '060-Rest-comments.sql');
ALTER TABLE `Edukia` COMMENT = "[entity][rest]";
ALTER TABLE `Etiketa` COMMENT = "[entity][rest]";
ALTER TABLE `Ikastegia` COMMENT = "[entity][rest]";
ALTER TABLE `KategoriaGlobala` COMMENT = "[entity][rest]";
ALTER TABLE `Kategoria` COMMENT = "[entity][rest]";

UPDATE changelog
	                         SET complete_dt = NOW()
	                         WHERE change_number = 60
	                         AND delta_set = 'Main';
-- Fragment ends: 60 --
-- Fragment begins: 61 --
INSERT INTO changelog
                                (change_number, delta_set, start_dt, applied_by, description) VALUES (61, 'Main', NOW(), 'dbdeploy', '061-EtagVersions.sql');
CREATE TABLE `EtagVersions` (
    `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
    `table` varchar(55) DEFAULT NULL,
    `etag` varchar(255),
    `lastChange` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

UPDATE changelog
	                         SET complete_dt = NOW()
	                         WHERE change_number = 61
	                         AND delta_set = 'Main';
-- Fragment ends: 61 --
