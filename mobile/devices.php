<!-- V2.0 Copyright Nanab nanab666@gmail.com. -->
<?php
include(dirname(__FILE__)."/../settings/load_settings.php");
if($_POST['DevUpdate'] == "updateon") {
	$idt = $_POST['DevOnId'];
	$text = fopen("http://$User:$Pass@$Ip:$Port/$funcdev/$idt/turnoff", 'r');
	fclose($text);	
	echo "success";	
};								
if($_POST['DevUpdate'] == "updateoff") {
	$idt = $_POST['DevOnId'];
	$text = fopen("http://$User:$Pass@$Ip:$Port/$funcdev/$idt/turnon", 'r');
	fclose($text);	
	echo "success";	
};
if($_POST['DevUpdate'] == "cancelsemiauto") {
	$idt = $_POST['DevOnId'];
	$text = fopen("http://$User:$Pass@$Ip:$Port/$funcdev/$idt/cancelsemiauto", 'r');
	fclose($text);	
	echo "success";	
};
if($_POST['DevUpdate'] == "updatedim") {
	$DevDimId = $_POST['DevOnId'];
	$DevDimLevel = $_POST['DevDimLevel'];
	$text = fopen("http://$User:$Pass@$Ip:$Port/$funcdev/$DevDimId/dim/$DevDimLevel", 'r');
	fclose($text);		
	echo "success";		
};	
?>