<!-- V2.0 Copyright Nanab nanab666@gmail.com. -->
<?php
$Version = "2.0";
$xml = simplexml_load_file(dirname(__FILE__)."/settings.xml");
//include dirname(__FILE__).'../inc/include.php';
//Load language inte array

//Jquery files
$Theme = $xml->main->theme;
$Jquery = "../ui/jquery-1.9.0.js";
$JqueryCustom = "../ui/jquery-ui-1.10.0.custom.js";
$JqueryCustomCss = "../themes/themes/$Theme/jquery.ui.theme.css";
$JqueryCustomCss2 = "../themes/themes/$Theme/jquery-ui.css";
//$JqueryCustom2 = "../themes/vader/jquery-ui-1.9.2.custom.css";
//$JqueryCustom2Css = "../themes/vader/jquery-ui-1.9.2.custom.css";

//Main
$First = $xml->main->first;
$VersionXml = $xml->main->version;
//If first time load networksettings
if ($First == "true"){
	$Ip = $xml->main->ip;
 	$Port = $xml->main->port;
 	$User = $xml->main->user;
 	$Pass = $xml->main->pass;
 	$MainTitle = $xml->main->title;
 	$TabTime = $xml->main->tabtime;
 	$Lang = $xml->main->lang;
	$LangFile = $xml->main->langfile;
	$XmlLang = simplexml_load_file(dirname(__FILE__)."/language/$LangFile");
//if second time load page
}else if ($First == "second"){
	$Ip = $xml->main->ip;
	$Port = $xml->main->port;
	$User = $xml->main->user;
	$Pass = $xml->main->pass;
	$MainTitle = $xml->main->title;
	$TabTime1 = $xml->main->tabtime;
	$TabTime = $TabTime1 * 10000;
	$LangFile = $xml->main->langfile;
	$AutoUp = $xml->main->autoup;
	$HideTab = $xml->main->hidetab;
	$HideTabButton = $xml->main->hidetabbutton;
	$XmlLang = simplexml_load_file(dirname(__FILE__)."/language/$LangFile");
 	//Advanced
	$ImagePath = $xml->advanced->imagepath;
	$FuncSysm = 'systemmodes';
	$funcdev = 'devices';
	$FuncDS = 'datasources';
	$FuncSC = 'scenarios';
	$FuncDG = 'devicegroups';
//if not first or second time load page
}else{
 	$Ip = $xml->main->ip;
	$Port = $xml->main->port;
	$User = $xml->main->user;
	$Pass = $xml->main->pass;
	$MainTitle = $xml->main->title;
	$TabTime1 = $xml->main->tabtime;
	$TabTime = $TabTime1 * 10000;
	$LangFile = $xml->main->langfile;
	$AutoUp = $xml->main->autoup;
	$HideTab = $xml->main->hidetab;
	$HideTabButton = $xml->main->hidetabbutton;
	$AllMove = $xml->main->allmove;
	$MoveRespondPositionX = $xml->main->moverespondpositionx;
	$MoveRespondPositionY = $xml->main->moverespondpositiony;
	$RefreshButtonActive = $xml->main->refreshbutton;
	$SettingsButtonActive = $xml->main->settingsbutton;
	$SettingsButtonPositionX = $xml->main->settingsbuttonpositionx;
	$SettingsButtonPositionY = $xml->main->settingsbuttonpositiony;
	$RefreshButtonPositionX = $xml->main->refreshbuttonpositionx;
	$RefreshButtonPositionY = $xml->main->refreshbuttonpositiony;
	$XmlLang = simplexml_load_file(dirname(__FILE__)."/language/$LangFile");
 	//Advanced
	$ImagePath = $xml->advanced->imagepath;
	$FuncSysm = 'systemmodes';
	$funcdev = 'devices';
	$FuncDS = 'datasources';
	$FuncSC = 'scenarios';
	$FuncDG = 'devicegroups';
	//Settings for page size
	$SizeX = "15";
	$SizeY = "15";
	//Function enabled or not from xml file	
	$SCEn = $xml->scenarios->en;	
	$DGEn = $xml->devicegroups->en;
	//Weather
	$WeatherEnabled = $xml->weather->en;	
	$WeatherUrl = $xml->weather->url;
	$WeatherXmlFile = $xml->weather->xmlfile;
	$WeatherMeteogram = $xml->weather->meteogram;
	$WeatherNumberOf = $xml->weather->number;
	$WeatherIconSize = $xml->weather->iconsize;;
	$WeatherFontSize = $xml->weather->fontsize;;
	$WeatherTransparent = $xml->weather->transperant;;
	$WeatherPositionX = $xml->weather->positionx;
	$WeatherPositionY = $xml->weather->positiony;
	$WeatherTempFile = (dirname(__FILE__)."/../settings/tempfiles/weather.xml");
	//Load global language variables
	$MinLang = $XmlLang->globallang->minutes;
	$HourLang = $XmlLang->globallang->hours;
	$DayLang = $XmlLang->globallang->day;
	$DaysLang = $XmlLang->globallang->days;
	$WeekLang = $XmlLang->globallang->week;
	$WeeksLang = $XmlLang->globallang->weeks;
	$MonthLang = $XmlLang->globallang->month;
	$MonthsLang = $XmlLang->globallang->months;
	$YearLang = $XmlLang->globallang->year;
	$YearsLang = $XmlLang->globallang->years;
	
	//Loading from switchking starts here

	// If Scenarios is active load them from switchking	
	if ($SCEn == "true") {	 
 		$XmlSC = simplexml_load_file(dirname(__FILE__)."/tempfiles/scenarios.xml");
 		$CountSC = count($XmlSC);
 		$ISCSwitchLoad=0;
 		$CountSC1 = $CountSC - "1";
			while($ISCSwitchLoad<=$CountSC1) {
				${'SCSwitch'.$ISCSwitchLoad.'Id'} = $XmlSC->RESTScenario[$ISCSwitchLoad]->ID;
				${'SCSwitch'.$ISCSwitchLoad.'Active'} = $XmlSC->RESTScenario[$ISCSwitchLoad]->Active;
				${'SCSwitch'.$ISCSwitchLoad.'Name'} = $XmlSC->RESTScenario[$ISCSwitchLoad]->Name;
				${'SCSwitch'.$ISCSwitchLoad.'Enabled'} = $XmlSC->RESTScenario[$ISCSwitchLoad]->Enabled;
				$ISCSwitchLoad++;
			};
	};
	
	 // Load devices from switchking
	 
 	$XmlDevs = simplexml_load_file(dirname(__FILE__)."/tempfiles/devices.xml");
	
 	$CountDevs = count($XmlDevs);
 	$DevNumbers = $xml->devices->numberofdevices;
 	$IDevSwitchLoad=0;
 	$CountDevs1 = $CountDevs - "1";
	while($IDevSwitchLoad<=$CountDevs1) {
		${'DevSwitch'.$IDevSwitchLoad.'Id'} = $XmlDevs->RESTDevice[$IDevSwitchLoad]->ID;
		${'DevSwitch'.$IDevSwitchLoad.'CurrentStateID'} = $XmlDevs->RESTDevice[$IDevSwitchLoad]->CurrentStateID;
		${'DevSwitch'.$IDevSwitchLoad.'Name'} = $XmlDevs->RESTDevice[$IDevSwitchLoad]->Name;
		${'DevSwitch'.$IDevSwitchLoad.'SupportsAbsoluteDimLvl'} = $XmlDevs->RESTDevice[$IDevSwitchLoad]->SupportsAbsoluteDimLvl;
		${'DevSwitch'.$IDevSwitchLoad.'CurrentDimLevel'} = $XmlDevs->RESTDevice[$IDevSwitchLoad]->CurrentDimLevel;
		${'DevSwitch'.$IDevSwitchLoad.'ModeType'} = $XmlDevs->RESTDevice[$IDevSwitchLoad]->ModeType;
		$IDevSwitchLoad++;
	};	
		
	// Load systemmodes from switchking
 	$XmlSM = simplexml_load_file("http://$User:$Pass@$Ip:$Port/$FuncSysm");
 	$CountSM = count($XmlSM);
 	$SMNumbers = $xml->systemmodes->numberofsm;
 	$ISMSwitchLoad=0;
 	$CountSM1 = $CountSM - "1";
	while($ISMSwitchLoad<=$CountSM1) {
		${'SMSwitch'.$ISMSwitchLoad.'Id'} = $XmlSM->RESTSystemMode[$ISMSwitchLoad]->ID;
		${'SMSwitch'.$ISMSwitchLoad.'Active'} = $XmlSM->RESTSystemMode[$ISMSwitchLoad]->Active;
		${'SMSwitch'.$ISMSwitchLoad.'Name'} = $XmlSM->RESTSystemMode[$ISMSwitchLoad]->Name;
		${'SMSwitch'.$ISMSwitchLoad.'Enabled'} = $XmlSM->RESTSystemMode[$ISMSwitchLoad]->Enabled;					
		$ISMSwitchLoad++;
	};
	
	// Load datasources from switchking
 	$XmlDS = simplexml_load_file(dirname(__FILE__)."/tempfiles/datasources.xml");
 	$CountDS1 = count($XmlDS);
	$CountDS = $CountDS1 - "1";
 	$DSNumbers = $xml->systemmodes->numberofds;
 	$IDSSwitchLoad=0; 	
	while($IDSSwitchLoad<=$CountDS) {
		${'DSSwitch'.$IDSSwitchLoad.'Id'} = $XmlDS->RESTDataSource[$IDSSwitchLoad]->ID;
		${'DSSwitch'.$IDSSwitchLoad.'LastValue'} = $XmlDS->RESTDataSource[$IDSSwitchLoad]->LastValue;
		${'DSSwitch'.$IDSSwitchLoad.'Name'} = $XmlDS->RESTDataSource[$IDSSwitchLoad]->Name;
		${'DSSwitch'.$IDSSwitchLoad.'Enabled'} = $XmlDS->RESTDataSource[$IDSSwitchLoad]->Enabled;					
		$IDSSwitchLoad++;
	};
	if ($DGEn == "true") {	
	// Load devicegroups from switchking
 	$XmlDG = simplexml_load_file(dirname(__FILE__)."/tempfiles/devicegroups.xml");
 	$CountDG1 = count($XmlDG);
	$CountDG = $CountDG1 - "1";
 	$IDGSwitchLoad=0; 	
	while($IDGSwitchLoad<=$CountDG) {
		${'DGSwitch'.$IDGSwitchLoad.'Id'} = $XmlDG->RESTDeviceGroup[$IDGSwitchLoad]->ID;
		${'DGSwitch'.$IDGSwitchLoad.'Name'} = $XmlDG->RESTDeviceGroup[$IDGSwitchLoad]->Name;				
		$IDGSwitchLoad++;
	};
	};
	//Loading from xml file starts here
	//Scenarios settings from xml file
	$MoveableSC = $xml->scenarios->moveablesc;
	$SCEn = $xml->scenarios->en;
	$SCX = $xml->scenarios->x;
	$SCY = $xml->scenarios->y;
	$SCBackColor = $xml->scenarios->backcolor;
	$SCFontSize = $xml->scenarios->fontsize;
	$SCHideable = $xml->scenarios->hideable;
	
	//DeviceGroups settings from xml file
	$MoveableDG = $xml->devicegroups->moveabledg;
	$DGX = $xml->devicegroups->x;
	$DGY = $xml->devicegroups->y;
	//$DGBackColor = $xml->devicegroups->backcolor;
	//$DGFontSize = $xml->devicegroups->fontsize;
	//$DGHideable = $xml->devicegroups->hideable;	
	
	//Devices
	//Devices settings from xml file		
	$moveabledev = $xml->devices->moveabledev;
	$IDevLoad=0;
	while($IDevLoad<=$DevNumbers) {
		$devtemp = 'dev'.$IDevLoad;
		${'Dev'.$IDevLoad.'id'} = $xml->devices->$devtemp->id;
		${'Dev'.$IDevLoad.'ap'} = $xml->devices->$devtemp->ap;
		${'Dev'.$IDevLoad.'en'} = $xml->devices->$devtemp->en;
		${'Dev'.$IDevLoad.'x'} = $xml->devices->$devtemp->x;
		${'Dev'.$IDevLoad.'y'} = $xml->devices->$devtemp->y;
		${'Dev'.$IDevLoad.'OnScenarioDriven'} = $xml->devices->$devtemp->onscenariodriven;
		${'Dev'.$IDevLoad.'OffScenarioDriven'} = $xml->devices->$devtemp->offscenariodriven;
		${'Dev'.$IDevLoad.'OnScheduleDriven'} = $xml->devices->$devtemp->onscheduledriven;
		${'Dev'.$IDevLoad.'OffScheduleDriven'} = $xml->devices->$devtemp->offscheduledriven;
		${'Dev'.$IDevLoad.'OnSemiAuto'} = $xml->devices->$devtemp->onsemiauto;
		${'Dev'.$IDevLoad.'OffSemiAuto'} = $xml->devices->$devtemp->offsemiauto;
		${'Dev'.$IDevLoad.'OnScheduleAndRuleDriven'} = $xml->devices->$devtemp->onscheduleandruledriven;
		${'Dev'.$IDevLoad.'OffScheduleAndRuleDriven'} = $xml->devices->$devtemp->offscheduleandruledriven;
		${'Dev'.$IDevLoad.'nameOn'} = $xml->devices->$devtemp->nameon;
		${'Dev'.$IDevLoad.'tab'} = $xml->devices->$devtemp->tab;
		${'Dev'.$IDevLoad.'PicSizeWidth'} = $xml->devices->$devtemp->picsizewidth;
		${'Dev'.$IDevLoad.'PicSizeHeight'} = $xml->devices->$devtemp->picsizeheight;
		$IDevLoad++;
	};			

	//Datasources
	//Datasources settings from xml file
	$DSNumbers = $xml->datasources->numberofds;
	$MoveableDS = $xml->datasources->moveableds;
	$IDSLoad=0;
	while($IDSLoad<=$DSNumbers) {
		$dstemp = 'ds'.$IDSLoad;
	 	${'DS'.$IDSLoad.'Id'} = $xml->datasources->$dstemp->id;
		${'DS'.$IDSLoad.'Ap'} = $xml->datasources->$dstemp->ap;
		${'DS'.$IDSLoad.'En'} = $xml->datasources->$dstemp->en;
		${'DS'.$IDSLoad.'Fa'} = $xml->datasources->$dstemp->fa;
		${'DS'.$IDSLoad.'Tab'} = $xml->datasources->$dstemp->tab;
		${'DS'.$IDSLoad.'NameOn'} = $xml->datasources->$dstemp->nameon;
		${'DS'.$IDSLoad.'x'} = $xml->datasources->$dstemp->x;
		${'DS'.$IDSLoad.'y'} = $xml->datasources->$dstemp->y;
		${'DS'.$IDSLoad.'SizeX'} = $xml->datasources->$dstemp->sizex;
		${'DS'.$IDSLoad.'SizeY'} = $xml->datasources->$dstemp->sizey;
		${'DS'.$IDSLoad.'Minute'} = $xml->datasources->$dstemp->minute;					
		$IDSLoad++;
	};
	
	//Systemmodes
	//Systemmodes settings from xml file
	$MoveableSM = $xml->systemmodes->moveablesm;
	$ISMLoad=0;
	while($ISMLoad<=$SMNumbers) {
		$smtemp = 'sm'.$ISMLoad;
		${'SM'.$ISMLoad.'Id'} = $xml->systemmodes->$smtemp->id;
		${'SM'.$ISMLoad.'Ap'} = $xml->systemmodes->$smtemp->ap;
		${'SM'.$ISMLoad.'En'} = $xml->systemmodes->$smtemp->en;
		${'SM'.$ISMLoad.'On'} = $xml->systemmodes->$smtemp->on;
		${'SM'.$ISMLoad.'Off'} = $xml->systemmodes->$smtemp->off;
		${'SM'.$ISMLoad.'x'} = $xml->systemmodes->$smtemp->x;
		${'SM'.$ISMLoad.'y'} = $xml->systemmodes->$smtemp->y;
		${'SM'.$ISMLoad.'Tab'} = $xml->systemmodes->$smtemp->tab;					
		$ISMLoad++;
	};
	
	//Tabs
 	//Tabs settings from xml file
 	$TabNumbers = $xml->tabs->numberoftabs;
	$ITabLoad=1;
	while($ITabLoad<=$TabNumbers) {
		$Tabtemp = 'tab'.$ITabLoad;
		${'Tab'.$ITabLoad.'Id'} = $xml->tabs->$Tabtemp->id;
		${'Tab'.$ITabLoad.'En'} = $xml->tabs->$Tabtemp->en;
		${'Tab'.$ITabLoad.'Name'} = $xml->tabs->$Tabtemp->name;
		${'Tab'.$ITabLoad.'Page'} = $xml->tabs->$Tabtemp->page;
		${'Tab'.$ITabLoad.'BakPic'} = $xml->tabs->$Tabtemp->bakpic;
		${'Tab'.$ITabLoad.'BakPicHeight'} = $xml->tabs->$Tabtemp->bakpicheight;
		${'Tab'.$ITabLoad.'BakPicWidth'} = $xml->tabs->$Tabtemp->bakpicwidth;	
		$ITabLoad++;
	};
	
	//Razzberry support (Alpha)
	$RazberryActive = "true";			
};
?>