<?php include ('haut.php');
TestAdmin();
?>

<section id="two" class="wrapper style2 special">
	<div class="inner narrow">
		<header>
			<h2>Modifiez les informations.</h2>
		</header>
			<h5>Laissez vide pour ne pas modifier</h5>
			<form METHOD="POST" ACTION="changeLogin.php" >
				<div class="form-control">
				<?php
					$res=Listerlogin($connex);
					$resu = $res->fetchAll(); //met dans un tableau le résultat de la requete sql
					echo '<label for="login">Comptes :</label>
							<div class="12u$">
									<div class="select-wrapper">
										<select name="id">
											<option value="0"> - Comptes - </option>';
					foreach ($resu as $ligne) { //choisit le compte a modifier
						echo '<option value="'.$ligne["id"].'">'.$ligne["login"].'</option>'; // pour créer chaque ligne de choix
						}
					echo "</select> </br></br></div></div>";
				?>
				<label for="nom"> Nom : <input type="text" name="nom" > </label>
				<label for="prenom"> Prenom : <input type="text" name="prenom" > </label>
				<label for="numero"> Numero : <input type="text" name="numero" > </label>
				<label for="mdp"> Mot de passe : <input type="password" name="mdp" > </label>
				<label for="adresse">Adresse :<input type="text" name="adresse"> </label>
				<label for="cp">Code postal :<input type="number" name="cp" maxlength="5"> </label>
				</div>
				<ul class="actions">
 					<li>
					<input type="submit" value="Modifier" />
					</li>
				</ul>
			</form>
<?php include ('bas.php'); ?>
