alter table ErabiltzaileenIrudiak add `irudia` varchar(100) default '' comment '[FSO]' after `id`;
alter table ErabiltzaileenIrudiak change `irudiaFileSize` `irudiaFileSize` int(11) unsigned NOT NULL COMMENT '';
