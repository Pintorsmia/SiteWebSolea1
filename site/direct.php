<?php include ('haut.php');

$login= $_SESSION['login'];
$numero= $_POST['numero'];
$raison= $_POST['raison'];

$date = date("Y-m-d H:i:s");

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
rendezvous($numero, $idlogin, $date, $raison, $connex);
echo 'Rendez-vous pris</br>';
echo '<a href="demande.php" class="button special">Retour</a>';

include ('bas.php'); ?>