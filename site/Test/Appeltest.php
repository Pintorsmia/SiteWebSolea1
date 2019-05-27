<?php 

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
	$data = "endpoint=PJSIP%2F".$Numero."&extension=".$Extension."&app=".$Stasis."&timeout=-1&api_key=asterisk:asterisk";
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_exec($ch);
	curl_close($ch);
};
//Creation pour appel externe (client)\\
function CreationChannelExterne ($IdChannel,$Numero,$Extension,$Stasis){
	$ch = curl_init("http://10.1.3.251:8088/ari/channels/".$IdChannel);
	$data = "endpoint=PJSIP%2Fast_solea1%2Fsip:".$Numero."@192.168.176.59:5060&extension=".$Extension."&app=".$Stasis."&timeout=-1&api_key=asterisk:asterisk";
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
	return $reponse;
};


/*
CreationChannelInterne("11","11","site_aix","API-REST");
sleep(1);
CreationChannelExterne("5801","5801","entreprise","API-REST");
sleep(1);
CreationBridge("711");
sleep(5);
AjoutChanneldansBridge("711","11");
AjoutChanneldansBridge("711","5801");
*/
/*
$test="00565\n";
$test = substr($test,1); 
echo $test;
*/

CreationChannelExterne("5801","5801","entreprise","API-REST");


while (1){
	echo (StatusChannel ("5801"));
	sleep(1);
}
?>