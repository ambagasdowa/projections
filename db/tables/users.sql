-- phpMyAdmin SQL Dump
-- version 4.1.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 18, 2014 at 03:10 PM
-- Server version: 5.5.35-2
-- PHP Version: 5.6.0-1+b1

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
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `clear_password` varchar(20) DEFAULT NULL,
  `first_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `email` tinytext NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `level` int(2) NOT NULL DEFAULT '7',
  `status` enum('Active','Inactive') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `clear_password`, `first_name`, `last_name`, `email`, `id_empresa`, `level`, `status`) VALUES
(1, 'ambagasdowa', 'f96bd74e5e3fa4f26d99901f557fe9691327a73d', 'hide', 'sekai', 'hakaimono', '1@2.com', 0, 0, 'Inactive'),
(3, 'administrador', 'aa7e3777d5950560cdbd4a24edd641294e2dbd81', 'administrador', 'Administrador', 'Bonampak', 'admin@bonamapak.com.mx', 0, 0, 'Active'),
(4, 'teisa', 'b72bb5f1741b041f1e099e6a8fa2095737ab5eb8', '123456', 'teisa', 'admin', 'teisa@gmail.com', 3, 7, 'Active'),
(5, 'Macuspana', 'b72bb5f1741b041f1e099e6a8fa2095737ab5eb8', '123456', 'Macuspana', 'atm', 'atm@mail.com', 2, 7, 'Active'),
(6, 'bonampak', 'b72bb5f1741b041f1e099e6a8fa2095737ab5eb8', '123456', 'Bonampak', 'admin', 'bonampak@mail.com', 1, 7, 'Active');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
