<?php
		$root = realpath($_SERVER["DOCUMENT_ROOT"]);
		include(dirname(__FILE__)."/../settings/load_settings.php");
?>
<style type="text/css">

            	#devicegroupsmain {
				position: absolute;
				z-index: 70;
				left: <?php echo $DGX ?>px;
				top: <?php echo $DGY ?>px;
				}
</style>