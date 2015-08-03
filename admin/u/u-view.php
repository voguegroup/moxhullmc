<?php session_start();

include(dirname(__FILE__) . '/../config/config.php');

if (!$_SESSION['uid']) {
header ("Location:$cms_abs_url/index.php");
}

/* Generate Menus */
$HTTP_SESSION_VARS['T'] = 'user';
$HTTP_SESSION_VARS['S'] = 'view';
include($cms_root_url . '/components/menu-script.php');
include($cms_root_url . '/components/log-script.php');

if (isset($_GET['DEL'])) {
require($cms_root_url . '/components/mysql_connect.inc');
		
		$query = sprintf("UPDATE users SET
		status='Z' WHERE user_id='{$_GET['DEL']}'");

		$query_result = mysql_query($query);
		
		if ($query_result) {
		$erun = "User Account Deleted!";		
		} else {
		$erun = "Error, User Account NOT Deleted!";			
		}
		mysql_close();		
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
	document.getElementById('delete_alert').innerHTML = '<div id="error_message_bg"></div><div id="error_message"><p>Do you really want to delete this user?<br /><br /><input type="button" value="Yes" onclick="deleteYes('+id+')" />&nbsp;&nbsp;&nbsp;<input type="button" value="No" onclick="deleteNo()" /></p></div>';
}

function deleteYes(id) {
	location.href='u-view.php?DEL='+id;
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
		<p><img src="../images/icons/users_48.gif" alt="" name="users_icon" width="48" height="48" hspace="20" vspace="0" border="0" align="left" /><strong>Manage CMS Users</strong><br />Work with the WYSIWYG editor to add and amend front end copy content.</p>
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
				<h1>View Users</h1>
				<p>Options and systems to manage the BlueWave CMS users database</p>
			</div>
				
				<table cellpadding="10" cellspacing="0">
<tr bgcolor="#a0adb5">
<td align="left" valign="top"><strong>Name</strong></td>
<td align="left" valign="top"><strong>Email</strong></td>
<td align="left" valign="top"><strong>User Type</strong></td>
<td align="left" valign="top"><strong>Status</strong></td>
<td align="left" valign="top"><strong>Last Login</strong></td>
<td align="left" valign="top"><strong>Last IP</strong></td>
<td align="left" valign="top" colspan="2">&nbsp;</td>
</tr>

<?php

require($cms_root_url . '/components/mysql_connect.inc');

$query = "SELECT * FROM users where status NOT LIKE 'Z' ORDER BY last_name ASC";
$query_result = mysql_query($query);

if (!$query_result) {
$message  = 'Invalid query: ' . mysql_error() . "\n";
$message .= 'Whole query: ' . $query;
die($message);
}

while ($row = mysql_fetch_assoc($query_result)) {

if ($row[user_type] == 'A') {
$user_type = 'Administrator';
} elseif ($row[user_type] == 'M') {
$user_type = 'Manager';
} elseif ($row[user_type] == 'U') {
$user_type = 'User';
} elseif ($row[user_type] == 'G') {
$user_type = 'Guest User';
}

if ($row[status] == 'L') {
$status = 'Live';
} elseif ($row[user_type] == 'D') {
$status = 'Disabled';
}

print ("<tr onmouseover=\"this.style.backgroundColor='#f4f4f4';\" onmouseout=\"this.style.backgroundColor='#fafafa';\">\n");
print ("<td align=\"left\" valign=\"middle\"><strong>$row[first_name] $row[last_name]</strong></td>\n");
print ("<td align=\"left\" valign=\"middle\"><a href=\"mailto:$row[email]\">$row[email]</a></td>\n");
print ("<td align=\"left\" valign=\"middle\">$user_type</td>\n");
print ("<td align=\"left\" valign=\"middle\">$status</td>\n");
print ("<td align=\"left\" valign=\"middle\">$row[last_login_date]</td>\n");
print ("<td align=\"left\" valign=\"middle\">$row[last_login_ip]</td>\n");
print ("<td align=\"left\" valign=\"middle\"><a class=\"button\" href=\"u-edit.php?EDIT=$row[user_id]\">EDIT</a></td>\n");
if ($_SESSION['uid'] == $row[user_id]) {
print ("<td align=\"left\" valign=\"middle\"></td>\n");
} else {
print ("<td align=\"left\" valign=\"middle\"><a class=\"button\" onclick=\"deleteAlert({$row[user_id]})\">DEL</a></td>\n");
}
print ("</tr>\n");

}
mysql_free_result($query_result);
mysql_close ();
?>
</table>

<br /><input name="refresh-table" type="button" value="Refresh Page" onclick="location.href('#');" />&nbsp;&nbsp;&nbsp;<input name="print-table" type="button"  disabled="true" value="Print Table" />		
				
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