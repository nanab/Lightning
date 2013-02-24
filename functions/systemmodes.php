<!-- V2.0 Copyright Nanab nanab666@gmail.com. -->
<?php
include(dirname(__FILE__)."/../settings/load_settings.php");		
if($_POST['SystemmodesUpdate'] == "SystemmodesUpdate") {
	$idsm = $_POST['SMId'];
	echo $idsm;
	$text = fopen("http://$User:$Pass@$Ip:$Port/$FuncSysm/$idsm/activate", 'r');
	fclose($text);
	echo "success";		
}
?>
