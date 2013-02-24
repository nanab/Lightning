<!-- V1.9 Copyright Nanab nanab666@gmail.com. -->
<html>
	<head>
    <!-- 
    	TODO before V2.0. 
    	Fix function to check if writable 
        Function to upgrade settings.xml
    -->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- <meta name="apple-mobile-web-app-capable" content="yes" /> -->
	<?php
	//Include settings file
	include(dirname(__FILE__)."/settings/load_settings.php");
	//Load language variables
	//$DirCheckLang = $XmlLang->main->dircheck;
	//$WriteFileCheckLang = $XmlLang->main->writefilecheck;
	//Kolla om tempfiles foldern är skrivbar annars stoppa.
	/*$tempdir_test = "../settings/tempfiles";
	echo $tempdir_test;
	if (is_writable($tempdir_test)) {
	} else {
    echo $DirCheckLang;
		exit;
	}
	//Kolla om settings.xml är skrivbar annars stoppa.
	$settingsfile_test = dirname(__FILE__)."\settings\settings.xml";
	if (is_writable($settingsfile_test)) {
	} else {
    echo $WriteFileCheckLang;
		exit;
	}*/		
	//If first time call first function so user can fill in connection info
	if ($First == "true"){		
		include(dirname(__FILE__)."/functions/first_time.php");
		first_time();
	//after connection info is done start import tempfiles xml files from switchking
	}else if ($First == "second"){
		include(dirname(__FILE__)."/functions/first_time.php");
		second_time();
	//First stage done check version of settingsfile. Upgrade if older.
	}else if ($VersionXml < $Version){
		include(dirname(__FILE__)."/functions/upgrade.php"); 
		upgrade($Version, $VersionXml);
	//Start importing devices, systemmodes and datasources
	}else{?>
    	<?php
		//Check if all devices is imported if not import them	
    	if ($CountDevs > $DevNumbers) {	
        	include(dirname(__FILE__)."/functions/import_to_lightning.php");
			index_import_devices();
		//Check if all systemmodes is imported if not import them		
		}else if($CountSM > $SMNumbers){
			include(dirname(__FILE__)."/functions/import_to_lightning.php");
			index_import_systemmodes();
		//Check if all datasources is imported if not import them
		}else if($CountDS1 > $DSNumbers){
			include(dirname(__FILE__)."/functions/import_to_lightning.php");
			index_import_datasources();			
			//All imported start lodaing page
		}else{			
			?>
            <title><?php echo $MainTitle ?></title>
            <script src="<?php echo $Jquery; ?>"></script>
   			<script src="<?php echo $JqueryCustom; ?>"></script> 
    		<link rel="stylesheet" href="<?php echo $JqueryCustomCss; ?>" />
            <link rel="stylesheet" href="<?php echo $JqueryCustomCss2; ?>" />
    		<style type="text/css">
				.buttonhidemenubar { 
					background:gray;
					cursor:pointer;		
					height:5px; 
    				width: 50%;
    				margin: 0px auto;
					-moz-border-radius-bottomright: 6px; -webkit-border-bottom-right-radius: 6px; -khtml-border-bottom-right-radius: 6px; border-bottom-right-radius: 6px;
					-moz-border-radius-bottomleft: 6px; -webkit-border-bottom-left-radius: 6px; -khtml-border-bottom-left-radius: 6px; border-bottom-left-radius: 6px;
				}							​
			</style>
    		<script>
				<!-- Dunction loading tabs-->
				$(function() {
					$( "#tabs" ).tabs({				
						beforeLoad: function( event, ui ) {					
							ui.jqXHR.error(function() {
								ui.panel.html("Something went wrong call 911!!!" );
							});					
						}
					});								
				});	
				//Function to hide tabb bar.
				$(function() {
        			function runEffect() {
						var selectedEffect = 'slide';
		 				var options = {direction: "up"};
						var attr = $("div.menubar").attr('style');
    					if (typeof attr == 'undefined' ) {				            
            				$( "div.menubar" ).hide( selectedEffect, options, 300 );					
						}
         				else if ($("div.menubar").is(':visible')){				
							$( "div.menubar" ).hide( selectedEffect, options, 300 );
		 				}
		 				else{
							$( "div.menubar" ).removeAttr( "style" ).hide().fadeIn();
		 				}          			
       				};		        
        			// set effect from select menu value
					$( "div.buttonhidemenubar" ).click(function() {
						runEffect();
            			return false;
        			});		
    			});		
				//If $HideTab ais active hide tabbar from start.
				<?php if ($HideTab == "true"){ ?>
					$(document).ready(function(){
						$( "div.menubar" ).hide();
					});
				<?php } ?>
    		</script>	 
		</head>        
        <?php 
		//set size for page based on bakground picture.
		$FTabBakPicWidth = $Tab1BakPicWidth;
		//add som more pixels to the page size to look better behind backgroundpicture
		$FTabBakPicWidth12 = $FTabBakPicWidth + $SizeX + 10;				
		 ?>
		<body style="width:<?php echo $FTabBakPicWidth12; ?>;">
			<div id="tabs">
    			<div id"menubar" class="menubar">
					<ul>
						<?php
                        $FTabLoadName=1;
                        while($FTabLoadName<=$TabNumbers) {
                            $FTabEnName = "Tab".$FTabLoadName."En";
                            $FTabIdName = $FTabLoadName;
                            $FTabName = "Tab".$FTabLoadName."Name";				
                            if ($$FTabEnName == "true"){?>
                                <li>
                                    <a href="#tabs-<?php echo $FTabIdName; ?>">
                                        <?php echo $$FTabName; ?>
                                    </a>
                                </li>
                            	<?php
                            }
                            $FTabLoadName++;
                        }	?>	
					</ul>
       			</div>
       			<?php if ($HideTabButton == "true") { ?>
       				<div class="buttonhidemenubar">
       				</div>
       				<?php
	   			};
        		$FTabLoad=1;
				while($FTabLoad<=$TabNumbers) {
					$FTabEn = "Tab".$FTabLoad."En";
					$FTabId = $FTabLoad;
					$FTabPage = "Tab".$FTabLoad."Page";
					$FTabBakPicWidth = "Tab".$FTabLoad."BakPicWidth";
					$FTabBakPicHeight = "Tab".$FTabLoad."BakPicHeight";
					$FTabBakPicWidth1 = $$FTabBakPicWidth + $SizeX;
					$FTabBakPicHeight1 =  $$FTabBakPicHeight + $SizeY;
					if ($$FTabEn == "true"){?>
                		<div id="tabs-<?php echo $FTabId; ?>" style="border:0px;outline:none";>
							<iframe src="<?php echo $$FTabPage; ?>" style=" border-width:0 " width="<?php echo $FTabBakPicWidth1; ?>" height="<?php echo $FTabBakPicHeight1; ?>" frameborder="0" scrolling="no"></iframe>
						</div>
                		<?php
					}
					$FTabLoad++;
				} ?>	               
			</div>  
		</body>
		<?php 
		}; 
	}?>
</html>