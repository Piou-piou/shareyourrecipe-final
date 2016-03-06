<?php
	error_reporting(E_ALL ^ E_NOTICE); // cache les erreurs de php

	//inclusion des fichiers utilies pour la connection
    include('projet_co_connect.inc');
    include('connect.php');
    
    //connection bdd
    $dbc = monconnect($dbname,$dbhost,$login,$password);

	//creation de noms abreges pur les variables
	$mail = mysql_real_escape_string(htmlspecialchars($_POST['mail']));
	
	//verfification si mail pas vide + si correspond bien a un mail
	if(isset($_POST['submitted'])) {
		if ($mail === '') {
			header("location:index.php?mess=Veuillez entrer votre adresse E-mail");
			$haserror = true;
		}
		else {
			if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", $mail)) {
				header("location:index.php?mess=Vous avez entré une adresse E-mail incorrecte.");
				$haserror = true;
			}
			//reverification si mail existe pas deja au cas ou user modifie url
			$mailbdd = "select mail from newsletter where mail='$mail'";
            $query = mysql_query($mailbdd, $dbc);
            while ($ligne = mysql_fetch_row($query)) {
                $ligne_mailbdd = $ligne[0];
            }
            /////////////////////////////////////////////
			if (($mail === $ligne_mailbdd) && ($radio == 0)) {
                header("location:index.php?mess=Cette adresse E-mail est déjà utilisé. Veuillez en choisir une autre.");
				$haserror = true;
            }
			else if (($mail != $ligne_mailbdd) && ($radio == 1)) {
                header("location:index.php?mess=Veuillez vous inscrire à la newsletter.");
				$mailok = $mail;
				setcookie("mail_post", $mailok, (time()+5));
				$haserror = true;
            }
			else {
				$mailok = $mail;
				setcookie("mail_post", $mailok, (time()+5));
			}
		}
    }
	
	if(!isset($haserror)) {
		//on indique que pour valider inscription faut cliquer sur le lien du mail
			//insertion de l'email dans la bdd
                $req = "insert into newsletter (mail) values ('$mailok')";
                mysql_query($req, $dbc);
				
				//le mail est correct, on lui envoi un mail
				$adresse_dest = $mailok;
				
				//envoi d'un email de confirmation
                // Initialisation de quelques informations statiques
                $sujet = "Validation de votre inscription à la newsletter";
                $contenu_message = 'Merci de vous être inscrit sur ShareYourRecipe, vous receverez la première newsletter sous peu.';
                $headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                $headers .= "From: shareyourrecipe@gmail.com";
                //mail($adresse_dest, $sujet, $contenu_message, $headers);
				
				header("location:index.php?mess=Vous avez été inscrit à notre newsletter");
	}
?>