<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>BlueWave Content Management System by Digital Arts</title>
<style type="text/css">
    <!--
    
	body {
	background-color: #FFFFFF;
	margin: 0px;
	padding: 0px;
	}
#container {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-style: normal;
	line-height: normal;
	font-weight: normal;
	color: #666666;
	text-decoration: none;
	margin: 40px;
}
h1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 30px;
	font-style: normal;
	line-height: normal;
	font-weight: normal;
	color: #666666;
	text-decoration: none;
}
form {
	margin: 0px;
	padding: 0px;
}

    -->
    </style>
</head>

<body>
<div id="container">
<?php
function generatePassword ($length = 8)
{
  // start with a blank password
  $password = "";

  // define possible characters
  $possible = "0123456789bcdfghjkmnpqrstvwxyz"; 
    
  // set up a counter
  $i = 0; 
    
  // add random characters to $password until $length is reached
  while ($i < $length) { 

    // pick a random character from the possible ones
    $char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
        
    // we don't want this character if it's already in the password
    if (!strstr($password, $char)) { 
      $password .= $char;
      $i++;
    }
  }
  // done!
  return $password;
}

if ($_POST[runtype] == 'emsent') {

require('components/mysql_connect.inc');
		
		$query = sprintf("SELECT * FROM users WHERE email='%s' AND status='L'",
		mysql_real_escape_string($_POST['username']));
		
		$query_result = mysql_query($query);
		
		$count = mysql_num_rows($query_result);
		if ($count == 0) {
		print ("<strong>Sorry, unable to locate your account details...</strong><br /><br />Please click the back button below to retry!\n");
		exit;
		}
			
				while ($row = mysql_fetch_assoc($query_result)) {
								
								// Generate a random password
								$password = generatePassword();
								
								// Update password in database
								$query = sprintf("UPDATE users SET password=MD5('%s') WHERE user_id=%s LIMIT 1",
								mysql_real_escape_string($password),
								mysql_real_escape_string($row['user_id']));
								
								$result = mysql_query($query);

								include(dirname(__FILE__) . '/config/config.php');

								$message .= "$site_name user account details reminder, Your account details are:\n\n";
								$message .= "Username: $row[email]\n";
								$message .= "Password: $password\n\n";
								$message .= "Your password has been changed for security purposes, you can change it once you log in\n\n";
								$message .= "You may login via $cms_abs_url\n\n";
								$message .= "For technical support, please contact your project manager, $support_agent on $support_tel or email $support_email\n\n";
								$message .= "$site_name Automated Administrator\n\n";
								
								$subject = "$site_name User Account Reminder";
								$headers = "From: $site_email";
								
								mail ("$row[email]", "$subject", "$message", "$headers");

				}
		print ("<h1>Password sent</h1>\n");
		print ("Thank you, your password has been emailed to your registered email address.<br /><br />\n");
		mysql_free_result($query_result);
		mysql_close();
}

if (empty($_POST[runtype])) {
print ("<h1>Password assistant</h1>\n");
print ("Please complete the following details to recover your forgotted password...<br /><br />\n");
print ("<form action=\"password-help.php\" method=\"post\" name=\"password-help\">\n");
print ("Please enter your email address:<br />\n");
print ("<input name=\"username\" type=\"text\" size=\"36\" maxlength=\"60\" />&nbsp;&nbsp;&nbsp;<input name=\"submit\" type=\"submit\" value=\"Go\" />\n");
print ("<input name=\"runtype\" type=\"hidden\" value=\"emsent\" />\n");
print ("</form>\n");
}
?>
</div>
</body>
</html>
