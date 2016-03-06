<?php
    error_reporting(E_ALL ^ E_NOTICE); // cache les erreurs de php
    
    //inclusion des fichiers utilies pour la connection
    include('projet_co_connect.inc');
    include('connect.php');
    include('testpassswd.php');
    
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
    
    //recuperationj des champs
    $prenom =  mysql_real_escape_string(htmlspecialchars($_POST['prenom']));
    $nom = mysql_real_escape_string(htmlspecialchars($_POST['nom']));
    $pseudo = mysql_real_escape_string(htmlspecialchars($_POST['pseudo']));
    $mdp = mysql_real_escape_string(htmlspecialchars($_POST['mdp']));
    $verif_mdp = mysql_real_escape_string(htmlspecialchars($_POST['verif_mdp']));
    $mail = mysql_real_escape_string(htmlspecialchars($_POST['mail']));
    $verif_mail = mysql_real_escape_string(htmlspecialchars($_POST['verif_mail']));
    $jour = mysql_real_escape_string(htmlspecialchars($_POST['jour']));
    $mois = mysql_real_escape_string(htmlspecialchars($_POST['mois']));
    $annee = mysql_real_escape_string(htmlspecialchars($_POST['annee']));
    $citation = mysql_real_escape_string(htmlspecialchars($_POST['citation']));
	$robot = mysql_real_escape_string(htmlspecialchars($_POST['robot']));

    //si le mec a cliqué sur envoyer
    if(isset($_POST['submitted'])) {
        
        //recup image
        $image = $_FILES['image']['name'];
        $taille = $_FILES['image']['size'];
        $tmp = $_FILES['image']['tmp_name'];
 
        //verif si prenom est vide ou pas
        if($prenom === '') {
            $mvprenom = "<h6>Veuillez entrer votre prenom.</h6>";
            $haserror = true;
        } 
        else {
            setcookie("prenom_post", $prenom, (time()+5));
            $prenom = mysql_real_escape_string(htmlspecialchars($_POST['prenom']));
        }
        //verif si nom est pas vide
        if($nom === '') {
            $mvnom = "<h6>Veuillez entrer votre nom.</h6>";
            $haserror = true;
        } 
        else {
            setcookie("nom_post", $nom, (time()+5));
            $nom = mysql_real_escape_string(htmlspecialchars($_POST['nom']));
        }
        //verif si pseudo pas vide + si + de 5 caracteres + si pas deja existant
        if($pseudo === '') {
            $mvpseudo = "<h6>Veuillez entrer un pseudo.</h6>";
            $haserror = true;
        } 
        else {
            $pseudo = mysql_real_escape_string(htmlspecialchars($_POST['pseudo']));
            //requete pour savoir si pseudo deja utilisé
            $pseudobdd = "select pseudo from pseudo where pseudo='$pseudo'";
            $req_query = mysql_query($pseudobdd, $dbc);
            while ($ligne = mysql_fetch_row($req_query)) {
                $ligne_pseudobdd = $ligne[0];
            }
            /////////////////////////////////////////////
            if (strlen($pseudo)<5) {
                setcookie("pseudo_post", $pseudo, (time()+5));
                $mvpseudo = "<h6>Votre pseudo est trop court.</h6>";
                $haserror = true;
            }
            else if ($pseudo === $ligne_pseudobdd) {
                $mvpseudo = "<h6>Ce pseudo est déjà utilisé.</h6>";
                $haserror = true;
            }
            else {
                setcookie("pseudo_post", $pseudo, (time()+5));
                $pseudo = mysql_real_escape_string(htmlspecialchars($_POST['pseudo']));
            }    
        }
        //si image vide
		if (empty($_FILES['image']['name'])) {
			$mvimg = "<h6>Vous n'avez pas mis d'image</h6>";
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
				$urlimg = "http://shareyourrecipe.fr/final/connexion/img_profil/$imageok";
			}
		}
        //verif si mdp est pas vide et si + de 5 caracteres
        if($mdp === '') {
            $mvmdp = "<h6>Veuillez entrer un mot de passe. </h6>";
            $haserror = true;
        } 
        else {
            $mdp = mysql_real_escape_string(htmlspecialchars($_POST['mdp']));
            $testmdp = testpassword($mdp);
            if (strlen($mdp)<5) {
                $mvmdp = "<h6>Votre mot de passe est trop court.</h6>";
                $haserror = true;
            }
            else if ($testmdp < 40) {
                $mvmdp = "Votre mot de passe est trop simple.</h6>";
                $haserror = true;
            }
            else {
                $mdp = md5(mysql_real_escape_string(htmlspecialchars($_POST['mdp'])));
            }      
        }
        //verif si verif_mdp pas vide + si correspond a mdp
        if($verif_mdp === '') {
            $mvverif_mdp = "<h6>Veuillez ré-entrer votre mot de passe pour pouvoir les vérifier.</h6>";
            $haserror = true;
        } 
        else {
            $verif_mdp = mysql_real_escape_string(htmlspecialchars($_POST['verif_mdp']));
            if (($_POST['mdp']) != ($_POST['verif_mdp'])) {
                $mvverif_mdp = "<h6>Les mots de passent ne correspondent pas.</h6>";
                $haserror = true;
            }
            else {
              $verif_mdp = mysql_real_escape_string(htmlspecialchars($_POST['verif_mdp']));
              
            }
        }
        //verif si mail pas vide + si correspond bien a un mail avec @ et tout et tout
        if($mail === '') {
            $mvmail = "<h6>Veuillez entrer votre adresse E-mail.</h6>";
            $haserror = true;
        } 
        else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", $mail)) {
            $mvmail = "<h6>Vous avez entré une adresse E-mail incorrecte.</h6>";
            $haserror = true;
        }
        else {
            $mail = mysql_real_escape_string(htmlspecialchars($_POST['mail']));
            //requete pour savoir si mail deja utilisé
            $mailbdd = "select mail from identite where mail='$mail'";
            $req_query1 = mysql_query($mailbdd, $dbc);
            while ($ligne1 = mysql_fetch_row($req_query1)) {
                $ligne_mailbdd = $ligne1[0];
            }
            /////////////////////////////////////////////
            if ($mail === $ligne_mailbdd) {
                $mvmail = "<h6>Ce mail est déjà utilisé.</h6>";
                $haserror = true;
            }
            else {
                setcookie("mail_post", $mail, (time()+5));
                $mail = mysql_real_escape_string(htmlspecialchars($_POST['mail']));
            } 
        } 
        //verif si verfi_mail est vide + si correspond a mail
        if($verif_mail === '') {
            $mvverif_mail = "<h6>Veuillez ré-entrer votre E-mail pour pouvoir les vérifier.</h6>";
            $haserror = true;
        }   
        else {
            if (($mail) != ($verif_mail)) {
                $mvverif_mail = "<h6>Les E-mails ne correspondent pas.</h6>";
                $haserror = true;
            }
            else {
                setcookie("verif_mail_post", $verif_mail, (time()+5));
                $verif_mail = mysql_real_escape_string(htmlspecialchars($_POST['verif_mail'])); 
            }
        }
        //verif si date pas vide (jour mois et annee
        if($jour === 'Selectionnez votre jour de naissance') {
            $mvdate = "<h6>Veuillez sélectionner un jour, un mois et une année de naissance pour que votre date de naissance soit correcte.</h6>";
            $haserror = true;
            if($mois === 'Selectionnez votre mois de naissance') {
                $mvdate = "<h6>Veuillez sélectionner un jour, un mois et une année de naissance pour que votre date de naissance soit correcte.</h6>";
                $haserror = true;
                if($annee === 'Selectionnez votre annee de naissance'){
                    $mvdate = "<h6>Veuillez sélectionner un jour, un mois et une année de naissance pour que votre date de naissance soit correcte.</h6>";
                    $haserror = true;
                }
            }
        }
        else {
            $jour = mysql_real_escape_string(htmlspecialchars($_POST['jour']));
            $mois = mysql_real_escape_string(htmlspecialchars($_POST['mois']));
            $annee = mysql_real_escape_string(htmlspecialchars($_POST['annee']));
            $date = "$jour/$mois/$annee";
        }
        //verif si citation pas trop longue
        if (strlen($citation) > 150) {
            $mvcitation = "<h6>Votre citation est trop longue.</h6>";
            $haserror = true;
        }
        else {
            setcookie("citation_post", $citaiton, (time()+5));
            $citation = mysql_real_escape_string(htmlspecialchars($_POST['citation']));
        }
		//verif si robot vide ou pas
		if ($robot != '') {
			$robot = "Vous êtes un robot, vous ne pouvez docn pas vous inscrire sur ce site.";
			$haserror = true;
		}
		else {
			$robot = $robot;
		}
    }
    
    if(isset($haserror)) {
        header("location:index.php?prenom=$mvprenom&nom=$mvnom&pseudo=$mvpseudo&mdp=$mvmdp&verif_mdp=$mvverif_mdp&mail=$mvmail&verif_mail=$mvverif_mail&date=$mvdate&citation=$mvcitation&image=$mvimg&robot=$robot");
    }
    
    // si tout ça est ok, on insert dans la bdd
	if(!isset($haserror)) {  
        //insertion pseudo
        $requete = "insert into pseudo (pseudo) values ('$pseudo')";
        mysql_query($requete, $dbc);
        
        //insertion dans identite 
        $requete1 = "insert into identite (nom, prenom, mdp, date_de_naissance, img_profil, mail, citation) values ('$nom', '$prenom', '$mdp', '$date', '$urlimg', '$mail', '$citation')";
        mysql_query($requete1, $dbc);
		
		//selection de l'id_identite dans la table identite
        $select = "select ID_identite from identite where nom='$nom' and prenom='$prenom'";
        $query = mysql_query($select, $dbc);
        //aficher query tant que qqch dans $ligne
        while ($ligne = mysql_fetch_row($query)) {
            $id = $ligne[0];
        }
        
        //selection de l'id_pseudo dans la table pseudo
        $select1 = "select ID_pseudo from pseudo where pseudo='$pseudo'";
        $query1 = mysql_query($select1, $dbc);
        //aficher query tant que qqch dans $ligne
        while ($ligne1 = mysql_fetch_row($query1)) {
            $id1 = $ligne1[0];
        }
        
        //insertion id_pseudo dans identite
        $requete2 = "UPDATE identite SET ID_pseudo='$id' WHERE ID_identite='$id'";
        $requete3 = "UPDATE pseudo SET ID_identite='$id' WHERE ID_pseudo='$id1'";
        
        mysql_query($requete2, $dbc);
        mysql_query($requete3, $dbc);
        
        $poste = "Votre compte à bien été crée veuillez vous connecter";
        header("location:login.php?poste=$poste");
    }    
?>