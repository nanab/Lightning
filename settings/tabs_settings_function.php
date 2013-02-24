<!-- V2.0 Copyright Nanab nanab666@gmail.com. -->
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<?php
		@$TabEn = $_GET["TabEn"];
		@$TabName = $_GET["TabName"];
		@$TabPage = $_GET["TabPage"];
		@$TabBakPic = $_GET["TabBakPic"];
		@$TabBakPicHeight = $_GET["TabBakPicHeight"];
		@$TabBakPicWidth = $_GET["TabBakPicWidth"];
		@$TabId = $_GET["TabID"];
		if (@$_GET["func"] == "tabs_settings") {
    		tabs_settings($TabEn, $TabName, $TabPage, $TabBakPic, $TabBakPicHeight, $TabBakPicWidth , $TabId);
    	die();
		}
		
		function tabs_settings($TabEn, $TabName, $TabPage, $TabBakPic, $TabBakPicHeight, $TabBakPicWidth , $TabId){ 
        	include(dirname(__FILE__)."/load_settings.php");			
			//Load language vars
			$TabLang = $XmlLang->settings->tabs->tab;
			$TabIdLang = $XmlLang->settings->tabs->id;
			$TabNameLang = $XmlLang->settings->tabs->name;
			$TabFileLang = $XmlLang->settings->tabs->fileb;
			$TabPicLang = $XmlLang->settings->tabs->pic;
			$TabSizeHeightLang = $XmlLang->settings->tabs->height;
			$TabSizeWidthLang = $XmlLang->settings->tabs->width;
			$TabActiveLang = $XmlLang->settings->tabs->en;
			$SavedLang = $XmlLang->settings->main->saved;
 			$SavebuttonLang = $XmlLang->settings->main->savebutton;
			$BackButtonLang = $XmlLang->settings->main->backbutton;
			?>	
			<style type="text/css">
				#contenttabs {
					width:450px;	
					-moz-border-radius: 10px;
					-webkit-border-radius: 10px;
					border-radius: 10px;
					border-color: solid 10px rgba(0,0,0,0.2); /*Very transparent black*/
				}
				.borderdiv {
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
					$('form#tabs_settings').submit();
				});
			</script>
		</head>
		<body>
			<div id="contenttabs">
				<div class="borderdiv">
					<center>
						<div id="PageBack" class="PageBack"><-- <?php echo $BackButtonLang; ?></div>
					</center>			
                </div>
            </div> 
			<div id="contenttabs">
				<form id="tabs_settings" name="tabs_settings" method="post" action="/settings/tabs_settings_function.php?Send">
					<div class="borderdiv">
						<div style="height:20px;">
							<div style="display:inline-block;">
							</div>
							<div style="display:inline-block;">
								<?php echo $TabLang . $TabId ?>   		  					
							</div>
							<div style="display:inline-block;">
							</div>
							<div style="display:inline-block;">      						
							</div>
						</div>
						<div style="height:53px;">
							<div style="display:inline-block;">
							</div>
							<div style="display:inline-block;">
								
								<label for="id"><?php echo $TabIdLang; ?></label><br />
								<input name="id" type="text" id="id" value="<?php echo $TabId ?>" size="20" />
							</div>
							<div style="display:inline-block;">
							</div>
							<div style="display:inline-block;">
								<label for="name"><?php echo $TabNameLang; ?></label><br />
								<input name="name" type="text" id="name" value="<?php echo $TabName ?>" size="20" />
							</div>
						</div>    
						<div style="height:53px;">
							<div style="display:inline-block;">
							</div>
							<div style="display:inline-block;">
								<label for="pic"><?php echo $TabPicLang; ?></label><br />
                                <?php
                    			echo "<select name='pic' id='pic'>";
								echo "<option value='$TabBakPic'>$TabBakPic</option>";
								$files = array_map("htmlspecialchars", scandir(dirname(__FILE__)."/../images/"));
								foreach ($files as $file)
								if ($file == "."){
								}else if ($file == ".."){
								}else if ($file == $TabBakPic){
								}else{
								echo "<option value='$file'>$file</option>";
								}
								echo "</select>";
								?>
							</div>
							<div style="display:inline-block;">
							</div>
							<div style="display:inline-block;">							
                                <label for="page"><?php echo $TabFileLang; ?></label><br />
								<input name="page" type="text" id="page" value="<?php echo $TabPage ?>" size="20" />
							</div>
						</div>
						<div style="height:53px;">
							<div style="display:inline-block;">
							</div>
							<div style="display:inline-block;">
								<label for="height"><?php echo $TabSizeHeightLang; ?></label><br />
								<input name="height" type="text" id="height" value="<?php echo $TabBakPicHeight ?>" size="20" />
							</div>
							<div style="display:inline-block;">
							</div>
							<div style="display:inline-block;">
								<label for="width"><?php echo $TabSizeWidthLang; ?></label><br />
								<input name="width" type="text" id="width" value="<?php echo $TabBakPicWidth?>" size="20" />
							</div>
						</div>
						<div style="height:53px;">
							<div style="display:inline-block;">
							</div>
							<div style="display:inline-block;">
								<label for="aktiv"><?php echo $TabActiveLang; ?></label><br />
								<?php if($TabEn == "true"){ ?>	  
									<input type="checkbox" name="en" value="yes" checked>
								<?php }else{ ?>
									<input type="checkbox" name="en" value="yes">      
								<?php }; ?>
							</div>
							</div>
							<div style="display:inline-block;">
							</div>
							<div style="display:inline-block;">
								
						</div>
					</div>
					<div id="savebutton" class="borderdiv savebutton">
						<center>
							<div style="display:inline-block;">                      
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
			<br>
		</body>
	<?php }; ?>
	<?php if(isset($_GET['Send'])) {
		//Load XML and set some config	
		$xmltabsSettings = new DOMDocument('1.0', 'utf-8');
		$xmltabsSettings->formatOutput = true;
		$xmltabsSettings->preserveWhiteSpace = false;
		$xmltabsSettings->load('settings.xml');
		$id_new = $_POST['id'];
		$name_new = $_POST['name'];
		$page_new = $_POST['page'];
		$pic_new = $_POST['pic'];
		$height_new = $_POST['height'];
		$width_new = $_POST['width'];
		@$en_new =  $_POST['en'];
		if ($en_new == ""){
			 $en_new = "false";
			}else{
			$en_new = "true";
		};		
		//Get item Element
		$tabs =  $xmltabsSettings->getElementsByTagName('tabs')->item(0);
		$tabs1 = $tabs->getElementsByTagName('tab'.$id_new)->item(0);
		//Load child elements
		$id_orginal = $tabs1->getElementsByTagName('id')->item(0);
		$en_orginal = $tabs1->getElementsByTagName('en')->item(0);
		$name_orginal = $tabs1->getElementsByTagName('name')->item(0);
		$page_orginal = $tabs1->getElementsByTagName('page')->item(0);
		$pic_orginal = $tabs1->getElementsByTagName('bakpic')->item(0);
		$height_orginal = $tabs1->getElementsByTagName('bakpicheight')->item(0);
		$width_orginal = $tabs1->getElementsByTagName('bakpicwidth')->item(0);
		//Change values
		$id_orginal->nodeValue = $id_new;
		$en_orginal->nodeValue = $en_new;
		$name_orginal->nodeValue = $name_new;
		$page_orginal->nodeValue = $page_new;
		$pic_orginal->nodeValue = $pic_new;
		$height_orginal->nodeValue = $height_new;
		$width_orginal->nodeValue = $width_new;
		//Replace old elements with new
		$xmltabsSettings->save("settings.xml");
			?>
			<script language="JavaScript" type="text/JavaScript">
			<!--
				window.location.href = "tabs_settings.php";
			//-->
			</script>
	<?php
	};
	if(@$_POST['send4'] == "send4") {
		//Load XML and set some config	
		$xmlTabsSettings = new DOMDocument('1.0', 'utf-8');
		$xmlTabsSettings->formatOutput = true;
		$xmlTabsSettings->preserveWhiteSpace = false;
		$xmlTabsSettings->load('settings.xml');
		@$id_new = $_POST['TabId'];
		@$en_new = $_POST['TabEn'];
		//Get item Element
		$Tabs =  $xmlTabsSettings->getElementsByTagName('tabs')->item(0);
		$Tabs1 = $Tabs->getElementsByTagName('tab'.$id_new)->item(0);
		//Load child elements
		$en_orginal = $Tabs1->getElementsByTagName('en')->item(0);
		//Change values
		$en_orginal->nodeValue = $en_new;
		//Replace old elements with new
		$xmlTabsSettings->save("settings.xml");
		echo "success";	
	};
	?>
	</body>
</html>
