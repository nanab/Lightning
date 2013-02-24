<!-- V2.0 Copyright Nanab nanab666@gmail.com. -->
<?php
$xmlload = simplexml_load_file(dirname(__FILE__)."/settings.xml");	
$SMNumbersOriginal = $xmlload->systemmodes->numberofsm;
$xmlSMAdd = new DOMDocument('1.0', 'utf-8');
$xmlSMAdd->formatOutput = true;
$xmlSMAdd->preserveWhiteSpace = false;
$xmlSMAdd->load(dirname(__FILE__)."/settings.xml");	
//Get item Element
$SMSum =  $xmlSMAdd->getElementsByTagName('systemmodes')->item(0);
$NumofSMOriginal = $SMSum->getElementsByTagName('numberofsm')->item(0);
$NumofSMnew = $SMNumbersOriginal + 1; 
if ($SMNumbersOriginal == "1"){ 
	$newItem = $xmlSMAdd->createElement('sm1');
	$newItem->appendChild($xmlSMAdd->createElement('ap', '1'));
}else{
	$newItem = $xmlSMAdd->createElement('sm'.$SMNumbersOriginal);
	$newItem->appendChild($xmlSMAdd->createElement('ap', $SMNumbersOriginal));
}
$newItem->appendChild($xmlSMAdd->createElement('en', 'false'));
$newItem->appendChild($xmlSMAdd->createElement('id', ''));
$newItem->appendChild($xmlSMAdd->createElement('x', '50'));
$newItem->appendChild($xmlSMAdd->createElement('y', '50'));
$newItem->appendChild($xmlSMAdd->createElement('on', 'Hemma_On.png'));
$newItem->appendChild($xmlSMAdd->createElement('off', 'Hemma_Off.png'));
$newItem->appendChild($xmlSMAdd->createElement('tab', '1'));
//Load child elements
$xmlSMAdd->getElementsByTagName('systemmodes')->item(0)->appendChild($newItem);
//Replace old elements with new
$NumofSMOriginal->nodeValue = $NumofSMnew;
$xmlSMAdd->save(dirname(__FILE__)."/settings.xml");
?>