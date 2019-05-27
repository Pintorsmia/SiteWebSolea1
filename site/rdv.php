<?php include ('haut.php');

$login= $_SESSION['login'];
$annee= $_POST['annee'];
$mois= $_POST['mois'];
$jour= $_POST['jour'];
$heure= $_POST['heure'];
$min= $_POST['min'];
$numero= $_POST['numero'];
$raison= $_POST['raison'];

if ($heure > 23 || $min > 59 || $heure =="" || $min == "") {
	echo 'Entrez une heure convenable</br>';
	echo '<a href="demande.php" class="button special">Retour</a>';
	exit();
}

$date = "20".$annee."-".$mois."-".$jour." ".$heure.":".$min.":00";
$datetime= new DateTime($date);
$now= new DateTime("NOW");


$res=ListerLogin($connex);
$resu = $res->fetchAll(); //met dans un tableau le résultat de la requete sql
//on a un tableau alors qu'on cherche qu'un seul login, on peut faire faire fetchColumn avec que le login qui nous interesse

foreach ($resu as $ligne) {
	if ($ligne["login"] == $login) {
		$numerobdd = $ligne["numero"];
		$idlogin = $ligne["id"];
	}
}

if ($numero == "" || $numero == " "){
	$numero = $numerobdd; //affecte le num de la bdd
}

if ($now > $datetime){
// verifie si la date entrée est posterieure a la date actuelle
	echo 'Entrez une date postérieur à la date actuelle</br>';
	echo '<a href="demande.php" class="button special">Retour</a>';
}
else {
	rendezvous($numero, $idlogin, $date,$raison, $connex);
	echo 'Rendez-vous pris</br>';
	echo '<a href="index.php" class="button special">Accueil</a>';
}

include ('bas.php'); ?>