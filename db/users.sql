CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `username` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `clear_password` varchar(20) default NULL,
  `first_name` varchar(20) default NULL,
  `last_name` varchar(20) default NULL,
  `email` tinytext NOT NULL,
  `status` enum('Active','Inactive') NOT NULL default 'Active',
  `last_login` datetime default NULL,
  `last_access` datetime default NULL,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `status` (`status`),
  KEY `login` (`username`,`password`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;
