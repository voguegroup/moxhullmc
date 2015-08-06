<?php session_start();

include('../config/config.php');

if (!$_SESSION['uid']) {
header ("Location:$cms_abs_url/index.php");
}

/* Generate Menus */
$HTTP_SESSION_VARS['T'] = 'data';
$HTTP_SESSION_VARS['S'] = 'menu';
include('../components/menu-script.php');
include('../components/log-script.php');


?>
<!DOCTYPE html>
<html dir="ltr" class="ltr" lang="en">
<head>
<!-- Mobile viewport optimized: h5bp.com/viewport -->
<meta name="viewport" content="width=device-width">
<meta charset="UTF-8" />
<meta name="description" content="" />
<meta name="keywords" content="" />
<meta name="author" content="Vogue Creative" />
<title>Vogue Creative CMS</title>
<?php include('../components/meta.php'); ?>
<link href="../css/page.css" rel="stylesheet" type="text/css" />
<link href="../css/home.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div id="header">
	<div class="container">
		<?php include('../components/header.php'); ?>
	</div>
</div>

<?php include('../components/page-menu.php'); ?>

<div id="page-text">
	<div class="container">
		<p><img src="../images/icons/data_48.gif" alt="" name="asset_icon" width="48" height="48" hspace="20" vspace="0" border="0" align="left" /><strong>Manage Data / Information</strong><br />Manage dynamic web site data and information stored in the MySQL database.</p>
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
				<h1>Data / Information</h1>
				<p>Options and systems to manage stored data and information using the BlueWave CMS system</p>
			</div>
				
		<ul id="option-menu">
			<li onmouseover="this.style.backgroundColor='#f4f4f4';" onmouseout="this.style.backgroundColor='#ffffff';"><a href="car-view.php"><img src="../images/icons/data_48.gif" alt="" name="icon-home" width="48" height="48" hspace="15" vspace="0" border="0" align="left" id="icon-home" /><strong><br />
			  Cars</strong></a></li> 
			
		</ul>
			</div>
			
		</div>
		
	</div>
	
</div>

<div id="footer">
		<?php include('../components/footer.php'); ?>
</div>
</body>
</html>
