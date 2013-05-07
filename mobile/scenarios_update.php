<!-- V2.0 Copyright Nanab nanab666@gmail.com. -->
<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
include(dirname(__FILE__)."/../settings/load_settings.php");
if($_POST['SCUp'] == "update") {
	$idt = $_POST['ID'];	
	$text = fopen("http://$User:$Pass@$Ip:$Port/commandqueue?operation=changescenario&target=$idt&param1=param1¶m2=param2¶m3=param3", 'r');
	fclose($text);
	include(dirname(__FILE__)."/import_from_switchking.php");
	importtoxml(dirname(__FILE__)."/../settings/tempfiles/scenarios.xml", "http://$User:$Pass@$Ip:$Port/$FuncSC", "Scenarios");
	sortxml(dirname(__FILE__)."/../settings/tempfiles/scenarios.xml", 'ID', 'number', 'ascending', 'RESTDevice' );
	echo "success";		
}								
?>