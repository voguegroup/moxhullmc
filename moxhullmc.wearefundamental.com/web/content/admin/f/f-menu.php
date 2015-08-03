<?php session_start();

include(dirname(__FILE__) . '/../config/config.php');

if (!$_SESSION['uid']) {
header ("Location:$cms_abs_url/index.php");
}

/* Generate Menus */
$HTTP_SESSION_VARS['T'] = 'front';
$HTTP_SESSION_VARS['S'] = 'menu';
include($cms_root_url . '/components/menu-script.php');
include($cms_root_url . '/components/log-script.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php include($cms_root_url . '/components/meta.php'); ?>
<link href="<?php echo $cms_abs_url ?>/css/page.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $cms_abs_url ?>/css/home.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div id="header">
	<div class="container">
		<?php include($cms_root_url . '/components/header.php'); ?>
	</div>
</div>

<?php require('../components/page-menu.php'); ?>

<div id="page-text">
	<div class="container">
		<img src="../images/icons/content_48.gif" name="icon-front" width="48" height="48" hspace="20" vspace="0" border="0" align="left" id="icon-front" /><p><strong>Manage Front End Content</strong><br />Work with the WYSIWYG editor to add and amend front end copy content.</p>
	</div>
</div>

<div id="content">
	<div class="container">		
		
		<div id="page-internal-nav">
			<ul id="navlist">
			<?php print ("$submenu\n"); ?>	
			</ul>
		</div>
		
		<div id="page-container">
			<div id="page-pad">
				
			<div id="page-pad-title">
				<h1>Front End Content</h1>
				<p>Options and systems to manage the BlueWave CMS front end content</p>
			</div>
				
		<ul id="option-menu">
			<li onmouseover="this.style.backgroundColor='#f4f4f4';" onmouseout="this.style.backgroundColor='#ffffff';"><a href="page-view.php"><img src="../images/icons/content_48.gif" alt="" name="icon-home" width="48" height="48" hspace="15" vspace="0" border="0" align="left" id="icon-home" /><strong>View Content Pages</strong><br />Add, edit and delete content pages.</a></li>
		</ul>
	
			</div>
			
		</div>
		
	</div>
	
</div>

<div id="footer">
		<?php include($cms_root_url . '/components/footer.php'); ?>
</div>
</body>
</html>
