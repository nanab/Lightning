<!-- V2.0 Copyright Nanab nanab666@gmail.com. -->
	<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php
        $root = realpath($_SERVER["DOCUMENT_ROOT"]);
        include(dirname(__FILE__)."/../settings/load_settings.php");		
        ?>                
        <script>
            $(function() {
                $( "#menu" ).menu();
                $('li','ul#menu').on('click', function(){
                    ID = this.id;
                    SCUp = "update";
                    $.ajax({
                    type: "POST",
                    url: "/functions/scenarios_update.php",
                    data: {'ID': ID,  'SCUp': SCUp},
                    success: function(msge){
                        if(msge = 'success') {
                            //$('#menu').fadeOut('fast');
                            location.reload()
                            //$('#menu').delay(1000).load('/functions/scenarios_load.php');
                            //$('#menu').delay(1000).fadeIn('slow');						
                        }
                    }
                });
            return false; });					
            });	
        </script>
        <style>
            .ui-menu-item { 
				font-size: <?php echo $SCFontSize; ?>px; background:#<?php echo $SCBackColor; ?>;
			}
            .ui-menu .ui-state-disabled a  {
				color: #6F0;
			}
        </style>
	</head>
	<body>
 		<ul id="menu">
 			<?php
			$ISCS=0;
			while($ISCS<=$CountSC1) {
				$SCName = "SCSwitch".$ISCS."Name";
				$SCEnabled = "SCSwitch".$ISCS."Enabled";
				$SCActive = "SCSwitch".$ISCS."Active";
				$SCId = "SCSwitch".$ISCS."Id";					
				?>                    
                    <li <?php if ($$SCActive == 'true'){ ?> class="ui-state-disabled" <?php }?> id='<?php echo $$SCId; ?>'>
						<?php 
						if ($$SCEnabled == 'true'){ ?>
							<a href="#"><?php echo $$SCName; ?></a></li>
                   		<?php
						};
				$ISCS++;
			};		
			?>
		 </ul>
	</body>
