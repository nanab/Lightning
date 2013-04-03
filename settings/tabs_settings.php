<!-- V2.0 Copyright Nanab nanab666@gmail.com. -->
<html>
	<head>
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php
        include(dirname(__FILE__)."/load_settings.php");
        ?>
        <script src="<?php echo $Jquery; ?>"></script>
		<script src="<?php echo $JqueryCustom; ?>"></script> 
		<link rel="stylesheet" href="<?php echo $JqueryCustomCss; ?>" /> 
        <style type="text/css">
		.button { 				
					cursor:pointer;				
				}
        </style>
        <script>		
			var DELAY = 250, clicks = 0, timer = null;
			$(document).ready(function() {
				$(".button").button().on("click", function(e){				
					clicks++;  //count clicks
					var element = $(this);
					var Id = element.attr("id");
					var TabEn = $("#TabEn"+Id).val();													
					var TabName = $("#TabName"+Id).val();						
					var TabPage = $("#TabPage"+Id).val(); 						
					var TabBakPic = $("#TabBakPic"+Id).val();												
					var TabBakPicHeight = $("#TabBakPicHeight"+Id).val();						
					var TabBakPicWidth = $("#TabBakPicWidth"+Id).val();						
					var TabId = $("#TabId"+Id).val();										
					if(clicks === 1) {
						timer = setTimeout(function() {
								$('.contentdev3').hide();										
							$("#contenttabstest").load('<?php echo $Catalog; ?>tabs_settings_function.php?TabEn='+ TabEn +'&TabName='+ TabName +'&TabPage='+ TabPage +'&TabBakPic='+ TabBakPic +'&TabBakPicHeight='+ TabBakPicHeight +'&TabBakPicWidth='+ TabBakPicWidth +'&TabId='+ TabId +'&func=tabs_settings') 
							clicks = 0;             //after action performed, reset counter
						}, DELAY);
					} else {
						clearTimeout(timer);    //prevent single-click action
						var send4 = "send4";
						if (TabEn == "true"){
							var TabEn = "false";
						}else if (TabEn == "false"){
							var TabEn = "true";
						}
						$.ajax({
								type: "POST",
								url: "<?php echo $Catalog; ?>tabs_settings_function.php",
								data: {'TabId': TabId, 'TabEn': TabEn, 'send4': send4},
								success: function(msge){
									if(msge = 'success') {
										location.reload()
									}
								}
							});
						clicks = 0;             //after action performed, reset counter
					}	
				})
				.on("dblclick", function(e){
					e.preventDefault();  //cancel system double-click event
				});
			});		
		</script>
	</head>
	<body>
		<div id="contenttabstest">
		</div>
		<?php
		$TabSettLoad=1;
		while($TabSettLoad<=$TabNumbers) {				
			$TabEn = "Tab".$TabSettLoad."En";
			$TabName = "Tab".$TabSettLoad."Name";
			$TabPage = "Tab".$TabSettLoad."Page";
			$TabBakPic = "Tab".$TabSettLoad."BakPic";
			$TabBakPicHeight = "Tab".$TabSettLoad."BakPicHeight";
			$TabBakPicWidth = "Tab".$TabSettLoad."BakPicWidth";
			$TabId = "Tab".$TabSettLoad."Id";
			$TabNameVar = str_replace(' ', '%20', $$TabName);
			if ($TabSettLoad % 2 == 0) { 
				$Div = '<div id="varannan">';
				$Divstop = "";
				$Br = "";			
			}else{			
				$Divstop = "</div>";
				$Div = "";
				$Br = "<br>";			 	
			}
			echo $Div;
			?>           
			<div id="contentdev3" class="contentdev3" style="display:inline-block; width:255;">					                       
				<input type="hidden" id="TabName<?php echo $TabSettLoad; ?>" value="<?php echo $TabNameVar; ?>" />
				<input type="hidden" id="TabPage<?php echo $TabSettLoad; ?>" value="<?php echo $$TabPage; ?>" />	     												
				<input type="hidden" id="TabBakPic<?php echo $TabSettLoad; ?>" value="<?php echo $$TabBakPic; ?>" /> 						
				<input type="hidden" id="TabBakPicHeight<?php echo $TabSettLoad; ?>" value="<?php echo $$TabBakPicHeight; ?>" />						
				<input type="hidden" id="TabBakPicWidth<?php echo $TabSettLoad; ?>" value="<?php echo $$TabBakPicWidth; ?>" />						
				<input type="hidden" id="TabId<?php echo $TabSettLoad; ?>" value="<?php echo $$TabId; ?>" />						
				<input type="hidden" id="TabEn<?php echo $TabSettLoad; ?>" value="<?php echo $$TabEn; ?>" />						                     
				<input class="button" name="<?php echo $$TabName; ?>" type="button" value="<?php echo $$TabName; ?>" id="<?php echo $TabSettLoad; ?>"
				<?php 
				if ($$TabEn == "true"){
					?> 
					style="width:250;" 
					<?php
				}else{
					?> 
					style="color:Red;width:250;" 
					<?php
				}; ?>
				>				
			</div>			
			<?php
			echo $Divstop;
			echo $Br;						
			$TabSettLoad++;
		} ?>	
	</body>
</html>