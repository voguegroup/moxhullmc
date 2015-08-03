<?php session_start();

include(dirname(__FILE__) . '/../config/config.php');

if (!$_SESSION['uid']) {
header ("Location:$cms_abs_url/index.php");
}

function truncate($string, $limit, $break=".", $pad="...") 
{ 
	// return with no change if string is shorter than $limit  
	if (strlen($string) <= $limit) return $string;

	// is $break present between $limit and the end of the string?
 	if (false !== ($breakpoint = strpos($string, $break, $limit))) 
	{ 
		if($breakpoint < strlen($string) - 1) 
		{ 
			$string = substr($string, 0, $breakpoint) . $pad; } 
		} 
	return $string; 
}

if ($_GET['delete']) {

	require($cms_root_url . '/components/mysql_connect.inc');
	
	$query = "DELETE FROM pages WHERE page_id=" . mysql_real_escape_string($_GET['delete']);
	
	$result = mysql_query($query);
	
	if ($result) {
		$erun = 'Page Deleted';
		$srun = $erun;
		include($cms_root_url . '/components/log-script.php');
	} 
	else {
		$erun = 'Error, Page NOT Deleted';
	}
	
}

/* Generate Menus */
$HTTP_SESSION_VARS['T'] = 'front';
$HTTP_SESSION_VARS['S'] = 'page_view';
include($cms_root_url . '/components/menu-script.php');
include($cms_root_url . '/components/log-script.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php include($cms_root_url . '/components/meta.php'); ?>
<link href="<?php echo $cms_abs_url ?>/css/page.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $cms_abs_url ?>/css/home.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
function deleteAlert(id) {
	document.getElementById('delete_alert').innerHTML = '<div id="error_message_bg"></div><div id="error_message"><p>Do you really want to delete this content page?<br /><br /><input type="button" value="Yes" onclick="deleteYes('+id+')" />&nbsp;&nbsp;&nbsp;<input type="button" value="No" onclick="deleteNo()" /></p></div>';
}

function deleteYes(id) {
	location.href='page-view.php?delete='+id;
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
		<img src="../images/icons/content_48.gif" name="icon-front" width="48" height="48" hspace="20" vspace="0" border="0" align="left" id="icon-front" /><p><strong>Manage Front End Content</strong><br />Work with the WYSIWYG editor to add and amend front end copy content.</p>
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
                    <h1>View Content Pages</h1>
                    <p>Add, edit and delete content pages.</p>
                </div>
                
                <a class="button" href="page-add.php">Create New Page</a><div class="clear"></div><br />
    
                <ul id="home-menu">
    
                <?php
            
                    require($cms_root_url . '/components/mysql_connect.inc');
                    
                    $query = "SELECT * FROM pages ORDER BY page_id ASC";
                    
                    $query_result = mysql_query($query);
					
					echo '<table cellpadding="10" cellspacing="0">';
						echo '<tr bgcolor="#a0adb5">';
							echo '<td align="left" valign="top"><strong>ID</strong></td>';
							echo '<td align="left" valign="top"><strong>URL</strong></td>';
							echo '<td align="left" valign="top"><strong>Title</strong></td>';
							echo '<td align="left" valign="top"><strong>Description</strong></td>';
							echo '<td align="left" valign="top"><strong>&nbsp;</strong></td>';
							echo '<td align="left" valign="top"><strong>&nbsp;</strong></td>';
						echo '</tr>';
                    
                    while ($row = mysql_fetch_assoc($query_result)) {
                    
						echo '<tr onmouseover="this.style.backgroundColor=\'#f4f4f4\';" onmouseout="this.style.backgroundColor=\'#fafafa\';" style="height: 50px;">';
							echo '<td align=\"left\" valign=\"middle\" class="td-document-bg">' . $row['page_id'] . '</td>';
							echo '<td align=\"left\" valign=\"middle\">/' . $row['page_url'] . '</td>';
							echo '<td align=\"left\" valign=\"middle\">' . $row['page_title'] . '</td>';
							echo '<td align=\"left\" valign=\"middle\">' . truncate($row['page_description'], "80", " ") . '</td>';
							echo '<td align=\"left\" valign=\"middle\"><a href="page-edit.php?edit=' . $row['page_id'] . '" class="button">Edit</a></td>';
							echo '<td align=\"left\" valign=\"middle\"><a onclick="deleteAlert(' . $row['page_id'] . ')" class="button" >Delete</a></td>';
						echo '</tr>';
                    
                    }
                    
					echo '</table>';
            
                ?>				
                    
                </ul>				
	
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