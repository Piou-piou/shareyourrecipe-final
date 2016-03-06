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
	
	//recuperation de l'id_pseudo dans la table pseudo en fonction de la session
	$reqpseudo = "select ID_pseudo from pseudo where pseudo='$pseudo'";
	$execreqpseudo = mysql_query($reqpseudo, $dbc);
	$row = mysql_fetch_row($execreqpseudo);
	$id_pseudo = $row[0];
	
	//recuperation de l'id_identite dans la table identite
	$reqidentite = "select ID_identite from identite where ID_pseudo='$id_pseudo'";
	$execreqidentite = mysql_query($reqidentite, $dbc);
	$row1 = mysql_fetch_row($execreqidentite);
	$id_identite = $row1[0];
	
	$req1 = "delete from identite where ID_identite='$id_identite'";
	mysql_query($req1, $dbc);
	
	//suppression des commentaire en focntion de l'id_pseudo
	$req2 = "delete from commente where ID_pseudo='$id_pseudo'";
	mysql_query($req2, $dbc);
	
	//suppression du pseudo dans pseudo
	$req = "delete from pseudo where ID_pseudo='$id_pseudo'";
	mysql_query($req, $dbc);
	
	session_start();
	$_SESSION['login'];
	unset($_SESSION['login']);
	session_destroy();

	//on reidrige vers page accueil avec mess qui dit compte bien delete
	header("location:login.php?mess=Votre compte à bien été supprimé.");
?>	