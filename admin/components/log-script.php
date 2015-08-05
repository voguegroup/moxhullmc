<?php session_start();

include (dirname(__FILE__) . '/../config/config.php');

if (isset($_GET['erun'])) {
	$sql=$dbo->prepare("INSERT INTO fsclog SET uid= :uid , sesip= :sesip, action= :action', action_time= :action_time");
$sql->execute(array(
":uid" => $_SESSION['uid'],
":sesip" => $_SERVER['REMOTE_ADDR'],
":action" =>	 $_GET['erun'],
":action_time" => gmdate("Y-m-d H:i:s")
));

}

if (isset($_GET['srun'])) {
	$srun = $_GET['srun'];
} 
else if(isset($srun)) {
	$srun = $srun;
}
if($srun) {
	$sql=$dbo->prepare("INSERT INTO fsclog SET uid= :uid , sesip= :sesip, action= :action', action_time= :action_time");
$sql->execute(array(
":uid" => $_SESSION['uid'],
":sesip" => $_SERVER['REMOTE_ADDR'],
":action" =>	 $_GET['srun'],
":action_time" => gmdate("Y-m-d H:i:s")
));
}

?>