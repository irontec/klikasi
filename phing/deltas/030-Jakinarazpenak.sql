alter table Jakinarazpenak add column `deletedBySender` tinyint(1) DEFAULT '0';
alter table Jakinarazpenak add column `deletedByErabiltzailea` tinyint(1) DEFAULT '0';
alter table Jakinarazpenak change `egoera` `ikusita` tinyint(1) not null default '0';
alter table Jakinarazpenak add column `egoera` varchar(250) NOT NULL DEFAULT 'onartzeko' COMMENT '[enum:onartzeko|onartua|ezOnartua]';

Alter table `ErabiltzaileaRelEdukia` change `egoera` `egoera` varchar(250) NOT NULL DEFAULT 'baieztatua' COMMENT '[enum:onartzeko|onartua|ezOnartua]';
Update `ErabiltzaileaRelEdukia` set egoera = 'onartzeko' where egoera = 'baieztatzeko';
Update `ErabiltzaileaRelEdukia` set egoera = 'onartzeko' where egoera = 'baieztatua';
ALTER TABLE `ErabiltzaileaRelIrakaslea` change `egoera` `egoera` varchar(45) NOT NULL DEFAULT 'onartzeko' COMMENT '[enum:onartzeko|onartua|ezOnartua]';

