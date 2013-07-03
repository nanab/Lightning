<!-- V2.0 Copyright Nanab nanab666@gmail.com. -->
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<?php
		include(dirname(__FILE__)."/load_settings.php");
		include(dirname(__FILE__)."/load_switch.php");
		//Load language vars
 		$EnabledLang = $XmlLang->settings->scenarios->enabled;
		$DisabledLang = $XmlLang->settings->scenarios->disabled;
 		$XLang = $XmlLang->settings->scenarios->posx;
 		$YLang = $XmlLang->settings->scenarios->posy;
 		$BackLang = $XmlLang->settings->scenarios->backcolor;
 		$FontLang = $XmlLang->settings->scenarios->fontsize;
		$HideableLang = $XmlLang->settings->scenarios->hideable;
		$SaveButtonLang = $XmlLang->settings->main->savebutton;
		?>
		<script src="<?php echo $Jquery; ?>"></script>
		<script src="<?php echo $JqueryCustom; ?>"></script> 
		<link rel="stylesheet" href="<?php echo $JqueryCustomCss; ?>" /> 
		<style type="text/css">
			#contentsc {
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
				.savebuttonscenarios { 				
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
				<?php if($SCEn == "true"){ ?>
				var enabledval = "false";
				<?php }else{ ?>
				var enabledval = "true";	
				<?php } ?>
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
				$(".savebuttonscenarios").button().on("click", function(){
					$('form#scenarios_settings').submit();
				});
			});
		</script>
	</head>
	<body>
		<div id="contentsc">
			<form id="scenarios_settings" name="scenarios_settings" method="post" action="/settings/scenarios_settings.php?Send">
  				<div class="borderdiv">
                    <center>
						<?php if($SCEn == "true"){ ?>	
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
      						<input name="x" type="text" id="x" value="<?php echo $SCX ?>" size="20" />
    					</div>
    					<div style="display:inline-block;">
        				</div>
        				<div style="display:inline-block;">
      						<label for="y"><?php echo $YLang; ?></label><br />
      						<input name="y" type="text" id="y" value="<?php echo $SCY?>" size="20" />
    					</div>
  					</div>
  					<div style="height:53px;">
  						<div style="display:inline-block;">
        				</div>
    					<div style="display:inline-block;">
      						<label for="bc"><?php echo $BackLang; ?></label><br />
      						<input name="bc" type="text" id="bc" value="<?php echo $SCBackColor ?>" size="20" />
   						</div>
   						<div style="display:inline-block;">
        				</div>
        				<div style="display:inline-block;">
    						<label for="font"><?php echo $FontLang; ?></label><br />
      						<input name="font" type="text" id="font" value="<?php echo $SCFontSize ?>" size="20" />
    					</div>
  					</div>
                    <div style="height:53px;">
  						<div style="display:inline-block;">
        				</div>
    					<div style="display:inline-block;">
      						<label for="hideable"><?php echo $HideableLang; ?></label><br />
        					<?php if($SCHideable == "true"){ ?>	  
      							<input type="checkbox" name="hideable" value="yes" checked>
      						<?php }else{ ?>
      							<input type="checkbox" name="hideable" value="yes">      
      						<?php }; ?>
   						</div>
   						<div style="display:inline-block;">
        				</div>
        				<div style="display:inline-block;">    						
    					</div>
  					</div>
    			</div>
  				<div class="borderdiv" id="save">
                    <center>
                        <div class="savebuttonscenarios"><?php echo $SaveButtonLang; ?></div>
                    </center>			
                </div>   
            </form>
        </div>
		<?php if(isset($_GET['Send'])) {
			//Load XML and set some config
			$xmlSCSettings = new DOMDocument('1.0', 'utf-8');
			$xmlSCSettings->formatOutput = true;
			$xmlSCSettings->preserveWhiteSpace = false;
			$xmlSCSettings->load('settings.xml');
			@$en_new = $_POST['enabled'];
			$x_new = $_POST['x'];
			$y_new = $_POST['y'];
			$bc_new = $_POST['bc'];
			$font_new = $_POST['font'];
			@$hideable_new = $_POST['hideable'];
			if ($hideable_new == ""){
				$hideable_new = "false";
			}else{
				$hideable_new = "true";
			};
			//Get item Element
			$sc =  $xmlSCSettings->getElementsByTagName('scenarios')->item(0);
			//Load child elements
			$en_orginal = $sc->getElementsByTagName('en')->item(0);
			$x_orginal = $sc->getElementsByTagName('x')->item(0);
			$y_orginal = $sc->getElementsByTagName('y')->item(0);
			$bc_orginal = $sc->getElementsByTagName('backcolor')->item(0);
			$font_orginal = $sc->getElementsByTagName('fontsize')->item(0);
			$hideable_orginal = $sc->getElementsByTagName('hideable')->item(0);
			//Change values
			$en_orginal->nodeValue = $en_new;
			$x_orginal->nodeValue = $x_new;
			$y_orginal->nodeValue = $y_new;
			$bc_orginal->nodeValue = $bc_new;
			$font_orginal->nodeValue = $font_new;
			$hideable_orginal->nodeValue = $hideable_new;
			//Replace old elements with new
			$xmlSCSettings->save("settings.xml");
			?>
			<script language="JavaScript" type="text/JavaScript">
				<!--
					window.location.href = "scenarios_settings.php";
				//-->
			</script>
		<?php
		}
		?>
	</body>
</html>