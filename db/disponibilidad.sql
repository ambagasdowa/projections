-- if you wont a separate db uncomment this line below
-- grant usage on disponibilidad.* to disponibilidad@localhost identified by '@disponibilidad#';
-- grant select, insert, update, delete, drop, alter, create temporary tables on disponibilidad.* to disponibilidad@localhost;
-- flush privileges;

drop table if exists `disponibilidad`;
create table `disponibilidad`(
  `id_disponibilidad` int(11) unsigned not null AUTO_INCREMENT,
  `id_empresa` int(11) unsigned not null,
  `id_area` int(11) unsigned not null,
  `id_flota` int(11) unsigned not null,
  `current_work_day` int(4) unsigned not null,
  `total_current_working_days` int(4) unsigned not null,
  `set_date` date null,
  `current_date_time` timestamp DEFAULT current_timestamp,
-- this data comes from sql query too
  `tipo_disponibilidad` varchar(10) null,
  `total_units` int(11) unsigned not null,
  `asigned_personal` int(11) unsigned null,
  `unit_disp` int(11) unsigned null,
  `unit_transit` int(11) unsigned null,
  `unit_maintenance` int(11) unsigned null,
  `unit_accidented` int(11) unsigned null,
  `unit_loaded` int(11) unsigned null,
  `unit_unloaded` int(11) unsigned null,
  `unit_out_service` int(11) unsigned null,
-- this data comes from sql query too
  `unit_loaded_stanby` int(11) unsigned null,
  `unit_without_operator` int(11) unsigned null,
  `unit_stopped` int(11) unsigned null,
  `unit_trips_ha` int(11) unsigned null,
  `unit_productivity_ha` int(11) unsigned null,
  `tons_program` int(11) unsigned null,
  `tons_real` decimal(18,6) null,
  `performance` float(4) null,
  `accomplishment` float(4) null,
--   `area` varchar(50) not null,
  `year` year not null,
  `month` varchar(50) null,
  `day` char(2) null,
-- extraIngo
  `area` varchar(100) null,
  `mes` char(10) null,
--   `numMes` int(2) null,
--   `counting` decimal(18,6) not null,
-- tipoOperacion //4 that is counting Trips
--   `tipoOperacion` int(1) unsigned not null,
--   `id_fraction` int(10) null,
--   `fraccion` varchar(55) null,
  `status` enum('Active','Inactive') NOT NULL default 'Active',
  PRIMARY KEY (`id_disponibilidad`)
)ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;