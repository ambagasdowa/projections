-- modd projections

CREATE TABLE IF NOT EXISTS `themes` (
  `id_theme` int(11) unsigned NOT NULL auto_increment,
  `vendor`	varchar(20) not null,
  `library` varchar(25) not null,
  `version` varchar(25) not null,
  `default` boolean not null ,
  `themename` varchar(20) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL default 'Active',
  PRIMARY KEY  (`id_theme`),
  KEY `status` (`status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;
