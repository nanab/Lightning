<!-- V2.0 Copyright Nanab nanab666@gmail.com. -->
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<?php $TabBakPic = 'Tab'.$tabpage.'BakPic'; 
		include(dirname(__FILE__)."/functions/devices_load.php");?> <!-- Set bakground picture for specifik tab. -->
		<script src="<?php echo $Jquery; ?>"></script> <!-- Inlude jquery files. -->
		<script src="<?php echo $JqueryCustom; ?>"></script> <!-- Inlude jquery files. -->        
		<link rel="stylesheet" href="<?php echo $JqueryCustomCss; ?>" />
        <link rel="stylesheet" href="<?php echo $JqueryCustomCss2; ?>" />
        <?php if ($RazberryActive == "true") { ?>      <!-- If razzbery is aktivated start loading files. -->
			<script src="razberry/razberry_load.js"></script> 
            <script src="razberry/jquery.triggerpath.js"></script> 
            <script src="razberry/jquery.dateformat.js"></script> 
        <?php } ?> <!-- Done loading razberry files -->		
        <?php if ($AllMove == "true") { ?>   <!-- If move is active load move functions -->	
			<script src="/functions/moveabledivs.js"></script>            
		<?php }; // Done loading move function
						
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
			#device2 { 
				position: absolute;
				cursor:pointer;						
				z-index: 25;
				left: 10px;
				top: 10px;
				font-size: 12px; 	
			}
		</style>
		<script>
			//Function for hide scenarios BETA!
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
								url: "<?php echo $Catalog; ?>/functions/devices.php",
								data: {'DevOnId': DevOnId, 'DevOnDiv': DevOnDiv, 'DevUpdate': DevUpdate, 'DevDimLevel': DevDimLevel, 'DevUpdateDim': DevUpdateDim},
								success: function(html){
									e.preventDefault();
									setTimeout(function(){
										if(html = 'success') {
											$('#ap<?php echo $tabpage ?>DivDev'+ DevOnDiv).fadeOut('fast').delay(1000);																						
											$('#ap<?php echo $tabpage ?>DivDev'+ DevOnDiv).load('<?php echo $Catalog; ?>/functions/devices_load.php?Devap='+ Devap +'&DevOnId='+ DevOnId + '&DevOnScenarioDriven='+ DevOnScenarioDriven +'&DevOffScenarioDriven='+ DevOffScenarioDriven +'&Deven='+ Deven +'&DevNameOn='+ DevNameOn +'&Devtab='+ Devtab +'&DevName='+ DevName +'&DevOnScheduleDriven='+ DevOnScheduleDriven +'&DevOffScheduleDriven='+ DevOffScheduleDriven +'&DevOnSemiAuto='+ DevOnSemiAuto +'&DevOffSemiAuto='+ DevOffSemiAuto +'&DevOnScheduleAndRuleDriven='+ DevOnScheduleAndRuleDriven +'&DevOffScheduleAndRuleDriven='+ DevOffScheduleAndRuleDriven +'&DevPicSizeWidth='+ DevPicSizeWidth +'&DevPicSizeHeight='+ DevPicSizeHeight + '&DevCurrentState='+ DevCurrentState + '&SupportsAbsoluteDimLvl='+ SupportsAbsoluteDimLvl + '&CurrentDimLevel='+ CurrentDimLevel + '&DevModeType='+ DevModeType + '&TabPage='+ TabPage + '&func=device_load').fadeIn('slow');																																											
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
							url: "<?php echo $Catalog; ?>/functions/devices.php",
							data: {'DevOnId': DevOnId, 'DevOnDiv': DevOnDiv, 'DevUpdate': DevUpdate, 'DevDimLevel': DevDimLevel, 'DevUpdateDim': DevUpdateDim},
							success: function(html){
								e.preventDefault();
								if(html = 'success') {
									$('#ap<?php echo $tabpage ?>DivDev'+ DevOnDiv).fadeOut('fast').delay(1000);											
									$('#ap<?php echo $tabpage ?>DivDev'+ DevOnDiv).load('<?php echo $Catalog; ?>/functions/devices_load.php?Devap='+ Devap +'&DevOnId='+ DevOnId + '&DevOnScenarioDriven='+ DevOnScenarioDriven +'&DevOffScenarioDriven='+ DevOffScenarioDriven +'&Deven='+ Deven +'&DevNameOn='+ DevNameOn +'&Devtab='+ Devtab +'&DevName='+ DevName +'&DevOnScheduleDriven='+ DevOnScheduleDriven +'&DevOffScheduleDriven='+ DevOffScheduleDriven +'&DevOnSemiAuto='+ DevOnSemiAuto +'&DevOffSemiAuto='+ DevOffSemiAuto +'&DevOnScheduleAndRuleDriven='+ DevOnScheduleAndRuleDriven +'&DevOffScheduleAndRuleDriven='+ DevOffScheduleAndRuleDriven +'&DevPicSizeWidth='+ DevPicSizeWidth +'&DevPicSizeHeight='+ DevPicSizeHeight + '&DevCurrentState='+ DevCurrentState + '&SupportsAbsoluteDimLvl='+ SupportsAbsoluteDimLvl + '&CurrentDimLevel='+ CurrentDimLevel + '&DevModeType='+ DevModeType + '&TabPage='+ TabPage + '&func=device_load');																																
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
    										
			//Function Dim device
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
						url: "<?php echo $Catalog; ?>/functions/devices.php",
						data: {'DevOnId': DevOnId, 'DevOnDiv': DevOnDiv, 'DevUpdate': DevUpdate, 'DevDimLevel': DevDimLevel, 'DevUpdate': DevUpdate},
						success: function(html){
							if(html = 'success') {
								$('#ap<?php echo $tabpage ?>DivDev'+ DevOnDiv).fadeOut('fast');											
								$('#ap<?php echo $tabpage ?>DivDev'+ DevOnDiv).delay(1000).load('<?php echo $Catalog; ?>/functions/devices_load.php?Devap='+ Devap +'&DevOnId='+ DevOnId + '&DevOnScenarioDriven='+ DevOnScenarioDriven +'&DevOffScenarioDriven='+ DevOffScenarioDriven +'&Deven='+ Deven +'&DevNameOn='+ DevNameOn +'&Devtab='+ Devtab +'&DevName='+ DevName +'&DevOnScheduleDriven='+ DevOnScheduleDriven +'&DevOffScheduleDriven='+ DevOffScheduleDriven +'&DevOnSemiAuto='+ DevOnSemiAuto +'&DevOffSemiAuto='+ DevOffSemiAuto +'&DevOnScheduleAndRuleDriven='+ DevOnScheduleAndRuleDriven +'&DevOffScheduleAndRuleDriven='+ DevOffScheduleAndRuleDriven +'&DevPicSizeWidth='+ DevPicSizeWidth +'&DevPicSizeHeight='+ DevPicSizeHeight + '&DevCurrentState='+ DevCurrentState + '&SupportsAbsoluteDimLvl='+ SupportsAbsoluteDimLvl + '&CurrentDimLevel='+ CurrentDimLevel + '&DevModeType='+ DevModeType + '&TabPage='+ TabPage + '&func=device_load');																																
								$('#ap<?php echo $tabpage ?>DivDev'+ DevOnDiv).fadeIn('slow');	
							}
						}
					});
				return false; 	});						
			
			//Function update systemmodes
				$('body').on('click', '.SystemmodesOn_Off', function(e){					
					e.preventDefault();
					var element = $(this);
					var Id = element.attr("id");															
					var SMId = $("#SMId"+Id).val();
					var SystemmodesUpdate = "SystemmodesUpdate";
										
					$.ajax({
						type: "POST",
						url: "<?php echo $Catalog; ?>/functions/systemmodes.php",
						data: {'SMId': Id, 'SystemmodesUpdate': SystemmodesUpdate},
						success: function(html){
							if(html = 'success') {
								location.reload();
							}
						}
					});
				return false; 	});						
				<?php																									
				//Load devicegroups
				if ($DGEn == "true"){ ?>
					$('#devicegroupsmain').load('<?php echo $Catalog; ?>/functions/devicegroups.php');
					//Moveable devicegroup
					<?php if ($AllMove == "true"){ ?>
						MoveableDG('<?php echo $tabpage ?>');
					<?php }; ?>				
				<?php }; 													
				//Load Scenarios
				if ($SCEn == "true"){ ?>					
					$('#scenarios').load('<?php echo $Catalog; ?>/functions/scenarios.php');
					//Moveable Scenarios
					<?php if ($AllMove == "true"){ ?>			
						MoveableSC('<?php echo $tabpage ?>');
					<?php }; ?>						
				<?php };
				//Load Settingsbutton
				if ($SettingsButtonActive == "true"){ ?>
					$( ".buttonsettings" ).button({ label: "<?php echo $SettingsButtonLang; ?>"}).click(function() {
						$('#settings').load('<?php echo $Catalog; ?>/settings/settings_tabs.php').show();
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
					$('#weather').load('<?php echo $Catalog; ?>/functions/weather.php');
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
						dialog.dialog({ position: 'top' }).load('<?php echo $Catalog; ?>/functions/graph.php?DSMinute='+ DSMinute + '&DSSizeX='+ DSSizeX + '&DSSizeY='+ DSSizeY + '&DSId='+ DSId + '&func=graph');
						$('#dropDown').on('change',function() {
							var NewTime = $("#dropDown").val();
							dialog.dialog({ position: 'top' }).load('<?php echo $Catalog; ?>/functions/graph.php?DSMinute='+ NewTime + '&DSSizeX='+ DSSizeX + '&DSSizeY='+ DSSizeY + '&DSId='+ DSId + '&func=graph');
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
							var tabpaged = '<?php echo $tabpage; ?>';	
							$('#devices_div').fadeOut('fast').load('<?php echo $Catalog; ?>/functions/devices_load.php?tabpage='+ tabpaged + '&func=device_load_first').fadeIn('slow');					
							//location.reload(); //Reload page
						}								
					}, <?php echo $TabTime; ?>, true);												
				<?php }; ?>			
		</script>
	</head>
	<body>
    	<!-- //Start loading page -->
		<div id"main<?php echo $tabpage; ?>" style="border:none; margin: 0px; display: inline;" class="main"> <!--Main div -->
	 		<img src="<?php echo $ImagePath.$$TabBakPic; ?>" width="<?php echo $Tab1BakPicWidth; ?>" height="<?php echo $Tab1BakPicHeight; ?>" style="border:none;"/> <!--Background picture -->           
	 		
			<div id="devices_div"> 	     
				<?php 
				device_load_first($tabpage); //load devices from device_load_first.php
				?>
            </div>
			<?php	
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
			$SMNumbers = $SMNumbers - 1; 
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
            <div id="refresh" class="refresh"></div>
   			<div id="buttonsettings" class="buttonsettings"></div>
            <?php if ($RazberryActive == "true") { ?> <!-- If razberry is activated start add support for Razberry zwave device --> 
           	<div class="razberry"></div> 
            <?php } ?> <!-- Done adding support for razberry -->
 		</div>
	</body>
