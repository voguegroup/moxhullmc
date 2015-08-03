<?php session_start();

include(dirname(__FILE__) . '/../config/config.php');

if (!$_SESSION['uid']) {
header ("Location:$cms_abs_url/index.php");
}

/* Generate Menus */
$HTTP_SESSION_VARS['T'] = 'user';
$HTTP_SESSION_VARS['S'] = 'logs';
include($cms_root_url . '/components/menu-script.php');
include($cms_root_url . '/components/log-script.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php include($cms_root_url . '/components/meta.php'); ?>
<link href="<?php echo $cms_abs_url ?>/css/page.css" rel="stylesheet" type="text/css" />

<script language="JavaScript" type="text/JavaScript">
<!--
function Menu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}

function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
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
				<h1>View Usage Logs</h1>
				<p>Options and systems to manage the BlueWave CMS users database</p>
			</div>
				
				<div><form name="form1" id="form1">
  <select name="menu1" onchange="MM_jumpMenu('parent',this,0)">
    <option> -- Select number of logs to view --</option>
	<option value="u-logs.php?shown=25">25</option>
	<option value="u-logs.php?shown=50">50</option>
	<option value="u-logs.php?shown=100">100</option>
	<option value="u-logs.php?shown=200">200</option>
	<option value="u-logs.php?shown=500">500</option>
	<option value="u-logs.php?shown=1000">1000</option>
  </select>
</form></div><br />			
				
				<table border="1" cellpadding="10" cellspacing="0" bordercolor="#ffffff" bgcolor="#fafafa">
<tr bgcolor="#CCCCCC">
<td align="left" valign="top"><strong>Log ID</strong></a></td>
<td align="left" valign="top"><strong>User Name</strong></a></td>
<td align="left" valign="top"><strong>IP Address</strong></td>
<td align="left" valign="top"><strong>Date / Time</strong></td>
<td align="left" valign="top"><strong>Action</strong></td>
</tr>

<?php

require($cms_root_url . '/components/mysql_connect.inc');

if ($_GET['shown']) {
$query = "SELECT * FROM fsclog, users WHERE (fsclog.uid = users.user_id) ORDER BY fsclog_id DESC LIMIT {$_GET['shown']}";
} else {
$query = "SELECT * FROM fsclog, users WHERE (fsclog.uid = users.user_id) ORDER BY fsclog_id DESC LIMIT 25";
}

$query_result = mysql_query($query);

if (!$query_result) {
$message  = 'Invalid query: ' . mysql_error() . "\n";
$message .= 'Whole query: ' . $query;
die($message);
}

while ($row = mysql_fetch_assoc($query_result)) {
	if (!$row[user]) {
	$user = 'Unknown';
	} else {
	$user = $row[user];
	}
print ("<tr onmouseover=\"this.style.backgroundColor='#f4f4f4';\" onmouseout=\"this.style.backgroundColor='#fafafa';\">\n");
print ("<td align=\"left\" valign=\"middle\">$row[fsclog_id]</td>\n");
print ("<td align=\"left\" valign=\"middle\">$row[first_name] $row[last_name]</td>\n");
print ("<td align=\"left\" valign=\"middle\">$row[sesip]</td>\n");
print ("<td align=\"left\" valign=\"middle\">$row[action_time]</td>\n");
print ("<td align=\"left\" valign=\"middle\">$row[action]</td>\n");
print ("</tr>\n");
}

mysql_free_result($query_result);
mysql_close();
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
</body>
</html>
