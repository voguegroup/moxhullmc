<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="author" content="Moxhull Motor Company">
<meta name="keywords" content="used car finance sutton coldfield, car finance, used fiesta finance, used corsa finance, second hand cars finance sutton coldfield, used fords sutton coldfield, used vaxhaull sutton coldfield, used vw sutton coldfield, used renault sutton coldfield">
<meta name="description" content="Used car finance options available on all cars at Moxhull Motor Company. Call today to arrange an appointment.">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>*MANUFACTURER* *MODEL* *PRICE* | Moxhull Motor Company</title>
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

<script src="js/jquery.tools.min.js"></script>
<!-- carousel -->
<script src="js/jquery.carouFredSel.min.js"></script>
<script src="js/jquery.touchSwipe.min.js"></script>
<!-- styled select -->
<link rel="stylesheet" href="css/cusel.css">
<script src="js/cusel-min.js"></script>
<!-- custom input -->
<script src="js/jquery.customInput.js"></script>

<link href="css/prettyPhoto.css" rel="stylesheet">
<script src="js/jquery.prettyPhoto.js"></script>
<script type="text/javascript" language="javascript" src="js/custom.js"></script>
</head>

<body>
<div class="body_wrap">
	
	<!-- header top bar -->
	<?php include ('components/header.php'); ?>
	<!--/ header top bar -->
		
<!-- header -->
<div class="header header_thin" style="background-image:url(images/temp/slider_1_1.jpg)">
            
	<div class="header_title">
    	<h1><span>Audi</span> A3 S-Line 2.0TDI</h1>
    </div>

</div>
<!--/ header -->

<!-- breadcrumbs -->
<div class="middle_row row_white breadcrumbs">
    <div class="container">
        <p><a href="/">Home</a>  <span class="separator">&rsaquo;</span>    <a href="cars.php">Audi</a>  <span class="separator">&rsaquo;</span>  <span class="current">A3</span></p>
        <a href="cars.php" class="link_back">View all cars</a>
    </div>
</div>
<!--/ breadcrumbs -->

<!-- middle -->   
<div id="middle" class="full_width">
	<div class="container clearfix">  
    
		<!-- content -->
        <div class="content">
        	
            <div class="offer_details clearfix">
            	<!-- offer left -->
            	<div class="offer_gallery">
                	<div class="gallery_images">
                    	<div id="gallery_images">
                        	<div class="gallery_image_item">
                            <img src="images/temp/prod_gallery_1.jpg" alt="">
                            <a href="images/temp/prod_gallery_1.jpg" data-rel="prettyPhoto[gal]">
                            <span>Image 1 <em class="ico_large"></em></span></a>
                            </div>
                            <div class="gallery_image_item">
                            <img src="images/temp/prod_gallery_2.jpg" alt="">
                            <a href="images/temp/prod_gallery_2.jpg" data-rel="prettyPhoto[gal]">
                            <span>Image 2 <em class="ico_large"></em></span></a>
                            </div>
                            <div class="gallery_image_item"> 
                            <img src="images/temp/prod_gallery_3.jpg" alt="">
                            <span>Image 3 <em class="ico_large"></em></span></a> <!-- example without caption -->
                            </div>
                            <div class="gallery_image_item">
                            <img src="images/temp/prod_gallery_4.jpg" alt="">
                            <a href="images/temp/prod_gallery_4.jpg" data-rel="prettyPhoto[gal]">
                            <span>Image 4 <em class="ico_large"></em></span></a>
                            </div>
                            <div class="gallery_image_item">
                            <img src="images/temp/prod_gallery_5.jpg" alt="">
                            <a href="images/temp/prod_gallery_5.jpg" data-rel="prettyPhoto[gal]">
                            <span>Image 5 <em class="ico_large"></em></span></a>
                            </div>
                            <div class="gallery_image_item">
                            <img src="images/temp/prod_gallery_6.jpg" alt="">
                            <a href="images/temp/prod_gallery_6.jpg" data-rel="prettyPhoto[gal]">
                            <span>Image 6 <em class="ico_large"></em></span></a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="gallery_thumbs">
                    	<div id="gallery_thumbs">
                        	<a href="#"><img src="images/temp/prod_gallery_1.jpg" alt=""></a>
                            <a href="#"><img src="images/temp/prod_gallery_2.jpg" alt=""></a>
                            <a href="#"><img src="images/temp/prod_gallery_3.jpg" alt=""></a>
                            <a href="#"><img src="images/temp/prod_gallery_4.jpg" alt=""></a>
                            <a href="#"><img src="images/temp/prod_gallery_5.jpg" alt=""></a>
                            <a href="#"><img src="images/temp/prod_gallery_6.jpg" alt=""></a>
                        </div>
                        <a href="#" class="prev" id="gallery_thumbs_prev"></a>
                        <a href="#" class="next" id="gallery_thumbs_next"></a>
                    </div>
                    
                    <script>	
					jQuery(document).ready(function($) {	
						function carGalleryInit() {
							$('#gallery_thumbs').children().each(function(i) {
								$(this).addClass( 'itm'+i );
								$(this).click(function() {
									$('#gallery_images').trigger('slideTo',[i, 0, true]);
									$('#gallery_thumbs a').removeClass('selected');
									$(this).addClass('selected');
									return false;
								});
							});
							$('#gallery_thumbs a.itm0').addClass('selected');
								
							$('#gallery_images').carouFredSel({
								infinite: false,
								circular: false,
								auto: false,
								width: '100%',
								scroll: {
									items : 1,
									fx : "crossfade"
								}
							});
							$('#gallery_thumbs').carouFredSel({
								prev : "#gallery_thumbs_prev",
								next : "#gallery_thumbs_next", 
								infinite: false,
								circular: false,
								auto: false,
								width: '100%',
								scroll: {
									items : 1
								}
							});		
						}
						
						$(window).load(function() {
							carGalleryInit();
						}); 
						var resizeTimer;
						$(window).resize(function() {
							clearTimeout(resizeTimer);
							resizeTimer = setTimeout(carGalleryInit, 100);
						});	          
					});
				    </script> 
                
                </div>
                <!--/ offer left -->
                <!-- offer right -->
                <div class="offer_aside">
                	<div class="offer_price">
                    	<strong>&pound;3,250</strong>
                     
                       
                    </div>
                    
                    <div class="offer_data">
                    	<ul>
                    		<li>2005</li>
                    		<li>83,000</li>
                    		<li>2.0 Diesel</li>
                    		<li>Grey</li>
                    	</ul>
                    </div>
                    
                    <div class="offer_descr">
                        <p>Car Desciption - Electric front windows, Heated rear window, Rear window wash/wipe with intermittent delay, Windscreen wipers/ intermittent wipe + 4 position delay, Anti-lock brake system, Rev counter, Warning buzzer and light for front seatbelts unfastened, Body colour door mirrors.</p>
                    </div>
                    
                    <div class="offer_specification">
                    	<ul>
                    		<li><span class="spec_name">Engine size:</span> <strong class="spec_value">2.0</strong></li>
                            <li><span class="spec_name">Fuel type:</span> <strong class="spec_value">Diesel</strong></li>
                            <li><span class="spec_name">Body type:</span> <strong class="spec_value">Hatchback</strong></li>
                            <li><span class="spec_name">Transmission:</span> <strong class="spec_value">Automatic</strong></li>
                            <li><span class="spec_name">Previous owners:</span> <strong class="spec_value">3</strong></li>
                            <li><span class="spec_name">Number of doors:</span> <strong class="spec_value">5</strong></li>
                    	</ul>
                    </div>
                    
                </div>
                <!--/ offer right -->
            </div>
            
            <!-- details tabs 
            <div class="details_tabs">
	            <ul class="tabs linked">
	                <li><a href="#t_overview"><span>OVERVIEW</span></a></li>
	                <li><a href="#t_description"><span>DESCRIPTION</span></a></li>
	                <li><a href="#t_contacts"><span>CONTACT US</span></a></li>
	                <li><a href="#t_send"><span>SEND TO A FRIEND</span></a></li>
	            </ul>
	            <div id="t_overview" class="tabcontent clearfix">
                	<div class="col col_1_4">
		            	<h3>Interior Features</h3>	
	                    <ul>
	                    	<li>Full Leather Interior</li>
	                    	<li>Central locking</li>
	                        <li>Automatic air conditioning</li>
	                        <li>Cruise control</li>
	                        <li>Electric heated seats</li>
	                        <li>Electric windows</li>
	                        <li>Navigation system</li>
	                        <li>Parking sensors</li>
	                        <li>Power Assisted Steering</li>
	                    </ul>
                    </div>
                    <div class="col col_1_4">
		            	<h3>Exterior Features</h3>	
	                    <ul>
	                    	<li> 20” Alloy wheels</li>
	                    	<li>Pearl White metallic paint</li>
	                    	<li>Automatic air conditioning</li>
	                    	<li>Trailer coupling</li>
	                    	<li>Sunroof</li>
	                    	<li>Double Exhaust</li>
                            <li>Electric Mirrors</li>
						</ul>
                    </div>
                    <div class="col col_1_4">
		            	<h3>Safety Features</h3>	
	                    <ul>
	                    	<li>ABS</li>
	                    	<li>ESP with EDL + ASR</li>
	                    	<li>Four Wheel Drive</li>
	                    	<li>Immobilizer</li>
	                    	<li>Xenon headlights</li>
	                    	<li>Passenger Airbag</li>
	                    	<li>Curtain Airbags</li>
	                    	<li>Drivers knee airbag</li>
	                    </ul>
                    </div>
                    <div class="col col_1_4">
		            	<h3>Extras</h3>	
	                    <ul>
	                    	<li>Full Service History</li>
	                    	<li>2 year Warranty</li>
	                    	<li>CD / DVD / MP3 Audio</li>
	                    	<li>Auxiliary Audio Input</li>
	                    	<li>Vehicle Anti-Theft</li>
	                    </ul>
                    </div>
	            </div>
                
	            <div id="t_description" class="tabcontent clearfix">
	            	<h3>Full Description</h3>
                    <div class="col col_1_2 alpha">
                    	<p>Hendrerit arcu sed erat molestie vehicula. Sed auctor neque eu tellus rhoncus ut eleifend nibh porttitor. Ut in nulla enim. Phasellus molestie magna non est bibendum non venenatis nisl tempor. Suspendisse.</p>

						<p>Proin quis tortor orci. Etiam at risus et justo dignissim congue. Donec congue lacinia dui, a porttitor lectus condimentum laoreet. Nunc eu ullamcorper orci. Quisque eget odio ac lectus vestibulum faucibus eget in metus. In pellentesque faucibus vestibulum. Nulla at nulla justo, eget luctus tortor. Nulla facilisi. Duis aliquet.</p>
                    </div>
                    <div class="col col_1_2">
                    	<p>Quisque eget odio ac lectus vestibulum faucibus eget in metus. In pellentesque faucibus vestibulum. Nulla at nulla justo, eget luctus tortor. Nulla facilisi. Duis aliquet acus lacus orna acus lacus orna.</p>

						<p>Curabitur Vulputate, Ligula Lacinia Curabitur vulputate, ligula lacinia scelerisque tempor, lacus lacus ornare ante, ac egestas est urna sit amet arcu lorem ipsum dolor sit amet regularsao.</p>
                    </div>
                    
	            </div>
	            
                <div id="t_contacts" class="tabcontent clearfix">
	            	<form action="#" class="details_form ajax_form" id="offer_contact">
                    	<div class="form_col_1">
                        	<div class="row input_styled inlinelist">
                            	<label class="label_title">Form of Address:</label>
                                <input type="radio" name="title" value="mrs" id="mrs" checked> <label for="mrs">Mrs.</label>
		                        <input type="radio" name="title" value="mr" id="mr"> <label for="mr">Mr.</label>
		                        <input type="radio" name="title" value="company" id="company"> <label for="company">Company</label>
                            </div>
                            <div class="row">
		                    	<label class="label_title">Your Full Name:</label>
		                        <input type="text" name="yourname" id="name" class="inputField required" value="">
		                    </div>
                            <div class="row">
		                    	<label class="label_title">Your Email Address:</label>
		                        <input type="text" name="email" id="email" class="inputField required" value="">
		                    </div>                            
                        </div>
                        <!--/ form col 1
                        <div class="form_col_2">
                        	<div class="row">
		                    	<label class="label_title">Message:</label>
		                        <textarea rows="4" cols="5" name="message" id="message" class="textareaField required"></textarea>
		                    </div>
                            <div class="row rowSubmit">
                            	<a href="#" class="link_reset" onclick="document.getElementById('offer_contact').reset();return false">Reset All Contact Form Fields</a>
                            	<input type="submit" value="SEND MESSAGE" id="send" class="btn_send">
                            </div>
                        </div>
                        <!--/ form col 2
                        
                    </form>                    
	            </div>
	            
                <div id="t_send" class="tabcontent clearfix feedback_ajax_form">
	            	<form action="#" class="details_form" id="offer_send_friend">
                    	<div class="form_col_1">                            
                            <div class="row">
		                    	<label class="label_title">Your Email Address:</label>
		                        <input type="text" name="email_from" name="email_from" class="inputField required" value="">
		                    </div>   
                            <div class="row">
		                    	<label class="label_title">Your Friend’s Email Address:</label>
		                        <input type="text" name="email" id="email_f" class="inputField required" value="">
		                    </div>                         
                        </div>
                        <!--/ form col 1
                        <div class="form_col_2 col_thin">
                        	<div class="row">
		                    	<label class="label_title">Message:</label>
		                        <textarea rows="4" cols="5" name="message" name="message_f" class="textareaField required">Check out this cool car:
http://mobile.de/auto-inserat/mercedes-benz-ml-63</textarea>
		                    </div>
                            <div class="row rowSubmit">
                            	<a href="#" class="link_reset" onclick="document.getElementById('offer_send_friend').reset();return false">Reset All Form Fields</a>
                            	<input type="submit" value="SEND MESSAGE" id="send_f" class="btn_send">
                            </div>
                        </div>
                        <!--/ form col 2 
                        <div class="form_col_3">
                        	<div class="row">
		                    	<label class="label_title">Share on:</label>
                            	<a href="#" class="btn_share"><img src="images/btn_share_tweet.png" alt=""></a>
                                <a href="#" class="btn_share"><img src="images/btn_share_like.png" alt=""></a>
                                <a href="#" class="btn_share"><img src="images/btn_share_g1.png" alt=""></a>
                            </div>
                        </div>
                        <!--/ form col 3 
                        
                    </form>
	            </div>
            </div>
            <!--/ details tabs -->
            
            <div class="text_box">
            	<p>
                <a href="contact.php" class="btn btn_big btn_white"><span>ARRANGE VIEWING <strong>0121 345 6789</strong></span></a>
                <a href="mailto:sales@moxhullmotorcompany.co.uk" class="btn btn_big btn_orange"><span>EMAIL US ABOUT THIS CAR</span></a>
                </p>
            	<p><em>Prices are subject to change. Please see our <a href="privacy.php">Privacy Policy</a> for more info</em></p>
            </div>
            
        </div>
        <!--/ content -->
        
              
    </div>
</div>
<!--/ middle -->

	<!-- latest_offers -->
	<div class="middle_row latest_offers">
		<div class="container clearfix">         			
        	<h2>Cars Similar to your search</h2>                    
		</div>
            
        <div id="latest_offers">
            <div class="latest_item">
            <a href="offers-details.html"><img src="images/temp/prod_img_01.jpg" alt=""></a>
            <a href="offers-details.html">Land Rover Freelander 1.8i</a>
            </div>
            <div class="latest_item">
            <a href="offers-details.html"><img src="images/temp/prod_img_02.jpg" alt=""></a>
            <a href="offers-details.html">Fiat Punto 1.4i</a>
            </div>
            <div class="latest_item">
            <a href="offers-details.html"><img src="images/temp/prod_img_03.jpg" alt=""></a>
            <a href="offers-details.html">Citroen C3 1.6d</a>
            </div>
            <div class="latest_item">
            <a href="offers-details.html"><img src="images/temp/prod_img_04.jpg" alt=""></a>
            <a href="offers-details.html">Renault Clio 1.6i</a>
            </div>
            <div class="latest_item">
            <a href="offers-details.html"><img src="images/temp/prod_img_05.jpg" alt=""></a>
            <a href="offers-details.html">BMW 3 Series 2.0d</a>
            </div>
            <div class="latest_item">
            <a href="offers-details.html"><img src="images/temp/prod_img_06.jpg" alt=""></a>
            <a href="offers-details.html">Toyota Aygo 1.1i</a>
            </div>
            <div class="latest_item">
            <a href="offers-details.html"><img src="images/temp/prod_img_07.jpg" alt=""></a>
            <a href="offers-details.html">Audi A3 1.9d</a>
            </div>
            <div class="latest_item">
            <a href="offers-details.html"><img src="images/temp/prod_img_08.jpg" alt=""></a>
            <a href="offers-details.html">VW Golf 1.6i</a>
            </div>
            <div class="latest_item">
            <a href="offers-details.html"><img src="images/temp/prod_img_09.jpg" alt=""></a>
            <a href="offers-details.html">Seat Leon 1.6i</a>
            </div>
        </div>
        
        <a class="prev" id="latest_offers_prev" href="#"></a>
        <a class="next" id="latest_offers_next" href="#"></a>
                    
        <script>	
        jQuery(document).ready(function($) {	
			var screenRes = $(window).width();
			
            $('#latest_offers').carouFredSel({
                prev : "#latest_offers_prev",
                next : "#latest_offers_next", 
                infinite: false,
                circular: true,
                auto: false,
                width: '100%',				
                scroll: {
                    items : 1,
					onBefore: function (data) {
						if (screenRes > 900) {
						data.items.visible.eq(0).animate({opacity: 0.15},300);
						data.items.old.eq(-1).animate({opacity: 1},300);
						data.items.visible.eq(-1).animate({opacity: 0.15},300);		               
						}
		            },
					onAfter: function (data) {
						if (screenRes > 900) {
						data.items.old.eq(0).animate({opacity: 1},300);	
						}
		            }
                }
            });			
			if (screenRes > 900) {
				var vis_items = $("#latest_offers").triggerHandler("currentVisible");
				vis_items.eq(-1).animate({opacity: 0.15},100);
				vis_items.eq(0).animate({opacity: 0.15},100);
			}
        });
        </script>             
	</div>
    <!--/ latest_offers -->
    
 <?php include ('components/brands.php'); ?>
    
<!--/ middle -->

<?php include ('components/footer.php'); ?>

</div>
</body>
</html>
