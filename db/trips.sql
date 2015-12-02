drop table if exists `tripcount`;
create table `tripcount`(
  `id_tripcount` int(11) unsigned not null AUTO_INCREMENT,
  `id_empresa` int(11) unsigned not null,
  `id_area` int(11) unsigned not null,
  `area` varchar(50) not null,
  `year` year not null,
  `numMes` int(2) null,
  `month` varchar(5) null,
  `day` char(2) null,
  `counting` decimal(18,6) not null,
-- tipoOperacion //4 that is counting Trips
  `tipoOperacion` int(1) unsigned not null,
  `id_fraction` int(10) null,
  `fraccion` varchar(55) null,
  `status` enum('Active','Inactive') NOT NULL default 'Active',
  PRIMARY KEY (`id_tripcount`)
)ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;