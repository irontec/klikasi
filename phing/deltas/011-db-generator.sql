ALTER TABLE `KategoriaGlobala` ADD `irudiaBaseName` VARCHAR(255) COMMENT '' AFTER `irudia`;
ALTER TABLE `KategoriaGlobala` ADD `irudiaMimeType` VARCHAR(80) COMMENT '' AFTER `irudia`;
ALTER TABLE `KategoriaGlobala` ADD `irudiaFileSize` INT(11) UNSIGNED COMMENT '[FSO]' AFTER `irudia`;
ALTER TABLE `KategoriaGlobala` DROP irudia;
