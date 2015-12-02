-- Host: localhost    Database: flujo
-- ------------------------------------------------------
-- Server version	5.5.24-5

-- install the database after db creation
-- set level and user privileges
grant usage on flujo.* to flujo@localhost identified by '@flujo#';
grant select, insert, update, delete, drop, alter, create temporary tables on flujo.* to flujo@localhost;
flush privileges;


-- /////////////////////////////////////////////////////////////////////////////////////////
-- Start the fetch of external data
-- /////////////////////////////////////////////////////////////////////////////////////////


drop table if exists `saldo`;
create table `saldo`(
  `id_saldo` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_kingdoms` int(11) not null,
  `real` varchar(150) null,
  `presupuesto` varchar(150) null,
  `inicial` varchar(150) NULL,
  `disponible` varchar(150) NULL,
  `efectivo` varchar(150) NULL,
  `year` year NULL,
  `month` int(2) null,
  `week` int(3) NULL,
  `fdatetime` timestamp DEFAULT current_timestamp,
  `fecha` date NOT NULL ,
  `status` enum('Active','Inactive') NOT NULL default 'Active',
  PRIMARY KEY (`id_saldo`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `saldo`
--

LOCK TABLES `saldo` WRITE;
/*!40000 ALTER TABLE `saldo` DISABLE KEYS */;
INSERT INTO `saldo` VALUES (1,2,'12000','1290',NULL,NULL,NULL,2014,7,31,'2014-09-12 22:51:08','0000-00-00','Active'),(2,2,'1200','12000',NULL,NULL,NULL,2014,8,31,'2014-09-12 22:52:35','0000-00-00','Active'),(3,2,'12000','1234',NULL,NULL,NULL,2014,7,30,'2014-09-15 15:21:33','0000-00-00','Active'),(4,2,'1300','1400',NULL,NULL,NULL,2014,7,29,'2014-09-15 15:31:42','0000-00-00','Active'),(5,2,'13000','4200',NULL,NULL,NULL,2014,7,27,'2014-09-17 14:43:24','0000-00-00','Active'),(6,2,'1200','6000',NULL,NULL,NULL,2014,7,28,'2014-09-17 14:43:57','0000-00-00','Active'),(7,2,'12000','12600',NULL,NULL,NULL,2014,8,32,'2014-09-17 15:36:49','0000-00-00','Active'),(8,2,NULL,'24000',NULL,NULL,NULL,2014,6,27,'2014-09-18 21:21:17','0000-00-00','Active'),(9,2,NULL,'15000',NULL,NULL,NULL,2015,2,8,'2014-09-19 14:41:33','0000-00-00','Active'),(10,2,NULL,'13400',NULL,NULL,NULL,2014,5,18,'2014-09-19 15:38:42','0000-00-00','Active'),(11,2,NULL,'12000',NULL,NULL,NULL,2014,4,15,'2014-09-19 15:59:05','0000-00-00','Active');
/*!40000 ALTER TABLE `saldo` ENABLE KEYS */;
UNLOCK TABLES;


-- #########################################################################

drop table if exists `kingdoms`;
create table `kingdoms`(
  `id_kingdoms` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `kingdom` text NULL,
  `fdatetime` timestamp DEFAULT current_timestamp,
  `status` enum('Active','Inactive') NOT NULL default 'Active',
  PRIMARY KEY (`id_kingdoms`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


drop table if exists `realms`;
create table `realms`(
  `id_realms` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `realm` text NULL,
  `fdatetime` timestamp DEFAULT current_timestamp,
  `status` enum('Active','Inactive') NOT NULL default 'Active',
  PRIMARY KEY (`id_realms`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

LOCK TABLES `realms` WRITE;
/*!40000 ALTER TABLE `realms` DISABLE KEYS */;
INSERT INTO `realms` VALUES 
(1,'Ingresos','2014-07-18 16:49:33','Active'),
(2,'Egresos','2014-07-18 16:49:58','Active');
/*!40000 ALTER TABLE `realms` ENABLE KEYS */;
UNLOCK TABLES;

drop table if exists `realms_class`;
create table `realms_class`(
  `prefix` varchar(3) not null DEFAULT 'div',
  `id_realms_class` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_realms` int(11) null,
  `realms_class` text NULL,
  `fdatetime` timestamp DEFAULT current_timestamp,
  `status` enum('Active','Inactive') NOT NULL default 'Active',
  PRIMARY KEY (`id_realms_class`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `realms_class`
--

LOCK TABLES `realms_class` WRITE;
/*!40000 ALTER TABLE `realms_class` DISABLE KEYS */;
INSERT INTO `realms_class` VALUES 
('div',1,1,'Ingresos','2014-07-18 22:38:09','Active'),
('div',2,2,'Gastos Normales de Operacion','2014-07-18 22:38:46','Active'),
('div',3,2,'Impuestos','2014-07-18 22:39:01','Active'),
('div',4,2,'Reembolso de fondo Fijo de Caja','2014-07-18 22:39:52','Active'),
('div',5,2,'Pago a Proveedores Almacen (Anexo A)','2014-07-18 22:40:55','Active'),
('div',6,2,'Otros Gastos (Anexo E)','2014-07-18 22:41:13','Active'),
('div',7,2,'Inversiones de Activo Fijo (Anexo F)','2014-07-18 22:41:31','Active'),
('div',8,2,'Pago de Prestámos','2014-09-19 14:19:08','Active');
/*!40000 ALTER TABLE `realms_class` ENABLE KEYS */;
UNLOCK TABLES;


drop table if exists `accounts`;
create table `accounts`(
  `id_accounts` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_realms_class` int(10) null,
  `account` varchar(255) null,
  `description` text NOT NULL,
  `year` year NULL,
  `fdatetime` timestamp DEFAULT current_timestamp,
  `fecha` date NOT NULL,
  `status` enum('Active','Inactive') NOT NULL default 'Active',
  PRIMARY KEY (`id_accounts`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
INSERT INTO `accounts` VALUES 
(1,1,'Cobranza Concretos Apasco S.A.','',2014,'2014-07-19 03:47:05','2014-07-18','Active'),
(2,1,'Cobranza Cementos Apasco S.A.','',2014,'2014-07-19 03:48:37','2014-07-18','Active'),
(3,1,'Cobranza Otros Clientes','',2014,'2014-07-19 03:48:56','2014-07-18','Active'),
(4,1,'Otros Ingresos / Traspasos','',2014,'2014-07-19 03:49:21','2014-07-18','Active'),
(5,2,'Nomina Catorcenal','',2014,'2014-07-19 03:52:15','2014-07-18','Active'),
(6,2,'Nomina Confidencial','',2014,'2014-07-19 03:57:50','2014-07-18','Active'),
(7,2,'Nomina Administrativa','',2014,'2014-07-19 03:58:07','2014-07-18','Active'),
(8,2,'Incentivos','',2014,'2014-07-19 03:58:31','2014-07-18','Active'),
(9,2,'Finiquitos','',2014,'2014-07-19 04:02:33','2014-07-18','Active'),
(10,2,'Pemex (Diesel / Flete Diesel)','',2014,'2014-07-19 04:03:14','2014-07-18','Active'),
(11,2,'Gastos de Viaje','',2014,'2014-07-19 04:03:51','2014-07-18','Active'),
(12,2,'Anticipos Operadores Guadalajara','',2014,'2014-07-19 04:04:05','2014-07-18','Active'),
(13,2,'Anticipos Operadores Tijuana','',2014,'2014-07-19 04:04:20','2014-07-18','Active'),
(14,2,'Reembolso de Gastos Guadalajara','',2014,'2014-07-19 04:04:56','2014-07-18','Active'),
(15,2,'Reembolso de Gastos Ramos Arizpe','',2014,'2014-07-19 04:05:22','2014-07-18','Active'),
(16,3,'IMSS  Bimestre de Ifonavit y SAR Orizaba y Bases','',2014,'2014-07-19 04:06:11','2014-07-18','Active'),(17,3,'ISR','',2014,'2014-07-19 04:06:24','2014-07-18','Active'),
(18,3,'Impuesto sobre la Nomina de Orizaba','',2014,'2014-07-19 04:06:43','2014-07-18','Active'),(19,3,'ISTP','',2014,'2014-07-19 04:06:55','2014-07-18','Active'),
(20,3,'IETU','',2014,'2014-07-19 04:07:30','2014-07-18','Active'),
(21,3,'Impuesto sobre la Nomina de Tijuana','',2014,'2014-07-19 04:07:49','2014-07-18','Active'),(22,3,'IVA','',2014,'2014-07-19 04:07:55','2014-07-18','Active'),
(23,3,'Impuesto sobre la Nomina de Guadalajara','',2014,'2014-07-19 04:08:29','2014-07-18','Active'),
(24,4,'Reembolso de fondo Fijo de Caja Orizaba','',2014,'2014-07-19 04:08:29','2014-07-18','Active'),
(25,5,'Pago a Proveedores','',2014,'2014-07-19 04:08:29','2014-07-18','Active'),
(26,6,'Cofremex S.A de C.V','16 Frenos Electromagneticos',2014,'2014-07-19 04:08:29','2014-07-18','Active'),(27,7,'Inversiones de Activo Fijo','',2014,'2014-07-19 04:08:29','2014-07-18','Active'),(28,1,'Depositos','',NULL,'2014-09-15 14:08:13','0000-00-00','Active'),
(29,1,'Inversion Cuenta Corriente','',NULL,'2014-09-15 14:08:34','0000-00-00','Active'),(30,1,'Inversiones','',NULL,'2014-09-15 14:08:53','0000-00-00','Active'),
(31,2,'Nómina Operadores','',NULL,'2014-09-18 21:43:42','0000-00-00','Active'),
(32,2,'Reembolso de Gastos Tijuana','',NULL,'2014-09-18 21:47:10','0000-00-00','Active'),
(33,2,'Reembolso Gastos de Bases de Guadalajara','',NULL,'2014-09-18 21:48:08','0000-00-00','Active'),(34,2,'Infonacot','',NULL,'2014-09-18 21:48:40','0000-00-00','Active'),
(35,2,'Arrendamiento Financiero','',NULL,'2014-09-18 21:49:07','0000-00-00','Active'),
(36,2,'Pensiones Alimenticias','',NULL,'2014-09-18 21:49:30','0000-00-00','Active'),
(37,2,'Pensiones Alimenticias','',NULL,'2014-09-18 21:50:19','0000-00-00','Active'),
(38,2,'Compra de Dolares','',NULL,'2014-09-18 21:50:36','0000-00-00','Active'),
(39,2,'Sindicato','',NULL,'2014-09-18 21:50:57','0000-00-00','Active'),
(40,2,'Deposito de Garantia (Capufe)','',NULL,'2014-09-18 21:51:29','0000-00-00','Active'),
(41,2,'Otros pagos en dolares','',NULL,'2014-09-18 21:52:03','0000-00-00','Active'),(42,2,'Dividendos','',NULL,'2014-09-18 21:52:40','0000-00-00','Active'),
(43,2,'PTU y Aguinaldo','',NULL,'2014-09-18 21:52:55','0000-00-00','Active'),
(44,3,'Impuesto sobre la Nomina de Saltillo','',NULL,'2014-09-18 22:55:44','0000-00-00','Active'),
(45,3,'Retencion ISR Honorarios / Arrendamiento','',NULL,'2014-09-18 22:56:34','0000-00-00','Active'),
(46,3,'Retencion I.V.A.','',NULL,'2014-09-18 23:03:37','0000-00-00','Active'),
(47,3,'Otros Impuestos y Derechos','',NULL,'2014-09-18 23:04:12','0000-00-00','Active'),
(48,3,'Provisiones de Impuestos','',NULL,'2014-09-18 23:04:37','0000-00-00','Active'),
(49,3,'Otros por pagos Impuestos','',NULL,'2014-09-18 23:07:05','0000-00-00','Active'),(50,5,'Proveedores','',NULL,'2014-09-19 13:44:18','0000-00-00','Active'),
(51,5,'Talleres Externos','',NULL,'2014-09-19 13:44:42','0000-00-00','Active'),
(52,5,'Gasolineras','',NULL,'2014-09-19 13:45:03','0000-00-00','Active'),
(53,5,'Proveedores (Servicios)','',NULL,'2014-09-19 13:45:27','0000-00-00','Active'),
(54,5,'IAVE','',NULL,'2014-09-19 13:45:46','0000-00-00','Active'),
(55,5,'Via Pass Peaje','',NULL,'2014-09-19 13:46:14','0000-00-00','Active'),
(56,5,'FIARUM','',NULL,'2014-09-19 13:46:41','0000-00-00','Active'),
(57,5,'Casetas Acatlan Guadalajara','',NULL,'2014-09-19 13:47:07','0000-00-00','Active'),
(58,5,'Primas de seguros Mapfre Tepeyac','',NULL,'2014-09-19 13:47:53','0000-00-00','Active'),
(59,5,'Servicios Teisa Atm','',NULL,'2014-09-19 13:48:16','0000-00-00','Active'),
(60,5,'Proyecto Integra','',NULL,'2014-09-19 13:48:39','0000-00-00','Active'),
(61,5,'Arrendamiento Financiero','',NULL,'2014-09-19 13:49:30','0000-00-00','Active'),
(62,5,'Anticipo Telcel','',NULL,'2014-09-19 13:50:04','0000-00-00','Active'),
(63,5,'Proveedores Servicios (Hospedaje)','',NULL,'2014-09-19 13:50:45','0000-00-00','Active'),
(64,5,'Miguel Angel Velazco Manrique','',NULL,'2014-09-19 13:52:13','0000-00-00','Active'),
(65,5,'Otros Pagos Ramos Arizpe','',NULL,'2014-09-19 13:53:03','0000-00-00','Active'),
(66,5,'Telmex','Teléfonos de México',NULL,'2014-09-19 13:53:55','0000-00-00','Active'),
(67,6,'Kasa International','6 Tractores',NULL,'2014-09-19 14:04:18','0000-00-00','Active'),
(68,6,'R+R Esquemas y Edificaciones','Departamento Guillermo G. Anaya',NULL,'2014-09-19 14:05:19','0000-00-00','Active'),(69,8,'Pago de Prestamos','',NULL,'2014-09-19 14:35:41','0000-00-00','Active');
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;
UNLOCK TABLES;


drop table if exists `flujo`;
create table `flujo`(
  `id_flujo` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_kingdoms` int(11) not null,
  `id_accounts` int(11) null,
  `id_realms_class` int(11) null,
  `id_realms` int(11) null,
  `flujo` varchar(255) null,
  `presupuesto` varchar(255) null,
  `week` int(3) NULL,
  `month` int(2) null,
  `year` year null,
  `fdatetime` timestamp DEFAULT current_timestamp,
  `fecha` date NULL,
  `status` enum('Active','Inactive') NOT NULL default 'Active',
  PRIMARY KEY (`id_flujo`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
--
-- Dumping data for table `flujo`
--

LOCK TABLES `flujo` WRITE;
/*!40000 ALTER TABLE `flujo` DISABLE KEYS */;
INSERT INTO `flujo` VALUES (1,2,1,NULL,NULL,NULL,'1000',31,7,2014,'2014-09-12 22:51:08',NULL,'Active'),(2,2,2,NULL,NULL,NULL,'2300',31,7,2014,'2014-09-12 22:51:08',NULL,'Active'),(3,2,3,NULL,NULL,NULL,'1000',31,7,2014,'2014-09-12 22:51:08',NULL,'Active'),(4,2,4,NULL,NULL,NULL,'1200',31,7,2014,'2014-09-12 22:51:08',NULL,'Active'),(5,2,5,NULL,NULL,NULL,'100',31,7,2014,'2014-09-12 22:51:08',NULL,'Active'),(6,2,6,NULL,NULL,NULL,'110',31,7,2014,'2014-09-12 22:51:08',NULL,'Active'),(7,2,7,NULL,NULL,NULL,'230',31,7,2014,'2014-09-12 22:51:08',NULL,'Active'),(8,2,8,NULL,NULL,NULL,'100',31,7,2014,'2014-09-12 22:51:08',NULL,'Active'),(9,2,9,NULL,NULL,NULL,'10',31,7,2014,'2014-09-12 22:51:08',NULL,'Active'),(10,2,10,NULL,NULL,NULL,'10',31,7,2014,'2014-09-12 22:51:08',NULL,'Active'),(11,2,11,NULL,NULL,NULL,'10',31,7,2014,'2014-09-12 22:51:08',NULL,'Active'),(12,2,16,NULL,NULL,NULL,'20',31,7,2014,'2014-09-12 22:51:08',NULL,'Active'),(13,2,17,NULL,NULL,NULL,'23',31,7,2014,'2014-09-12 22:51:08',NULL,'Active'),(14,2,18,NULL,NULL,NULL,'12',31,7,2014,'2014-09-12 22:51:08',NULL,'Active'),(15,2,19,NULL,NULL,NULL,'10',31,7,2014,'2014-09-12 22:51:08',NULL,'Active'),(16,2,20,NULL,NULL,NULL,'110',31,7,2014,'2014-09-12 22:51:08',NULL,'Active'),(17,2,21,NULL,NULL,NULL,'20',31,7,2014,'2014-09-12 22:51:08',NULL,'Active'),(18,2,22,NULL,NULL,NULL,'5',31,7,2014,'2014-09-12 22:51:08',NULL,'Active'),(19,2,23,NULL,NULL,NULL,'10',31,7,2014,'2014-09-12 22:51:08',NULL,'Active'),(20,2,1,NULL,NULL,NULL,'12000',31,8,2014,'2014-09-12 22:52:35',NULL,'Active'),(21,2,2,NULL,NULL,NULL,'12900',31,8,2014,'2014-09-12 22:52:35',NULL,'Active'),(22,2,3,NULL,NULL,NULL,'2000',31,8,2014,'2014-09-12 22:52:35',NULL,'Active'),(23,2,4,NULL,NULL,NULL,'1000',31,8,2014,'2014-09-12 22:52:35',NULL,'Active'),(24,2,5,NULL,NULL,NULL,'1200',31,8,2014,'2014-09-12 22:52:35',NULL,'Active'),(25,2,6,NULL,NULL,NULL,'1200',31,8,2014,'2014-09-12 22:52:35',NULL,'Active'),(26,2,7,NULL,NULL,NULL,'100',31,8,2014,'2014-09-12 22:52:35',NULL,'Active'),(27,2,28,NULL,NULL,NULL,'1000',31,7,2014,'2014-09-15 14:09:14',NULL,'Active'),(28,2,29,NULL,NULL,NULL,'300',31,7,2014,'2014-09-15 14:09:14',NULL,'Active'),(29,2,30,NULL,NULL,NULL,'850',31,7,2014,'2014-09-15 14:09:14',NULL,'Active'),(30,2,28,NULL,NULL,NULL,'1200',30,7,2014,'2014-09-15 15:21:33',NULL,'Active'),(31,2,29,NULL,NULL,NULL,'1200',30,7,2014,'2014-09-15 15:21:33',NULL,'Active'),(32,2,30,NULL,NULL,NULL,'1400',30,7,2014,'2014-09-15 15:21:33',NULL,'Active'),(33,2,1,NULL,NULL,NULL,'1000',30,7,2014,'2014-09-15 15:21:33',NULL,'Active'),(34,2,2,NULL,NULL,NULL,'1780',30,7,2014,'2014-09-15 15:21:33',NULL,'Active'),(35,2,3,NULL,NULL,NULL,'2880',30,7,2014,'2014-09-15 15:21:33',NULL,'Active'),(36,2,4,NULL,NULL,NULL,'1299',30,7,2014,'2014-09-15 15:21:33',NULL,'Active'),(37,2,5,NULL,NULL,NULL,'12',30,7,2014,'2014-09-15 15:21:33',NULL,'Active'),(38,2,6,NULL,NULL,NULL,'12',30,7,2014,'2014-09-15 15:21:33',NULL,'Active'),(39,2,8,NULL,NULL,NULL,'12',30,7,2014,'2014-09-15 15:21:33',NULL,'Active'),(40,2,11,NULL,NULL,NULL,'12',30,7,2014,'2014-09-15 15:21:33',NULL,'Active'),(41,2,13,NULL,NULL,NULL,'12',30,7,2014,'2014-09-15 15:21:33',NULL,'Active'),(42,2,14,NULL,NULL,NULL,'12',30,7,2014,'2014-09-15 15:21:33',NULL,'Active'),(43,2,16,NULL,NULL,NULL,'12',30,7,2014,'2014-09-15 15:21:33',NULL,'Active'),(44,2,17,NULL,NULL,NULL,'12',30,7,2014,'2014-09-15 15:21:33',NULL,'Active'),(45,2,18,NULL,NULL,NULL,'31',30,7,2014,'2014-09-15 15:21:33',NULL,'Active'),(46,2,19,NULL,NULL,NULL,'3',30,7,2014,'2014-09-15 15:21:33',NULL,'Active'),(47,2,20,NULL,NULL,NULL,'21',30,7,2014,'2014-09-15 15:21:33',NULL,'Active'),(48,2,21,NULL,NULL,NULL,'2',30,7,2014,'2014-09-15 15:21:33',NULL,'Active'),(49,2,22,NULL,NULL,NULL,'1',30,7,2014,'2014-09-15 15:21:33',NULL,'Active'),(50,2,23,NULL,NULL,NULL,'2',30,7,2014,'2014-09-15 15:21:33',NULL,'Active'),(51,2,28,NULL,NULL,NULL,'1200',30,7,2014,'2014-09-15 15:22:10',NULL,'Active'),(52,2,29,NULL,NULL,NULL,'1200',30,7,2014,'2014-09-15 15:22:10',NULL,'Active'),(53,2,30,NULL,NULL,NULL,'1400',30,7,2014,'2014-09-15 15:22:10',NULL,'Active'),
(54,2,1,NULL,NULL,NULL,'1000',30,7,2014,'2014-09-15 15:22:10',NULL,'Active'),(55,2,2,NULL,NULL,NULL,'1780',30,7,2014,'2014-09-15 15:22:10',NULL,'Active'),(56,2,3,NULL,NULL,NULL,'2880',30,7,2014,'2014-09-15 15:22:10',NULL,'Active'),(57,2,4,NULL,NULL,NULL,'1299',30,7,2014,'2014-09-15 15:22:10',NULL,'Active'),(58,2,5,NULL,NULL,NULL,'12',30,7,2014,'2014-09-15 15:22:10',NULL,'Active'),(59,2,6,NULL,NULL,NULL,'12',30,7,2014,'2014-09-15 15:22:10',NULL,'Active'),(60,2,8,NULL,NULL,NULL,'12',30,7,2014,'2014-09-15 15:22:10',NULL,'Active'),(61,2,11,NULL,NULL,NULL,'12',30,7,2014,'2014-09-15 15:22:10',NULL,'Active'),(62,2,13,NULL,NULL,NULL,'12',30,7,2014,'2014-09-15 15:22:10',NULL,'Active'),(63,2,14,NULL,NULL,NULL,'12',30,7,2014,'2014-09-15 15:22:10',NULL,'Active'),(64,2,16,NULL,NULL,NULL,'12',30,7,2014,'2014-09-15 15:22:10',NULL,'Active'),(65,2,17,NULL,NULL,NULL,'12',30,7,2014,'2014-09-15 15:22:10',NULL,'Active'),(66,2,18,NULL,NULL,NULL,'31',30,7,2014,'2014-09-15 15:22:10',NULL,'Active'),(67,2,19,NULL,NULL,NULL,'3',30,7,2014,'2014-09-15 15:22:10',NULL,'Active'),(68,2,20,NULL,NULL,NULL,'21',30,7,2014,'2014-09-15 15:22:10',NULL,'Active'),(69,2,21,NULL,NULL,NULL,'2',30,7,2014,'2014-09-15 15:22:10',NULL,'Active'),(70,2,22,NULL,NULL,NULL,'1',30,7,2014,'2014-09-15 15:22:10',NULL,'Active'),(71,2,23,NULL,NULL,NULL,'2',30,7,2014,'2014-09-15 15:22:10',NULL,'Active'),(72,2,28,NULL,NULL,NULL,'100',29,7,2014,'2014-09-15 15:31:42',NULL,'Active'),(73,2,29,NULL,NULL,NULL,'100',29,7,2014,'2014-09-15 15:31:42',NULL,'Active'),(74,2,30,NULL,NULL,NULL,'100',29,7,2014,'2014-09-15 15:31:42',NULL,'Active'),(75,2,5,NULL,NULL,NULL,'10',29,7,2014,'2014-09-15 15:31:42',NULL,'Active'),(76,2,6,NULL,NULL,NULL,'10',29,7,2014,'2014-09-15 15:31:42',NULL,'Active'),(77,2,7,NULL,NULL,NULL,'10',29,7,2014,'2014-09-15 15:31:42',NULL,'Active'),(78,2,17,NULL,NULL,NULL,'10',29,7,2014,'2014-09-15 15:31:42',NULL,'Active'),(79,2,18,NULL,NULL,NULL,'15',29,7,2014,'2014-09-15 15:31:42',NULL,'Active'),(80,2,19,NULL,NULL,NULL,'10',29,7,2014,'2014-09-15 15:31:42',NULL,'Active'),(81,2,20,NULL,NULL,NULL,'10',29,7,2014,'2014-09-15 15:31:42',NULL,'Active'),(82,2,21,NULL,NULL,NULL,'10',29,7,2014,'2014-09-15 15:31:42',NULL,'Active'),(83,2,28,NULL,NULL,NULL,'120',27,7,2014,'2014-09-17 14:43:24',NULL,'Active'),(84,2,29,NULL,NULL,NULL,'110',27,7,2014,'2014-09-17 14:43:24',NULL,'Active'),(85,2,30,NULL,NULL,NULL,'200',27,7,2014,'2014-09-17 14:43:24',NULL,'Active'),(86,2,1,NULL,NULL,NULL,'300',27,7,2014,'2014-09-17 14:43:24',NULL,'Active'),(87,2,2,NULL,NULL,NULL,'400',27,7,2014,'2014-09-17 14:43:24',NULL,'Active'),(88,2,3,NULL,NULL,NULL,'500',27,7,2014,'2014-09-17 14:43:24',NULL,'Active'),(89,2,4,NULL,NULL,NULL,'12000',27,7,2014,'2014-09-17 14:43:24',NULL,'Active'),(90,2,5,NULL,NULL,NULL,'100',27,7,2014,'2014-09-17 14:43:24',NULL,'Active'),(91,2,6,NULL,NULL,NULL,'100',27,7,2014,'2014-09-17 14:43:24',NULL,'Active'),(92,2,7,NULL,NULL,NULL,'100',27,7,2014,'2014-09-17 14:43:24',NULL,'Active'),(93,2,8,NULL,NULL,NULL,'10',27,7,2014,'2014-09-17 14:43:24',NULL,'Active'),(94,2,9,NULL,NULL,NULL,'10',27,7,2014,'2014-09-17 14:43:24',NULL,'Active'),(95,2,10,NULL,NULL,NULL,'10',27,7,2014,'2014-09-17 14:43:24',NULL,'Active'),(96,2,11,NULL,NULL,NULL,'10',27,7,2014,'2014-09-17 14:43:24',NULL,'Active'),(97,2,12,NULL,NULL,NULL,'10',27,7,2014,'2014-09-17 14:43:24',NULL,'Active'),(98,2,13,NULL,NULL,NULL,'10',27,7,2014,'2014-09-17 14:43:24',NULL,'Active'),(99,2,14,NULL,NULL,NULL,'10',27,7,2014,'2014-09-17 14:43:24',NULL,'Active'),(100,2,15,NULL,NULL,NULL,'10',27,7,2014,'2014-09-17 14:43:24',NULL,'Active'),(101,2,24,NULL,NULL,NULL,'20',27,7,2014,'2014-09-17 14:43:24',NULL,'Active'),(102,2,28,NULL,NULL,NULL,'200',28,7,2014,'2014-09-17 14:43:57',NULL,'Active'),(103,2,29,NULL,NULL,NULL,'200',28,7,2014,'2014-09-17 14:43:57',NULL,'Active'),(104,2,16,NULL,NULL,NULL,'150',28,7,2014,'2014-09-17 14:43:57',NULL,'Active'),(105,2,17,NULL,NULL,NULL,'240',28,7,2014,'2014-09-17 14:43:57',NULL,'Active'),(106,2,28,NULL,NULL,NULL,'2300',32,8,2014,'2014-09-17 15:36:49',NULL,'Active'),(107,2,29,NULL,NULL,NULL,'1200',32,8,2014,'2014-09-17 15:36:49',NULL,'Active'),
(108,2,5,NULL,NULL,NULL,'1200',32,8,2014,'2014-09-17 15:36:49',NULL,'Active'),(109,2,6,NULL,NULL,NULL,'2000',32,8,2014,'2014-09-17 15:36:49',NULL,'Active'),(110,2,24,NULL,NULL,NULL,'12',30,7,2014,'2014-09-18 20:52:16',NULL,'Active'),(111,2,25,NULL,NULL,NULL,'12',30,7,2014,'2014-09-18 20:52:16',NULL,'Active'),(112,2,26,NULL,NULL,NULL,'12',30,7,2014,'2014-09-18 20:52:16',NULL,'Active'),(113,2,27,NULL,NULL,NULL,'12',30,7,2014,'2014-09-18 20:52:16',NULL,'Active'),(114,2,28,NULL,NULL,NULL,'12',27,6,2014,'2014-09-18 21:21:17',NULL,'Active'),(115,2,5,NULL,NULL,NULL,'12',27,6,2014,'2014-09-18 21:21:17',NULL,'Active'),(116,2,16,NULL,NULL,NULL,'12',27,6,2014,'2014-09-18 21:21:17',NULL,'Active'),(117,2,24,NULL,NULL,NULL,'12',27,6,2014,'2014-09-18 21:21:17',NULL,'Active'),(118,2,25,NULL,NULL,NULL,'12',27,6,2014,'2014-09-18 21:21:17',NULL,'Active'),(119,2,26,NULL,NULL,NULL,'12',27,6,2014,'2014-09-18 21:21:17',NULL,'Active'),(120,2,27,NULL,NULL,NULL,'12',27,6,2014,'2014-09-18 21:21:17',NULL,'Active'),(121,2,29,NULL,NULL,NULL,'12',27,6,2014,'2014-09-18 22:32:04',NULL,'Active'),(122,2,31,NULL,NULL,NULL,'12',27,6,2014,'2014-09-18 22:33:07',NULL,'Active'),(123,2,50,NULL,NULL,NULL,'200',31,7,2014,'2014-09-19 13:54:53',NULL,'Active'),(124,2,54,NULL,NULL,NULL,'15',31,7,2014,'2014-09-19 13:54:53',NULL,'Active'),(125,2,62,NULL,NULL,NULL,'10',31,7,2014,'2014-09-19 13:54:53',NULL,'Active'),(126,2,69,NULL,NULL,NULL,'100',31,7,2014,'2014-09-19 14:36:01',NULL,'Active'),(127,2,67,NULL,NULL,NULL,'120',31,7,2014,'2014-09-19 14:39:13',NULL,'Active'),(128,2,68,NULL,NULL,NULL,'110',31,7,2014,'2014-09-19 14:39:13',NULL,'Active'),(129,2,26,NULL,NULL,NULL,'90',31,7,2014,'2014-09-19 14:39:13',NULL,'Active'),(130,2,28,NULL,NULL,NULL,'200',8,2,2015,'2014-09-19 14:41:33',NULL,'Active'),(131,2,1,NULL,NULL,NULL,'100',8,2,2015,'2014-09-19 14:41:33',NULL,'Active'),(132,2,3,NULL,NULL,NULL,'100',8,2,2015,'2014-09-19 14:41:33',NULL,'Active'),(133,2,4,NULL,NULL,NULL,'10',8,2,2015,'2014-09-19 14:41:33',NULL,'Active'),(134,2,34,NULL,NULL,NULL,'23',8,2,2015,'2014-09-19 14:41:33',NULL,'Active'),(135,2,49,NULL,NULL,NULL,'11',8,2,2015,'2014-09-19 14:41:33',NULL,'Active'),(136,2,56,NULL,NULL,NULL,'11',8,2,2015,'2014-09-19 14:41:33',NULL,'Active'),(137,2,26,NULL,NULL,NULL,'21',8,2,2015,'2014-09-19 14:41:33',NULL,'Active'),(138,2,69,NULL,NULL,NULL,'12',8,2,2015,'2014-09-19 14:41:33',NULL,'Active'),(139,2,68,NULL,NULL,NULL,'50',18,5,2014,'2014-09-19 15:38:42',NULL,'Active'),(140,2,28,NULL,NULL,NULL,'100',18,5,2014,'2014-09-19 15:51:54',NULL,'Active'),(141,2,31,NULL,NULL,NULL,'100',15,4,2014,'2014-09-19 15:59:44',NULL,'Active'),(142,2,28,NULL,NULL,NULL,'100',15,4,2014,'2014-09-19 16:01:34',NULL,'Active'),(143,2,31,NULL,NULL,NULL,'100',15,4,2014,'2014-09-19 16:01:34',NULL,'Active'),(144,2,69,NULL,NULL,NULL,'100',27,7,2014,'2014-09-19 21:02:57',NULL,'Active'),(145,2,69,NULL,NULL,NULL,'100',28,7,2014,'2014-09-19 21:03:28',NULL,'Active'),(146,2,69,NULL,NULL,NULL,'100',29,7,2014,'2014-09-19 21:04:17',NULL,'Active'),(147,2,69,NULL,NULL,NULL,'100',30,7,2014,'2014-09-19 21:05:46',NULL,'Active');
/*!40000 ALTER TABLE `flujo` ENABLE KEYS */;
UNLOCK TABLES;



-- the views
drop table if exists `accounts_views`;
create table `accounts_views`(
  `id_accounts_views` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_kingdoms` int(11) not null,
  `id_realms_class` int(11) null,
  `id_accounts` int(11) null,
  `fdatetime` timestamp DEFAULT current_timestamp,
  `fecha` date NULL,
  `status` enum('Active','Inactive') NOT NULL default 'Active',
  PRIMARY KEY (`id_accounts_views`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

insert into `accounts_views` values
(null,'1','7','27',NOW(),NOW(),'Active');

-- This going firts in the modulo ??
drop table if exists `realms_class_views`;
create table `realms_class_views`(
  `id_realms_class_views` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_kingdoms` int(11) not null,
  `id_realms_class` int(11) null,
  `fdatetime` timestamp DEFAULT current_timestamp,
  `fecha` date NULL,
  `status` enum('Active','Inactive') NOT NULL default 'Active',
  PRIMARY KEY (`id_realms_class_views`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- #########################################################################

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

