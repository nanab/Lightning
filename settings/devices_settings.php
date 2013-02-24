<!-- V2.0 Copyright Nanab nanab666@gmail.com. -->
<html>
	<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php
        include(dirname(__FILE__)."/load_settings.php");
        ?>
        <script src="<?php echo $Jquery; ?>"></script>
		<script src="<?php echo $JqueryCustom; ?>"></script> 
		<link rel="stylesheet" href="<?php echo $JqueryCustomCss; ?>" /> 
        <style type="text/css">
		.button { 				
					cursor:pointer;				
				}
        </style>
        <script>		
			var DELAY = 250, clicks = 0, timer = null;
			$(document).ready(function() {
				$(".button").button().on("click", function(e){				
					clicks++;  //count clicks
					var element = $(this);
					var Id = element.attr("id");
					var Devap = $("#Devap"+Id).val();													
					var Devid = $("#Devid"+Id).val();						
					var Devx = $("#Devx"+Id).val(); 						
					var Devy = $("#Devy"+Id).val();												
					var DevOnScenarioDriven = $("#DevOnScenarioDriven"+Id).val();						
					var DevOffScenarioDriven = $("#DevOffScenarioDriven"+Id).val();						
					var Deven = $("#Deven"+Id).val();						
					var DevnameOn = $("#DevnameOn"+Id).val();						
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
					if(clicks === 1) {
						timer = setTimeout(function() {
								$('.contentdev3').hide();										
							$("#contentdevtest").load('devices_settings_function.php?Devap='+ Devap +'&Devid='+ Devid +'&Devx='+ Devx +'&Devy='+ Devy +'&DevOnScenarioDriven='+ DevOnScenarioDriven +'&DevOffScenarioDriven='+ DevOffScenarioDriven +'&Deven='+ Deven +'&DevnameOn='+ DevnameOn +'&Devtab='+ Devtab +'&DevName='+ DevName +'&DevOnScheduleDriven='+ DevOnScheduleDriven +'&DevOffScheduleDriven='+ DevOffScheduleDriven +'&DevOnSemiAuto='+ DevOnSemiAuto +'&DevOffSemiAuto='+ DevOffSemiAuto +'&DevOnScheduleAndRuleDriven='+ DevOnScheduleAndRuleDriven +'&DevOffScheduleAndRuleDriven='+ DevOffScheduleAndRuleDriven +'&DevPicSizeWidth='+ DevPicSizeWidth +'&DevPicSizeHeight='+ DevPicSizeHeight +'&func=device_settings') 
							clicks = 0;             //after action performed, reset counter
						}, DELAY);
					} else {
						clearTimeout(timer);    //prevent single-click action
						var send4 = "send4";
						if (Deven == "true"){
							var Deven = "false";
						}else if (Deven == "false"){
							var Deven = "true";
						}
						$.ajax({
								type: "POST",
								url: "devices_settings_function.php",
								data: {'Devap': Devap, 'Deven': Deven, 'send4': send4},
								success: function(msge){
									if(msge = 'success') {
										location.reload()
									}
								}
							});
						clicks = 0;             //after action performed, reset counter
					}
	
				})
				.on("dblclick", function(e){
					e.preventDefault();  //cancel system double-click event
				});
			});		
		</script>
	</head>
	<body>
        <div id="contentdevtest">
        </div>
		<?php
        $DevSettLoad=0;
		while($DevSettLoad<=$CountDevs1) {				
			$WDevap = "Dev".$DevSettLoad."ap";
			$WDevid = "DevSwitch".$DevSettLoad."Id";
			$WDevx = "Dev".$DevSettLoad."x";
			$WDevy = "Dev".$DevSettLoad."y";
			$WDevOnScenarioDriven = "Dev".$DevSettLoad."OnScenarioDriven";
			$WDevOffScenarioDriven = "Dev".$DevSettLoad."OffScenarioDriven";			
			$WDevOnScheduleDriven = "Dev".$DevSettLoad."OnScheduleDriven";
			$WDevOffScheduleDriven = "Dev".$DevSettLoad."OffScheduleDriven";			
			$WDevOnSemiAuto = "Dev".$DevSettLoad."OnSemiAuto";
			$WDevOffSemiAuto = "Dev".$DevSettLoad."OffSemiAuto";			
			$WDevOnScheduleAndRuleDriven = "Dev".$DevSettLoad."OnScheduleAndRuleDriven";
			$WDevOffScheduleAndRuleDriven = "Dev".$DevSettLoad."OffScheduleAndRuleDriven";
			$WDeven = "Dev".$DevSettLoad."en";
			$WDevnameOn = "Dev".$DevSettLoad."nameOn";
			$WDevtab = "Dev".$DevSettLoad."tab";
			$WDevName = "DevSwitch".$DevSettLoad."Name";
			$WDevPicSizeWidth = "Dev".$DevSettLoad."PicSizeWidth";
			$WDevPicSizeHeight = "Dev".$DevSettLoad."PicSizeHeight";
			$WDevNameNew = str_replace(' ', '%20', $$WDevName);
			if ($DevSettLoad % 2 == 0) { 
			$Div = '<div id="varannan">';
			$Divstop = "";
			$Br = "";			
			}else{			
			$Divstop = "</div>";
			$Div = "";
			$Br = "<br>";			 	
			}
			echo $Div;
			?>           
            <div id="contentdev3" class="contentdev3" style="display:inline-block; width:255;">					                       
                <input type="hidden" id="Devap<?php echo $DevSettLoad; ?>" value="<?php echo $$WDevap; ?>" />
                <input type="hidden" id="Devid<?php echo $DevSettLoad; ?>" value="<?php echo $$WDevid; ?>" />	     												
                <input type="hidden" id="Devx<?php echo $DevSettLoad; ?>" value="<?php echo $$WDevx; ?>" /> 						
                <input type="hidden" id="Devy<?php echo $DevSettLoad; ?>" value="<?php echo $$WDevy; ?>" />						
                <input type="hidden" id="DevOnScenarioDriven<?php echo $DevSettLoad; ?>" value="<?php echo $$WDevOnScenarioDriven; ?>" />						
                <input type="hidden" id="DevOffScenarioDriven<?php echo $DevSettLoad; ?>" value="<?php echo $$WDevOffScenarioDriven; ?>" />						
                <input type="hidden" id="Deven<?php echo $DevSettLoad; ?>" value="<?php echo $$WDeven; ?>" />						
                <input type="hidden" id="DevnameOn<?php echo $DevSettLoad; ?>" value="<?php echo $$WDevnameOn; ?>" />						
                <input type="hidden" id="Devtab<?php echo $DevSettLoad; ?>" value="<?php echo $$WDevtab; ?>" />						
                <input type="hidden" id="DevName<?php echo $DevSettLoad; ?>" value="<?php echo $WDevNameNew; ?>" />						
                <input type="hidden" id="DevOnScheduleDriven<?php echo $DevSettLoad; ?>" value="<?php echo $$WDevOnScheduleDriven; ?>" />						
                <input type="hidden" id="DevOffScheduleDriven<?php echo $DevSettLoad; ?>" value="<?php echo $$WDevOffScheduleDriven; ?>" />						
                <input type="hidden" id="DevOnSemiAuto<?php echo $DevSettLoad; ?>" value="<?php echo $$WDevOnSemiAuto; ?>" />						
                <input type="hidden" id="DevOffSemiAuto<?php echo $DevSettLoad; ?>" value="<?php echo $$WDevOffSemiAuto; ?>" />						
                <input type="hidden" id="DevOnScheduleAndRuleDriven<?php echo $DevSettLoad; ?>" value="<?php echo $$WDevOnScheduleAndRuleDriven; ?>" />						
                <input type="hidden" id="DevOffScheduleAndRuleDriven<?php echo $DevSettLoad; ?>" value="<?php echo $$WDevOffScheduleAndRuleDriven; ?>" />						
                <input type="hidden" id="DevPicSizeWidth<?php echo $DevSettLoad; ?>" value="<?php echo $$WDevPicSizeWidth; ?>" />						
                <input type="hidden" id="DevPicSizeHeight<?php echo $DevSettLoad; ?>" value="<?php echo $$WDevPicSizeHeight; ?>" />
                <input class="button" name="<?php echo $$WDevName; ?>" type="button" value="<?php echo $$WDevName; ?>" id="<?php echo $DevSettLoad; ?>"
				<?php 
				if ($$WDeven == "true"){
					?> 
					style="width:250;" 
					<?php
				}else{
					?> 
					style="color:Red;width:250;" 
					<?php
				}; ?>
				>				
            </div>			
            <?php
			echo $Divstop;
			echo $Br;		
			$DevSettLoad++;
		} ?>	
	</body>
</html>