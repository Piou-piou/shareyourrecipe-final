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
	
	$target = 'sftp://SRC1_2011_12_19@src-projet.pu-pm.univ-fcomte.f/home/projets/Projets_2011_12/SRC1_2011_12_19/SiteFinal/connexion/img_profil/';   // Repertoire cible
	$extension = 'jpg'; // Extension du fichier sans le .
	$extension2 = 'png';
	$extension3 = 'jpeg';
	$extension4 = 'gif';
	$max_size = 20971520; // Taille max en octets du fichier (20Mo)
	$width_max = 1920; // Largeur max de l'image en pixels
	$height_max = 1200; // Hauteur max de l'image en pixels
	
	//recup de tout dans pseudo id + pseudo
	$req = "select * from pseudo where pseudo='$pseudo'";
	$query = mysql_query($req, $dbc);
	while ($ligne = mysql_fetch_row($query)) {
		$id_pseudo = $ligne[0];
		$pseudo = $ligne[1];
	}
	
	if(isset($_POST['submitted'])) {
		//recup image
        $image = $_FILES['image']['name'];
        $taille = $_FILES['image']['size'];
        $tmp = $_FILES['image']['tmp_name'];
		
		//si image vide
		if (empty($_FILES['image']['name'])) {
			$mvimg = "<h6>Vous n'avez pas mis d'image</h6>";
			$haserror = true;
		}
		else {
			//recuperation info sur img
			$infos_img = getimagesize($_FILES['image']['tmp_name']);
			
			if(substr($image, -3) == (!$extension || !$extension2 || !$extension3 || !$extension4)) {
				$mvimg = "<h6>Votre image ne comporte pas l'extension .jpg</h6>";
				$haserror = true;
			}
			else if(($infos_img[0] >= $width_max) && ($infos_img[1] >= $height_max) && ($_FILES['image']['size'] >= $max_size)) {
				$mvimg = "<h6>Problème dans les dimensions ou taille de l\'image.</h6>";
				$haserror = true;
			}
			else {
				$chemin_destination = './img_profil/';    
				move_uploaded_file($_FILES['image']['tmp_name'], $chemin_destination.$_FILES['image']['name']);
				$imageok = $_FILES['image']['name'];
				$urlimg = "https://src-projet.pu-pm.univ-fcomte.fr/projets_collectifs/SRC1_2011_2012/SRC1_2011_12_19/SiteFinal/connexion/img_profil/$imageok";
			}
		}
	}
	
	//si il y a des erreurs
	if(isset($haserror)) {
		header("location:image.php?image=$mvimg");
    }
	
	// si tout ça est ok, on insert dans la bdd
	if(!isset($haserror)) {
		//on modifie le pseudo dans la table pseudo
		$req = "update identite set img_profil='$urlimg' where ID_pseudo='$id_pseudo'";
		mysql_query($req, $dbc);
		
		header("location:espacemembre.php");
	}	
?>