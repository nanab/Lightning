<?php
$Version = "2.0";
$Catalog = ""; //If ligtning is installed under child catalog on webserver add catalog name here started whit "/". example "/lightning"
$xml = simplexml_load_file(dirname(__FILE__)."/settings.xml");
//Load language inte array

//Jquery files
$Theme = $xml->main->theme;
$Jquery = $Catalog . '/ui/jquery-1.9.0.js';
$JqueryCustom = $Catalog . '/ui/jquery-ui-1.10.0.custom.js';
$JqueryCustomCss = $Catalog . '/themes/themes/' . $Theme . '/jquery.ui.theme.css';
$JqueryCustomCss2 = $Catalog . '/themes/themes/' . $Theme . '/jquery-ui.css';
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
	$ImagePath = ".." . $Catalog . $xml->advanced->imagepath;
	$FuncSysm = 'systemmodes';
	$funcdev = 'devices';
	$FuncDS = 'datasources';
	$FuncSC = 'scenarios';
	$FuncDG = 'devicegroups';
	$BackgroundColorWidgets = "0, 0, 0";
	$TextColorWidgets = "white";
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
	$OnlyDays = "true";
	$WeatherDegree = "°";
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
	$RazberryActive = "false";			
};
?>