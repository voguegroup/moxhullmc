<?php session_start();

include (dirname(__FILE__) . '/../config/config.php');

if (isset($_GET['erun'])) {
	include($cms_root_url . '/components/mysql_connect.inc');
	$query = "INSERT INTO fsclog SET uid='{$_SESSION['uid']}', sesip='{$_SERVER['REMOTE_ADDR']}', action='{$_GET['erun']}', action_time=NOW()";
	$query_result = mysql_query($query);
}

if (isset($_GET['srun'])) {
	$srun = $_GET['srun'];
} 
elseif(isset($srun)) {
	$srun = $srun;
}
if($srun) {
	include($cms_root_url . '/components/mysql_connect.inc');
	$query = "INSERT INTO fsclog SET uid='{$_SESSION['uid']}', sesip='{$_SERVER['REMOTE_ADDR']}', action='$srun', action_time=NOW()";
	$query_result = mysql_query($query);
}

?>