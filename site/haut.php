<!DOCTYPE HTML>
<!--
	Typify by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<?php
//phpinfo(); //peut etre utile
require_once ('connexion.php'); // déclaration du fichier contenant des fonctions pouvant être appelées
require_once ('fonctionBDD.php');


$connex=connexionBDD(); // appel de la fonction connexionBDD. Le résultat retourné sera dans la variable $connex
session_start();

function TestAdmin (){
if (!(isset($_SESSION['login'])) || $_SESSION['statut'] != 'admin' ) {
	echo '<script language="JavaScript">alert("Vous n\'êtes pas autorisé à accéder à cette page.");</script> ';
	exit();
}}


?>



<html>
	<head>
		<title>Solea 1</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	</head>
	<body>

		<!-- Banner -->
			<section id="banner">
				<h2><strong>Solea 1</strong></h2>
				
				<ul class="actions">
					<li><a href="index.php" class="button special">Accueil</a></li>
					<?php
					if ((isset($_SESSION['statut'])) && ($_SESSION['statut']=='client')){
					?>
					<li><a href="demande.php" class="button special">Demande d'appel</a></li>
					<?php } ?>
					<li><a href="GestionLogin.php" class="button special">Gestion</a></li>
					<li><a href="login.php" class="button special">
					<?php
					if ((isset($_SESSION['login'])) && $_SERVER['REQUEST_URI']!='/login.php'){
						echo $_SESSION['login'].' : Déconnexion';
					}
					else {
						echo'Se connecter';
					}
					?>
					</a></li>
					<?php
					if ((isset($_SESSION['statut'])) && ($_SESSION['statut']=='tech')){
						$estDispo = estDispo($_SESSION['id'],$connex)->fetchColumn();
						if ($_SERVER['REQUEST_URI']=='/dispo.php?dispo=1') $estDispo = 0;
						elseif ($_SERVER['REQUEST_URI']=='/dispo.php?dispo=0') $estDispo = 1;
						echo '<li';
						if($estDispo) echo ' style="background-color:green;" ';
						else echo ' style="background-color:orange;" ';
						echo'><a href="dispo.php?dispo='.$estDispo.'" class="button special"  onclick="myUpdate()">';
						if($estDispo) echo 'Disponible';
						else echo 'Occupé';
						echo '</a></li>';
						echo '<script src="js/app.js"></script>'; //script pour popup
					}
					?>
					
				</ul>
			</section>

		<!-- One -->
		<section id="one" class="wrapper special">
			<div class="inner">
			

	



<!-- Pop up -->
<style>
	<?php include ('modal.css'); // bug lorsque dans le dossier css ?>
</style>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2>Appel en cours</h2>
    </div>
    <div class="modal-body">
		<p id="nomcli" >Client : </p> <!-- a remplir avec javascript -->
		<p id="numcli" >Numéro : </p>
		<p id="addrcli" >Adresse : </p>
		<p id="raisoncli" >Raison : </p>
		<?php
		echo 	'<section class="wrapper style2 special" style="background-color:white">
					<ul>			
						<button type="button" id="buttoncli" onclick="STOP('.$_SESSION["numero"].')"> Raccrocher </button>
					</ul>	
				</section>'
		?>			
	</div>
  
  </div>
	
</div>

<script language="JavaScript"><?php include('modal.js'); ?></script>


<div class="messages"> </div>

<?php
	
?>