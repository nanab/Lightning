<!-- V2.0 Copyright Nanab nanab666@gmail.com. -->
<?php
$xmlload = simplexml_load_file(dirname(__FILE__)."/settings.xml");	
$DevNumbersOriginal = $xmlload->datasources->numberofds;
$xmlDSAdd = new DOMDocument('1.0', 'utf-8');
$xmlDSAdd->formatOutput = true;
$xmlDSAdd->preserveWhiteSpace = false;
$xmlDSAdd->load(dirname(__FILE__)."/settings.xml");	
//Get item Element
$DSSum =  $xmlDSAdd->getElementsByTagName('datasources')->item(0);
$NumofdevOriginal = $DSSum->getElementsByTagName('numberofds')->item(0);
$Numofdevnew = $DevNumbersOriginal + 1; 
if ($DevNumbersOriginal == "1"){ 
	$newItem = $xmlDSAdd->createElement('ds1');
	$newItem->appendChild($xmlDSAdd->createElement('ap', '1'));
}else{
	$newItem = $xmlDSAdd->createElement('ds'.$DevNumbersOriginal);
	$newItem->appendChild($xmlDSAdd->createElement('ap', $DevNumbersOriginal));
}
$newItem->appendChild($xmlDSAdd->createElement('en', 'false'));
$newItem->appendChild($xmlDSAdd->createElement('id', ''));
$newItem->appendChild($xmlDSAdd->createElement('fa', '°C'));
$newItem->appendChild($xmlDSAdd->createElement('x', '100'));
$newItem->appendChild($xmlDSAdd->createElement('y', '150'));
$newItem->appendChild($xmlDSAdd->createElement('nameon', 'true'));
$newItem->appendChild($xmlDSAdd->createElement('tab', '1'));
$newItem->appendChild($xmlDSAdd->createElement('sizex', '500'));
$newItem->appendChild($xmlDSAdd->createElement('sizey', '500'));
$newItem->appendChild($xmlDSAdd->createElement('minute', '1440'));
//Load child elements
$xmlDSAdd->getElementsByTagName('datasources')->item(0)->appendChild($newItem);
//Replace old elements with new
$NumofdevOriginal->nodeValue = $Numofdevnew;
$xmlDSAdd->save(dirname(__FILE__)."/settings.xml");
?>