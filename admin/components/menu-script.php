<?php session_start();

$base = $cms_abs_url . '/';
$backbutton = '<li><a href="javascript:history.back(-1);">&nbsp;<img src="' . $cms_abs_url . '/images/icon-up-level-small.gif" alt="Return to previous menu" width="14" height="12" hspace="0" vspace="0" border="0" /></a></li>';
$t = $HTTP_SESSION_VARS['T'];
$s = $HTTP_SESSION_VARS['S'];

/* Home */
$url = 'home.php'; $title = 'Home';
if ($t == 'home') {
$topmenu .= '<li><a href="' . $base . $url . '" id="current">' . $title . '</a></li>';
} else {
$topmenu .= '<li><a href="' . $base . $url . '">' . $title . '</a></li>';
}

/* Front End */
$url = 'f/f-menu.php'; $title = 'Site Content';
if ($t == 'front') {
$topmenu .= '<li><a href="' . $base . $url . '" id="current">' . $title . '</a></li>';

				/* Front End Sub Menu */
				$submenu .= $backbutton;	
							
				$surl = 'f/f-menu.php'; $stitle = 'Front End Content';
				if ($s == 'menu') {
					$submenu .= '<li><a href="' . $base . $surl . '" id="pagecurrent">' . $stitle . '</a></li>';
				} else {
					$submenu .= '<li><a href="' . $base . $surl . '">' . $stitle . '</a></li>';
				}
				
				$surl = 'f/page-view.php'; $stitle = 'Content Pages';
				if ($s == 'page_view') {
					$submenu .= '<li><a href="' . $base . $surl . '" id="pagecurrent">' . $stitle . '</a></li>';
				} else {
					$submenu .= '<li><a href="' . $base . $surl . '">' . $stitle . '</a></li>';
				}

} else {
$topmenu .= '<li><a href="' . $base . $url . '">' . $title . '</a></li>';
}

/* Main Data */

$url = 'd/d-menu.php'; $title = 'Data / Information';
if ($t == 'data') {
$topmenu .= '<li><a href="' . $base . $url . '" id="current">' . $title . '</a></li>';

				// Data Sub Menu
				$submenu .= $backbutton;				
				
				$surl = 'd/d-menu.php'; $stitle = 'Data / Information';
				if ($s == 'menu') {
					$submenu .= '<li><a href="' . $base . $surl . '" id="pagecurrent">' . $stitle . '</a></li>';
				} else {
					$submenu .= '<li><a href="' . $base . $surl . '">' . $stitle . '</a></li>';
				}
				$surl = 'd/manufacturers-view.php'; $stitle = 'Manufacturers';
				if ($s == 'manufacturers') {
				$submenu .= '<li><a href="' . $base . $surl . '" id="pagecurrent">' . $stitle . '</a></li>';
				} else {
				$submenu .= '<li><a href="' . $base . $surl . '">' . $stitle . '</a></li>';
				}
				$surl = 'd/rooms-view.php'; $stitle = 'Rooms';
				if ($s == 'rooms') {
				$submenu .= '<li><a href="' . $base . $surl . '" id="pagecurrent">' . $stitle . '</a></li>';
				} else {
				$submenu .= '<li><a href="' . $base . $surl . '">' . $stitle . '</a></li>';
				}
				$surl = 'd/piles-view.php'; $stitle = 'Piles';
				if ($s == 'piles') {
				$submenu .= '<li><a href="' . $base . $surl . '" id="pagecurrent">' . $stitle . '</a></li>';
				} else {
				$submenu .= '<li><a href="' . $base . $surl . '">' . $stitle . '</a></li>';
				}
				$surl = 'd/ranges-view.php'; $stitle = 'Ranges';
				if ($s == 'ranges') {
				$submenu .= '<li><a href="' . $base . $surl . '" id="pagecurrent">' . $stitle . '</a></li>';
				} else {
				$submenu .= '<li><a href="' . $base . $surl . '">' . $stitle . '</a></li>';
				}
				$surl = 'd/products-view.php'; $stitle = 'Products';
				if ($s == 'products') {
				$submenu .= '<li><a href="' . $base . $surl . '" id="pagecurrent">' . $stitle . '</a></li>';
				} else {
				$submenu .= '<li><a href="' . $base . $surl . '">' . $stitle . '</a></li>';
				}
				$surl = 'd/fitting-price.php'; $stitle = 'Fitting Price';
				if ($s == 'fitting') {
				$submenu .= '<li><a href="' . $base . $surl . '" id="pagecurrent">' . $stitle . '</a></li>';
				} else {
				$submenu .= '<li><a href="' . $base . $surl . '">' . $stitle . '</a></li>';
				}
				
} else {
$topmenu .= '<li><a href="' . $base . $url . '">' . $title . '</a></li>';
}


$url = 'c/c-menu.php'; $title = 'Customers';
if ($t == 'customers') {
$topmenu .= '<li><a href="' . $base . $url . '" id="current">' . $title . '</a></li>';

				// Data Sub Menu
				$submenu .= $backbutton;				
				
				$surl = 'c/c-menu.php'; $stitle = 'Customers';
				if ($s == 'menu') {
					$submenu .= '<li><a href="' . $base . $surl . '" id="pagecurrent">' . $stitle . '</a></li>';
				} else {
					$submenu .= '<li><a href="' . $base . $surl . '">' . $stitle . '</a></li>';
				}
				$surl = 'c/orders-view.php'; $stitle = 'Orders';
				if ($s == 'orders') {
				$submenu .= '<li><a href="' . $base . $surl . '" id="pagecurrent">' . $stitle . '</a></li>';
				} else {
				$submenu .= '<li><a href="' . $base . $surl . '">' . $stitle . '</a></li>';
				}
				
} else {
$topmenu .= '<li><a href="' . $base . $url . '">' . $title . '</a></li>';
}


/* Asset Data */
/*
$url = 'a/a-banners.php'; $title = 'Assets';
if ($t == 'asset') {
$topmenu .= '<li><a href="' . $base . $url . '" id="current">' . $title . '</a></li>';

				// Asset Sub Menu
				$submenu .= $backbutton;
								
				$surl = 'a/a-banners.php'; $stitle = 'Banners';
				if ($s == 'banners') {
					$submenu .= '<li><a href="' . $base . $surl . '" id="pagecurrent">' . $stitle . '</a></li>';
				} else {
					$submenu .= '<li><a href="' . $base . $surl . '">' . $stitle . '</a></li>';
				}
							

} else {
$topmenu .= '<li><a href="' . $base . $url . '">' . $title . '</a></li>';
}
*/

/* SEO and Marketing */
/*
$url = 'x/x-menu.php'; $title = 'SEO / Marketing';
if ($t == 'seo') {
$topmenu .= '<li><a href="' . $base . $url . '" id="current">' . $title . '</a></li>';

				// SEO and Marketing Sub Menu
				$submenu .= $backbutton;				
				
				$surl = 'x/x-menu.php'; $stitle = 'SEO &amp; Marketing';
				if ($s == 'menu') {
					$submenu .= '<li><a href="' . $base . $surl . '" id="pagecurrent">' . $stitle . '</a></li>';
				} else {
					$submenu .= '<li><a href="' . $base . $surl . '">' . $stitle . '</a></li>';
				}
				$surl = 'x/x-info.php'; $stitle = 'Info Requests';
				if ($s == 'info') {
				$submenu .= '<li><a href="' . $base . $surl . '" id="pagecurrent">' . $stitle . '</a></li>';
				} else {
				$submenu .= '<li><a href="' . $base . $surl . '">' . $stitle . '</a></li>';
				}
				$surl = 'x/x-sitemap.php'; $stitle = 'Sitemap';
				if ($s == 'sitemap') {
				$submenu .= '<li><a href="' . $base . $surl . '" id="pagecurrent">' . $stitle . '</a></li>';
				} else {
				$submenu .= '<li><a href="' . $base . $surl . '">' . $stitle . '</a></li>';
				}
				

} else {
$topmenu .= '<li><a href="' . $base . $url . '">' . $title . '</a></li>';
}
*/

/* Users */
$url = 'u/u-menu.php'; $title = 'Users / Logs';
if ($t == 'user') {
$topmenu .= '<li><a href="' . $base . $url . '" id="current">' . $title . '</a></li>';

				/* Users Sub Menu */
				$submenu .= $backbutton;				
				$surl = 'u/u-menu.php'; $stitle = 'Users / Logs';
				if ($s == 'menu') {
				$submenu .= '<li><a href="' . $base . $surl . '" id="pagecurrent">' . $stitle . '</a></li>';
				} else {
				$submenu .= '<li><a href="' . $base . $surl . '">' . $stitle . '</a></li>';
				}
				$surl = 'u/u-view.php'; $stitle = 'View Users';
				if ($s == 'view') {
				$submenu .= '<li><a href="' . $base . $surl . '" id="pagecurrent">' . $stitle . '</a></li>';
				} else {
				$submenu .= '<li><a href="' . $base . $surl . '">' . $stitle . '</a></li>';
				}
				$surl = 'u/u-add.php'; $stitle = 'Add User';
				if ($s == 'add') {
				$submenu .= '<li><a href="' . $base . $surl . '" id="pagecurrent">' . $stitle . '</a></li>';
				} else {
				$submenu .= '<li><a href="' . $base . $surl . '">' . $stitle . '</a></li>';
				}
				$surl = 'u/u-logs.php'; $stitle = 'View Usage Logs';
				if ($s == 'logs') {
				$submenu .= '<li><a href="' . $base . $surl . '" id="pagecurrent">' . $stitle . '</a></li>';
				} else {
				$submenu .= '<li><a href="' . $base . $surl . '">' . $stitle . '</a></li>';
				}

} else {
$topmenu .= '<li><a href="' . $base . $url . '">' . $title . '</a></li>';
}

/* Support */
$url = 's/s-menu.php'; $title = 'Support';
if ($t == 'support') {
$topmenu .= '<li><a href="' . $base . $url . '" id="current">' . $title . '</a></li>';

				/* Support Sub Menu */
				$submenu .= $backbutton;				
				
				$surl = 's/s-menu.php'; $stitle = 'Support Subscriptions';
				if ($s == 'menu') {
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