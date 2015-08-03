<?php session_start();

include(dirname(__FILE__) . '/config/config.php');

if (!$_SESSION['uid']) {
header ("Location:$cms_abs_url/index.php");
}

/* Generate Menus */
$HTTP_SESSION_VARS['T'] = 'home';
$HTTP_SESSION_VARS['S'] = 'menu';
include($cms_root_url . '/components/menu-script.php');
include($cms_root_url . '/components/log-script.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include('components/meta.php'); ?>
<link href="css/home.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div id="header">
	<div class="container">
		<?php include('components/header.php'); ?>
	</div>
</div>

<?php require('components/page-menu.php'); ?>

<div id="page-text">
	<div class="container">
		<p><?php print("Welcome <strong>{$_SESSION['user']}</strong> to the <strong>Bluewave</strong> <strong>C</strong>ontrol <strong>M</strong>anagement <strong>S</strong>ystem. Your IP address, <em>{$_SERVER['REMOTE_ADDR']}</em> has been recorded for this session!\n"); ?></p>
	</div>
</div>

<div id="content">
	<div class="container">
		<ul id="home-menu">
		
			<li onmouseover="this.style.backgroundColor='#f4f4f4';" onmouseout="this.style.backgroundColor='#ffffff';"><a href="f/f-menu.php"><img src="images/icons/content_48.gif" name="icon-front" width="48" height="48" hspace="10" vspace="0" border="0" align="left" id="icon-front" /><strong>Manage Front End Content</strong><br />Work with the WYSIWYG editor to add and amend front end copy content.</a></li>		

			<li onmouseover="this.style.backgroundColor='#f4f4f4';" onmouseout="this.style.backgroundColor='#ffffff';"><a href="d/d-menu.php"><img src="images/icons/data_48.gif" name="icon-data" width="48" height="48" hspace="10" vspace="0" border="0" align="left" id="icon-data" /><strong>Manage Data / Information</strong><br />Manage dynamic web site data and information stored in the MySQL database.</a></li>
            
			<li onmouseover="this.style.backgroundColor='#f4f4f4';" onmouseout="this.style.backgroundColor='#ffffff';"><a href="c/c-menu.php"><img src="images/icons/customers_48.gif" name="icon-data" width="48" height="48" hspace="10" vspace="0" border="0" align="left" id="icon-data" /><strong>Manage Customers</strong><br />Manage data supplied by customers.</a></li>		

<?php
/*		
			<li onmouseover="this.style.backgroundColor='#f4f4f4';" onmouseout="this.style.backgroundColor='#ffffff';"><a href="a/a-banners.php"><img src="images/icons/asset_48.gif" name="icon-asset" width="48" height="48" hspace="10" vspace="0" border="0" align="left" id="icon-asset" /><strong>Asset Management</strong><br />Manage site banners.</a></li>
*/
?>
			<li onmouseover="this.style.backgroundColor='#f4f4f4';" onmouseout="this.style.backgroundColor='#ffffff';"><a href="u/u-menu.php"><img src="images/icons/users_48.gif" name="icon-user" width="48" height="48" hspace="10" vspace="0" border="0" align="left" id="icon-user" /><strong>Users / Logs</strong><br />Manage BlueWave Content Management System users and logs.</a></li>	
            
			<li onmouseover="this.style.backgroundColor='#f4f4f4';" onmouseout="this.style.backgroundColor='#ffffff';"><a href="s/s-menu.php"><img src="images/icons/support_48.gif" name="icon-support" width="48" height="48" hspace="10" vspace="0" border="0" align="left" id="icon-support" /><strong>BlueWave Support</strong><br />Visit the BlueWave CMS support web site in a new browser window.</a></li>	
		
			<li onmouseover="this.style.backgroundColor='#f2f2f2';" onmouseout="this.style.backgroundColor='#ffffff';"><a href="<?php echo $site_url; ?>" target="_blank"><img src="images/icons/home_48.gif" name="icon-home" width="48" height="48" hspace="10" vspace="0" border="0" align="left" id="icon-home" /><strong>View Live Site</strong><br />Open the live front end of the site in a new browser window.</a></li>		
			

<?php
if(!empty($stats_link)) {
?>
			<li onmouseover="this.style.backgroundColor='#f4f4f4';" onmouseout="this.style.backgroundColor='#ffffff';"><a href="<?php echo $stats_link; ?>" target="_blank"><img src="images/icons/stats_48.gif" name="icon-stats" width="48" height="48" hspace="10" vspace="0" border="0" align="left" id="icon-stats" /><strong>View Site Statistics</strong><br />View real-time site statistics in a new browser window.</a></li>
<?php
}
?>

		</ul>
	</div>
</div>

<div id="footer">
		<?php include('components/footer.php'); ?>
</div>

</body>
</html>
