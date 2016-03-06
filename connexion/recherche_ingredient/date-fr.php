<?php
function date_fran() {
	$mois = array("Janvier", "Fevrier", "Mars",
                "Avril","Mai", "Juin", 
                "Juillet", "Août","Septembre",
                "Octobre", "Novembre", "Decembre");
	$jours= array("Dimanche", "Lundi", "Mardi",
                "Mercredi", "Jeudi", "Vendredi",
                "Samedi");
	return $jours[date("w")]." ".date("j").(date("j")==1 ? "er":" ").
         $mois[date("n")-1]." ".date("Y");
}
?>