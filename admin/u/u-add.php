<?php session_start();

include(dirname(__FILE__) . '/../config/config.php');

if (!$_SESSION['uid']) {
header ("Location:$cms_abs_url/index.php");
}

/* Generate Menus */
$HTTP_SESSION_VARS['T'] = 'user';
$HTTP_SESSION_VARS['S'] = 'add';
include($cms_root_url . '/components/menu-script.php');
include($cms_root_url . '/components/log-script.php');

if (isset($_POST['submit'])) {

function check_email_address($email) {

if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
return false;
}

$email_array = explode("@", $email);
$local_array = explode(".", $email_array[0]);

for ($i = 0; $i < sizeof($local_array); $i++) {
	if (!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) {
	return false;
	}
}
	
	if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) {
	$domain_array = explode(".", $email_array[1]);
		if (sizeof($domain_array) < 2) {
		return false;
		}
		
		for ($i = 0; $i < sizeof($domain_array); $i++) {
			if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i])) {
			return false;
			}
		}
		
	}
	
return true;
} 


/* Process to Add new user to the table */

		/* Check for a valid email address in the email field */
			if (!$short) {
				if (!check_email_address($_POST['email'])) { 
				$erun = 'Error, your email address was not valid!';
				$_SESSION['ltr']++;
				$short = true;
				}
		}
		
		/* Check Password is over 6 chars long */
		if (!$short) {
			if (strlen($_POST['passworda']) < 7) {
			$erun = "Password too short!";
			$short = true;
			}
		}

		/* Check Password A and B are the same */
		if (!$short) {
			if ($_POST['passworda'] != $_POST['passwordb']) {
			$erun = "Passwords do not match!";
			$short = true;
			}
		}

		/* Check no required fields are blank */
		if (!$short) {
			if ((strlen($_POST['first_name']) < 1) || (strlen($_POST['last_name']) < 1) || (strlen($_POST['email']) < 1)) {
			$erun = "Error, required field left blank!";
			$short = true;
			}
		}

				/* Check username is not already in use */
				
				if (!$short) {
				
					require($cms_root_url . '/components/mysql_connect.inc');
					
					$query = sprintf("SELECT email FROM users WHERE email='%s'",
					mysql_real_escape_string($_POST['email']));
					
					$query_result = mysql_query($query);
					
					$count = mysql_num_rows($query_result);
					if ($count >= 1) {
					$erun = "Username / Email already in use!";
					}
					
					mysql_free_result($query_result);
					mysql_close();
					
				}
				
						/* Insert the new user into the table */
						
						if (!$short) {
						
						require($cms_root_url . '/components/mysql_connect.inc');
		
						$query = sprintf("INSERT into users SET
						first_name='%s',
						last_name='%s',
						email='%s',
						password='%s',
						user_type='%s',
						status='%s',
						last_login_ip='0.0.0.0',
						last_login_date=NOW(),
						account_created=NOW()",
						mysql_real_escape_string($_POST['first_name']),
						mysql_real_escape_string($_POST['last_name']),
						mysql_real_escape_string($_POST['email']),
						mysql_real_escape_string(md5($_POST['passworda'])),
						mysql_real_escape_string($_POST['user_type']),
						mysql_real_escape_string($_POST['status']));
						
						$query_result = mysql_query($query);
						
						if ($query_result) {

								if (isset($_POST['notify'])) {
								
								$message .= "Please Note...\n\n"; 
								$message .= "You have been added to the $site_name Administration system. Your account details are:\n\n";
								$message .= "Username: {$_POST['email']}\n";
								$message .= "Password: {$_POST['passworda']}\n\n";
								$message .= "You may login via $cms_abs_url/index.php\n\n";
								$message .= "For technical support, please contact your project manager, $support_agent on $support_tel or email $support_email\n\n";
								$message .= "$site_name Automated Administrator\n\n";
								
								$subject = "$site_name Administrator Account Created";
								$headers = "From: BlueWave CMS Administrator";
								
								mail ("{$_POST['email']}", "$subject", "$message", "$headers");
								
								}

										if (!$_POST['addmore']) {
										header ("Location:u-menu.php?erun=User {$_POST['first_name']} {$_POST['last_name']} successfully added!");
										} else {
										header ("Location:u-add.php?erun=User {$_POST['first_name']} {$_POST['last_name']} successfully added!");
										}
	
								} else {
								$erun="Error, user {$_POST['first_name']} {$_POST['last_name']} not added, please re-try!";
								}
						mysql_close();
						}
}

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
				<h1>Add User</h1>
				<p>Options and systems to manage the BlueWave CMS users database</p>
			</div>
			
			<p><strong>Please Note:</strong> fields marked <img src="../images/icon-required-field.gif" alt="This is a required field and *MUST* be completed" name="required-field-icon" width="18" height="18" hspace="10" vspace="0" border="0" align="middle" /> are required!</p>
			
<form action="u-add.php" method="POST">

<strong>First Name:</strong> <em>(Enter users first name)</em><br />
<input name="first_name" value="<?php echo $_POST['first_name']; ?>" type="text" size="70" maxlength="60" /><img src="../images/icon-required-field.gif" alt="This is a required field and *MUST* be completed" name="required-field-icon" width="18" height="18" hspace="10" vspace="0" border="0" align="middle" /><br /><br />

<strong>Surname:</strong> <em>(Enter users last name)</em><br />
<input name="last_name"  value="<?php echo $_POST['last_name']; ?>" type="text" size="70" maxlength="60" /><img src="../images/icon-required-field.gif" alt="This is a required field and *MUST* be completed" name="required-field-icon" width="18" height="18" hspace="10" vspace="0" border="0" align="middle" /><br /><br />

<strong>Email:</strong> <em>(Email address will serve as username)</em><br />
<input name="email"  value="<?php echo $_POST['email']; ?>" type="text" size="70" maxlength="60" /><img src="../images/icon-required-field.gif" alt="This is a required field and *MUST* be completed" name="required-field-icon" width="18" height="18" hspace="10" vspace="0" border="0" align="middle" /><br /><br />

<strong>Password:</strong> <em>(Select a unique password - between 7 and 12 Charactors)</em><br />
<input name="passworda" type="password" size="50" maxlength="12" /><img src="../images/icon-required-field-caution.gif" alt="This is a required field with specific data requirements" name="required-field-caution-icon" width="18" height="18" hspace="10" vspace="0" border="0" align="middle" /><br /><br />

<strong>Re-enter Password:</strong><br />
<input name="passwordb" type="password" size="50" maxlength="12" /><img src="../images/icon-required-field-caution.gif" alt="This is a required field with specific data requirements" name="required-field-caution-icon" width="18" height="18" hspace="10" vspace="0" border="0" align="middle" /><br /><br />


<strong>User Type:</strong> <em>(Select the users access level)</em><br />
<select name="user_type" size="1">
<option value="A">Administrator</option>
<option value="M">Manager</option>
<option value="U">User</option>
<option value="G">Guest User</option>
</select><br /><br />

<strong>User Status:</strong> <em>(Select the users initial status)</em><br />
<select name="status" size="1">
<option value="L">Live</option>
<option value="D">Disabled</option>
</select><br /><br />

<input name="notify" type="checkbox" value="yes" />&nbsp;&nbsp;Confirm details by email to new user?<br /><br />
<input name="addmore" type="checkbox" value="yes" />&nbsp;&nbsp;Add Another more users after this one?<br /><br />

<input name="submit" type="submit" value="Add New User" />

</form>	
				
			</div>
			
		</div>
		
	</div>
	
</div>

<div id="footer">
		<?php include($cms_root_url . '/components/footer.php'); ?>
</div>
</body>
</html>
