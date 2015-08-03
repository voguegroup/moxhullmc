<?php session_start();

include(dirname(__FILE__) . '/../config/config.php');

if (!$_SESSION['uid']) {
header ("Location:$cms_abs_url/index.php");
}

/* Generate Menus */
$HTTP_SESSION_VARS['T'] = 'data';
$HTTP_SESSION_VARS['S'] = 'piles';
include($cms_root_url . '/components/menu-script.php');
include($cms_root_url . '/components/log-script.php');


$pile_id = $_GET['edit'];


// Include DB Connection.
require($cms_root_url . '/components/mysql_connect.inc');


if ($_POST['submitted']) {
	
	// Validation	
	if (!$erun && empty($_POST['pile_name'])) {
		$erun = "Please enter a pile name";
	}
	
	
	if (!$erun) {
		$query = sprintf("UPDATE piles SET pile_name='%s' WHERE pile_id='%s'",
		mysql_real_escape_string(stripslashes($_POST['pile_name'])),
		mysql_real_escape_string($pile_id));
	
		$result = mysql_query($query);
		
		if ($result) {
			$erun = 'Pile Saved';
			$srun = "Pile &quot;" . mysql_real_escape_string(stripslashes($_POST['pile_name'])) . "&quot; Edited";
			include($cms_root_url . '/components/log-script.php');
		} 
		else {
			$erun = 'Error, Pile NOT Saved';
		}
	}

} 


$query = "SELECT * FROM piles WHERE pile_id=" . mysql_real_escape_string($pile_id);

$result = mysql_query($query);

while ($row = mysql_fetch_assoc($result)) {

	$pile_name = $row['pile_name'];

}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php include($cms_root_url . '/components/meta.php'); ?>
<link href="<?php echo $cms_abs_url ?>/css/page.css" rel="stylesheet" type="text/css" />
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
                    <h1>Edit Suitability </h1>
                    <p>Modify an existing suitability.</p>
                </div>
                
                <p><strong>Please Note:</strong> fields marked <img src="../images/icon-required-field.gif" alt="This is a required field and *MUST* be completed" name="required-field-icon" width="18" height="18" hspace="5" vspace="0" border="0" align="middle" /> are required!</p>
                
<form action="" method="post">
	
Enter a Suitability Name<br />
<input type="text" name="pile_name" size="80" maxlength="200" value="<?php echo stripslashes($pile_name); ?>" />
<img src="../images/icon-required-field.gif" alt="This is a required field and *MUST* be completed" name="required-field-icon" width="18" height="18" hspace="5" vspace="0" border="0" style="vertical-align:top;" /><br /><br />

<input name="submitted" type="hidden" value="TRUE" />
<input name="submit" type="submit" value="Save Suitability" />

</form>	         

			</div>
		</div>
		
	</div>
</div>


<div id="footer">
	<?php include($cms_root_url . '/components/footer.php'); ?>
</div>

</body>
</html>