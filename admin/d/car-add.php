<?php session_start();

include('../config/config.php');

if (!$_SESSION['uid']) {
header ("Location:$cms_abs_url/index.php");
}

/* Generate Menus */
$HTTP_SESSION_VARS['T'] = 'data';
$HTTP_SESSION_VARS['S'] = 'car';
include('../components/menu-script.php');
include('../components/log-script.php');

require_once('../ScriptLibrary/incPureUpload.php');
// Pure PHP Upload 2.1.8
$ppu = new pureFileUpload();
$ppu->path = "../../images/uploads"; //change when uploaded
$ppu->extensions = "JPG,JPEG,PNG";
$ppu->formName = "addform";
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

if (isset($editFormAction)) {
  if (isset($_SERVER['QUERY_STRING'])) {
	  if (!eregi("GP_upload=true", $_SERVER['QUERY_STRING'])) {
  	  $editFormAction .= "&GP_upload=true";
		}
  } else {
    $editFormAction .= "?GP_upload=true";
  }
}

if (isset($_POST['submitted'])) {
	
	if (empty($_POST['Make'])) {
		$erun = "Please enter the Make";
	}
	
	if (!$erun && empty($_POST['Model'])) {
		$erun = "Please enter the Model";
	}
	
	if (!$erun && empty($_POST['Price'])) {
		$erun = "Please enter the Price";
	}
	
	if (!$erun) {

	$query = $dbo->prepare("INSERT INTO stock (`Feed_ID`,
  `Vehicle_ID`,
  `FullRegistration`,
  `Colour`,
  `FuelType`,
  `Year`,
  `Mileage`,
  `BodyType`,
  `Doors`,
  `Make`,
  `Model`,
  `Variant`,
  `EngineSize`,
  `Price`,
  `Transmission`,
  `PictureRefs`,
  `ServiceHistory`,
  `PreviousOwners`,
  `Category`,
  `FourWheelDrive`,
  `Options`,
  `Comments`,
  `New`,
  `Used`,
  `Site`,
  `Origin`,
  `V5`,
  `Condition`,
  `ExDemo`,
  `FranchiseApproved`,
  `TradePrice`,
  `TradePriceExtra`,
  `ServiceHistoryText`,
  `Capid`,
  `Attention_Grabber`) 
  
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
":Vehicle_ID" => $_POST['Vehicle_ID'],
":FullRegistration" => $_POST['FullRegistration'],
":Colour" => $_POST['Colour'],
":FuelType" => $_POST['FuelType'],
":Year" => $_POST['Year'],
":Mileage" => $_POST['Mileage'],
":BodyType" => $_POST['BodyType'],
":Doors" => $_POST['Doors'],
":Make" => $_POST['Make'],
":Model" => $_POST['Model'],
":Variant" => $_POST['Variant'],
":EngineSize" => $_POST['EngineSize'],
":Price" => $_POST['Price'],
":Transmission" => $_POST['Transmission'],
":PictureRefs" => $_FILES['image1']['name'] . ',' . $_FILES['image2']['name'] . ',' . $_FILES['image3']['name'] . ',' . $_FILES['image4']['name'] ,
":ServiceHistory" => $_POST['ServiceHistory'],
":PreviousOwners" => $_POST['PreviousOwners'],
":Category" => $_POST['Category'],
":FourWheelDrive" => $_POST['FourWheelDrive'],
":Options" => $_POST['Options'],
":Comments" => $_POST['Comments'],
":New" => $_POST['New'],
":Used" => $_POST['Used'],
":Site" => $_POST['Site'],
":Origin" => $_POST['Origin'],
":V5" => $_POST['V5'],
":Condition" => $_POST['Condition'],
":ExDemo" => $_POST['ExDemo'],
":FranchiseApproved" => $_POST['FranchiseApproved'],
":TradePrice" => $_POST['TradePrice'],
":TradePriceExtra" => $_POST['TradePriceExtra'],
":ServiceHistoryText" => $_POST['ServiceHistoryText'],
":Capid" => $_POST['Capid'],
":Attention_Grabber" => $_POST['Attention_Grabber'] )); 
	
	if($query) {
			$erun = 'Vehicle Created';
			$srun = "Vehicle &quot;" . $_POST['Make'] . "&quot; Created";
			include('../components/log-script.php');
	 } else {
		 
		 	$erun = 'Error, Vehicle NOT Created ' . $query->errorCode();
	
		
	}
		
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
<link href="../css/page.css" rel="stylesheet" type="text/css" />
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
                    <h1>Add Car</h1>
                    <p>Create a new car.</p>
                </div>
                
                <p><strong>Please Note:</strong> fields marked <img src="../images/icon-required-field.gif" alt="This is a required field and *MUST* be completed" name="required-field-icon" width="18" height="18" hspace="5" vspace="0" border="0" align="middle" /> are required!</p>
                
<form action="<?php echo $GP_uploadAction; ?>" method="post" enctype="multipart/form-data" name="addform" onsubmit="checkFileUpload(this,'JPG,JPEG,PNG',true,'','','','','','','');showProgressWindow('fileCopyProgress.htm',300,100);return document.MM_returnValue">

Enter the Unique Vehicle ID<br />
<input type="text" name="Vehicle_ID" size="50" maxlength="50" value="" /><br /><br />

Enter the Full Registration<br />
<input type="text" name="FullRegistration" size="20" maxlength="20" value="" /><br /><br />

Enter the Colour<br />
<input type="text" name="Colour" size="60" maxlength="60" value="" /><br /><br />

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
<input type="text" name="Year" size="4" maxlength="4" value=""  /><br /><br />

Enter the Mileage *Number only<br />
<input type="text" name="Mileage" size="10" maxlength="10" value=""  /><br /><br />

Enter the Body Type *No Doors Info<br />
<input type="text" name="BodyType" size="30" maxlength="30" value=""  /><br /><br />

Enter the Number of Doors *Number only<br />
<input type="text" name="Doors" size="1" maxlength="1" value=""  /><br /><br />

Enter the Make<br />
<input type="text" name="Make" size="50" maxlength="50" value=""  /><img src="../images/icon-required-field.gif" alt="This is a required field and *MUST* be completed" name="required-field-icon" width="18" height="18" hspace="5" vspace="0" border="0" align="middle" /><br /><br />

Enter the Model<br />
<input type="text" name="Model" size="50" maxlength="50" value=""  /><img src="../images/icon-required-field.gif" alt="This is a required field and *MUST* be completed" name="required-field-icon" width="18" height="18" hspace="5" vspace="0" border="0" align="middle" /><br /><br />

Enter the Variant<br />
<input type="text" name="Variant" size="75" maxlength="75" value=""  /><br /><br />

Enter the Engine Size *Number only<br />
<input type="text" name="EngineSize" size="4" maxlength="4" value=""  /><br /><br />

Enter the Price (&pound;) *Number only - Do not include &pound; sign, commas or decimal places<br />
<input type="text" name="Price" size="10" maxlength="10" value=""  /><img src="../images/icon-required-field.gif" alt="This is a required field and *MUST* be completed" name="required-field-icon" width="18" height="18" hspace="5" vspace="0" border="0" align="middle" /><br /><br />

Enter the Transmission<br />
<select name="Transmission">
<option value="Manual" selected="selected">Manual</option>
<option value="Automatic">Automatic</option>
</select><br /><br />

Upload Image 1<br />
<input name="image1" type="file" onchange="checkOneFileUpload(this,'JPG,JPEG,PNG',true,'','','','','','','')" /><br /><br />

Upload Image 2<br />
<input name="image2" type="file" onchange="checkOneFileUpload(this,'JPG,JPEG,PNG',true,'','','','','','','')" /><br /><br />

Upload Image 3<br />
<input name="image3" type="file" onchange="checkOneFileUpload(this,'JPG,JPEG,PNG',true,'','','','','','','')" /><br /><br />

Upload Image 4<br />
<input name="image4" type="file" onchange="checkOneFileUpload(this,'JPG,JPEG,PNG',true,'','','','','','','')" /><br /><br />

Service History?<br />
<select name="ServiceHistory">
<option value="1" selected="selected">Yes</option>
<option value="0">No</option>
</select><br /><br />

Enter the Number Previous Owners *Number only<br />
<input type="text" name="PreviousOwners" size="1" maxlength="1" value="1"  /><br /><br />

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
<input type="text" name="Condition" size="100" maxlength="100" value=""  /><br /><br />

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
<input type="text" name="TradePrice" size="10" maxlength="10" value=""  /><br /><br />

Extra price text (Traderlink site only)<br />
<input type="text" name="TradePriceExtra" size="20" maxlength="20" value=""  /><br /><br />

Service History<br />
<select name="ServiceHistoryText">
<option value="Full service history" selected="selected">Full service history</option>
<option value="Full dealership history" >Full dealership history</option>
<option value="Service History" >Service history</option>
<option value="Part service history" >Part service history</option>
</select><br /><br />

Enter the CAP ID *Number only<br />
<input type="text" name="Capid" size="10" maxlength="10" value=""  /><br /><br />

Enter the unique selling point of that vehicle in the title to really grab buyers attention to make sure they click to find out more about your car.<br />
<textarea name="Attention_Grabber" maxlength="30"></textarea>
<br /><br />

<input name="submitted" type="hidden" value="TRUE" />
<input name="submit" type="submit" value="Save Car" />

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