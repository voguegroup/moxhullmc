<?php session_start();

include('../config/config.php');

if (!$_SESSION['uid']) {
header ("Location:$cms_abs_url/index.php");
}

/* Generate Menus */
$HTTP_SESSION_VARS['T'] = 'data';
$HTTP_SESSION_VARS['S'] = 'ranges';
include('../components/menu-script.php');
include('../components/log-script.php');


if ($_POST['submitted']) {
	$query = $dbo->prepare("INSERT INTO stock (Feed_ID,
  Vehicle_ID,
  FullRegistration,
  Colour,
  FuelType,
  Year,
  Mileage,
  BodyType,
  Doors,
  Make,
  Model,
  Variant,
  EngineSize,
  Price,
  Transmission,
  PictureRefs,
  ServiceHistory,
  PreviousOwners,
  Category,
  FourWheelDrive,
  Options,
  Comments,
  New,
  Used,
  Site,
  Origin,
  V5,
  Condition,
  ExDemo,
  FranchiseApproved,
  TradePrice,
  TradePriceExtra,
  ServiceHistoryText,
  Capid,
  Attention_Grabber) 
						 VALUES (:Feed_ID,
  :Vehicle_ID,
  :FullRegistration,
  :Colour,
  :FuelType,
  :Year,
  :Mileage,
  :BodyType,
  :Doors,
  :Make,
  :Model,
  :Variant,
  :EngineSize,
  :Price,
  :Transmission,
  :PictureRefs,
  :ServiceHistory,
  :PreviousOwners,
  :Category,
  :FourWheelDrive,
  :Options,
  :Comments,
  :New,
  :Used,
  :Site,
  :Origin,
  :V5,
  :Condition,
  :ExDemo,
  :FranchiseApproved,
  :TradePrice,
  :TradePriceExtra,
  :ServiceHistoryText,
  :Capid,
  :Attention_Grabber)");
  
  $query->execute(array(
":Feed_ID" => '0', //change to Al's ID
":Vehicle_ID" => '0',
":FullRegistration" => '0',
":Colour" => '0',
":FuelType" => '0',
":Year" => '0',
":Mileage" => '0',
":BodyType" => '0',
":Doors" => '0',
":Make" => '0',
":Model" => '0',
":Variant" => '0',
":EngineSize" => '0',
":Price" => '0',
":Transmission" => '0',
":PictureRefs" => '0',
":ServiceHistory" => '0',
":PreviousOwners" => '0',
":Category" => '0',
":FourWheelDrive" => '0',
":Options" => '0',
":Comments" => '0',
":New" => '0',
":Used" => '0',
":Site" => '0',
":Origin" => '0',
":V5" => '0',
":Condition" => '0',
":ExDemo" => '0',
":FranchiseApproved" => '0',
":TradePrice" => '0',
":TradePriceExtra" => '0',
":ServiceHistoryText" => '0',
":Capid" => '0',
":Attention_Grabber" => '0' )); 
	
	if($query) {
			$erun = 'Vehicle Created';
			$srun = "Vehicle &quot;" . $_POST['Make'] . "&quot; Created";
			include('../components/log-script.php');
	 } else {
		 
		 	$erun = 'Error, Range NOT Created ' . $query->errorCode();
	
		
	}
		
		

} 

?><!DOCTYPE html>
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
<link href="<?php echo $cms_abs_url ?>/css/page.css" rel="stylesheet" type="text/css" />
<script language='JavaScript' src='../ScriptLibrary/incPureUpload.js' type="text/javascript"></script>
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
                    <h1>Add Range</h1>
                    <p>Create a new range.</p>
                </div>
                
                <p><strong>Please Note:</strong> fields marked <img src="../images/icon-required-field.gif" alt="This is a required field and *MUST* be completed" name="required-field-icon" width="18" height="18" hspace="5" vspace="0" border="0" align="middle" /> are required!</p>
                
<form action="" method="post" enctype="multipart/form-data">


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
<input type="text" name="range_name" size="50" maxlength="50" value=""  /><img src="../images/icon-required-field.gif" alt="This is a required field and *MUST* be completed" name="required-field-icon" width="18" height="18" hspace="5" vspace="0" border="0" align="middle" /><br /><br />

Enter the Model<br />
<input type="text" name="range_name" size="50" maxlength="50" value=""  /><img src="../images/icon-required-field.gif" alt="This is a required field and *MUST* be completed" name="required-field-icon" width="18" height="18" hspace="5" vspace="0" border="0" align="middle" /><br /><br />

Enter the Variant<br />
<input type="text" name="range_name" size="75" maxlength="75" value=""  /><br /><br />

Enter the Engine Size *Number only<br />
<input type="text" name="range_name" size="4" maxlength="4" value=""  /><br /><br />

Enter the Price (&pound;) *Number only - Do not include &pound; sign, commas or decimal places<br />
<input type="text" name="range_name" size="10" maxlength="10" value=""  /><img src="../images/icon-required-field.gif" alt="This is a required field and *MUST* be completed" name="required-field-icon" width="18" height="18" hspace="5" vspace="0" border="0" align="middle" /><br /><br />

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
	<?php include('../components/footer.php'); ?>
</div>

</body>
</html>