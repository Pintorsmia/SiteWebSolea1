<?php include ('haut.php'); 
if (isset($_SESSION['login']) && ($_SESSION['statut'] == 'admin'  || $_SESSION['statut'] == 'tech' )) {
?>
<div class="inner narrow">
	<header>
		<h2>Historique des appels</h2>
	</header>
	
</div>

<table>
	<thead>
		<tr>
			<th>Client</th>
			<th>Technicien</th>
			<th>Date</th>
			<th>Durée</th>
			<th>Etat</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$res=listerHistorique($connex);
		$resu = $res->fetchAll();
		
			foreach ($resu as $ligne) {
				echo '<tr>';
				echo '<td>'.$ligne['cprenom'].' '.$ligne['cnom'].'</td>';
				echo '<td>'.$ligne['tprenom'].' '.$ligne['tnom'].'</td>';
				echo '<td>'.$ligne['date'].'</td>';
				echo '<td>'.$ligne['duree'].'</td>';
				echo '<td>'.$ligne['resultat'].'</td>';
				echo '</tr>';
			}
	?>
	</tbody>
</table>

<?php
}
include ('bas.php'); ?>