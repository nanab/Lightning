<?php
//Loading from switchking starts here
include ("load_settings.php");
// If Scenarios is active load them from switchking	
	if ($SCEn == "true") {	
		$SCXmlStrMain  = file_get_contents("http://$User:$Pass@$Ip:$Port/$FuncSC"); //Switch king path to get scenarios info from
    	$SCXml_Cont_Main = new SimpleXMLElement($SCXmlStrMain);  
		$CountSC = count($SCXml_Cont_Main);
		$CountSC1 = $CountSC - "1";
		$Scenarios = array(); 
    	foreach($SCXml_Cont_Main as $SCUrlMain){ //read out info from switchking into array
			$Id = $SCUrlMain->ID;				
			$Active = $SCUrlMain->Active;
			$Name = $SCUrlMain->Name;
			$Enabled = $SCUrlMain->Enabled;		
			$Scenarios[] = $Id . "," . $Active . "," . $Name . "," . $Enabled; //add to array splitted by ,
		}
		$Scenarios = array_unique($Scenarios);	
    	sort($Scenarios, SORT_NUMERIC); //Sort array after id.
		$ISCSwitchLoad=0;
		foreach($Scenarios as $Scenario){ //split upp array into scenario and add specifik number in each scenario variable name
			$Scenario = explode(",", $Scenario);
			${'SCSwitch'.$ISCSwitchLoad.'Id'} = $Scenario[0];
			${'SCSwitch'.$ISCSwitchLoad.'Active'} = $Scenario[1];
			${'SCSwitch'.$ISCSwitchLoad.'Name'} = $Scenario[2];
			${'SCSwitch'.$ISCSwitchLoad.'Enabled'} = $Scenario[3];
			$ISCSwitchLoad++;
		}
	};
	
	 // Load devices from switchking
 	$DevNumbers = $xml->devices->numberofdevices; //read out amount of devices in local settings file	
	$DevXmlStrMain  = file_get_contents("http://$User:$Pass@$Ip:$Port/$funcdev"); //Switch king path to get device info rfrom
    $DevXml_Cont_Main = new SimpleXMLElement($DevXmlStrMain);  
	$CountDevs = count($DevXml_Cont_Main);
	$CountDevs1 = $CountDevs - "1";
	$devices = array(); 
    foreach($DevXml_Cont_Main as $DevUrlMain){ //read out info from switchking into array
		$Id = $DevUrlMain->ID;				
		$CurrentStateID = $DevUrlMain->CurrentStateID;
		$Name = $DevUrlMain->Name;
		$SupportsAbsoluteDimLvl = $DevUrlMain->SupportsAbsoluteDimLvl;
		$CurrentDimLevel = $DevUrlMain->CurrentDimLevel;
		$ModeType = $DevUrlMain->ModeType;		
		$devices[] = $Id . "," . $CurrentStateID . "," . $Name . "," . $SupportsAbsoluteDimLvl . "," . $CurrentDimLevel . "," . $ModeType; //add to array splitted by ,
	}
	$devices = array_unique($devices);	
    sort($devices, SORT_NUMERIC); //Sort array after id.
	$IDevSwitchLoad=0;
	foreach($devices as $device){ //split upp array into device and add specifik number in each device variable name
		$device = explode(",", $device);
		${'DevSwitch'.$IDevSwitchLoad.'Id'} = $device[0];
		${'DevSwitch'.$IDevSwitchLoad.'CurrentStateID'} = $device[1];
		${'DevSwitch'.$IDevSwitchLoad.'Name'} = $device[2];
		${'DevSwitch'.$IDevSwitchLoad.'SupportsAbsoluteDimLvl'} = $device[3];
		${'DevSwitch'.$IDevSwitchLoad.'CurrentDimLevel'} = $device[4];
		${'DevSwitch'.$IDevSwitchLoad.'ModeType'} = $device[5];
		$IDevSwitchLoad++;
	}
		
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
	$DSNumbers = $xml->systemmodes->numberofds; //read out amount of datasources in local settings file	
	$DSXmlStrMain  = file_get_contents("http://$User:$Pass@$Ip:$Port/$FuncDS"); //Switch king path to get datasource info rfrom
    $DSXml_Cont_Main = new SimpleXMLElement($DSXmlStrMain);  
	$CountDS1 = count($DSXml_Cont_Main);
	$CountDS = $CountDS1 - "1";
	$Datasources = array(); 
    foreach($DSXml_Cont_Main as $DSUrlMain){ //read out info from switchking into array
		$Id = $DSUrlMain->ID;				
		$LastValue = $DSUrlMain->LastValue;
		$LastValue = str_replace(',', '&#44;', $LastValue);	//Convert , to html in value. To not interfear whit explode later
		$Name = $DSUrlMain->Name;
		$Enabled = $DSUrlMain->Enabled;		
		$Datasources[] = $Id . "," . $LastValue . "," . $Name . "," . $Enabled; //add to array splitted by ,
	}
	$Datasources = array_unique($Datasources);	
    //sort($Datasources, SORT_NUMERIC); //Sort array after id.
	$IDSSwitchLoad=0;
	foreach($Datasources as $Datasource){ //split upp array into datasource and add specifik number in each datasource variable name
		$Datasource = explode(",", $Datasource);
		${'DSSwitch'.$IDSSwitchLoad.'Id'} = $Datasource[0];
		${'DSSwitch'.$IDSSwitchLoad.'LastValue'} = $Datasource[1];
		${'DSSwitch'.$IDSSwitchLoad.'Name'} = $Datasource[2];
		${'DSSwitch'.$IDSSwitchLoad.'Enabled'} = $Datasource[3];
		$IDSSwitchLoad++;
	}
	
	// Load devicegroups from switchking	
	if ($DGEn == "true") {	//If devicegroups enabled start loading	
		$DGXmlStrMain  = file_get_contents("http://$User:$Pass@$Ip:$Port/$FuncDG"); //Switch king path to get devicegroups info from switchking
    	$DGXml_Cont_Main = new SimpleXMLElement($DGXmlStrMain);  
		$CountDG1 = count($DGXml_Cont_Main);
		$CountDG = $CountDG1 - "1";
		$Devicegroups = array(); 
    	foreach($DGXml_Cont_Main as $DGUrlMain){ //read out info from switchking into array
			$Id = $DGUrlMain->ID;				
			$Name = $DGUrlMain->Name;	
			$Devicegroups[] = $Id . "," . $Name; //add to array splitted by ,
		}
		$Devicegroups = array_unique($Devicegroups);	
    	//sort($Datasources, SORT_NUMERIC); //Sort array after id.
		$IDGSwitchLoad=0;
		foreach($Devicegroups as $Devicegroup){ //split upp array into devicegroup and add specifik number in each devicegroup variable name
			$Devicegroup = explode(",", $Devicegroup);
			${'DGSwitch'.$IDGSwitchLoad.'Id'} = $Devicegroup[0];
			${'DGSwitch'.$IDGSwitchLoad.'Name'} = $Devicegroup[1];
			$IDGSwitchLoad++;
		}
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
	$DevicegroupTransparent = "0.8";
	$MoveableDG = $xml->devicegroups->moveabledg;
	$DGX = $xml->devicegroups->x;
	$DGY = $xml->devicegroups->y;
	//$DGBackColor = $xml->devicegroups->backcolor;
	//$DGFontSize = $xml->devicegroups->fontsize;
	//$DGHideable = $xml->devicegroups->hideable;	
	
	//Devices
	//Devices settings from xml file		
	$moveabledev = $xml->devices->moveabledev;
	$DeviceTransparent = "0.8";
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
	$DatasourceTransparent = "0.8";
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
	
	
	?>