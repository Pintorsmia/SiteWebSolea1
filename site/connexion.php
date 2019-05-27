<?php
function connexionBDD() { // déclaration de la fonction connexionBDD

    include("paramCon.php"); // on "inclut" un fichier source contenant du code 
    $dsn='mysql:host='.$lehost.';dbname='.$dbname; //.';port='.$leport;
   
    // connexion à la bdd (connexion persistante)
    
	try {
        $connex = new PDO($dsn, $user, $pass); // tentative de connexion
    } catch (PDOException $e) { //si une erreur est repéré
        print "Erreur de connexion à la base de données ! : " . $e->getMessage();
       die(""); // Arrêt du script - sortie.
    }
    return $connex;
}	

function deconnexionBDD($connex) { //déclaration de la fonction deconnexionBDD
    $connex = null; // fermeture de la connexion a la base de donnees (même si demande de connexion persistante).
}