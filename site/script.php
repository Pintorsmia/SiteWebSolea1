<?php
require_once ('connexion.php');
require_once ('fonctionBDD.php');
$connex=connexionBDD();

$res=PremierRdv($connex);
$resu = $res->fetch();

global $numclient, $statutInge;
$statutInge = false;

$rdv = new DateTime($resu['rdv']);

$datefuture= new DateTime("NOW");
$datefuture->add(new DateInterval('PT10M'));

$datepasse=new DateTime("NOW");
$datepasse->sub(new DateInterval('PT10M'));


if  ( (isset($resu['rdv'])) && ($resu['rdv']!="") ){
	echo "il y a un rdv \n";
	if ($rdv < $datepasse){
		SupprRdv($resu["id"],$connex);
		exit ("rdv passé"); 
	}
	elseif (($rdv <= $datefuture) && ($rdv >= $datepasse)) {
		
		echo "rdv bientot \n";
		$numclient = $resu["numero"];
		$param = param($connex)->fetchColumn();
		$tech = techDispo($param,$connex)->fetchColumn();
		
		if ((isset($tech)) && ($tech!="")){
			$numtech = numtech($tech,$connex)->fetchColumn();
			$statutInge = true;
		}
		else {
			ReportRdv(21,$resu["id"],$connex);
			exit("pas de tech dispo\n");
		}
	}
	else exit("mais il n'est pas pour tout de suite\n");
}
else exit("pas de rdv \n");


?>