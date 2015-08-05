<?php // Config file for Bluewave CMS
// Client site details
$site_name = "Moxhull MC"; // e.g. Company name
$site_url = "http://moxhullmc.wearefundamental.com"; // Client site URL
$site_email = "tom@voguegroup.co.uk"; // For sending emails such as new user alerts
$stats_link = ""; // For viewing site analytics
// Support details
$support_tel = "0121 334 2373";
$support_email = "hello@wearefundamental.com";
$support_url = "http://www.wearefundamental.com";
$support_agent = "Fundamental";
$support_pin = "";
// CMS setup
$cms_dir = "/admin"; // e.g. '/admin'
$cms_abs_url = "http://moxhullmc.wearefundamental.com/admin"; // e.g. 'http://www.domain.com/admin'
$cms_root_url = "/mnt/stor12-wc2-dfw1/589243/moxhullmc.wearefundamental.com/web/content/admin"; // e.g. '/home/username/public_html/admin'
// Database details

$user = '589243_mox';
$password = 'TT9-SLQ-VtT-zkp';
$db = '589243_mox';
$host = 'mysql51-011.wc2.dfw1.stabletransit.com';
$port = 21;

$link = mysqli_init();
$success = mysqli_real_connect(
   $link, 
   $host, 
   $user, 
   $password, 
   $db,
   $port
);

//$db_host = 'mysql51-011.wc2.dfw1.stabletransit.com'; // e.g. 'localhost'
//$db_user = '589243_mox'; // MySQL username
//$db_pass = 'TT9-SLQ-VtT-zkp'; // MySQL password
//$db_name = '589243_mox'; // MySQL database name
?>
