<!-- V2.0 Copyright Nanab nanab666@gmail.com. -->
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />    
	<?php
	include(dirname(__FILE__)."/load_settings.php");
 	$MenuTab1 = $XmlLang->settings->tabssettings->menutab1;
 	$MenuTab2 = $XmlLang->settings->tabssettings->menutab2;
 	$MenuTab3 = $XmlLang->settings->tabssettings->menutab3;
 	$MenuTab4 = $XmlLang->settings->tabssettings->menutab4;
 	$MenuTab5 = $XmlLang->settings->tabssettings->menutab5;
 	$MenuTab6 = $XmlLang->settings->tabssettings->menutab6;
	$MenuTab7 = $XmlLang->settings->tabssettings->menutab7;
	$MenuTab8 = $XmlLang->settings->tabssettings->menutab8;
 	?>
    <script>	  
		$(function() {
   			$( "#tabs_settings" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
        	$( "#tabs_settings li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
    	});												
    </script> 
    <style>
		.ui-tabs-vertical { width: auto; font-size:12px; }
		.ui-tabs-vertical .ui-tabs-nav { padding: .2em .1em .2em .2em; float: left; width: 12em; }
		.ui-tabs-vertical .ui-tabs-nav li { clear: left; width: 100%; border-bottom-width: 1px !important; border-right-width: 0 !important; margin: 0 -1px .2em 0; }
		.ui-tabs-vertical .ui-tabs-nav li a { display:block; }
		.ui-tabs-vertical .ui-tabs-nav li.ui-tabs-active { padding-bottom: 0; padding-right: .1em; border-right-width: 1px; border-right-width: 1px; }
		.ui-tabs-vertical .ui-tabs-panel { padding: 1em; float: right; width: auto;}
    </style>   
</head>
<body>
	<div id="tabs_settings" style="border:1px solid #CCC;">
    	<ul>
            <li><a href="#tabs_settings-1"><?php echo $MenuTab1; ?></a></li>
            <li><a href="#tabs_settings-2"><?php echo $MenuTab2; ?></a></li>
            <li><a href="#tabs_settings-3"><?php echo $MenuTab3; ?></a></li>
            <li><a href="#tabs_settings-4"><?php echo $MenuTab4; ?></a></li>
            <li><a href="#tabs_settings-5"><?php echo $MenuTab5; ?></a></li>
            <li><a href="#tabs_settings-6"><?php echo $MenuTab6; ?></a></li>
            <li><a href="#tabs_settings-7"><?php echo $MenuTab7; ?></a></li>
            <li><a href="#tabs_settings-8"><?php echo $MenuTab8; ?></a></li>
        </ul>
        <div id="tabs_settings-1">
        	<iframe src="/settings/main_settings.php" style=" border-width:0 " width="550" height="400" frameborder="0" scrolling="auto"></iframe>
        </div>
        <div id="tabs_settings-2">
            <iframe src="/settings/devices_settings.php" style=" border-width:0 " width="550" height="400" frameborder="0" scrolling="auto"></iframe>
        </div>
        <div id="tabs_settings-3">
            <iframe src="/settings/tabs_settings.php" style=" border-width:0 " width="550" height="400" frameborder="0" scrolling="auto"></iframe>
        </div>
        <div id="tabs_settings-4">
            <iframe src="/settings/systemmodes_settings.php" style=" border-width:0 " width="550" height="400" frameborder="0" scrolling="auto"></iframe>
        </div>
        <div id="tabs_settings-5">
            <iframe src="/settings/datasources_settings.php" style=" border-width:0 " width="550" height="400" frameborder="0" scrolling="auto"></iframe>
        </div>
        <div id="tabs_settings-6">
            <iframe src="/settings/scenarios_settings.php" style=" border-width:0 " width="550" height="400" frameborder="0" scrolling="auto"></iframe>
        </div>
        <div id="tabs_settings-7">
            <iframe src="/settings/devicegroups_settings.php" style=" border-width:0 " width="550" height="400" frameborder="0" scrolling="auto"></iframe>
        </div>
        <div id="tabs_settings-8">
            <iframe src="/settings/weather_settings.php" style=" border-width:0 " width="550" height="400" frameborder="0" scrolling="auto"></iframe>
        </div>
    </div> 
</body>