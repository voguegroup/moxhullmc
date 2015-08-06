<?php 
$base = '../';
$backbutton = '<li><a href="javascript:history.back(-1);">&nbsp;<img src="' . '../images/icon-up-level-small.gif" alt="Return to previous menu" width="14" height="12" hspace="0" vspace="0" border="0" /></a></li>';
$t = $HTTP_SESSION_VARS['T'];
$s = $HTTP_SESSION_VARS['S'];

/* Home */
$url = 'home.php'; $title = 'Home';
if ($t == 'home') {
$topmenu = '<li><a href="' . $base . $url . '" id="current">' . $title . '</a></li>';
} else {
$topmenu = '<li><a href="' . $base . $url . '">' . $title . '</a></li>';
}



/* Main Data */

$url = 'd/d-menu.php'; $title = 'Data / Information';
if ($t == 'data') {
$topmenu .= '<li><a href="' . $base . $url . '" id="current">' . $title . '</a></li>';

				// Data Sub Menu
				$submenu = $backbutton;				
				
				
				$surl = 'd/car-view.php'; $stitle = 'Cars';
				if ($s == 'car') {
				$submenu .= '<li><a href="' . $base . $surl . '" id="pagecurrent">' . $stitle . '</a></li>';
				} else {
				$submenu .= '<li><a href="' . $base . $surl . '">' . $stitle . '</a></li>';
				}
				
				
} else {
$topmenu .= '<li><a href="' . $base . $url . '">' . $title . '</a></li>';
}



/* Logout */
$topmenu .= "<li><a href=\"$cms_abs_url/index.php?logout=TRUE\">Log Out</a></li>";

?>