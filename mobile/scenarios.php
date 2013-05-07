<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <?php 
	include(dirname(__FILE__)."/../settings/load_settings.php"); 
	include(dirname(__FILE__)."/../settings/load_switch.php");
	?>                
    <script>
    	$(function() {
        	$('body').on('click', 'div.scenario', function(e){					
            	ID = this.id;
                SCUp = "update";
                $.ajax({
                type: "POST",
                url: "/functions/scenarios_update.php",
                data: {'ID': ID,  'SCUp': SCUp},
                success: function(msge){
                	if(msge = 'success') {
                    	$('#main_div').load('scenarios.php');		
                    }
                }
            });
            return false; });					
        });	
    </script>        
</head>
<body> 		
 	<?php
	$ISCS=0;
	while($ISCS<=$CountSC1) {
		$SCName = "SCSwitch".$ISCS."Name";
		$SCEnabled = "SCSwitch".$ISCS."Enabled";
		$SCActive = "SCSwitch".$ISCS."Active";
		$SCId = "SCSwitch".$ISCS."Id";					
		if ($$SCEnabled == 'true'){ ?>
            <div id="<?php echo $$SCId; ?>" class="ui-tabs ui-widget ui-widget-content ui-corner-all tester scenario">
				<div <?php if ($$SCActive == 'true'){ ?>style="color:#060" <?php } ?> class="scenarios">
                    <?php echo $$SCName; ?>
                </div>
            </div>
            <div style="height:3px;">                
            </div>
            <?php
		};						
		$ISCS++;
	};		
	?>		
</body>
