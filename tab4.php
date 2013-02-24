<!-- V2.0 Copyright Nanab nanab666@gmail.com. -->
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<?php
		$root = realpath($_SERVER["DOCUMENT_ROOT"]);		
		include(dirname(__FILE__)."/style/devices_style.php");
		include(dirname(__FILE__)."/style/datasources_style.php");
		include(dirname(__FILE__)."/style/systemmodes_style.php");
		include(dirname(__FILE__)."/style/scenarios_style.php");
		include(dirname(__FILE__)."/style/devicegroups_style.php");
		include(dirname(__FILE__)."/settings/load_settings.php");		
		$tabpage = '4';		
		include(dirname(__FILE__)."/tabs_main.php");		
		?>
	</head>
</html>