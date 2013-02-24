<!-- V2.0 Copyright Nanab nanab666@gmail.com. -->
<?php
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
@$TabPage = $_GET["TabPage"];	
include(dirname(__FILE__)."/../settings/load_settings.php");
$Xmlread = simplexml_load_file("http://$User:$Pass@$Ip:$Port/$funcdev/$DevOnId");
$DevModeType = $Xmlread->ModeType;
$DevCurrentState = $Xmlread->CurrentStateID;
if (@$_GET["func"] == "device_load") {			
    device_load($Devap, $Devid, $DevOnId,$DevOnScenarioDriven, $DevOffScenarioDriven, $DevEn, $DevNameOn, $DevTab, $DevName, $DevOnScheduleDriven, $DevOffScheduleDriven, $DevOnSemiAuto, $DevOffSemiAuto, $DevOnScheduleAndRuleDriven, $DevOffScheduleAndRuleDriven, $DevPicSizeWidth, $DevPicSizeHeight, $DevCurrentState, $SupportsAbsoluteDimLvl, $CurrentDimLevel, $DevModeType, $TabPage);
    die();
};		
function device_load($Devap, $Devid, $DevOnId, $DevOnScenarioDriven, $DevOffScenarioDriven, $DevEn, $DevNameOn, $DevTab, $DevName, $DevOnScheduleDriven, $DevOffScheduleDriven, $DevOnSemiAuto, $DevOffSemiAuto, $DevOnScheduleAndRuleDriven, $DevOffScheduleAndRuleDriven, $DevPicSizeWidth, $DevPicSizeHeight, $DevCurrentState, $SupportsAbsoluteDimLvl, $CurrentDimLevel, $DevModeType, $TabPage){		
	include(dirname(__FILE__)."/../settings/load_settings.php");
	if ($DevEn == "true"){
		if ($DevTab == $TabPage){                         		
			if($DevNameOn == 'true'){
				?>
				<div id="divname" style="display:inline-block;">
                    &nbsp;
                    <div style="display:inline-block;">
                        <center>
							<?php echo $DevName . "&nbsp;&nbsp;"; ?>
                        </center>
                    </div>
				</div>
			<?php };	
			if($DevCurrentState == "2") { ?>					
				<center>
					<form method="post" action="" STYLE="margin:0; padding:0;">
                        <input type="hidden" id="DevUpdate<?php echo $Devap; ?>" value="updateon" />
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
                        <input type="hidden" id="DevCurrentState<?php echo $Devap; ?>" value="<?php echo $DevCurrentState; ?>" />
						<input type="hidden" id="SupportsAbsoluteDimLvl<?php echo $Devap; ?>" value="<?php echo $SupportsAbsoluteDimLvl; ?>" />
						<input type="hidden" id="CurrentDimLevel<?php echo $Devap; ?>" value="<?php echo $CurrentDimLevel; ?>" />
                        <input type="hidden" id="DevModeType<?php echo $Devap; ?>" value="<?php echo $DevModeType; ?>" />                                           
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
						}; ?>
					</form>
				</center>
				<?php 
			}else{ 
				?>        
				<center>
					<form method="post" action="" STYLE="margin:0; padding:0;">
						<input type="hidden" id="DevUpdate<?php echo $Devap; ?>" value="updateoff" />
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
                        <input type="hidden" id="DevCurrentState<?php echo $Devap; ?>" value="<?php echo $DevCurrentState; ?>" />
						<input type="hidden" id="SupportsAbsoluteDimLvl<?php echo $Devap; ?>" value="<?php echo $SupportsAbsoluteDimLvl; ?>" />
						<input type="hidden" id="CurrentDimLevel<?php echo $Devap; ?>" value="<?php echo $CurrentDimLevel; ?>" />
                        <input type="hidden" id="DevModeType<?php echo $Devap; ?>" value="<?php echo $DevModeType; ?>" />
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
				</center>
				<?php		
			};
			if($SupportsAbsoluteDimLvl == 'true') {
				if (($CurrentDimLevel == '-1') && ($DevCurrentState == "2")){
					$dimlevelzero = '100';
				}elseif(($CurrentDimLevel == '-1') && ($DevCurrentState == "1")){
					$dimlevelzero = '0';
				}else{
					$dimlevelzero = $CurrentDimLevel;
				};
				?>
				<center>
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
				</center>
				<?php		
			};													
		}; 
	};			
};