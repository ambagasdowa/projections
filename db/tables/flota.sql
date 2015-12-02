-- phpMyAdmin SQL Dump
-- version 4.0.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 06, 2014 at 08:42 AM
-- Server version: 5.5.37-1
-- PHP Version: 5.6.0-1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `projections`
--

-- --------------------------------------------------------

--
-- Table structure for table `flota`
--

CREATE TABLE IF NOT EXISTS `flota` (
  `id_flota` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) DEFAULT NULL,
  `alarmas` char(1) DEFAULT NULL,
  `qtracs_groupnum` varchar(10) DEFAULT NULL,
  `trafico_local_foraneo` text,
  `id_areaflota` text,
  `estatus` char(1) DEFAULT NULL,
  `id_area` int(11) NOT NULL,
  PRIMARY KEY (`id_flota`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `flota`
--

INSERT INTO `flota` (`id_flota`, `nombre`, `alarmas`, `qtracs_groupnum`, `trafico_local_foraneo`, `id_areaflota`, `estatus`, `id_area`) VALUES
(1, ' ORIZABA                                ', '', ' 1        ', ' 0                    ', ' 0           ', '', 1),
(2, ' PUEBLA                                 ', '', ' 2        ', ' 0                    ', ' 0           ', '', 1),
(3, ' RAMOS ARIZPE                           ', '', ' 3        ', ' 0                    ', ' 0           ', '', 3),
(4, ' ESCOBEDO                               ', '', ' 4        ', ' 0                    ', ' 0           ', '', 3),
(5, ' GUADALAJARA                            ', '', ' 5        ', ' 0                    ', ' 0           ', '', 2),
(6, ' CULIACAN                               ', '', ' 6        ', ' 0                    ', ' 0           ', '', 2),
(7, ' LA PAZ                                 ', '', ' 7        ', ' 0                    ', ' 0           ', '', 2),
(8, ' HERMOSILLO                             ', '', ' 8        ', ' 0                    ', ' 0           ', '', 5),
(9, ' GUAYMAS                                ', '', ' 9        ', ' 0                    ', ' 0           ', '', 2),
(10, ' ALTAMIRA                               ', '', ' 10       ', ' 0                    ', ' 0           ', '', 3),
(11, ' SAN LUIS                               ', '', ' 11       ', ' 0                    ', ' 0           ', '', 3),
(12, ' CHIHUAHUA                              ', '', ' 12       ', ' 0                    ', ' 0           ', '', 3),
(13, ' CD. JUAREZ                             ', '', ' 13       ', ' 0                    ', ' 0           ', '', 3),
(14, ' TIJUANA                                ', '', ' 14       ', ' 0                    ', ' 0           ', '', 4),
(15, ' MANZANILLO                             ', '', ' 15       ', ' 0                    ', ' 0           ', '', 2),
(16, 'OZ TERCEROS', NULL, '16', NULL, NULL, NULL, 1),
(17, 'GDL TERCEROS', NULL, '17', NULL, NULL, NULL, 2),
(18, 'GDL ENVASADO', NULL, '18', NULL, NULL, NULL, 2),
(19, 'RAM ENVASADO', NULL, '19', NULL, NULL, NULL, 3);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
