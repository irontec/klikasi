CREATE TABLE `EtagVersions` (
    `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
    `table` varchar(55) DEFAULT NULL,
    `etag` varchar(255),
    `lastChange` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
