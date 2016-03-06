<?php
	error_reporting(E_ALL ^ E_NOTICE); // cache les erreurs de php
	
	//avant toute chose faire un session start
	Session_start();

	//si le user n'a rien mis dans login on lui de pense a se connecter
	if (!isset($_SESSION['login'])) {
		header("location:login.php?mess=Pense a te connecter.");
	}
	
	$pseudo = $_SESSION['login'];
	
	//connection bdd
	include("projet_co_connect.inc");
	include('connect.php');
	$dbc = monconnect($dbname,$dbhost,$login,$password);
	
	//recup donnee postee dans form
	$pseudourl = mysql_real_escape_string(htmlspecialchars($_POST['pseudo']));

	
	//recup de tout dans pseudo id + pseudo
	$req = "select * from pseudo where pseudo='$pseudo'";
	$query = mysql_query($req, $dbc);
	while ($ligne = mysql_fetch_row($query)) {
		$id_pseudo = $ligne[0];
		$pseudo = $ligne[1];
	}	
	
	//si le mec a cliqué sur envoyer
    if(isset($_POST['submitted'])) {
		//verif si pseudourl pas vide
		if ($pseudourl === '') {
			$mvpseudo = "Veuillez entrez un pseudo.";
			$haserror = true;
		}
		else {
            //requete pour savoir si pseudo deja utilisé
            $pseudobdd = "select pseudo from pseudo where pseudo='$pseudourl'";
            $req_query = mysql_query($pseudobdd, $dbc);
            while ($ligne = mysql_fetch_row($req_query)) {
                $ligne_pseudobdd = $ligne[0];
            }
            /////////////////////////////////////////////
            if (strlen($pseudourl)<5) {
                $mvpseudo = "Votre pseudo est trop court.";
                $haserror = true;
            }
			else if ($pseudourl === $pseudo) {
				$pseudook = $pseudourl;
			}
            else if ($pseudourl === $ligne_pseudobdd) {
                $mvpseudo = "Ce pseudo est déjà utilisé.";
				$haserror = true;
            }
            else {
                $pseudook = $pseudourl;
            } 
        }
	}	
	
	if(isset($haserror)) {
        header("location:index.php?pseudo=$mvpseudo");
    }
	
	if (!isset($haserror)) {
		//on modifie le pseudo dans la table pseudo
		$req = "update pseudo set pseudo='$pseudook' where ID_pseudo='$id_pseudo'";
		mysql_query($req, $dbc);
		
		//on inclut le fichier logout pour deco
		include("logout.php");
	}
?>	