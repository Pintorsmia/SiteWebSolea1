<?php include ('haut.php');
//TestAdmin();
?>


<section id="two" class="wrapper style2 special">
	<div class="inner narrow">
		<header>
			<h2>Création d'un compte</h2>
		</header>
		
		<form class="grid-form" method="post" action="enregistreLogin.php">
 			<div class="form-control">
 				<label for="login">Login :</label>
 				<input type="text" name="login">
				<label for="nom">Nom :</label>
 				<input type="text" name="nom">
				<label for="prenom">Prenom :</label>
 				<input type="text" name="prenom">
 				<label for="numero">Numero :</label>
 				<input type="text" name="numero">
				<label for="pass">Mot de passe :</label>
 				<input type="password" name="mdp">
				<label for="adresse">Adresse :</label>
 				<input type="text" name="adresse">
				<label for="cp">Code postal :</label>
 				<input type="number" name="cp" maxlength="5">
 			</div>
 
		<ul class="actions">
 			<li>
 			<input type="submit" value="Créer" />
 			</li>
 		</ul>
 
		</form>
	</div>
</section>

<?php include ('bas.php'); ?>
