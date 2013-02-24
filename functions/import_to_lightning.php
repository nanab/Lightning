<!-- V2.0 Copyright Nanab nanab666@gmail.com. -->
<?php
function index_import_devices(){
	include(dirname(__FILE__)."/../settings/load_settings.php");
	$ImportDevicesTitleLang = $XmlLang->import->devicestitle;
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
	<div id="dialog-confirm" title="<?php echo $ImportDevicesTitleLang; ?>">
		<p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><?php echo $ImportDevicesTextLang; ?></p>
	</div>
	<div class="background"></div>
	<?php	
}
function index_import_systemmodes(){
	include(dirname(__FILE__)."/../settings/load_settings.php");
	$ImportSMTitleLang = $XmlLang->import->systemmodestitle;
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
	<div id="dialog-confirm" title="<?php echo $ImportSMTitleLang; ?>">
		<p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span><?php echo $ImportSMTextLang; ?></p>
	</div>
	<div class="background"></div>
	<?php			
}
function index_import_datasources(){
	include(dirname(__FILE__)."/../settings/load_settings.php");
	$ImportDSTitleLang = $XmlLang->import->datasourcestitle;
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
				width:400,
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
	<div id="dialog-confirm" title="<?php echo $ImportDSTitleLang; ?>">
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