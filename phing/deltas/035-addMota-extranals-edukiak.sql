ALTER TABLE Bideoa ADD `mota` varchar(25) NOT NULL DEFAULT 'youtube' COMMENT '[enum:youtube|vimeo]';
ALTER TABLE Aurkezpena ADD `mota` varchar(250) NOT NULL DEFAULT 'slideshare' COMMENT '[enum:slideshare]';
ALTER TABLE Esteka ADD `mota` varchar(250) NOT NULL DEFAULT 'link' COMMENT '[enum:link|audio]';
ALTER TABLE Irudia ADD`mota` varchar(250) NOT NULL DEFAULT 'flickr' COMMENT '[enum:flickr|pinterest]';
ALTER TABLE Fitxategia ADD `mota` varchar(250) NOT NULL DEFAULT 'bestelakoak' COMMENT '[enum:mega|bestelakoak]';
ALTER TABLE Fitxategia ADD `downloadMota` varchar(250) NOT NULL DEFAULT 'audio' COMMENT '[enum:audio|video|text|calc]';
