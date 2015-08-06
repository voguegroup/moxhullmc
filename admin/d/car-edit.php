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



$id = $_GET['id'];



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
		$query = $dbo->prepare("UPDATE stock SET
  `Vehicle_ID`=:Vehicle_ID,
  `FullRegistration`=:FullRegistration,
  `Colour`=:Colour,
  `FuelType`=:FuelType,
  `Year`=:Year,
  `Mileage`=:Mileage,
  `BodyType`=:BodyType,
  `Doors`=:Doors,
  `Make`=:Make,
  `Model`=:Model,
  `Variant`=:Variant,
  `EngineSize`=:EngineSize,
  `Price`=:Price,
  `Transmission`=:Transmission,
  `PictureRefs`=:PictureRefs,
  `PreviousOwners`=:PreviousOwners,
  `Category`=:Category,
  `FourWheelDrive`=:FourWheelDrive,
  `Options`=:Options,
  `Comments`=:Comments,
  `New`=:New,
  `Used`=:Used,
  `Site`=:Site,
  `Origin`=:Origin,
  `V5`=:V5,
  `Condition`=:Condition,
  `ExDemo`=:ExDemo,
  `FranchiseApproved`=:FranchiseApproved,
  `TradePrice`=:TradePrice,
  `TradePriceExtra`=:TradePriceExtra,
  `Capid`=: Capid
   WHERE `id`=:id");
   
   $query->execute(array(
":id" => $_POST['id'],
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
":PictureRefs" => $_FILES['image1'] . ',' . $_FILES['image2'] . ',' . $_FILES['image3'] . ',' . $_FILES['image4'],
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
":Capid" => $_POST['Capid'] )); 
		
		if($query) {
			$erun = 'Vehicle Saved';
			$srun = "Vehicle &quot;" . $_POST['Make'] . "&quot; Saved";
			include('../components/log-script.php');
	 } else {
		 
		 	$erun = 'Error, Vehicle NOT Saved ' . $query->errorCode();
	
		
	}
		
	}

} 


$query = $dbo->prepare("SELECT * FROM stock WHERE id=:id");
$query->bindParam(':id', $id);
$query->execute();

while ($row = $query->fetch(PDO::FETCH_ASSOC)) {

  $Vehicle_ID= $row['Vehicle_ID'];
  $FullRegistration= $row['FullRegistration'];
  $Colour= $row['Colour'];
  $FuelType= $row['FuelType'];
  $Year= $row['Year'];
  $Mileage= $row['Mileage'];
  $BodyType= $row['BodyType'];
  $Doors= $row['Doors'];
  $Make= $row['Make'];
  $Model= $row['Model'];
  $Variant= $row['Variant'];
  $EngineSize= $row['EngineSize'];
  $Price= $row['Price'];
  $Transmission= $row['Transmission'];
  $PreviousOwners= $row['PreviousOwners'];
  $Category= $row['Category'];
  $FourWheelDrive= $row['FourWheelDrive'];
  $Options= $row['Options'];
  $Comments= $row['Comments'];
  $New= $row['New'];
  $Used= $row['Used'];
  $Site= $row['Site'];
  $Origin= $row['Origin'];
  $V5= $row['V5'];
  $Condition= $row['Condition'];
  $ExDemo= $row['ExDemo'];
  $FranchiseApproved= $row['FranchiseApproved'];
  $TradePrice= $row['TradePrice'];
  $TradePriceExtra= $row['TradePriceExtra'];
  $Capid= $row['Capid'];
  
  
  $PictureRefs= $row['PictureRefs'];
  

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
                    <h1>Edit Range</h1>
                    <p>Modify an existing range.</p>
                </div>
                
                <p><strong>Please Note:</strong> fields marked <img src="../images/icon-required-field.gif" alt="This is a required field and *MUST* be completed" name="required-field-icon" width="18" height="18" hspace="5" vspace="0" border="0" align="middle" /> are required!</p>
                
<form action="" method="post" enctype="multipart/form-data">


Enter the Unique Vehicle ID<br />
<input type="text" name="Vehicle_ID" size="50" maxlength="50" value="<?php echo $Vehicle_ID; ?>" /><br /><br />

Enter the Full Registration<br />
<input type="text" name="FullRegistration" size="20" maxlength="20" value="<?php echo $FullRegistration; ?>" /><br /><br />

Enter the Colour<br />
<input type="text" name="Colour" size="60" maxlength="60" value="<?php echo $Colour; ?>" /><br /><br />

Enter the Fuel Type<br />
<select name="FuelType">
<option selected value="<?php echo $FuelType; ?>"><?php echo $FuelType; ?></option>
<option value="Bi Fuel">Bi Fuel</option>
<option value="Diesel">Diesel</option>
<option value="Dual Fuel">Dual Fuel</option>
<option value="Electric">Electric</option>
<option value="Hybrid">Hybrid</option>
<option value="LPG">LPG</option>
<option value="LPG G3">LPG G3</option>
<option value="Petrol" >Petrol</option>
</select><br /><br />

Enter the Year<br />
<input type="text" name="Year" size="4" maxlength="4" value="<?php echo $Year; ?>"  /><br /><br />

Enter the Mileage *Number only<br />
<input type="text" name="Mileage" size="10" maxlength="10" value="<?php echo $Mileage; ?>"  /><br /><br />

Enter the Body Type *No Doors Info<br />
<input type="text" name="BodyType" size="30" maxlength="30" value="<?php echo $BodyType; ?>"  /><br /><br />

Enter the Number of Doors *Number only<br />
<input type="text" name="Doors" size="1" maxlength="1" value="<?php echo $Doors; ?>"  /><br /><br />

Enter the Make<br />
<input type="text" name="Make" size="50" maxlength="50" value="<?php echo $Make; ?>"  /><img src="../images/icon-required-field.gif" alt="This is a required field and *MUST* be completed" name="required-field-icon" width="18" height="18" hspace="5" vspace="0" border="0" align="middle" /><br /><br />

Enter the Model<br />
<input type="text" name="Model" size="50" maxlength="50" value="<?php echo $Model; ?>"  /><img src="../images/icon-required-field.gif" alt="This is a required field and *MUST* be completed" name="required-field-icon" width="18" height="18" hspace="5" vspace="0" border="0" align="middle" /><br /><br />

Enter the Variant<br />
<input type="text" name="Variant" size="75" maxlength="75" value="<?php echo $Variant; ?>"  /><br /><br />

Enter the Engine Size *Number only<br />
<input type="text" name="EngineSize" size="4" maxlength="4" value="<?php echo $EngineSize; ?>"  /><br /><br />

Enter the Price (&pound;) *Number only - Do not include &pound; sign, commas or decimal places<br />
<input type="text" name="Price" size="10" maxlength="10" value="<?php echo $Price; ?>"  /><img src="../images/icon-required-field.gif" alt="This is a required field and *MUST* be completed" name="required-field-icon" width="18" height="18" hspace="5" vspace="0" border="0" align="middle" /><br /><br />

Enter the Transmission<br />
<select name="Transmission">
<option selected value="<?php echo $Transmission; ?>"><?php echo $Transmission; ?></option>
<option value="Manual" >Manual</option>
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

Enter the Number Previous Owners *Number only<br />
<input type="text" name="PreviousOwners" size="1" maxlength="1" value="<?php echo $PreviousOwners; ?>" /><br /><br />

Enter the Category<br />
<select name="Category">
<option selected value="<?php echo $Category; ?>"><?php echo $Category; ?></option>
<option value="CARS" >Cars</option>
<option value="BIKE">Bike</option>
<option value="COMM">Comm</option>
</select><br /><br />

Four Wheel Drive?<br />
<select name="FourWheelDrive">
<option selected value="<?php echo $FourWheelDrive; ?>"><?php echo $FourWheelDrive; ?></option>
<option value="1" >Yes [1]</option>
<option value="0">No [0]</option>
</select><br /><br />

Options - List format seperated by commas<br />
<textarea name="Options" maxlength="1000"><?php echo $Options; ?></textarea><br /><br />

Comments - Any additional text such as Price excludes VAT etc (this field must not contain any data that appears already in the advert).<br />
<textarea name="Comments" maxlength="1500"><?php echo $Comments; ?></textarea><br /><br />

New?<br />
<select name="New">
<option selected value="<?php echo $New; ?>"><?php echo $New; ?></option>
<option value="Y" >Yes</option>
<option value="N" >No</option>
</select><br /><br />

Used?<br />
<select name="Used">
<option selected value="<?php echo $Used; ?>"><?php echo $Used; ?></option>
<option value="Y" >Yes</option>
<option value="N" >No</option>
</select><br /><br />

Site?<br />
<select name="Site">
<option selected value="<?php echo $Site; ?>"><?php echo $Site; ?></option>
<option value="C" >Consumer [C]</option>
<option value="T" >Traderlink [T]</option>
<option value="B" >Both [B]</option>
</select><br /><br />

Origin?<br />
<select name="Origin">
<option selected value="<?php echo $Origin; ?>"><?php echo $Origin; ?></option>
<option value="UK" >UK</option>
<option value="Parallel Import" >Parallel Import</option>
<option value="grey Import" >Grey Import</option>
</select><br /><br />

Does the vehicle have a V5 document?<br />
<select name="V5">
<option selected value="<?php echo $V5; ?>"><?php echo $V5; ?></option>
<option value="Y" >Yes</option>
<option value="N" >No</option>
</select><br /><br />

Enter the Condition of the Vehicle<br />
<input type="text" name="Condition" size="100" maxlength="100" value="<?php echo $Condition; ?>"  /><br /><br />

Is the vehicle ex-demo?<br />
<select name="ExDemo">
<option selected value="<?php echo $ExDemo; ?>"><?php echo $ExDemo; ?></option>
<option value="Y" >Yes</option>
<option value="N" >No</option>
</select><br /><br />

Is the vehicle Franchise Approved?<br />
<select name="FranchiseApproved">
<option selected value="<?php echo $FranchiseApproved; ?>"><?php echo $FranchiseApproved; ?></option>
<option value="Y" >Yes</option>
<option value="N" >No</option>
</select><br /><br />

Price for the Traderlink site *Number only - Do not include &pound; sign, commas or decimal places<br />
<input type="text" name="TradePrice" size="10" maxlength="10" value="<?php echo $TradePrice; ?>"  /><br /><br />

Extra price text (Traderlink site only)<br />
<input type="text" name="TradePriceExtra" size="20" maxlength="20" value="<?php echo $TradePriceExtra; ?>"  /><br /><br />

Enter the CAP ID *Number only<br />
<input type="text" name="Capid" size="10" maxlength="10" value="<?php echo $Capid; ?>"  /><br />
<br />

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