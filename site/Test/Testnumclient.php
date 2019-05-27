<?php
$numclient = "758";

//Vérifie qu'il ai bien un 0 avant le numéro
if(!$numclient[0]=="0"){
    $numclient="0".$numclient;
	
}
echo ($numclient."\n");

?>