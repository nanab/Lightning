<!-- V2.0 Copyright Nanab nanab666@gmail.com. -->
<html style="border:none;">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<?php
		$TabBakPic = 'Tab'.$tabpage.'BakPic';
		?>
		<script src="<?php echo $Jquery; ?>"></script>
		<script src="<?php echo $JqueryCustom; ?>"></script> 
		<link rel="stylesheet" href="<?php echo $JqueryCustomCss; ?>" />
        <link rel="stylesheet" href="<?php echo $JqueryCustomCss2; ?>" />
        <?php
        include_once(dirname(__FILE__)."/functions/import_from_switchking.php");
		importtoxml(dirname(__FILE__)."/settings/tempfiles/devices.xml", "http://$User:$Pass@$Ip:$Port/$funcdev", "Devices");
		importtoxml(dirname(__FILE__)."/settings/tempfiles/systemmodes.xml", "http://$User:$Pass@$Ip:$Port/$FuncSysm", "Systemmodes");
		if ($SCEn == "true"){
		importtoxml(dirname(__FILE__)."/settings/tempfiles/scenarios.xml", "http://$User:$Pass@$Ip:$Port/$FuncSC", "Scenarios");
		};
		if ($DGEn == "true"){
		importtoxml(dirname(__FILE__)."/settings/tempfiles/devicegroups.xml", "http://$User:$Pass@$Ip:$Port/$FuncDG", "Devicegroups");
		};
		importtoxml(dirname(__FILE__)."/settings/tempfiles/datasources.xml", "http://$User:$Pass@$Ip:$Port/$FuncDS", "Datasources");
		sortxml(dirname(__FILE__)."/settings/tempfiles/devices.xml", 'ID', 'number', 'ascending', 'RESTDevice' );		
		//Get XML file from yr.no. Check file for timestamp and only update if more than 20min old. (yr.no rules)
		if ($WeatherEnabled == "true") {
			$FileWeather = $WeatherUrl . $WeatherXmlFile;
			if (file_exists($WeatherTempFile) && (filemtime($WeatherTempFile) > (time() - 60 * 20 ))) {
				// Cache file is less than twenty minutes old. 
				// Don't bother refreshing, just use the file as-is.
			} else {
				// Our cache is out-of-date, so load the data from our remote server,
				// and also save it over our cache for next time.   
				$dom = new DOMDocument();
				//check if url is alright and try to load xml file from yr.no
				if (@$dom->load($FileWeather) == false){
					//If not loading write to logfile
					$FileLog = fopen(dirname(__FILE__)."/settings/tempfiles/log.txt", 'a+') or die("can't open file");
					fwrite($FileLog, date("Y-m-d H:i:s"). " Could not open weather url check that you have internet connection and url line is rigth!".  PHP_EOL);
					fclose($FileLog);			
				}else{
					$dom->load($FileWeather);
					$dom->save($WeatherTempFile);					
				}			
			}
		};
		//Language
		$RefreshButtonLang = $XmlLang->main->refreshbutton;
		$SettingsButtonLang = $XmlLang->main->settingsbutton;
		$MoveMainLang = $XmlLang->moveable->maintext;
		$MoveDevices1Lang = $XmlLang->moveable->devicessaved1;
		$MoveDevices2Lang = $XmlLang->moveable->devicessaved2;
		$MoveSM1Lang = $XmlLang->moveable->systemmodessaved1;
		$MoveSM2Lang = $XmlLang->moveable->systemmodessaved2;
		$MoveDS1Lang = $XmlLang->moveable->datasourcessaved1;
		$MoveDS2Lang = $XmlLang->moveable->datasourcessaved2;
		$MoveDG1Lang = $XmlLang->moveable->devicegroupssaved1;
		$MoveDG2Lang = $XmlLang->moveable->devicegroupssaved2;
		$MoveSC1Lang = $XmlLang->moveable->scenariossaved1;
		$MoveSC2Lang = $XmlLang->moveable->scenariossaved2;
		$MoveWeather1Lang = $XmlLang->moveable->weathersaved1;
		$MoveWeather2Lang = $XmlLang->moveable->weathersaved2;
		$MoveSettingsButton1Lang = $XmlLang->moveable->settingsbuttonsaved1;
		$MoveSettingsButton2Lang = $XmlLang->moveable->settingsbuttonsaved2;
		$MoveRefreshButton1Lang = $XmlLang->moveable->refreshbuttonsaved1;
		$MoveRefreshButton2Lang = $XmlLang->moveable->refreshbuttonsaved2;
	?>	
		<style type="text/css">			
			body {
				background-color: #999;
				
			}    
			#refresh {
				position: absolute;
				font-size: 12px;
				z-index: 9;
				left: <?php echo $RefreshButtonPositionX; ?>px;
				top: <?php echo $RefreshButtonPositionY; ?>px;;
			}				
			.moverespond {
				position: absolute;
				width: 200px;
				height: 60px;
				z-index: 9;
				left: <?php echo $MoveRespondPositionY; ?>px;
				top: <?php echo $MoveRespondPositionX; ?>px;
				-moz-border-radius: 10px;
				-webkit-border-radius: 10px;
				border-radius: 10px;
				background-color: rgba(255, 255, 255, 0.5);
				border-color: solid 10px rgba(0,0,0,0.2); /*Very transparent black*/
			}
			#settings {
				position: absolute;
				width: auto;
				height: auto;
				z-index: 9;
				left: 15%;
				top: 15%;
				-moz-border-radius: 10px;
				-webkit-border-radius: 10px;
				border-radius: 10px;
				background-color: rgba(255, 255, 255, 0.5);
				border-color: solid 10px rgba(0,0,0,0.2); /*Very transparent black*/
			} 
			#buttonsettings { 
				position: absolute;
				cursor:pointer;						
				z-index: 25;
				left: <?php echo $SettingsButtonPositionX; ?>px;
				top: <?php echo $SettingsButtonPositionY; ?>px;
				font-size: 12px; 	
			}
			<?php if ($WeatherEnabled == "true") { ?>
			.weather{
				position: absolute;
				z-index: 30;
				left: <?php echo $WeatherPositionX; ?>px;
				top: <?php echo $WeatherPositionY; ?>px;
			<?php }; ?>			}
			<?php if ($AllMove == "true"){ ?>
			.notclickdiv {
				pointer-events: none;
			}
			<?php }; ?>
		</style>
		<script>
			//Function for hide scenarios
    		$(function() {
        		// run the currently selected effect
		 		function runEffect(page) {
					var selectedEffect = 'slide';
		 			var options = {direction: "left"};
					var attr = $(page).attr('style');
					if (typeof attr == 'undefined' ) {				            
						$(page).hide( selectedEffect, options, 300 );					
					}
					else if ($(page).is(':visible')){				
						$(page).hide( selectedEffect, options, 300 );
					}
					else{
						$(page).removeAttr( "style" ).hide().fadeIn();
					}          			
       			};        
       			 // set effect from select menu value
       			 $( ".buttonsc" ).click(function() {
            		runEffect('#scenarios');
            		return false;
        		});		
    		});
			//If move is active load functions
			<?php if ($AllMove == "true"){ ?>  	
			//Function for moveable divs.
			function MoveableDivs<?php echo $tabpage ?>(Move1, Move2, Move3) {   
				var $MoveId = Move1
				$('#ap' + Move3 + 'DivDev'+ $MoveId).draggable({ 
					containment: '#main' + Move3, 
					scroll: false
				}).mousemove(function(){
					var coord = $(this).position();
					$("p:last").text( "left: " + coord.left + ", top: " + coord.top );								
				}).mouseup(function(){ 
					var coord = $(this).position();	
					var $left = coord.left;
					var $top = coord.top;
					$.ajax({	
						type: "POST",
						url: "/settings/save_movable_divs.php",
						data: {"left": $left, "top": $top, "id": $MoveId},
						success: function(response){
							$("#respond").html('<div class="success"><center><?php echo $MoveDevices1Lang; ?> ' + Move2 + '<?php echo $MoveDevices2Lang; ?></center></div>').hide().fadeIn(1000);
							setTimeout(function(){ $('#respond').fadeOut(1000); }, 2000);
						}					
					});
				});			
			}
			//Funktion för moveable datasources
			function MoveableDS<?php echo $tabpage ?>(MoveDS1, MoveDS2, MoveDS3) {   
				var $MoveDSId = MoveDS1		
				$('#ap' + MoveDS3 + 'DivDS'+ $MoveDSId).draggable({ 
					containment: '#main' + MoveDS3, 
					scroll: false
				}).mousemove(function(){
					var coord = $(this).position();
					$("p:last").text( "left: " + coord.left + ", top: " + coord.top );								
				}).mouseup(function(){ 
					var coord = $(this).position();	
					var $left = coord.left;
					var $top = coord.top;
					$.ajax({	
						type: "POST",
						url: "/settings/save_movable_ds.php",
						data: {"left": $left, "top": $top, "id": $MoveDSId},
						success: function(response){
							$("#respond").html('<div class="success"><center><?php echo $MoveDS1Lang; ?> ' + MoveDS2 + '<?php echo $MoveDS2Lang; ?></center></div>').hide().fadeIn(1000);
							setTimeout(function(){ $('#respond').fadeOut(1000); }, 2000);
						}	
					});
				});				 	
			}	
			//Funktion för moveable systemlägen
			function MoveableSM<?php echo $tabpage ?>(MoveSM1, MoveSM2, MoveSM3) {   
				var $MoveSMId = MoveSM1		
				$('#ap' + MoveSM3 + 'DivSM'+ $MoveSMId).draggable({ 
					containment: '#main' + MoveSM3, 
					scroll: false
				}).mousemove(function(){
					var coord = $(this).position();
					$("p:last").text( "left: " + coord.left + ", top: " + coord.top );								
				}).mouseup(function(){ 
					var coord = $(this).position();	
					var $left = coord.left;
					var $top = coord.top;
					$.ajax({	
						type: "POST",
						url: "/settings/save_movable_sm.php",
						data: {"left": $left, "top": $top, "id": $MoveSMId},
						success: function(response){
							$("#respond").html('<div class="success"><center><?php echo $MoveSM1Lang; ?> ' + MoveSM2 + '<?php echo $MoveSM2Lang; ?></center></div>').hide().fadeIn(1000);
							setTimeout(function(){ $('#respond').fadeOut(1000); }, 2000);
						}					
					});
				});				 
			}
			//Funktion för moveable scenario
			function MoveableSC(MoveSC1) {   	
				$('#scenariosmain').draggable({ 
					containment: '#main' + MoveSC1, 
					scroll: false
				}).mousemove(function(){
					var coord = $(this).position();
					$("p:last").text( "left: " + coord.left + ", top: " + coord.top );								
				}).mouseup(function(){ 
					var coord = $(this).position();	
					var $left = coord.left;
					var $top = coord.top;
					$.ajax({	
						type: "POST",
						url: "/settings/save_movable_sc.php",
						data: {"left": $left, "top": $top},
						success: function(response){
							$("#respond").html('<div class="success"><center><?php echo $MoveSC1Lang; ?><?php echo $MoveSC2Lang; ?></center></div>').hide().fadeIn(1000);
							setTimeout(function(){ $('#respond').fadeOut(1000); }, 2000);
						}					
					});
				});				 
			}			
			//Funktion för moveable devicegroups
			function MoveableDG(MoveDG1) {   	
				$('#devicegroupsmain').draggable({ 
					containment: '#main' + MoveDG1, 
					scroll: false
				}).mousemove(function(){
					var coord = $(this).position();
					$("p:last").text( "left: " + coord.left + ", top: " + coord.top );								
				}).mouseup(function(){ 
					var coord = $(this).position();	
					var $left = coord.left;
					var $top = coord.top;
					$.ajax({	
						type: "POST",
						url: "/settings/save_movable_dg.php",
						data: {"left": $left, "top": $top},
						success: function(response){
							$("#respond").html('<div class="success"><center><?php echo $MoveDG1Lang; ?><?php echo $MoveDG2Lang; ?></center></div>').hide().fadeIn(1000);
							setTimeout(function(){ $('#respond').fadeOut(1000); }, 2000);
						}					
					});
				});				 
			}
			//Funktion för moveable weather
			<?php if ($WeatherEnabled == "true") { ?>
			function MoveableWeather(MoveWeather1) {   	
				$('#weather').draggable({ 
					containment: '#main' + MoveWeather1, 
					scroll: false
				}).mousemove(function(){
					var coord = $(this).position();
					$("p:last").text( "left: " + coord.left + ", top: " + coord.top );								
				}).mouseup(function(){ 
					var coord = $(this).position();	
					var $left = coord.left;
					var $top = coord.top;
					$.ajax({	
						type: "POST",
						url: "/settings/save_movable_weather.php",
						data: {"left": $left, "top": $top},
						success: function(response){
							$("#respond").html('<div class="success"><center><?php echo $MoveWeather1Lang; ?><?php echo $MoveWeather2Lang; ?></center></div>').hide().fadeIn(1000);
							setTimeout(function(){ $('#respond').fadeOut(1000); }, 2000);
						}					
					});
				});				 
			}
			<?php }; ?>
			//Funktion för moveable Settingsbutton
			function MoveableSettingsButton(MoveSettingsButton1) {   	
				$('#buttonsettings').draggable({ 
					containment: '#main' + MoveSettingsButton1, 
					scroll: false
				}).mousemove(function(){
					var coord = $(this).position();
					$("p:last").text( "left: " + coord.left + ", top: " + coord.top );								
				}).mouseup(function(){ 
					var coord = $(this).position();	
					var $left = coord.left;
					var $top = coord.top;
					$.ajax({	
						type: "POST",
						url: "/settings/save_movable_settings_button.php",
						data: {"left": $left, "top": $top},
						success: function(response){
							$("#respond").html('<div class="success"><center><?php echo $MoveSettingsButton1Lang; ?><?php echo $MoveSettingsButton2Lang; ?></center></div>').hide().fadeIn(1000);
							setTimeout(function(){ $('#respond').fadeOut(1000); }, 2000);
						}					
					});
				});				 
			}
			//Funktion för moveable Refresh button
			function MoveableRefreshButton(MoveRefreshButton1) {   	
				$('#refresh').draggable({ 
					containment: '#main' + MoveRefreshButton1, 
					scroll: false
				}).mousemove(function(){
					var coord = $(this).position();
					$("p:last").text( "left: " + coord.left + ", top: " + coord.top );								
				}).mouseup(function(){ 
					var coord = $(this).position();	
					var $left = coord.left;
					var $top = coord.top;
					$.ajax({	
						type: "POST",
						url: "/settings/save_movable_refresh_button.php",
						data: {"left": $left, "top": $top},
						success: function(response){
							$("#respond").html('<div class="success"><center><?php echo $MoveRefreshButton1Lang; ?><?php echo $MoveRefreshButton2Lang; ?></center></div>').hide().fadeIn(1000);
							setTimeout(function(){ $('#respond').fadeOut(1000); }, 2000);
						}					
					});
				});				 
			}
			<?php }; ?>
			//Function update (On/Off) Devices
			var DELAY = 250, clicks = 0, timer = null;	
			$(document).ready(function(){
				$('body').on('click', '.ReturnON_OFF', function(e){
					clicks++;  //count clicks
					e.preventDefault();
					var element = $(this);
					var Id = element.attr("id");						
					var DevOnId = $("#DevOnId"+Id).val();						
					var DevOnDiv = $("#DevOnDiv"+Id).val();
					var DevDimLevel = "100";
					var DevUpdate = $("#DevUpdate"+Id).val();
					var DevUpdateDim = '0';
					var Devap = $("#Devap"+Id).val();																																				
					var DevOnScenarioDriven = $("#DevOnScenarioDriven"+Id).val();						
					var DevOffScenarioDriven = $("#DevOffScenarioDriven"+Id).val();						
					var Deven = $("#Deven"+Id).val();						
					var DevNameOn = $("#DevNameOn"+Id).val();						
					var Devtab = $("#Devtab"+Id).val();						
					var DevName = $("#DevName"+Id).val();						
					var DevOnScheduleDriven = $("#DevOnScheduleDriven"+Id).val();						
					var DevOffScheduleDriven = $("#DevOffScheduleDriven"+Id).val();						
					var DevOnSemiAuto = $("#DevOnSemiAuto"+Id).val();						
					var DevOffSemiAuto = $("#DevOffSemiAuto"+Id).val();						
					var DevOnScheduleAndRuleDriven = $("#DevOnScheduleAndRuleDriven"+Id).val();						
					var DevOffScheduleAndRuleDriven = $("#DevOffScheduleAndRuleDriven"+Id).val();						
					var DevPicSizeWidth = $("#DevPicSizeWidth"+Id).val();						
					var DevPicSizeHeight = $("#DevPicSizeHeight"+Id).val();						
					var DevCurrentState = $("#DevCurrentState"+Id).val();
					var SupportsAbsoluteDimLvl = $("#SupportsAbsoluteDimLvl"+Id).val();
					var CurrentDimLevel = $("#CurrentDimLevel"+Id).val();
					var DevModeType = $("#DevModeType"+Id).val();
					var TabPage = "<?php echo $tabpage ?>";							
					if(clicks === 1) {
						if (DevCurrentState == "1"){
							var DevCurrentState = "2";
							var CurrentDimLevel = "100";
						}else if (DevCurrentState == "2"){
							var DevCurrentState = "1";
							var CurrentDimLevel = "0";
						}
            			timer = setTimeout(function() {	
							$.ajax({
								type: "POST",
								url: "/functions/devices.php",
								data: {'DevOnId': DevOnId, 'DevOnDiv': DevOnDiv, 'DevUpdate': DevUpdate, 'DevDimLevel': DevDimLevel, 'DevUpdateDim': DevUpdateDim},
								success: function(html){
									e.preventDefault();
									setTimeout(function(){
										if(html = 'success') {
											$('#ap<?php echo $tabpage ?>DivDev'+ DevOnDiv).fadeOut('fast').delay(1000);																						
											$('#ap<?php echo $tabpage ?>DivDev'+ DevOnDiv).load('/functions/devices_load.php?Devap='+ Devap +'&DevOnId='+ DevOnId + '&DevOnScenarioDriven='+ DevOnScenarioDriven +'&DevOffScenarioDriven='+ DevOffScenarioDriven +'&Deven='+ Deven +'&DevNameOn='+ DevNameOn +'&Devtab='+ Devtab +'&DevName='+ DevName +'&DevOnScheduleDriven='+ DevOnScheduleDriven +'&DevOffScheduleDriven='+ DevOffScheduleDriven +'&DevOnSemiAuto='+ DevOnSemiAuto +'&DevOffSemiAuto='+ DevOffSemiAuto +'&DevOnScheduleAndRuleDriven='+ DevOnScheduleAndRuleDriven +'&DevOffScheduleAndRuleDriven='+ DevOffScheduleAndRuleDriven +'&DevPicSizeWidth='+ DevPicSizeWidth +'&DevPicSizeHeight='+ DevPicSizeHeight + '&DevCurrentState='+ DevCurrentState + '&SupportsAbsoluteDimLvl='+ SupportsAbsoluteDimLvl + '&CurrentDimLevel='+ CurrentDimLevel + '&DevModeType='+ DevModeType + '&TabPage='+ TabPage + '&func=device_load').fadeIn('slow');																																											
										}
									}, 1000);
								}
							});							
							clicks = 0;             //after action performed, reset counter 
            			}, DELAY);
        			} else {
						clearTimeout(timer);    //prevent single-click action
						var DevUpdate = "cancelsemiauto";
						var DevModeType = "ScenarioDriven";
						if (DevCurrentState == "1"){
							var DevCurrentState = "2";
							var CurrentDimLevel = "100";
						}else if (DevCurrentState == "2"){
							var DevCurrentState = "1";
							var CurrentDimLevel = "0";
						}
						$.ajax({
							type: "POST",
							url: "/functions/devices.php",
							data: {'DevOnId': DevOnId, 'DevOnDiv': DevOnDiv, 'DevUpdate': DevUpdate, 'DevDimLevel': DevDimLevel, 'DevUpdateDim': DevUpdateDim},
							success: function(html){
								e.preventDefault();
								if(html = 'success') {
									$('#ap<?php echo $tabpage ?>DivDev'+ DevOnDiv).fadeOut('fast').delay(1000);											
									$('#ap<?php echo $tabpage ?>DivDev'+ DevOnDiv).load('/functions/devices_load.php?Devap='+ Devap +'&DevOnId='+ DevOnId + '&DevOnScenarioDriven='+ DevOnScenarioDriven +'&DevOffScenarioDriven='+ DevOffScenarioDriven +'&Deven='+ Deven +'&DevNameOn='+ DevNameOn +'&Devtab='+ Devtab +'&DevName='+ DevName +'&DevOnScheduleDriven='+ DevOnScheduleDriven +'&DevOffScheduleDriven='+ DevOffScheduleDriven +'&DevOnSemiAuto='+ DevOnSemiAuto +'&DevOffSemiAuto='+ DevOffSemiAuto +'&DevOnScheduleAndRuleDriven='+ DevOnScheduleAndRuleDriven +'&DevOffScheduleAndRuleDriven='+ DevOffScheduleAndRuleDriven +'&DevPicSizeWidth='+ DevPicSizeWidth +'&DevPicSizeHeight='+ DevPicSizeHeight + '&DevCurrentState='+ DevCurrentState + '&SupportsAbsoluteDimLvl='+ SupportsAbsoluteDimLvl + '&CurrentDimLevel='+ CurrentDimLevel + '&DevModeType='+ DevModeType + '&TabPage='+ TabPage + '&func=device_load');																																
									$('#ap<?php echo $tabpage ?>DivDev'+ DevOnDiv).fadeIn('slow');	
								}
							}
						});														
						clicks = 0;             //after action performed, reset counter
        			}
    			})
    			.on("dblclick", function(e){
        				e.preventDefault();  //cancel system double-click event
    			return false; });
    		});								
			//Function Dim device
			$(document).ready(function(){
				$('.DevDim').on('change',function() {
					var element = $(this);
					var Id = element.attr("id");
					var DevDimLevel = $("#DevDimLevel"+Id).val();
					var DevUpdate = $("#DevUpdateDim"+Id).val();																
					var DevOnId = $("#DevOnIdDim"+Id).val();						
					var DevOnDiv = $("#DevOnDiv"+Id).val();
					var Devap = $("#Devap"+Id).val();																																				
					var DevOnScenarioDriven = $("#DevOnScenarioDriven"+Id).val();						
					var DevOffScenarioDriven = $("#DevOffScenarioDriven"+Id).val();						
					var Deven = $("#Deven"+Id).val();						
					var DevNameOn = $("#DevNameOn"+Id).val();						
					var Devtab = $("#DevtabDim"+Id).val();						
					var DevName = $("#DevName"+Id).val();						
					var DevOnScheduleDriven = $("#DevOnScheduleDriven"+Id).val();						
					var DevOffScheduleDriven = $("#DevOffScheduleDriven"+Id).val();						
					var DevOnSemiAuto = $("#DevOnSemiAuto"+Id).val();						
					var DevOffSemiAuto = $("#DevOffSemiAuto"+Id).val();						
					var DevOnScheduleAndRuleDriven = $("#DevOnScheduleAndRuleDriven"+Id).val();						
					var DevOffScheduleAndRuleDriven = $("#DevOffScheduleAndRuleDriven"+Id).val();						
					var DevPicSizeWidth = $("#DevPicSizeWidth"+Id).val();						
					var DevPicSizeHeight = $("#DevPicSizeHeight"+Id).val();						
					var DevCurrentState = $("#DevCurrentState"+Id).val();
					var SupportsAbsoluteDimLvl = $("#SupportsAbsoluteDimLvl"+Id).val();
					var CurrentDimLevel = DevDimLevel;
					var DevModeType = $("#DevModeType"+Id).val();
					var TabPage = "<?php echo $tabpage ?>";	
					if (DevCurrentState == "1"){
						var DevCurrentState = "2";
					}
					$.ajax({
						type: "POST",
						url: "/functions/devices.php",
						data: {'DevOnId': DevOnId, 'DevOnDiv': DevOnDiv, 'DevUpdate': DevUpdate, 'DevDimLevel': DevDimLevel, 'DevUpdate': DevUpdate},
						success: function(html){
							if(html = 'success') {
								$('#ap<?php echo $tabpage ?>DivDev'+ DevOnDiv).fadeOut('fast');											
								$('#ap<?php echo $tabpage ?>DivDev'+ DevOnDiv).delay(1000).load('/functions/devices_load.php?Devap='+ Devap +'&DevOnId='+ DevOnId + '&DevOnScenarioDriven='+ DevOnScenarioDriven +'&DevOffScenarioDriven='+ DevOffScenarioDriven +'&Deven='+ Deven +'&DevNameOn='+ DevNameOn +'&Devtab='+ Devtab +'&DevName='+ DevName +'&DevOnScheduleDriven='+ DevOnScheduleDriven +'&DevOffScheduleDriven='+ DevOffScheduleDriven +'&DevOnSemiAuto='+ DevOnSemiAuto +'&DevOffSemiAuto='+ DevOffSemiAuto +'&DevOnScheduleAndRuleDriven='+ DevOnScheduleAndRuleDriven +'&DevOffScheduleAndRuleDriven='+ DevOffScheduleAndRuleDriven +'&DevPicSizeWidth='+ DevPicSizeWidth +'&DevPicSizeHeight='+ DevPicSizeHeight + '&DevCurrentState='+ DevCurrentState + '&SupportsAbsoluteDimLvl='+ SupportsAbsoluteDimLvl + '&CurrentDimLevel='+ CurrentDimLevel + '&DevModeType='+ DevModeType + '&TabPage='+ TabPage + '&func=device_load');																																
								$('#ap<?php echo $tabpage ?>DivDev'+ DevOnDiv).fadeIn('slow');	
							}
						}
					});
				return false; 	});						
			});
			//Function update systemmodes
			$(document).ready(function(){
				$('body').on('click', '.SystemmodesOn_Off', function(e){					
					e.preventDefault();
					var element = $(this);
					var Id = element.attr("id");															
					var SMId = $("#SMId"+Id).val();
					var SystemmodesUpdate = "SystemmodesUpdate";
										
					$.ajax({
						type: "POST",
						url: "/functions/systemmodes.php",
						data: {'SMId': Id, 'SystemmodesUpdate': SystemmodesUpdate},
						success: function(html){
							if(html = 'success') {
								location.reload();
							}
						}
					});
				return false; 	});						
			});
			$(document).ready(function(){
				<?php																									
				//Load devicegroups
				if ($DGEn == "true"){ ?>
					$('#devicegroupsmain').load('/functions/devicegroups.php');
					//Moveable devicegroup
					<?php if ($AllMove == "true"){ ?>
						MoveableDG('<?php echo $tabpage ?>');
					<?php }; ?>				
				<?php }; 													
				//Load Scenarios
				if ($SCEn == "true"){ ?>					
					$('#scenarios').load('/functions/scenarios.php');
					//Moveable Scenarios
					<?php if ($AllMove == "true"){ ?>			
						MoveableSC('<?php echo $tabpage ?>');
					<?php }; ?>						
				<?php }; ?>
				//Load Settingsbutton
				<?php if ($SettingsButtonActive == "true"){ ?>
					$( ".buttonsettings" ).button({ label: "<?php echo $SettingsButtonLang; ?>"}).click(function() {
						$('#settings').load('/settings/settings_tabs.php').show();
						SettingsDivVissible = 'true';
						return false;
					});
					//IF move enabled make Settings button movable
					<?php if ($AllMove == "true"){ ?>			
							MoveableSettingsButton('<?php echo $tabpage ?>');
					<?php };
				};
				//Load refreshbutton
				if ($RefreshButtonActive == "true"){ ?> 				
					$( ".refresh" ).button({ label: "<?php echo $RefreshButtonLang; ?>"}).click(function() {
						<?php if ($AllMove == "false"){ ?>
							location.reload();
						<?php }; ?>
					});
					<?php if ($AllMove == "true"){ ?>			
							MoveableRefreshButton('<?php echo $tabpage ?>');
					<?php };
				};
				//Load weather widget
				if ($WeatherEnabled == "true") { ?>			
					$('#weather').load('/functions/weather.php');
					//Moveable Weather
					<?php if ($AllMove == "true"){ ?>			
						MoveableWeather('<?php echo $tabpage ?>');
					<?php }; ?>						
				<?php }; ?>				
				//Set var for settings so autorefresh dosent hide it 
				SettingsDivVissible = 'false';
				//Function to hide settings if clicking outside settings div.  
				$(document).click(function(e){
					if($(e.target).is('#settings, #settings *'))return;
						$('#settings').hide();
						if (SettingsDivVissible == 'true'){
							SettingsDivVissible = 'false';
							location.reload();
						}												
					});					
				});	
				//Graph function on click datasource		
				$(function() {
					$('.datasource').on('click', function(){
						var element = $(this);
						var Id = element.attr("id");						
						var DSMinute = $("#MinDS"+Id).val();
						var DSSizeX = $("#SizeXDS"+Id).val();
						var DSSizeY = $("#SizeYDS"+Id).val();
						var DSName = $("#NameDS"+Id).val();
						var DSId = $("#IdDS"+Id).val();
						var dlg = $("#datasourcegraf");
						var Numbert = 25;
						var1 = parseInt(DSSizeX);
						var2 = parseInt(Numbert);
						var SizeXNew = var1+var2;
						var hours = "<?php echo $HourLang; ?>";
						var days = "<?php echo $DaysLang; ?>";
						var week = "<?php echo $WeekLang; ?>";
						var weeks = "<?php echo $WeeksLang; ?>";
						dlg.dialog( {
							minHeight: 'auto',
							width: SizeXNew,
							resizable: false,					
						});
						var dialog = $("#datasourcegraf").dialog();
						dialog.data( "uiDialog" )._title = function(title) {
							title.html( this.options.title );
						};
						//Bring upp the dialog whit dropdown list in title
						dialog.dialog({title: DSName + ' <select id="dropDown"><option value="' + DSMinute + '">own</option><option value="720">12' + hours + '</option><option value="1440">24' + hours + '</option><option value="2160">36' + hours + '</option><option value="2880">48' + hours + '</option><option value="4320">3' + days + '</option><option value="5760">4' + days + '</option><option value="7200">5' + days + '</option><option value="8640">6' + days + '</option><option value="10080">1' + week + '</option><option value="20160">2' + weeks + '</option><option value="30240">3' + weeks + '</option></select>', draggable: false});
						dialog.dialog({ position: 'top' }).load('/functions/graph.php?DSMinute='+ DSMinute + '&DSSizeX='+ DSSizeX + '&DSSizeY='+ DSSizeY + '&DSId='+ DSId + '&func=graph');
						$('#dropDown').on('change',function() {
							var NewTime = $("#dropDown").val();
							dialog.dialog({ position: 'top' }).load('/functions/graph.php?DSMinute='+ NewTime + '&DSSizeX='+ DSSizeX + '&DSSizeY='+ DSSizeY + '&DSId='+ DSId + '&func=graph');
						});
					});					
                });								
				//Function for auto refreshing all devices, systemmodes, datasources 
				<?php if ($AllMove == "false" && $AutoUp == "true"){?>
					var auto_refresh = window.setTimeout(
					function() {
						if (SettingsDivVissible == 'true') {
							//No update									
						}else{
							<?php
							include_once(dirname(__FILE__)."/functions/import_from_switchking.php");
							importtoxml(dirname(__FILE__)."/settings/tempfiles/devices.xml", "http://$User:$Pass@$Ip:$Port/$funcdev", "Devices");
							importtoxml(dirname(__FILE__)."/settings/tempfiles/systemmodes.xml", "http://$User:$Pass@$Ip:$Port/$FuncSysm", "Systemmodes");
							if ($SCEn == "true"){
								importtoxml(dirname(__FILE__)."/settings/tempfiles/scenarios.xml", "http://$User:$Pass@$Ip:$Port/$FuncSC", "Scenarios");
							};
							if ($DGEn == "true"){
								importtoxml(dirname(__FILE__)."/settings/tempfiles/devicegroups.xml", "http://$User:$Pass@$Ip:$Port/$FuncDG", "Devicegroups");
							};
							importtoxml(dirname(__FILE__)."/settings/tempfiles/datasources.xml", "http://$User:$Pass@$Ip:$Port/$FuncDS", "Datasources");
							sortxml(dirname(__FILE__)."/settings/tempfiles/devices.xml", 'ID', 'number', 'ascending', 'RESTDevice' );
							?>
							location.reload();
						}								
					}, <?php echo $TabTime; ?>, true);												
				<?php }; ?>
			
		</script>
	</head>
	<body>
    	<!-- //Start loading page -->
		<div id"main<?php echo $tabpage; ?>" style="border:none; margin: 0px; display: inline;" class="main">
			<img src="<?php echo $ImagePath.$$TabBakPic; ?>" width="<?php echo $Tab1BakPicWidth; ?>" height="<?php echo $Tab1BakPicHeight; ?>" style="border:none;"/>           
	 		<?php 	     
				 //Start loading devices.
				$idev=0;
				$CountDevs_new = $CountDevs - 1;
				while($idev<=$CountDevs_new) {
					$DevEn = "Dev".$idev."en";
					$Devid = 'DevSwitch'.$idev.'Id';
					$DevNameOn = "Dev".$idev."nameOn";
					$Devap = "Dev".$idev."ap";
					$DevPicSizeWidth = "Dev".$idev."PicSizeWidth";
					$DevPicSizeHeight = "Dev".$idev."PicSizeHeight";
					$DevOnScenarioDriven = "Dev".$idev."OnScenarioDriven";
					$DevOffScenarioDriven = "Dev".$idev."OffScenarioDriven";			
					$DevOnScheduleDriven = "Dev".$idev."OnScheduleDriven";
					$DevOffScheduleDriven = "Dev".$idev."OffScheduleDriven";			
					$DevOnSemiAuto = "Dev".$idev."OnSemiAuto";
					$DevOffSemiAuto = "Dev".$idev."OffSemiAuto";			
					$DevOnScheduleAndRuleDriven = "Dev".$idev."OnScheduleAndRuleDriven";
					$DevOffScheduleAndRuleDriven = "Dev".$idev."OffScheduleAndRuleDriven";
					$DevModeType = "DevSwitch".$idev."ModeType";
					$Devtab = "Dev".$idev."tab";
					$DevName = "DevSwitch".$idev."Name";
					$DevCurrentState = 'DevSwitch'.$idev.'CurrentStateID';
					$SupportsAbsoluteDimLvl = 'DevSwitch'.$idev.'SupportsAbsoluteDimLvl';
					$CurrentDimLevel = 'DevSwitch'.$idev.'CurrentDimLevel';
					if ($$DevEn == "true"){
						if ($$Devtab == $tabpage){ ?>
                            <div id="ap<?php echo $tabpage ?>DivDev<?php echo $$Devap ?>">
							<div class="notclickdiv"><?php
								if($$DevNameOn == 'true'){
									?><div id="divname" style="display:inline-block;">
                                        &nbsp;
                                        <div style="display:inline-block;">
                                        	<center>
												<?php echo $$DevName . "&nbsp;&nbsp;"; ?>
                                            </center>
                                        </div>
									</div>
								<?php };	
								if($$DevCurrentState == "2") { ?>					
									<center>
										<form method="post" action="" STYLE="margin:0; padding:0;">
                                        	<input type="hidden" id="DevUpdate<?php echo $idev; ?>" value="updateon" />
											<input type="hidden" id="DevOnId<?php echo $idev; ?>" value="<?php echo $$Devid; ?>" />
											<input type="hidden" id="DevOnDiv<?php echo $idev; ?>" value="<?php echo $$Devap; ?>" />                    	                                        	<input type="hidden" id="Devap<?php echo $idev; ?>" value="<?php echo $$Devap; ?>" />  														
                                            <input type="hidden" id="DevOnScenarioDriven<?php echo $idev; ?>" value="<?php echo $$DevOnScenarioDriven; ?>" />						
                                            <input type="hidden" id="DevOffScenarioDriven<?php echo $idev; ?>" value="<?php echo $$DevOffScenarioDriven; ?>" />						
                                            <input type="hidden" id="Deven<?php echo $idev; ?>" value="<?php echo $$DevEn; ?>" />						
                                            <input type="hidden" id="DevNameOn<?php echo $idev; ?>" value="<?php echo $$DevNameOn; ?>" />						
                                            <input type="hidden" id="Devtab<?php echo $idev; ?>" value="<?php echo $$Devtab; ?>" />						
                                            <input type="hidden" id="DevName<?php echo $idev; ?>" value="<?php echo $$DevName; ?>" />						
                                            <input type="hidden" id="DevOnScheduleDriven<?php echo $idev; ?>" value="<?php echo $$DevOnScheduleDriven; ?>" />						
                                            <input type="hidden" id="DevOffScheduleDriven<?php echo $idev; ?>" value="<?php echo $$DevOffScheduleDriven; ?>" />						
                                            <input type="hidden" id="DevOnSemiAuto<?php echo $idev; ?>" value="<?php echo $$DevOnSemiAuto; ?>" />						
                                            <input type="hidden" id="DevOffSemiAuto<?php echo $idev; ?>" value="<?php echo $$DevOffSemiAuto; ?>" />						
                                            <input type="hidden" id="DevOnScheduleAndRuleDriven<?php echo $idev; ?>" value="<?php echo $$DevOnScheduleAndRuleDriven; ?>" />						
                                            <input type="hidden" id="DevOffScheduleAndRuleDriven<?php echo $idev; ?>" value="<?php echo $$DevOffScheduleAndRuleDriven; ?>" />						
                                            <input type="hidden" id="DevPicSizeWidth<?php echo $idev; ?>" value="<?php echo $$DevPicSizeWidth; ?>" />						
                                            <input type="hidden" id="DevPicSizeHeight<?php echo $idev; ?>" value="<?php echo $$DevPicSizeHeight; ?>" />
                                            <input type="hidden" id="DevCurrentState<?php echo $idev; ?>" value="<?php echo $$DevCurrentState; ?>" />
											<input type="hidden" id="SupportsAbsoluteDimLvl<?php echo $idev; ?>" value="<?php echo $$SupportsAbsoluteDimLvl; ?>" />
											<input type="hidden" id="CurrentDimLevel<?php echo $idev; ?>" value="<?php echo $$CurrentDimLevel; ?>" />
                                            <input type="hidden" id="DevModeType<?php echo $idev; ?>" value="<?php echo $$DevModeType; ?>" />                                            
                                            <?php
												if ($$DevModeType == "ScenarioDriven"){ ?>
												<input type="image"  src='<?php echo $ImagePath.$$DevOnScenarioDriven; ?>'  width="<?php echo $$DevPicSizeWidth ?>" height="<?php echo $$DevPicSizeHeight ?>" id="<?php echo $$Devap ?>" style="display:block;" class="ReturnON_OFF" id="<?php echo $$Devap; ?>"/>
                                            <?php }else if ($$DevModeType == "ScheduleDriven") { ?>
                                            <input type="image"  src='<?php echo $ImagePath.$$DevOnScheduleDriven; ?>'  width="<?php echo $$DevPicSizeWidth ?>" height="<?php echo $$DevPicSizeHeight ?>" id="ReturnOn" style="display:block;" class="ReturnON_OFF" id="<?php echo $$Devap; ?>"/>
                                            <?php }else if ($$DevModeType == "SemiAuto") { ?>
                                            <input type="image"  src='<?php echo $ImagePath.$$DevOnSemiAuto; ?>'  width="<?php echo $$DevPicSizeWidth ?>" height="<?php echo $$DevPicSizeHeight ?>" id="<?php echo $$Devap ?>" style="display:block;" class="ReturnON_OFF" id="<?php echo $$Devap; ?>"/>
                                            <?php }else if ($$DevModeType == "ScheduleAndRuleDriven") { ?>
                                            <input type="image"  src='<?php echo $ImagePath.$$DevOnScheduleAndRuleDriven; ?>'  width="<?php echo $$DevPicSizeWidth ?>" height="<?php echo $$DevPicSizeHeight ?>" id="<?php echo $$Devap ?>" style="display:block;" class="ReturnON_OFF" id="<?php echo $$Devap; ?>"/>
                                            <?php }; ?>
										</form>
									</center>
								<?php }else{ ?>        
									<center>
										<form method="post" action="" STYLE="margin:0; padding:0;">
											<input type="hidden" id="DevUpdate<?php echo $idev; ?>" value="updateoff" />
											<input type="hidden" id="DevOnId<?php echo $idev; ?>" value="<?php echo $$Devid; ?>" />
											<input type="hidden" id="DevOnDiv<?php echo $idev; ?>" value="<?php echo $$Devap; ?>" />                    	                                        	<input type="hidden" id="Devap<?php echo $idev; ?>" value="<?php echo $$Devap; ?>" />  														
                                            <input type="hidden" id="DevOnScenarioDriven<?php echo $idev; ?>" value="<?php echo $$DevOnScenarioDriven; ?>" />						
                                            <input type="hidden" id="DevOffScenarioDriven<?php echo $idev; ?>" value="<?php echo $$DevOffScenarioDriven; ?>" />						
                                            <input type="hidden" id="Deven<?php echo $idev; ?>" value="<?php echo $$DevEn; ?>" />						
                                            <input type="hidden" id="DevNameOn<?php echo $idev; ?>" value="<?php echo $$DevNameOn; ?>" />						
                                            <input type="hidden" id="Devtab<?php echo $idev; ?>" value="<?php echo $$Devtab; ?>" />						
                                            <input type="hidden" id="DevName<?php echo $idev; ?>" value="<?php echo $$DevName; ?>" />						
                                            <input type="hidden" id="DevOnScheduleDriven<?php echo $idev; ?>" value="<?php echo $$DevOnScheduleDriven; ?>" />						
                                            <input type="hidden" id="DevOffScheduleDriven<?php echo $idev; ?>" value="<?php echo $$DevOffScheduleDriven; ?>" />						
                                            <input type="hidden" id="DevOnSemiAuto<?php echo $idev; ?>" value="<?php echo $$DevOnSemiAuto; ?>" />						
                                            <input type="hidden" id="DevOffSemiAuto<?php echo $idev; ?>" value="<?php echo $$DevOffSemiAuto; ?>" />						
                                            <input type="hidden" id="DevOnScheduleAndRuleDriven<?php echo $idev; ?>" value="<?php echo $$DevOnScheduleAndRuleDriven; ?>" />						
                                            <input type="hidden" id="DevOffScheduleAndRuleDriven<?php echo $idev; ?>" value="<?php echo $$DevOffScheduleAndRuleDriven; ?>" />						
                                            <input type="hidden" id="DevPicSizeWidth<?php echo $idev; ?>" value="<?php echo $$DevPicSizeWidth; ?>" />						
                                            <input type="hidden" id="DevPicSizeHeight<?php echo $idev; ?>" value="<?php echo $$DevPicSizeHeight; ?>" />
                                            <input type="hidden" id="DevCurrentState<?php echo $idev; ?>" value="<?php echo $$DevCurrentState; ?>" />
											<input type="hidden" id="SupportsAbsoluteDimLvl<?php echo $idev; ?>" value="<?php echo $$SupportsAbsoluteDimLvl; ?>" />
											<input type="hidden" id="CurrentDimLevel<?php echo $idev; ?>" value="<?php echo $$CurrentDimLevel; ?>" />
                                            <input type="hidden" id="DevModeType<?php echo $idev; ?>" value="<?php echo $$DevModeType; ?>" />
											<?php
												if ($$DevModeType == "ScenarioDriven"){ ?>
												<input type="image"  src='<?php echo $ImagePath.$$DevOffScenarioDriven; ?>'  width="<?php echo $$DevPicSizeWidth ?>" height="<?php echo $$DevPicSizeHeight ?>" id="<?php echo $$Devap ?>" style="display:block;" class="ReturnON_OFF" id="<?php echo $$Devap; ?>"/>
                                            <?php }else if ($$DevModeType == "ScheduleDriven") { ?>
                                            <input type="image"  src='<?php echo $ImagePath.$$DevOffScheduleDriven; ?>'  width="<?php echo $$DevPicSizeWidth ?>" height="<?php echo $$DevPicSizeHeight ?>" id="<?php echo $$Devap ?>" style="display:block;" class="ReturnON_OFF" id="<?php echo $$Devap; ?>"/>
                                            <?php }else if ($$DevModeType == "SemiAuto") { ?>
                                            <input type="image"  src='<?php echo $ImagePath.$$DevOffSemiAuto; ?>'  width="<?php echo $$DevPicSizeWidth ?>" height="<?php echo $$DevPicSizeHeight ?>" id="<?php echo $$Devap ?>" style="display:block;" class="ReturnON_OFF" id="<?php echo $$Devap; ?>"/>
                                            <?php }else if ($$DevModeType == "ScheduleAndRuleDriven") { ?>
                                            <input type="image"  src='<?php echo $ImagePath.$$DevOffScheduleAndRuleDriven; ?>'  width="<?php echo $$DevPicSizeWidth ?>" height="<?php echo $$DevPicSizeHeight ?>" id="<?php echo $$Devap ?>" style="display:block;" class="ReturnON_OFF" id="<?php echo $$Devap; ?>"/>
                                            <?php }; ?>
										</form>
									</center>
									<?php		
								};
								if($$SupportsAbsoluteDimLvl == 'true') {
									if (($$CurrentDimLevel == '-1') && ($$DevCurrentState == "2")){
										$dimlevelzero = '100';
									}elseif(($$CurrentDimLevel == '-1') && ($$DevCurrentState == "1")){
										$dimlevelzero = '0';
									}else{
									$dimlevelzero = $$CurrentDimLevel;
									};
									?>
									<center>
									<form action="" class="DevDim" id="<?php echo $idev; ?>" method="post" STYLE="margin:0; padding:0;">
										<select id="DevDimLevel<?php echo $idev; ?>">
											<option selected="<?php $$CurrentDimLevel; ?>"><?php echo $dimlevelzero; ?>%</option>
											<option value="100">100%</option>
											<option value="90">90%</option>
											<option value="80">80%</option>
											<option value="70">70%</option>
											<option value="60">60%</option>
											<option value="50">50%</option>
											<option value="40">40%</option>
											<option value="30">30%</option>
											<option value="20">20%</option>
											<option value="10">10%</option>
											<input type="hidden" id="DevOnIdDim<?php echo $idev; ?>" value="<?php echo $$Devid; ?>" />
											<input type="hidden" id="DevUpdateDim<?php echo $idev; ?>" value="updatedim" />
											<input type="hidden" id="DevtabDim<?php echo $idev; ?>" value="<?php echo $$Devtab; ?>" />
										</select>
									</form>
									</center>
								<?php		
								};					
							?></div></div><?php	
						}; 
					};
					//If moveable is active call Move function and in style file (dev style file) sett form not clickable
					if ($AllMove == "true"){
					?>
                    <script>
					MoveableDivs<?php echo $tabpage ?>('<?php echo $$Devap ?>', '<?php echo $$Devid ?>', '<?php echo $tabpage ?>');
					</script>
                    <?php
					}
					$idev++;
				};					
			//Load Divs for datasources		
			$idsd=0;
			while($idsd<=$CountDS) {
				$DSNameOn = "DS".$idsd."NameOn";
				$DSTab = "DS".$idsd."Tab";
				$DSFa = "DS".$idsd."Fa";
				$DSAp = "DS".$idsd."Ap";
				$DSName = "DSSwitch".$idsd."Name";
				$DSLastValue = "DSSwitch".$idsd."LastValue";
				$DSId = "DSSwitch".$idsd."Id";
				$DSEn = "DS".$idsd."En";
				$DSSizeX = "DS".$idsd."SizeX";
				$DSSizeY = "DS".$idsd."SizeY";
				$DSMinute = "DS".$idsd."Minute";
				if ($$DSTab == $tabpage && $$DSEn == "true"){
						?>
						<div id="ap<?php echo $tabpage ?>DivDS<?php echo $idsd ?>">
                            <div class="notclickdiv">
                                <center>
                                    <div id="<?php echo 'dss' . $$DSAp; ?>" style="display:inline-block;">                
                                        &nbsp;
                                        <div id="<?php echo $$DSAp; ?>" class="datasource"style="display:inline-block;" >
											<?php		
                                            if($$DSNameOn == 'true'){
                                                echo $$DSName;
                                                echo "&nbsp;&nbsp;";			
                                                ?><br /><?php 
                                            };
                                            echo $$DSLastValue; 
                                            echo $$DSFa . "&nbsp;&nbsp;";			
                                            ?>               
                                            <input type="hidden" id="IdDS<?php echo $idsd; ?>" value="<?php echo $$DSId; ?>">
                                            <input type="hidden" id="NameDS<?php echo $idsd; ?>" value="<?php echo $$DSName; ?>">
                                            <input type="hidden" id="SizeXDS<?php echo $idsd; ?>" value="<?php echo $$DSSizeX; ?>">
                                            <input type="hidden" id="SizeYDS<?php echo $idsd; ?>" value="<?php echo $$DSSizeY; ?>">
                                            <input type="hidden" id="MinDS<?php echo $idsd; ?>" value="<?php echo $$DSMinute; ?>">             
                                        </div>       
                                    </div>
                                </center>
                            </div>
						</div>
						<?php
				};
				//Moveable
				if ($AllMove == "true"){ ?> 
					<script>
                    	MoveableDS<?php echo $tabpage ?>('<?php echo $$DSAp ?>', '<?php echo $$DSId ?>', '<?php echo $tabpage ?>');
                    </script>
                    <?php
				};
				$idsd++;
			};				
			//Load systemmodes
			$ismd=0;
				while($ismd<=$SMNumbers) {	
				$SMEn = "SM".$ismd."En";
				$SMId = "SMSwitch".$ismd."Id";
				$SMAp = "SM".$ismd."Ap";
				$SMOn = "SM".$ismd."On";
				$SMTab = "SM".$ismd."Tab";
				$SMOff = "SM".$ismd."Off";
				if ($$SMTab == $tabpage && $$SMEn == "true"){
					?>
					<div id="ap<?php echo $tabpage ?>DivSM<?php echo $ismd ?>">
                    <div class="notclickdiv">
						<?php
						$xmlSM = simplexml_load_file("http://$User:$Pass@$Ip:$Port/$FuncSysm/active");
						$json = json_encode($xmlSM);
						$arraySM = json_decode($json,TRUE);
						if($arraySM['ID'] == $$SMId) {
							?>
							<center>
								<img src='<?php echo $ImagePath.$$SMOn; ?>' width="60" height="60">
							</center>
							<?php
						}else{
							?>
							<center>
								<form method="post" action="" STYLE="margin:0; padding:0;">
									<input type="image" id='<?php echo $$SMId; ?>' src='<?php echo $ImagePath.$$SMOff; ?>' value="" class="SystemmodesOn_Off" width="60" height="60"/>
								</form>
							</center>    			
							<?php
						} ?>
                        </div>															
					</div>
					<?php
				}				
				//Moveable
				if ($AllMove == "true"){ ?> 
					<script>
                    	MoveableSM<?php echo $tabpage ?>('<?php echo $$SMAp ?>', '<?php echo $$SMId ?>', '<?php echo $tabpage ?>');
                    </script>
                    <?php
				};				
				$ismd++;
			};					
			//If move enabled bring upp move dialog div.
    		if ($AllMove == "true"){
    			?>
                <div class="moverespond">
				<div><center><?php echo $MoveMainLang; ?></center></div>
                <div id="respond"></div>
                </div>
				<?php 			                
			}; ?>
   			<div id="scenariosmain" style="">  
   				<div style="display:inline-block;" id="scenarios">
                </div>
    			<?php if ($SCEn == "true" && $SCHideable == "true"){ ?>					
						<div style="display:inline-block;background:black;cursor:pointer;width:5px;height:80%" class="buttonsc">
                        </div>
   				<?php }; ?>
    		</div>
            <?php if ($WeatherEnabled == "true") { ?>
            <div id="weather" class="weather"></div>
            <?php }; ?>
            <div id="devicegroupsmain"></div>   
   			<div id="settings" style="display: none" class="settings"></div>
            <div id="datasourcegraf" style="display: none" class="datasourcegraf"></div>
            <div id="refresh" class="refresh">
			</div>
   			<div id="buttonsettings" class="buttonsettings">
   			</div>
 		</div>
	</body>
</html>