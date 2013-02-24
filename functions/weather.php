<!-- V2.0 Copyright Nanab nanab666@gmail.com. -->
<?php
include(dirname(__FILE__)."/../settings/load_settings.php");
$Night = "Night";
$Morning = "Morning";
$Day = "Day";
$Evening = "Evening";
?>
<style>
	.mainweather{
		font-size: <?php echo $WeatherFontSize; ?>px;
		-moz-border-radius: 10px;
		-webkit-border-radius: 10px;
		border-radius: 10px;
		background-color: rgba(255, 255, 255, <?php echo $WeatherTransparent; ?>);
		border-color: solid 10px rgba(0,0,0,0.2); /*Very transparent black*/
	}
	.clickweather{
		cursor:pointer;
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
$NumberWeather = $WeatherNumberOf;
foreach ($forecast->forecast->tabular as $tabular) {
  $itime = 1;  
    foreach ($tabular->time as $data) {
		//time
        ${'From'.$itime} = substr($data['from'], 0,10);       
        ${'To'.$itime} = $data['to'];       
        ${'Period'.$itime} = $data['period'];
		//symbol
		${'Number'.$itime} = $data->symbol['number'];
		${'Name'.$itime} = $data->symbol['name'];
		//Winddirection
		${'Code'.$itime} = $data->windDirection['code'];
		//Windspeed
		${'Mps'.$itime} = $data->windSpeed['mps'] . '&nbsp;M/s';
		//temperature
		${'TempValue'.$itime} = $data->temperature['value'] . '&nbsp;°C';
		//convert period numbers to time on day in text
		if (${'Period'.$itime} == "0") {
			${'PeriodName'.$itime} = $Night;
		}else if (${'Period'.$itime} == "1"){
			${'PeriodName'.$itime} = $Morning;
		}else if (${'Period'.$itime} == "2"){
			${'PeriodName'.$itime} = $Day;
		}else if (${'Period'.$itime} == "3"){
			${'PeriodName'.$itime} = $Evening;
		}       		
		if($itime == $NumberWeather) break;
		$itime++;
    } 
}
?>
<body bgcolor="black">
	<div class="notclickdiv">
		<div id="mainweather" class="mainweather" style="display:inline-block;">
			<div class="clickweather">
				<?php
				$idwe=1;
				while($idwe<=$NumberWeather) {
					//$DSNameOn = "DS".$idsd."NameOn";
					$From = "From".$idwe;
					$PeriodName = "PeriodName".$idwe;
					$Number = "Number".$idwe;
					$Code = "Code".$idwe;
					$Mps = "Mps".$idwe;
					$TempValue = "TempValue".$idwe;
					?>
					<div id="ikon" style="display:inline-block;">
						<?php
						if($$PeriodName == "Night" || $$PeriodName == "Evening"){
							echo "<img src='http://api.yr.no/weatherapi/weathericon/1.0/?symbol=" . $$Number . ";is_night=1;content_type=image/png' width='" . $WeatherIconSize . "' height='" . $WeatherIconSize . "'>";
						}else{
							echo "<img src='http://api.yr.no/weatherapi/weathericon/1.0/?symbol=" . $$Number . ";content_type=image/png' width='" . $WeatherIconSize . "' height='" . $WeatherIconSize . "'>";
						}
						?>
					</div>
					<div id="dayweather" class="dayweather" style="display:inline-block; border:3 black;">                                                      
						<?php								
						echo $$From;
						echo "&nbsp;";
						echo $$PeriodName;
						echo "&nbsp;&nbsp;&nbsp;";
						echo "<br>";
						echo $$Code;
						echo "&nbsp;";
						echo $$Mps;
						echo "&nbsp;&nbsp;";
						echo $$TempValue. '&nbsp;';
						?>
					</div>                        						
					<?php
					$idwe++;
				}
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
</body>