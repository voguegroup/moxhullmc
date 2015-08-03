<?php
// Function to build omain name
function domain_name() {
	$domain = "http";
	if ($_SERVER["HTTPS"] == "on") {
		$domain .= "s";
	}
	$domain .= "://";
	$domain .= $_SERVER['SERVER_NAME'];
	return $domain;
}

// If form has been submitted
if($_POST) {
	// Validate fields
	if(empty($_POST['site_name']) && empty($erun)) {
		$erun = "Please enter a Site Name";
	}
	
	if(empty($_POST['site_url']) && empty($erun)) {
		$erun = "Please enter a Site URL";
	}
	
	if(empty($_POST['site_email']) && empty($erun)) {
		$erun = "Please enter a Site Email Address";
	}
	
	if(empty($_POST['support_tel']) && empty($erun)) {
		$erun = "Please enter a Support Telephone Number";
	}
	
	if(empty($_POST['support_email']) && empty($erun)) {
		$erun = "Please enter a Support Email Address";
	}
	
	if(empty($_POST['support_url']) && empty($erun)) {
		$erun = "Please enter a Support URL";
	}
	
	if(empty($_POST['support_agent']) && empty($erun)) {
		$erun = "Please enter a Support Agent Name";
	}
	
	if(empty($_POST['cms_install_url']) && empty($erun)) {
		$erun = "Please enter the Support Installation Directory";
	}
	
	if(empty($_POST['default_first_name']) && empty($erun)) {
		$erun = "Please enter a Default User First Name";
	}
	
	if(empty($_POST['default_last_name']) && empty($erun)) {
		$erun = "Please enter a Default User Last Name";
	}
	
	if(empty($_POST['default_email']) && empty($erun)) {
		$erun = "Please enter a Default User Email Address";
	}
	
	if(empty($_POST['default_passworda']) && empty($erun)) {
		$erun = "Please enter a Default CMS User Password";
	}
	
	if(($_POST['default_passworda'] != $_POST['default_passwordb']) && empty($erun)) {
		$erun = "CMS User passwords do not match";
	}
	
	if(empty($_POST['db_host']) && empty($erun)) {
		$erun = "Please enter a Database Host Name";
	}
	
	if(empty($_POST['db_user']) && empty($erun)) {
		$erun = "Please enter a Database Username";
	}
	
	if(empty($_POST['db_passworda']) && empty($erun)) {
		$erun = "Please enter a Database Password";
	}
	
	if(($_POST['db_passworda'] != $_POST['db_passwordb']) && empty($erun)) {
		$erun = "Database passwords do not match";
	}
	
	if(empty($_POST['db_name']) && empty($erun)) {
		$erun = "Please enter a Database Name";
	}
	
	// If everything validated, install Bluewave CMS
	if(!$erun) {
		// Retrieve all posted information
		$site_name = stripslashes($_POST['site_name']);
		$site_url = stripslashes($_POST['site_url']);
		$site_email = stripslashes($_POST['site_email']);
		if(!empty($_POST['stats_link'])) {
			$stats_link = stripslashes($_POST['stats_link']);
		} else {
			$stats_link = NULL;
		}
		
		$support_tel = stripslashes($_POST['support_tel']);
		$support_email = stripslashes($_POST['support_email']);
		$support_url = stripslashes($_POST['support_url']);
		$support_agent = stripslashes($_POST['support_agent']);
		if(!empty($_POST['support_pin'])) {
			$support_pin = stripslashes($_POST['support_pin']);
		} else {
			$support_pin = NULL;
		}
		
		$cms_install_url = stripslashes($_POST['cms_install_url']);
		$default_first_name = stripslashes($_POST['default_first_name']);
		$default_last_name = stripslashes($_POST['default_last_name']);
		$default_email = stripslashes($_POST['default_email']);
		$default_password = stripslashes($_POST['default_passworda']);
		
		$db_host = stripslashes($_POST['db_host']);
		$db_user = stripslashes($_POST['db_user']);
		$db_pass = stripslashes($_POST['db_passworda']);
		$db_name = stripslashes($_POST['db_name']);
		
		
		// Create the config.php file
		$config_filename = dirname(__FILE__) . "/../config/config.php";
		$config_file = fopen($config_filename, 'w') or die ("Can't create config.php");
		
		// Create config file data
		$config_data = "<?php // Config file for Bluewave CMS\r\r";
		
		$config_data .= "// Client site details\r";
		$config_data .= '$site_name = "' .$site_name. "\"; // e.g. Company name\r";
		$config_data .= '$site_url = "' .$site_url. "\"; // Client site URL\r";
		$config_data .= '$site_email = "' .$site_email. "\"; // For sending emails such as new user alerts\r";
		$config_data .= '$stats_link = "' .$stats_link. "\"; // For viewing site analytics\r\r";
		
		$config_data .= "// Support details\r";
		$config_data .= '$support_tel = "' .$support_tel. "\";\r";
		$config_data .= '$support_email = "' .$support_email. "\";\r";
		$config_data .= '$support_url = "' .$support_url. "\";\r";
		$config_data .= '$support_agent = "' .$support_agent. "\";\r";
		$config_data .= '$support_pin = "' .$support_pin. "\";\r\r";
		
		$config_data .= "// CMS setup\r";
		$config_data .= '$cms_dir = "' .$cms_install_url. "\"; // e.g. '/admin'\r";
		$config_data .= '$cms_abs_url = "' .$site_url.$cms_install_url. "\"; // e.g. 'http://www.domain.com/admin'\r";
		$config_data .= '$cms_root_url = "' .$_SERVER['DOCUMENT_ROOT'].$cms_install_url. "\"; // e.g. '/home/username/public_html/admin'\r\r";
		
		$config_data .= "// Database details\r";
		$config_data .= '$db_host = \'' . $db_host . '\'; // e.g. \'localhost\'' . "\r";
		$config_data .= '$db_user = \'' . $db_user . '\'; // MySQL username' . "\r";
		$config_data .= '$db_pass = \'' . $db_pass . '\'; // MySQL password' . "\r";
		$config_data .= '$db_name = \'' . $db_name . '\'; // MySQL database name' . "\r";
		
		$config_data .= '?>';
		
		fwrite($config_file, $config_data);
		fclose($config_file);
		chmod($config_filename, 0777);
		
		
		// Create the database tables
		
		// Connect to database
		$connection = mysql_connect($db_host, $db_user, $db_pass);
		mysql_select_db($db_name);
		
		// Create Users database
		$query = "CREATE TABLE users (
user_id smallint(3) unsigned NOT NULL auto_increment,
first_name varchar(60) NOT NULL,
last_name varchar(60) NOT NULL,
email varchar(60) NOT NULL,
password varchar(32) not null,
user_type char(1) not null,
status char(1) not null,
last_login_ip varchar(20) not null,
last_login_date datetime,
account_created datetime,
INDEX (email, password),
PRIMARY KEY (user_id)
);";

		$result = mysql_query($query) or $error['users']="Users table could not be created. MySQL error: " .mysql_error();
		
		// Create User Log table
		$query = "CREATE TABLE fsclog (
fsclog_id smallint(7) unsigned NOT NULL auto_increment,
uid smallint(3) NOT NULL,
sesip varchar(20) NOT NULL,
action varchar(100) not null,
action_time datetime,
PRIMARY KEY (fsclog_id)
);";

		$result = mysql_query($query) or $error['userlog']="User Log table could not be created. MySQL error: " .mysql_error();
		
		// Create User Log table
		$query = "CREATE TABLE pages (
page_id int(10) unsigned NOT NULL auto_increment,
page_title varchar(100) NOT NULL,
page_description text NOT NULL,
meta_title varchar(255) default NULL,
meta_description text,
meta_keywords varchar(255) default NULL,
rss_url varchar(255) default NULL,
page_url varchar(255) NOT NULL,
page_content text NOT NULL,
PRIMARY KEY  (page_id),
FULLTEXT KEY page_title (page_title, page_description, meta_keywords, page_content)
);";

		$result = mysql_query($query) or $error['pages']="Pages table could not be created. MySQL error: " .mysql_error();
		
		// Add default user
		if(!$error) {
			$query = sprintf("INSERT INTO users
(first_name, last_name, email, password, user_type, status, last_login_ip, last_login_date, account_created) VALUES
('%s', '%s', '%s', '%s', 'A', 'L', '0.0.0.0', NULL, NOW())",
mysql_real_escape_string($default_first_name),
mysql_real_escape_string($default_last_name),
mysql_real_escape_string($default_email),
md5(mysql_real_escape_string($default_password)));
			
			$result = mysql_query($query) or $error['default_user']="Default user could not be created. MySQL error: " .mysql_error();
			
			// Send confirmation email to default user
			$message .= "Please Note...\n\n"; 
			$message .= "You have been added to the $site_name Administration system. Your account details are:\n\n";
			$message .= "Username: $default_email\n";
			$message .= "Password: $default_password\n\n";
			$message .= "You may login via $site_url$cms_install_url\n\n";
			$message .= "For technical support, please contact your project manager, $support_agent on $support_tel or email $support_email\n\n";
			$message .= "$site_name Automated Administrator\n\n";
			
			$subject = "$site_name Administrator Account Created";
			$headers = "From: BlueWave CMS Administrator <$site_email>";
			
			mail ($default_email, "$subject", "$message", "$headers");
		}
		
		// Forward to success or fail page depending on result
		if(!$error) {
			header("Location: success.php");
			exit();
		}
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Bluewave CMS Setup</title>

<style type="text/css">
body {
	background-color: #A0ADB5;
	font-family: Arial, Helvetica, sans-serif;
}

#container {
	width: 730px;
	margin: 0 auto;
	background-color: #ffffff;
	border: 1px solid #113247;
	padding: 20px;
}

h1 {
	margin: 0 0 10px 0;
	color: #113247;
}

h2 {
	background-color: #A0ADB5;
	color: #ffffff;
	font-size: 1em;
	padding: 5px;
	margin-top: 20px;
}

table {
	width: 100%;
	margin-bottom: 20px;
}

ul {
	list-style-type: square;
	list-style-position: inside;
	padding: 0;
}
</style>
</head>

<?php
if (isset($erun)) {
print ("<body onload=\"alert('$erun')\">\n");
} else {
print ("<body>\n");
}
?>

<div id="container">

<?php
if ($error) {
	?>
	<h1>Error!</h1>
	<p><strong>Bluewave CMS</strong> could not be installed for the following reason(s):</p>
	<ul>
	<?php
	foreach($error as $value) {
		echo "<li>$value</li>\n";
	}
	?>
	</ul>
	<?php
} else {
	?>
	<h1>Bluewave CMS Setup</h1>
	
	<form method="post" action="">
	<table border="0">
	<tr>
	<td colspan="3"><h2>Client Site Details</h2></td>
	</tr>
	
	<tr>
	<td>Site Name:</td>
	<td><input type="text" id="site_name" name="site_name" size="30" value="<?php echo stripslashes($_POST['site_name']); ?>" /> *</td>
	<td>(e.g. My Website)</td>
	</tr>
	
	<tr>
	<td>Site URL:</td>
	<td><input type="text" id="site_url" name="site_url" size="30" value="<?php echo ($_POST) ? stripslashes($_POST['site_url']) : domain_name(); ?>" /> *</td>
	<td>(e.g. http://www.domain.com)</td>
	</tr>
	
	<tr>
	<td>Site Email:</td>
	<td><input type="text" id="site_email" name="site_email" size="30" value="<?php echo stripslashes($_POST['site_email']); ?>" /> *</td>
	<td>(e.g. admin@domain.com)</td>
	</tr>
	
	<tr>
	<td>Stats Link:</td>
	<td><input type="text" id="stats_link" name="stats_link" size="30" value="<?php echo stripslashes($_POST['stats_link']); ?>" /></td>
	<td>(e.g. http://www.google.com/analytics)</td>
	</tr>
	
	<tr>
	<td colspan="3"><h2>Support</h2></td>
	</tr>
	
	<tr>
	<td>Support Tel:</td>
	<td><input type="text" id="support_tel" name="support_tel" size="30" value="<?php echo ($_POST) ? stripslashes($_POST['support_tel']) : "0870 307 0002"; ?>" /> *</td>
	<td>(e.g. 0870 307 0002)</td>
	</tr>
	
	<tr>
	<td>Support Email:</td>
	<td><input type="text" id="support_email" name="support_email" size="30" value="<?php echo ($_POST) ? stripslashes($_POST['support_email']) : "support@bluewavecms.com"; ?>" /> *</td>
	<td>(e.g. support@bluewavecms.com)</td>
	</tr>
	
	<tr>
	<td>Support URL:</td>
	<td><input type="text" id="support_url" name="support_url" size="30" value="<?php echo ($_POST) ? stripslashes($_POST['support_url']) : "http://www.bluewavecms.com"; ?>" /> *</td>
	<td>(e.g. http://www.bluewavecms.com)</td>
	</tr>
	
	<tr>
	<td>Support Agent:</td>
	<td><input type="text" id="support_agent" name="support_agent" size="30" value="<?php echo ($_POST) ? stripslashes($_POST['support_agent']) : "Paul Summers"; ?>" /> *</td>
	<td>(e.g. Paul Summers)</td>
	</tr>
	
	<tr>
	<td>Support PIN:</td>
	<td><input type="text" id="support_pin" name="support_pin" size="30" value="<?php echo stripslashes($_POST['support_pin']); ?>" /></td>
	<td>(only if support is installed)</td>
	</tr>
	
	<tr>
	<td colspan="3"><h2>CMS Setup</h2></td>
	</tr>
	
	<tr>
	<td>CMS Installation Directory:</td>
	<td><input type="text" id="cms_install_url" name="cms_install_url" size="30" value="<?php echo ($_POST) ? stripslashes($_POST['cms_install_url']) : "/admin"; ?>" /> *</td>
	<td>(e.g. /admin)</td>
	</tr>
	
	<tr>
	<td>Default User First Name:</td>
	<td><input type="text" id="default_first_name" name="default_first_name" size="30" value="<?php echo stripslashes($_POST['default_first_name']); ?>" /> *</td>
	<td>(e.g. 'John')</td>
	</tr>
	
	<tr>
	<td>Default User Last Name:</td>
	<td><input type="text" id="default_last_name" name="default_last_name" size="30" value="<?php echo stripslashes($_POST['default_last_name']); ?>" /> *</td>
	<td>(e.g. 'Smith')</td>
	</tr>
	
	<tr>
	<td>Default User Email Address:</td>
	<td><input type="text" id="default_email" name="default_email" size="30" value="<?php echo stripslashes($_POST['default_email']); ?>" /> *</td>
	<td>(e.g. 'johnsmith@domain.com')</td>
	</tr>
	
	<tr>
	<td>Default User Password:</td>
	<td><input type="password" id="default_passworda" name="default_passworda" size="30" value="<?php echo stripslashes($_POST['default_passworda']); ?>" /> *</td>
	</tr>
	
	<tr>
	<td>Confirm Password:</td>
	<td><input type="password" id="default_passwordb" name="default_passwordb" size="30" value="<?php echo stripslashes($_POST['default_passwordb']); ?>" /> *</td>
	</tr>
	
	<tr>
	<td colspan="3"><h2>Database Connection</h2></td>
	</tr>
	
	<tr>
	<td>Host name:</td>
	<td><input type="text" id="db_host" name="db_host" size="30" value="<?php echo ($_POST) ? stripslashes($_POST['db_host']) : "localhost"; ?>" /> *</td>
	<td>(e.g. localhost)</td>
	</tr>
	
	<tr>
	<td>Username:</td>
	<td><input type="text" id="db_user" name="db_user" size="30" value="<?php echo stripslashes($_POST['db_user']); ?>" /> *</td>
	<td>(e.g. Default)</td>
	</tr>
	
	<tr>
	<td>Password:</td>
	<td><input type="password" id="db_passworda" name="db_passworda" size="30" value="<?php echo stripslashes($_POST['db_passworda']); ?>" /> *</td>
	</tr>
	
	<tr>
	<td>Confirm Password:</td>
	<td><input type="password" id="db_passwordb" name="db_passwordb" size="30" value="<?php echo stripslashes($_POST['db_passwordb']); ?>" /> *</td>
	</tr>
	
	<tr>
	<td>Database Name:</td>
	<td><input type="text" id="db_name" name="db_name" size="30" value="<?php echo stripslashes($_POST['db_name']); ?>" /> *</td>
	<td>(e.g. database1)</td>
	</tr>
	</table>
	
	<input type="submit" name="submit" value="Install Bluewave CMS" />
	
	<br /><br />
	</form>
	<?php
}
?>
</div>
</body>
</html>