<!-- V2.0 Copyright Nanab nanab666@gmail.com. -->
<?php 
function first_time(){
	include("./settings/load_settings.php");
	$FirstLang = $XmlLang->firsttime->first;
	echo $FirstLang; ?><br><?php		
	include("./settings/main_settings.php");		
};
function second_time(){
	include("./settings/load_settings.php");
	$testconnection = file_get_contents("http://$User:$Pass@$Ip:$Port/$funcdev");
	if($testconnection === FALSE) {
		echo "Can't connect to switchking server please check your connection info";
		include("./settings/main_settings.php");
		die();
	}else{
	@include_once("import_from_switchking.php");
	@importtoxml("./settings/tempfiles/devices.xml", "http://$User:$Pass@$Ip:$Port/$funcdev", "Devices");
	@importtoxml("./settings/tempfiles/systemmodes.xml", "http://$User:$Pass@$Ip:$Port/$FuncSysm", "Systemmodes");
	@importtoxml("./settings/tempfiles/scenarios.xml", "http://$User:$Pass@$Ip:$Port/$FuncSC", "Scenarios");
	@importtoxml("./settings/tempfiles/devicegroups.xml", "http://$User:$Pass@$Ip:$Port/$FuncDG", "Devicegroups");
	@importtoxml("./settings/tempfiles/datasources.xml", "http://$User:$Pass@$Ip:$Port/$FuncDS", "Datasources");
	@sortxml("./settings/tempfiles/devices.xml", 'ID', 'number', 'ascending', 'RESTDevice' );
	$xmlMainSettings = new DOMDocument('1.0', 'utf-8');
	$xmlMainSettings->formatOutput = true;
	$xmlMainSettings->preserveWhiteSpace = false;
	$xmlMainSettings->load("./settings/settings.xml");
	$first_new = "false";
	$main =  $xmlMainSettings->getElementsByTagName('main')->item(0);
	$first_orginal = $main->getElementsByTagName('first')->item(0);
	$first_orginal->nodeValue = $first_new;
	?>
	<script>
		<?php 
		if ($First == "second"){ 
			$xmlMainSettings->save("./settings/settings.xml"); ?>
				window.location.href = "../index.php";					
			<?php 
		};
		?>
	</script>
	<?php
	}
};
?>