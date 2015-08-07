<?php // Config file for Bluewave CMS
// Client site details
$site_name = "Moxhull MC"; // e.g. Company name
$site_url = "http://moxhullmotorcompany.co.uk"; // Client site URL
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
$cms_abs_url = "http://moxhullmotorcompany.co.uk/admin"; // e.g. 'http://www.domain.com/admin'
$cms_root_url = "/mnt/stor12-wc2-dfw1/589243/www.moxhullmotorcompany.co.uk/content/admin"; // e.g. '/home/username/public_html/admin'
// Database details

$user = '589243_mox';
$password = 'TT9-SLQ-VtT-zkp';
$db = '589243_mox';
//$host = '72.3.204.197';
$host = 'mysql51-011.wc2.dfw1.stabletransit.com'; //use this when live

try {
$dbo = new PDO('mysql:host='.$host.';dbname='.$db, $user, $password);
} catch (PDOException $e) {
print "Error!: " . $e->getMessage() . "<br/>";
die();
}
if($dbo){
  //echo "<p>connection successful!</p>";
}
?>
