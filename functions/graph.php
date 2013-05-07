<?php
//Load graph image
include(dirname(__FILE__)."/../settings/load_settings.php");
//Get id off device
@$DSId = $_GET["DSId"];
//Get width size of image to display
@$DSSizeX = $_GET["DSSizeX"];
//Get Height size of imgage to display
@$DSSizeY = $_GET["DSSizeY"];
//Get minutes to diplay on graph
@$DSMinute = $_GET["DSMinute"];
//Path where to save image you get from switchking temporarly
$img = dirname(__FILE__)."/../settings/tempfiles/tempgraph.png";
//String to get image from switchking
$url = "http://$User:$Pass@$Ip:$Port/$FuncDS/$DSId/graph.png?width=$DSSizeX&height=$DSSizeY&minutesofhistory=$DSMinute";
file_put_contents($img, file_get_contents($url)); //Save image from switch king to the temporarly location
?>
<img src="../settings/tempfiles/tempgraph.png" /> <!-- Display image. -->