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
<meta name="keywords" content="used cars sutton coldfield, used fiesta, used corsa, second hand cars sutton coldfield, used fords sutton coldfield, used vaxhaull sutton coldfield, used vw sutton coldfield, used renalt sutton coldfield">
<meta name="description" content="Welcome to Moxhull Motor Company, supplying quality second-hand cars at affordable prices. Call today to arrange an appointment.">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Moxhull Motor Company | Sutton Coldfields leading used car sales</title>
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


<!-- breadcrumbs -->
<div class="middle_row row_white breadcrumbs">
    <div class="container">
        <p><a href="index.php">Home</a>  <span class="separator">&rsaquo;</span>  <a href="#">Used Car Search</a>  <span class="separator">&rsaquo;</span>  27 results</p>

    </div>
</div>
<!--/ breadcrumbs -->

<!-- middle -->
<div id="middle" class="cols2 full_width">
	<div class="container clearfix">


		<!-- content -->
        <div class="content">

            <!-- sorting, pages -->
	        <div class="list_manage">
            	<div class="inner clearfix">
                <form action="#" method="post" class="form_sort">
                    <span class="manage_title">Sort by:</span>
                        <select class="select_styled white_select" name="sort_list" id="sort_list">
                            <option value="1">Latest Added</option>
                            <option value="2" selected>Price High - Low</option>
                            <option value="3">Price Low - Hight</option>
                            <option value="4">Names A-Z</option>
                            <option value="5">Names Z-A</option>
                        </select>
                </form>

                <div class="pages_jump">
                    <span class="manage_title">Jump to page:</span>
                    <form action="#" method="post">
                        <input type="text" name="jumptopage" value="15" class="inputSmall"><input type="submit" class="btn-arrow" value="Go">
                    </form>
                </div>

                <div class="pages">
                    <span class="manage_title">Page: &nbsp;<strong>1 of 25</strong></span> <a href="#" class="link_prev">Previous</a><a href="#" class="link_next">Next</a>
                </div>

                </div>
	        </div>
          	<!--/ sorting, pages -->

            <!-- offers list -->
			<div class="offer_list clearfix">
            <?php //this is where i'll put the for loop ?>
				<div class="offer_item clearfix">
                	<div class="offer_image"><a href="vehicle.php"><img src="images/temp/prod_img_07.jpg" alt=""></a></div>
                    <div class="offer_aside">
                    	<h2><a href="offers-details.html">Kia Picanto</a></h2>
                    	<div class="offer_descr">
                        	<p>Electric front windows, Heated rear window, Rear window wash/wipe with intermittent delay, Windscreen wipers/ intermittent wipe...</p>
                        </div>
                        <div class="offer_data">
                        	<div class="offer_price">&pound;3,250</div>
                            <span class="offer_miliage">83,000</span>
                            <span class="offer_regist">2005</span>
                        </div>
                    </div>
                </div>

                <div class="offer_item clearfix">
                	<div class="offer_image"><a href="offers-details.html"><img src="images/temp/prod_img_02.jpg" alt=""></a></div>
                    <div class="offer_aside">
                    	<h2><a href="offers-details.html">Vauxhall Corsa</a></h2>
                    	<div class="offer_descr">
                        	<p>Electric front windows, Heated rear window, Rear window wash/wipe with intermittent delay, Windscreen wipers/ intermittent wipe...</p>
                        </div>

                        <div class="offer_data">
                        	<div class="offer_price">&pound;2,995</div>
                            <span class="offer_miliage">48,000</span>
                            <span class="offer_regist">2009</span>
                        </div>
                    </div>
                </div>

                <div class="offer_item clearfix">
                	<div class="offer_image"><a href="offers-details.html"><img src="images/temp/prod_img_03.jpg" alt=""></a></div>
                    <div class="offer_aside">
                    	<h2><a href="offers-details.html">Renault Twingo</a></h2>
                    	<div class="offer_descr">
                        	<p>Electric front windows, Heated rear window, Rear window wash/wipe with intermittent delay, Windscreen wipers/ intermittent wipe...</p>
                        </div>

                        <div class="offer_data">
                        	<div class="offer_price">&pound;4,495</div>
                            <span class="offer_miliage">37,000</span>
                            <span class="offer_regist">2009</span>
                        </div>
                    </div>
                </div>

                <div class="offer_item clearfix">
                	<div class="offer_image"><a href="offers-details.html"><img src="images/temp/prod_img_04.jpg" alt=""></a></div>
                    <div class="offer_aside">
                    	<h2><a href="offers-details.html">VW Polo</a></h2>
                    	<div class="offer_descr">
                        	<p>Electric front windows, Heated rear window, Rear window wash/wipe with intermittent delay, Windscreen wipers/ intermittent wipe...</p>
                        </div>

                        <div class="offer_data">
                        	<div class="offer_price">&pound;2,995</div>
                            <span class="offer_miliage">55,000</span>
                            <span class="offer_regist">2008</span>
                        </div>
                    </div>
                </div>

                <div class="offer_item clearfix">
                	<div class="offer_image"><a href="offers-details.html"><img src="images/temp/prod_img_05.jpg" alt=""></a></div>
                    <div class="offer_aside">
                    	<h2><a href="offers-details.html">Myvi</a></h2>
                    	<div class="offer_descr">
                        	<p>Electric front windows, Heated rear window, Rear window wash/wipe with intermittent delay, Windscreen wipers/ intermittent wipe...</p>
                        </div>

                        <div class="offer_data">
                        	<div class="offer_price">&pound;3,250</div>
                            <span class="offer_miliage">110,000</span>
                            <span class="offer_regist">2001</span>
                        </div>
                    </div>
                </div>

                <div class="offer_item clearfix">
                	<div class="offer_image"><a href="offers-details.html"><img src="images/temp/prod_img_06.jpg" alt=""></a></div>
                    <div class="offer_aside">
                    	<h2><a href="offers-details.html">Toyota Yaris</a></h2>
                    	<div class="offer_descr">
                        	<p>Electric front windows, Heated rear window, Rear window wash/wipe with intermittent delay, Windscreen wipers/ intermittent wipe...</p>
                 </div>
                        <div class="offer_data">
                        	<div class="offer_price">&pound;1,995</div>
                            <span class="offer_miliage">62,000</span>
                            <span class="offer_regist">2008</span>
                        </div>
                    </div>
                </div>

                <div class="offer_item clearfix">
                	<div class="offer_image"><a href="offers-details.html"><img src="images/temp/prod_img_01.jpg" alt=""></a></div>
                    <div class="offer_aside">
                    	<h2><a href="offers-details.html">Toyota Aygo</a></h2>
                    	<div class="offer_descr">
                        	<p>Electric front windows, Heated rear window, Rear window wash/wipe with intermittent delay, Windscreen wipers/ intermittent wipe...</p>

                        </div>
                        <div class="offer_data">
                        	<div class="offer_price">&pound;1,845</div>
                            <span class="offer_miliage">88,000</span>
                            <span class="offer_regist">2003</span>
                        </div>
                    </div>
                </div>

                <div class="offer_item clearfix">
                	<div class="offer_image"><a href="offers-details.html"><img src="images/temp/prod_img_08.jpg" alt=""></a></div>
                    <div class="offer_aside">
                    	<h2><a href="offers-details.html">Peugeot 107</a></h2>
                    	<div class="offer_descr">
                        	<p>Electric front windows, Heated rear window, Rear window wash/wipe with intermittent delay, Windscreen wipers/ intermittent wipe...</p>

                        </div>
                        <div class="offer_data">
                        	<div class="offer_price">&pound;3,450</div>
                            <span class="offer_miliage">95,000</span>
                            <span class="offer_regist">2006</span>
                        </div>
                    </div>
                </div>

            </div>
            <!--/ offers list -->

            <!-- pagination -->
            <div class="tf_pagination">
	            <div class="inner">
	            	<a class="page_prev" href="#"><span></span>PREV</a>
                	<a class="page_next" href="#"><span></span>NEXT</a>

                	<span class="page-numbers page_current">1</span> <a href="#" class="page-numbers">2</a>  <a href="#" class="page-numbers">3</a> <a href="#" class="page-numbers">4</a> <a href="#" class="page-numbers">5</a> <a href="#" class="page-numbers">6</a> <a href="#" class="page-numbers">7</a> &hellip;  <a href="#" class="page-numbers">18</a>

	            </div>
            </div>
            <!--/ pagination -->

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
