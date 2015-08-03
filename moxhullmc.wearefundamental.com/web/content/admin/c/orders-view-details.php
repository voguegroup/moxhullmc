<?php session_start();

include(dirname(__FILE__) . '/../config/config.php');

if (!$_SESSION['uid']) {
header ("Location:$cms_abs_url/index.php");
}

/* Generate Menus */
$HTTP_SESSION_VARS['T'] = 'customers';
$HTTP_SESSION_VARS['S'] = 'orders';
include($cms_root_url . '/components/menu-script.php');
include($cms_root_url . '/components/log-script.php');

$id = $_GET['id'];

// Include DB Connection.
require($cms_root_url . '/components/mysql_connect.inc');


	$query = "SELECT *, DATE_FORMAT(order_date, '%D %M %Y (%T)') AS date FROM orders WHERE order_id=" . mysql_real_escape_string($id);
					
	$result = mysql_query($query);

	$row = mysql_fetch_assoc($result);
	
	$session_id = $row['session_id'];
	$order_date = $row['date'];
	$order_title = $row['order_title'];
	$order_first_name = $row['order_first_name'];
	$order_last_name = $row['order_last_name'];
	$order_email = $row['order_email'];
	$order_telephone = $row['order_telephone'];
	$order_callback_date = $row['order_callback_date'];
	$order_callback_time = $row['order_callback_time'];
	$order_address_number_and_street = $row['order_address_number_and_street'];
	$order_address_city = $row['order_address_city'];
	$order_address_county = $row['order_address_county'];
	$order_address_postcode = $row['order_address_postcode'];
	$order_stairs = $row['order_stairs'];
	$order_stairs_number = $row['order_stairs_number'];
	$order_notes = $row['order_notes'];
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php include($cms_root_url . '/components/meta.php'); ?>
<link href="<?php echo $cms_abs_url ?>/css/page.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.title {
	float: left; 
	width: 200px; 
	font-weight: bold;
}

#basket {
	border-collapse:collapse;	
	border: 2px solid #333333;
	color:#000000;
	font-size: 1em;
}

#basket tr th {
	background-color:#333333;
	color:#ffffff;
	font-weight:normal;
	text-align:left;
	padding-left: 5px;
	padding-top: 5px;
	padding-bottom: 5px;
	padding-right: 35px;
	font-size: 0.9em;
}

#basket tr td {
	vertical-align:top;
	font-weight: bold;
	padding-top: 15px;
	padding-right: 35px;
	padding-left: 5px;
	padding-bottom: 5px;
	border: none;
}

#basket tr td span.small {
	font-size: 0.9em;
	font-weight: normal;
}

#basket tr.dark td {
	background-color:#F5F5F5;
	font-size: 0.9em;
	font-weight:normal;
	padding-top: 5px;
	padding-bottom: 5px;
	border-bottom: 1px solid #333333;
}

#basket tr td sup {
	font-size: 0.8em;
}
</style>
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
		<p><img src="../images/icons/customers_48.gif" alt="" name="asset_icon" width="48" height="48" hspace="20" vspace="0" border="0" align="left" /><strong>Manage Customers</strong><br />Manage data supplied by customers.</p>
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
                    <h1>Order Details</h1>
                    <p>View order details</p>
                </div>
                
                <span class="title">Order Date:</span> <?php echo $order_date; ?><br /><br />
                
                <span class="title">Name:</span> <?php echo $order_title . ' ' . $order_first_name . ' ' . $order_last_name ; ?><br />
                <span class="title">Email:</span> <a href="mailto:<?php echo $order_email; ?>"><?php echo $order_email; ?></a><br />
                <span class="title">Telephone:</span> <?php echo $order_telephone; ?><br />
                <span class="title">Callback Date:</span> <?php echo $order_callback_date; ?><br />
                <span class="title">Callback Time:</span> <?php echo $order_callback_time; ?><br /><br />
                
                <span class="title">House Number &amp; Street:</span> <?php echo $order_address_number_and_street; ?><br />
                <span class="title">Town / City / District:</span> <?php echo $order_address_city; ?><br />
                <span class="title">County:</span> <?php echo $order_address_county; ?><br />
                <span class="title">Postcode:</span> <?php echo $order_address_postcode; ?><br /><br />
                
                <span class="title">Are there stairs involved?</span> <?php echo $order_stairs; ?><br />
                <span class="title">Number of stairs:</span> <?php echo $order_stairs_number; ?><br /><br />
                
                <span class="title">Notes:</span> <?php echo $order_notes; ?><br /><br /><br />
                
                
				<?php
                
					$query = "SELECT basket.*, products.*, ranges.*, piles.* FROM basket, products, ranges, piles WHERE session_id='" . mysql_real_escape_string($session_id) . "' AND basket.product_id=products.product_id AND products.range_id=ranges.range_id AND ranges.pile_id=piles.pile_id";
					
					$result = mysql_query($query);
					
						

		echo '<table id="basket">';
			echo '<tr>';
				echo '<th>Carpet Name</th>';
				echo '<th>Range</th>';
				echo '<th>Pile Content</th>';
				echo '<th>Carpet Price</th>';
				echo '<th>Fitting Required?</th>';
				echo '<th>Fitting Price</th>';
				echo '<th>Total Price</th>';
				echo '<th>Underlay Required?</th>';
			echo '</tr>';
		
		while ($row = mysql_fetch_assoc($result)) {
			
			echo '<tr>';
				echo '<td>' . $row['product_name'] . '</td>';
				echo '<td>' . $row['range_name'] . '</td>';
				echo '<td>' . $row['pile_name'] . '</td>';
				echo '<td>&pound;';
				//echo number_format(($row['basket_carpet_price']*($row['basket_width']*$row['basket_length'])), 2);
				echo number_format($row['basket_carpet_price'], 2) . ' per m<sup>2</sup></td>';
				echo '<td>' . $row['basket_fitted'] . '</td>';
				echo '<td>&pound;';
				//echo number_format(($row['basket_fitting_price']*($row['basket_width']*$row['basket_length'])), 2);
				echo number_format($row['basket_fitting_price'], 2) . ' per m<sup>2</sup></td>';
				echo '<td>&pound;';
				//echo number_format((($row['basket_carpet_price']+$row['basket_fitting_price'])*($row['basket_width']*$row['basket_length'])), 2);
				echo number_format(($row['basket_carpet_price']+$row['basket_fitting_price']), 2) . ' per m<sup>2</sup></td>';
				echo '<td>' . $row['basket_underlay'] . '</td>';
			echo '</tr>';
			echo '<tr class="dark">';
				echo '<td colspan="8">Room details: Carpet for ' . $row['basket_name'] . ' - ' . number_format($row['basket_width']*$row['basket_length'], 2) . 'm<sup>2</sup> (' . $row['basket_width'] . 'm x ' . $row['basket_length'] . 'm)</td>';
			echo '</tr>';
			
		}
		

		
		echo '</table>';
						
		
				
				?>

			</div>
		</div>
		
	</div>
</div>


<div id="footer">
	<?php include($cms_root_url . '/components/footer.php'); ?>
</div>
<div id="delete_alert"></div>
</body>
</html>