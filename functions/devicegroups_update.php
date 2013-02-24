<!-- V2.0 Copyright Nanab nanab666@gmail.com. -->
<?php
include(dirname(__FILE__)."/../settings/load_settings.php");
if($_POST['DGUp'] == "shedule") {
	$idt = $_POST['ID'];	
	$text = fopen("http://$User:$Pass@$Ip:$Port/$FuncDG/$idt/cancelsemiauto", 'r');
	fclose($text);
	include(dirname(__FILE__)."/import_from_switchking.php");
	importtoxml(dirname(__FILE__)."/../settings/tempfiles/devicegroups.xml", "http://$User:$Pass@$Ip:$Port/$FuncDG", "Devicegroups");
	echo "success";		
}
if($_POST['DGUp'] == "turnon") {
	$idt = $_POST['ID'];	
	$text = fopen("http://$User:$Pass@$Ip:$Port/$FuncDG/$idt/turnon", 'r');
	fclose($text);
	include(dirname(__FILE__)."/import_from_switchking.php");
	importtoxml(dirname(__FILE__)."/../settings/tempfiles/devicegroups.xml", "http://$User:$Pass@$Ip:$Port/$FuncDG", "Devicegroups");
	echo "success";		
}
if($_POST['DGUp'] == "turnoff") {
	$idt = $_POST['ID'];	
	$text = fopen("http://$User:$Pass@$Ip:$Port/$FuncDG/$idt/turnoff", 'r');
	fclose($text);
	include(dirname(__FILE__)."/import_from_switchking.php");
	importtoxml(dirname(__FILE__)."/../settings/tempfiles/devicegroups.xml", "http://$User:$Pass@$Ip:$Port/$FuncDG", "Devicegroups");
	echo "success";		
}
if($_POST['DGUp'] == "dim") {
	$idt = $_POST['ID'];
	$dim = $_POST['Dim'];
	$text = fopen("http://$User:$Pass@$Ip:$Port/$FuncDG/$idt/dim/$dim", 'r');
	fclose($text);
	include(dirname(__FILE__)."/import_from_switchking.php");
	importtoxml(dirname(__FILE__)."/../settings/tempfiles/devicegroups.xml", "http://$User:$Pass@$Ip:$Port/$FuncDG", "Devicegroups");
	echo "success";		
}
if($_POST['DGUp'] == "sync") {
	$idt = $_POST['ID'];
	$text = fopen("http://$User:$Pass@$Ip:$Port/$FuncDG/$idt/synchronize", 'r');
	fclose($text);
	include(dirname(__FILE__)."/import_from_switchking.php");
	importtoxml(dirname(__FILE__)."/../settings/tempfiles/devicegroups.xml", "http://$User:$Pass@$Ip:$Port/$FuncDG", "Devicegroups");
	echo "success";		
}							
?>