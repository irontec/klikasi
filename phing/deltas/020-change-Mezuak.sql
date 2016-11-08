ALTER TABLE Mezuak CHANGE `mota` `mota` varchar(250) NOT NULL COMMENT '[enum:iradokizuna|mezua|moderazioa|edukia]';
ALTER TABLE Mezuak ADD `edukiaId` mediumint(8) NOT NULL DEFAULT 0;
