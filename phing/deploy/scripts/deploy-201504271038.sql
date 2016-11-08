-- Fragment begins: 55 --
INSERT INTO changelog
                                (change_number, delta_set, start_dt, applied_by, description) VALUES (55, 'Main', NOW(), 'dbdeploy', '055-Irudiak.sql');
alter table Irudia modify `url` varchar(750) DEFAULT NULL;


UPDATE changelog
	                         SET complete_dt = NOW()
	                         WHERE change_number = 55
	                         AND delta_set = 'Main';
-- Fragment ends: 55 --
-- Fragment begins: 56 --
INSERT INTO changelog
                                (change_number, delta_set, start_dt, applied_by, description) VALUES (56, 'Main', NOW(), 'dbdeploy', '056-urllength.sql');
alter table Fitxategia modify  `url` varchar(750) DEFAULT NULL;
alter table Esteka modify  `url` varchar(750) DEFAULT NULL;
alter table Bideoa modify  `url` varchar(750) DEFAULT NULL;
alter table Aurkezpena modify  `url` varchar(750) DEFAULT NULL;

UPDATE changelog
	                         SET complete_dt = NOW()
	                         WHERE change_number = 56
	                         AND delta_set = 'Main';
-- Fragment ends: 56 --
-- Fragment begins: 57 --
INSERT INTO changelog
                                (change_number, delta_set, start_dt, applied_by, description) VALUES (57, 'Main', NOW(), 'dbdeploy', '057-Add-metas-to-Orrialdea.sql');
ALTER TABLE `Orrialdea` ADD `metaTitle` varchar(255) DEFAULT NULL;
ALTER TABLE `Orrialdea` ADD `metaDescription` varchar(500) DEFAULT NULL;
ALTER TABLE `Orrialdea` ADD `metaKeywords` varchar(255) DEFAULT NULL;

UPDATE changelog
	                         SET complete_dt = NOW()
	                         WHERE change_number = 57
	                         AND delta_set = 'Main';
-- Fragment ends: 57 --
-- Fragment begins: 58 --
INSERT INTO changelog
                                (change_number, delta_set, start_dt, applied_by, description) VALUES (58, 'Main', NOW(), 'dbdeploy', '058-add-img-orrialdea.sql');
ALTER TABLE `Orrialdea` ADD `img` varchar(25) COMMENT '[file]';

UPDATE changelog
	                         SET complete_dt = NOW()
	                         WHERE change_number = 58
	                         AND delta_set = 'Main';
-- Fragment ends: 58 --
-- Fragment begins: 59 --
INSERT INTO changelog
                                (change_number, delta_set, start_dt, applied_by, description) VALUES (59, 'Main', NOW(), 'dbdeploy', '059-db-generator.sql');
ALTER TABLE `Orrialdea` ADD `imgBaseName` VARCHAR(255) COMMENT '' AFTER `img`;
ALTER TABLE `Orrialdea` ADD `imgMimeType` VARCHAR(80) COMMENT '' AFTER `img`;
ALTER TABLE `Orrialdea` ADD `imgFileSize` INT(11) UNSIGNED COMMENT '[FSO]' AFTER `img`;
ALTER TABLE `Orrialdea` DROP img;

UPDATE changelog
	                         SET complete_dt = NOW()
	                         WHERE change_number = 59
	                         AND delta_set = 'Main';
-- Fragment ends: 59 --
