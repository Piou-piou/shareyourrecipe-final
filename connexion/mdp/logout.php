<?php
	error_reporting(E_ALL ^ E_NOTICE); // cache les erreurs de php
	
	session_start();
	$_SESSION['login'];
	unset($_SESSION['login']);
	session_destroy();

	header("location:../login.php?mess=Veuillez vous connecter avec votre nouveau mot de passe.");
?>