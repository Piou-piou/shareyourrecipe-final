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
		
		//recup image
		$image = $_FILES['image']['name'];
		$taille = $_FILES['image']['size'];
		$tmp = $_FILES['image']['tmp_name'];
		
		//verification si champs vide
		//verif de nom si vide + si existe deja
		if ($nom === '') {
			$mvnom = "<h6>Veuillez entrer un nom pour votre recette.</h6>";
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
                $mvnom = "<h6>Votre nom de reccette est trop court.</h6>";
                $haserror = true;
            }
            else if ($nom === $ligne_nombdd) {
                $mvnom = "<h6>Ce nom de recette est déjà utilisé.</h6>";
				$haserror = true;
            }
            else {
				setcookie("nom_post", $nom, (time()+5));
                $nom = mysql_real_escape_string(htmlspecialchars($_POST['nom']));
            }
		}
		//verif de ingredient si vide
		if (($ingredient1 === '') && ($ingredient2 === '') && ($ingredient3 === '') && ($ingredient4 === '') && ($ingredient5 === '') && ($ingredient6 === '') && ($ingredient7 === '') && ($ingredient8 === '') && ($ingredient9 === '') && ($ingredient10 === '')) {
			setcookie("ingredient1_post", $ingredient1, (time()+5));
			setcookie("ingredient2_post", $ingredient2, (time()+5));
			setcookie("ingredient3_post", $ingredient3, (time()+5));
			setcookie("ingredient4_post", $ingredient4, (time()+5));
			setcookie("ingredient5_post", $ingredient5, (time()+5));
			setcookie("ingredient6_post", $ingredient6, (time()+5));
			setcookie("ingredient7_post", $ingredient7, (time()+5));
			setcookie("ingredient8_post", $ingredient8, (time()+5));
			setcookie("ingredient9_post", $ingredient9, (time()+5));
			setcookie("ingredient10_post", $ingredient10, (time()+5));
			$mvingredient = "<h6>Veuillez entrer au minimum un ingrédient pour votre recette.</h6>";
			$haserror = true;
		}
		else {
			setcookie("ingredient1_post", $ingredient1, (time()+5));
			setcookie("ingredient2_post", $ingredient2, (time()+5));
			setcookie("ingredient3_post", $ingredient3, (time()+5));
			setcookie("ingredient4_post", $ingredient4, (time()+5));
			setcookie("ingredient5_post", $ingredient5, (time()+5));
			setcookie("ingredient6_post", $ingredient6, (time()+5));
			setcookie("ingredient7_post", $ingredient7, (time()+5));
			setcookie("ingredient8_post", $ingredient8, (time()+5));
			setcookie("ingredient9_post", $ingredient9, (time()+5));
			setcookie("ingredient10_post", $ingredient10, (time()+5));
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
			setcookie("quantite1_post", $quantite1, (time()+5));
			setcookie("quantite2_post", $quantite2, (time()+5));
			setcookie("quantite3_post", $quantite3, (time()+5));
			setcookie("quantite4_post", $quantite4, (time()+5));
			setcookie("quantite5_post", $quantite5, (time()+5));
			setcookie("quantite6_post", $quantite6, (time()+5));
			setcookie("quantite7_post", $quantite7, (time()+5));
			setcookie("quantite8_post", $quantite8, (time()+5));
			setcookie("quantite9_post", $quantite9, (time()+5));
			setcookie("quantite10_post", $quantite10, (time()+5));
			$mvquantite = "<h6>Veuillez entrer au minimum une quantite pour votre recette.</h6>";
			$haserror = true;
		}
		else {
			setcookie("quantite1_post", $quantite1, (time()+5));
			setcookie("quantite2_post", $quantite2, (time()+5));
			setcookie("quantite3_post", $quantite3, (time()+5));
			setcookie("quantite4_post", $quantite4, (time()+5));
			setcookie("quantite5_post", $quantite5, (time()+5));
			setcookie("quantite6_post", $quantite6, (time()+5));
			setcookie("quantite7_post", $quantite7, (time()+5));
			setcookie("quantite8_post", $quantite8, (time()+5));
			setcookie("quantite9_post", $quantite9, (time()+5));
			setcookie("quantite10_post", $quantite10, (time()+5));
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
			$mvpreparation = "<h6>Veuillez entrer une manière de preparer votre recette.</h6>";
			$haserror = true;
		}
		else if (strlen($preparation)<30) {
			$mvpreparation = "<h6>Votre préparation doit contenir au minimum 100 caractères.</h6>";
			$haserror = true;
		}
		else {
			setcookie("preparation_post", $preparation, (time()+5));
			$preparation = mysql_real_escape_string(htmlspecialchars($_POST['preparation']));
		}
		//si image vide
		if (empty($_FILES['image']['name'])) {
			$mvimg1 = "<h6>Vous n'avez pas mis d'image</h6>";
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
				$chemin_destination = './medias/image/';    
				move_uploaded_file($_FILES['image']['tmp_name'], $chemin_destination.$_FILES['image']['name']);
				$imageok = $_FILES['image']['name'];
				$urlimg = "http://shareyourrecipe.fr/final/connexion/ajouter_une_recette/medias/image/$imageok";
			}
		}	
	}
	
	//si il y a des erreurs
	if(isset($haserror)) {
        header("location:index.php?nom=$mvnom&image=$mvimg&ingredient=$mvingredient&quantite=$mvquantite&preparation=$mvpreparation&conseil=$mvconseil");
    }
	
	// si tout ça est ok, on insert dans la bdd
	if(!isset($haserror)) {
		//recup de l'id_pseudo pour le mettre dans les differentes tables
		$reqpseudo = "select ID_pseudo from pseudo where pseudo='$pseudo'";
		$resreqpseudo = mysql_query($reqpseudo, $dbc);
		while ($ligne = mysql_fetch_row($resreqpseudo)) {
			$ID_pseudo = $ligne[0];
		}
		//creation de la requete pour ajouter la preparation
		$req = "insert into recette (nom_recette, preparation, conseil, ID_pseudo) values ('$nom', '$preparation', '$conseil', '$ID_pseudo')";
		mysql_query($req, $dbc);
		
		//ajout des ingredients
		$req1 = "insert into ingredient (ingredient1, ingredient2, ingredient3, ingredient4, ingredient5, ingredient6, ingredient7, ingredient8, ingredient9, ingredient10) values('$ingredient1', '$ingredient2', '$ingredient3', '$ingredient4', '$ingredient5', '$ingredient6', '$ingredient7', '$ingredient8', '$ingredient9', '$ingredient10')";
		mysql_query($req1, $dbc);
		
		//selection de l'id recette que l'on vient d'ajouter
		$reqrecette = "select ID_recette from recette where nom_recette='$nom'";
		$resreqrecette = mysql_query($reqrecette, $dbc);
		while ($ligne1 = mysql_fetch_row($resreqrecette)) {
			$ID_recette = $ligne1[0];
		}
		
		//selection de l'id ingredient que l'on vient d'ajouter
		$reqingredient = "select ID_ingredient from ingredient where ingredient1='$ingredient1'";
		$resreqingredient = mysql_query($reqingredient, $dbc);
		while ($ligne2 = mysql_fetch_row($resreqingredient)) {
			$ID_ingredient = $ligne2[0];
		}
		
		//ajout du conteneur de la recette dans table contient
		$req2 = "insert into contient (quantite1, quantite2, quantite3, quantite4, quantite5, quantite6, quantite7, quantite8, quantite9, quantite10, image, ID_recette, ID_ingredient) values ('$quantite1', '$quantite2', '$quantite3', '$quantite4', '$quantite5', '$quantite6', '$quantite7', '$quantite8', '$quantite9', '$quantite10', '$urlimg', '$ID_recette', '$ID_ingredient')";
		mysql_query($req2, $dbc);
		
		//on redirige vers index de ajout recette
		header("location:../recherche/affiche_recette.php?id_recette=$ID_recette");
		
	}
?>	