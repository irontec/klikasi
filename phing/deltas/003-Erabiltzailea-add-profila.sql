ALTER TABLE Erabiltzailea ADD `profila` varchar(250) NOT NULL DEFAULT 'otros' COMMENT '[enum:irakasle|otros|ikasle]' AFTER `superErabiltzailea`;
