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



if ($_GET['delete']) {
	
	$query=$dbo->prepare("DELETE FROM stock WHERE id= :delete");
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
                    <h1>Cars</h1>
                    <p>Add, edit and delete cars.</p>
                </div>
            
            	<a class="button" href="car-add.php">Create New Car</a>
            	<div class="clear"></div><br />
            
                <?php
                    
                    $query = $dbo->prepare("SELECT * FROM stock ");
                    
                    $query->execute();
					
					echo '<table cellpadding="10" cellspacing="0">';
						echo '<tr bgcolor="#a0adb5">';
							echo '<td align="left" valign="top"><strong>Edit</strong></td>';
							echo '<td align="left" valign="top"><strong>Make</strong></td>';
							echo '<td align="left" valign="top"><strong>Model</strong></td>';
							echo '<td align="left" valign="top"><strong>Year</strong></td>';
							echo '<td align="left" valign="top"><strong>Price</strong></td>';
						echo '</tr>';
                    
                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    
						echo '<tr onmouseover="this.style.backgroundColor=\'#f4f4f4\';" onmouseout="this.style.backgroundColor=\'#fafafa\';">';
							
							echo '<td align=\"left\" valign=\"middle\"><a href="car-edit.php?id=' . $row['id'] . '">EDIT ICON</a></td>';
							
							
							echo '<td align=\"left\" valign=\"middle\">' . $row['Make'] . '</td>';
							
							
								echo '<td align=\"left\" valign=\"middle\">' . $row['Model'] . '</td>';		
							
							
			
							
							echo '<td align=\"left\" valign=\"middle\">' . $row['Year'] . '</td>';
							
							
							echo '<td align=\"left\" valign=\"middle\">&pound;' . $row['Price'] . '</td>';
							
						
							
							
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