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
	include('testpassswd.php');
	$dbc = monconnect($dbname,$dbhost,$login,$password);
	
	//recup donnee postee dans form
	$mdp = md5(mysql_real_escape_string(htmlspecialchars($_POST['mdp'])));
	$mdp_new = md5(mysql_real_escape_string(htmlspecialchars($_POST['mdp_new'])));
	$verif_mdp_new = md5(mysql_real_escape_string(htmlspecialchars($_POST['verif_mdp_new'])));

	
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
		$nom = $ligne1[1];
		$prenom = $ligne1[2];
		$mail = $ligne1[3];
		$date = $ligne1[4];
		$cp = $ligne1[5];
		$citation = $ligne1[6];
		$mdpbdd = $ligne1[7];
	}
	
	//si le mec a cliqué sur envoyer
    if(isset($_POST['submitted'])) {
		//verif si mdp pas vide
		if (($mdp === '') || ($mdp_new === '') || ($verif_mdp_new === '')) {
			$mvmdp = "Veuillez remplir tous les champs.";
			$haserror = true;
		}
		else {
			//on verifie si mdp === mdpbdd
			if ($mdp === $mdpbdd) {
				$mdp_new = mysql_real_escape_string(htmlspecialchars($_POST['mdp_new']));
				$testmdp = testpassword($mdp_new);
				if (strlen($mdp_new)<5) {
				    $mvmdp = "Votre mot de passe est trop court.";
				    $haserror = true;
				}
				else if ($testmdp < 40) {
				    $mvmdp = "Votre mot de passe est trop simple.";
				    $haserror = true;
				}
				else {
				    $mdp_new = md5(mysql_real_escape_string(htmlspecialchars($_POST['mdp_new'])));
				}
				//verif si verif_mdp_new pas vide + si correspond a mdp_new
				if($verif_mdp_new === '') {
					$mvverif_mdp = "Veuillez ré-entrer votre mot de passe pour pouvoir les vérifier.";
					$haserror = true;
				} 
				else {
					$verif_mdp_new = mysql_real_escape_string(htmlspecialchars($_POST['verif_mdp_new']));
					if (($_POST['mdp_new']) != ($_POST['verif_mdp_new'])) {
						$mvverif_mdp = "Les mots de passent ne correspondent pas.";
						$haserror = true;
					 }
					else {
						$verif_mdp = md5(mysql_real_escape_string(htmlspecialchars($_POST['verif_mdp_new'])));
					}
				}
			}
			else {
				$mvmdp = "Votre ancien mot de passe est incorrect";
				$haserror = true;
			}
        }
	}	
	
	if(isset($haserror)) {
        header("location:index.php?mdp=$mvmdp&verif_mdp=$mvverif_mdp");
    }
	
	if (!isset($haserror)) {
		//on modifie le pseudo dans la table pseudo
		$req2 = "update identite set mdp='$mdp_new' where ID_pseudo='$id_pseudo' and ID_identite='$ID_identite'";
		mysql_query($req2, $dbc);
		include("logout.php");
	}
?>	