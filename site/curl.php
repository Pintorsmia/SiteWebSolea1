<?php
require_once("script.php");
$App = "API-REST";

$IngeDispo = $statutInge;
//$IngeDispo = true;
echo '////SCRIPT LANCE ////////// ' . "\n";

echo $tech;
//Appel ingénieur
$Id = $numtech; 		//le numéro de l'appelant
$Num = $numtech;
//$Id = "11";
//$Num = "11";
$Exten = "site_aix";


//Appel du client
//Vérifie qu'il ai bien un 0 avant le numéro

//Vérifie qu'il ai bien un 0 avant le numéro
if(!$numclient[0]=="0"){
    $numclient="0".$numclient;
}

$IdC = $numclient; 		// le numéro de l'appelant
$NumC = $numclient;
$ExtenC = "entreprise";

// --- Status d'un tel ----\\
function StatusDevice ($Numero){
	$ch = curl_init();
	$url = "http://10.1.3.251:8088/ari/deviceStates/PJSIP%2F".$Numero."?api_key=asterisk:asterisk";
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER, true );
	curl_setopt($ch,CURLOPT_HEADER, false );
	$retour = curl_exec($ch);
	curl_close($ch);
	$retour = json_decode($retour);
	return $retour->{'state'};
};

//Creation pour appel interne \\
function CreationChannelInterne ($IdChannel,$Numero,$Extension,$Stasis){
	$ch = curl_init("http://10.1.3.251:8088/ari/channels/".$IdChannel);
	$data = "endpoint=PJSIP%2F".$Numero."&extension=".$Extension."&app=".$Stasis."&callerId=Hotline&timeout=-1&api_key=asterisk:asterisk";
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_exec($ch);
	curl_close($ch);
};
//Creation pour appel externe (client)\\
function CreationChannelExterne ($IdChannel,$Numero,$Extension,$Stasis){
	//on enleve le premier 0
	$Numero = substr($Numero,1);  
	$ch = curl_init("http://10.1.3.251:8088/ari/channels/".$IdChannel);
	$data = "endpoint=PJSIP%2Fast_solea1%2Fsip:".$Numero."@192.168.176.59:5060&extension=".$Extension."&app=".$Stasis."&callerId=Solea1&timeout=-1&api_key=asterisk:asterisk";
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_exec($ch);
	curl_close($ch);
}
//Creation du lien entre les tel\\
function CreationBridge ($IdBridge){
	$ch = curl_init("http://10.1.3.251:8088/ari/bridges/".$IdBridge);
	$data = "api_key=asterisk:asterisk";
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_exec($ch);
	curl_close($ch);
}
//Ajoute un tel dans notre lien\\
function AjoutChanneldansBridge ($IdBridge,$IdChannel){
	$ch = curl_init("http://10.1.3.251:8088/ari/bridges/".$IdBridge."/addChannel");
	$data = "channel=".$IdChannel."&api_key=asterisk:asterisk";
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_exec($ch);
	curl_close($ch);
}

//Suppresion d'un channel \\
function SuppressionChannel ($Num){
	$ch = curl_init();
	$url = "http://10.1.3.251:8088/ari/channels/".$Num."?api_key=asterisk:asterisk";
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
	//curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	
	curl_exec($ch);
	curl_close($ch);
}

//Status d'un channel \\
function StatusChannel ($Id){
	$ch = curl_init();
	$url = "http://10.1.3.251:8088/ari/channels/".$Id."?api_key=asterisk:asterisk";
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER, true );
	curl_setopt($ch,CURLOPT_HEADER, false );
	$retour = curl_exec($ch);
	$status_http = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);
	$retour = json_decode($retour);

	if ($status_http != 200 ){
		$reponse = "Stop";
	}else{
		$reponse=$retour->{'state'};
	}
	//echo $reponse;
	return $reponse;
}

$HeureAppel; $HeureFinAppel; //permet de calculer temps d'un appel

if($IngeDispo==true){
	$test = false;
	$telInge = false; //est ce qu'un inge est en ligne
	$nb_essai = 0;
	
		
		appeler($resu["idlogin"],$tech,$resu["raison"],$connex);	//affichage popup
		$HeureAppel = new DateTime("NOW");
		//Appel de l'ingénieur + tentative de rajout dans le bridge
		CreationChannelInterne($Id,$Num,$Exten,$App);
		sleep(1); //pour attendre le changement de status
		while ($test == false) {
			//echo StatusDevice($Num);
			if (StatusDevice($Num) == "RINGING" || StatusDevice($Num) == "RINGINUSE"){ //si le tel sonne
				$nb_essai ++;
				sleep(1);
			}elseif (StatusDevice($Num)=="INUSE"){
				$test = true;
				usleep(50*1000); //50ms
				CreationBridge($Num); //bridge id correspondant au numero client
				usleep(50*1000);
				AjoutChanneldansBridge($Num,$Id); //ajout dans le bridge
				
				$telInge = true; //inge en ligne
			}else{
				$nb_essai=-1;
			}
			if ($nb_essai >= 10 || $nb_essai==-1){  //Correspond au nombre de seconde que l'inge a pour repondre
				$test = true;
				//BDD ajoute 20minute au RDV
				ReportRdv(21,$resu["id"],$connex);
				raccrocher($resu["idlogin"],$tech,$connex);	//fin popup 
				$HeureFinAppel = new DateTime("NOW");
				historique($HeureAppel->format('Y-m-d H:i:s'),$HeureFinAppel->format('Y-m-d H:i:s'),(''),$resu["idlogin"],$tech,"Pas de réponse du Technicien",$connex);
				dispo(0,$tech,$connex); //passe le technicien en non dispo
				//Supprimer les channels 
				SuppressionChannel($Num);
				$telInge = false;
				exit("Pas de reponse\n");
			}
		}
		$temps = 0; //temps appel client
		$sonnerie = false;
		$appel = false; //si appel en cour ou non
		if($telInge == true){
			CreationChannelExterne($IdC,$NumC,$ExtenC,$App);
			sleep(1);
			
			
			while($sonnerie==false){
				$teststatus = StatusChannel($IdC);
				if($teststatus == "Stop" || $temps >= 10){
					$sonnerie = true;
					ReportRdv(720,$resu["id"],$connex);
					SuppressionChannel($NumC);
					SuppressionChannel($Num);
					$HeureFinAppel = new DateTime("NOW");
					historique($HeureAppel->format('Y-m-d H:i:s'),$HeureFinAppel->format('Y-m-d H:i:s'),(''),$resu["idlogin"],$tech,"Pas de réponse Client",$connex);
					raccrocher($resu["idlogin"],$tech,$connex);	//fin popup 
					exit("Fin d'appel\n");
				}elseif($teststatus == "Ringing"){
					$temps ++;
					sleep(1);
				}elseif($teststatus == "Up"){
					$sonnerie=true;
					sleep(1);
					AjoutChanneldansBridge($Num,$IdC);
					dispo(0,$tech,$connex); //passe le technicien en non dispo
					incrementTech($tech,$connex);
					SupprRdv($resu["id"],$connex);				//supression rdv dans BDD
					$appel = true;
				}
			}
		}

		

		//// PENDANT APPEL ////
		while($appel){
			sleep(1);
			//FIN d'un appel
			if(StatusChannel($IdC) == "Stop" || (StatusDevice($Num) != "INUSE" && StatusDevice($Num) != "RINGINUSE")){
				//Racroche les 2 tel
				SuppressionChannel($NumC);
				SuppressionChannel($Num);
				$HeureFinAppel = new DateTime("NOW");
				sleep(1);
				$TempsAppel = $HeureFinAppel->diff($HeureAppel);
				echo $TempsAppel->format('%H:%I:%S')."\n";
				historique($HeureAppel->format('Y-m-d H:i:s'),$HeureFinAppel->format('Y-m-d H:i:s'),$TempsAppel->format('%H:%I:%S'),$resu["idlogin"],$tech,"OK",$connex);
				raccrocher($resu["idlogin"],$tech,$connex);	//fin popup + derniere appel tech
				dispo(1,$tech,$connex); //passe le technicien en dispo
				exit ("Fin d'appel \n");
				
			}

			


		}
	}
?>