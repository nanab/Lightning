<!-- V2.0 Copyright Nanab nanab666@gmail.com. -->
<?php
//Load graph image
include(dirname(__FILE__)."/../settings/load_settings.php");
//DSId
@$DSId = $_GET["DSId"];
//DSSizeX
@$DSSizeX = $_GET["DSSizeX"];
//DSSizeY
@$DSSizeY = $_GET["DSSizeY"];
//DSMinute
@$DSMinute = $_GET["DSMinute"];
$test = "http://$User:$Pass@$Ip:$Port/$FuncDS/$DSId/graph.png?width=$DSSizeX&height=$DSSizeY&minutesofhistory=$DSMinute";
?>
<img src="<?php echo $test; ?>" />