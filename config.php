<?php

/*-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
	PATH SETTINGS
-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-*/

// Path '/' folder
define('ABSPATH', dirname(__FILE__));

// Path '_uploads' folder
define('UP_ABSPATH', ABSPATH . '/views/_uploads');

// Home URL
define('HOME_URI', 'http://blog.matizamundo.com.br');


/*-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
	DATABASE SETTINGS
-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-*/

// Database Host
define('DB_HOST', 'localhost');

// Database Name
define('DB_NAME', 'matizamu_blog');

// Database User
define('DB_USER', 'matizamu_bloadm');

// Database Password
define('DB_PASS', 'root123456');

// PDO Connection Charset
define('DB_CHARSET', 'utf8');


/*-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
	OTHERS SETTINGS
-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-*/

// For developers - Change value to true
define('DEBUG', true);

// Load 'loader.php'
require_once ABSPATH . '/loader.php';

?>