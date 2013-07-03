<!-- V2.0 Copyright Nanab nanab666@gmail.com. -->
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<?php
		include(dirname(__FILE__)."/load_settings.php");
		include(dirname(__FILE__)."/load_switch.php");
		//Load language vars
 		$EnabledLang = $XmlLang->settings->devicegroups->enabled;
		$DisabledLang = $XmlLang->settings->devicegroups->disabled;
 		$XLang = $XmlLang->settings->devicegroups->posx;
 		$YLang = $XmlLang->settings->devicegroups->posy;
		$SaveButtonLang = $XmlLang->settings->main->savebutton;
		?>
		<script src="<?php echo $Jquery; ?>"></script>
		<script src="<?php echo $JqueryCustom; ?>"></script> 
		<link rel="stylesheet" href="<?php echo $JqueryCustomCss; ?>" /> 
		<style type="text/css">
			#contentdg {
				width:500px;	
				-moz-border-radius: 10px;
				-webkit-border-radius: 10px;
				border-radius: 10px;
				border-color: solid 10px rgba(0,0,0,0.2); /*Very transparent black*/
			}
			.borderdiv {
				width:99,5%;
				border:1px solid #CCC;
				border-radius:10px;
				background-color: rgba(255, 255, 255, 0.5);
			}
				#save { 				
					cursor:pointer;				
				}
				.savebuttondevicegroups { 				
					cursor:pointer;				
				}
			#disabled { 
				color:red; 
			}	
		</style>
        <script>
			$(document).ready(function() {
				var enabled = "<?php echo $EnabledLang; ?>";
				var disabled = "<?php echo $DisabledLang; ?>";
				<?php if($DGEn == "true"){ ?>
				var enabledval = "false";
				<?php }else{ ?>
				var enabledval = "true";	
				<?php } ?>
				$(".savebuttondevicegroups").button().on("click", function(){
					$('form#devicegroups_settings').submit();
				});
				$( ".enabled").button().on("click", function(){;				
					if (enabledval == "true") {
						$(".enabled").text(enabled);
						$('.enabled').css('color','white');
					} else {
						$(".enabled").text(disabled);
						$('.enabled').css('color','red');
					}
					$("#enabled").val(enabledval);
				});
			});
		</script>
	</head>
	<body>
		<div id="contentdg">
			<form id="devicegroups_settings" name="devicegroups_settings" method="post" action="/settings/devicegroups_settings.php?Send">
  				<div class="borderdiv">
                    <center>
						<?php if($DGEn == "true"){ ?>	
                            <input type="hidden" name="enabled" id="enabled" value="true" />
                            <div class="enabled"><?php echo $EnabledLang; ?></div>
                        <?php }else{ ?>
                            <input type="hidden" name="enabled" id="enabled" value="false" />
                            <div class="enabled" id="disabled"><?php echo $DisabledLang; ?></div>
                        <?php }; ?>
                    </center>			              					    					       				       				 					 
                </div>
                <div class="borderdiv">    				                                   
  					<div style="height:53px;">
    					<div style="display:inline-block;">
        				</div>
    					<div style="display:inline-block;">
      						<label for="x"><?php echo $XLang; ?></label><br />
      						<input name="x" type="text" id="x" value="<?php echo $DGX ?>" size="20" />
    					</div>
    					<div style="display:inline-block;">
        				</div>
        				<div style="display:inline-block;">
      						<label for="y"><?php echo $YLang; ?></label><br />
      						<input name="y" type="text" id="y" value="<?php echo $DGY?>" size="20" />
    					</div>
  					</div>
    			</div>
  				<div class="borderdiv" id="save">
                    <center>
                        <div class="savebuttondevicegroups"><?php echo $SaveButtonLang; ?></div>
                    </center>			
                </div>                
            </form>
        </div>
		<?php if(isset($_GET['Send'])) {
			//Load XML and set some config
			$xmlDGSettings = new DOMDocument('1.0', 'utf-8');
			$xmlDGSettings->formatOutput = true;
			$xmlDGSettings->preserveWhiteSpace = false;
			$xmlDGSettings->load('settings.xml');
			@$en_new = $_POST['enabled'];
			$x_new = $_POST['x'];
			$y_new = $_POST['y'];
			//Get item Element
			$dg =  $xmlDGSettings->getElementsByTagName('devicegroups')->item(0);
			//Load child elements
			$en_orginal = $dg->getElementsByTagName('en')->item(0);
			$x_orginal = $dg->getElementsByTagName('x')->item(0);
			$y_orginal = $dg->getElementsByTagName('y')->item(0);			
			//Change values
			$en_orginal->nodeValue = $en_new;
			$x_orginal->nodeValue = $x_new;
			$y_orginal->nodeValue = $y_new;			
			//Replace old elements with new
			$xmlDGSettings->save("settings.xml");
			?>
            <script language="JavaScript" type="text/JavaScript">
				<!--
					window.location.href = "devicegroups_settings.php";
				//-->
			</script>			
		<?php
		}
		?>
	</body>
</html>