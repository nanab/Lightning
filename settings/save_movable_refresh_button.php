<!-- V2.0 Copyright Nanab nanab666@gmail.com. -->
<?php
$left = $_POST['left'];
$top = $_POST['top'];
//Load XML and set some config
$xml = new DOMDocument('1.0', 'utf-8');
$xml->formatOutput = true;
$xml->preserveWhiteSpace = false;
$xml->load('settings.xml'); 
//Get item Element
$refreshbuttmove = $xml->getElementsByTagName('main')->item(0);
//Load child elements
$x = $refreshbuttmove->getElementsByTagName('refreshbuttonpositionx')->item(0);
$y = $refreshbuttmove->getElementsByTagName('refreshbuttonpositiony')->item(0);
//Change values
$x->nodeValue = $left;
$y->nodeValue = $top;
//Replace old elements with new
echo 'Wrote: ' . $xml->save("settings.xml") . ' bytes';
?>