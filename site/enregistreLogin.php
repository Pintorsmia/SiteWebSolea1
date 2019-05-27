<?php include ('haut.php');
//TestAdmin();

$vartest = false;
$res=ListerLogin($connex);
$resu = $res->fetchAll(); //met dans un tableau le résultat de la requete sql

$login= $_POST['login'];
$nom= $_POST['nom'];
$prenom= $_POST['prenom'];
$numero= $_POST['numero'];
$mdp= sha1($_POST['mdp']);
$cp= $_POST['cp'] ;
$adresse= $_POST['adresse'] ;

foreach ($resu as $ligne) {
	if ($ligne["login"] == $login) {
		$vartest = true;
	}

}

if ($vartest == false){

	$resu = CreerLogin($login,$nom,$prenom,$numero,$mdp,$adresse,$cp,$connex);
	deconnexionBDD($connex);
	print ("Compte créé</br>");
	echo '<a href="index.php" class="button special">Retour</a>';
}
else {
	print ("Ce nom est déjà utilisé veuillez en choisir un autre</br>");
	echo '<a href="index.php" class="button special">Retour</a>';
}
include ('bas.php'); ?>