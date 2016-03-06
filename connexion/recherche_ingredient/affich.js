function change(chiffre) {
	var i;
	var contenu = "";
	var cpt;
	var ingredient;
	
	contenu += "<form method='post' action='affiche_liste_recette.php'>"; 
	//afficahge des maison en fonction du prix
	for (i=0; i<chiffre; i++) {
			cpt ++;
			//contenu += "<table><tr><td>"  + cheminimg + annonce[i]+ cheminimg1 + " </td><td> " + texte + lieux[i] + texteS + prix[i] + "€.</td></tr></table>" + "<br><br><br>";
			contenu += "<input type='text' placeholder='ingredient"+(i+1)+"' name='ingredient"+(i+1)+"'><br>";
	}
	contenu += "<input type='submit' value='rechercher'/><input type='hidden' name='submitted' id='submitted' value='true'/></form>"
	afficheDanslaDiv(contenu, "ingredient", 0, 0, 0);
}

function afficheDanslaDiv(texte, div, gras, italique, souligne){
	var Daffichage = document.getElementById(div);
	if (gras == 1){
		texte = ("<b>" + texte + "</b>");
	}
	if (italique == 1){
		texte = ("<em>" + texte + "</em>");
	}
	if (souligne == 1){
		texte = ("<u>" + texte + "</u>");
	}
	Daffichage.innerHTML = texte;
}