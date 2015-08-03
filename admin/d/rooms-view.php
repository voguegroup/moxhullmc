<?php session_start();

include(dirname(__FILE__) . '/../config/config.php');

if (!$_SESSION['uid']) {
header ("Location:$cms_abs_url/index.php");
}

/* Generate Menus */
$HTTP_SESSION_VARS['T'] = 'data';
$HTTP_SESSION_VARS['S'] = 'rooms';
include($cms_root_url . '/components/menu-script.php');
include($cms_root_url . '/components/log-script.php');

// Include DB Connection.
require($cms_root_url . '/components/mysql_connect.inc');

/*if ($_POST['submitted']) {
	
	$query = sprintf("INSERT INTO rooms (room_name) VALUES ('%s')",
	mysql_real_escape_string(stripslashes($_POST['room_name'])));
	
	$result = mysql_query($query);
	
	if ($result) {
		$srun = 'Room "' . mysql_real_escape_string(stripslashes($_POST['room_name'])) . '" Added';
		include($cms_root_url . '/components/log-script.php');
	}
	
}
else {*/
	if ($_GET['delete']) {
		
		$query = "DELETE FROM rooms WHERE room_id=" . mysql_real_escape_string($_GET['delete']);
		
		$result = mysql_query($query);
		
		if ($result) {
			$erun = 'Room Deleted';
			$srun = $erun;
			include($cms_root_url . '/components/log-script.php');
		} 
		else {
			$erun = 'Error, Room NOT Deleted';
		}
		
	}	
/*}*/

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php include($cms_root_url . '/components/meta.php'); ?>
<link href="<?php echo $cms_abs_url ?>/css/page.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
function deleteAlert(id) {
	document.getElementById('delete_alert').innerHTML = '<div id="error_message_bg"></div><div id="error_message"><p>Do you really want to delete this room?<br /><br /><input type="button" value="Yes" onclick="deleteYes('+id+')" />&nbsp;&nbsp;&nbsp;<input type="button" value="No" onclick="deleteNo()" /></p></div>';
}

function deleteYes(id) {
	location.href='rooms-view.php?delete='+id;
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
                    <h1>Product Type </h1>
                    <p>Add and remove product types.</p>
                </div>
                
				<a class="button" href="rooms-add.php">Create New Product Type </a>
				<div class="clear"></div><br />
            
                <?php
            
                    require($cms_root_url . '/components/mysql_connect.inc');
                    
                    $query = "SELECT * FROM rooms ORDER by room_name ASC";
                    
                    $query_result = mysql_query($query);
					
					if (mysql_num_rows($query_result) > 0) {
						
						echo '<br />';
					
						echo '<table cellpadding="10" cellspacing="0">';
							echo '<tr bgcolor="#a0adb5">';
								echo '<td align="left" valign="top"><strong>Room</strong></td>';
								echo '<td align="left" valign="top"><strong>Room Image</strong></td>';
								echo '<td align="left" valign="top"><strong>&nbsp;</strong></td>';
								echo '<td align="left" valign="top"><strong>&nbsp;</strong></td>';
							echo '</tr>';
						
						while ($row = mysql_fetch_assoc($query_result)) {
						
							echo '<tr onmouseover="this.style.backgroundColor=\'#f4f4f4\';" onmouseout="this.style.backgroundColor=\'#fafafa\';">';
								echo '<td align="left" valign="middle">' . $row['room_name'] . '</td>';
								echo '<td valign="middle" style="text-align: center;"><img src="/images/rooms/' . $row['room_image'] . '" alt="" /></td>';
								echo '<td align="left" valign="middle"><a href="rooms-edit.php?edit=' . $row['room_id'] . '" class="button">Edit</a></td>';
								echo '<td align="left" valign="middle"><a onclick="deleteAlert(' . $row['room_id'] . ')" class="button" >Delete</a></td>';
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