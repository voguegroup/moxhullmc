<?php session_start();

include(dirname(__FILE__) . '/../config/config.php');

if (!$_SESSION['uid']) {
header ("Location:$cms_abs_url/index.php");
}

/* Generate Menus */
$HTTP_SESSION_VARS['T'] = 'data';
$HTTP_SESSION_VARS['S'] = 'products';
include($cms_root_url . '/components/menu-script.php');
include($cms_root_url . '/components/log-script.php');


$product_id = $_GET['edit'];


// Include DB Connection.
require($cms_root_url . '/components/mysql_connect.inc');


require_once('../ScriptLibrary/incPureUpload.php');
require_once('../ScriptLibrary/incResize.php');
// Pure PHP Upload 2.1.8
$ppu = new pureFileUpload();
$ppu->path = "../../images/products";
$ppu->extensions = "JPG,JPEG";
$ppu->formName = "editform";
$ppu->storeType = "file";
$ppu->sizeLimit = "";
$ppu->nameConflict = "uniq";
$ppu->requireUpload = "true";
$ppu->minWidth = "";
$ppu->minHeight = "";
$ppu->maxWidth = "";
$ppu->maxHeight = "";
$ppu->saveWidth = "";
$ppu->saveHeight = "";
$ppu->timeout = "600";
$ppu->progressBar = "fileCopyProgress.htm";
$ppu->progressWidth = "300";
$ppu->progressHeight = "100";
$ppu->redirectURL = "";
$ppu->checkVersion("2.1.8");
$ppu->doUpload();

// Smart Image Processor 1.0.7
if (isset($HTTP_GET_VARS['GP_upload'])) {
  $sip = new resizeUploadedFiles($ppu);
  $sip->component = "GD2";
  $sip->resizeImages = "false";
  $sip->aspectImages = "true";
  $sip->maxWidth = "";
  $sip->maxHeight = "";
  $sip->quality = "80";
  $sip->makeThumb = "true";
  $sip->pathThumb = "../../images/products/thumbs";
  $sip->aspectThumb = "true";
  $sip->naming = "prefix";
  $sip->suffix = "small_";
  $sip->maxWidthThumb = "180";
  $sip->maxHeightThumb = "180";
  $sip->qualityThumb = "100";
  $sip->checkVersion("1.0.7");
  $sip->doResize();
}

if (isset($editFormAction)) {
  if (isset($_SERVER['QUERY_STRING'])) {
	  if (!eregi("GP_upload=true", $_SERVER['QUERY_STRING'])) {
  	  $editFormAction .= "&GP_upload=true";
		}
  } else {
    $editFormAction .= "?GP_upload=true";
  }
}


if ($_POST['submitted']) {
	
	// Validation
	if (!$erun && empty($_POST['range_id'])) {
		$erun = "Please select a range";
	}
	
	if (!$erun && empty($_POST['product_name'])) {
		$erun = "Please enter a product name";
	}
	
	if (!$erun && empty($_POST['product_colour'])) {
		$erun = "Please select a product colour";
	}
	
	
	if (!$erun) {
		
		if (empty($_POST['product_gradient'])) {
			$product_gradient = 0;
		}
		else {
			$product_gradient = $_POST['product_gradient'];	
		}
		
		$query = sprintf("UPDATE products SET range_id='%s', 
						 product_name='%s',
						 product_description='%s', 
						 product_colour='%s',
						 product_gradient='%s',
						 product_patterned='%s',
						 product_bestseller='%s', 
						 product_feat='%s', 
						 product_status='%s',
						 product_image='%s'
						 WHERE product_id='%s'",
						 mysql_real_escape_string($_POST['range_id']),
						 mysql_real_escape_string(stripslashes($_POST['product_name'])),
						 mysql_real_escape_string(stripslashes($_POST['product_description'])),
						 mysql_real_escape_string($_POST['product_colour']),
						 mysql_real_escape_string(stripslashes($product_gradient)),
						 mysql_real_escape_string($_POST['product_patterned']),
						 mysql_real_escape_string($_POST['product_bestseller']),
						 mysql_real_escape_string($_POST['product_feat']),
						 mysql_real_escape_string($_POST['product_status']),
						 mysql_real_escape_string(stripslashes($_POST['product_image'])),
						 mysql_real_escape_string($product_id));
	
		$result = mysql_query($query);
		
		if ($result) {
			$erun = 'Product Saved';
			$srun = "Product &quot;" . mysql_real_escape_string(stripslashes($_POST['product_name'])). "&quot; Edited";
			include($cms_root_url . '/components/log-script.php');
		} 
		else {
			echo mysql_error();
			$erun = 'Error, Product NOT Saved';
		}
	}
} 
else {
	if ($_GET['delete_image']) {
		
		$query = "UPDATE products SET product_image='' WHERE product_id=" . mysql_real_escape_string($product_id);
		
		$result = mysql_query($query);
			
		if ($result) {
			$erun = 'Product Image Deleted';
		} 
		else {
			$erun = 'Error, Product Image NOT Deleted';
		}	
		
	}	
}


$query = "SELECT * FROM products WHERE product_id=" . mysql_real_escape_string($product_id);

$result = mysql_query($query);

while ($row = mysql_fetch_assoc($result)) {

	$range_id = $row['range_id'];
	$product_name = $row['product_name'];
	$product_description = $row['product_description'];
	$product_colour = $row['product_colour'];
	$product_gradient = $row['product_gradient'];
	$product_patterned = $row['product_patterned'];
	$product_bestseller = $row['product_bestseller'];
	$product_status = $row['product_status'];
	$product_image = $row['product_image'];
	$product_feat = $row['product_feat'];

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
                    <h1>Edit Product</h1>
                    <p>Modify an existing product.</p>
                </div>
                
                <p><strong>Please Note:</strong> fields marked <img src="../images/icon-required-field.gif" alt="This is a required field and *MUST* be completed" name="required-field-icon" width="18" height="18" hspace="5" vspace="0" border="0" align="middle" /> are required!</p>
                
<form action="<?php echo $GP_uploadAction; ?>" method="post" enctype="multipart/form-data" name="editform" onsubmit="checkFileUpload(this,'JPG,JPEG',true,'','','','','','','');showProgressWindow('fileCopyProgress.htm',300,100);return document.MM_returnValue">

Select a Range<br />
<select name="range_id" size="1">
	<option value="">-- Select --</option>
	<?php
		$query = "SELECT * FROM ranges ORDER BY range_name ASC";
		$result = mysql_query($query);
		while($row = mysql_fetch_assoc($result)) {
			echo '<option value="' . $row['range_id'] . '"';
			if ($range_id == $row['range_id']) {
				echo ' selected="selected"';	
			}
			echo '>' . $row['range_name'] . '</option>';	
		}
	?>
</select>
<img src="../images/icon-required-field.gif" alt="This is a required field and *MUST* be completed" name="required-field-icon" width="18" height="18" hspace="5" vspace="0" border="0" style="vertical-align:top;" /><br /><br />
			
Enter a Product Name<br />
<input name="product_name" type="text" size="80" maxlength="100" value="<?php echo stripslashes($product_name); ?>" />
<img src="../images/icon-required-field.gif" alt="This is a required field and *MUST* be completed" name="required-field-icon" width="18" height="18" hspace="5" vspace="0" border="0" style="vertical-align:top;" /><br /><br />

Enter a Product Description<br />
<textarea name="product_description" rows="5" cols="40"><?php echo stripslashes($product_description); ?></textarea><br /><br />

Select a Colour<br />
<select name="product_colour" size="1">
	<option value="">-- Select --</option>
     <?php
		$query = "SELECT * FROM colours ORDER BY id ASC";
		$result = mysql_query($query);
		while($row = mysql_fetch_assoc($result)) {
			echo '<option value="' . $row['colour'] . '"';
			if ($product_colour == $row['colour']) {
				echo ' selected="selected"';	
			}
			echo '>' . $row['colour'] . '</option>';	
		}
	?>
    
    
    
</select><br /><br />

Enter a Gradient <em>(The higher the value, the higher the product will appear in a search)</em><br />
<input name="product_gradient" type="text" size="1" maxlength="2" value="<?php echo stripslashes($product_gradient); ?>" /><br /><br />

Is This a Patterned Carpet?<br />
<input type="radio" name="product_patterned" value="Y" <?php if ($product_patterned == 'Y') { echo 'checked="checked"'; } ?> />Yes<br />
<input type="radio" name="product_patterned" value="N" <?php if (!isset($product_patterned) || empty($product_patterned) || $product_patterned == 'N') { echo 'checked="checked"'; } ?> />No<br /><br />

Is This Product a Bestseller?<br />
<input type="radio" name="product_bestseller" value="Y" <?php if ($product_bestseller == 'Y') { echo 'checked="checked"'; } ?> />Yes<br />
<input type="radio" name="product_bestseller" value="N" <?php if (!isset($product_bestseller) || empty($product_patterned) || $product_bestseller == 'N') { echo 'checked="checked"'; } ?> />No<br /><br />
Is This Product a Featured Carpet?<br />
<input type="radio" name="product_feat" value="1" <?php if ($product_feat == '1') { echo 'checked="checked"'; } ?> />Yes<br />
<input type="radio" name="product_feat" value="0" <?php if (!isset($product_feat) || empty($product_feat) || $product_feat == '0') { echo 'checked="checked"'; } ?> />No<br /><br />

Status<br />
<select name="product_status" size="1">
	<option value="L" <?php if ($product_status == 'L') { echo 'selected="selected"'; } ?>>Online</option>
    <option value="D" <?php if ($product_status == 'D') { echo 'selected="selected"'; } ?>>Offline</option>
</select><br /><br />

<?php if (empty($product_image)) { ?>
Upload a Product Image<br />
<input name="product_image" type="file" onchange="checkOneFileUpload(this,'JPG,JPEG',true,'','','','','','','')" />
<img src="../images/icon-required-field.gif" alt="This is a required field and *MUST* be completed" name="required-field-icon" width="18" height="18" hspace="5" vspace="0" border="0" style="vertical-align:top;" /><br /><br />
<?php } else { ?>
Current Product Image<br />
<img src="/images/products/thumbs/small_<?php echo $product_image; ?>" alt="" /><br />
<input type="hidden" name="product_image" value="<?php echo $product_image; ?>" />
<a href="products-edit.php?edit=<?php echo $product_id; ?>&amp;delete_image=true">Delete current image and upload a new one</a><br /><br />
<?php } ?>

<input name="submitted" type="hidden" value="TRUE" />
<input name="submit" type="submit" value="Save Product" />

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