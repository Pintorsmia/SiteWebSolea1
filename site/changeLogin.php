<?php include ('haut.php');
//TestAdmin();

$nom= $_POST['nom'] ;//recupere les donnees envoyes
$prenom= $_POST['prenom'] ;
$numero= $_POST['numero'] ;
if (!($_POST['mdp'] == "" || $_POST['mdp'] == " "))$mdp= sha1($_POST['mdp']) ;
else $mdp = "";
$id= $_POST['id'] ; 
$cp= $_POST['cp'] ;
$adresse= $_POST['adresse'] ;

?>

<header class="major">
		<h2>Modification d'un compte.</h2>
</header>


<?php
$resu = ModifieLogin ($nom,$prenom,$numero,$mdp,$id,$adresse,$cp,$connex); //fonction dans la page fonctionBDD.php
deconnexionBDD($connex);

$res=verification($_SESSION['login'], $connex);
$resu = $res->fetch(); //fetch car qu'une seule ligne (pas une colonne) à récup

$_SESSION['numero'] = $resu['numero'];

echo 'Le compte est maintenant modifié' ;
echo '</br><a href="index.php" class="button special">Retour</a>';
//session_destroy(); Car on modifiait le login
include ('bas.php'); ?>