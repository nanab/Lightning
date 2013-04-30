<?php
		$root = realpath($_SERVER["DOCUMENT_ROOT"]);
		include(dirname(__FILE__)."/../settings/load_settings.php");
?>
<style type="text/css">
	#divname {	
		color:<?php echo $TextColorWidgets; ?>;		
		-moz-border-radius: 10px;
		-webkit-border-radius: 10px;
		border-radius: 10px;
		background-color: rgba(<?php echo $BackgroundColorWidgets; ?>, <?php echo $DeviceTransparent; ?>);
		border-color: solid 10px rgba(0,0,0,0.2); /*Very transparent black*/
	}
	
	<?php
	$DevStyleLoad=0;
	while($DevStyleLoad<=$CountDevs)
	{				
		$SDevap = "Dev".$DevStyleLoad."ap";				
		$SDevx = "Dev".$DevStyleLoad."x";
		$SDevy = "Dev".$DevStyleLoad."y";
		$SDevTab = "Dev".$DevStyleLoad."tab";
		?>
		#ap<?php echo $$SDevTab ?>DivDev<?php echo $$SDevap ?> {
			position: absolute;
			z-index: <?php echo $$DevStyleLoad ?>;
			left: <?php echo $$SDevx ?>px;
			top: <?php echo $$SDevy ?>px;
		}					
		<?php					
		$DevStyleLoad++;
	}
	?>					
</style>