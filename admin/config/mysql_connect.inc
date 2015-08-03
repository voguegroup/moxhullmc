<?php



include(dirname(__FILE__) . 'config.php');



DEFINE (DB_USER, $db_user);

DEFINE (DB_PASSWORD, $db_pass);

DEFINE (DB_HOST, $db_host);

DEFINE (DB_NAME, $db_name);



/* Create MySQL Connection */

$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);

if (!$link)

{

	die('Could not connect to MySQL: '.mysql_error());

}



/* Select database */

$db_selected = mysql_select_db(DB_NAME, $link);

if (!db_selected)

{

	die('Could not select database: '.mysql_error());

}



?>
