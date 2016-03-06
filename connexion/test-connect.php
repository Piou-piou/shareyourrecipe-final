<?php
	include('projet_co_connect.inc');
	//inclusion du script de connexion
	include("connect.php");
	
	//lancement de la connexion
	$db = monconnect($dbname,$dbhost,$login,$password);
?>