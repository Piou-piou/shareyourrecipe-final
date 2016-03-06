<?php
	error_reporting(E_ALL ^ E_NOTICE); // cache les erreurs de php
	
	Session_start();

	//si le user n'a rien mis dans login on lui de pense a se connecter
	if (!isset($_SESSION['login'])) {
		header("location:../login.php?mess=Pense a te connecter.");
	}
	
	$pseudo = $_SESSION['login'];

	//inclusion des fichiers utilies pour la connection
    include("projet_co_connect.inc");
    include('connect.php');
    
    //connection bdd
    $dbc = monconnect($dbname,$dbhost,$login,$password);
	
	//recuperation de l'id commentaire dans l'url
	$id_commentaire = $_GET['id_commentaire'];
	
	//recuperation de l'id_pseudo dans la table pseudo en fonction de la session
	$reqpseudo = "select ID_pseudo from pseudo where pseudo='$pseudo'";
	$execreqpseudo = mysql_query($reqpseudo, $dbc);
	$row = mysql_fetch_row($execreqpseudo);
	$id_pseudo = $row[0];
	
	//recuperation de l'id recette pour pouvor rediriger correctement
	$reqrec = "select ID_recette from commente where ID_commentaire='$id_commentaire' and ID_pseudo='$id_pseudo'";
	$execreqrec = mysql_query($reqrec, $dbc);
	$row2 = mysql_fetch_row($execreqrec);
	$id_recette = $row2[0];
	
	//recuperation de l'id_pseudo dans la table commente
	$reqpseudo1 = "select ID_pseudo from commente where ID_commentaire='$id_commentaire'";
	$execreqpseudo1 = mysql_query($reqpseudo1, $dbc);
	$row1 = mysql_fetch_row($execreqpseudo1);
	$id_pseudocom = $row1[0];
	
	//si id_pseudo = id_pseudocom sa veut dire que les deux id correspondent donc c'est bien son commentaire
	if ($id_pseudo == $id_pseudocom) {
		$req = "delete from commente where ID_commentaire='$id_commentaire' and ID_pseudo='$id_pseudocom'";
		mysql_query($req, $dbc);
		header("location:affiche_recette.php?&id_recette=$id_recette");
	}
	else {
		header("location:affiche_recette.php?mess=Ce commentaire n\'est pas le votre, vous ne pouvez pas le supprimer.");
	}
?>	