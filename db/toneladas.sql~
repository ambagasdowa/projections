
drop table if exists `operacion`;
create table `operacion`(
  `id_operacion` int(11) unsigned not null AUTO_INCREMENT,
  `id_empresa` int(4) not null,
  `area` varchar(50) not null,
  `year` year not null,
  `numMes` int(2) not null,
  `month` varchar(5) not null,
  `day` int(2) not null,
  `operacion` decimal(18,6) not null,
  `tipoOperacion` int(1) not null,
  `id_fraction` int(10) not null,
  `fraccion` varchar(55) not null,
  `status` enum('Active','Inactive') NOT NULL default 'Active',
  PRIMARY KEY (`id_operacion`)
)ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

drop table if exists `operacionMensual`;
create table `operacionMensual`(
  `id_operacionMensual` int(11) unsigned not null AUTO_INCREMENT,
  `id_empresa` int(4) not null,
  `area` varchar(50) not null,
  `year` year not null,
  `numMes` int(2) not null,
  `month` varchar(5) not null,
--   `day` int(2) not null,
  `operacion` decimal(18,6) not null,
  `tipoOperacion` int(1) not null,
  `id_fraction` int(10) not null,
  `fraccion` varchar(55) not null,
  `status` enum('Active','Inactive') NOT NULL default 'Active',
  PRIMARY KEY (`id_operacionMensual`)
)ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- drop table if exists `operacionAnual`;
-- create table `operacionAnual`(
--   `id_operacionAnual` int(11) unsigned not null AUTO_INCREMENT,
--   `id_empresa` int(4) not null,
--   `area` varchar(50) not null,
--   `year` year not null,
-- --   `numMes` int(2) not null,
-- --   `month` varchar(5) not null,
-- --   `day` int(2) not null,
--   `operacion` decimal(18,6) not null,
--   `tipoOperacion` int(1) not null,
--   `id_fraction` int(10) not null,
--   `fraccion` varchar(55) not null,
--   `status` enum('Active','Inactive') NOT NULL default 'Active',
--   PRIMARY KEY (`id_operacionAnual`)
-- )ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
