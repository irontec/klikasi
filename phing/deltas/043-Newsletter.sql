CREATE TABLE `Newsletter` (
    `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
    `title` varchar(255) NOT NULL,
    `content` text,
    `active` tinyint(1) NOT NULL DEFAULT '0',
    `send` tinyint(1) NOT NULL DEFAULT '0',
    `shippingDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `dateToSend` timestamp NOT NULL,
    `sent` mediumint(8) NOT NULL DEFAULT '0',
    `readBy` mediumint(8) NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COMMENT='[entity]';
