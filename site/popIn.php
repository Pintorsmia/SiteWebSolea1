<?php
require_once ('connexion.php'); // déclaration du fichier contenant des fonctions pouvant être appelées
require_once ('fonctionBDD.php');
$connex=connexionBDD(); // appel de la fonction connexionBDD. Le résultat retourné sera dans la variable $connex
session_start();



function popup($idclient,$raison,$idtech,$connex){ //on appelle cette fct lorsque un tuple est présent dans appeler, verifier si admin ou tech concerné !!

    $resl=LoginPopIn($idclient,$connex);
    $resul = $resl->fetchAll();
	$resul[0] += [ "raison"=> $raison ];
	$resul[0] += [ "id"=> $idtech ];
	
    echo json_encode($resul);
	}

function verifieAppel($connex){
	$test=false
	$resa=ListerAppelPopIn($connex);
	$resua = $resa->fetchAll();
	
	if(empty($resua)){
		echo json_encode(array("option"=>"vide"));
	}else{

		foreach ($resua as $ligne) {
			
			if ( (isset($_SESSION['id'])) && ($ligne['idtech'] == $_SESSION['id']) ){
				popup($ligne['idclient'],$ligne['raison'],$ligne['idtech'],$connex);
				$test=true;
			}/*else{
				echo "test";
				echo json_encode(array("option"=>"vide"));
			}*/
		}
		if ($test == true){
			echo json_encode(array("option"=>"vide"));
		}
	}
}

verifieAppel($connex);
?>