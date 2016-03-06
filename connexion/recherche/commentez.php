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
	
	//si le mec a cliqué sur envoyer
    if(isset($_POST['submitted'])) {
		//recuperation du commentaire
		$comentaire = mysql_real_escape_string(htmlspecialchars($_POST['commentaire']));
		$id_recette = mysql_real_escape_string(htmlspecialchars($_POST['id']));
		
		//verif si commentaire vide
		if ($commenaire === '') {
			$mvcom = "Votre commentaire est vide veuillez en entrer un.";
			$haserror = true;
		}
		else {
			$comok = mysql_real_escape_string(htmlspecialchars($_POST['commentaire']));
			
		}
	}
	
	if (isset($haserror)) {
		header("location:index.php?mess=$mcom");
	}
	
	//si il n'y a pas d'erreur un on recupere la date et on insere dans bdd
	if (!isset($haserror)) {
		//inclusion du fichier pour la date en fr
		include("date-fr.php");
		//recup de la date et l'heure
		$date = date_fran();
		$heure = date("H:i");	
		
		//ajout du commentaire dans la bdd
		//recuperation de l'id pseudo
		$reqpseudo = "select ID_pseudo from pseudo where pseudo='$pseudo'";
		$execreqpseudo = mysql_query($reqpseudo, $dbc);
		$row = mysql_fetch_row($execreqpseudo);
		$id_pseudo = $row[0];
		
		//creation requete + execution equete insertion commentaire
		$req = "insert into commente (ID_recette, ID_pseudo, commentaire, date, heure) values ('$id_recette', '$id_pseudo', '$comok', '$date', '$heure')";
		mysql_query($req, $dbc);
		
		//redirection ver la page précédente
		header("location:affiche_recette.php?id_recette=$id_recette");
	}
?>