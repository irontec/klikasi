alter table IkastegiMota add `default` tinyint(1) not null default 0;
insert into IkastegiMota values (null, 'Ikastegia', 'ikastegia', 1);

alter table Kanpaina add `widgetEdukiakOrdena` varchar(25) default 'data' comment '[enum:data|karma]' after `widgetEdukiak`;
alter table Kanpaina add `widgetIkastegiakOrdena` varchar(25) default 'karma' comment '[enum:edukiKopurua|data|karma|erabiltzaileKopurua]' after `widgetIkastegiak`;
alter table Kanpaina add `widgetErabiltzaileakOrdena` varchar(25) default 'karma' comment '[enum:edukiKopurua|data|karma]' after `widgetErabiltzaileak`;
alter table Kanpaina add `widgetKategoriakOrdena` varchar(25) default 'karma' comment '[enum:edukiKopurua|data|karma]' after `widgetKategoriak`;

alter table Ikastegia add `ikasleKopurua` int not null default 0;
alter table Erabiltzailea add `karma` int(11) NOT NULL DEFAULT '0';
