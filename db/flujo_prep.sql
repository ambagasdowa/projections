-- Host: localhost    Database: flujo_prep
-- ------------------------------------------------------
-- Server version	5.5.24-5

-- install the database after db creation
-- set level and user privileges
grant usage on flujo_prep.* to flujo_prep@localhost identified by '@flujo_prep#';
grant select, insert, update, delete, drop, alter, create temporary tables on flujo_prep.* to flujo_prep@localhost;
flush privileges;

--
-- Table structure for table `ingresos`
--

drop table if exists `ingresos`;
create table `ingresos`(
  `id_ingresos` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `concreto` varchar(150) NULL,
  `cemento` varchar(150) NULL,
  `otros` varchar(150) NULL,
  `traspaso` varchar(150) NULL,
  `week` int(2) NULL,
  `fecha` timestamp DEFAULT now(),
  `status` enum('Active','Inactive') NOT NULL default 'Active',
  PRIMARY KEY (`id_ingresos`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- /////////////////////////////////////////////////////////////////////////////////////////
-- Start the fetch of external data
-- /////////////////////////////////////////////////////////////////////////////////////////

drop table if exists `egresos`;
create table `egresos`(
  `id_egresos` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `catorcenal` varchar(150) NULL,
  `confidencial` varchar(150) NULL,
  `administrativa` varchar(150) NULL,
  `telmex` varchar(150) NULL,
  `cfe` varchar(150) NULL,
  `pemex` varchar(150) NULL,
  `peajes` varchar(150) NULL,
  `enlonadas` varchar(150) NULL,
  `seguros` varchar(150) NULL,
  `manufactura` varchar(150) NULL,
  `manpower` varchar(150) NULL,
  `week` int(2) NULL,
  `fecha` timestamp DEFAULT current_timestamp,
  `status`	boolean	 not null DEFAULT true,
  PRIMARY KEY (`id_egresos`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

drop table if exists `impuestos`;
create table `impuestos`(
  `id_impuestos` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `imss` varchar(150) NULL,
  `iss` varchar(150) NULL,
  `estatal` varchar(150) NULL,
  `istp` varchar(150) NULL,
  `ietu` varchar(150) NULL,
  `otros` varchar(150) NULL,
  `iva` varchar(150) NULL,
  `provisiones` varchar(150) NULL,
  `week` int(2) NULL,
  `fecha` timestamp DEFAULT current_timestamp,
  `status`	boolean	 not null DEFAULT true,
  PRIMARY KEY (`id_impuestos`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

drop table if exists `saldo`;
create table `saldo`(
  `id_saldo` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `inicial` varchar(150) NULL,
  `disponible` varchar(150) NULL,
  `efectivo` varchar(150) NULL,
  `week` int(2) NULL,
  `fecha` timestamp DEFAULT current_timestamp,
  `status`	boolean	 not null DEFAULT true,
  PRIMARY KEY (`id_saldo`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


-- drop table if exists `trafico_guia`;
-- create table `trafico_guia` (
-- 
--  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
-- ) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

--   sql.sql =>select * from Information_Schema.Columns where TABLE_NAME = 'trafico_guia';
--   isql -v odbc-bonampakdb zam lis -bt  < /tmp/tabla.sql > /tmp/desc_tabla.sql;
--   sed -e '1,3d' -e "s/|/\t/g" -e "s/^/null/g" -e '$d' /tmp/desc_tabla.sql > /tmp/tabla.csv
--   open csv in excel extract the tables an paste in txt file
--   clean and pass trhought
--    sed -e 's/ //g' -e 's/^/`/g' -e 's/$/` varchar(255) NOT NULL,/g' -e 's/^/ /g' test >fiw.sql

