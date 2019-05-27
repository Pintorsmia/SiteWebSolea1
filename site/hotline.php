<?php include ('haut.php');
TestAdmin();
?>

<section id="two" class="wrapper style2 special">
	<div class="inner narrow">
	
	<header>
		<h2>Promouvoir un compte.</h2>
	</header>
		
	<form METHOD="POST" ACTION="promotion.php" >
			<div class="form-control">
			
			<?php
				$res=ListerLogin($connex);
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
			<label for="statut">Status :</label><select name="statut">
				<option value="0"> - Status - </option>
				<option value="admin">Administrateur</option>
				<option value="tech">Technicien</option>
				<option value="client">Client</option>
			</select>
		</div>
		</br>
		<ul class="actions">
			<li>
			<input type="submit" value="Modifier" />
			</li>
		</ul>
	</form>
	
	<header>
		<h2>Changer la stratégie d'appel.</h2>
	</header>
	<h5>Actuel : <?php echo $reso=PrendreOption($connex)->fetchColumn(); ?></h5>
	<form METHOD="POST" ACTION="option.php" >
	<label for="option">Stratégie :</label><select name="option">
				<option> - Stratégie - </option>
				<option value="last">Dernier appel le moins récent</option>
				<option value="count">Le moins d'appels</option>
			</select>
		</div>
		<ul class="actions">
			<li>
			<input type="submit" value="Modifier" />
			</li>
		</ul>
	</form>
			<div class="form-control">
<?php include ('bas.php'); ?>