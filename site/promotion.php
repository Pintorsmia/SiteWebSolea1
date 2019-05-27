<?php include ('haut.php');
TestAdmin();

$id= $_POST['id'] ;
$statut= $_POST['statut'] ;

?>

<header class="major">
		<h2>Modification d'un compte.</h2>
</header>


<?php
promotion ($id,$statut,$connex); //fonction dans la page fonctionBDD.php
deconnexionBDD($connex);

echo 'Le compte est maintenant modifié' ;
echo '</br><a href="index.php" class="button special">Retour</a>';

include ('bas.php'); ?>