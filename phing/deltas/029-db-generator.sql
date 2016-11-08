ALTER TABLE `HomePage` ADD `irudiaBaseName` VARCHAR(255) COMMENT '' AFTER `irudia`;
ALTER TABLE `HomePage` ADD `irudiaMimeType` VARCHAR(80) COMMENT '' AFTER `irudia`;
ALTER TABLE `HomePage` ADD `irudiaFileSize` INT(11) UNSIGNED COMMENT '[FSO]' AFTER `irudia`;
ALTER TABLE `HomePage` DROP irudia;
