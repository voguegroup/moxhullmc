<?php session_start();

require_once('config/config.php');

	/* ------------------------- Start of Login Attempts Function  ------------------------- */

function recordLoginAttempt() {
global $dbo; // We have to declare this as a global function since it's wrapped in a function
$sql=$dbo->prepare("INSERT INTO fsclog (uid, sesip, action, action_time) VALUES(:uid, :sesip, :action, :action_time)");
$sql->execute(array(
":uid" => '0',
":sesip" => $_SERVER['REMOTE_ADDR'],
":action" =>	 'Attempted Login',
":action_time" => gmdate("Y-m-d H:i:s")
));	
	

	}

	/* ------------------------- End of Login Attempts Function  ------------------------- */


	if (isset($_POST['submitted'])) {

			// Validate the email address.
			if (empty($_POST['real_data_goes_here_1'])) {
				$erun = "You forgot to enter your email address!";
				recordLoginAttempt();
			}

			
			// Validate the password.
			if (empty($_POST['real_data_goes_here_2'])) {
				$erun = "You forgot to enter your password!";
				recordLoginAttempt();
			}


			// If there are no errors...
			if (!isset($erun)) {


$query = $dbo->prepare("SELECT * FROM users WHERE email = :email AND password = :password AND status='L'");
$query->bindParam(':email', $_POST['real_data_goes_here_1']);
$query->bindParam(':password', md5($_POST['real_data_goes_here_2']));
$query->execute();

$total = $query->rowCount();
$row = $query->fetch();

if($total == 1){
	$_SESSION['user'] = $row['first_name'] . ' ' . $row['last_name'];
	$_SESSION['uid'] = $row['user_id'];
	$_SESSION['priv'] = $row['user_type'];
	
	//Update the Users table with the last login IP and date.
	
$sql=$dbo->prepare("UPDATE users SET last_login_ip = :ip, last_login_date= :date where user_id= :user_id");
$sql->execute(array(
":ip" => $_SERVER['REMOTE_ADDR'],
":date" => gmdate("Y-m-d H:i:s"),
":user_id" => $_SESSION['uid']
));
	
// Add a new entry in the log.
$sql=$dbo->prepare("INSERT INTO fsclog (uid, sesip, action, action_time) VALUES(:uid, :sesip, :action, :action_time)");
$sql->execute(array(
":uid" => '0',
":sesip" => $_SERVER['REMOTE_ADDR'],
":action" =>	 'User '. $_SESSION['user'] .' Login',
":action_time" => gmdate("Y-m-d H:i:s")
));

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
		
		/* ------------------------- End of No Errors  ------------------------- */

	

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

	


	/* ------------------------- Start of Login Attempts Handling  ------------------------- */

$query=$dbo->prepare("SELECT * FROM fsclog WHERE (UNIX_TIMESTAMP(action_time) > UNIX_TIMESTAMP(NOW())-3660) AND sesip= :sesip ORDER BY action_time DESC");
$query->bindParam(':sesip', $_SERVER['REMOTE_ADDR']);
$query->execute();
	
$login_attempts = 0;

	while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
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
