<?php 
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
	$sql=$dbo->prepare("INSERT INTO fsclog SET uid= :uid , sesip= :sesip, action= :action', action_time= :action_time");
$sql->execute(array(
":uid" => $_SESSION['uid'],
":sesip" => $_SERVER['REMOTE_ADDR'],
":action" =>	 $_GET['srun'],
":action_time" => gmdate("Y-m-d H:i:s")
));
} 
else if(isset($srun)) {
	$srun = $srun;
}


?>