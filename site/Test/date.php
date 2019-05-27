<?php
/*
$date = new DateTime("NOW");
echo $date->format('Y-m-d H:i:s')."\n";


$datefuture= new DateTime("NOW");
$datefuture->add(new DateInterval('PT5M'));
echo $datefuture->format('Y-m-d H:i:s')."\n";

$datepasse=new DateTime("NOW");;
$datepasse->sub(new DateInterval('PT10M'));
echo $datepasse->format('Y-m-d H:i:s')."\n";
*/




$HeureAppel; $HeureFinAppel; //permet de calculer temps d'un appel

$HeureAppel = new DateTime("NOW");
//sleep(5);
$HeureFinAppel = new DateTime("NOW");

$TempsAppel = $HeureFinAppel->diff($HeureAppel);
echo $TempsAppel->format('%H:%I:%S')."\n";


?>