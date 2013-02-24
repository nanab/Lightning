<!-- V2.0 Copyright Nanab nanab666@gmail.com. -->
<?php
$xmlload = simplexml_load_file(dirname(__FILE__)."/settings.xml");	
$DevNumbersOriginal = $xmlload->devices->numberofdevices;
$xmldevicesAdd = new DOMDocument('1.0', 'utf-8');
$xmldevicesAdd->formatOutput = true;
$xmldevicesAdd->preserveWhiteSpace = false;
$xmldevicesAdd->load(dirname(__FILE__)."/settings.xml");	
//Get item Element
$DevicesSum =  $xmldevicesAdd->getElementsByTagName('devices')->item(0);
$NumofdevOriginal = $DevicesSum->getElementsByTagName('numberofdevices')->item(0);
$Numofdevnew = $DevNumbersOriginal + 1; 
if ($DevNumbersOriginal == "1"){ 
	$newItem = $xmldevicesAdd->createElement('dev1');
	$newItem->appendChild($xmldevicesAdd->createElement('ap', '1'));
}else{
	$newItem = $xmldevicesAdd->createElement('dev'.$DevNumbersOriginal);
	$newItem->appendChild($xmldevicesAdd->createElement('ap', $DevNumbersOriginal));
}
$newItem->appendChild($xmldevicesAdd->createElement('en', 'false'));
$newItem->appendChild($xmldevicesAdd->createElement('id', ''));
$newItem->appendChild($xmldevicesAdd->createElement('x', '100'));
$newItem->appendChild($xmldevicesAdd->createElement('y', '120'));
$newItem->appendChild($xmldevicesAdd->createElement('onscenariodriven', 'DeviceOn_Scenario.png'));
$newItem->appendChild($xmldevicesAdd->createElement('offscenariodriven', 'DeviceOff_Scenario.png'));
$newItem->appendChild($xmldevicesAdd->createElement('onscheduledriven', 'DeviceOn.png'));
$newItem->appendChild($xmldevicesAdd->createElement('offscheduledriven', 'DeviceOff.png'));
$newItem->appendChild($xmldevicesAdd->createElement('onsemiauto', 'DeviceOn_SemiAuto.png'));
$newItem->appendChild($xmldevicesAdd->createElement('offsemiauto', 'DeviceOff_SemiAuto.png'));
$newItem->appendChild($xmldevicesAdd->createElement('onscheduleandruledriven', 'DeviceOn_Rule.png'));
$newItem->appendChild($xmldevicesAdd->createElement('offscheduleandruledriven', 'DeviceOff_Rule.png'));
$newItem->appendChild($xmldevicesAdd->createElement('picsizewidth', '40'));
$newItem->appendChild($xmldevicesAdd->createElement('picsizeheight', '40'));
$newItem->appendChild($xmldevicesAdd->createElement('nameon', 'true'));
$newItem->appendChild($xmldevicesAdd->createElement('tab', '1'));
//Load child elements
$xmldevicesAdd->getElementsByTagName('devices')->item(0)->appendChild($newItem);
//Replace old elements with new
$NumofdevOriginal->nodeValue = $Numofdevnew;
$xmldevicesAdd->save(dirname(__FILE__)."/settings.xml");
?>