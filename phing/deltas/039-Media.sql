alter table Bideoa change `url` `url` text NOT NULL;
alter table Aurkezpena change `url` `url` text NOT NULL;
alter table Aurkezpena change `mota` `mota` varchar(250) NOT NULL DEFAULT 'slideshare' COMMENT '[enum:slideshare|issuu]';

