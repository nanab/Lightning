<!-- V2.0 Copyright Nanab nanab666@gmail.com. -->
<?php 
function first_time(){
	include(dirname(__FILE__)."/../settings/load_settings.php");
	$FirstLang = $XmlLang->firsttime->first;
	echo $FirstLang; ?><br><?php		
	include(dirname(__FILE__)."/../settings/main_settings.php");		
};
function second_time(){
	@include_once(dirname(__FILE__)."/import_from_switchking.php");
	@importtoxml(dirname(__FILE__)."/../settings/tempfiles/devices.xml", "http://$User:$Pass@$Ip:$Port/$funcdev", "Devices");
	@importtoxml(dirname(__FILE__)."/../settings/tempfiles/systemmodes.xml", "http://$User:$Pass@$Ip:$Port/$FuncSysm", "Systemmodes");
	@importtoxml(dirname(__FILE__)."/../settings/tempfiles/scenarios.xml", "http://$User:$Pass@$Ip:$Port/$FuncSC", "Scenarios");
	@importtoxml(dirname(__FILE__)."/../settings/tempfiles/devicegroups.xml", "http://$User:$Pass@$Ip:$Port/$FuncDG", "Devicegroups");
	@importtoxml(dirname(__FILE__)."/../settings/tempfiles/datasources.xml", "http://$User:$Pass@$Ip:$Port/$FuncDS", "Datasources");
	@sortxml(dirname(__FILE__)."/../settings/tempfiles/devices.xml", 'ID', 'number', 'ascending', 'RESTDevice' );
	$xmlMainSettings = new DOMDocument('1.0', 'utf-8');
	$xmlMainSettings->formatOutput = true;
	$xmlMainSettings->preserveWhiteSpace = false;
	$xmlMainSettings->load(dirname(__FILE__)."/../settings/settings.xml");
	$first_new = "false";
	$main =  $xmlMainSettings->getElementsByTagName('main')->item(0);
	$first_orginal = $main->getElementsByTagName('first')->item(0);
	$first_orginal->nodeValue = $first_new;
	?>
	<script>
		<?php 
		if ($First == "second"){ 
			$xmlMainSettings->save(dirname(__FILE__)."/../settings/settings.xml"); ?>
			$(document).ready(function(){
				location.reload()
			});
			<?php 
		};
		?>
	</script>
	<?php
};
?>