<?php
/**
 * This is core configuration file.
 *
 * Use it to configure core behaviour ofCake.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * In this file you set up your database connection details.
 *
 * @package       cake
 * @subpackage    cake.config
 */
/**
 * Database configuration class.
 * You can specify multiple configurations for production, development and testing.
 *
 * driver => The name of a supported driver; valid options are as follows:
 *		mysql 		- MySQL 4 & 5,
 *		mysqli 		- MySQL 4 & 5 Improved Interface (PHP5 only),
 *		sqlite		- SQLite (PHP5 only),
 *		postgres	- PostgreSQL 7 and higher,
 *		mssql		- Microsoft SQL Server 2000 and higher,
 *		db2			- IBM DB2, Cloudscape, and Apache Derby (http://php.net/ibm-db2)
 *		oracle		- Oracle 8 and higher
 *		firebird	- Firebird/Interbase
 *		sybase		- Sybase ASE
 *		adodb-[drivername]	- ADOdb interface wrapper (see below),
 *		odbc		- ODBC DBO driver
 *
 * You can add custom database drivers (or override existing drivers) by adding the
 * appropriate file to app/models/datasources/dbo.  Drivers should be named 'dbo_x.php',
 * where 'x' is the name of the database.
 *
 * persistent => true / false
 * Determines whether or not the database should use a persistent connection
 *
 * connect =>
 * ADOdb set the connect to one of these
 *	(http://phplens.com/adodb/supported.databases.html) and
 *	append it '|p' for persistent connection. (mssql|p for example, or just mssql for not persistent)
 * For all other databases, this setting is deprecated.
 *
 * host =>
 * the host you connect to the database.  To add a socket or port number, use 'port' => #
 *
 * prefix =>
 * Uses the given prefix for all the tables in this database.  This setting can be overridden
 * on a per-table basis with the Model::$tablePrefix property.
 *
 * schema =>
 * For Postgres and DB2, specifies which schema you would like to use the tables in. Postgres defaults to
 * 'public', DB2 defaults to empty.
 *
 * encoding =>
 * For MySQL, MySQLi, Postgres and DB2, specifies the character encoding to use when connecting to the
 * database.  Uses database default.
 *
 */
class DATABASE_CONFIG {


	var $flujo = array(
		'driver' => 'mysql',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'flujo',
		'password' => '@flujo#',
		'database' => 'flujo',
		'prefix' => '',
		'encoding' => 'utf-8',
	);
	
	var $presupuesto = array(
		'driver' => 'mysql',
		'persistent' => true,
		'host' => 'localhost',
		'login' => 'presupuesto',
		'password' => '@presupuesto#',
		'database' => 'presupuesto',
		'prefix' => '',
		'encoding' => 'utf-8',
	);
	
	var $flujo_prep = array(
		'driver' => 'mysql',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'flujo_prep',
		'password' => '@flujo_prep#',
		'database' => 'flujo_prep',
		'prefix' => '',
		'encoding' => 'utf-8',
	);

	var $login = array(
		'driver' => 'mysql',
		'persistent' => true,
		'host' => 'localhost',
		'login' => 'projections',
		'password' => '@projections#',
		'database' => 'projections',
		'prefix' => '',
		'encoding' => 'utf-8',
	);

	var $atm = array(
		'driver' => 'mysql',
		'persistent' => true,
		'host' => 'localhost',
		'login' => 'projections_atm',
		'password' => '@projections_atm#',
		'database' => 'projections_atm',
		'prefix' => '',
		'encoding' => 'utf-8',
	);
	
	var $teisa = array(
		'driver' => 'mysql',
		'persistent' => true,
		'host' => 'localhost',
		'login' => 'projections_tei',
		'password' => '@projections_tei#',
		'database' => 'projections_tei',
		'prefix' => '',
		'encoding' => 'utf-8',
	);

	var $default = array( // connect to remote mssql server
		'driver' => 'mssql',
		'persistent' => false,
		'host' => 'IntegraDb',
		'login' => 'zam',
		'password' => 'lis',
		'database' => 'bonampakdb',
		'prefix' => '',
		'encoding' => 'utf-8',
	    'port' => '1433'
	);

	
	var $integraapp = array( // connect to remote mssql server
		'driver' => 'mssql',
		'persistent' => false,
		'host' => 'IntegraDb',
		'login' => 'zam',
		'password' => 'lis',
		'database' => 'integraapp',
		'prefix' => '',
		'encoding' => 'utf-8',
	    'port' => '1433'
	);

/** WARNING starting mssql connections **/

// [odbc-bonampakdb]
// Description = IntegraDb
// Driver = ms-sql
// ServerName = IntegraDb
// UID = zam
// port = 1433
// Database = bonampakdb

// [odbc-macuspanadb]
// Description = IntegraDbMacuspana
// Driver = ms-sql
// ServerName = IntegraDb
// UID = zam
// port = 1433
// Database = macuspanadb

// [odbc-tespecializadadb]
// Description = IntegraDbTespecializada
// Driver = ms-sql
// ServerName = IntegraDb
// UID = zam
// port = 1433
// Database = tespecializadadb

/** TODO making the connection for conciliations all from the model */
	var $mssqlAtm = array( // connect to remote mssql server
		'driver' => 'mssql',
		'persistent' => false,
		'host' => 'IntegraDb',
		'login' => 'zam',
		'password' => 'lis',
		'database' => 'macuspanadb',
		'prefix' => '',
		'encoding' => 'utf-8',
	    'port' => '1433'
	);

	var $mssqlTei = array( // connect to remote mssql server
		'driver' => 'mssql',
		'persistent' => false,
		'host' => 'IntegraDb',
		'login' => 'zam',
		'password' => 'lis',
		'database' => 'tespecializadadb',
		'prefix' => '',
// 		'encoding' => 'iso-8859-1',
		'encoding' => 'utf-8',
	    'port' => '1433'
	);

// 	var $conciliations = array( // connect to remote mssql server
// 		'driver' => 'mssql',
// 		'persistent' => false,
// 		'host' => 'IntegraDb',
// 		'login' => 'zam',
// 		'password' => 'lis',
// 		'database' => 'integraapp',
// 		'prefix' => '',
// 		'encoding' => 'utf8',
// 	    'port' => '1433'
// 	);

	
	var $test = array(
		'driver' => 'mysql',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'user',
		'password' => 'password',
		'database' => 'test_database_name',
		'prefix' => '',
		'encoding' => 'utf8',
	);

  /** ALERT => Install the database projections.sql 
  * mysql> grant usage on projections.* to projections@localhost identified by '@projections#';
  *
  * GRANT SELECT, INSERT, UPDATE, DELETE, DROP, ALTER, CREATE TEMPORARY TABLES ON projections.* TO projections@localhost;
  *
  * mysql> grant select,insert,delete,update  on projections.* to projections@localhost;
  *
  * mysql> flush privileges;
  *
  */
}


?>
