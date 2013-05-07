//Function update (On/Off) Devices
			var DELAY = 250, clicks = 0, timer = null;	
			$(document).ready(function(){
				$('body').on('click', 'div.deve', function(e){
					clicks++;  //count clicks
					e.preventDefault();
					var element = $(this);
					var Id = element.attr("id");						
					var DevOnId = $("#DevOnId"+Id).val();						
					var DevOnDiv = $("#DevOnDiv"+Id).val();
					var DevDimLevel = "100";
					var DevUpdate = $("#DevUpdate"+Id).val();
					var DevUpdateDim = '0';
					var Devap = $("#Devap"+Id).val();																																				
					var DevOnScenarioDriven = $("#DevOnScenarioDriven"+Id).val();						
					var DevOffScenarioDriven = $("#DevOffScenarioDriven"+Id).val();						
					var Deven = $("#Deven"+Id).val();						
					var DevNameOn = $("#DevNameOn"+Id).val();						
					var Devtab = $("#Devtab"+Id).val();						
					var DevName = $("#DevName"+Id).val();						
					var DevOnScheduleDriven = $("#DevOnScheduleDriven"+Id).val();						
					var DevOffScheduleDriven = $("#DevOffScheduleDriven"+Id).val();						
					var DevOnSemiAuto = $("#DevOnSemiAuto"+Id).val();						
					var DevOffSemiAuto = $("#DevOffSemiAuto"+Id).val();						
					var DevOnScheduleAndRuleDriven = $("#DevOnScheduleAndRuleDriven"+Id).val();						
					var DevOffScheduleAndRuleDriven = $("#DevOffScheduleAndRuleDriven"+Id).val();						
					var DevPicSizeWidth = $("#DevPicSizeWidth"+Id).val();						
					var DevPicSizeHeight = $("#DevPicSizeHeight"+Id).val();						
					var DevCurrentState = $("#DevCurrentState"+Id).val();
					var SupportsAbsoluteDimLvl = $("#SupportsAbsoluteDimLvl"+Id).val();
					var CurrentDimLevel = $("#CurrentDimLevel"+Id).val();
					var DevModeType = $("#DevModeType"+Id).val();							
					if(clicks === 1) {
						if (DevCurrentState == "1"){
							var DevCurrentState = "2";
							var CurrentDimLevel = "100";
						}else if (DevCurrentState == "2"){
							var DevCurrentState = "1";
							var CurrentDimLevel = "0";
						}
            			timer = setTimeout(function() {	
							$.ajax({
								type: "POST",
								url: "devices.php",
								data: {'DevOnId': DevOnId, 'DevOnDiv': DevOnDiv, 'DevUpdate': DevUpdate, 'DevDimLevel': DevDimLevel, 'DevUpdateDim': DevUpdateDim},
								success: function(html){
									e.preventDefault();
									setTimeout(function(){
										if(html = 'success') {
											$('#device'+ Id).fadeOut('fast');																						
											$('#device'+ Id).load('devices_load_mobile.php?Devap='+ Devap +'&DevOnId='+ DevOnId + '&DevOnScenarioDriven='+ DevOnScenarioDriven +'&DevOffScenarioDriven='+ DevOffScenarioDriven +'&Deven='+ Deven +'&DevNameOn='+ DevNameOn +'&Devtab='+ Devtab +'&DevName='+ DevName +'&DevOnScheduleDriven='+ DevOnScheduleDriven +'&DevOffScheduleDriven='+ DevOffScheduleDriven +'&DevOnSemiAuto='+ DevOnSemiAuto +'&DevOffSemiAuto='+ DevOffSemiAuto +'&DevOnScheduleAndRuleDriven='+ DevOnScheduleAndRuleDriven +'&DevOffScheduleAndRuleDriven='+ DevOffScheduleAndRuleDriven +'&DevPicSizeWidth='+ DevPicSizeWidth +'&DevPicSizeHeight='+ DevPicSizeHeight + '&DevCurrentState='+ DevCurrentState + '&SupportsAbsoluteDimLvl='+ SupportsAbsoluteDimLvl + '&CurrentDimLevel='+ CurrentDimLevel + '&DevModeType='+ DevModeType + '&func=device_load').fadeIn('slow');																																											
										}
									}, 1000);
								}
							});							
							clicks = 0;             //after action performed, reset counter 
            			}, DELAY);
        			} else {
						clearTimeout(timer);    //prevent single-click action
						var DevUpdate = "cancelsemiauto";
						var DevModeType = "ScenarioDriven";
						if (DevCurrentState == "1"){
							var DevCurrentState = "2";
							var CurrentDimLevel = "100";
						}else if (DevCurrentState == "2"){
							var DevCurrentState = "1";
							var CurrentDimLevel = "0";
						}
						$.ajax({
							type: "POST",
							url: "devices.php",
							data: {'DevOnId': DevOnId, 'DevOnDiv': DevOnDiv, 'DevUpdate': DevUpdate, 'DevDimLevel': DevDimLevel, 'DevUpdateDim': DevUpdateDim},
							success: function(html){
								e.preventDefault();
								if(html = 'success') {
									$('#device'+ Id).fadeOut('fast');											
									$('#device'+ Id).load('devices_load_mobile.php?Devap='+ Devap +'&DevOnId='+ DevOnId + '&DevOnScenarioDriven='+ DevOnScenarioDriven +'&DevOffScenarioDriven='+ DevOffScenarioDriven +'&Deven='+ Deven +'&DevNameOn='+ DevNameOn +'&Devtab='+ Devtab +'&DevName='+ DevName +'&DevOnScheduleDriven='+ DevOnScheduleDriven +'&DevOffScheduleDriven='+ DevOffScheduleDriven +'&DevOnSemiAuto='+ DevOnSemiAuto +'&DevOffSemiAuto='+ DevOffSemiAuto +'&DevOnScheduleAndRuleDriven='+ DevOnScheduleAndRuleDriven +'&DevOffScheduleAndRuleDriven='+ DevOffScheduleAndRuleDriven +'&DevPicSizeWidth='+ DevPicSizeWidth +'&DevPicSizeHeight='+ DevPicSizeHeight + '&DevCurrentState='+ DevCurrentState + '&SupportsAbsoluteDimLvl='+ SupportsAbsoluteDimLvl + '&CurrentDimLevel='+ CurrentDimLevel + '&DevModeType='+ DevModeType + '&func=device_load');																																
									$('#device'+ Id).fadeIn('slow');	
								}
							}
						});														
						clicks = 0;             //after action performed, reset counter
        			}
    			})
    			.on("dblclick", function(e){
        				e.preventDefault();  //cancel system double-click event
    			return false; });
    										
			//Function Dim device
				$('.dim').on('change',function() {
					alert("hey");
					var element = $(this);
					var Id = element.attr("id");
					var DevDimLevel = $("#DevDimLevel"+Id).val();
					var DevUpdate = $("#DevUpdateDim"+Id).val();																
					var DevOnId = $("#DevOnIdDim"+Id).val();						
					var DevOnDiv = $("#DevOnDiv"+Id).val();
					var Devap = $("#Devap"+Id).val();																																				
					var DevOnScenarioDriven = $("#DevOnScenarioDriven"+Id).val();						
					var DevOffScenarioDriven = $("#DevOffScenarioDriven"+Id).val();						
					var Deven = $("#Deven"+Id).val();						
					var DevNameOn = $("#DevNameOn"+Id).val();						
					var Devtab = $("#DevtabDim"+Id).val();						
					var DevName = $("#DevName"+Id).val();						
					var DevOnScheduleDriven = $("#DevOnScheduleDriven"+Id).val();						
					var DevOffScheduleDriven = $("#DevOffScheduleDriven"+Id).val();						
					var DevOnSemiAuto = $("#DevOnSemiAuto"+Id).val();						
					var DevOffSemiAuto = $("#DevOffSemiAuto"+Id).val();						
					var DevOnScheduleAndRuleDriven = $("#DevOnScheduleAndRuleDriven"+Id).val();						
					var DevOffScheduleAndRuleDriven = $("#DevOffScheduleAndRuleDriven"+Id).val();						
					var DevPicSizeWidth = $("#DevPicSizeWidth"+Id).val();						
					var DevPicSizeHeight = $("#DevPicSizeHeight"+Id).val();						
					var DevCurrentState = $("#DevCurrentState"+Id).val();
					var SupportsAbsoluteDimLvl = $("#SupportsAbsoluteDimLvl"+Id).val();
					var CurrentDimLevel = DevDimLevel;
					var DevModeType = $("#DevModeType"+Id).val();	
					if (DevCurrentState == "1"){
						var DevCurrentState = "2";
					}
					$.ajax({
						type: "POST",
						url: "devices.php",
						data: {'DevOnId': DevOnId, 'DevOnDiv': DevOnDiv, 'DevUpdate': DevUpdate, 'DevDimLevel': DevDimLevel, 'DevUpdate': DevUpdate},
						success: function(html){
							if(html = 'success') {
								$('#device'+ Id).fadeOut('fast');											
								$('#device'+ Id).delay(1000).load('devices_load_mobile.php?Devap='+ Devap +'&DevOnId='+ DevOnId + '&DevOnScenarioDriven='+ DevOnScenarioDriven +'&DevOffScenarioDriven='+ DevOffScenarioDriven +'&Deven='+ Deven +'&DevNameOn='+ DevNameOn +'&Devtab='+ Devtab +'&DevName='+ DevName +'&DevOnScheduleDriven='+ DevOnScheduleDriven +'&DevOffScheduleDriven='+ DevOffScheduleDriven +'&DevOnSemiAuto='+ DevOnSemiAuto +'&DevOffSemiAuto='+ DevOffSemiAuto +'&DevOnScheduleAndRuleDriven='+ DevOnScheduleAndRuleDriven +'&DevOffScheduleAndRuleDriven='+ DevOffScheduleAndRuleDriven +'&DevPicSizeWidth='+ DevPicSizeWidth +'&DevPicSizeHeight='+ DevPicSizeHeight + '&DevCurrentState='+ DevCurrentState + '&SupportsAbsoluteDimLvl='+ SupportsAbsoluteDimLvl + '&CurrentDimLevel='+ CurrentDimLevel + '&DevModeType='+ DevModeType  + '&func=device_load');																																
								$('#device'+ Id).fadeIn('slow');	
							}
						}
					});
				return false; 	});
				
						
			});
			