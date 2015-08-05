<?php session_start();

include('../config/config.php');

if (!$_SESSION['uid']) {
header ("Location:$cms_abs_url/index.php");
}

/* Generate Menus */
$HTTP_SESSION_VARS['T'] = 'data';
$HTTP_SESSION_VARS['S'] = 'ranges';
include($cms_root_url . '/components/menu-script.php');
include($cms_root_url . '/components/log-script.php');



if ($_GET['delete']) {
	
	$query=$dbo->prepare("DELETE FROM ranges WHERE range_id= :delete");
$query->bindParam(':delete', $_GET['delete']);
$query->execute();
	
	
	if ($query) {
		$erun = 'Range Deleted';
		$srun = $erun;
		include($cms_root_url . '/components/log-script.php');
	} 
	else {
		$erun = 'Error, Range NOT Deleted';
	}
	
}


if (isset($_GET['range']) || isset($_GET['manufacturer'])) {
	
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
	$order_by_query = "ORDER BY manufacturer_name ASC, range_name ASC";	
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
<link href="<?php echo $cms_abs_url ?>/css/page.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $cms_abs_url ?>/css/home.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
function deleteAlert(id) {
	document.getElementById('delete_alert').innerHTML = '<div id="error_message_bg"></div><div id="error_message"><p>Do you really want to delete this range?<br /><br /><input type="button" value="Yes" onclick="deleteYes('+id+')" />&nbsp;&nbsp;&nbsp;<input type="button" value="No" onclick="deleteNo()" /></p></div>';
}

function deleteYes(id) {
	location.href='car-view.php?delete='+id;
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
                    <h1>Ranges</h1>
                    <p>Add, edit and delete product ranges.</p>
                </div>
            
            	<a class="button" href="car-add.php">Create New Range</a><div class="clear"></div><br />
            
                <?php
            
                    require($cms_root_url . '/components/mysql_connect.inc');
                    
                    $query = $dbo->prepare("SELECT * FROM cdf " . $order_by_query);
                    
                    $query->execute();
					
					echo '<table cellpadding="10" cellspacing="0">';
						echo '<tr bgcolor="#a0adb5">';
							echo '<td align="left" valign="top"><strong><a href="ranges-view.php?range=' . $order_by_url . '">Range</a></strong></td>';
							echo '<td align="left" valign="top"><strong><a href="ranges-view.php?manufacturer=' . $order_by_url . '">Manufacturer</a></strong></td>';
							echo '<td align="left" valign="top"><strong>Room</strong></td>';
							echo '<td align="left" valign="top"><strong>Pile</strong></td>';
							echo '<td align="left" valign="top"><strong>&nbsp;</strong></td>';
							echo '<td align="left" valign="top"><strong>&nbsp;</strong></td>';
						echo '</tr>';
                    
                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    
						echo '<tr onmouseover="this.style.backgroundColor=\'#f4f4f4\';" onmouseout="this.style.backgroundColor=\'#fafafa\';">';
							echo '<td align=\"left\" valign=\"middle\">' . $row['range_name'] . '</td>';
							
							if (empty($row['manufacturer_name'])) {
								echo '<td align=\"left\" valign=\"middle\" style="color: red;">Manufacturer has been deleted</td>';
							}
							else {
								echo '<td align=\"left\" valign=\"middle\">' . $row['manufacturer_name'] . '</td>';		
							}
							
							
							// ---------- Start getting the rooms ---------- //
							
							echo '<td align=\"left\" valign=\"middle\">';
							
							
							
							
							echo '</td>';
							
							// ---------- End getting the rooms ---------- //
							
							
							if (empty($row['pile_name'])) {
								echo '<td align=\"left\" valign=\"middle\" style="color: red;">Pile has been deleted</td>';	
							}
							else {
								echo '<td align=\"left\" valign=\"middle\">' . $row['pile_name'] . '</td>';	
							}
							
							echo '<td align=\"left\" valign=\"middle\"><a href="ranges-edit.php?edit=' . $row['range_id'] . '" class="button">Edit</a></td>';
							echo '<td align=\"left\" valign=\"middle\"><a onclick="deleteAlert(' . $row['range_id'] . ')" class="button" >Delete</a></td>';
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