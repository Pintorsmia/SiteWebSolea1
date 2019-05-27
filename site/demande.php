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
			<h2>Demande d'appel</h2>
		</header>
		
		<form class="grid-form" method="post" action="rdv.php">
 			<div class="form-control">
				<label for="date">Date :</label>
 				<select name="jour">
					<?php
					for ($i = 1; $i <= 31; $i++) {
						echo '<option value="'.$i.'"> '.$i.' </option>';
					}
					?>
				</select>
				<select name="mois">
					<option value="1"> Janvier </option>
					<option value="2"> Fevrier </option>
					<option value="3"> Mars </option>
					<option value="4"> Avril </option>
					<option value="5"> Mai </option>
					<option value="6"> Juin </option>
					<option value="7"> Juillet </option>
					<option value="8"> Aout </option>
					<option value="9"> Septembre </option>
					<option value="10"> Octobre </option>
					<option value="11"> Novembre </option>
					<option value="12"> Decembre </option>
				</select>
				<select name="annee">
					<option value="19"> 2019 </option>
					<option value="20"> 2020 </option>
				</select>
				<label for="date">Heure :</label>
				<input placeholder="Heure" type="number" name="heure"> <input placeholder="Minute" type="number" name="min">
				</br></br>
 				<label for="num">Numero :</label>
 				<input type="text" placeholder="Laissez vide pour votre numéro par défaut" name="numero">
				<label for="raison">Raison du rendez-vous:</label>
 				<input type="text" placeholder="Facultatif" name="raison">

 			</div>
 
		<ul class="actions">
 			<li>
 			<input type="submit" value="Demander" />
 			</li>
 		</ul>
 
		</form>
	</div>
	</br></br></br>
	<div class="inner narrow">
		<header>
			<h2>Demande d'appel directe</h2>
		</header>
		
		<form class="grid-form" method="post" action="direct.php">
 			<div class="form-control">

 				<label for="num">Numero :</label>
 				<input type="text" placeholder="Laissez vide pour votre numéro par défaut" name="numero">
				<label for="raison">Raison du rendez-vous :</label>
 				<input type="text" placeholder="Facultatif" name="raison">

 			</div>
 
		<ul class="actions">
 			<li>
 			<input type="submit" value="Demander" />
 			</li>
 		</ul>
 
		</form>
	</div>
</section>

<?php
}

include ('bas.php'); ?>