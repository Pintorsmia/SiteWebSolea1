<?php include ('haut.php');
TestAdmin();

$option= $_POST['option'] ;
?>

<header class="major">
		<h2>Modification de la stratégie.</h2>
</header>


<?php
option($option,$connex); //fonction dans la page fonctionBDD.php
deconnexionBDD($connex);

echo 'La stratégie est maintenant modifié' ;
echo '</br><a href="index.php" class="button special">Retour</a>';


include ('bas.php'); ?>