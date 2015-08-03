<?php session_start();

include(dirname(__FILE__) . '/../config/config.php');

if (!$_SESSION['uid']) {
header ("Location:$cms_abs_url/index.php");
}

/* Generate Menus */
$HTTP_SESSION_VARS['T'] = 'data';
$HTTP_SESSION_VARS['S'] = 'rooms';
include($cms_root_url . '/components/menu-script.php');
include($cms_root_url . '/components/log-script.php');


require_once('../ScriptLibrary/incPureUpload.php');
require_once('../ScriptLibrary/incResize.php');
// Pure PHP Upload 2.1.8
$ppu = new pureFileUpload();
$ppu->path = "../../images/rooms";
$ppu->extensions = "JPG,JPEG";
$ppu->formName = "addform";
$ppu->storeType = "file";
$ppu->sizeLimit = "";
$ppu->nameConflict = "uniq";
$ppu->requireUpload = "true";
$ppu->minWidth = "30";
$ppu->minHeight = "30";
$ppu->maxWidth = "30";
$ppu->maxHeight = "30";
$ppu->saveWidth = "";
$ppu->saveHeight = "";
$ppu->timeout = "600";
$ppu->progressBar = "fileCopyProgress.htm";
$ppu->progressWidth = "300";
$ppu->progressHeight = "100";
$ppu->redirectURL = "";
$ppu->checkVersion("2.1.8");
$ppu->doUpload();

if (isset($editFormAction)) {
  if (isset($_SERVER['QUERY_STRING'])) {
	  if (!eregi("GP_upload=true", $_SERVER['QUERY_STRING'])) {
  	  $editFormAction .= "&GP_upload=true";
		}
  } else {
    $editFormAction .= "?GP_upload=true";
  }
}


// Include DB Connection.
require($cms_root_url . '/components/mysql_connect.inc');


if ($_POST['submitted']) {
	
	// Validation	
	if (!$erun && empty($_POST['room_name'])) {
		$erun = "Please enter a room name";
	}
	
	
	if (!$erun) {
		$query = sprintf("INSERT INTO rooms (room_name, room_image) VALUES ('%s', '%s')",
		mysql_real_escape_string(stripslashes($_POST['room_name'])),
		mysql_real_escape_string(stripslashes($_POST['room_image'])));
	
		$result = mysql_query($query);
		
		if ($result) {
			$erun = 'Room Added';
			$srun = "Room &quot;" . mysql_real_escape_string(stripslashes($_POST['room_name'])) . "&quot; Added";
			include($cms_root_url . '/components/log-script.php');
		} 
		else {
			$erun = 'Error, Room NOT Saved';
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
<script language='JavaScript' src='../ScriptLibrary/incPureUpload.js' type="text/javascript"></script>
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
                    <h1>Create Product Type </h1>
                    <p>Create a new product type.</p>
                </div>
                
                <p><strong>Please Note:</strong> fields marked <img src="../images/icon-required-field.gif" alt="This is a required field and *MUST* be completed" name="required-field-icon" width="18" height="18" hspace="5" vspace="0" border="0" align="middle" /> are required!</p>
                
<form action="<?php echo $GP_uploadAction; ?>" method="post" enctype="multipart/form-data" name="addform" onsubmit="checkFileUpload(this,'JPG,JPEG',true,'','30','30','30','30','','');showProgressWindow('fileCopyProgress.htm',300,100);return document.MM_returnValue">
	
Enter a Product Type Name<br />
<input type="text" name="room_name" size="80" maxlength="200" value="<?php echo stripslashes($_POST['room_name']); ?>" />
<img src="../images/icon-required-field.gif" alt="This is a required field and *MUST* be completed" name="required-field-icon" width="18" height="18" hspace="5" vspace="0" border="0" style="vertical-align:top;" /><br /><br />

Upload a Icon Image <em>(30x30 pixels)</em><br />
<input name="room_image" type="file" onchange="checkOneFileUpload(this,'JPG,JPEG',true,'','30','30','30','30','','')" />
<img src="../images/icon-required-field.gif" alt="This is a required field and *MUST* be completed" name="required-field-icon" width="18" height="18" hspace="5" vspace="0" border="0" style="vertical-align:top;" /><br /><br />

<input name="submitted" type="hidden" value="TRUE" />
<input name="submit" type="submit" value="Create Product Type" />

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