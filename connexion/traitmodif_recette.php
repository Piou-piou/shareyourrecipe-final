<?php
	error_reporting(E_ALL ^ E_NOTICE); // cache les erreurs de php
	
	Session_start();

	//si le user n'a rien mis dans login on lui de pense a se connecter
	if (!isset($_SESSION['login'])) {
		header("location:../login.php?mess=Pense a te connecter.");
	}
	
	$pseudo = $_SESSION['login'];

	//inclusion des fichiers utilies pour la connection
    include('projet_co_connect.inc');
    include('connect.php');
    
    //connection bdd
    $dbc = monconnect($dbname,$dbhost,$login,$password);
	
	$target = 'sftp://SRC1_2011_12_19@src-projet.pu-pm.univ-fcomte.f/home/projets/Projets_2011_12/SRC1_2011_12_19/SiteFinal/connexion/ajouter_une_recette/medias/image/';  // Repertoire cible
	$extension = 'jpg'; // Extension du fichier sans le .
	$extension2 = 'png';
	$extension3 = 'jpeg';
	$extension4 = 'gif';
	$max_size = 20971520; // Taille max en octets du fichier (20Mo)
	$width_max = 1920; // Largeur max de l'image en pixels
	$height_max = 1200; // Hauteur max de l'image en pixels

	
	//si le mec a cliqué sur envoyer
    if(isset($_POST['submitted'])) {
		//recuperation des champs et nettoyage de ceux-ci avec trim
		$nom = mysql_real_escape_string(htmlspecialchars($_POST['nom']));
		$ingredient1 = mysql_real_escape_string(htmlspecialchars($_POST['ingredient1']));
		$ingredient2 = mysql_real_escape_string(htmlspecialchars($_POST['ingredient2']));
		$ingredient3 = mysql_real_escape_string(htmlspecialchars($_POST['ingredient3']));
		$ingredient4 = mysql_real_escape_string(htmlspecialchars($_POST['ingredient4']));
		$ingredient5 = mysql_real_escape_string(htmlspecialchars($_POST['ingredient5']));
		$ingredient6 = mysql_real_escape_string(htmlspecialchars($_POST['ingredient6']));
		$ingredient7 = mysql_real_escape_string(htmlspecialchars($_POST['ingredient7']));
		$ingredient8 = mysql_real_escape_string(htmlspecialchars($_POST['ingredient8']));
		$ingredient9 = mysql_real_escape_string(htmlspecialchars($_POST['ingredient9']));
		$ingredient10 = mysql_real_escape_string(htmlspecialchars($_POST['ingredient10']));
		$quantite1 = mysql_real_escape_string(htmlspecialchars($_POST['quantite1']));
		$quantite2 = mysql_real_escape_string(htmlspecialchars($_POST['quantite2']));
		$quantite3 = mysql_real_escape_string(htmlspecialchars($_POST['quantite3']));
		$quantite4 = mysql_real_escape_string(htmlspecialchars($_POST['quantite4']));
		$quantite5 = mysql_real_escape_string(htmlspecialchars($_POST['quantite5']));
		$quantite6 = mysql_real_escape_string(htmlspecialchars($_POST['quantite6']));
		$quantite7 = mysql_real_escape_string(htmlspecialchars($_POST['quantite7']));
		$quantite8 = mysql_real_escape_string(htmlspecialchars($_POST['quantite8']));
		$quantite9 = mysql_real_escape_string(htmlspecialchars($_POST['quantite9']));
		$quantite10 = mysql_real_escape_string(htmlspecialchars($_POST['quantite10']));
		$preparation = mysql_real_escape_string(htmlspecialchars($_POST['preparation']));
		$conseil = mysql_real_escape_string(htmlspecialchars($_POST['conseil']));
		
		//on recup id_pseudo en fonction du pseudo
		$id_pseudobdd = "select ID_pseudo from pseudo where pseudo='$pseudo'";
		$exeid_pseudobdd = mysql_query($id_pseudobdd, $dbc);
        while ($ligne0 = mysql_fetch_row($exeid_pseudobdd)) {
            $id_pseudo = $ligne0[0];
        }
		
		//on verifie si le nom du post === nom dans bdd
		$id_recbdd = "select nom_recette from recette where ID_pseudo='$id_pseudo'";
		$exeid_recbdd = mysql_query($id_recbdd, $dbc);
        while ($ligne1 = mysql_fetch_row($exeid_recbdd)) {
            $ligne_nomrec = $ligne1[0];
        }
		
		//recup image
		$image = $_FILES['image']['name'];
		$taille = $_FILES['image']['size'];
		$tmp = $_FILES['image']['tmp_name'];
		
		//verification si champs vide
		//verif de nom si vide + si existe deja
		if ($nom === '') {
			$mvnom = "Veuillez entrer un nom pour votre recette.";
			$haserror = true;
		}
		else {
			//requete pour savoir si nom recette deja utilisé
            $nombdd = "select nom_recette from recette where nom_recette='$nom'";
            $query = mysql_query($nombdd, $dbc);
            while ($ligne = mysql_fetch_row($query)) {
                $ligne_nombdd = $ligne[0];
            }
            /////////////////////////////////////////////
            if (strlen($nom)<5) {
                $mvnom = "Votre nom de reccette est trop court.";
                $haserror = true;
            }
			else if ($nom === $ligne_nomrec) {
				$nom = mysql_real_escape_string(htmlspecialchars($_POST['nom']));
			}
            else if ($nom === $ligne_nombdd) {
                $mvnom = "Ce nom de recette est déjà utilisé.";
				$haserror = true;
            }
            else {
                $nom = mysql_real_escape_string(htmlspecialchars($_POST['nom']));
            }
		}
		//verif de ingredient si vide
		if (($ingredient1 === '') && ($ingredient2 === '') && ($ingredient3 === '') && ($ingredient4 === '') && ($ingredient5 === '') && ($ingredient6 === '') && ($ingredient7 === '') && ($ingredient8 === '') && ($ingredient9 === '') && ($ingredient10 === '')) {
			$mvingredient = "<h6>Veuillez entrer au minimum un ingrédient pour votre recette.</h6>";
			$haserror = true;
		}
		else {
			$ingredient1 = mysql_real_escape_string(htmlspecialchars($_POST['ingredient1']));
			$ingredient2 = mysql_real_escape_string(htmlspecialchars($_POST['ingredient2']));
			$ingredient3 = mysql_real_escape_string(htmlspecialchars($_POST['ingredient3']));
			$ingredient4 = mysql_real_escape_string(htmlspecialchars($_POST['ingredient4']));
			$ingredient5 = mysql_real_escape_string(htmlspecialchars($_POST['ingredient5']));
			$ingredient6 = mysql_real_escape_string(htmlspecialchars($_POST['ingredient6']));
			$ingredient7 = mysql_real_escape_string(htmlspecialchars($_POST['ingredient7']));
			$ingredient8 = mysql_real_escape_string(htmlspecialchars($_POST['ingredient8']));
			$ingredient9 = mysql_real_escape_string(htmlspecialchars($_POST['ingredient9']));
			$ingredient10 = mysql_real_escape_string(htmlspecialchars($_POST['ingredient10']));
		}
		//verif de quantite si vide
		if (($quantite1 === '') && ($quantite2 === '') &&($quantite3 === '') &&($quantite4 === '') &&($quantite5 === '') &&($quantite6 === '') &&($quantite7 === '') &&($quantite8 === '') &&($quantite9 === '') &&($quantite10 === '')) {
			$mvquantite = "<h6>Veuillez entrer au minimum une quantite pour votre recette.</h6>";
			$haserror = true;
		}
		else {
			$quantite1 = mysql_real_escape_string(htmlspecialchars($_POST['quantite1']));
			$quantite2 = mysql_real_escape_string(htmlspecialchars($_POST['quantite2']));
			$quantite3 = mysql_real_escape_string(htmlspecialchars($_POST['quantite3']));
			$quantite4 = mysql_real_escape_string(htmlspecialchars($_POST['quantite4']));
			$quantite5 = mysql_real_escape_string(htmlspecialchars($_POST['quantite5']));
			$quantite6 = mysql_real_escape_string(htmlspecialchars($_POST['quantite6']));
			$quantite7 = mysql_real_escape_string(htmlspecialchars($_POST['quantite7']));
			$quantite8 = mysql_real_escape_string(htmlspecialchars($_POST['quantite8']));
			$quantite9 = mysql_real_escape_string(htmlspecialchars($_POST['quantite9']));
			$quantite10 = mysql_real_escape_string(htmlspecialchars($_POST['quantite10']));
		}
		//si preparation vide
		if ($preparation === '') {
			$mvpreparation = "Veuillez entrer une manière de preparer votre recette.";
			$haserror = true;
		}
		else if (strlen($preparation)<30) {
			$mvpreparation = "Votre préparation doit contenir au minimum 30 caractères.";
			$haserror = true;
		}
		else {
			$preparation = mysql_real_escape_string(htmlspecialchars($_POST['preparation']));
		}
		if (empty($_FILES['image']['name'])) {
			$vide = true;
		}
		else {
			//recuperation info sur img
			$infos_img = getimagesize($_FILES['image']['tmp_name']);
			
			if(substr($image, -3) == (!$extension || !$extension2 || !$extension3 || !$extension4)) {
				$mvimg = "Votre image ne comporte pas l'extension .jpg";
				$haserror = true;
			}
			else if(($infos_img[0] >= $width_max) && ($infos_img[1] >= $height_max) && ($_FILES['image']['size'] >= $max_size)) {
				$mvimg = "Problème dans les dimensions ou taille de l\'image.";
				$haserror = true;
			}
			else {
				$chemin_destination = './ajouter_une_recette/medias/image/';    
				move_uploaded_file($_FILES['image']['tmp_name'], $chemin_destination.$_FILES['image']['name']);
				$imageok = $_FILES['image']['name'];
				$urlimg = "https://src-projet.pu-pm.univ-fcomte.fr/projets_collectifs/SRC1_2011_2012/SRC1_2011_12_19/SiteFinal/connexion/ajouter_une_recette/medias/image/$imageok";
			}
		}
	}
	
	//si il y a des erreurs
	if(isset($haserror)) {
        header("location:modif_recette.php?nom=$mvnom&image=$mvimg&ingredient=$mvingredient&preparation=$mvpreparation&conseil=$mvconseil");
    }
	
	// si tout ça est ok, on insert dans la bdd
	if(!isset($haserror)) {
		//on recupere les id
		$id_recette = $_POST['id_recette'];
		//id_contient + id_ingredient
		$reqid_contient = "select * from contient where ID_recette='$id_recette'";
		$exereqid_contient = mysql_query($reqid_contient, $dbc);
		$row = mysql_fetch_row($exereqid_contient);
		$id_contient = $row[0];
		$id_ingredient = $row[13];
		
		//modification recette
		$req = "update recette set nom_recette='$nom', preparation='$preparation', conseil='$conseil' where ID_recette='$id_recette'";
		mysql_query($req, $dbc);
		
		//modifcation ingredient
		$req1 = "update ingredient set ingredient1='$ingredient1', ingredient2='$ingredient2', ingredient3='$ingredient3', ingredient4='$ingredient4', ingredient5='$ingredient5', ingredient6='$ingredient6', ingredient7='$ingredient7', ingredient8='$ingredient8', ingredient9='$ingredient9', ingredient10='$ingredient10' where ID_ingredient='$id_ingredient'";
		mysql_query($req1, $dbc);
		
		//modification contient si img vide
		if (isset($vide)) {
			$req2 = "update contient set quantite1='$quantite1', quantite2='$quantite2', quantite3='$quantite3', quantite4='$quantite4', quantite5='$quantite5', quantite6='$quantite7', quantite8='$quantite8', quantite9='$quantite9', quantite10='$quantite10' where ID_contient='$id_contient'";
			mysql_query($req2, $dbc);
		}
		else {
			$req2 = "update contient set quantite1='$quantite1', quantite2='$quantite2', quantite3='$quantite3', quantite4='$quantite4', quantite5='$quantite5', quantite6='$quantite7', quantite8='$quantite8', quantite9='$quantite9', quantite10='$quantite10', image='$urlimg' where ID_contient='$id_contient'";
			mysql_query($req2, $dbc);
		}
		
		
		//on redirige vers l'affichage de la recette
		header("location:recherche/affiche_recette.php?id_recette=$id_recette");
	}
?>	