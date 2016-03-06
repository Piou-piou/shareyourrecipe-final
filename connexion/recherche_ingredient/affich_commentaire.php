<?php
	error_reporting(E_ALL ^ E_NOTICE); // cache les erreurs de php

	//recuperation des commentaries
	$reqcom = "select * from commente where ID_recette='$id_recette'";
	$querycom = mysql_query($reqcom, $dbc);
			
	while ($lignecom = mysql_fetch_row($querycom)) {
		//recup id_commentaire
		$id_commentaire = $lignecom[0];
		//recup du pseudo dans commente
		$id_pseudo = $lignecom[2];
				
		//recuperation du pseudo dans la bdd
		$reqpseudo = "select pseudo from pseudo where ID_pseudo='$id_pseudo'";
		$execreqpseudo = mysql_query($reqpseudo, $dbc);
		$row = mysql_fetch_row($execreqpseudo);
		$pseudobdd = $row[0];
				
		//ligne[3]=commentaire et $ligne[4]=date
		//definition du commentaire
		$com = stripslashes(htmlspecialchars_decode($lignecom[3]));
		
		echo("<div class='commentaire'><a class='nom'>$pseudobdd </a>");
		//si pseudobdd = pseudo dans login on affich pour delete le commentaire
		if ($pseudo == $pseudobdd) {
			echo("$com <span id='com'><a href='supprim_commentaire.php?id_commentaire=$id_commentaire&id_recette=$lignecom[0]'>Supprimer   </a>");
		}
		else {
			echo("$com");
		}
		echo("</br><span>$lignecom[4],");
		echo(" $lignecom[5]</span></div> <br><br>");
		
	}
?>