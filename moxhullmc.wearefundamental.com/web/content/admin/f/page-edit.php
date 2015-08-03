<?php session_start();

include(dirname(__FILE__) . '/../config/config.php');

if (!$_SESSION['uid']) {
header ("Location:$cms_abs_url/index.php");
}

// Include FCKeditor
include_once(dirname(__FILE__) . "/../fckeditor/fckeditor.php");

/* Generate Menus */
$HTTP_SESSION_VARS['T'] = 'front';
$HTTP_SESSION_VARS['S'] = 'page_view';
include($cms_root_url . '/components/menu-script.php');
include($cms_root_url . '/components/log-script.php');


$page_id = $_GET['edit'];

require($cms_root_url . '/components/mysql_connect.inc');


if ($_POST['submitted']) {
	
	$query = sprintf("UPDATE pages SET
	page_title='%s',
	page_url='%s',
	page_description='%s',
	page_keywords='%s',
	page_content='%s'
	WHERE page_id=%s",
	mysql_real_escape_string(stripslashes($_POST['page_title'])),
	mysql_real_escape_string(stripslashes($_POST['page_url'])),
	mysql_real_escape_string(stripslashes($_POST['page_description'])),
	mysql_real_escape_string(stripslashes($_POST['page_keywords'])),
	mysql_real_escape_string(stripslashes($_POST['page_content'])),
	mysql_real_escape_string($page_id));

	$result = mysql_query($query);
	
	if ($result) {
		$erun = 'Page Saved';
		$srun = "Page &quot;" . mysql_real_escape_string(stripslashes($_POST['page_title'])). "&quot; Edited";
		include($cms_root_url . '/components/log-script.php');
	} 
	else {
		$erun = 'Error, Page NOT Saved';
	}
						
} 


$query = "SELECT * FROM pages WHERE page_id=" . mysql_real_escape_string($page_id);

$result = mysql_query($query);

while ($row = mysql_fetch_assoc($result)) {

	$page_title = $row['page_title'];
	$page_url = $row['page_url'];
	$page_description = $row['page_description'];
	$page_keywords = $row['page_keywords'];
	$page_content = $row['page_content'];

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
		<img src="../images/icons/content_48.gif" alt="" name="users_icon" width="48" height="48" hspace="20" vspace="0" border="0" align="left" /><p><strong>Manage Front End Content</strong><br />Work with the WYSIWYG editor to add and amend front end copy content.</p>
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
				<h1>Edit Content Page</h1>
				<p>Make changes to a content page</p>
			</div>
            	
			<p><strong>Please Note:</strong> fields marked <img src="../images/icon-required-field.gif" alt="This is a required field and *MUST* be completed" name="required-field-icon" width="18" height="18" hspace="5" vspace="0" border="0" align="middle" /> are required!</p>
					
<form action="" method="post" name="editform">
			
Enter a Page Title<br />
<input name="page_title" type="text" size="80" maxlength="100" value="<?php echo $page_title; ?>" />
<img src="../images/icon-required-field.gif" alt="This is a required field and *MUST* be completed" name="required-field-icon" width="18" height="18" hspace="5" vspace="0" border="0" style="vertical-align:top;" /><br /><br />

Enter a Page URL<br />
<input name="page_url" type="text" size="80" maxlength="100" value="<?php echo $page_url; ?>" />
<img src="../images/icon-required-field.gif" alt="This is a required field and *MUST* be completed" name="required-field-icon" width="18" height="18" hspace="5" vspace="0" border="0" style="vertical-align:top;" /><br /><br />

Enter a Page Description<br />
<input name="page_description" type="text" size="80" maxlength="150" value="<?php echo $page_description; ?>" />
<img src="../images/icon-required-field.gif" alt="This is a required field and *MUST* be completed" name="required-field-icon" width="18" height="18" hspace="5" vspace="0" border="0" style="vertical-align:top;" /><br /><br />

Enter Page Keywords<br />
<textarea name="page_keywords" rows="2" cols="60" /><?php echo $page_keywords; ?></textarea><br /><br />

Enter Page Content<br />
<?php
	$oFCKeditor = new FCKeditor('page_content');
	$oFCKeditor->BasePath = $cms_abs_url . '/fckeditor/';
	$oFCKeditor->Config["CustomConfigurationsPath"] = $cms_abs_url . '/fckconfig/editorconfig.js';
	$oFCKeditor->Width = '721';
	$oFCKeditor->Height = '400';
	// Add content if posted
	if(isset($page_content)) {
		$oFCKeditor->Value = $page_content;
	}
	$oFCKeditor->Create();
?>
<img src="../images/icon-required-field.gif" alt="This is a required field and *MUST* be completed" name="required-field-icon" width="18" height="18" hspace="5" vspace="0" border="0" style="vertical-align:top;" /><br /><br />

<input name="submitted" type="hidden" value="TRUE" />
<input name="submit" type="submit" value="Save Content" />

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