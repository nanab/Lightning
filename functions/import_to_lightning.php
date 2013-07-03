<?php
function index_import_devices($RemainingDevices){
	include(dirname(__FILE__)."/../settings/load_settings.php");
	$ImportDevicesTitleLang1 = $XmlLang->import->devicestitle1;
	$ImportDevicesTitleLang2 = $XmlLang->import->devicestitle2;
	$ImportDevicesTextLang = $XmlLang->import->devicestext;
	$ImportDevicesBackgroundLang = $XmlLang->import->devicesbackground;
	?>
	<script src="<?php echo $Jquery; ?>"></script>
	<script src="<?php echo $JqueryCustom; ?>"></script> 
	<link rel="stylesheet" href="<?php echo $JqueryCustomCss; ?>" />
	<link rel="stylesheet" href="<?php echo $JqueryCustomCss2; ?>" />
	<script>        		
		$(function() {						
			$( "#dialog-confirm" ).dialog({
				resizable: false,
				width:400,
				modal: true,							
				buttons: {
					"Ok": function() {
						var update = "devices";									
						$.ajax({	
							type: "POST",
							url: "/functions/import_to_lightning.php",
							data: {"update": update},
							success: function(response){
								location.reload()
							}					
						});
					},
					Cancel: function() {
						var BackgroundText = '<?php echo $ImportDevicesBackgroundLang; ?>';
						$( this ).dialog( "close" );
						$(".background").html(BackgroundText);
					}
				}
			});
		});				
	</script>            
	<div id="dialog-confirm" title="<?php echo $ImportDevicesTitleLang1 . " " . $RemainingDevices . " " . $ImportDevicesTitleLang2; ?>">
		<p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><?php echo $ImportDevicesTextLang; ?></p>
	</div>
	<div class="background"></div>
	<?php	
}
function index_import_systemmodes($RemainingSystemmodes){
	include(dirname(__FILE__)."/../settings/load_settings.php");
	$ImportSMTitleLang1 = $XmlLang->import->systemmodestitle1;
	$ImportSMTitleLang2 = $XmlLang->import->systemmodestitle2;
	$ImportSMTextLang = $XmlLang->import->systemmodestext;
	$ImportSMBackgroundLang = $XmlLang->import->systemmodesbackground;
	?>
	<script src="<?php echo $Jquery; ?>"></script>
	<script src="<?php echo $JqueryCustom; ?>"></script> 
	<link rel="stylesheet" href="<?php echo $JqueryCustomCss; ?>" />
	<link rel="stylesheet" href="<?php echo $JqueryCustomCss2; ?>" />
	<script>        		
		$(function() {						
			$( "#dialog-confirm" ).dialog({
				resizable: false,
				width:400,
				modal: true,							
				buttons: {
					"Ok": function() {
						var update = "systemmodes";									
						$.ajax({	
							type: "POST",
							url: "/functions/import_to_lightning.php",
							data: {"update": update},
							success: function(response){
								location.reload()
							}					
						});
					},
					Cancel: function() {
						var BackgroundText = '<?php echo $ImportSMBackgroundLang; ?>';
						$( this ).dialog( "close" );
						$(".background").html(BackgroundText);
					}
				}
			});
		});				
	</script>            
	<div id="dialog-confirm" title="<?php echo $ImportSMTitleLang1 . " " . $RemainingSystemmodes . " " . $ImportSMTitleLang2; ?>">
		<p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><?php echo $ImportSMTextLang; ?></p>
	</div>
	<div class="background"></div>
	<?php			
}
function index_import_datasources($RemainingDatasources){
	include(dirname(__FILE__)."/../settings/load_settings.php");
	$ImportDSTitleLang1 = $XmlLang->import->datasourcestitle1;
	$ImportDSTitleLang2 = $XmlLang->import->datasourcestitle2;
	$ImportDSTextLang = $XmlLang->import->datasourcestext;
	$ImportDSBackgroundLang = $XmlLang->import->datasourcesbackground;
	?>
	<script src="<?php echo $Jquery; ?>"></script>
	<script src="<?php echo $JqueryCustom; ?>"></script> 
	<link rel="stylesheet" href="<?php echo $JqueryCustomCss; ?>" />
	<link rel="stylesheet" href="<?php echo $JqueryCustomCss2; ?>" />
	<script>        		
		$(function() {						
			$( "#dialog-confirm" ).dialog({
				resizable: false,
				width:500,
				modal: true,							
				buttons: {
					"Ok": function() {
						var update = "datasources";									
						$.ajax({	
							type: "POST",
							url: "/functions/import_to_lightning.php",
							data: {"update": update},
							success: function(response){
								location.reload()
							}					
						});
					},
					Cancel: function() {
						var BackgroundText = '<?php echo $ImportDSBackgroundLang; ?>';
						$( this ).dialog( "close" );
						$(".background").html(BackgroundText);
					}
				}
			});
		});				
	</script>            
	<div id="dialog-confirm" title="<?php echo $ImportDSTitleLang1 . " " . $RemainingDatasources . " " . $ImportDSTitleLang2; ?>">
		<p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><?php echo $ImportDSTextLang; ?></p>
	</div>
	<div class="background"></div>
	<?php			
}
if(@$_POST['update'] == "devices") {
	$DevNumbersab = $DevNumbers;
	$tva = '1';
	$DevNumbersab = $DevNumbersab + $tva;
	do {
		$tva = '1';
		$DevNumbersab = $DevNumbersab + $tva;
		include(dirname(__FILE__)."/../settings/devices_settings_add.php");
		$xmla = simplexml_load_file(dirname(__FILE__)."/../settings/settings.xml");	
	}
	while($DevNumbersab<=$CountDevs); 	
	echo "success";	
}
if(@$_POST['update'] == "systemmodes") {
	$SMNumbersab = $SMNumbers;
	$tvas = '1';
	$SMNumbersab = $SMNumbersab + $tvas;
	do {
		$tvsa = '1';
		$SMNumbersab = $SMNumbersab + $tvas;
  		include(dirname(__FILE__)."/../settings/systemmodes_settings_add.php");
		$xmla = simplexml_load_file(dirname(__FILE__)."/../settings/settings.xml");	
  	}
 	while($SMNumbersab<=$SMNumbers); 
	echo "success";				
}
if(@$_POST['update'] == "datasources") {
	$DSNumbersab = $DSNumbers;
	$tvas = '1';
	$DSNumbersab = $DSNumbersab + $tvas;
	do {
		$tvsa = '1';
		$DSNumbersab = $DSNumbersab + $tvas;
  		include(dirname(__FILE__)."/../settings/datasources_settings_add.php");
		$xmla = simplexml_load_file(dirname(__FILE__)."/../settings/settings.xml");	
  	}
 	while($DSNumbersab<=$CountDS1);
	echo "success";				
}
?>