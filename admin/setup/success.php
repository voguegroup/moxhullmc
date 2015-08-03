<?php
include (dirname(__FILE__) . '/../config/config.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Bluewave CMS Installed</title>
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
</style>
</head>

<body>

<div id="container">
<h1>Done!</h1>
<p><strong>Bluewave CMS</strong> was successfully installed. An email containing the default user's login details has been sent to the email address you specified.</p>
<p>To log in to <strong>Bluewave CMS</strong> immediately, <a href="<?php echo $cms_abs_url ; ?>">click here</a> to go to the login page.</p>
</div>
</body>
</html>