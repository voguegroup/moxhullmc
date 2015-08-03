<?php session_start();

include(dirname(__FILE__) . '/../config/config.php');

if (!$_SESSION['uid']) {
header ("Location:$cms_abs_url/index.php");
}

/* Generate Menus */
$HTTP_SESSION_VARS['T'] = 'data';
$HTTP_SESSION_VARS['S'] = 'ranges';
include($cms_root_url . '/components/menu-script.php');
include($cms_root_url . '/components/log-script.php');


$range_id = $_GET['edit'];


// Include DB Connection.
require($cms_root_url . '/components/mysql_connect.inc');


if ($_POST['submitted']) {
	
	
	$updated_room_array = '|';
	$query = "SELECT * FROM rooms ORDER BY room_name ASC";
	$result = mysql_query($query);
	while($row = mysql_fetch_assoc($result)) {
		if (isset($_POST['room' . $row['room_id']])) {
			$updated_room_array .= $row['room_id'] . '|';
		}
	}
	
	
	// Validation	
	if (!$erun && empty($_POST['manufacturer_id'])) {
		$erun = "Please select a manufacturer";
	}
	
	if (!$erun && empty($_POST['range_name'])) {
		$erun = "Please enter a range name";
	}
	
	if (!$erun && empty($_POST['pile_id'])) {
		$erun = "Please select a pile content";
	}
	
	if (!$erun && empty($_POST['range_width'])) {
		$erun = "Please select a width";
	}
	
	if (!$erun && empty($_POST['range_style'])) {
		$erun = "Please enter some information about the style";
	}
	
	if (!$erun && empty($_POST['range_backing'])) {
		$erun = "Please enter some information about the backing";
	}
	
	if (!$erun && empty($_POST['range_type'])) {
		$erun = "Please select the range type";
	}
	
	if (!$erun && (strlen($updated_room_array) == 1)) {
		$erun = "Please select where this range will be used";
	}
	
	if (!$erun && empty($_POST['range_warranty'])) {
		$erun = "Please enter some information about the warranty";
	}
	
	if (!$erun && !is_numeric($_POST['range_half_roll_price'])) {
		$erun = "Please enter a half roll price";
	}
	
	if (!$erun && !is_numeric($_POST['range_roll_price'])) {
		$erun = "Please enter a full roll price";
	}
	
	if (!$erun && !is_numeric($_POST['range_cut_price'])) {
		$erun = "Please enter a cut price";
	}
	
	if (!$erun && !is_numeric($_POST['range_resell_price'])) {
		$erun = "Please enter a resell price";
	}
	
	if (isset($_POST['range_on_sale'])) {
		$range_on_sale = 'Y';	
	}
	else {
		$range_on_sale = 'N';
	}
	
	
	if (!$erun) {
		$query = sprintf("UPDATE ranges SET manufacturer_id='%s', 
											range_name='%s', 
											range_british_wool='%s', 
											range_wow='%s', 
											range_pet='%s', 
											pile_id='%s',
											range_pile_weight='%s',
											range_width='%s',
											range_style='%s',
											range_backing='%s',
											range_type='%s',
											room_id='%s',
											range_warranty='%s',
											range_half_roll_price='%s',
											range_roll_price='%s',
											range_cut_price='%s',
											range_resell_price='%s',
											range_on_sale='%s',
											range_sale_discount='%s' 
		                  WHERE range_id='%s'",
		mysql_real_escape_string($_POST['manufacturer_id']),
		mysql_real_escape_string(stripslashes($_POST['range_name'])),
		mysql_real_escape_string($_POST['range_british_wool']),
		mysql_real_escape_string($_POST['range_wow']),
		mysql_real_escape_string($_POST['range_pet']),
		mysql_real_escape_string($_POST['pile_id']),
		mysql_real_escape_string($_POST['range_pile_weight']),
		mysql_real_escape_string($_POST['range_width']),
		mysql_real_escape_string(stripslashes($_POST['range_style'])),
		mysql_real_escape_string(stripslashes($_POST['range_backing'])),
		mysql_real_escape_string($_POST['range_type']),
		mysql_real_escape_string($updated_room_array),
		mysql_real_escape_string(stripslashes($_POST['range_warranty'])),
		mysql_real_escape_string($_POST['range_half_roll_price']),
		mysql_real_escape_string($_POST['range_roll_price']),
		mysql_real_escape_string($_POST['range_cut_price']),
		mysql_real_escape_string($_POST['range_resell_price']),
		mysql_real_escape_string($range_on_sale),
		mysql_real_escape_string(stripslashes($_POST['range_sale_discount'])),
		mysql_real_escape_string($range_id));
	
		$result = mysql_query($query);
		
		if ($result) {
			$erun = 'Range Saved';
			$srun = "Range &quot;" . mysql_real_escape_string(stripslashes($_POST['range_name'])) . "&quot; Edited";
			include($cms_root_url . '/components/log-script.php');
		} 
		else {
			$erun = 'Error, Range NOT Saved';
		}
	}

} 


$query = "SELECT * FROM ranges WHERE range_id=" . mysql_real_escape_string($range_id);

$result = mysql_query($query);

while ($row = mysql_fetch_assoc($result)) {

	$manufacturer_id = $row['manufacturer_id'];
	$range_name = $row['range_name'];
	$range_british_wool = $row['range_british_wool'];
	$pile_id = $row['pile_id'];
	$range_pile_weight = $row['range_pile_weight'];
	$range_width = $row['range_width'];
	$range_style = $row['range_style'];
	$range_backing = $row['range_backing'];
	$range_type = $row['range_type'];
	$room_id = $row['room_id'];
	$room_array = substr($room_id, 1, -1);
	$room_array = explode('|', $room_array);
	$range_warranty = $row['range_warranty'];
	$range_half_roll_price = $row['range_half_roll_price'];
	$range_roll_price = $row['range_roll_price'];
	$range_cut_price = $row['range_cut_price'];
	$range_resell_price = $row['range_resell_price'];
	$range_on_sale = $row['range_on_sale'];
	$range_sale_discount = $row['range_sale_discount'];

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
                    <h1>Edit Range</h1>
                    <p>Modify an existing range.</p>
                </div>
                
                <p><strong>Please Note:</strong> fields marked <img src="../images/icon-required-field.gif" alt="This is a required field and *MUST* be completed" name="required-field-icon" width="18" height="18" hspace="5" vspace="0" border="0" align="middle" /> are required!</p>
                
<form action="" method="post">

  <p>Select a Manufacturer<br />
      <select name="manufacturer_id" size="1">
        <option value="">-- Select --</option>
        <?php
		$query = "SELECT * FROM manufacturers ORDER BY manufacturer_name ASC";
		$result = mysql_query($query);
		while($row = mysql_fetch_assoc($result)) {
			echo '<option value="' . $row['manufacturer_id'] . '"';
			if ($manufacturer_id == $row['manufacturer_id']) {
				echo ' selected="selected"';	
			}
			echo '>' . $row['manufacturer_name'] . '</option>';	
		}
	?>
      </select>
      <img src="../images/icon-required-field.gif" alt="This is a required field and *MUST* be completed" name="required-field-icon" width="18" height="18" hspace="5" vspace="0" border="0" style="vertical-align:top;" /><br />
    <br />
    
    Enter a Range Name<br />
  <input type="text" name="range_name" size="80" maxlength="200" value="<?php echo stripslashes($range_name); ?>" />
  <img src="../images/icon-required-field.gif" alt="This is a required field and *MUST* be completed" name="required-field-icon" width="18" height="18" hspace="5" vspace="0" border="0" style="vertical-align:top;" /><br />
  <br />
    
    Is This Range Made from British Wool?<br />
  <input type="radio" name="range_british_wool" value="Y" <?php if ($range_british_wool == 'Y') { echo 'checked="checked"'; } ?> />
    Yes<br />
  <input type="radio" name="range_british_wool" value="N" <?php if (!isset($range_british_wool) || $range_british_wool == 'N') { echo 'checked="checked"'; } ?> />
    No<br /><br />
    Is This A WOW Product?<br />
  <input type="radio" name="range_wow" value="Y" <?php if ($_POST['range_wow'] == 'Y') { echo 'checked="checked"'; } ?> />Yes<br />
  <input type="radio" name="range_wow" value="N" <?php if (!isset($_POST['range_wow']) || $_POST['range_wow'] == 'N') { echo 'checked="checked"'; } ?> />No<br /><br />
  Is This A Pet and Family Product?<br />
<input type="radio" name="range_pet" value="Y" <?php if ($_POST['range_pet'] == 'Y') { echo 'checked="checked"'; } ?> />Yes<br />
<input type="radio" name="range_pet" value="N" <?php if (!isset($_POST['range_pet']) || $_POST['range_pet'] == 'N') { echo 'checked="checked"'; } ?> />No<br /><br />
  Select a Suitability <br />
    <select name="pile_id" size="1">
      <option value="">-- Select --</option>
      <?php
		$query = "SELECT * FROM piles ORDER BY pile_name ASC";
		$result = mysql_query($query);
		while($row = mysql_fetch_assoc($result)) {
			echo '<option value="' . $row['pile_id'] . '"';
			if ($pile_id == $row['pile_id']) {
				echo ' selected="selected"';	
			}
			echo '>' . $row['pile_name'] . '</option>';	
		}
	?>
    </select>
    <img src="../images/icon-required-field.gif" alt="This is a required field and *MUST* be completed" name="required-field-icon" width="18" height="18" hspace="5" vspace="0" border="0" id="required-field-icon" style="vertical-align:top;" /></p>
  <p><br />
    
    Enter pile weight:<br />
    <input type="text" name="range_pile_weight" size="40" maxlength="200" value="<?php echo stripslashes($range_pile_weight); ?>" />
    <br />
    <br />
    Select a Width<br />
    <select name="range_width" size="1">
      <option value="2m, 3m or 4m" selected="selected">2m, 3m or 4m</option>
      <option value="2m">2m</option>
      <option value="3m">3m</option>
      <option value="4m">4m</option>
      <option value="4m, 5m" <?php if ($_POST['range_width'] == '4m, 5m') { echo 'selected="selected"'; } ?>>4m, 5m</option>
      <option value="5m">5m</option>
      <option value="Tiles: Standard Box">Tiles: Standard Box</option>
    </select>
    <img src="../images/icon-required-field.gif" alt="This is a required field and *MUST* be completed" name="required-field-icon" width="18" height="18" hspace="5" vspace="0" border="0" id="required-field-icon" style="vertical-align:top;" /><br />
    <br />
    Enter a Style<br />
    <input type="text" name="range_style" size="80" maxlength="200" value="<?php echo stripslashes($range_style); ?>" />
    <img src="../images/icon-required-field.gif" alt="This is a required field and *MUST* be completed" name="required-field-icon" width="18" height="18" hspace="5" vspace="0" border="0" style="vertical-align:top;" /><br />
    <br />
    Enter a Backing<br />
    <input type="text" name="range_backing" size="80" maxlength="200" value="<?php echo stripslashes($range_backing); ?>" />
    <img src="../images/icon-required-field.gif" alt="This is a required field and *MUST* be completed" name="required-field-icon" width="18" height="18" hspace="5" vspace="0" border="0" style="vertical-align:top;" /><br />
    <br />
    Select the Range Type<br />
    <select name="range_type" size="1">
      <option value="">-- Select --</option>
      <option value="Domestic" <?php if ($range_type == 'Domestic') { echo 'selected="selected"'; } ?>>Domestic</option>
      <option value="Heavy Domestic" <?php if ($range_type == 'Heavy Domestic') { echo 'selected="selected"'; } ?>>Heavy Domestic</option>
      <option value="Extra Heavy Domestic" <?php if ($range_type == 'Extra Heavy Domestic') { echo 'selected="selected"'; } ?>>Extra Heavy Domestic</option>
      <option value="Commercial" <?php if ($range_type == 'Commercial') { echo 'selected="selected"'; } ?>>Commercial</option>
      <option value="Heavy Commercial" <?php if ($range_type == 'Heavy Commercial') { echo 'selected="selected"'; } ?>>Heavy Commercial</option>
      <option value="Extra Heavy Commercial" <?php if ($range_type == 'Extra Heavy Commercial') { echo 'selected="selected"'; } ?>>Extra Heavy Commercial</option>
    </select>
    <img src="../images/icon-required-field.gif" alt="This is a required field and *MUST* be completed" name="required-field-icon" width="18" height="18" hspace="5" vspace="0" border="0" style="vertical-align:top;" /><br />
    <br />
    Select What Type of Product <img src="../images/icon-required-field.gif" alt="This is a required field and *MUST* be completed" name="required-field-icon" width="18" height="18" hspace="5" vspace="0" border="0" style="vertical-align:top;" /><br />
    <?php
	$query = "SELECT * FROM rooms ORDER BY room_name ASC";
	$result = mysql_query($query);
	while($row = mysql_fetch_assoc($result)) {
		echo '<input type="checkbox" name="room' . $row['room_id'] . '"';
		if (in_array($row['room_id'], $room_array)) {
			echo ' checked="checked"';	
		}
		echo ' /> ' . $row['room_name'] . '<br />';	
	}
?>
    <br />
    Enter Warranty Details<br />
    <input type="text" name="range_warranty" size="80" maxlength="200" value="<?php echo stripslashes($range_warranty); ?>" />
    <img src="../images/icon-required-field.gif" alt="This is a required field and *MUST* be completed" name="required-field-icon" width="18" height="18" hspace="5" vspace="0" border="0" style="vertical-align:top;" /><br />
    <br />
    Enter Half Roll Price<br />
    &pound;
    <input type="text" name="range_half_roll_price" size="6" maxlength="6" value="<?php echo stripslashes($range_half_roll_price); ?>" />
    <img src="../images/icon-required-field.gif" alt="This is a required field and *MUST* be completed" name="required-field-icon" width="18" height="18" hspace="5" vspace="0" border="0" style="vertical-align:top;" /><br />
    <br />
    Enter Full Roll Price<br />
    &pound;
    <input type="text" name="range_roll_price" size="6" maxlength="6" value="<?php echo stripslashes($range_roll_price); ?>" />
    <img src="../images/icon-required-field.gif" alt="This is a required field and *MUST* be completed" name="required-field-icon" width="18" height="18" hspace="5" vspace="0" border="0" style="vertical-align:top;" /><br />
    <br />
    Enter Cut Price<br />
    &pound;
    <input type="text" name="range_cut_price" size="6" maxlength="6" value="<?php echo stripslashes($range_cut_price); ?>" />
    <img src="../images/icon-required-field.gif" alt="This is a required field and *MUST* be completed" name="required-field-icon" width="18" height="18" hspace="5" vspace="0" border="0" style="vertical-align:top;" /><br />
    <br />
    Enter Resell Price<br />
    &pound;
    <input type="text" name="range_resell_price" size="6" maxlength="6" value="<?php echo stripslashes($range_resell_price); ?>" />
    <img src="../images/icon-required-field.gif" alt="This is a required field and *MUST* be completed" name="required-field-icon" width="18" height="18" hspace="5" vspace="0" border="0" style="vertical-align:top;" /><br />
    <br />
    Is This Range on Sale?<br />
    <input type="checkbox" name="range_on_sale" <?php if ($range_on_sale=="Y") { echo 'checked="checked"'; } ?> />
    <br />
    <br />
    Percentage Discount When on Sale<br />
    <input type="text" name="range_sale_discount" size="3" maxlength="3" value="<?php echo stripslashes($range_sale_discount); ?>" />
    % <br />
    <br />
    
    
    <input name="submitted" type="hidden" value="TRUE" />
    <input name="submit" type="submit" value="Save Range" />
  </p>
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