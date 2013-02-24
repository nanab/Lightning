<!-- V2.0 Copyright Nanab nanab666@gmail.com. -->
	<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php
        include(dirname(__FILE__)."/../settings/load_settings.php");				
        ?>        
        <link rel="stylesheet" href="<?php echo $JqueryCustomCss; ?>" />
        <link rel="stylesheet" href="<?php echo $JqueryCustomCss2; ?>" />
        <style>
			.dgimg { 				
				cursor:pointer;				
			}
			.ui-dialog {
				font-size:12px;
			}            
			.maindg {
				font-size:14px;
				-moz-border-radius: 10px;
				-webkit-border-radius: 10px;
				border-radius: 10px;
				background-color: rgba(255, 255, 255, 0.5);
				border-color: solid 10px rgba(0,0,0,0.2); /*Very transparent black*/
				text-align:right;				
				vertical-align:top;
			}			
        </style>       
        <script>
            $(function() {
                $('.shedule').on('click', function(){
                    ID = this.id;
                    DGUp = "shedule";
                    $.ajax({
                    type: "POST",
                    url: "/functions/devicegroups_update.php",
                    data: {'ID': ID,  'DGUp': DGUp},
                    success: function(msge){
                        if(msge = 'success') {
                            location.reload()                            					
                        }
                    }
                });
            return false; });					
            });	
			$(function() {
                $('.turnon').on('click', function(){
                    ID = this.id;
                    DGUp = "turnon";
                    $.ajax({
                    type: "POST",
                    url: "/functions/devicegroups_update.php",
                    data: {'ID': ID,  'DGUp': DGUp},
                    success: function(msge){
                        if(msge = 'success') {
                            location.reload()                          					
                        }
                    }
                });
            return false; });					
            });	
			$(function() {
                $('.turnoff').on('click', function(){
                    ID = this.id;
                    DGUp = "turnoff";
                    $.ajax({
                    type: "POST",
                    url: "/functions/devicegroups_update.php",
                    data: {'ID': ID,  'DGUp': DGUp},
                    success: function(msge){
                        if(msge = 'success') {
                            location.reload()						
                        }
                    }
                });
            return false; });					
            });
			$(function() {
                $('.sync').on('click', function(){
                    ID = this.id;
                    DGUp = "sync";
                    $.ajax({
                    type: "POST",
                    url: "/functions/devicegroups_update.php",
                    data: {'ID': ID,  'DGUp': DGUp},
                    success: function(msge){
                        if(msge = 'success') {
                            location.reload()					
                        }
                    }
                });
            return false; });					
            });
			$(function() {
                $('.dim').on('click', function(){
					ID = this.id
					var dlg = $("#dialog");
					dlg.dialog( {
    				width: 70,
    				height: dlg.height() + 70,
					resizable: false,
    				});
					$('#dialog').html('<form action="" method="post" STYLE="margin:0; padding:0;"><select class="dimsend" id=' + ID + '><option selected="100%</option><option value="100">100%</option><option value="90">90%</option><option value="80">80%</option><option value="70">70%</option><option value="60">60%</option><option value="50">50%</option><option value="40">40%</option><option value="30">30%</option><option value="20">20%</option><option value="10">10%</option></select></form>');
                    });
                });
				
         $(function() {
                $('.dimsend').on('change',function() {
                    ID = this.id;
					Dim = $(this).val();
                    DGUp = "dim";
                    $.ajax({
                    type: "POST",
                    url: "/functions/devicegroups_update.php",
                    data: {'ID': ID,  'DGUp': DGUp, 'Dim': Dim},
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
	</head>
	<body>
 		<div id="maindg" class="maindg">               
 			<?php
			$IDGS=0;
			while($IDGS<=$CountDG) {
				@$DGName = "DGSwitch".$IDGS."Name";
				$SCId = "DGSwitch".$IDGS."Id";					
				?>  
                <div>                
                	&nbsp;&nbsp;                                               
                    <?php if ($$DGName == ""){
						 $DGName = "Default";
						 echo $DGName;
					}else{
					};
					echo @$$DGName ?>
                    &nbsp;<img src="../images/devicegroups/DeviceAsScheduled_Small.png" id='<?php echo $$SCId; ?>' class="shedule dgimg"/>&nbsp;<img src="../images/devicegroups/DeviceOn_Small.png"id='<?php echo $$SCId; ?>' class="turnon dgimg"/>&nbsp;<img src="../images/devicegroups/DeviceDim_Small.png"id='<?php echo $$SCId; ?>' class="dim dgimg"/>&nbsp;<img src="../images/devicegroups/DeviceOff_Small.png"id='<?php echo $$SCId; ?>' class="turnoff dgimg"/>&nbsp;<img src="../images/devicegroups/Syncronize_Small.png"id='<?php echo $$SCId; ?>' class="sync dgimg"/>
					&nbsp;&nbsp;
                    </div>
                    <?php
				$IDGS++;
			};		
			?>
		</div>
        <div id="dialog" title="Choose dimlevel!">  			
		</div>
	</body>