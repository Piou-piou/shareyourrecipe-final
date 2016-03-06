<?php
	error_reporting(E_ALL ^ E_NOTICE); // cache les erreurs de php

	//avant toute chose faire un session start
	Session_start();

    //inclusion des fichiers utilies pour la connection
    include('projet_co_connect.inc');
    include('connect.php');
    
    //connection bdd
    $dbc = monconnect($dbname, $dbhost, $login, $password);
	
	//recup des donnees
	$pseudo = mysql_real_escape_string(htmlspecialchars($_POST['pseudo']));
	$mdp = md5(mysql_real_escape_string(htmlspecialchars($_POST['mdp'])));
		
	//recuperation du mdp + mail dans bdd
	//selection de l'id_pseudo + pseudo dans la table pseudo
    $req = "select pseudo, ID_pseudo from pseudo where pseudo='$pseudo'";
    $query = mysql_query($req, $dbc);
	$numenr = mysql_num_rows($query);
    //aficher query tant que qqch dans $ligne
    while ($ligne = mysql_fetch_row($query)) {
        $id = $ligne[1];
    }
	$req1 = "select mdp from identite where ID_pseudo='$id'";
	$query1 = mysql_query($req1, $dbc);

	
	//verif si num enr = 0
	if ($numenr == 0) {
		header("location:login.php?mess=<h6>Pseudo inconnu</h6>");
	}
	else {
		$mdpbdd = mysql_result($query1,0,"mdp");
		//si les mdp sont egaux on redirige ver esace membre sinon ver login avec un mess d'erreur
		if ($mdp == $mdpbdd) {
			$_SESSION['login'] = $pseudo;
			header("location:espacemembre.php");
		}
		else {
			header("location:login.php?mess=</h6>Mauvais mdp</h6>");
		}
	}
?>