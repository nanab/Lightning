
//Function for moveable divs.
			function MoveableDivs1(Move1, Move2, Move3) {   
				var $MoveId = Move1
				$('#ap' + Move3 + 'DivDev'+ $MoveId).draggable({ 
					containment: '#main' + Move3, 
					scroll: false
				}).mousemove(function(){
					var coord = $(this).position();
					$("p:last").text( "left: " + coord.left + ", top: " + coord.top );								
				}).mouseup(function(){ 
					var coord = $(this).position();	
					var $left = coord.left;
					var $top = coord.top;
					$.ajax({	
						type: "POST",
						url: "/settings/save_movable_divs.php",
						data: {"left": $left, "top": $top, "id": $MoveId},
						success: function(response){
							$("#respond").html('<div class="success"><center><?php echo $MoveDevices1Lang; ?> ' + Move2 + '<?php echo $MoveDevices2Lang; ?></center></div>').hide().fadeIn(1000);
							setTimeout(function(){ $('#respond').fadeOut(1000); }, 2000);
						}					
					});
				});			
			}
			//Funktion för moveable datasources
			function MoveableDS1(MoveDS1, MoveDS2, MoveDS3) {   
				var $MoveDSId = MoveDS1		
				$('#ap' + MoveDS3 + 'DivDS'+ $MoveDSId).draggable({ 
					containment: '#main' + MoveDS3, 
					scroll: false
				}).mousemove(function(){
					var coord = $(this).position();
					$("p:last").text( "left: " + coord.left + ", top: " + coord.top );								
				}).mouseup(function(){ 
					var coord = $(this).position();	
					var $left = coord.left;
					var $top = coord.top;
					$.ajax({	
						type: "POST",
						url: "/settings/save_movable_ds.php",
						data: {"left": $left, "top": $top, "id": $MoveDSId},
						success: function(response){
							$("#respond").html('<div class="success"><center><?php echo $MoveDS1Lang; ?> ' + MoveDS2 + '<?php echo $MoveDS2Lang; ?></center></div>').hide().fadeIn(1000);
							setTimeout(function(){ $('#respond').fadeOut(1000); }, 2000);
						}	
					});
				});				 	
			}	
			//Funktion för moveable systemlägen
			function MoveableSM1(MoveSM1, MoveSM2, MoveSM3) {   
				var $MoveSMId = MoveSM1		
				$('#ap' + MoveSM3 + 'DivSM'+ $MoveSMId).draggable({ 
					containment: '#main' + MoveSM3, 
					scroll: false
				}).mousemove(function(){
					var coord = $(this).position();
					$("p:last").text( "left: " + coord.left + ", top: " + coord.top );								
				}).mouseup(function(){ 
					var coord = $(this).position();	
					var $left = coord.left;
					var $top = coord.top;
					$.ajax({	
						type: "POST",
						url: "/settings/save_movable_sm.php",
						data: {"left": $left, "top": $top, "id": $MoveSMId},
						success: function(response){
							$("#respond").html('<div class="success"><center><?php echo $MoveSM1Lang; ?> ' + MoveSM2 + '<?php echo $MoveSM2Lang; ?></center></div>').hide().fadeIn(1000);
							setTimeout(function(){ $('#respond').fadeOut(1000); }, 2000);
						}					
					});
				});				 
			}
			//Funktion för moveable scenario
			function MoveableSC(MoveSC1) {   	
				$('#scenariosmain').draggable({ 
					containment: '#main' + MoveSC1, 
					scroll: false
				}).mousemove(function(){
					var coord = $(this).position();
					$("p:last").text( "left: " + coord.left + ", top: " + coord.top );								
				}).mouseup(function(){ 
					var coord = $(this).position();	
					var $left = coord.left;
					var $top = coord.top;
					$.ajax({	
						type: "POST",
						url: "/settings/save_movable_sc.php",
						data: {"left": $left, "top": $top},
						success: function(response){
							$("#respond").html('<div class="success"><center><?php echo $MoveSC1Lang; ?><?php echo $MoveSC2Lang; ?></center></div>').hide().fadeIn(1000);
							setTimeout(function(){ $('#respond').fadeOut(1000); }, 2000);
						}					
					});
				});				 
			}			
			//Funktion för moveable devicegroups
			function MoveableDG(MoveDG1) {   	
				$('#devicegroupsmain').draggable({ 
					containment: '#main' + MoveDG1, 
					scroll: false
				}).mousemove(function(){
					var coord = $(this).position();
					$("p:last").text( "left: " + coord.left + ", top: " + coord.top );								
				}).mouseup(function(){ 
					var coord = $(this).position();	
					var $left = coord.left;
					var $top = coord.top;
					$.ajax({	
						type: "POST",
						url: "/settings/save_movable_dg.php",
						data: {"left": $left, "top": $top},
						success: function(response){
							$("#respond").html('<div class="success"><center><?php echo $MoveDG1Lang; ?><?php echo $MoveDG2Lang; ?></center></div>').hide().fadeIn(1000);
							setTimeout(function(){ $('#respond').fadeOut(1000); }, 2000);
						}					
					});
				});				 
			}
			//Funktion för moveable weather
			
			function MoveableWeather(MoveWeather1) {   	
				$('#weather').draggable({ 
					containment: '#main' + MoveWeather1, 
					scroll: false
				}).mousemove(function(){
					var coord = $(this).position();
					$("p:last").text( "left: " + coord.left + ", top: " + coord.top );								
				}).mouseup(function(){ 
					var coord = $(this).position();	
					var $left = coord.left;
					var $top = coord.top;
					$.ajax({	
						type: "POST",
						url: "/settings/save_movable_weather.php",
						data: {"left": $left, "top": $top},
						success: function(response){
							$("#respond").html('<div class="success"><center><?php echo $MoveWeather1Lang; ?><?php echo $MoveWeather2Lang; ?></center></div>').hide().fadeIn(1000);
							setTimeout(function(){ $('#respond').fadeOut(1000); }, 2000);
						}					
					});
				});				 
			}
		
			//Funktion för moveable Settingsbutton
			function MoveableSettingsButton(MoveSettingsButton1) {   	
				$('#buttonsettings').draggable({ 
					containment: '#main' + MoveSettingsButton1, 
					scroll: false
				}).mousemove(function(){
					var coord = $(this).position();
					$("p:last").text( "left: " + coord.left + ", top: " + coord.top );								
				}).mouseup(function(){ 
					var coord = $(this).position();	
					var $left = coord.left;
					var $top = coord.top;
					$.ajax({	
						type: "POST",
						url: "/settings/save_movable_settings_button.php",
						data: {"left": $left, "top": $top},
						success: function(response){
							$("#respond").html('<div class="success"><center><?php echo $MoveSettingsButton1Lang; ?><?php echo $MoveSettingsButton2Lang; ?></center></div>').hide().fadeIn(1000);
							setTimeout(function(){ $('#respond').fadeOut(1000); }, 2000);
						}					
					});
				});				 
			}
			//Funktion för moveable Refresh button
			function MoveableRefreshButton(MoveRefreshButton1) {   	
				$('#refresh').draggable({ 
					containment: '#main' + MoveRefreshButton1, 
					scroll: false
				}).mousemove(function(){
					var coord = $(this).position();
					$("p:last").text( "left: " + coord.left + ", top: " + coord.top );								
				}).mouseup(function(){ 
					var coord = $(this).position();	
					var $left = coord.left;
					var $top = coord.top;
					$.ajax({	
						type: "POST",
						url: "/settings/save_movable_refresh_button.php",
						data: {"left": $left, "top": $top},
						success: function(response){
							$("#respond").html('<div class="success"><center><?php echo $MoveRefreshButton1Lang; ?><?php echo $MoveRefreshButton2Lang; ?></center></div>').hide().fadeIn(1000);
							setTimeout(function(){ $('#respond').fadeOut(1000); }, 2000);
						}					
					});
				});				 
			}
