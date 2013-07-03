<!-- V2.0 Copyright Nanab nanab666@gmail.com. -->
<html>
	<head>
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php
        include(dirname(__FILE__)."/load_settings.php");
		include(dirname(__FILE__)."/load_switch.php");
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
					var SMAp = $("#SMAp"+Id).val();
					var SMId = $("#SMId"+Id).val();
					var SMEn = $("#SMEn"+Id).val();													
					var SMName = $("#SMName"+Id).val();						
					var SMTab = $("#SMTab"+Id).val(); 						
					var SMOn = $("#SMOn"+Id).val();												
					var SMOff = $("#SMOff"+Id).val();						
					var SMx = $("#SMx"+Id).val();						
					var SMy = $("#SMy"+Id).val();
						
					if(clicks === 1) {
						timer = setTimeout(function() {
								$('.contentdev3').hide();										
							$("#contentsmtest").load('systemmodes_settings_function.php?SMAp='+ SMAp +'&SMId='+ SMId +'&SMEn='+ SMEn +'&SMName='+ SMName +'&SMTab='+ SMTab +'&SMOn='+ SMOn +'&SMOff='+ SMOff +'&SMx='+ SMx +'&SMy='+ SMy +'&func=systemmodes_settings') 
							clicks = 0;             //after action performed, reset counter
						}, DELAY);
					} else {
						clearTimeout(timer);    //prevent single-click action
						var send4 = "send4";
						if (SMEn == "true"){
							var SMEn = "false";
						}else if (SMEn == "false"){
							var SMEn = "true";
						}
						$.ajax({
								type: "POST",
								url: "systemmodes_settings_function.php",
								data: {'SMAp': SMAp, 'SMEn': SMEn, 'send4': send4},
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
		<div id="contentsmtest">
		</div>
		<?php
        $SMSettLoad=0;
		while($SMSettLoad<=$CountSM1) {				
			$WSMAp = "SM".$SMSettLoad."Ap";
			$WSMId = "SMSwitch".$SMSettLoad."Id";
			$WSMEn = "SM".$SMSettLoad."En";
			$WSMOn = "SM".$SMSettLoad."On";
			$WSMTab = "SM".$SMSettLoad."Tab";
			$WSMOff = "SM".$SMSettLoad."Off";
			$WSMx = "SM".$SMSettLoad."x";
			$WSMy = "SM".$SMSettLoad."y";
			$WSMName = "SMSwitch".$SMSettLoad."Name";
			$WSMNameNew = str_replace(' ', '%20', $$WSMName);
			if ($SMSettLoad % 2 == 0) { 
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
				<input type="hidden" id="SMAp<?php echo $SMSettLoad; ?>" value="<?php echo $$WSMAp; ?>" />
				<input type="hidden" id="SMId<?php echo $SMSettLoad; ?>" value="<?php echo $$WSMId; ?>" />	     												
                <input type="hidden" id="SMEn<?php echo $SMSettLoad; ?>" value="<?php echo $$WSMEn; ?>" /> 						
                <input type="hidden" id="SMOn<?php echo $SMSettLoad; ?>" value="<?php echo $$WSMOn; ?>" />						
                <input type="hidden" id="SMTab<?php echo $SMSettLoad; ?>" value="<?php echo $$WSMTab; ?>" />						
                <input type="hidden" id="SMOff<?php echo $SMSettLoad; ?>" value="<?php echo $$WSMOff; ?>" />						
                <input type="hidden" id="SMx<?php echo $SMSettLoad; ?>" value="<?php echo $$WSMx; ?>" />
				<input type="hidden" id="SMy<?php echo $SMSettLoad; ?>" value="<?php echo $$WSMy; ?>" />
				<input type="hidden" id="SMName<?php echo $SMSettLoad; ?>" value="<?php echo $WSMNameNew; ?>" />				
                <input class="button" name="<?php echo $$WSMName; ?>" type="button" value="<?php echo $$WSMName; ?>" id="<?php echo $SMSettLoad; ?>"
				<?php if ($$WSMEn == "true"){
					?> style="width:250;" <?php
				}else{
					?> style="color:Red;width:250;" <?php
				}; ?>
				>				
            </div>			
            <?php
			echo $Divstop;
			echo $Br;		
			$SMSettLoad++;
		}; ?>	
	</body>
</html>