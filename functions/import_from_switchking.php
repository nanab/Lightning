<?php
include("./settings/load_settings.php");
function sortxml( $xmlfile, $sortby, $type = 'number', $order = 'ascending', $child ) {
    $xp = new XSLTProcessor();
    $xsl = new DomDocument;
    $xsl->load("./functions/sortxml.xsl");
    $xp->importStylesheet($xsl);
    $xml_doc = new DomDocument;
    $xml_doc->load($xmlfile);
    $xp->setParameter('', 'sortby', $sortby);
    $xp->setParameter('', 'type', $type);
    $xp->setParameter('', 'order', $order);
    $xp->setParameter('', 'child', $child);
    $sorted = $xp->transformToXML($xml_doc);
    $fh = fopen($xmlfile, 'w') or die("can't open file");
    fwrite($fh, $sorted);
    fclose($fh);
	unset($xsl);
};
function importtoxml($file, $xmladd, $First){
	$xml2 = simplexml_load_file($xmladd);
	$fh = fopen($file, 'w') or die("can't open file");
	$FirstRow = '<?xml version="1.0" encoding="UTF-8"?>';
	fwrite($fh, $FirstRow."\n");
	$FirstRow2 = '<' . $First . '>';
	fwrite($fh, $FirstRow2."\n");
	foreach($xml2->children() as $child) {
		$SecondRow = '	<' . $child->getName(). '>';
		fwrite($fh, $SecondRow."\n");
		if($child->count()>1) {
			// loops through the child node, prints the name and the content of each $child2
			foreach($child as $child2) {
				$ThirdRow = '		<' .$child2->getName(). '>'. $child2. '</' .$child2->getName(). '>';
				fwrite($fh, $ThirdRow."\n");
			}
			$FourthRow = '	</' . $child->getName(). '>'; 
			fwrite($fh, $FourthRow."\n");
		}
	}
	$LastRow = '</' . $First . '>';
	fwrite($fh, $LastRow."\n");
	fclose($fh);
	unset($xml2);
};
?>