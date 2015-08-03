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

// Include DB Connection.
require($cms_root_url . '/components/mysql_connect.inc');

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php include($cms_root_url . '/components/meta.php'); ?>
<link href="<?php echo $cms_abs_url ?>/css/page.css" rel="stylesheet" type="text/css" />
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
                    <h1>Orders</h1>
                    <p>View orders</p>
                </div>
                
                <?php
				
					$query = "SELECT *, DATE_FORMAT(order_date, '%D %M %Y (%T)') AS date FROM orders ORDER BY order_date DESC";
					
					$result = mysql_query($query);
					
					if (mysql_num_rows($result) > 0) {
					
						echo '<table cellpadding="10" cellspacing="0">';
							echo '<tr bgcolor="#a0adb5">';
								echo '<td align="left" valign="top"><strong>Order Date</strong></td>';
								echo '<td align="left" valign="top"><strong>Name</strong></td>';
								echo '<td align="left" valign="top"><strong>Email</strong></td>';
								echo '<td align="left" valign="top"><strong>Telephone</strong></td>';
								echo '<td align="left" valign="top"><strong>&nbsp;</strong></td>';
							echo '</tr>';
						
						while ($row = mysql_fetch_assoc($result)) {
						
							echo '<tr onmouseover="this.style.backgroundColor=\'#f4f4f4\';" onmouseout="this.style.backgroundColor=\'#fafafa\';" style="height: 50px;">';
								echo '<td align=\"left\" valign=\"middle\">' . $row['date'] . '</td>';
								echo '<td align=\"left\" valign=\"middle\">' . $row['order_title'] . ' ' . $row['order_first_name'] . ' ' . $row['order_last_name'] . '</td>';
								echo '<td align=\"left\" valign=\"middle\"><a href="mailto:' . $row['order_email'] . '">' . $row['order_email'] . '</a></td>';
								echo '<td align=\"left\" valign=\"middle\">' . $row['order_telephone'] . '</td>';
								echo '<td align=\"left\" valign=\"middle\"><a href="orders-view-details.php?id=' . $row['order_id'] . '">View Details</a></td>';
							echo '</tr>';
						
						}
						
						echo '</table>';
					
					}
				
				
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