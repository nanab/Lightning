<!-- V2.0 Copyright Nanab nanab666@gmail.com. -->
<?php
$left = $_POST['left'];
$top = $_POST['top'];
$id = $_POST['id'];
//Load XML and set some config
$xml = new DOMDocument('1.0', 'utf-8');
$xml->formatOutput = true;
$xml->preserveWhiteSpace = false;
$xml->load('settings.xml');
//Get item Element
$devmove = $xml->getElementsByTagName('dev'.$id)->item(0);
//Load child elements
$x = $devmove->getElementsByTagName('x')->item(0);
$y = $devmove->getElementsByTagName('y')->item(0);
//Change values
$x->nodeValue = $left;
$y->nodeValue = $top;
//Replace old elements with new
echo 'Wrote: ' . $xml->save("settings.xml") . ' bytes';
?>