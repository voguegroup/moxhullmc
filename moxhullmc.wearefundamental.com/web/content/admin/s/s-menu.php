<?php session_start();

include(dirname(__FILE__) . '/../config/config.php');

if (!$_SESSION['uid']) {
header ("Location:$cms_abs_url/index.php");
}

/* Generate Menus */
$HTTP_SESSION_VARS['T'] = 'support';
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
		<p><img src="../images/icons/support_48.gif" alt="" name="asset_icon" width="48" height="48" hspace="20" vspace="0" border="0" align="left" /><strong>Manage Support Subscription</strong><br />Manage your site support subscriptions.</p>
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
				<h1>Support Subscriptions</h1>
				<p>Options and systems to manage associated site support and maintenance.</p>
			</div>
				
			<p>There is currently no support subscription installed...</p>
			<p>Please contact sales on <b><?php echo $support_tel; ?></b> to discuss BlueWave CMS support and maintenance options.</p>
			<p>The BlueWave CMS subscription will provide various support contact options, including a dedicated account manager, direct contact 																		telephone and email support, access to the BlueWave CMS Knowledge base system, and How To guides.</p>
			<p>The subscription also offers software assurance, automatically updating your BlueWave CMS with security updates, patches and features as they become available.</p>
			<p>For further assistance, please contact us now on <b><?php echo $support_tel; ?></b> or email <b><a href="mailto:<?php echo $support_email; ?>"><?php echo $support_email; ?></a></b>.</p>

			</div>
			
		</div>
		
	</div>
	
</div>

<div id="footer">
		<?php include($cms_root_url . '/components/footer.php'); ?>
</div>
</body>
</html>
