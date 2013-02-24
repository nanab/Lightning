<!-- V2.0 Copyright Nanab nanab666@gmail.com. -->
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<?php
		include(dirname(__FILE__)."/load_settings.php");
		//Load language vars
 		$EnabledLang = $XmlLang->settings->weather->enabled;
		$DisabledLang = $XmlLang->settings->weather->disabled;
 		$XLang = $XmlLang->settings->weather->posx;
 		$YLang = $XmlLang->settings->weather->posy;
		$NumberOfLang = $XmlLang->settings->weather->numberof;
		$WeatherTransparentLang = $XmlLang->settings->weather->transparent;
		$WeatherIconSizeLang = $XmlLang->settings->weather->iconsize;
		$WeatherFontSizeLang = $XmlLang->settings->weather->fontsize;
		$WeatherUrlLang = $XmlLang->settings->weather->url;
		$SaveButtonLang = $XmlLang->settings->main->savebutton; 		
		?>
        <script src="<?php echo $Jquery; ?>"></script>
		<script src="<?php echo $JqueryCustom; ?>"></script> 
		<link rel="stylesheet" href="<?php echo $JqueryCustomCss; ?>" /> 
		<style type="text/css">
			#contentweather {
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
				.savebuttonweather { 				
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
				<?php if($WeatherEnabled == "true"){ ?>
				var enabledval = "false";
				<?php }else{ ?>
				var enabledval = "true";	
				<?php } ?>
				$(".savebuttonweather").button().on("click", function(){
					$('form#weather_settings').submit();
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
		<div id="contentweather">
			<form id="weather_settings" name="weather_settings" method="post" action="/settings/weather_settings.php?Send">
            	<div class="borderdiv">
                    <center>
						<?php if($WeatherEnabled == "true"){ ?>	
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
   		  					<label for="url"><?php echo $WeatherUrlLang; ?></label><br />
      						<input name="url" type="text" id="url" value="<?php echo $WeatherUrl ?>" size="60" />
    					</div>
        				<div style="display:inline-block; width:45px;">
        				</div>
        				<div style="display:inline-block;">
    					</div>
  					</div>       
  					<div style="height:53px;">
    					<div style="display:inline-block;">
        				</div>
    					<div style="display:inline-block;">
      						<label for="x"><?php echo $XLang; ?></label><br />
      						<input name="x" type="text" id="x" value="<?php echo $WeatherPositionX ?>" size="20" />
    					</div>
    					<div style="display:inline-block; width:30px;">
        				</div>
        				<div style="display:inline-block;">
      						<label for="y"><?php echo $YLang; ?></label><br />
      						<input name="y" type="text" id="y" value="<?php echo $WeatherPositionY?>" size="20" />
    					</div>
  					</div>
                    <div style="height:53px;">
    					<div style="display:inline-block;">
        				</div>
    					<div style="display:inline-block;">
      						<label for="numoff"><?php echo $NumberOfLang; ?></label><br />
      						<input name="numoff" type="text" id="numoff" value="<?php echo $WeatherNumberOf ?>" size="20" />
    					</div>
    					<div style="display:inline-block; width:15px;">
        				</div>
        				<div style="display:inline-block;">
      						<label for="transp"><?php echo $WeatherTransparentLang; ?></label><br />
      						<input name="transp" type="text" id="transp" value="<?php echo $WeatherTransparent?>" size="20" />
    					</div>
  					</div>
                    <div style="height:53px;">
    					<div style="display:inline-block;">
        				</div>
    					<div style="display:inline-block;">
      						<label for="iconsize"><?php echo $WeatherIconSizeLang; ?></label><br />
      						<input name="iconsize" type="text" id="iconsize" value="<?php echo $WeatherIconSize ?>" size="20" />
    					</div>
    					<div style="display:inline-block; width:30px;">
        				</div>
        				<div style="display:inline-block;">
      						<label for="fontsize"><?php echo $WeatherFontSizeLang; ?></label><br />
      						<input name="fontsize" type="text" id="fontsize" value="<?php echo $WeatherFontSize?>" size="20" />
    					</div>
  					</div>
    			</div>  				
        		<div class="borderdiv" id="save">
                    <center>
                        <div class="savebuttonweather"><?php echo $SaveButtonLang; ?></div>
                    </center>			
                </div>                
            </form>
        </div>        
		<?php if(isset($_GET['Send'])) {
			//Load XML and set some config
			$xmlWeatherSettings = new DOMDocument('1.0', 'utf-8');
			$xmlWeatherSettings->formatOutput = true;
			$xmlWeatherSettings->preserveWhiteSpace = false;
			$xmlWeatherSettings->load('settings.xml');
			@$en_new = $_POST['enabled'];
			$x_new = $_POST['x'];
			$y_new = $_POST['y'];
			$url_new = $_POST['url'];
			$numoff_new = $_POST['numoff'];
			$transp_new = $_POST['transp'];
			$iconsize_new = $_POST['iconsize'];
			$fontsize_new = $_POST['fontsize'];			
			//Get item Element
			$dg =  $xmlWeatherSettings->getElementsByTagName('weather')->item(0);
			//Load child elements
			$en_orginal = $dg->getElementsByTagName('en')->item(0);
			$x_orginal = $dg->getElementsByTagName('positionx')->item(0);
			$y_orginal = $dg->getElementsByTagName('positiony')->item(0);
			$url_orginal = $dg->getElementsByTagName('url')->item(0);
			$numoff_orginal = $dg->getElementsByTagName('number')->item(0);
			$transp_orginal = $dg->getElementsByTagName('transperant')->item(0);
			$iconsize_orginal = $dg->getElementsByTagName('iconsize')->item(0);
			$fontsize_orginal = $dg->getElementsByTagName('fontsize')->item(0);			
			//Change values
			$en_orginal->nodeValue = $en_new;
			$x_orginal->nodeValue = $x_new;
			$y_orginal->nodeValue = $y_new;
			$url_orginal->nodeValue = $url_new;
			$numoff_orginal->nodeValue = $numoff_new;
			$transp_orginal->nodeValue = $transp_new;
			$iconsize_orginal->nodeValue = $iconsize_new;
			$fontsize_orginal->nodeValue = $fontsize_new;		
			//Replace old elements with new			
			$xmlWeatherSettings->save("settings.xml");
			?>
			<script language="JavaScript" type="text/JavaScript">
				<!--
					window.location.href = "weather_settings.php";
				//-->
			</script>
		<?php
		}
		?>
	</body>
</html>