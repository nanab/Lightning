<!-- V2.0 Copyright Nanab nanab666@gmail.com. -->
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<?php
		@$SMAp = $_GET["SMAp"];
		@$SMId = $_GET["SMId"];
		@$SMEn = $_GET["SMEn"];
		@$SMOn = $_GET["SMOn"];
		@$SMTab = $_GET["SMTab"];
		@$SMOff = $_GET["SMOff"];
		@$SMx = $_GET["SMx"];
		@$SMy = $_GET["SMy"];
		@$SMName = $_GET["SMName"];
		if (@$_GET["func"] == "systemmodes_settings") {
    		systemmodes_settings($SMAp, $SMId, $SMEn, $SMOn, $SMTab, $SMOff, $SMx, $SMy, $SMName);
    	die();
		}		
		function systemmodes_settings($SMAp, $SMId, $SMEn, $SMOn, $SMTab, $SMOff, $SMx, $SMy, $SMName){
        	include(dirname(__FILE__)."/load_settings.php");	
			//Load language vars
			$SMLang = $XmlLang->settings->systemmodes->name;
			$SMIdLang = $XmlLang->settings->systemmodes->id;
			$SMXLang = $XmlLang->settings->systemmodes->x;
			$SMYLang = $XmlLang->settings->systemmodes->y;
			$SMPicOnLang = $XmlLang->settings->systemmodes->picon;
			$SMPicOffLang = $XmlLang->settings->systemmodes->picoff;
			$SMEnLang = $XmlLang->settings->systemmodes->en;
			$SMTabLang = $XmlLang->settings->systemmodes->tab;
			$SavedLang = $XmlLang->settings->main->saved;
 			$SavebuttonLang = $XmlLang->settings->main->savebutton;
			$BackButtonLang = $XmlLang->settings->main->backbutton;
			?> 
			<style type="text/css">
				#contentsm2 {
					width:450px;	
					-moz-border-radius: 10px;
					-webkit-border-radius: 10px;
					border-radius: 10px;
					border-color: solid 10px rgba(0,0,0,0.2); /*Very transparent black*/
				}
				.bordersm2 {
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
					$('form#systemmodes_settings').submit();
				});
			</script>
		</head>
		<body>
			<div id="contentsm2">
				<div class="bordersm2">
					<center>
						<div id="PageBack" class="PageBack"><-- <?php echo $BackButtonLang; ?></div>
					</center>			
                </div>
            </div>
			<div id="contentsm2">
				<form id="systemmodes_settings" name="systemmodes_settings" method="post" action="/settings/systemmodes_settings_function.php?Send">
        			<div class="bordersm2">
                        <div style="height:65px;">
                            <div style="display:inline-block;">
                            </div>
                            <div style="display:inline-block;">
                            <?php echo $SMLang . "&nbsp;" . $SMAp . "&nbsp;" . $SMName; ?><br>
                                <label for="title"><?php echo $SMIdLang; ?></label><br>
                                <input name="id" type="text" id="id" value="<?php echo $SMId?>" size="20" />
                            </div>
                            <div style="display:inline-block;">
                            </div>
                            <div style="display:inline-block;">      				
                            </div>
                        </div>
                        <div style="height:53px; ">
                            <div style="display:inline-block;">
                            </div>
                            <div style="display:inline-block;">
                                <label for="fa"><?php echo $SMPicOnLang; ?></label><br>
                                <?php
								echo "<select name='on' id='on'>";
								echo "<option value='$SMOn'>$SMOn</option>";
								$files = array_map("htmlspecialchars", scandir(dirname(__FILE__)."/../images/"));
								foreach ($files as $file)
								if ($file == "."){
								}else if ($file == ".."){
								}else if ($file == $SMOn){
								}else{
								echo "<option value='$file'>$file</option>";
								}
								echo "</select>";
								?>
                            </div>
                            <div style="display:inline-block;">
                            </div>
                            <div style="display:inline-block;">
                                <label for="fa"><?php echo $SMPicOffLang; ?></label><br>
                                <?php
								echo "<select name='off' id='off'>";
								echo "<option value='$SMOff'>$SMOff</option>";
								$files = array_map("htmlspecialchars", scandir(dirname(__FILE__)."/../images/"));
								foreach ($files as $file)
								if ($file == "."){
								}else if ($file == ".."){
								}else if ($file == $SMOff){
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
                            <div style="display:inline-block;">        
                                <label for="sx"><?php echo $SMXLang; ?></label><br>
                                <input name="x" type="text" id="x" value="<?php echo $SMx?>" size="20" />
                            </div>
                            <div style="display:inline-block;">
                            </div>
                            <div style="display:inline-block;">
                                <label for="sy"><?php echo $SMYLang; ?></label><br>
                                <input name="y" type="text" id="y" value="<?php echo $SMy ?>" size="20" />
                            </div>
                        </div>
                        <div style="height:53px;">
                            <div style="display:inline-block;">
                            </div>
                            <div style="display:inline-block;">      
                                <label for="tab"><?php echo $SMTabLang; ?></label><br>
                                <input name="itab" type="text" id="itab" value="<?php echo $SMTab ?>" size="20" />
                            </div>
                            <div style="display:inline-block;">
                            </div>
                            <div style="display:inline-block;">    				
                            </div>
                        </div>
                        <div style="height:53px;">
                            <div style="display:inline-block;">
                            </div>
                            <div style="display:inline-block;">      
                                <label for="t"><?php echo $SMEnLang; ?></label><br>
                                <?php if($SMEn == "true"){ ?>	  
                                    <input type="checkbox" name="en" value="yes" checked>
                                <?php }else{ ?>
                                    <input type="checkbox" name="en" value="yes">
                                <?php }; ?>
                            </div>
                            <div style="display:inline-block;">
                            </div>
                            <div style="display:inline-block;">    				
                            </div>
                        </div>
                    </div>
                    <div id="savebutton" class="bordersm2 savebutton">
						<center>
							<div style="display:inline-block;">
								<input type="hidden" name="ap" id="ap" value="<?php echo $SMAp; ?>" />                       
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
		$xmlsystemmodesSettings = new DOMDocument('1.0', 'utf-8');
		$xmlsystemmodesSettings->formatOutput = true;
		$xmlsystemmodesSettings->preserveWhiteSpace = false;
		$xmlsystemmodesSettings->load('settings.xml');
		$ap_new = $_POST['ap'];
		$id_new = $_POST['id'];
		@$en_new = $_POST['en'];
		$x_new = $_POST['x'];
		$y_new = $_POST['y'];
		$on_new = $_POST['on'];
		$itab_new = $_POST['itab'];
		$off_new = $_POST['off'];
		if ($en_new == ""){
			$en_new = "false";
		}else{
			$en_new = "true";
		};			
		//Get item Element
		$systemmodes =  $xmlsystemmodesSettings->getElementsByTagName('systemmodes')->item(0);
		$systemmodes1 = $systemmodes->getElementsByTagName('sm'.$ap_new)->item(0);
		//Load child elements
		$id_orginal = $systemmodes1->getElementsByTagName('id')->item(0);
		$x_orginal = $systemmodes1->getElementsByTagName('x')->item(0);
		$y_orginal = $systemmodes1->getElementsByTagName('y')->item(0);
		$en_orginal = $systemmodes1->getElementsByTagName('en')->item(0);
		$on_orginal = $systemmodes1->getElementsByTagName('on')->item(0);
		$off_orginal = $systemmodes1->getElementsByTagName('off')->item(0);
		$itab_orginal = $systemmodes1->getElementsByTagName('tab')->item(0);
		//Change values
		$id_orginal->nodeValue = $id_new;
		$x_orginal->nodeValue = $x_new;
		$y_orginal->nodeValue = $y_new;
		$en_orginal->nodeValue = $en_new;
		$on_orginal->nodeValue = $on_new;
		$off_orginal->nodeValue = $off_new;
		$itab_orginal->nodeValue = $itab_new;
		//Replace old elements with new
		$xmlsystemmodesSettings->save("settings.xml");
			?>
			<script language="JavaScript" type="text/JavaScript">
			<!--
				window.location.href = "systemmodes_settings.php";
			//-->
			</script>			  
		<?php
	};
	if(@$_POST['send4'] == "send4") {
		//Load XML and set some config	
		$xmlSystemmodesSettings = new DOMDocument('1.0', 'utf-8');
		$xmlSystemmodesSettings->formatOutput = true;
		$xmlSystemmodesSettings->preserveWhiteSpace = false;
		$xmlSystemmodesSettings->load('settings.xml');
		@$ap_new = $_POST['SMAp'];
		@$en_new = $_POST['SMEn'];
		//Get item Element
		$Systemmodes =  $xmlSystemmodesSettings->getElementsByTagName('systemmodes')->item(0);
		$Systemmodes1 = $Systemmodes->getElementsByTagName('sm'.$ap_new)->item(0);
		//Load child elements
		$en_orginal = $Systemmodes1->getElementsByTagName('en')->item(0);
		//Change values
		$en_orginal->nodeValue = $en_new;
		//Replace old elements with new
		$xmlSystemmodesSettings->save("settings.xml");
		echo "success";	
	};
	?>
</html>