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
				var DSAp = $("#DSAp"+Id).val();													
				var DSId = $("#DSId"+Id).val();						
				var DSSizeX = $("#DSSizeX"+Id).val(); 						
				var DSSizeY = $("#DSSizeY"+Id).val();																	
				var DSEn = $("#DSEn"+Id).val();						
				var DSNameOn = $("#DSNameOn"+Id).val();						
				var DSTab = $("#DSTab"+Id).val();						
				var DSName = $("#DSName"+Id).val();						
				var DSFa = $("#DSFa"+Id).val();						
				var DSMinute = $("#DSMinute"+Id).val();										
        		if(clicks === 1) {
            		timer = setTimeout(function() {
							$('.contentds3').hide();										
						$("#contentdstest").load('datasources_settings_function.php?DSAp='+ DSAp +'&DSId='+ DSId +'&DSSizeX='+ DSSizeX +'&DSSizeY='+ DSSizeY +'&DSEn='+ DSEn +'&DSNameOn='+ DSNameOn +'&DSTab='+ DSTab +'&DSName='+ DSName +'&DSFa='+ DSFa +'&DSMinute='+ DSMinute +'&func=datasources_settings') 
                		clicks = 0;             //after action performed, reset counter
            		}, DELAY);
        		} else {
            		clearTimeout(timer);    //prevent single-click action
					var send4 = "send4";
					if (DSEn == "true"){
						var DSEn = "false";
					}else if (DSEn == "false"){
						var DSEn = "true";
					}
            		$.ajax({
							type: "POST",
							url: "datasources_settings_function.php",
							data: {'DSAp': DSAp, 'DSEn': DSEn, 'send4': send4},
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
    <div id="contentdstest">
        </div>
		<?php
        $DSSettLoad=0;
		while($DSSettLoad<=$CountDS) {				
			$WDSAp = "DS".$DSSettLoad."Ap";
			$WDSId = "DSSwitch".$DSSettLoad."Id";
			$WDSEn = "DS".$DSSettLoad."En";
			$WDSFa = "DS".$DSSettLoad."Fa";
			$WDSTab = "DS".$DSSettLoad."Tab";
			$WDSNameOn = "DS".$DSSettLoad."NameOn";
			$WDSSizeX = "DS".$DSSettLoad."SizeX";
			$WDSSizeY = "DS".$DSSettLoad."SizeY";
			$WDSName = "DSSwitch".$DSSettLoad."Name";
			$WDSMinute = "DS".$DSSettLoad."Minute";
			$WDSNameNew = str_replace(' ', '%20', $$WDSName);			
			if ($DSSettLoad % 2 == 0) { 
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
            <div id="contentds3" class="contentds3" style="display:inline-block; width:255;">					                       
                		<input type="hidden" id="DSAp<?php echo $DSSettLoad; ?>" value="<?php echo $$WDSAp; ?>" />
                    	<input type="hidden" id="DSId<?php echo $DSSettLoad; ?>" value="<?php echo $$WDSId; ?>" />	     												
                        <input type="hidden" id="DSSizeX<?php echo $DSSettLoad; ?>" value="<?php echo $$WDSSizeX; ?>" /> 						
                        <input type="hidden" id="DSSizeY<?php echo $DSSettLoad; ?>" value="<?php echo $$WDSSizeY; ?>" />						               				
                        <input type="hidden" id="DSEn<?php echo $DSSettLoad; ?>" value="<?php echo $$WDSEn; ?>" />						
                        <input type="hidden" id="DSNameOn<?php echo $DSSettLoad; ?>" value="<?php echo $$WDSNameOn; ?>" />						
                        <input type="hidden" id="DSTab<?php echo $DSSettLoad; ?>" value="<?php echo $$WDSTab; ?>" />						
                        <input type="hidden" id="DSName<?php echo $DSSettLoad; ?>" value="<?php echo $WDSNameNew; ?>" />						
                        <input type="hidden" id="DSFa<?php echo $DSSettLoad; ?>" value="<?php echo $$WDSFa; ?>" />						
                        <input type="hidden" id="DSMinute<?php echo $DSSettLoad; ?>" value="<?php echo $$WDSMinute; ?>" />
                        <input class="button" name="<?php echo $$WDSName; ?>" type="button" value="<?php echo $$WDSName; ?>" id="<?php echo $DSSettLoad; ?>"						
						<?php if ($$WDSEn == "true"){
							?> style="width:250;" <?php
						}else{
							?> style="color:Red;width:250;" <?php
						}; ?>
					>				
            </div>			
            <?php
			echo $Divstop;
			echo $Br;		 
			$DSSettLoad++;
		}; ?>	
	</body>
</html>