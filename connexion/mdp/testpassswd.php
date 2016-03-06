<?php

function testpassword($mdp_new)	{ // $mdp le mot de passe pass� en param�tre

	// On r�cup�re la longueur du mot de passe	
	$longueur = strlen($mdp_new);

	// On fait une boucle pour lire chaque lettre
	for($i = 0; $i < $longueur; $i++) 	{
		
		// On s�lectionne une � une chaque lettre
		// $i �tant � 0 lors du premier passage de la boucle
		$lettre = $mdp_new[$i];
		
		if ($lettre>='a' && $lettre<='z'){
			// On ajoute 1 point pour une minuscule
			$point = $point + 1;
			
			// On rajoute le bonus pour une minuscule
			$point_min = 1;
		}
		else if ($lettre>='A' && $lettre <='Z'){
			// On ajoute 2 points pour une majuscule
			$point = $point + 2;
			
			// On rajoute le bonus pour une majuscule
			$point_maj = 2;
		}
		else if ($lettre>='0' && $lettre<='9'){
			// On ajoute 3 points pour un chiffre
			$point = $point + 3;
			
			// On rajoute le bonus pour un chiffre
			$point_chiffre = 3;
		}
		else {
			// On ajoute 5 points pour un caract�re autre
			$point = $point + 5;
			
			// On rajoute le bonus pour un caract�re autre
			$point_caracteres = 5;
		}
	}

	// Calcul du coefficient points/longueur
	$etape1 = $point / $longueur;

	// Calcul du coefficient de la diversit� des types de caract�res...
	$etape2 = $point_min + $point_maj + $point_chiffre + $point_caracteres;

	// Multiplication du coefficient de diversit� avec celui de la longueur
	$resultat = $etape1 * $etape2;

	// Multiplication du r�sultat par la longueur de la cha�ne
	$final = $resultat * $longueur;

	return $final;
}