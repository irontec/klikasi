ALTER TABLE `Orrialdea` ADD `imgBaseName` VARCHAR(255) COMMENT '' AFTER `img`;
ALTER TABLE `Orrialdea` ADD `imgMimeType` VARCHAR(80) COMMENT '' AFTER `img`;
ALTER TABLE `Orrialdea` ADD `imgFileSize` INT(11) UNSIGNED COMMENT '[FSO]' AFTER `img`;
ALTER TABLE `Orrialdea` DROP img;
