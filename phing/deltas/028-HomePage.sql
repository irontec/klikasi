CREATE TABLE `HomePage` (
    `id`  mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
    `identifier` varchar(250) NOT NULL,
    `title` varchar(250) NOT NULL,
    `description` text,
    `irudia` varchar(80) COMMENT '[FILE]',
    PRIMARY KEY (`id`),
    UNIQUE KEY `id` (`id`),
    UNIQUE KEY `identifier` (`identifier`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COMMENT='[entity]';
