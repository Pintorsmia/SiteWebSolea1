<?php include ('haut.php');
if (!(isset($_SESSION['login']))){
?>
<section id="two" class="wrapper style2 special">
	<div class="inner narrow">
		<header>
			<h2>Connectez-vous.</h2>
		</header>
			
			<form METHOD="POST" ACTION="identification.php" >
				<div class="form-control">
					<label for="login">Login : <input type="text" name="login" > </label>
					<label for="mdp">Mot de passe : <input type="password" name="mdp" ></label>
				</div>
				<ul class="actions">
 					<li>
					<input type="submit" value="Connexion" />
					</li>
					<li><input type="button" value="S'inscrire" onclick="window.location.href='/creationLogin.php'" /></li>
				</ul>
			</form>
		
<?php 
}
else {
	session_destroy();
	echo 'Vous êtes maintenant déconnecté';
	echo '</br><a href="index.php" class="button special">Retour</a>';

}
include ('bas.php'); ?>