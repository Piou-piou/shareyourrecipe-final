<?php
	error_reporting(E_ALL ^ E_NOTICE); // cache les erreurs de php
	
	//avant toute chose faire un session start
	Session_start();
	
	//si le user n'a rien mis dans login on lui de pense a se connecter
	if (!isset($_SESSION['login'])) {
		header("location:../login.php?mess=Pense a te connecter.");
	}

	$pseudo = $_SESSION['login'];

	//inclusion des fichiers pour connect bdd
	include("projet_co_connect.inc");
	include("connect.php");
	
	//connection bdd
    $dbc = monconnect($dbname, $dbhost, $login, $password);
	
	//recuperation de la note + id_recette
	$note = mysql_real_escape_string(htmlspecialchars($_POST['note']));
	$id_recette = mysql_real_escape_string(htmlspecialchars($_POST['id_recette']));
	
	//requete pour recuperer l'id pseudo
	$reqpseudo = "select ID_pseudo from pseudo where pseudo='$pseudo'";
	$execreqpseudo = mysql_query($reqpseudo, $dbc);
	$rowpseudo = mysql_fetch_row($execreqpseudo);
	$id_pseudo = $rowpseudo[0];
	
	//requete pour recuperer la note actuelle
	$req = "select * from note";
	$query = mysql_query($req, $dbc);
	$row = mysql_fetch_row($query);
	$id_note = $row[0];
	$notebdd = $row[3];

	
	//si le mec a cliqué sur notez
	if (isset($_POST['submittednote'])) {
		//insertion de la nouvelle note dans bdd
		//recherche si user a deja mis une note
		//requete pour savoir si pseudo deja utilisé
        $pseudobdd = "select ID_pseudo from note where ID_recette='$id_recette'";
        $req_query = mysql_query($pseudobdd, $dbc);
        while ($ligne = mysql_fetch_row($req_query)) {
            $ligne_pseudobdd = $ligne[0];
        }
		
		//si user a deja rentre note pour cette recette on affiche erreur
		if ($id_pseudo == $ligne_pseudobdd) {
			header("location:affiche_recette.php?mess=<h6>Vous avez déjà noté cette recette.</h6>&id_recette=$id_recette");
		}
		//sinon on insere la note et on calcul la moyenne
		else {
			if ($note > 5) {
				header("location:affiche_recette.php?mess=<h6>Votre note ne doit pas dépasser 5.</h6>&id_recette=$id_recette");
			}
			else if ($note < 0) {
				header("location:affiche_recette.php?mess=<h6>Votre note ne doit pas être inférieure à 0.</h6>&id_recette=$id_recette");
			}
			else {
				$req1 = "insert into note (ID_recette, ID_pseudo, note) values ('$id_recette', '$id_pseudo', '$note')";
				mysql_query($req1, $dbc);
				
				//recuperation des notes pour cette recette
				$req2 = "select note from note where ID_recette='$id_recette'";
				$query = mysql_query($req2, $dbc);
				
				$numenr = mysql_num_rows($query);
				$res = 0;
				while($ligne = mysql_fetch_row($query)) {
					$res += ("$ligne[0]");
				}
				$moy = $res/$numenr;
			
				//insertion de la moyenne dans la bdd
				$req3 = "update moyenne set moyenne='$moy' where ID_recette='$id_recette'";
				mysql_query($req3, $dbc);
			
				//on redirige vers la page précédente
				header("location:affiche_recette.php?id_recette=$id_recette");
			}	
		}
	}
?>