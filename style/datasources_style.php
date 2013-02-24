<?php
	$root = realpath($_SERVER["DOCUMENT_ROOT"]);
	include(dirname(__FILE__)."/../settings/load_settings.php");
?>
<style type="text/css">
	<?php
    $DSStyleLoad=0;
	while($DSStyleLoad<=$CountDS){				
		$SDSAp = "DS".$DSStyleLoad."Ap";				
		$SDSTab = "DS".$DSStyleLoad."Tab";
		$SDSEn = "DS".$DSStyleLoad."En";
		$SDSx = "DS".$DSStyleLoad."x";
		$SDSy = "DS".$DSStyleLoad."y";
		if ($$SDSEn == "true"){
			?>				
			#ap<?php echo $$SDSTab ?>DivDS<?php echo $$SDSAp ?> {
				position: absolute;				
				z-index: <?php echo $$DSStyleLoad ?>;
				left: <?php echo $$SDSx ?>px;
				top: <?php echo $$SDSy ?>px;
				-moz-border-radius: 10px;
				-webkit-border-radius: 10px;
				border-radius: 10px;
				background-color: rgba(255, 255, 255, 0.5);
				border-color: solid 10px rgba(0,0,0,0.2); /*Very transparent black*/
			}
            <?php
		}
		$DSStyleLoad++;
	} ?>		
	.datasource { 				
		cursor:pointer;				
	}
</style>