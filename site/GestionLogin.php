<?php include ('haut.php');
/* TestAdmin(); */

if (isset($_SESSION['statut']) && $_SESSION['statut'] == 'admin' ){
	$votre = '';
}
else {
	$votre = 'Votre';
}
?>

<div class="row">
	<div class="6u 12u$(small)">
		<ul class="alt">
			<li><a href="creationLogin.php" class="button alt fit">Création d'un Compte</a></li></li>
			<li><?php echo'<a href="modifie'.$votre.'Login.php" class="button alt fit">' ?>Modifier un Compte</a></li></li>
			<?php if (isset($_SESSION['login']) && $_SESSION['statut'] == 'admin' ) echo '<li><a href="supprLogin.php" class="button alt fit"> Supprimer un Compte</a></li></li>' ?>
			<?php if (isset($_SESSION['login']) && $_SESSION['statut'] == 'admin' ) echo '<li><a href="hotline.php" class="button alt fit"> Hotline</a></li></li>' ?>
		</ul>

	</div>
	
</div>

<?php include ('bas.php'); ?>