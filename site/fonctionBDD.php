<?php

function ListerLogin($connex) {
	$sql="SELECT id,login,nom,prenom,numero,personnel FROM login;";
	$result=$connex->query($sql);
	return $result;
}

function SupprLogin($id,$connex) {
	$sql="DELETE FROM rendezvous WHERE idlogin = ".$id.";DELETE FROM strat WHERE idtech = ".$id.";DELETE FROM login WHERE id = ".$id.";";
	$connex->query($sql);
}

function ModifieLogin($nom,$prenom,$numero,$mdp,$id,$adresse,$cp,$connex) {
	$sql="UPDATE login SET ";
	if (!($nom == "" || $nom == " "))$sql .="nom = '".$nom."',";
	if (!($prenom == "" || $prenom == " ")) $sql .="prenom = '".$prenom."',";
	if (!($numero == "" || $numero == " ")) $sql .="numero = '".$numero."', ";
	if (!($mdp == "" || $mdp == " ")) $sql .="mdp = '".$mdp."',";
	if (!($adresse == "" || $adresse == " ")) $sql .="adresse = '".$adresse."',";
	if (!($cp == "" || $cp == " ")) $sql .="code_postal = ".$cp.",";
	$sql .= "id = ".$id." WHERE id = ".$id.";";
	$connex->query($sql);
}

function promotion($id,$statut,$connex){
	$sql="UPDATE login SET personnel='".$statut."' WHERE id = ".$id.";";
	$today = date("Y-m-d H:i:s");
	if($statut == "tech"){
		$sql .="INSERT INTO strat (idtech, count, last) VALUES (".$id.", 0,'".$today."');";
	}
	$connex->query($sql);
}

function CreerLogin($login,$nom,$prenom,$numero,$mdp,$adresse,$cp,$connex) { //client de base
	$sql="INSERT INTO login (login,nom,prenom,numero,mdp,adresse,code_postal,personnel) VALUES ('".$login."','".$nom."','".$prenom."','".$numero."','".$mdp."','".$adresse."',".$cp.",'client');";
	$connex->query($sql);
}

function verification ($login, $connex) {
	$sql="SELECT mdp, personnel, id, numero FROM login WHERE login ='".$login."';";
	$result=$connex->query($sql);
	return $result;
}

function rendezvous ($numero, $idlogin, $date, $raison, $connex) {
	$sql="INSERT INTO rendezvous (numero,idlogin,rdv,raison) VALUES ('".$numero."',".$idlogin.",'".$date."','".$raison."');";
	$connex->query($sql);
}

function PremierRdv ($connex) {
	$sql="SELECT * FROM rendezvous ORDER BY rdv ASC LIMIT 1";
	$result=$connex->query($sql);
	return $result;
}

function ReportRdv ($time,$id, $connex){
	$sql="UPDATE rendezvous SET rdv = DATE_ADD(rdv, INTERVAL ".$time." SECOND) WHERE id=".$id.";";
	$connex->query($sql);
}

function SupprRdv ($id, $connex) {
	$sql="DELETE FROM rendezvous WHERE id = ".$id.";";
	$connex->query($sql);
}

function incrementTech ($idtech, $connex) {
	$today = date("Y-m-d H:i:s"); //format DATETIME
	$sql="UPDATE strat SET count = count+1 WHERE idtech = ".$idtech."; UPDATE strat SET last = '".$today."' WHERE idtech =".$idtech.";";
	$connex->query($sql);
}

function appeler ($client, $tech,$raison, $connex) {
	$sql="INSERT INTO appeler (idclient, idtech,raison) VALUES (".$client.", ".$tech.",'".$raison."');";
	$connex->query($sql);
}

function ListerAppel($connex) {
	$sql="SELECT * FROM appeler;";
	$result=$connex->query($sql);
	return $result;
}

function raccrocher($client, $tech, $connex) {
	$sql="DELETE FROM appeler WHERE idclient = ".$client." AND idtech = ".$tech."; "; // double requete, met a jour la table strat
	$connex->query($sql);
}

function dispo($bool,$idtech,$connex){
	$sql="UPDATE strat SET dispo=".$bool." where idtech=".$idtech.";";
	$connex->query($sql);
}

function estDispo($idtech, $connex) {
	$sql="SELECT dispo FROM strat WHERE idtech=".$idtech.";";
	$result=$connex->query($sql);
	return $result;
}

function techDispo($param,$connex){
	$sql="SELECT idtech FROM strat WHERE dispo=1 ORDER BY ".$param." ASC LIMIT 1;";
	$result=$connex->query($sql);
	return $result;
}

function option($option,$connex){
	$sql="UPDATE option SET option='".$option."';";
	$connex->query($sql);
}

function PrendreOption($connex){
	$sql="SELECT * FROM option;";
	$result=$connex->query($sql);
	return $result;
}

function param($connex){
	$sql="SELECT option FROM option;";
	$result=$connex->query($sql);
	return $result;
}

function numtech($idtech,$connex){
	$sql="SELECT numero FROM login WHERE id=".$idtech.";";
	$result=$connex->query($sql);
	return $result;
}

function historique($date,$datefin,$duree,$client,$tech,$resultat,$connex){
	$sql="INSERT INTO appel(date,datefin,duree,contact,tech,resultat) VALUES ('".$date."','".$datefin."','".$duree."',".$client.",".$tech.",'".$resultat."');";
	$result=$connex->query($sql);
}

function listerHistorique($connex){
	$sql="SELECT date,duree,resultat,c.nom AS cnom,c.prenom AS cprenom,t.nom AS tnom,t.prenom AS tprenom FROM appel INNER JOIN login AS c ON c.id=appel.contact INNER JOIN login AS t ON t.id=appel.tech ORDER BY datefin DESC LIMIT 20;";
	$result=$connex->query($sql);
	return $result;
}

function ListerAppelPopIn($connex) {
	$sql="SELECT idclient,idtech,raison FROM appeler;";
	$result=$connex->query($sql);
	return $result;
}

function LoginPopIn($idclient,$connex){
	$sql="SELECT nom,prenom,numero,adresse FROM login WHERE id=".$idclient.";";
	$result=$connex->query($sql);
	return $result;
}
?>