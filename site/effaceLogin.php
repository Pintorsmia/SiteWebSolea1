<?php include ('haut.php');
//TestAdmin();
?>

<header class="major">
		<h2>Suppression d'un compte.</h2>
</header>

<?php
$id= $_POST['id'] ;

$resu = SupprLogin ($id,$connex); //fonction dans la page fonctionBDD.php
deconnexionBDD($connex);

echo 'Vous avez supprimé le compte '.$id ;
echo '</br><a href="index.php" class="button special">Retour</a>';

include ('bas.php'); ?>