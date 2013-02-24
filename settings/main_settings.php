<!-- V2.0 Copyright Nanab nanab666@gmail.com. -->
	<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php
        include(dirname(__FILE__)."/load_settings.php");
        $IpLang = $XmlLang->settings->main->ip;
        $PortLang = $XmlLang->settings->main->port;
        $UserLang = $XmlLang->settings->main->user;
        $PassLang = $XmlLang->settings->main->pass;
        $MainTitleLang = $XmlLang->settings->main->name;
        $AutoUpLang = $XmlLang->settings->main->autoup;
        $TabTimeLang = $XmlLang->settings->main->tabtime;
        $HideTabLang = $XmlLang->settings->main->hidetab;
        $HideTabButtonLang = $XmlLang->settings->main->hidetabbutton;
        $SavedLang = $XmlLang->settings->main->saved;
        $SavebuttonLang = $XmlLang->settings->main->savebutton;
		$TabLangFileLang = $XmlLang->settings->main->langfile;
		$AllMoveLang = $XmlLang->settings->main->allmove;
		$ThemeLang = $XmlLang->settings->main->theme;
		$SaveButtonLang = $XmlLang->settings->main->savebutton;
        ?>
        <script src="<?php echo $Jquery; ?>"></script>
		<script src="<?php echo $JqueryCustom; ?>"></script> 
		<link rel="stylesheet" href="<?php echo $JqueryCustomCss; ?>" /> 
        <style type="text/css">
            #contentmain {
                width:500px;	
                -moz-border-radius: 10px;
                -webkit-border-radius: 10px;
                border-radius: 10px;
                /*background-color: rgba(255, 255, 255, 0.5);*/
                border-color: solid 10px rgba(0,0,0,0.2); /*Very transparent black*/
            }
            .borderdive{
                width:99,5%;
                border:1px solid #CCC;
                border-radius:10px;
                background-color: rgba(255, 255, 255, 0.5);
            }
			#save { 				
					cursor:pointer;				
				}
				.savebuttonmain { 				
					cursor:pointer;				
				}
        </style>
        <script>
			$(document).ready(function() {				
				$(".savebuttonmain").button().on("click", function(){
					$('form#main_settings').submit();
				});				
			});
		</script>
	</head>
	<body>
		<div id="contentmain">
			<form id="main_settings" name="main_settings" method="post" action="/settings/main_settings.php?Send">
  				<div class="borderdive">
    				<div style="height:53px;">
    					<div style="display:inline-block;">
       					 </div>
    					<div style="display:inline-block;">
   		  					<label for="title"><?php echo $MainTitleLang; ?></label><br>
      						<input name="title" type="text" id="title" value="<?php echo $MainTitle?>" size="20" />
    					</div>
        				<div style="display:inline-block;">
        				</div>
        				<div style="display:inline-block;">
      						<label for="ip"><?php echo $IpLang; ?></label><br />
      						<input name="ip" type="text" id="ip" value="<?php echo $Ip ?>" size="20" />
    					</div>
  					</div>    
  					<div style="height:53px;">
    					<div style="display:inline-block;">
        				</div>
    					<div style="display:inline-block;">
      						<label for="port"><?php echo $PortLang; ?></label><br />
      						<input name="port" type="text" id="port" value="<?php echo $Port ?>" size="20" />
    					</div>
    					<div style="display:inline-block;">
        				</div>
        				<div style="display:inline-block;">
      						<label for="user"><?php echo $UserLang; ?></label><br />
      						<input name="user" type="text" id="user" value="<?php echo $User?>" size="20" />
    					</div>
  					</div>
  					<div style="height:53px;">
  						<div style="display:inline-block;">
       					</div>
    					<div style="display:inline-block;">
      						<label for="pass"><?php echo $PassLang; ?></label><br />
      						<input name="pass" type="text" id="pass" value="<?php echo $Pass ?>" size="20" />
   						</div>
   						<div style="display:inline-block;">
        				</div>
        				<div style="display:inline-block;">    
    					</div>
  					</div>    			
                </div>
                <?php if ($First == "false") { ?>
    			<div class="borderdive">
  					<div style="display:inline-block;">
        			</div>
    				<div style="display:inline-block;">
        				<label for="autoup"><?php echo $AutoUpLang; ?></label><br />
        				<?php if($AutoUp == "true"){ ?>	  
      						<input type="checkbox" name="autoup" value="yes" checked>
      					<?php }else{ ?>
      						<input type="checkbox" name="autoup" value="yes">      
      					<?php }; ?>
   					</div>
   					<div style="display:inline-block; width:50px;">
        			</div>
        			<div style="display:inline-block;">
    					<label for="time"><?php echo $TabTimeLang; ?></label><br />
      					<input name="time" type="text" id="time" value="<?php echo $TabTime1 ?>" size="20" />
   					</div>
  				</div>
   				<div class="borderdive">
  					<div style="display:inline-block;">
        			</div>
    				<div style="display:inline-block;">
        				<label for="hidetab"><?php echo $HideTabLang; ?></label><br />
        				<?php if($HideTab == "true"){ ?>	  
      						<input type="checkbox" name="hidetab" value="yes" checked>
      					<?php }else{ ?>
      						<input type="checkbox" name="hidetab" value="yes">    
      					<?php }; ?>
   					</div>
  					<div style="display:inline-block;">
        			</div>
        			<div style="display:inline-block;">
    					<label for="hidetabbutton"><?php echo $HideTabButtonLang; ?></label><br />
        				<?php if($HideTabButton == "true"){ ?>	  
      						<input type="checkbox" name="hidetabbutton" value="yes" checked>
      					<?php }else{ ?>
      						<input type="checkbox" name="hidetabbutton" value="yes">                     
      					<?php }; ?>
    				</div>
  				</div>
                <div class="borderdive">
  					<div style="display:inline-block;">
        			</div>
    				<div style="display:inline-block;">
                    <label for="langfile"><?php echo $TabLangFileLang; ?></label><br />
                    <?php
                    echo "<select name='langfile' id='langfile'>";
					echo "<option value='$LangFile'>$LangFile</option>";
					$files = array_map("htmlspecialchars", scandir(dirname(__FILE__)."/language/"));
					foreach ($files as $file)
					if ($file == "."){
					}else if ($file == ".."){
					}else if ($file == $LangFile){
					}else{
    				echo "<option value='$file'>$file</option>";
					}
					echo "</select>";
					?>
   					</div>
  					<div style="display:inline-block; width:100px;">
        			</div>
        			<div style="display:inline-block;">
                    <label for="theme"><?php echo $ThemeLang; ?></label><br />
                    <?php
                    echo "<select name='theme' id='theme'>";
					echo "<option value='$Theme'>$Theme</option>";
					$themes = array_map("htmlspecialchars", scandir(dirname(__FILE__)."/../themes/themes"));
					foreach ($themes as $theme2)
					if ($theme2 == "."){
					}else if ($theme2 == ".."){
					}else if ($theme2 == $Theme){
					}else{
    				echo "<option value='$theme2'>$theme2</option>";
					}
					echo "</select>";
					?>
    				</div>
  				</div>
                <div class="borderdive">
  					<div style="display:inline-block;">
        			</div>
    				<div style="display:inline-block;">
        				<label for="hidetab"><?php echo $AllMoveLang; ?></label><br />
        				<?php if($AllMove == "true"){ ?>	  
      						<input type="checkbox" name="allmove" value="yes" checked>
      					<?php }else{ ?>
      						<input type="checkbox" name="allmove" value="yes">    
      					<?php }; ?>
   					</div>
  					<div style="display:inline-block;">
        			</div>
        			<div style="display:inline-block;">
    				</div>
  				</div>
               <?php }; ?>
  				<div class="borderdiv" id="save">
                    <center>
                        <div class="savebuttonmain"><?php echo $SaveButtonLang; ?></div>
                    </center>			
                </div>        
  			</form>
		</div>
		<?php if(isset($_GET['Send'])) {
			//Load XML and set some config
			$xmlMainSettings = new DOMDocument('1.0', 'utf-8');
			$xmlMainSettings->formatOutput = true;
			$xmlMainSettings->preserveWhiteSpace = false;
			$xmlMainSettings->load('settings.xml');
			$title_new = $_POST['title'];
			$ip_new = $_POST['ip'];
			$port_new = $_POST['port'];
			$user_new = $_POST['user'];
			$pass_new = $_POST['pass'];
			@$autoup_new = $_POST['autoup'];
			@$time_new = $_POST['time'];
			@$hidetab_new = $_POST['hidetab'];
			@$hidetabbutton_new = $_POST['hidetabbutton'];
			@$langfile_new = $_POST['langfile'];
			@$theme_new = $_POST['theme'];
			@$allmove_new = $_POST['allmove'];
			if ($First == "true"){
				$first_new = "second";
			}else{
				$first_new = "false";
			}
			if ($autoup_new == ""){
				 $autoup_new = "false";
			}else{
				$autoup_new = "true";
			};
			if ($hidetab_new == ""){
				 $hidetab_new = "false";
			}else{
				$hidetab_new = "true";
			};
			if ($hidetabbutton_new == ""){
				 $hidetabbutton_new = "false";
			}else{
				$hidetabbutton_new = "true";
			};
			if ($allmove_new == ""){
				 $allmove_new = "false";
			}else{
				$allmove_new = "true";
			};
			//Get item Element
			$main =  $xmlMainSettings->getElementsByTagName('main')->item(0);
			//Load child elements
			$title_orginal = $main->getElementsByTagName('title')->item(0);
			$ip_orginal = $main->getElementsByTagName('ip')->item(0);
			$port_orginal = $main->getElementsByTagName('port')->item(0);
			$user_orginal = $main->getElementsByTagName('user')->item(0);
			$pass_orginal = $main->getElementsByTagName('pass')->item(0);
			$first_orginal = $main->getElementsByTagName('first')->item(0);
			if ($First == "false") { 
			$autoup_orginal = $main->getElementsByTagName('autoup')->item(0);
			$time_orginal = $main->getElementsByTagName('tabtime')->item(0);
			$hidetab_orginal = $main->getElementsByTagName('hidetab')->item(0);
			$hidetabbutton_orginal = $main->getElementsByTagName('hidetabbutton')->item(0);
			$langfile_orginal = $main->getElementsByTagName('langfile')->item(0);
			$theme_orginal = $main->getElementsByTagName('theme')->item(0);
			$allmove_orginal = $main->getElementsByTagName('allmove')->item(0);
			};
			//Change values
			$title_orginal->nodeValue = $title_new;
			$ip_orginal->nodeValue = $ip_new;
			$port_orginal->nodeValue = $port_new;
			$user_orginal->nodeValue = $user_new;
			$pass_orginal->nodeValue = $pass_new;
			$first_orginal->nodeValue = $first_new;
			if ($First == "false") { 
			$autoup_orginal->nodeValue = $autoup_new;
			$time_orginal->nodeValue = $time_new;
			$hidetab_orginal->nodeValue = $hidetab_new;
			$hidetabbutton_orginal->nodeValue = $hidetabbutton_new;
			$langfile_orginal->nodeValue = $langfile_new;
			$theme_orginal->nodeValue = $theme_new;
			$allmove_orginal->nodeValue = $allmove_new;
			};
			//Replace old elements with new
			?>
			<script>
				<?php if ($First == "true"){
					$xmlMainSettings->save("settings.xml");?>
					window.location.href = "../index.php";<?php
				}else{
					$xmlMainSettings->save("settings.xml");?>
					window.location.href = "main_settings.php";<?php
				} ?>
					
			</script>
		<?php } ?>
	</body>
</html>