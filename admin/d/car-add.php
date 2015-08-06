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


// Include DB Connection.
require($cms_root_url . '/components/mysql_connect.inc');


if ($_POST['submitted']) {
	
	
	
	
	
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
		$query = sprintf("INSERT INTO ranges (manufacturer_id, 
											  range_name, 
											  range_british_wool, 
											  range_wow, 
											  range_pet, 
											  pile_id,
											  range_pile_weight,
											  range_width,
											  range_style,
											  range_backing,
											  range_type,
											  room_id,
											  range_warranty,
											  range_half_roll_price,
											  range_roll_price,
											  range_cut_price,
											  range_resell_price,
											  range_on_sale,
											  range_sale_discount) 
						 VALUES ('%s', 
								 '%s', 
								 '%s',
								 '%s',
								 '%s',
								 '%s', 
								 '%s', 
								 '%s', 
								 '%s', 
								 '%s',
								 '%s',
								 '%s',
								 '%s',
								 '%s',
								 '%s',
								 '%s',
								 '%s',
								 '%s',
								 '%s')",
		mysql_real_escape_string($_POST['manufacturer_id']),
		mysql_real_escape_string(stripslashes($_POST['range_name'])),
		mysql_real_escape_string($_POST['range_british_wool']),
		mysql_real_escape_string($_POST['range_wow']),
		mysql_real_escape_string($_POST['range_pet']),
		mysql_real_escape_string($_POST['pile_id']),
		mysql_real_escape_string(stripslashes($_POST['range_pile_weight'])),
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
		mysql_real_escape_string(stripslashes($_POST['range_sale_discount'])));
	
		$result = mysql_query($query);
		
		if ($result) {
			$erun = 'Range Created';
			$srun = "Range &quot;" . mysql_real_escape_string(stripslashes($_POST['range_name'])) . "&quot; Created";
			include($cms_root_url . '/components/log-script.php');
		} 
		else {
			$erun = 'Error, Range NOT Created';
		}
	}

} 

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
                    <h1>Add Range</h1>
                    <p>Create a new range.</p>
                </div>
                
                <p><strong>Please Note:</strong> fields marked <img src="../images/icon-required-field.gif" alt="This is a required field and *MUST* be completed" name="required-field-icon" width="18" height="18" hspace="5" vspace="0" border="0" align="middle" /> are required!</p>
                
<form action="" method="post">


Enter the Unique Vehicle ID<br />
<input type="text" name="range_name" size="50" maxlength="50" value="" /><br /><br />

Enter the Full Registration<br />
<input type="text" name="range_name" size="20" maxlength="20" value="" /><br /><br />

Enter the Colour<br />
<input type="text" name="range_name" size="60" maxlength="60" value="" /><br /><br />

Enter the Fuel Type<br />
<select name="FuelType">
<option value="Bi Fuel">Bi Fuel</option>
<option value="Diesel">Diesel</option>
<option value="Dual Fuel">Dual Fuel</option>
<option value="Electric">Electric</option>
<option value="Hybrid">Hybrid</option>
<option value="LPG">LPG</option>
<option value="LPG G3">LPG G3</option>
<option value="Petrol" selected="selected">Petrol</option>
</select><br /><br />

Enter the Year<br />
<input type="text" name="range_name" size="4" maxlength="4" value=""  /><br /><br />

Enter the Mileage *Number only<br />
<input type="text" name="range_name" size="10" maxlength="10" value=""  /><br /><br />

Enter the Body Type *No Doors Info<br />
<input type="text" name="range_name" size="30" maxlength="30" value=""  /><br /><br />

Enter the Number of Doors *Number only<br />
<input type="text" name="range_name" size="1" maxlength="1" value=""  /><br /><br />

Enter the Make<br />
<input type="text" name="range_name" size="50" maxlength="50" value=""  /><br /><br />

Enter the Model<br />
<input type="text" name="range_name" size="50" maxlength="50" value=""  /><br /><br />

Enter the Variant<br />
<input type="text" name="range_name" size="75" maxlength="75" value=""  /><br /><br />

Enter the Engine Size *Number only<br />
<input type="text" name="range_name" size="4" maxlength="4" value=""  /><br /><br />

Enter the Price (&pound;) *Number only - Do not include &pound; sign, commas or decimal places<br />
<input type="text" name="range_name" size="10" maxlength="10" value=""  /><br /><br />

Enter the Transmission<br />
<select name="Transmission">
<option value="Manual" selected="selected">Manual</option>
<option value="Automatic">Automatic</option>
</select><br /><br />

Upload Image 1<br />
<input type="file" name="image1" /><br /><br />

Upload Image 2<br />
<input type="file" name="image2" /><br /><br />

Upload Image 3<br />
<input type="file" name="image3" /><br /><br />

Upload Image 4<br />
<input type="file" name="image4" /><br /><br />

Service History?<br />
<select name="ServiceHistory">
<option value="1" selected="selected">Yes</option>
<option value="0">No</option>
</select><br /><br />

Enter the Number Previous Owners *Number only<br />
<input type="text" name="range_name" size="1" maxlength="1" value="1"  /><br /><br />

Enter the Category<br />
<select name="Category">
<option value="CARS" selected="selected">Cars</option>
<option value="BIKE">Bike</option>
<option value="COMM">Comm</option>
</select><br /><br />

Four Wheel Drive?<br />
<select name="FourWheelDrive">
<option value="1" selected="selected">Yes</option>
<option value="0">No</option>
</select><br /><br />

Options - List format seperated by commas<br />
<textarea name="Options" maxlength="1000">Anti-Lock Brakes,Alarm,Alloy Wheels,Automatic Gearbox,Sony CD,Central Locking</textarea><br /><br />

Comments - Any additional text such as Price excludes VAT etc (this field must not contain any data that appears already in the advert).<br />
<textarea name="Comments" maxlength="1500"></textarea><br /><br />

New?<br />
<select name="New">
<option value="Y" >Yes</option>
<option value="N" selected="selected">No</option>
</select><br /><br />

Used?<br />
<select name="Used">
<option value="Y" selected="selected">Yes</option>
<option value="N" >No</option>
</select><br /><br />

Site?<br />
<select name="Site">
<option value="C" >Consumer</option>
<option value="T" >Traderlink</option>
<option value="B" selected="selected" >Both</option>
</select><br /><br />

Origin?<br />
<select name="Origin">
<option value="UK" selected="selected">UK</option>
<option value="Parallel Import" >Parallel Import</option>
<option value="grey Import" >Grey Import</option>
</select><br /><br />

Does the vehicle have a V5 document?<br />
<select name="V5">
<option value="Y" selected="selected">Yes</option>
<option value="N" >No</option>
</select><br /><br />

Enter the Condition of the Vehicle<br />
<input type="text" name="range_name" size="100" maxlength="100" value=""  /><br /><br />

Is the vehicle ex-demo?<br />
<select name="ExDemo">
<option value="Y" >Yes</option>
<option value="N" selected="selected">No</option>
</select><br /><br />

Is the vehicle Franchise Approved?<br />
<select name="FranchiseApproved">
<option value="Y" >Yes</option>
<option value="N" selected="selected">No</option>
</select><br /><br />

Price for the Traderlink site *Number only - Do not include &pound; sign, commas or decimal places<br />
<input type="text" name="range_name" size="10" maxlength="10" value=""  /><br /><br />

Extra price text (Traderlink site only)<br />
<input type="text" name="range_name" size="20" maxlength="20" value=""  /><br /><br />

Service History<br />
<select name="ServiceHistoryText">
<option value="Full service history" selected="selected">Full service history</option>
<option value="Full dealership history" >Full dealership history</option>
<option value="Service History" >Service history</option>
<option value="Part service history" >Part service history</option>
</select><br /><br />

Enter the CAP ID *Number only<br />
<input type="text" name="range_name" size="10" maxlength="10" value=""  /><br /><br />

Enter the unique selling point of that vehicle in the title to really grab buyers attention to make sure they click to find out more about your car.<br />
<textarea name="Attention_Grabber" maxlength="30"></textarea>
<br /><br />

<input name="submitted" type="hidden" value="TRUE" />
<input name="submit" type="submit" value="Save Range" />

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