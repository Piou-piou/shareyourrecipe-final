<?php
	//ce code strictemement le meme sur n'imorte quel srv
	function monconnect($dbname,$dbhost,$login,$password){
		$db = mysql_connect($dbhost,$login,$password);
		if(!$db) {
			header("Location : erreur.php? mess='erreur de connexion'");
		}
		else {
			$resultat = mysql_select_db($dbname,$db);
			if(!$resultat) {
				header("location: erreur.php? mess='Impossible de selectionner la base'");
				return(0);
			}
		}
		return($db);
	}
	//or die("Impossible de se connecter : " . mysql_error());
?>