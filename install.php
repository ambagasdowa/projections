<?php
/** ALERT Install all stuff for work  
 ** @package full.
 **/
Installing cakephp 1.3 in debian

=== install apache2 mysql-server mysql-client php5-cli php5 php5-mysql 

then
a2enmod rewrite

change in /etc/apache2/apache.conf

<Directory>
/var/www/
AllowOverride none
to
AllowOverride All
</Directory>

Restart apache Service

Allowed memory size of 147281674 bytes exhausted in <some-file>.php on line 57
Then you start to search on the Internet with the above error message and you find advices like:
memory_limit = 32M to your server’s main php.ini file (recommended, if you have access)
memory_limit = 32M to a php.ini file in your application’s php file
ini_set(‘memory_limit’, ’32M’); ini_set(‘memory_limit’, ’-1’); in your sites/default/settings.php file
php_value memory_limit 32M in your .htaccess file
Add more memory 

The easiest way to find is to access the phpinfo() function on your system by launching a web-browser and typing the name (or IP address) of your Debian server like this:

and look for the following entry:
Loaded Configuration File etc/php5/apache2/php.ini
that is basically where your global php.ini file resides on your system.
Any application that uses Apache will read the value of the parameter:
memory_limit = 128M
 in cakephp overerite the .htaccess of the individual application
 are in the root directory 
 myApp/
    app/
    config/
    cake/
    .../
    .htaccess

backup your databases
mysqldump -u root -p --all-databases > alldb_backup.sql
or
mysqldump -h server -u root -p --all-databases > all_dbs.sql
and 
mysql -u root -p < all_dbs.sql

other options
mysqldump [options] --databases db_name1 [db_name2 db_name3...]

mysqldump -u SomeUser -p --databases mydb1 mydb2 mydb3 > myDbs.sql

TITLE => connect cakephp/LinuxBox To MSSQL
Summary

install the packages

freetds-bin
tdsodbc
unixodbc
php5-sybase


=== Add the server Definition Entry in /etc/freetds/freetds.conf

# hostidentifier => the name of the server this is a wrapper for the connection
[hostidentifier]
host = 192.168.0.30
port = 1433
tds version = 8.0

=== Add the driver configuration /etc/odbcinst.ini 
=== the routes in debian are /usr/lib/i386-linux-gnu/odbc/libtdsodbc.so
=== and /usr/lib/i386-linux-gnu/odbc/libtdsS.so

[ms-sql]
Description = TDS connection
Driver = /usr/lib/libtdsodbc.so.0
Setup = /usr/lib/libtdsS.so
UsageCount = 1
FileUsage = 1

=== Add the connection configuration /etc/odbc.ini

[odbc-dbname]
Description = sqlserver1
Driver = ms-sql
ServerName = hostsql1
UID = TuUsuario
Port = 1433
Database = dbname

Driver debe de ser el nombre del driver que hemos definido en odbcinst.ini
ServerName debe de ser el identificador de host que hemos definido en freetds.conf

=== Test the connection 

# tsql -S 192.168.0.30 -p 1433 -U TuUsuario -P TuPassword
locale is “en_US.UTF-8″
locale charset is “UTF-8″
1>

# isql -v odbc-dbname TuUsuario TuPassword

| Connected!                            |
|                                       |
| sql-statement                         |
| help [tablename]                      |
| quit                                  |
|                                       |
+—————————————+

SQL>

apt-get install libsybdb5 freetds-common php5-sybase
/etc/init.d/apache2 restart
At the end of the process, if all goes fine, you will find in the mssql section of phpinfo();


then in cakephp

I corrected the problem by adding the 'port' => '' to my database.php 
default config as in: 
        var $default = array( 
                'driver' => 'mssql', 
                'persistent' => false, 
                'host' => 'hostidentifier', 
                'login' => 'sa', 
                'password' => 'pass', 
                'database' => 'MyDb', 
                'encoding' => 'utf8', 
                'port' => '1433' 
        ); 

        
   Happy coding!
?>
