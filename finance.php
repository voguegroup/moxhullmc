<?php 
if ($_POST['cashprice']) {
	$cashprice=$_POST['cashprice'];
}
if ($_POST['deposit']) {
	$deposit=$_POST['deposit'];
}
if ($_POST['length']) {
	$length=$_POST['length'];
}
if ($_POST) {
	
	$total = ($cashprice - $deposit) * $length / 0.05;
}
?><!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="author" content="Moxhull Motor Company">
<meta name="keywords" content="car finance birmingham, car funance sutton coldfield, car, finance, sutton coldfield, used car finance sutton coldfield, car finance, used fiesta finance, used corsa finance, second hand cars finance sutton coldfield, used fords sutton coldfield, used vaxhaull sutton coldfield, used vw sutton coldfield, used renault sutton coldfield">
<meta name="description" content="Used car finance options available on all cars at Moxhull Motor Company. Call today to arrange an appointment.">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Moxhull Motor Company | Car Finance Birmingham</title>
<link href='http://fonts.googleapis.com/css?family=Raleway:400,700' rel='stylesheet' type='text/css'>
<link rel="shortcut icon" href="favicon.ico">

<link href="style.css" media="screen" rel="stylesheet">
<link href="screen.css" media="screen" rel="stylesheet">
<!-- custom CSS -->
<link href="custom.css" media="screen" rel="stylesheet">

<!-- main JS libs  -->
<script src="js/libs/modernizr.min.js"></script>
<script src="js/libs/respond.min.js"></script>					 
<script src="js/libs/jquery.min.js"></script>

<!-- scripts  -->
<script src="js/jquery.easing.min.js"></script>
<script src="js/general.js"></script>
<script src="js/hoverIntent.js"></script>
<!-- carousel -->
<script src="js/jquery.carouFredSel.min.js"></script>
<script src="js/jquery.touchSwipe.min.js"></script>
<!-- styled select -->
<link rel="stylesheet" href="css/cusel.css">
<script src="js/cusel-min.js"></script>
<!-- custom input -->
<script src="js/jquery.customInput.js"></script>
<!-- range slider -->
<link href="css/jslider.css" rel="stylesheet">
<script type="text/javascript" src="js/jquery.slider.bundle.js"></script>

</head>

<body>
<div class="body_wrap">
	
	<!-- header top bar -->
	<?php include ('components/header.php'); ?>
	<!--/ header top bar -->
		
<!-- header -->
<div class="header header_thin" style="background-image:url(images/temp/slider_1_2.jpg)">
            
	<div class="header_title">
    	&nbsp;
    </div>

</div>
<!--/ header -->

<!-- search 
	<div class="middle_row row_white search_row full_search">
		<div class="container">
			<form action="#" class="search_form clearfix">
            	<div class="row field_select">
                    <label class="label_title">Select Maker:</label>
                    <select class="select_styled" name="car_maker">
                        <option value="1">Alfa Romeo</option>
                        <option value="2">Audi</option>
                        <option value="3">BMW</option>
                        <option value="4">Chevrolet</option>
                        <option value="5">Ford</option>
                        <option value="6">Honda</option>                                                
                        <option value="7">Lexus</option>
                        <option value="8">Mazda</option>
                        <option value="9">Mercedes Benz</option>
                        <option value="10">Mitsubishi</option>
                        <option value="11">Nissan</option>
                        <option value="12">Opel</option>
                        <option value="13">Toyota</option>                       
                        <option value="14">Volkswagen</option>
                        <option value="15">Volvo</option>                        
                    </select>
                </div>
                
                <div class="row field_select">
                    <label class="label_title">Select Model:</label>
                    <select class="select_styled" name="car_model">
                        <option value="1">626</option>
                        <option value="2">323</option>
                        <option value="3">3</option>
                        <option value="4">5</option>
                        <option value="5">7</option>
                        <option value="6">СX-7</option>                                                
                        <option value="7">MVP</option>
                        <option value="8">RX-8</option>
                        <option value="9">MX-3</option>
                        <option value="10">MX-5</option>
                        <option value="11">MX-6</option>
                        <option value="12">BT-50</option>
                        <option value="13">CX-9</option>                                          
                    </select>
                </div>
                
                <div class="row field_select">
                    <label class="label_title">1st Registration from:</label>
                    <select class="select_styled" name="car_year">
                        <option value="1">2001</option>
                        <option value="2">2002</option>
                        <option value="3">2003</option>
                        <option value="4">2004</option>
                        <option value="5">2005</option>
                        <option value="6">2006</option>                                                
                        <option value="7">2007</option>
                        <option value="8">2008</option>
                        <option value="9">2009</option>
                        <option value="10">2010</option>
                        <option value="11">2011</option>
                        <option value="12">2012</option>
                    </select>
                </div>
                
                <div class="row field_select">
                    <label class="label_title">Price until:</label>
                    <select class="select_styled" name="car_model">
                        <option value="1">3000 EUR</option>
                        <option value="2">5000 EUR</option>
                        <option value="3">7000 EUR</option>
                        <option value="4" selected>10000 EUR</option>
                        <option value="5">20000 EUR</option>
                        <option value="6">Unlimited</option>
                    </select>
                </div>
                
                <div class="clear"></div>
                
                <div class="row field_select">
                    <label class="label_title">Mileage up to:</label>
                    <select class="select_styled" name="car_mileage">
                        <option value="1">50.000</option>
                        <option value="2">100.000</option>
                        <option value="3">150.000</option>
                        <option value="4">200.000</option>
                        <option value="5">300.000 +</option>
                    </select>
                </div>
                
                <div class="row field_select">
                    <label class="label_title">Fuel Type:</label>
                    <select class="select_styled" name="car_fuel_type">
                        <option value="1">Petrol </option>
                        <option value="2">Diesel</option>
                        <option value="3">Natural Gas</option>
                        <option value="4">LPG</option>
                        <option value="5">Electric</option>
                        <option value="6">Hybrid </option>                                                                                      
                    </select>
                </div>
                
                <div class="row field_select">
                    <label class="label_title">Vehicle Type:</label>
                    <select class="select_styled" name="car_type">
                        <option value="1">Compact Cars</option>
                        <option value="2">SUVs & PickUps </option>
                        <option value="3">Estate Saloons</option>
                        <option value="4">Sedan Cars</option>
                        <option value="5">Sports Cars</option>
                        <option value="6">Van & Minibus</option>                                                
                    </select>
                </div>
                
                <div class="row field_select">
                    <label class="label_title">Country / State:</label>
                    <select class="select_styled" name="car_location">
                        <option value="1">New York</option>
                        <option value="2">San Diego</option>
                        <option value="3">Chicago</option>
                        <option value="4">San Francisco</option>
                        <option value="5">Los Angeles</option>
                        <option value="6">Boston</option>
                    </select>
                </div>
                
                <div class="clear"></div>
                
                <div class="row field_select">
                    <label class="label_title">Motor Power:</label>
                    <select class="select_styled" name="car_motor">
                        <option value="1">110 kW - 146 kW</option>
                        <option value="2">147 kW - 184 kW</option>
                        <option value="3">185 kW - 222 kW</option>
                        <option value="4">223 kW - 262 kW</option>
                        <option value="5">263 kW - 295 kW </option>
                    </select>
                </div>
                
                <div class="row field_select">
                    <label class="label_title">Engine Size:</label>
                    <select class="select_styled" name="car_engine">
                        <option value="1">1.1 - 1.5</option>
                        <option value="2" selected>1.6 - 2.0</option>
                        <option value="3">2.1 - 3.0</option>
                        <option value="4">3.1 - 4.0</option>
                        <option value="5">4.1 +</option>                                                                                
                    </select>
                </div>
                
                <div class="row field_select">
                    <label class="label_title">Gearbox:</label>
                    <select class="select_styled" name="car_gearbox">
                        <option value="1">Manual</option>
                        <option value="2">Automatic</option>                                             
                    </select>
                </div>
                
                <div class="row field_select">
                    <label class="label_title">Damaged vehicles:</label>
                    <select class="select_styled" name="car_damage">
                        <option value="1">Show Also</option>
                        <option value="2">Dont't Show</option>
                    </select>
                </div>
                
                <div class="clear"></div>
                
                
                <div class="row rowSubmit">
                    <span class="btn btn_search"><input type="submit" value="SEARCH"></span>
                </div>
            </form>
		</div>
	</div>
<!--/ search -->

<!-- breadcrumbs -->
<div class="middle_row row_white breadcrumbs">
    <div class="container">
        <p><a href="index.html">Home</a>  <span class="separator">&rsaquo;</span>  <a href="#">Car Finance</a></p>
        <a href="offers-search.html" class="link_search">Start a new search</a> 
    </div>
</div>
<!--/ breadcrumbs -->

<!-- middle -->   
<div id="middle" class="cols2 full_width">
	<div class="container clearfix">  
    	
       
		<!-- content -->
        <div class="content">
        <!-- car types -->
	<div class="middle_row  search_row contact_form">
		<div class="container">  
			
           
           <h1>Car Finance with Moxhull Motor Company</h1>
           <p>At Moxhull Motor Company Sutton Coldfield, we are able to provide the right finance package to suit your requirements - it's a key factor in choosing the right car to fit your budget.</p>
           <p>We're able to offer competitive finance options that match your circumstances.</p>
           <h3>Calculate your finance payments</h3>
           <form action="" method="post" id="contactForm" class=>
                
                <div class="form_col_1">
                    <div class="row alignleft field_text">
                        <label class="label_title">Cash price (&pound;)</label>
                        <input type="text" name="cashprice" id="name" value="" class="inputField required" placeholder="1000">
                    </div> 
                    <div class="row alignleft field_text omega">
                        <label class="label_title">Deposit (&pound;)</label>
                        <input type="text" name="deposit" id="email" value="" class="inputField required" placeholder="300">
                    </div>  
                   
                    </div>   
                   
                    <div class="form_col_2">
                    
                    <div class="row alignleft field_text">
                        <label class="label_title">Length</label>
                         <select class="select_styled" name="length" id="subject">
                            <option value="12">12 months</option>
                            <option value="24">24 months</option>
                            <option value="36">36 months</option>
                        </select>
                    </div> 
                    <div class="row alignleft field_text omega">
                      <div class="row rowSubmit clearfix">
                        <input type="submit" value="Calculate Finance" id="send" class="btn btn-submit">
                    </div>
                    </div>   
                    </div>
             </form>  
             <?php if (isset($total)) { ?>
             
             <?php echo $total; ?>
             
             <?php } ?>  
             <p><small>* Above calculations are for illustration purposes only. Rates based on individual circumstance. Finance subject to documentation and completion fees.</small></p>
             
              <div class="text_box">
            	<p>
                <a href="contact.php" class="btn btn_big btn_white"><span>APPLY FOR FINANCE <strong>0121 345 6789</strong></span></a>
                <a href="mailto:sales@moxhullmotorcompany.co.uk" class="btn btn_big btn_orange"><span>EMAIL US ABOUT FINANCE</span></a>
                </p>
            	
            </div> 
		</div>
	</div>
    <!--/ car types -->	
            
            
            
            
            
        </div>
        <!--/ content -->
        
        
              
    </div>
</div>
<!--/ middle -->



 <?php include ('components/brands.php'); ?>
    
<!--/ middle -->

<?php include ('components/footer.php'); ?>

</div>
</body>
</html>
