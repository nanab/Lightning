<!-- V2.0 Copyright Nanab nanab666@gmail.com. -->
<?php
include(dirname(__FILE__)."/../settings/load_settings.php");
if($_POST['DevUpdate'] == "updateon") {
	$idt = $_POST['DevOnId'];
	$text = fopen("http://$User:$Pass@$Ip:$Port/$funcdev/$idt/turnoff", 'r');
	fclose($text);
	include(dirname(__FILE__)."/import_from_switchking.php");
	importtoxml(dirname(__FILE__)."/../settings/tempfiles/devices.xml", "http://$User:$Pass@$Ip:$Port/$funcdev", "Devices");
	sortxml(dirname(__FILE__)."/../settings/tempfiles/devices.xml", 'ID', 'number', 'ascending', 'RESTDevice' );
	echo "success";	
};								
if($_POST['DevUpdate'] == "updateoff") {
	$idt = $_POST['DevOnId'];
	$text = fopen("http://$User:$Pass@$Ip:$Port/$funcdev/$idt/turnon", 'r');
	fclose($text);
	include(dirname(__FILE__)."/import_from_switchking.php");
	importtoxml(dirname(__FILE__)."/../settings/tempfiles/devices.xml", "http://$User:$Pass@$Ip:$Port/$funcdev", "Devices");
	sortxml(dirname(__FILE__)."/../settings/tempfiles/devices.xml", 'ID', 'number', 'ascending', 'RESTDevice' );	
	echo "success";	
};
if($_POST['DevUpdate'] == "cancelsemiauto") {
	$idt = $_POST['DevOnId'];
	$text = fopen("http://$User:$Pass@$Ip:$Port/$funcdev/$idt/cancelsemiauto", 'r');
	fclose($text);
	include(dirname(__FILE__)."/import_from_switchking.php");
	importtoxml(dirname(__FILE__)."/../settings/tempfiles/devices.xml", "http://$User:$Pass@$Ip:$Port/$funcdev", "Devices");
	sortxml(dirname(__FILE__)."/../settings/tempfiles/devices.xml", 'ID', 'number', 'ascending', 'RESTDevice' );	
	echo "success";	
};
if($_POST['DevUpdate'] == "updatedim") {
	$DevDimId = $_POST['DevOnId'];
	$DevDimLevel = $_POST['DevDimLevel'];
	$text = fopen("http://$User:$Pass@$Ip:$Port/$funcdev/$DevDimId/dim/$DevDimLevel", 'r');
	fclose($text);	
	include(dirname(__FILE__)."/import_from_switchking.php");
	importtoxml(dirname(__FILE__)."/../settings/tempfiles/devices.xml", "http://$User:$Pass@$Ip:$Port/$funcdev", "Devices");
	sortxml(dirname(__FILE__)."/../settings/tempfiles/devices.xml", 'ID', 'number', 'ascending', 'RESTDevice' );	
	echo "success";		
};	
?>