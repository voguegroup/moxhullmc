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

if ($_POST['submitted']) {
	
	// Validation
	if (!$erun && $_POST['page_title'] == "") {
		$erun = "Please enter a page title";
	}
	
	if (!$erun && $_POST['page_url'] == "") {
		$erun = "Please enter a page URL";
	}
	
	if (!$erun && $_POST['page_description'] == "") {
		$erun = "Please enter a page description";
	}

	if (!$erun && $_POST['page_content'] == "") {
		$erun = "Please enter page content";
	}
	
	// If no errors, enter into database
	if(!$erun) {

		// Insert the new page into the table			
		require($cms_root_url . '/components/mysql_connect.inc');
	
		$query = sprintf("INSERT INTO pages (page_title, page_url, page_description, page_keywords, page_content) VALUES ('%s', '%s', '%s', '%s', '%s')",
		mysql_real_escape_string(stripslashes($_POST['page_title'])),
		mysql_real_escape_string(stripslashes($_POST['page_url'])),
		mysql_real_escape_string(stripslashes($_POST['page_description'])),
		mysql_real_escape_string(stripslashes($_POST['page_keywords'])),
		mysql_real_escape_string(stripslashes($_POST['page_content'])));
			
		$result = mysql_query($query);
	
		if ($result) {
			$erun = 'Page Created';
			$srun = "Page &quot;" . mysql_real_escape_string(stripslashes($_POST['page_title'])) . "&quot; Created";
			include($cms_root_url . '/components/log-script.php');
		} else {
			$erun = 'Error, Page NOT Created';
		}

	}
	
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php include($cms_root_url . '/components/meta.php'); ?>
<link href="<?php echo $cms_abs_url ?>/css/page.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
function generate_url() {
	// Retrieve entered value
	var x=document.addform.page_title.value;
	if(document.addform.page_url.value == "") {
		// Convert to lower case
		x=x.toLowerCase();
		// Remove apostrophes
		x=x.replace(/'/g,'');
		// Replace non alpha-numeric characters with hyphens (one per group of invalid characters)
		x=x.replace(/[^a-zA-Z0-9]+/g,'-');
		// Trim leading or trailing underscores
		x=x.replace(/^_+|_+$/g,"");
		document.addform.page_url.value = x;
	}
}
</script>
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
				<h1>Add Content Page</h1>
				<p>Create a new content page</p>
			</div>
			
			<p><strong>Please Note:</strong> fields marked <img src="../images/icon-required-field.gif" alt="This is a required field and *MUST* be completed" name="required-field-icon" width="18" height="18" hspace="5" vspace="0" border="0" align="middle" /> are required!</p>
			
<form action="page-add.php" name="addform" method="post">

Enter a Page Title<br />
<input name="page_title" type="text" size="80" maxlength="100" value="<?php echo stripslashes($_POST['page_title']); ?>" onblur="generate_url()"  />
<img src="../images/icon-required-field.gif" alt="This is a required field and *MUST* be completed" name="required-field-icon" width="18" height="18" hspace="5" vspace="0" border="0" style="vertical-align:top;" /><br /><br />

Enter a Page URL<br />
<input name="page_url" type="text" size="80" maxlength="100" value="<?php echo stripslashes($_POST['page_url']); ?>" />
<img src="../images/icon-required-field.gif" alt="This is a required field and *MUST* be completed" name="required-field-icon" width="18" height="18" hspace="5" vspace="0" border="0" style="vertical-align:top;" /><br /><br />

Enter a Page Description<br />
<input name="page_description" type="text" size="80" maxlength="150" value="<?php echo stripslashes($_POST['page_description']); ?>" />
<img src="../images/icon-required-field.gif" alt="This is a required field and *MUST* be completed" name="required-field-icon" width="18" height="18" hspace="5" vspace="0" border="0" style="vertical-align:top;" /><br /><br />

Enter Page Keywords<br />
<textarea name="page_keywords" rows="2" cols="60" /><?php echo stripslashes($_POST['page_keywords']); ?></textarea><br /><br />

Enter Page Content<br />
<?php
$oFCKeditor = new FCKeditor('page_content');
$oFCKeditor->BasePath = $cms_abs_url . '/fckeditor/';
$oFCKeditor->Config["CustomConfigurationsPath"] = $cms_abs_url . '/fckconfig/editorconfig.js';
$oFCKeditor->Width = '721';
$oFCKeditor->Height = '400';
// Add content if posted
if($_POST['page_content']) {
	$oFCKeditor->Value = stripslashes($_POST['page_content']);
}
$oFCKeditor->Create();
?>
<img src="../images/icon-required-field.gif" alt="This is a required field and *MUST* be completed" name="required-field-icon" width="18" height="18" hspace="5" vspace="0" border="0" style="vertical-align:top;" /><br /><br />

<input type="hidden" name="submitted" value="TRUE" />
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