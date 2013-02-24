<?php
		$root = realpath($_SERVER["DOCUMENT_ROOT"]);
		include(dirname(__FILE__)."/../settings/load_settings.php");
?>
<style type="text/css">

<?php
        $SMStyleLoad=0;
			while($SMStyleLoad<=$CountSM)
				{				
				$SSMap = "SM".$SMStyleLoad."Ap";				
				$SSMx = "SM".$SMStyleLoad."x";
				$SSMy = "SM".$SMStyleLoad."y";
				$SSMTab = "SM".$SMStyleLoad."Tab";
				?>
            	#ap<?php echo $$SSMTab ?>DivSM<?php echo $$SSMap ?> {
				position: absolute;
				width: 65px;
				height: 65px;
				z-index: <?php echo $$SMStyleLoad ?>;
				left: <?php echo $$SSMx ?>px;
				top: <?php echo $$SSMy ?>px;
				}
                <?php
				
				$SMStyleLoad++;
				}	?>		


</style>