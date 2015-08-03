<?php
require_once('admin/config/mysql_connect.inc');

$delete = "DELETE FROM feed";

mysql_query($delete);

$sql = "LOAD DATA LOCAL INFILE 'testfilestock.csv'
        INTO TABLE feed
        FIELDS TERMINATED BY '^'
        OPTIONALLY ENCLOSED BY '\"'
        LINES TERMINATED BY '\n'
		IGNORE 1 LINES";


mysql_query($sql);

?>
