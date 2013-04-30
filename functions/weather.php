<!-- V2.0 Copyright Nanab nanab666@gmail.com. -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include(dirname(__FILE__)."/../settings/load_settings.php");

//test variables
$WeatherFontSizeCredit = $WeatherFontSize - 4;
//Load text from language file
$Night = $XmlLang->weather->night;
$Morning = $XmlLang->weather->morning;
$Day = $XmlLang->weather->day;
$Evening = $XmlLang->weather->evening;
$sunday = $XmlLang->weather->sunday;
$monday = $XmlLang->weather->monday;
$tuesday = $XmlLang->weather->tuesday;
$wednesday = $XmlLang->weather->wednesday;
$thursday = $XmlLang->weather->thursday;
$friday = $XmlLang->weather->friday;
$saturday = $XmlLang->weather->saturday;

?>
<style>
	.mainweather{
		color:<?php echo $TextColorWidgets; ?>;
		font-size: <?php echo $WeatherFontSize; ?>px;
		-moz-border-radius: 10px;
		-webkit-border-radius: 10px;
		border-radius: 10px;
		background-color: rgba(<?php echo $BackgroundColorWidgets; ?>, <?php echo $WeatherTransparent; ?>);
		border-color: solid 10px rgba(0,0,0,0.2); /*Very transparent black*/
	}
	.clickweather{
		cursor:pointer;
	}
	#credit{
		color:<?php echo $TextColorWidgets; ?>;
		
		font-size:<?php echo $WeatherFontSizeCredit; ?>;
	}
	a:link{
		color:<?php echo $TextColorWidgets; ?>;
	}
	a:visited{
		color:<?php echo $TextColorWidgets; ?>;
	}
</style>
<script>
	$(function() {
        $('.clickweather').on('click', function(){
			var weatherurl = "<?php echo $WeatherUrl; ?>";
			var weathermeteogram = "<?php echo $WeatherMeteogram; ?>";
			var dlg = $("#test");
			dlg.dialog( {
    			minHeight: 'auto',
				resizable: true,
				width: 'auto'					
    		});
			var dialog = $("#test").dialog();
			dialog.data( "uiDialog" )._title = function(title) {
    			title.html( this.options.title );
			};
			//Bring upp the dialog 
			dialog.dialog({ title: 'Weather', position: 'left top' }).html('<img src="../settings/tempfiles/' + weathermeteogram +'">');					
        });					
    });			
</script>
<?php
$TempFileMeteo = (dirname(__FILE__)."/../settings/tempfiles/avansert_meteogram.png");
if (file_exists($TempFileMeteo) && (filemtime($TempFileMeteo) > (time() - 60 * 60 ))) {
   	// Cache file is less than sixty minutes old. 
   	// Don't bother refreshing, just use the file as-is.			
} else {
	copy($WeatherUrl. $WeatherMeteogram, '../settings/tempfiles/avansert_meteogram.png');
}
try {
	@$forecast = new SimpleXMLElement(dirname(__FILE__)."/../settings/tempfiles/weather.xml", null, true);
} catch (Exception $e) {
	$FileLog = fopen(dirname(__FILE__)."/../settings/tempfiles/log.txt", 'a+') or die("can't open file");
	write($FileLog, date("Y-m-d H:i:s"). " Could not read weather.xml file check that you have internet connection and url line is rigth!".  PHP_EOL);
	fclose($FileLog);
	exit;
}
//Read out credit text
$Creditt = $forecast->credit->link;
$CreditText = $Creditt['text'];
$CreditUrl = $Creditt['url'];
//read out values
$SunUp = $forecast->sun['rise'];
$SunUp = substr($SunUp, strpos($SunUp, "T", 0));
$SunUp = substr($SunUp, 1, 5);
$SunDown = $forecast->sun['set'];
$SunDown = substr($SunDown, strpos($SunDown, "T", 0));
$SunDown = substr($SunDown, 1, 5);
$NumberWeather = $WeatherNumberOf;
$CountWeather = count($forecast->forecast->tabular->time);
$Weathers = array();
foreach ($forecast->forecast->tabular as $tabular) {
  $itime = 1;  
    foreach ($tabular->time as $data) {
			//time
			$From = substr($data['from'], 0,10);       
			$To = $data['to'];       
			$Period = $data['period'];
			//symbol
			$Number = $data->symbol['number'];
			$Name = $data->symbol['name'];
			//Winddirection
			$Code = $data->windDirection['code'];
			//Windspeed
			$Mps = $data->windSpeed['mps'] . 'm/s';
			//temperature
			$TempValue = $data->temperature['value'];
			//convert period numbers to time on day in text
			if ($Period == "0") {
				$PeriodName = $Night;
			}else if ($Period == "1"){
				$PeriodName = $Morning;
			}else if ($Period == "2"){
				$PeriodName = $Day;
			}else if ($Period == "3"){
				$PeriodName = $Evening;
			}
			$Weathers[] = $Period . "," . $PeriodName. "," . $From. "," . $To. "," . $Number. "," . $Name. "," . $Code. "," . $Mps. "," . $TempValue;
		}
		if($itime == $CountWeather) break;
		$itime++;
    
}
?>
	<div class="notclickdiv" >
		<div id="mainweather" class="mainweather" style="display:inline-block;">        	
			<div class="clickweather">
            	<div id="delimiter" style="display:inline-block;">&nbsp;
            	</div>
            	<div id="sunup" style="display:inline-block;">
                <center>
                	<?php															
                	echo $SunUp;
					echo "<br>";
					
					echo "<img src='../images/weatherbar/sun.png' width='15' height='15'>";
					echo "<br>";
					echo $SunDown;
					?>
                    
                </center>
            	</div>
                <div id="sundown" style="display:inline-block;">
                	<center>
                		<?php
						echo "&nbsp;&nbsp;&nbsp;&nbsp;";
						?>
                	</center>
                </div>
				<?php
				$idwe=1;
				$Weathers = array_unique($Weathers);
				foreach($Weathers as $Weather){
					$Weathers[] = $Period . "," . $PeriodName. "," . $From. "," . $To. "," . $Number. "," . $Name. "," . $Code. "," . $Mps. "," . $TempValue;
					$Weather = explode(",", $Weather); //Split upp variable into picese seperated by ,										
					if ($OnlyDays == "true") {
						if ($Weather[0] == "2") {
							$Period = $Weather[0];
							$PeriodName = $Weather[1];
							$From = $Weather[2];
							$To = $Weather[3];
							$Number = $Weather[4];
							$Name = $Weather[5];
							$Code = $Weather[6];
							$Mps = $Weather[7];
							$TempValue = $Weather[8];											
							//Start Converting date to weekdays				
							$From = date('l', strtotime($From));
							if ($From == "Sunday"){ //Get the right weekday spelling from language file
								$From = $sunday;
							}
							if ($From == "Monday"){
								$From = $monday;
							}
							if ($From == "Tuesday"){
								$From = $tuesday;
							}
							if ($From == "Wednesday"){
								$From = $wednesday;
							}
							if ($From == "Thursday"){
								$From = $thursday;
							}
							if ($From == "Friday"){ 
								$From = $friday;
							}
							if ($From == "Saturday"){
								$From = $saturday;
							}
							$From = substr($From, 0, 3);
							//Done converting date to weekdays
							?>
							
							<div id="dayweather" class="dayweather" style="display:inline-block; border:3 black;">                                                      
								<?php
								echo "<center>";								
								echo $From;					
								echo "<br>";								
								if($PeriodName == "Night" || $PeriodName == "Evening"){
									echo "<img src='http://api.yr.no/weatherapi/weathericon/1.0/?symbol=" . $Number . ";is_night=1;content_type=image/png' width='" . $WeatherIconSize . "' height='" . $WeatherIconSize . "'>";
								}else{
									echo "<img src='http://api.yr.no/weatherapi/weathericon/1.0/?symbol=" . $Number . ";content_type=image/png' width='" . $WeatherIconSize . "' height='" . $WeatherIconSize . "'>";
								}								
								echo "<br>";
								echo $TempValue . $WeatherDegree;
								echo "</center>";
								?>                                
							</div>                        						
							<?php
							if ($NumberWeather == $idwe) {
								break;
							}
							$idwe++;
						}
					}else{
						$Period = $Weather[0];
						$PeriodName = $Weather[1];
						$From = $Weather[2];
						$To = $Weather[3];
						$Number = $Weather[4];
						$Name = $Weather[5];
						$Code = $Weather[6];
						$Mps = $Weather[7];
						$TempValue = $Weather[8];											
						//Start Converting date to weekdays				
						$From = date('l', strtotime($From));
						if ($From == "Sunday"){ //Get the right weekday spelling from language file
							$From = $sunday;
						}
						if ($From == "Monday"){
							$From = $monday;
						}
						if ($From == "Tuesday"){
							$From = $tuesday;
						}
						if ($From == "Wednesday"){
							$From = $wednesday;
						}
						if ($From == "Thursday"){
							$From = $thursday;
						}
						if ($From == "Friday"){ 
							$From = $friday;
						}
						if ($From == "Saturday"){
							$From = $saturday;
						}
						//Done converting date to weekdays
						?>
						
						<div id="dayweather" class="dayweather" style="display:inline-block; border:3 black;">                                                      
							<?php	
							echo "<center>";							
							echo $From;
							echo "&nbsp;";
							echo $PeriodName;
							echo "&nbsp;&nbsp;&nbsp;";
							echo "<br>";							
							if($PeriodName == "Night" || $PeriodName == "Evening"){
								echo "<img src='http://api.yr.no/weatherapi/weathericon/1.0/?symbol=" . $Number . ";is_night=1;content_type=image/png' width='" . $WeatherIconSize . "' height='" . $WeatherIconSize . "'>";
							}else{
								echo "<img src='http://api.yr.no/weatherapi/weathericon/1.0/?symbol=" . $Number . ";content_type=image/png' width='" . $WeatherIconSize . "' height='" . $WeatherIconSize . "'>";
							}
							echo "&nbsp;&nbsp;" .$TempValue. $WeatherDegree;
							echo "<br>";
							echo $Code;
							echo "&nbsp;";
							echo $Mps;
							echo "&nbsp;&nbsp;";
							echo "</center>";
							?>
						</div>                        						
						<?php
						if ($NumberWeather == $idwe) {
							break;
						}
						$idwe++;
					}
				}
				echo '&nbsp;';
				?>
                
			</div>										
			<div id="credit" style="display:right;">
				<?php
				echo '&nbsp;&nbsp;<a href="' . $CreditUrl . '">' . $CreditText . '</a>'; 
				?>
			</div>
		</div>
		<div id="test">
		</div>
	</div>
