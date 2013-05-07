<?php
if (@$_GET["func"] == "device_load") {	
@$Devap = $_GET["Devap"];
@$Devid = $_GET["Devid"];
@$DevOnId = $_GET["DevOnId"];
@$DevOnScenarioDriven = $_GET["DevOnScenarioDriven"];
@$DevOffScenarioDriven = $_GET["DevOffScenarioDriven"];
@$DevEn = $_GET["Deven"];
@$DevNameOn = $_GET["DevNameOn"];
@$DevTab = $_GET["Devtab"];
@$DevName = $_GET["DevName"];
@$DevOnScheduleDriven = $_GET["DevOnScheduleDriven"];
@$DevOffScheduleDriven = $_GET["DevOffScheduleDriven"];
@$DevOnSemiAuto = $_GET["DevOnSemiAuto"];
@$DevOffSemiAuto = $_GET["DevOffSemiAuto"];
@$DevOnScheduleAndRuleDriven = $_GET["DevOnScheduleAndRuleDriven"];
@$DevOffScheduleAndRuleDriven = $_GET["DevOffScheduleAndRuleDriven"];
@$DevPicSizeWidth = $_GET["DevPicSizeWidth"];
@$DevPicSizeHeight = $_GET["DevPicSizeHeight"];
@$DevCurrentState2 = $_GET["DevCurrentState"];
@$SupportsAbsoluteDimLvl = $_GET["SupportsAbsoluteDimLvl"];
@$CurrentDimLevel = $_GET["CurrentDimLevel"];
@$DevModeTyp2e = $_GET["DevModeType"];
include(dirname(__FILE__)."/../settings/load_settings.php");
$Xmlread = simplexml_load_file("http://$User:$Pass@$Ip:$Port/$funcdev/$DevOnId");
$DevModeType = $Xmlread->ModeType;
$DevCurrentState = $Xmlread->CurrentStateID;		
    device_load($Devap, $Devid, $DevOnId,$DevOnScenarioDriven, $DevOffScenarioDriven, $DevEn, $DevNameOn, $DevTab, $DevName, $DevOnScheduleDriven, $DevOffScheduleDriven, $DevOnSemiAuto, $DevOffSemiAuto, $DevOnScheduleAndRuleDriven, $DevOffScheduleAndRuleDriven, $DevPicSizeWidth, $DevPicSizeHeight, $DevCurrentState, $SupportsAbsoluteDimLvl, $CurrentDimLevel, $DevModeType);
    die();
};
if (@$_GET["func"] == "device_load_first") {
	
	device_load_first(1);
	die();
}
function device_load($Devap, $Devid, $DevOnId, $DevOnScenarioDriven, $DevOffScenarioDriven, $DevEn, $DevNameOn, $DevTab, $DevName, $DevOnScheduleDriven, $DevOffScheduleDriven, $DevOnSemiAuto, $DevOffSemiAuto, $DevOnScheduleAndRuleDriven, $DevOffScheduleAndRuleDriven, $DevPicSizeWidth, $DevPicSizeHeight, $DevCurrentState1, $SupportsAbsoluteDimLvl1, $CurrentDimLevel1, $DevModeType){	
include(dirname(__FILE__)."/../settings/load_settings.php");	
	if ($DevEn == "true"){                         		
		$DevPicSizeWidth = "30";
		$DevPicSizeHeight = "30";				                    
		?>
        <div id="<?php echo $Devap ?>" class="deve">            
            <div style="display:inline-block;">
            	<form method="post" action="" STYLE="margin:0; padding:0;">
            		<input type="hidden" id="DevOnId<?php echo $Devap; ?>" value="<?php echo $DevOnId; ?>" />
					<input type="hidden" id="DevOnDiv<?php echo $Devap; ?>" value="<?php echo $Devap; ?>" />
					<input type="hidden" id="Devap<?php echo $Devap; ?>" value="<?php echo $Devap; ?>" />
                    <input type="hidden" id="DevOnScenarioDriven<?php echo $Devap; ?>" value="<?php echo $DevOnScenarioDriven; ?>" />						
                    <input type="hidden" id="DevOffScenarioDriven<?php echo $Devap; ?>" value="<?php echo $DevOffScenarioDriven; ?>" />						
                    <input type="hidden" id="Deven<?php echo $Devap; ?>" value="<?php echo $DevEn; ?>" />						
                    <input type="hidden" id="DevNameOn<?php echo $Devap; ?>" value="<?php echo $DevNameOn; ?>" />						
                    <input type="hidden" id="Devtab<?php echo $Devap; ?>" value="<?php echo $DevTab; ?>" />	
                    <input type="hidden" id="DevName<?php echo $Devap; ?>" value="<?php echo $DevName; ?>" />						
                    <input type="hidden" id="DevOnScheduleDriven<?php echo $Devap; ?>" value="<?php echo $DevOnScheduleDriven; ?>" />						
                    <input type="hidden" id="DevOffScheduleDriven<?php echo $Devap; ?>" value="<?php echo $DevOffScheduleDriven; ?>" />						
                    <input type="hidden" id="DevOnSemiAuto<?php echo $Devap; ?>" value="<?php echo $DevOnSemiAuto; ?>" />						
                    <input type="hidden" id="DevOffSemiAuto<?php echo $Devap; ?>" value="<?php echo $DevOffSemiAuto; ?>" />						
                    <input type="hidden" id="DevOnScheduleAndRuleDriven<?php echo $Devap; ?>" value="<?php echo $DevOnScheduleAndRuleDriven; ?>" />						
                    <input type="hidden" id="DevOffScheduleAndRuleDriven<?php echo $Devap; ?>" value="<?php echo $DevOffScheduleAndRuleDriven; ?>" />						
                    <input type="hidden" id="DevPicSizeWidth<?php echo $Devap; ?>" value="<?php echo $DevPicSizeWidth; ?>" />						
                    <input type="hidden" id="DevPicSizeHeight<?php echo $Devap; ?>" value="<?php echo $DevPicSizeHeight; ?>" />
                    <input type="hidden" id="DevCurrentState<?php echo $Devap; ?>" value="<?php echo $DevCurrentState1; ?>" />
					<input type="hidden" id="SupportsAbsoluteDimLvl<?php echo $Devap; ?>" value="<?php echo $SupportsAbsoluteDimLvl1; ?>" />
					<input type="hidden" id="CurrentDimLevel<?php echo $Devap; ?>" value="<?php echo $CurrentDimLevel1; ?>" />
                    <input type="hidden" id="DevModeType<?php echo $Devap; ?>" value="<?php echo $DevModeType; ?>" />       		
            		<?php
					if($DevCurrentState1 == "2") { ?>														
                        <input type="hidden" id="DevUpdate<?php echo $Devap; ?>" value="updateon" />							             		                                                           
                        <?php
						if ($DevModeType == "ScenarioDriven"){ 
							?>
							<input type="image"  src='<?php echo $ImagePath.$DevOnScenarioDriven; ?>'  width="<?php echo $DevPicSizeWidth ?>" height="<?php echo $DevPicSizeHeight ?>" id="<?php echo $Devap ?>" style="display:block;" class="ReturnON_OFF" id="<?php echo $Devap; ?>"/>
							<?php 
						}else if ($DevModeType == "ScheduleDriven") { 
							?>
							<input type="image"  src='<?php echo $ImagePath.$DevOnScheduleDriven; ?>'  width="<?php echo $DevPicSizeWidth ?>" height="<?php echo $DevPicSizeHeight ?>" id="ReturnOn" style="display:block;" class="ReturnON_OFF" id="<?php echo $Devap; ?>"/>
							<?php 
						}else if ($DevModeType == "SemiAuto") { 
							?>
                            <input type="image"  src='<?php echo $ImagePath.$DevOnSemiAuto; ?>'  width="<?php echo $DevPicSizeWidth ?>" height="<?php echo $DevPicSizeHeight ?>" id="<?php echo $Devap ?>" style="display:block;" class="ReturnON_OFF" id="<?php echo $Devap; ?>"/>
                            <?php 
						}else if ($DevModeType == "ScheduleAndRuleDriven") { 
							?>
                            <input type="image"  src='<?php echo $ImagePath.$DevOnScheduleAndRuleDriven; ?>'  width="<?php echo $DevPicSizeWidth ?>" height="<?php echo $DevPicSizeHeight ?>" id="<?php echo $Devap ?>" style="display:block;" class="ReturnON_OFF" id="<?php echo $Devap; ?>"/>
                            <?php 
						}; 
						?>
				</form>
			</div>
            <div style="display:inline-block;vertical-align:top;">                    
				<?php 
				echo "<font size='2'>" . $DevName . "</font>";
				echo "<br>";
				echo "<font size='1'>On</font>";				
				?>                
			</div>				                
                <?php
			}else{ 
				?>        									
				<input type="hidden" id="DevUpdate<?php echo $Devap; ?>" value="updateoff" />                     		                       
				<?php
				if ($DevModeType == "ScenarioDriven"){ 
					?>
					<input type="image"  src='<?php echo $ImagePath.$DevOffScenarioDriven; ?>'  width="<?php echo $DevPicSizeWidth ?>" height="<?php echo $DevPicSizeHeight ?>" id="<?php echo $Devap ?>" style="display:block;" class="ReturnON_OFF" id="<?php echo $Devap; ?>"/>
                    <?php 
				}else if ($DevModeType == "ScheduleDriven") { 
					?>
                    <input type="image"  src='<?php echo $ImagePath.$DevOffScheduleDriven; ?>'  width="<?php echo $DevPicSizeWidth ?>" height="<?php echo $DevPicSizeHeight ?>" id="<?php echo $Devap ?>" style="display:block;" class="ReturnON_OFF" id="<?php echo $Devap; ?>"/>
                    <?php 
				}else if ($DevModeType == "SemiAuto") { 
					?>
                    <input type="image"  src='<?php echo $ImagePath.$DevOffSemiAuto; ?>'  width="<?php echo $DevPicSizeWidth ?>" height="<?php echo $DevPicSizeHeight ?>" id="<?php echo $Devap ?>" style="display:block;" class="ReturnON_OFF" id="<?php echo $Devap; ?>"/>
                    <?php 
				}else if ($DevModeType == "ScheduleAndRuleDriven") { 
					?>
                    <input type="image"  src='<?php echo $ImagePath.$DevOffScheduleAndRuleDriven; ?>'  width="<?php echo $DevPicSizeWidth ?>" height="<?php echo $DevPicSizeHeight ?>" id="<?php echo $Devap ?>" style="display:block;" class="ReturnON_OFF" id="<?php echo $Devap; ?>"/>
                    <?php 
				}; 
				?>
				</form>
			</div>
            <div style="display:inline-block;vertical-align:top;">                    
				<?php 
				echo "<font size='2'>" . $DevName . "</font>";
				echo "<br>";
				echo "<font size='1'>Off</font>";
				?>                
			</div>				
			<?php		
		};			
		if($SupportsAbsoluteDimLvl1 == 'true') {
			if (($CurrentDimLevel1 == '-1') && ($DevCurrentState1 == "2")){
				$dimlevelzero = '100';
			}elseif(($CurrentDimLevel1 == '-1') && ($DevCurrentState1 == "1")){
				$dimlevelzero = '0';
			}else{
				$dimlevelzero = $CurrentDimLevel1;
			};
			?>
            <script>
				$(function() {
    				$( "#slider" ).slider({
      					range: "max",
     					min: 0,
      					max: 100,
      					value: <?php echo $dimlevelzero; ?>,
						step: 10,
      					slide: function( event, ui ) {
        					$( "#slider_value" ).val( ui.value );
      					}
    				});
    				$( "#slider_value" ).val( $( "#slider" ).slider( "value" ) );
  				});
			</script>
                <div style="width:15px;display:inline-block;"></div>
                <div id="dim" style="display:inline-block;">
              	                                                                                            		                                                                               	 
						<div id="slider" DevOnIdDim="<?php echo $DevOnId; ?>" DevUpdateDim="updatedim" DevtabDim="<?php echo $DevTab; ?>" style="display:inline-block;"></div>               		         
                		<div style="display:inline-block;"><input type="text" id="slider_value"><label for="slider_value" style="font-size:9;">%</label></div>	                     
                	
                    
                <!--
					<form action="" class="DevDim" id="<?php echo $Devap; ?>" method="post" STYLE="margin:0; padding:0;">
						<select id="DevDimLevel<?php echo $Devap; ?>">
							<option selected="<?php echo $dimlevelzero; ?>"><?php echo $dimlevelzero; ?>%</option>
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
							<input type="hidden" id="DevOnIdDim<?php echo $Devap; ?>" value="<?php echo $DevOnId; ?>" />
							<input type="hidden" id="DevUpdateDim<?php echo $Devap; ?>" value="updatedim" />
							<input type="hidden" id="DevtabDim<?php echo $Devap; ?>" value="<?php echo $DevTab; ?>" />
						</select>
					</form>
                 -->
				</div>
				<?php		
			};													
		?> </div> <?php
	};	
	unset($SupportsAbsoluteDimLvl1);		
};
function device_load_first($tabpage) {
	include(dirname(__FILE__)."/../settings/load_settings.php");
	 //Start loading devices.
				$idev=0;
				$CountDevs_new = $CountDevs - 1;
				while($idev<=$CountDevs_new) {
					$DevEn = "Dev".$idev."en";
					$Devid = 'DevSwitch'.$idev.'Id';
					$DevNameOn = "Dev".$idev."nameOn";
					$Devap = "Dev".$idev."ap";
					$DevOnId = 'DevSwitch'.$idev.'Id';
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
							?><div id="device<?php echo $$Devap; ?>" class="ui-tabs ui-widget ui-widget-content ui-corner-all tester">	<?php
								device_load($$Devap, $$Devid, $$DevOnId, $$DevOnScenarioDriven, $$DevOffScenarioDriven, $$DevEn, $$DevNameOn, $$Devtab, $$DevName, $$DevOnScheduleDriven, $$DevOffScheduleDriven, $$DevOnSemiAuto, $$DevOffSemiAuto, $$DevOnScheduleAndRuleDriven, $$DevOffScheduleAndRuleDriven, $$DevPicSizeWidth, $$DevPicSizeHeight, $$DevCurrentState, $$SupportsAbsoluteDimLvl, $$CurrentDimLevel, $$DevModeType);																										
					?>
					</div>
                <div style="height:3px;">
                
                </div>
					<?php
					};
										
					$idev++;
				};					
}