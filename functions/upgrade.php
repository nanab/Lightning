<!-- V2.0 Copyright Nanab nanab666@gmail.com. -->
<?php
//Function to uppgrade settings.xml file
function upgrade($VersionUpgrade, $OldVersion){
	$xmlload = simplexml_load_file(dirname(__FILE__)."/../settings/settings.xml");	
	$DevNumbersOriginal = $xmlload->datasources->numberofds;	
	$xmlUpgrade = new DOMDocument('1.0', 'utf-8');
	$xmlUpgrade->formatOutput = true;
	$xmlUpgrade->preserveWhiteSpace = false;
	$xmlUpgrade->load(dirname(__FILE__)."/../settings/settings.xml");	
	//If version upgrade to is V2.0
	if ($VersionUpgrade == "2.0" && $OldVersion == "1.0"){
		//Upgrade Datasources 	
		//Get item Element
		$DSUpgrade =  $xmlUpgrade->getElementsByTagName('datasources')->item(0);
		$NumofdevOriginal = $DSUpgrade->getElementsByTagName('numberofds')->item(0);
		$Numofdevnew = $DevNumbersOriginal;
		$Numofdevfix = $Numofdevnew - 1; 
		$Number = "0";
		while($Number<=$Numofdevfix){
			$DSUpgrade1 = $DSUpgrade->getElementsByTagName('ds'. $Number)->item(0);
			$DSUpgrade1->appendChild($xmlUpgrade->createElement('sizex', '500'));
			$DSUpgrade1->appendChild($xmlUpgrade->createElement('sizey', '500'));
			$DSUpgrade1->appendChild($xmlUpgrade->createElement('minute', '1440'));
			//Load child elements
			$xmlUpgrade->getElementsByTagName('datasources')->item(0)->appendChild($DSUpgrade1);					
			$Number++;
		};
		//Add weather support
		$WeatherElem =  $xmlUpgrade->getElementsByTagName('settings')->item(0);
		$WeatherElem->appendChild($xmlUpgrade->createElement('weather'));
		$WeatherElem2 =  $xmlUpgrade->getElementsByTagName('weather')->item(0);
		$WeatherElem2->appendChild($xmlUpgrade->createElement('en', 'false'));
		$WeatherElem2->appendChild($xmlUpgrade->createElement('url', 'http://www.yr.no/sted/Sverige/Blekinge/Ronneby/'));
		$WeatherElem2->appendChild($xmlUpgrade->createElement('xmlfile', 'forecast.xml'));
		$WeatherElem2->appendChild($xmlUpgrade->createElement('meteogram', 'avansert_meteogram.png'));
    	$WeatherElem2->appendChild($xmlUpgrade->createElement('number', '7'));
    	$WeatherElem2->appendChild($xmlUpgrade->createElement('positionx', '11'));
    	$WeatherElem2->appendChild($xmlUpgrade->createElement('positiony', '616'));
    	$WeatherElem2->appendChild($xmlUpgrade->createElement('iconsize', '22'));
    	$WeatherElem2->appendChild($xmlUpgrade->createElement('fontsize', '12'));
    	$WeatherElem2->appendChild($xmlUpgrade->createElement('transperant', '0.8'));
		//Add theme support							
		$MainUpgrade =  $xmlUpgrade->getElementsByTagName('main')->item(0);
		$MainUpgrade->appendChild($xmlUpgrade->createElement('theme', 'ui-darkness'));
		//Add additional move settings
		$MainUpgrade->appendChild($xmlUpgrade->createElement('allmove', 'false'));
		$MainUpgrade->appendChild($xmlUpgrade->createElement('moverespondpositionx', '10'));
		$MainUpgrade->appendChild($xmlUpgrade->createElement('moverespondpositiony', '10'));
		//Add butten settings
		$MainUpgrade->appendChild($xmlUpgrade->createElement('refreshbutton', 'true'));
		$MainUpgrade->appendChild($xmlUpgrade->createElement('settingsbutton', 'true'));
		$MainUpgrade->appendChild($xmlUpgrade->createElement('settingsbuttonpositionx', '867'));
    	$MainUpgrade->appendChild($xmlUpgrade->createElement('settingsbuttonpositiony', '571'));
    	$MainUpgrade->appendChild($xmlUpgrade->createElement('refreshbuttonpositionx', '868'));
    	$MainUpgrade->appendChild($xmlUpgrade->createElement('refreshbuttonpositiony', '598'));
		//Upgrade version on file
		$Version_orginal = $MainUpgrade->getElementsByTagName('version')->item(0);
		$Version_orginal->nodeValue = $VersionUpgrade;
		//Replace or add elements with new	
		$xmlUpgrade->save(dirname(__FILE__)."/../settings/settings.xml");
		?>
        <script>
		location.reload()
		</script>
        <?php	
	};
};
?>



