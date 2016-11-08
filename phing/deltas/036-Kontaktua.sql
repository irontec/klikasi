CREATE TABLE `Kontaktua` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `izena` varchar(140) NOT NULL,
  `posta` varchar(140) NOT NULL,
  `gaia` varchar(140) NOT NULL,
  `mezua` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity]';
