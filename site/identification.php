<?php include ('haut.php');

$login= $_POST['login'];
$mdp= sha1($_POST['mdp']);

$res=verification($login, $connex);
$resu = $res->fetch(); //fetch car qu'une seule ligne (pas une colonne) à récup

if ($mdp == $resu['mdp']){
	$_SESSION['login'] = $login;
	$_SESSION['statut'] = $resu['personnel'];
	$_SESSION['id'] = $resu['id'];
	$_SESSION['numero'] = $resu['numero'];
	echo "Connecté en tant que ".$login."</br>";
	echo '<a href="index.php" class="button special">Retour</a>';
}
else {
	echo "Mot de passe érroné</br>";
	echo '<a href="login.php" class="button special">Retour</a>';
}

include ('bas.php'); ?>