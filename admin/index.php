<?php session_start();

	require_once('config/config.php');
	require_once('components/mysql_connect.inc');


	/* ------------------------- Start of IP Based Security Checks ------------------------- */

	//include('components/check-country.php');

	//$ip = $_SERVER['REMOTE_ADDR'];
	//$ip_data = locateIp($ip);



	/* ------------------------- End of IP Based Security Checks ------------------------- */


	/* ------------------------- Start of Login Attempts Function  ------------------------- */

	function recordLoginAttempt() {

		$query = sprintf("INSERT INTO fsclog (uid, sesip, action, action_time) VALUES('%s', '%s', '%s', NOW())",
				 mysql_real_escape_string('0'),
				 mysql_real_escape_string($_SERVER['REMOTE_ADDR']),
				 mysql_real_escape_string('Attempted Login'));

		$result = mysql_query($query);

	}

	/* ------------------------- End of Login Attempts Function  ------------------------- */


	if (isset($_POST['submitted'])) {

		if (!empty($_POST['email']) || !empty($_POST['password'])) {
			header('Location: http://www.google.com');
			exit;
		}
		else {

			// Validate the email address.
			if (!isset($erun) && empty($_POST['real_data_goes_here_1'])) {
				$erun = "You forgot to enter your email address!";
				recordLoginAttempt();
			}

			// Validate the email address.
			include('components/check-email.php');
			$validator = new EmailAddressValidator;
			if (!isset($erun) && !$validator->check_email_address($_POST['real_data_goes_here_1'])) {
				$erun = "Please enter a valid email address!";
				recordLoginAttempt();
			}

			// Validate the password.
			if (!isset($erun) && empty($_POST['real_data_goes_here_2'])) {
				$erun = "You forgot to enter your password!";
				recordLoginAttempt();
			}


			// If there are no errors...
			if (!isset($erun)) {

				// Query the database.
				$query = sprintf("SELECT * FROM users WHERE email='%s' AND password=MD5('%s') AND status='L'",
						 mysql_real_escape_string(stripslashes($_POST['real_data_goes_here_1'])),
						 mysql_real_escape_string(stripslashes($_POST['real_data_goes_here_2'])));

				$result = mysql_query($query);

				// If a match was made...
				if (mysql_num_rows($result) == 1) {

					$row = mysql_fetch_assoc($result);

					// Register the values.
					$_SESSION['user'] = $row['first_name'] . ' ' . $row['last_name'];
					$_SESSION['uid'] = $row['user_id'];
					$_SESSION['priv'] = $row['user_type'];

					// Update the Users table with the last login IP and date.
					$query = sprintf("UPDATE users SET last_login_ip='%s', last_login_date=NOW() where user_id='%s'",
						 	 mysql_real_escape_string(stripslashes($_SERVER['REMOTE_ADDR'])),
						 	 mysql_real_escape_string(stripslashes($_SESSION['uid'])));

					$result = mysql_query($query);

					// Add a new entry in the log.
					$query = sprintf("INSERT INTO fsclog (uid, sesip, action, action_time) VALUES ('%s', '%s', '%s', NOW())",
						 	 mysql_real_escape_string(stripslashes($_SESSION['uid'])),
							 mysql_real_escape_string(stripslashes($_SERVER['REMOTE_ADDR'])),
							 mysql_real_escape_string(stripslashes('User ' . $_SESSION['user'] . ' login!')));

					$result = mysql_query($query);

					// Redirect the user to the dashboard (home.php).
					header('Location: home.php');
					exit();

				}
				// If a match was NOT made...
				else {
					$erun = "Incorrect email/password combination.";
					recordLoginAttempt();
				}

			}

		}

	}
	else {

		/* ------------------------- Start of Logout/Timeout Handling  ------------------------- */

		if (isset($_GET['logout'])) {
			session_destroy();
			$erun = 'Your session has been closed!';
		}

		if (isset($_GET['timeout'])) {
			session_destroy();
			$erun = 'Your session has timed out, please re-login!';
		}

		/* ------------------------- End of Logout/Timeout Handling  ------------------------- */

	}


	/* ------------------------- Start of Login Attempts Handling  ------------------------- */

	$query = sprintf("SELECT * FROM fsclog WHERE (UNIX_TIMESTAMP(action_time) > UNIX_TIMESTAMP(NOW())-3660) AND sesip='%s' ORDER BY action_time DESC",
			 mysql_real_escape_string($_SERVER['REMOTE_ADDR']));

	$result = mysql_query($query);

	$login_attempts = 0;

	while ($row = mysql_fetch_assoc($result)) {
		if ($row['action'] == "Attempted Login") {
			$login_attempts++;
		}
		else {
			break;
		}
	}

	if ($login_attempts >= 3 ) {
		echo '<h1>You have exceeded the maximum number (3) of login attempts!</h1>';
		exit;
	}

	/* ------------------------- End of Login Attempts Handling  ------------------------- */

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BlueWave Content Management System by Digital Arts</title>
<script language="JavaScript" type="text/javascript">
<!-- Begin
function popUp(URL) {
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=500,height=300,left = 390,top = 200');");
}
// End -->
</script>
<link href="css/login.css" rel="stylesheet" type="text/css" />
</head>
<body <?php if ($erun) { echo "onload=\"alert('$erun')\""; } ?>>

	<div id="base-info">
		<?php
			echo "Login Attempts <em>({$login_attempts})</em> from address <em>({$_SERVER['REMOTE_ADDR']})</em>";
		?>
	</div>

    <div id="outer">

		<div id="login">

            <form action="" method="post" name="login-form" id="login-form">

                <strong>Email Address</strong><br />
                <input type="hidden" name="email" />
                <input type="text" name="real_data_goes_here_1" class="textbox" size="40" maxlength="60" <?php if (isset($_POST['real_data_goes_here_1'])) { echo 'value="' . stripslashes($_POST['real_data_goes_here_1']) . '"'; } ?> /><br /><br />

                <strong>Password</strong><br />
                <input type="hidden" name="password" />
                <input type="password" name="real_data_goes_here_2" class="textbox" size="25" maxlength="20" />

                <input type="hidden" name="submitted" value="TRUE" />
                <input type="submit" name="submit" value="Login" class="formbutton" />

            </form>

			<br /><br /><a href="javascript:popUp('password-help.php')">Help, i've forgotten my password!</a>

		</div>

    </div>

	<div id="top-bar">
		<?php
			$cstamp = date("Y");
			echo "&copy; $cstamp Developed by <a href=\"http://www.digitalarts.co.uk/\" target=\"_blank\">Digital Arts</a> - visit <a href=\"http://www.bluewavecms.com/\" target=\"_blank\">www.bluewavecms.com</a>";
		?>
	</div>

</body>
</html>
