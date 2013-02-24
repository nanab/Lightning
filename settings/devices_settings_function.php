<!-- V2.0 Copyright Nanab nanab666@gmail.com. -->
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<?php
		@$Devap = $_GET["Devap"];
		@$Devid = $_GET["Devid"];
		@$Devx = $_GET["Devx"];
		@$Devy = $_GET["Devy"];
		@$DevOnScenarioDriven = $_GET["DevOnScenarioDriven"];
		@$DevOffScenarioDriven = $_GET["DevOffScenarioDriven"];
		@$Deven = $_GET["Deven"];
		@$Devnameon = $_GET["DevnameOn"];
		@$Devtab = $_GET["Devtab"];
		@$DevName = $_GET["DevName"];
		@$DevOnScheduleDriven = $_GET["DevOnScheduleDriven"];
		@$DevOffScheduleDriven = $_GET["DevOffScheduleDriven"];
		@$DevOnSemiAuto = $_GET["DevOnSemiAuto"];
		@$DevOffSemiAuto = $_GET["DevOffSemiAuto"];
		@$DevOnScheduleAndRuleDriven = $_GET["DevOnScheduleAndRuleDriven"];
		@$DevOffScheduleAndRuleDriven = $_GET["DevOffScheduleAndRuleDriven"];
		@$DevPicSizeWidth = $_GET["DevPicSizeWidth"];
		@$DevPicSizeHeight = $_GET["DevPicSizeHeight"];
		if (@$_GET["func"] == "device_settings") {
    		device_settings($Devap, $Devid, $Devx, $Devy, $DevOnScenarioDriven, $DevOffScenarioDriven, $Deven, $Devnameon, $Devtab, $DevName, $DevOnScheduleDriven, $DevOffScheduleDriven, $DevOnSemiAuto, $DevOffSemiAuto, $DevOnScheduleAndRuleDriven, $DevOffScheduleAndRuleDriven, $DevPicSizeWidth, $DevPicSizeHeight);
    	die();
		}
		
		function device_settings($Devap, $Devid, $Devx, $Devy, $DevOnScenarioDriven, $DevOffScenarioDriven, $Deven, $Devnameon, $Devtab, $DevName, $DevOnScheduleDriven, $DevOffScheduleDriven, $DevOnSemiAuto, $DevOffSemiAuto, $DevOnScheduleAndRuleDriven, $DevOffScheduleAndRuleDriven, $DevPicSizeWidth, $DevPicSizeHeight){
        	include(dirname(__FILE__)."/load_settings.php");
			
			//Load language vars
			$DevLang = $XmlLang->settings->devices->name;
			$DevIdLang = $XmlLang->settings->devices->id;
			$DevXLang = $XmlLang->settings->devices->x;
			$DevYLang = $XmlLang->settings->devices->y;
			$DevOnScenarioDrivenLang = $XmlLang->settings->devices->onscenariodriven;
			$DevOffScenarioDrivenLang = $XmlLang->settings->devices->offscenariodriven;
			$DevOnScheduleDrivenLang = $XmlLang->settings->devices->onscheduledriven;
			$DevOffScheduleDrivenLang = $XmlLang->settings->devices->offscheduledriven;
			$DevOnSemiAutoLang = $XmlLang->settings->devices->onsemiauto;
			$DevOffSemiAutoLang = $XmlLang->settings->devices->offsemiauto;
			$DevOnScheduleAndRuleDrivenLang = $XmlLang->settings->devices->onscheduleandruledriven;
			$DevOffScheduleAndRuleDrivenLang = $XmlLang->settings->devices->offscheduleandruledriven;
			$DevEnLang = $XmlLang->settings->devices->en;
			$DevTabLang = $XmlLang->settings->devices->tab;
			$DevShNameLang = $XmlLang->settings->devices->shname;
			$SavedLang = $XmlLang->settings->main->saved;
			$BackButtonLang = $XmlLang->settings->main->backbutton;
 			$SavebuttonLang = $XmlLang->settings->main->savebutton;
			$DevPicSizeWidthLang = $XmlLang->settings->devices->picsizewidth;
			$DevPicSizeHeightLang = $XmlLang->settings->devices->picsizeheight;
			?>            
			<style type="text/css">
				#contentdev2 {
					width:500px;	
					-moz-border-radius: 10px;
					-webkit-border-radius: 10px;
					border-radius: 10px;
					border-color: solid 10px rgba(0,0,0,0.2); /*Very transparent black*/
				}
				.borderdev2 {
					width:99,5%;
					border:1px solid #CCC;
					border-radius:10px;
					background-color: rgba(255, 255, 255, 0.5);
				}
				.PageBack { 				
					cursor:pointer;				
				}
				#savebutton { 				
					cursor:pointer;				
				}
			</style>
            <script>			
				$(".PageBack").button().on("click", function(){
					location.reload();
				});
				$("#savebutton").button().on("click", function(){
					$('form#devices_settings').submit();
				});
			</script>
		</head>
		<body>
			<div id="contentdev2">
				<div class="borderdev2">
					<center>
						<div id="PageBack" class="PageBack"><-- <?php echo $BackButtonLang; ?></div>
					</center>			
                </div>
            </div>  
			<div id="contentdev2">
				<form id="devices_settings" class="submitdev" name="devices_settings" method="post" action="/settings/devices_settings_function.php?Send">
  					<div class="borderdev2">
    					<div style="height:53px;">
    						<div style="display:inline-block;">
        					</div>
    						<div style="display:inline-block;">
        						<?php echo $DevLang . "&nbsp;" . $Devap . "&nbsp;" .$DevName; ?><br>
   		  						<label for="title"><?php echo $DevIdLang; ?></label><br>
      						<input name="id" type="text" id="id" value="<?php echo $Devid?>" size="20" />
    						</div>
        					<div style="display:inline-block;">
        					</div>
        					<div style="display:inline-block;">
      						
    						</div>
  						</div>
                   	<div style="height:53px;">
    					<div style="display:inline-block;">
        				</div>
    					<div style="display:inline-block;"><br>
      						<label for="ip"><?php echo $DevXLang; ?></label><br />
      						<input name="x" type="text" id="x" value="<?php echo $Devx ?>" size="20" />
    					</div>
        				<div style="display:inline-block; width:93px;">
        				</div>
        				<div style="display:inline-block;">
                        	<label for="port"><?php echo $DevYLang; ?></label><br />
      						<input name="y" type="text" id="y" value="<?php echo $Devy ?>" size="20" />
    					</div>
  					</div>    
  					<div style="height:53px;">
    					<div style="display:inline-block;">
        				</div>
    					<div style="display:inline-block;"><br>
      						<label for="user"><?php echo $DevOnScenarioDrivenLang; ?></label><br />
                            <?php
                    		echo "<select name='OnScenarioDriven' id='OnScenarioDriven'>";
							echo "<option value='$DevOnScenarioDriven'>$DevOnScenarioDriven</option>";
							$files = array_map("htmlspecialchars", scandir(dirname(__FILE__)."/../images/"));
							foreach ($files as $file)
							if ($file == "."){
							}else if ($file == ".."){
							}else if ($file == $DevOnScenarioDriven){
							}else{
    						echo "<option value='$file'>$file</option>";
							}
							echo "</select>";
							?>
    					</div>
        				<div style="display:inline-block; width:35px;">
        				</div>
        				<div style="display:inline-block;">
                        <label for="pass"><?php echo $DevOffScenarioDrivenLang; ?></label><br />
                            <?php
                    		echo "<select name='OffScenarioDriven' id='OffScenarioDriven'>";
							echo "<option value='$DevOffScenarioDriven'>$DevOffScenarioDriven</option>";
							$files = array_map("htmlspecialchars", scandir(dirname(__FILE__)."/../images/"));
							foreach ($files as $file)
							if ($file == "."){
							}else if ($file == ".."){
							}else if ($file == $DevOffScenarioDriven){
							}else{
    						echo "<option value='$file'>$file</option>";
							}
							echo "</select>";
							?>      						
    					</div>
  					</div>
                    <div style="height:53px;">
    					<div style="display:inline-block;">
        				</div>
    					<div style="display:inline-block;"><br>
      						<label for="user"><?php echo $DevOnScheduleDrivenLang; ?></label><br />
                            <?php
                    		echo "<select name='OnScheduleDriven' id='OnScheduleDriven'>";
							echo "<option value='$DevOnScheduleDriven'>$DevOnScheduleDriven</option>";
							$files = array_map("htmlspecialchars", scandir(dirname(__FILE__)."/../images/"));
							foreach ($files as $file)
							if ($file == "."){
							}else if ($file == ".."){
							}else if ($file == $DevOnScheduleDriven){
							}else{
    						echo "<option value='$file'>$file</option>";
							}
							echo "</select>";
							?>
    					</div>
        				<div style="display:inline-block; width:35px;">
        				</div>
        				<div style="display:inline-block;">
                        <label for="pass"><?php echo $DevOffScheduleDrivenLang; ?></label><br />
                            <?php
                    		echo "<select name='OffScheduleDriven' id='OffScheduleDriven'>";
							echo "<option value='$DevOffScheduleDriven'>$DevOffScheduleDriven</option>";
							$files = array_map("htmlspecialchars", scandir(dirname(__FILE__)."/../images/"));
							foreach ($files as $file)
							if ($file == "."){
							}else if ($file == ".."){
							}else if ($file == $DevOffScheduleDriven){
							}else{
    						echo "<option value='$file'>$file</option>";
							}
							echo "</select>";
							?>      						
    					</div>
  					</div>    
                    <div style="height:53px;">
    					<div style="display:inline-block;">
        				</div>
    					<div style="display:inline-block;"><br>
      						<label for="user"><?php echo $DevOnSemiAutoLang; ?></label><br />
                            <?php
                    		echo "<select name='OnSemiAuto' id='OnSemiAuto'>";
							echo "<option value='$DevOnSemiAuto'>$DevOnSemiAuto</option>";
							$files = array_map("htmlspecialchars", scandir(dirname(__FILE__)."/../images/"));
							foreach ($files as $file)
							if ($file == "."){
							}else if ($file == ".."){
							}else if ($file == $DevOnSemiAuto){
							}else{
								echo "<option value='$file'>$file</option>";
							}
							echo "</select>";
							?>
    					</div>
        				<div style="display:inline-block; width:35px;">
        				</div>
        				<div style="display:inline-block;">
                        <label for="pass"><?php echo $DevOffSemiAutoLang; ?></label><br />
                            <?php
                    		echo "<select name='OffSemiAuto' id='OffSemiAuto'>";
							echo "<option value='$DevOffSemiAuto'>$DevOffSemiAuto</option>";
							$files = array_map("htmlspecialchars", scandir(dirname(__FILE__)."/../images/"));
							foreach ($files as $file)
							if ($file == "."){
							}else if ($file == ".."){
							}else if ($file == $DevOffSemiAuto){
							}else{
    						echo "<option value='$file'>$file</option>";
							}
							echo "</select>";
							?>      						
    					</div>
  					</div>    
                    <div style="height:53px;">
    					<div style="display:inline-block;">
        				</div>
    					<div style="display:inline-block;"><br>
      						<label for="user"><?php echo $DevOnScheduleAndRuleDrivenLang; ?></label><br />
                            <?php
                    		echo "<select name='OnScheduleAndRuleDriven' id='OnScheduleAndRuleDriven'>";
							echo "<option value='$DevOnScheduleAndRuleDriven'>$DevOnScheduleAndRuleDriven</option>";
							$files = array_map("htmlspecialchars", scandir(dirname(__FILE__)."/../images/"));
							foreach ($files as $file)
							if ($file == "."){
							}else if ($file == ".."){
							}else if ($file == $DevOnScheduleAndRuleDriven){
							}else{
    						echo "<option value='$file'>$file</option>";
							}
							echo "</select>";
							?>
    					</div>
        				<div style="display:inline-block;">
        				</div>
        				<div style="display:inline-block;">
                        <label for="pass"><?php echo $DevOffScheduleAndRuleDrivenLang; ?></label><br />
                            <?php
                    		echo "<select name='OffScheduleAndRuleDriven' id='OffScheduleAndRuleDriven'>";
							echo "<option value='$DevOffScheduleAndRuleDriven'>$DevOffScheduleAndRuleDriven</option>";
							$files = array_map("htmlspecialchars", scandir(dirname(__FILE__)."/../images/"));
							foreach ($files as $file)
							if ($file == "."){
							}else if ($file == ".."){
							}else if ($file == $DevOffScheduleAndRuleDriven){
							}else{
    						echo "<option value='$file'>$file</option>";
							}
							echo "</select>";
							?>      						
    					</div>
  					</div>
                    <div style="height:53px;">
    					<div style="display:inline-block;">
        				</div>
    					<div style="display:inline-block;"><br>
      						<label for="picsizewidth"><?php echo $DevPicSizeWidthLang; ?></label><br />
      						<input name="picsizewidth" type="text" id="picsizewidth" value="<?php echo $DevPicSizeWidth ?>" size="20" />
    					</div>
        				<div style="display:inline-block; width:93px;">
       					</div>
        				<div style="display:inline-block;"> 
                        <label for="picsizeheight"><?php echo $DevPicSizeHeightLang; ?></label><br />
      						<input name="picsizeheight" type="text" id="picsizeheight" value="<?php echo $DevPicSizeHeight ?>" size="20" />     						
    					</div>
  					</div>             
                    <div style="height:53px;">
    					<div style="display:inline-block;">
        				</div>
    					<div style="display:inline-block;"><br>
      						<label for="tab"><?php echo $DevTabLang; ?></label><br />
      						<input name="itab" type="text" id="itab" value="<?php echo $Devtab ?>" size="20" />
    					</div>
        				<div style="display:inline-block;">
       					</div>
        				<div style="display:inline-block;">      						
    					</div>
  					</div>       
  					<div style="height:60px;">
    					<div style="display:inline-block;">
        				</div>
    					<div style="display:inline-block;"><br>      
      						<label for="t"><?php echo $DevEnLang; ?></label><br />
      						<?php if($Deven == "true"){ ?>	  
      							<input type="checkbox" name="en" value="yes" checked>
      						<?php }else{ ?>
      							<input type="checkbox" name="en" value="yes">
      						<?php }; ?>
    					</div>
        				<div style="display:inline-block; width:183px;">
        				</div>
        				<div style="display:inline-block;">
    						<label for="t2"><?php echo $DevShNameLang; ?></label><br />
      						<?php if($Devnameon == "true"){ ?>	  
      							<input type="checkbox" name="nameon" value="yes" checked>
      						<?php }else{ ?>
      							<input type="checkbox" name="nameon" value="yes">
      						<?php }; ?>
    					</div>
  					</div>
    			</div>
    			<div id="savebutton" class="borderdev2 savebutton">
					<center>
						<div style="display:inline-block;">
							<input type="hidden" name="ap" id="ap" value="<?php echo $Devap; ?>" />                       
							<?php echo $SavebuttonLang; ?>                       
						</div>
						<div style="display:inline-block;">
						</div>
						<div id="savetabs" class="savetabs"style="display:inline-block;">
						</div>
                    </center>
				</div>      
  			</form>
		</div>	
	</body>
	<?php }; ?>
	<?php if(isset($_GET['Send'])) {
		//Load XML and set some config	
		$xmldevicesSettings = new DOMDocument('1.0', 'utf-8');
		$xmldevicesSettings->formatOutput = true;
		$xmldevicesSettings->preserveWhiteSpace = false;
		$xmldevicesSettings->load('settings.xml');
		$ap_new = $_POST['ap'];
		$id_new = $_POST['id'];
		@$en_new = $_POST['en'];
		$x_new = $_POST['x'];
		$y_new = $_POST['y'];
		$iOnScenarioDriven_new = $_POST['OnScenarioDriven'];
		$iOffScenarioDriven_new = $_POST['OffScenarioDriven'];
		$iOnScheduleDriven_new = $_POST['OnScheduleDriven'];
		$iOffScheduleDriven_new = $_POST['OffScheduleDriven'];
		$iOnSemiAuto_new = $_POST['OnSemiAuto'];
		$iOffSemiAuto_new = $_POST['OffSemiAuto'];
		$iOnScheduleAndRuleDriven_new = $_POST['OnScheduleAndRuleDriven'];
		$iOffScheduleAndRuleDriven_new = $_POST['OffScheduleAndRuleDriven'];
		$iPicSizeWidth_new = $_POST['picsizewidth'];
		$iPicSizeHeight_new = $_POST['picsizeheight'];
		$itab_new = $_POST['itab'];
		@$nameon_new = $_POST['nameon'];
		if ($en_new == ""){
			$en_new = "false";
		}else{
			$en_new = "true";
		};
		if ($nameon_new == ""){
			$nameon_new = "false";
		}else{
			$nameon_new = "true";
		};	
		//Get item Element
		$devices =  $xmldevicesSettings->getElementsByTagName('devices')->item(0);
		$devices1 = $devices->getElementsByTagName('dev'.$ap_new)->item(0);
		//Load child elements
		$id_orginal = $devices1->getElementsByTagName('id')->item(0);
		$en_orginal = $devices1->getElementsByTagName('en')->item(0);
		$x_orginal = $devices1->getElementsByTagName('x')->item(0);
		$y_orginal = $devices1->getElementsByTagName('y')->item(0);
		$iOnScenarioDriven_orginal = $devices1->getElementsByTagName('onscenariodriven')->item(0);
		$iOffScenarioDriven_orginal = $devices1->getElementsByTagName('offscenariodriven')->item(0);
		$iOnScheduleDriven_orginal = $devices1->getElementsByTagName('onscheduledriven')->item(0);
		$iOffScheduleDriven_orginal = $devices1->getElementsByTagName('offscheduledriven')->item(0);
		$iOnSemiAuto_orginal = $devices1->getElementsByTagName('onsemiauto')->item(0);
		$iOffSemiAuto_orginal = $devices1->getElementsByTagName('offsemiauto')->item(0);
		$iOnScheduleAndRuleDriven_orginal = $devices1->getElementsByTagName('onscheduleandruledriven')->item(0);
		$iOffScheduleAndRuleDriven_orginal = $devices1->getElementsByTagName('offscheduleandruledriven')->item(0);
		$iPicSizeWidth_orginal = $devices1->getElementsByTagName('picsizewidth')->item(0);
		$iPicSizeHeight_orginal = $devices1->getElementsByTagName('picsizeheight')->item(0);
		$nameon_orginal = $devices1->getElementsByTagName('nameon')->item(0);
		$itab_orginal = $devices1->getElementsByTagName('tab')->item(0);
		//Change values
		$id_orginal->nodeValue = $id_new;
		$en_orginal->nodeValue = $en_new;
		$x_orginal->nodeValue = $x_new;
		$y_orginal->nodeValue = $y_new;
		$iOnScenarioDriven_orginal->nodeValue = $iOnScenarioDriven_new;
		$iOffScenarioDriven_orginal->nodeValue = $iOffScenarioDriven_new;
		$iOnScheduleDriven_orginal->nodeValue = $iOnScheduleDriven_new;
		$iOffScheduleDriven_orginal->nodeValue = $iOffScheduleDriven_new;
		$iOnSemiAuto_orginal->nodeValue = $iOnSemiAuto_new;
		$iOffSemiAuto_orginal->nodeValue = $iOffSemiAuto_new;
		$iOnScheduleAndRuleDriven_orginal->nodeValue = $iOnScheduleAndRuleDriven_new;
		$iOffScheduleAndRuleDriven_orginal->nodeValue = $iOffScheduleAndRuleDriven_new;
		$iPicSizeWidth_orginal->nodeValue = $iPicSizeWidth_new;
		$iPicSizeHeight_orginal->nodeValue = $iPicSizeHeight_new;
		$nameon_orginal->nodeValue = $nameon_new;
		$itab_orginal->nodeValue = $itab_new;
		//Replace old elements with new				
			$xmldevicesSettings->save("settings.xml");
			?>
			<script language="JavaScript" type="text/JavaScript">
			<!--
				window.location.href = "devices_settings.php";
			//-->
			</script>	  
		<?php
	};
	if(isset($_GET['Send3'])) {
		$root = realpath($_SERVER["DOCUMENT_ROOT"]);
		$xmlload = simplexml_load_file("$root/settings/settings.xml");	
		$DevNumbersOriginal = $xmlload->devices->numberofdevices;
		$xmldevicesAdd = new DOMDocument('1.0', 'utf-8');
		$xmldevicesAdd->formatOutput = true;
		$xmldevicesAdd->preserveWhiteSpace = false;
		$xmldevicesAdd->load('settings.xml');	
		//Get item Element
		$DevicesSum =  $xmldevicesAdd->getElementsByTagName('devices')->item(0);
		$NumofdevOriginal = $DevicesSum->getElementsByTagName('numberofdevices')->item(0);
		$Numofdevnew = $DevNumbersOriginal + 1; 
		$newItem = $xmldevicesAdd->createElement('dev'.$Numofdevnew);
		$newItem->appendChild($xmldevicesAdd->createElement('ap', $Numofdevnew));
		$newItem->appendChild($xmldevicesAdd->createElement('en', 'false'));
		$newItem->appendChild($xmldevicesAdd->createElement('id', '1'));
		$newItem->appendChild($xmldevicesAdd->createElement('x', '50'));
		$newItem->appendChild($xmldevicesAdd->createElement('y', '50'));
		$newItem->appendChild($xmldevicesAdd->createElement('on', 'LampOn.png'));
		$newItem->appendChild($xmldevicesAdd->createElement('off', 'LampOff.png'));
		$newItem->appendChild($xmldevicesAdd->createElement('nameon', 'true'));
		//Load child elements
		$xmldevicesAdd->getElementsByTagName('devices')->item(0)->appendChild($newItem);
		//Replace old elements with new
		$NumofdevOriginal->nodeValue = $Numofdevnew;
		?>
		<script>
			alert ('<?php echo 'Wrote: ' . $xmldevicesAdd->save("settings.xml") . ' bytes! New device whit number' . $Numofdevnew . ' added!'; ?>');
		</script>
		<script language="JavaScript" type="text/JavaScript">
			<!--
				window.location.href = "devices_settings.php";
			//-->
		</script>
		<?php			  
	};
	if(@$_POST['send4'] == "send4") {
		//Load XML and set some config	
		$xmldevicesSettings = new DOMDocument('1.0', 'utf-8');
		$xmldevicesSettings->formatOutput = true;
		$xmldevicesSettings->preserveWhiteSpace = false;
		$xmldevicesSettings->load('settings.xml');
		@$ap_new = $_POST['Devap'];
		@$en_new = $_POST['Deven'];
		//Get item Element
		$devices =  $xmldevicesSettings->getElementsByTagName('devices')->item(0);
		$devices1 = $devices->getElementsByTagName('dev'.$ap_new)->item(0);
		//Load child elements
		$en_orginal = $devices1->getElementsByTagName('en')->item(0);
		//Change values
		$en_orginal->nodeValue = $en_new;
		//Replace old elements with new
		$xmldevicesSettings->save("settings.xml");
		echo "success";	
	};
	?>
</html>