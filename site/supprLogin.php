<?php include ('haut.php'); 
TestAdmin();
?>

<section id="two" class="wrapper style2 special">
	<div class="inner narrow">
		<header>
			<h2>Supprimez un compte.</h2>
		</header>
			
			<form METHOD="POST" ACTION="effaceLogin.php" >
				<div class="form-control">
				<?php
						$res=ListerLogin($connex);
			    		$resu = $res->fetchAll(); //met dans un tableau le résultat de la requete sql

						echo '<label for="user">Comptes :</label>
								<div class="12u$">
										<div class="select-wrapper">
							 				<select name="id">
							 					<option value="0"> - Comptes - </option>';
						foreach ($resu as $ligne) {
					        echo '<option value="'.$ligne["id"].'">'.$ligne["login"].'</option>'; // pour créer chaque ligne de choix
					        }
			    		echo "</select> </br></div></div>";
					?>
				</div>
				<ul class="actions">
 					<li>
					<input type="submit" value="Supprimer" />
					</li>
				</ul>
				
<?php include ('bas.php'); ?>