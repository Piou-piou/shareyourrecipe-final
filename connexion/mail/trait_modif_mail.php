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
	$emailurl = mysql_real_escape_string(htmlspecialchars($_POST['mail']));
	
	//recup de tout dans pseudo id + pseudo
	$req = "select * from pseudo where pseudo='$pseudo'";
	$query = mysql_query($req, $dbc);
	while ($ligne = mysql_fetch_row($query)) {
		$id_pseudo = $ligne[0];
		$pseudo = $ligne[1];
	}	
	
	$req1 = "select * from identite where ID_pseudo = '$id_pseudo'";
	$query1 = mysql_query($req1, $dbc);
	
	//afficahge des données de l'étudiant	
	while ($ligne1 = mysql_fetch_row($query1)) {
		$ID_identite = $ligne1[0];
		$mail = $ligne1[3];
	}
	
	//si le mec a cliqué sur envoyer
    if(isset($_POST['submitted'])) {
		//verif si mail pas vide + si correspond bien a un mail avec @ et tout et tout
        if($emailurl === '') {
            $mvmail = "Veuillez entrer votre adresse E-mail.";
            $haserror = true;
        } 
        else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", $emailurl)) {
            $mvmail = "Vous avez entré une adresse E-mail incorrecte.";
            $haserror = true;
        }
        else {
            //requete pour savoir si mail deja utilisé
            $mailbdd = "select mail from identite where mail='$emailurl'";
            $req_query1 = mysql_query($mailbdd, $dbc);
            while ($ligne1 = mysql_fetch_row($req_query1)) {
                $ligne_mailbdd = $ligne1[0];
            }
            /////////////////////////////////////////////
			if ($emailurl === $mail) {
				$emailook = $emailurl;
			}
            else if ($emailurl === $ligne_mailbdd) {
                $mvmail = "Ce mail est déjà utilisé.";
                $haserror = true;
            }
            else {
                $emailook = $emailurl;
            } 
        }
	}
	
	if(isset($haserror)) {
        header("location:index.php?mail=$mvmail");
    }
	
	if (!isset($haserror)) {
		//on modifie le mail + citation dans la table identite
		$req = "update identite set mail='$emailook' where ID_identite='$ID_identite'";
		mysql_query($req, $dbc);
		header("location:../espacemembre.php");
	}
?>	