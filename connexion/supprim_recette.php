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
	
	//connection bdd
	$dbc = monconnect($dbname,$dbhost,$login,$password);
	
	//recuperation de l'id recette de l'url
	$id_recette = $_GET['id_recette'];
	
	//recuperation de l'id_pseudo dans la table pseudo en fonction de la session
	$reqpseudo = "select ID_pseudo from pseudo where pseudo='$pseudo'";
	$execreqpseudo = mysql_query($reqpseudo, $dbc);
	$row = mysql_fetch_row($execreqpseudo);
	$id_pseudo = $row[0];
	
	//recuperation de l'id_pseudo dans la table recette
	$reqpseudo1 = "select ID_pseudo from recette where ID_recette='$id_recette'";
	$execreqpseudo1 = mysql_query($reqpseudo1, $dbc);
	$row1 = mysql_fetch_row($execreqpseudo1);
	$id_pseudorecet = $row1[0];
	
	//si id_pseudo dans pseudo est egal a id_pseuodo dans recette
	if ($id_pseudo == $id_pseudorecet) {
		//recup de l'id_contient + id_ingredient
		$req = "select * from contient where ID_recette='$id_recette'";
		$query = mysql_query($req, $dbc);
		$row = mysql_fetch_row($query);
		$id_contient = $row[0];
		$id_ingredient = $row[13];
		
		//suppression de la recette
		//suppression des commentaires
		$req1 = "delete from commente where ID_recette='$id_recette'";
		mysql_query($req1, $dbc);
		
		//suppression dans la table contient
		$req2 = "delete from contient where ID_contient='$id_contient'";
		mysql_query($req2, $dbc);
		
		//suppression dans la table ingredient
		$req3 = "delete from ingredient where ID_ingredient='$id_ingredient'";
		mysql_query($req3, $dbc);
		
		//suppression dans la table note
		$req4 = "delete from note where ID_recette='$id_recette'";
		mysql_query($req4, $dbc);
		
		//suppression dans table recette
		$req5 = "delete from recette where ID_recette='$id_recette'";
		mysql_query($req5, $dbc);
		
		header("location:affiche_mesrecettes.php?mess=Votre recette à été supprimée avec succès");
	}
	else {
		header("location:index.php?mess=Ce n\'est pas votre reccette, vous ne pouvez donc pas la supprimer.");
	}
?>	