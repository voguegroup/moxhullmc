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

// Include DB Connection.
require($cms_root_url . '/components/mysql_connect.inc');

if ($_GET['delete']) {
	
	$query = "DELETE FROM products WHERE product_id=" . mysql_real_escape_string($_GET['delete']);
	
	$result = mysql_query($query);
	
	if ($result) {
		$erun = 'Product Deleted';
		$srun = $erun;
		include($cms_root_url . '/components/log-script.php');
	} 
	else {
		$erun = 'Error, Product NOT Deleted';
	}
	
}


if (isset($_GET['product']) || isset($_GET['range']) || isset($_GET['manufacturer'])) {
	
	if (isset($_GET['product'])) {
		if ($_GET['product'] == "ASC") {
			$order_by_url = "DESC";
			$order_by_query = "ORDER BY product_name ASC";	
		}
		else {
			$order_by_url = "ASC";
			$order_by_query = "ORDER BY product_name DESC";
		}
	}
	
	if (isset($_GET['range'])) {
		if ($_GET['range'] == "ASC") {
			$order_by_url = "DESC";
			$order_by_query = "ORDER BY range_name ASC";	
		}
		else {
			$order_by_url = "ASC";
			$order_by_query = "ORDER BY range_name DESC";
		}
	}
	
	if (isset($_GET['manufacturer'])) {
		if ($_GET['manufacturer'] == "ASC") {
			$order_by_url = "DESC";
			$order_by_query = "ORDER BY manufacturer_name ASC";	
		}
		else {
			$order_by_url = "ASC";
			$order_by_query = "ORDER BY manufacturer_name DESC";
		}
	}
	
}
else {
	$order_by_url = "ASC";
	$order_by_query = "ORDER BY manufacturer_name ASC, range_name ASC, product_name ASC";	
}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php include($cms_root_url . '/components/meta.php'); ?>
<link href="<?php echo $cms_abs_url ?>/css/page.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
function deleteAlert(id) {
	document.getElementById('delete_alert').innerHTML = '<div id="error_message_bg"></div><div id="error_message"><p>Do you really want to delete this content page?<br /><br /><input type="button" value="Yes" onclick="deleteYes('+id+')" />&nbsp;&nbsp;&nbsp;<input type="button" value="No" onclick="deleteNo()" /></p></div>';
}

function deleteYes(id) {
	location.href='products-view.php?delete='+id;
}

function deleteNo() {
	var el=document.getElementById('error_message_bg');
	el.parentNode.removeChild(el);
	el=document.getElementById('error_message');
	el.parentNode.removeChild(el);
}
</script>

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
                    <h1>Products</h1>
                    <p>Add, edit and delete products.</p>
                </div>
            
            	<a class="button" href="products-add.php">Create New Product</a><div class="clear"></div><br />
            
                <?php
            
                    require($cms_root_url . '/components/mysql_connect.inc');
                    
					$query = "SELECT products.*, ranges.*, manufacturers.*, piles.* FROM products LEFT JOIN ranges ON products.range_id=ranges.range_id LEFT JOIN manufacturers ON ranges.manufacturer_id=manufacturers.manufacturer_id LEFT JOIN piles ON ranges.pile_id=piles.pile_id " . $order_by_query;
                    
                    $query_result = mysql_query($query);
					
					echo '<table cellpadding="10" cellspacing="0">';
						echo '<tr bgcolor="#a0adb5">';
							echo '<td align="left" valign="top"><strong><a href="products-view.php?product=' . $order_by_url . '">Product</a></strong></td>';
							echo '<td align="left" valign="top"><strong><a href="products-view.php?range=' . $order_by_url . '">Range</a></strong></td>';
							echo '<td align="left" valign="top"><strong><a href="products-view.php?manufacturer=' . $order_by_url . '">Manufacturer</a></strong></td>';
							//echo '<td align="left" valign="top"><strong>Room</strong></td>';
							echo '<td align="left" valign="top"><strong>Pile</strong></td>';
							echo '<td align="left" valign="top"><strong>Thumbnail</strong></td>';
							echo '<td align="left" valign="top"><strong>Gradient</strong></td>';
							echo '<td align="left" valign="top"><strong>&nbsp;</strong></td>';
							echo '<td align="left" valign="top"><strong>&nbsp;</strong></td>';
						echo '</tr>';
                    
                    while ($row = mysql_fetch_assoc($query_result)) {
                    
						echo '<tr onmouseover="this.style.backgroundColor=\'#f4f4f4\';" onmouseout="this.style.backgroundColor=\'#fafafa\';">';
							echo '<td align=\"left\" valign=\"middle\">' . $row['product_name'] . '</td>';

							if (empty($row['range_name'])) {
								echo '<td align=\"left\" valign=\"middle\" style="color: red;">Range has been deleted</td>';	
							}
							else {
								echo '<td align=\"left\" valign=\"middle\">' . $row['range_name'] . '</td>';		
							}

							if (empty($row['manufacturer_name']) && empty($row['range_name'])) {
								echo '<td align=\"left\" valign=\"middle\" style="color: blue;">Data not available</td>';		
							}
							elseif (empty($row['manufacturer_name'])) {
								echo '<td align=\"left\" valign=\"middle\" style="color: red;">Manufacturer has been deleted</td>';	
							}
							else {
								echo '<td align=\"left\" valign=\"middle\">' . $row['manufacturer_name'] . '</td>';		
							}


							// ---------- Start getting the rooms ---------- //
							/*
							echo '<td align=\"left\" valign=\"middle\">';
							
							if (!empty($row['room_id'])) {
							
								$room_array = substr($row['room_id'], 1, -1);
								$room_array = explode('|', $room_array);
								
								while (!empty($room_array)) {
									
									$room_id = array_shift($room_array);	
	
									$query2 = "SELECT * FROM rooms WHERE room_id=" . $room_id;
									$result2 = mysql_query($query2);
									
									if (mysql_num_rows($result2) == 1) {
										$row2 = mysql_fetch_assoc($result2);
										echo $row2['room_name'] . '<br />';
									}
									else {
										echo '<span style="color: red;">Room has been deleted</span><br />';	
									}
								
								}
								
							}
							else {
								echo '<span style="color: blue;">Data not available</span>';	
							}
							
							echo '</td>';
							*/
							// ---------- End getting the rooms ---------- //
							
							
							if (empty($row['pile_name']) && empty($row['range_name'])) {
								echo '<td align=\"left\" valign=\"middle\" style="color: blue;">Data not available</td>';		
							}
							elseif (empty($row['pile_name'])) {
								echo '<td align=\"left\" valign=\"middle\" style="color: red;">Pile has been deleted</td>';	
							}
							else {
								echo '<td align=\"left\" valign=\"middle\">' . $row['pile_name'] . '</td>';	
							}
							
							echo '<td align=\"left\" valign=\"middle\"><span style="display: block; width: 60px; height: 30px; background-repeat: no-repeat; background-image: url(/images/products/' . $row['product_image'] . ');"></span></td>';
							echo '<td align=\"left\" valign=\"middle\">' . $row['product_gradient'] . '</td>';
							echo '<td align=\"left\" valign=\"middle\"><a href="products-edit.php?edit=' . $row['product_id'] . '" class="button">Edit</a></td>';
							echo '<td align=\"left\" valign=\"middle\"><a onclick="deleteAlert(' . $row['product_id'] . ')" class="button" >Delete</a></td>';
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