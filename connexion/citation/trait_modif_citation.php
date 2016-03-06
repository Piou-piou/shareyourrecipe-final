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
	$citation = mysql_real_escape_string(htmlspecialchars($_POST['citation']));

	
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
		if ($citation === '') {
			$mvcitation = "Veuillez entrez une citation.";
			$haserror = true;
		}
		else {
            if (strlen($citation)<5) {
                $mvcitation = "Votre citation est trop courte.";
                $haserror = true;
            }
			else if (strlen($citation)>150) {
                $mvcitation = "Votre citation est trop longue.";
                $haserror = true;
			}
            else {
                $citationok = $citation;
            } 
        }
	}	
	
	if(isset($haserror)) {
        header("location:index.php?citation=$mvcitation");
    }
	
	if (!isset($haserror)) {
		//on modifie la citation dans la table identite
		$req1 = "update identite set citation='$citationok' where ID_pseudo='$id_pseudo'";
		mysql_query($req1, $dbc);
		header("location:../espacemembre.php");
	}
?>	