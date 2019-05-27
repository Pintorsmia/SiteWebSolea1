<?php include ('haut.php');

if (!(isset($_SESSION['login']))){
	echo "Il faut se connecter pour accéder à cette fonction</br>";
	echo '<a href="login.php" class="button special">Se connecter</a>';
}

else { 
?>

<section id="two" class="wrapper style2 special">
	<div class="inner narrow">
		<header>
			<h2>Modifiez votre compte.</h2>
		</header>
			
			<form METHOD="POST" ACTION="changeLogin.php" >
				<div class="form-control">
				<?php
					$res=Listerlogin($connex);
					$resu = $res->fetchAll(); //met dans un tableau le résultat de la requete sql
					
					foreach ($resu as $ligne) {
						if ($_SESSION['login'] == $ligne['login']){
							$id = $ligne['id'];
							$statut = $ligne['personnel'];
						}
					}
					echo '<input type="hidden" value='.$id.' name="id">';
				?>
				<label for="nom"> Nom : <input type="text" name="nom" > </label>
				<label for="prenom"> Prenom : <input type="text" name="prenom" > </label>
				<label for="numero"> Numero : <input type="text" name="numero" placeholder="<?php echo $_SESSION['numero'];?>" > </label>
				<label for="mdp"> Mot de passe : <input type="password" name="mdp" > </label>
				<label for="adresse">Adresse :<input type="text" name="adresse"> </label>
				<label for="cp">Code postal :<input type="number" name="cp" maxlength="5"> </label>
				<input type="hidden" name="statut" value="<?php echo $statut; ?>">
				</div>
				<ul class="actions">
 					<li>
					<input type="submit" value="Modifier" />
					</li>
				</ul>
				
<?php 
}
include ('bas.php'); ?>