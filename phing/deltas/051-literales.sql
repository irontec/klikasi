CREATE TABLE `Literales` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `identificativo` varchar(255) DEFAULT NULL,
  `literaleu` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `identificativo` (`identificativo`)
) ENGINE=InnoDB AUTO_INCREMENT=418 DEFAULT CHARSET=utf8 COMMENT='[entity]';
