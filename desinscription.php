<?php
    //inclusion des fichier pour la connexion a la bdd
    include('projet_co_connect.inc');
    include('connect.php');
    $dbc = monconnect($dbname,$dbhost,$login,$password);

    if($_GET['tru']==1) {
        // On crée un cookie qui expirera 25 secondes plus tard pour des raisons de sécurité.
        setcookie("redirection", time()+25);
        
        //mise dans une varaible de l'email contenu l'url
        $mail = $_GET['email'];
        
        //reverification si mail existe pas deja au cas ou user modifie url
        $mailbdd = "select mail from newsletter where mail='$mail'";
        $query = mysql_query($mailbdd, $dbc);
        while ($ligne = mysql_fetch_row($query)) {
            $ligne_mailbdd = $ligne[0];
        }
        /////////////////////////////////////////////
        if ($mail != $ligne_mailbdd) {
            header("location:index.php?mess=L'adresse E-mail que vous avez entré n'xeiste pas dans la base de données.");
            
        }
        else {
            $suprmailbdd = "delete from newsletter where mail='$mail'";
            mysql_query($suprmailbdd, $dbc);
            
            //envoi d'un email de confirmation
            // Initialisation de quelques informations statiques
            $adresse_dest = $mail;
            $sujet = "Validation de votre désinscription à la newsletter";
            $contenu_message = 'Vous allez être désinscrit de notre newsletter, nous vous remercions de l\'interet que vous avez porté à ce projet.';
            $headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= "From: shareyourrecipe@gmail.com";
            mail($adresse_dest, $sujet, $contenu_message, $headers);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Validation inscription Newsletter</title>
        <meta charset="UTF-8">
        <meta http-equiv="refresh" content="25; url=http://www.anthony-pilloud.fr/news/feedback.php" />
    </head>
    <body>
        <p>Votre désinscription à la newsletter à été effectué, vous allez recevoir un E-mail vous le confirmant sous peu.</p>
        <p>Vous allez etre redirigé vers la page d'accueil. Si la redirection ne fonctionne pas veuillez<a href="index.php">cliquer ici.</a></p>
    </body>
</html>
<?php
    //fermeture du else
    }
    //fermeture du if
    }
    else {
        header("location:index.php?mess=Il y a eu un problème lors de la suppression de votre adresse E-mail, veuillez réesseyer ultérieurement.");
    }
?>    
