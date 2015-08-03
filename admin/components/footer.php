<div class="container">
	<p><strong>Site Tag:</strong> <?php echo $site_name; ?> | For technical support, please visit <?php echo $support_url; ?></p>
	<p><?php
	$cstamp = date("Y");
	print ("&copy; $cstamp Developed by <a href=\"http://www.digitalarts.co.uk/\" target=\"_blank\">Digital Arts</a> - visit <a href=\"http://www.bluewavecms.com/\" target=\"_blank\">www.bluewavecms.com</a>\n");
	?></p>
</div>

<?php
// Display error message if necessary
if(isset($erun)) {
?>
<div id="error_message_bg"></div>
<div id="error_message">
<p><?php echo $erun; ?><br /><br />
<input type="button" value="OK" onclick="var el=document.getElementById('error_message_bg'); el.parentNode.removeChild(el); el=document.getElementById('error_message'); el.parentNode.removeChild(el);" /></p>
</div>
<?php
}
?>