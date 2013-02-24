<!-- V2.0 Copyright Nanab nanab666@gmail.com. -->
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php
		@$DSAp = $_GET["DSAp"];
		@$DSId = $_GET["DSId"];
		@$DSSizeX = $_GET["DSSizeX"];
		@$DSSizeY = $_GET["DSSizeY"];
		@$DSEn = $_GET["DSEn"];
		@$DSNameOn = $_GET["DSNameOn"];
		@$DSTab = $_GET["DSTab"];
		@$DSName = $_GET["DSName"];
		@$DSFa = $_GET["DSFa"];
		@$DSMinute = $_GET["DSMinute"];
		if (@$_GET["func"] == "datasources_settings") {
    		datasources_settings($DSAp, $DSId, $DSEn, $DSFa, $DSTab, $DSNameOn, $DSSizeX, $DSSizeY, $DSName, $DSMinute);
    	die();
		}
		function datasources_settings($DSAp, $DSId, $DSEn, $DSFa, $DSTab, $DSNameOn, $DSSizeX, $DSSizeY, $DSName, $DSMinute){
        	include(dirname(__FILE__)."/load_settings.php");	
			//Load language vars
			$DSLang = $XmlLang->settings->datasources->name;
			$DSIdLang = $XmlLang->settings->datasources->id;
			$DSTextLang = $XmlLang->settings->datasources->text;
			$DSShNameLang = $XmlLang->settings->datasources->shname;
			$DSEnLang = $XmlLang->settings->datasources->en;
			$DSTabLang = $XmlLang->settings->datasources->tab;
			$DSGraphLang = $XmlLang->settings->datasources->graph;
			$DSSizeHeightGraphLang = $XmlLang->settings->datasources->sizeheightgraph;
			$DSSizeWidthGraphLang = $XmlLang->settings->datasources->sizewidthgraph;
			$DSMinuteGraphLang = $XmlLang->settings->datasources->minutegraph;
			$SavedLang = $XmlLang->settings->main->saved;
 			$SavebuttonLang = $XmlLang->settings->main->savebutton;
			$BackButtonLang = $XmlLang->settings->main->backbutton; 
			?> 
			<style type="text/css">
				#contentds2 {
					width:450px;	
					-moz-border-radius: 10px;
					-webkit-border-radius: 10px;
					border-radius: 10px;
					border-color: solid 10px rgba(0,0,0,0.2); /*Very transparent black*/
				}
				.borderds2 {
					width:99,5%;
					border:1px solid #CCC;
					border-radius:10px;
					background-color: rgba(255, 255, 255, 0.5);
				}
				.PageBack { 				
					cursor:pointer;				
				}
				#savebutton { 				
					cursor:pointer;				
				}
			</style>
            <script>			
    		$(".PageBack").button().on("click", function(){
				location.reload();
			});
			$("#savebutton").button().on("click", function(){
				$('form#datasources_settings').submit();
			});
			</script>
		</head>
		<body>
        	<div id="contentds2">
        		<div class="borderds2">
        			<center>
        				<div id="PageBack" class="PageBack"><-- <?php echo $BackButtonLang; ?></div>
					</center>			
                </div>
               </div>  
			<div id="contentds2">
				<form id="datasources_settings" name="datasources_settings" method="post" action="/settings/datasources_settings_function.php?Send">
  					<div class="borderds2">
    					<div style="height:65px;">
                            <div style="display:inline-block;">
                            </div>
                            <div style="display:inline-block;">
                                <?php echo $DSLang . "&nbsp;" . $DSAp . "&nbsp;" . $DSName; ?><br>
                                <label for="title"><?php echo $DSIdLang; ?></label><br>
                                <input name="id" type="text" id="id" value="<?php echo $DSId?>" size="20" />
                            </div>
                            <div style="display:inline-block;">
                            </div>
                            <div style="display:inline-block;">
                                <label for="fa"><?php echo $DSTextLang; ?></label><br>
                                <input name="fa" type="text" id="fa" value="<?php echo $DSFa ?>" size="20" />
                            </div>
                        </div>
                        <div style="height:53px; ">
                            <div style="display:inline-block;">
                            </div>
                            <div style="display:inline-block;">
                                <label for="tab"><?php echo $DSTabLang; ?></label><br>
                                <input name="itab" type="text" id="itab" value="<?php echo $DSTab ?>" size="20" />
                            </div>
                            <div style="display:inline-block;">
                            </div>
                        </div>
                        <div style="height:53px;">
                            <div style="display:inline-block;">
                            </div>
                            <div style="display:inline-block;">      
                                <label for="t"><?php echo $DSEnLang; ?></label>
                                <?php if($DSEn == "true"){ ?>	  
                                    <input type="checkbox" name="en" value="yes" checked>
                                <?php }else{ ?>
                                    <input type="checkbox" name="en" value="yes">
                                <?php }; ?>
                            </div>
                            <div style="display:inline-block;">
                            </div>
                            <div style="display:inline-block;">
                                <label for="t2"><?php echo $DSShNameLang; ?></label>
                                    <?php if($DSNameOn == "true"){ ?>	  
                                        <input type="checkbox" name="nameon" value="yes" checked>
                                    <?php }else{ ?>
                                        <input type="checkbox" name="nameon" value="yes">
                                    <?php }; ?>
                            </div>
                        </div>
                    </div>
                    <div class="borderds2">
                    	<div style="height:65px;">
                            <div style="display:inline-block;">
                            </div>
                            <div style="display:inline-block;">
                            	<?php echo $DSGraphLang; ?> <br>     
                                <label for="syg"><?php echo $DSSizeHeightGraphLang; ?></label><br>
                                <input name="syg" type="text" id="syg" value="<?php echo $DSSizeY ?>" size="20" />
                            </div>
                            <div style="display:inline-block;">
                            </div>
                            <div style="display:inline-block;">
                                <label for="sxg"><?php echo $DSSizeWidthGraphLang; ?></label><br>
                                <input name="sxg" type="text" id="sxg" value="<?php echo $DSSizeX ?>" size="20" />
                            </div>
                        </div>
                        <div style="height:65px;">
                            <div style="display:inline-block;">
                            </div>
                            <div style="display:inline-block;">      
                                <label for="minute"><?php echo $DSMinuteGraphLang; ?></label><br>
                                <input name="minute" type="text" id="minute" value="<?php echo $DSMinute ?>" size="20" />
                            </div>
                            <div style="display:inline-block;">
                            </div>
                            <div style="display:inline-block;">                              
                            </div>
                        </div>
                    </div>    
                    <div id="savebutton" class="borderds2 savebutton">
					<center>
					<div style="display:inline-block;">
                    	<input type="hidden" name="ap" id="ap" value="<?php echo $DSAp; ?>" />
                        
						<?php echo $SavebuttonLang; ?>
                        
					</div>
					<div style="display:inline-block;">
					</div>
					<div id="savetabs" class="savetabs"style="display:inline-block;">
					</div>
                    </center>
				</div>    				 				
  				</form>
			</div>
		</body>
		<?php }; ?>
		<?php if(isset($_GET['Send'])) {
			//Load XML and set some config	
			$xmldatasourcesSettings = new DOMDocument('1.0', 'utf-8');
			$xmldatasourcesSettings->formatOutput = true;
			$xmldatasourcesSettings->preserveWhiteSpace = false;
			$xmldatasourcesSettings->load('settings.xml');
			$ap_new = $_POST['ap'];
			$id_new = $_POST['id'];
			@$en_new = $_POST['en'];
			$fa_new = $_POST['fa'];
			$itab_new = $_POST['itab'];
			$sxg_new = $_POST['sxg'];
			$syg_new = $_POST['syg'];
			$minute_new = $_POST['minute'];
			@$nameon_new = $_POST['nameon'];
			if ($en_new == ""){
				$en_new = "false";
			}else{
				$en_new = "true";
			};
			if ($nameon_new == ""){
				$nameon_new = "false";
			}else{
				$nameon_new = "true";
			};	
			//Get item Element
			$datasources =  $xmldatasourcesSettings->getElementsByTagName('datasources')->item(0);
			$datasources1 = $datasources->getElementsByTagName('ds'.$ap_new)->item(0);
			//Load child elements
			$id_orginal = $datasources1->getElementsByTagName('id')->item(0);	
			$en_orginal = $datasources1->getElementsByTagName('en')->item(0);
			$fa_orginal = $datasources1->getElementsByTagName('fa')->item(0);
			$nameon_orginal = $datasources1->getElementsByTagName('nameon')->item(0);
			$itab_orginal = $datasources1->getElementsByTagName('tab')->item(0);
			$sxg_orginal = $datasources1->getElementsByTagName('sizex')->item(0);
			$syg_orginal = $datasources1->getElementsByTagName('sizey')->item(0);
			$minute_orginal = $datasources1->getElementsByTagName('minute')->item(0);
			//Change values
			$id_orginal->nodeValue = $id_new;
			$en_orginal->nodeValue = $en_new;
			$fa_orginal->nodeValue = $fa_new;
			$nameon_orginal->nodeValue = $nameon_new;
			$itab_orginal->nodeValue = $itab_new;
			$sxg_orginal->nodeValue = $sxg_new;
			$syg_orginal->nodeValue = $syg_new;
			$minute_orginal->nodeValue = $minute_new;
			//Replace old elements with new
			$xmldatasourcesSettings->save("settings.xml");
			?>
			<script language="JavaScript" type="text/JavaScript">
			<!--
				window.location.href = "datasources_settings.php";
			//-->
			</script>					  
			<?php
		};
		if(@$_POST['send4'] == "send4") {
			//Load XML and set some config	
			$xmldatasourcesSettings = new DOMDocument('1.0', 'utf-8');
			$xmldatasourcesSettings->formatOutput = true;
			$xmldatasourcesSettings->preserveWhiteSpace = false;
			$xmldatasourcesSettings->load('settings.xml');
			@$ap_new = $_POST['DSAp'];
			@$en_new = $_POST['DSEn'];
			//Get item Element
			$datasources =  $xmldatasourcesSettings->getElementsByTagName('datasources')->item(0);
			$datasources1 = $datasources->getElementsByTagName('ds'.$ap_new)->item(0);
			//Load child elements
			$en_orginal = $datasources1->getElementsByTagName('en')->item(0);
			//Change values
			$en_orginal->nodeValue = $en_new;
			//Replace old elements with new
			$xmldatasourcesSettings->save("settings.xml");
			echo "success";	
		};
		?>
</html>