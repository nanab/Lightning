<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="HandheldFriendly" content="true" />
<meta name="viewport" content="width=device-width,height=device-height, user-scalable=yes" />
<head>
<?php include(dirname(__FILE__)."/../settings/load_settings.php"); ?>
<?php include(dirname(__FILE__)."/devices_load_mobile.php"); ?>
<script src="<?php echo ".." . $Jquery; ?>"></script> <!-- Inlude jquery files. -->
<script src="<?php echo ".." . $JqueryCustom; ?>"></script> <!-- Inlude jquery files. -->
<script src="jquery.ui.touch-punch.min.js"></script>
<script src="devices.js"></script>
<link rel="stylesheet" href="<?php echo ".." . $JqueryCustomCss; ?>" />
<link rel="stylesheet" href="<?php echo ".." . $JqueryCustomCss2; ?>" />
<style>
	#bod{
		height:100%;
	}
  	body{
		color:white;
		background-color:#333;	
	}
	#dev_butt{
		font-size:15;
	}
	#scen_butt{
		font-size:15;
	}
	#dat_butt{
		font-size:15;
	}
	.tester{
		cursor:pointer;
	}
	#slider_value{
		font-size:9;
		border: 0; 
		color: white; 
		background: transparent; 
		text-align:right; 
		width:31px;
	}
	#slider{
		width:80px;
		 font-size: 10;	
	}
	
</style>
<script>
$(document).ready(function(){
$('.button_devices').addClass('ui-state-focus');	
});
$(function() {
	$(".button_devices").button().on("click", function(e){
		$('#main_div').load('devices_load_mobile.php?func=device_load_first').fadeIn('fast');
		$('.button_scenarios').removeClass("ui-state-focus");
		$('.button_datasources').removeClass("ui-state-focus");
		$('.button_devices').addClass('ui-state-focus');		
		return false;
	});
	$(".button_scenarios").button().on("click", function(e){
		$('#main_div').load('scenarios.php');
		$('.button_datasources').removeClass("ui-state-focus");
		$('.button_devices').removeClass('ui-state-focus');
		$('.button_scenarios').addClass('ui-state-focus');
		return false;
	});
	$(".button_datasources").button().on("click", function(e){
		$('#main_div').empty();
		$('.button_scenarios').removeClass("ui-state-focus");
		$('.button_devices').removeClass('ui-state-focus');
		$('.button_datasources').addClass('ui-state-focus');
		return false;
	});
});
</script>
</head>
<body>
<div id="bod">
<div id="title_div" class="ui-tabs ui-widget ui-widget-content ui-corner-all"><center><?php echo $MainTitle ?></center></div>
<div id="menu_div" class="ui-tabs ui-widget ui-widget-content ui-corner-all">
<center>
<button id="dev_butt" class="button_devices">Devices</button>
<button id="scen_butt" class="button_scenarios">Scenarios</button>
<button id="dat_butt" class="button_datasources">Datasources</button>
</center>
</div>	
<div id="main_div" class="ui-tabs ui-widget ui-widget-content ui-corner-all">
	<?php 
		device_load_first(1); //load devices from device_load_first.php
	?>    
</div>
</div>

</body>