<?php 
//define some contstant
//define( "DB_DSN", "mysql:host=localhost;dbname=vrittDB" ); //this constant will be use as our connectionstring/dsn
define( "DB_HOST", "localhost" ); //username of the database
define( "DB_DBNAME", "transwise" ); //password of the database
define( "DB_USERNAME", "root" ); //username of the database
define( "DB_PASSWORD", "" ); //password of the database
$dataBase = new PDO("mysql:host=".DB_HOST.";dbname=".DB_DBNAME, DB_USERNAME, DB_PASSWORD);
$dataBase->setAttribute(PDO::ATTR_TIMEOUT, '1');
$dataBase->setAttribute(PDO::ATTR_PERSISTENT, 'false');
$dataBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>

