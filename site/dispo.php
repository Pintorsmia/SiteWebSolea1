<?php include ('haut.php');

if ($_GET['dispo']){
	$dispo = 0;
} else {
	$dispo = 1;
}
$id= $_SESSION['id'] ;

?>

<header class="major">
		<h3>Vous êtes maintenant indiqué comme <?php if (!($dispo)) echo "in"?>disponible.</h3>
</header>


<?php
dispo ($dispo,$id,$connex); //fonction dans la page fonctionBDD.php
deconnexionBDD($connex);

include ('bas.php'); ?>