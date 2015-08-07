<?php
$username="589243_mox";		$password="TT9-SLQ-VtT-zkp";		$database="589243_mox";
$con = mysql_connect("mysql51-011.wc2.dfw1.stabletransit.com",$username,$password) or die( "Unable to Connect database");
mysql_select_db($database,$con) or die( "Unable to select database");
// Table Name that you want
// to export in csv
$ShowTable = "stock";

$FileName = "_export.csv";
$file = fopen($FileName,"w");

$sql = mysql_query("SELECT * FROM  `$ShowTable` LIMIT 11");
$row = mysql_fetch_assoc($sql);
// Save headings alon
	$HeadingsArray=array();
	foreach($row as $name => $value){
		$HeadingsArray[]=$name;
	}
	fputcsv($file,$HeadingsArray); 
	
// Save all records without headings

	while($row = mysql_fetch_assoc($sql)){
	$valuesArray=array();
		foreach($row as $name => $value){
		$valuesArray[]=$value;
		}
	fputcsv($file,$valuesArray); 
	}
	fclose($file);

header("Location: $FileName");

echo "Complete Record saves as CSV in file: <b style=\"color:red;\">$FileName</b>";
?>