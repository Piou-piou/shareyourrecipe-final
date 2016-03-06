<?php
	//recuperation du $mess palce dans l'url en fonction de l'erreur dans connect.php
	$mess = $_GET['mess'];
	print ("<div id='err'>$mess</div>");
	
	/*if(isset($GET_['mess'])) {
		print("<div id='noerr'>Le message d'erreur n'est pas definis");
	}
	else {
		print ("<div id='err'>$mess</div>");
	}*/
	
?>