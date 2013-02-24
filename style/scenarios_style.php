<?php
		$root = realpath($_SERVER["DOCUMENT_ROOT"]);
		include(dirname(__FILE__)."/../settings/load_settings.php");
?>
<style type="text/css">
            	#scenariosmain {
				position: absolute;
				z-index: 1;
				left: <?php echo $SCX ?>px;
				top: <?php echo $SCY ?>px;
				}
</style>