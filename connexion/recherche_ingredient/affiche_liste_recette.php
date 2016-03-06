<?php
	error_reporting(E_ALL ^ E_NOTICE); // cache les erreurs de php

	//avant toute chose faire un session start
	Session_start();

	$pseudo = $_SESSION['login'];

	//inclusion des fichiers pour connect bdd
	include("projet_co_connect.inc");
	include("connect.php");
	
	//connection bdd
    $dbc = monconnect($dbname, $dbhost, $login, $password);
	
	
	//si le mec a cliqué sur envoyer
    if(isset($_POST['submitted'])) {	
		//recup du ou des ingredients
		$ingredient1 = mysql_real_escape_string(htmlspecialchars($_POST['ingredient1']));
		$ingredient2 = mysql_real_escape_string(htmlspecialchars($_POST['ingredient2']));
		$ingredient3 = mysql_real_escape_string(htmlspecialchars($_POST['ingredient3']));
	}	
?>
<!DOCTYPE html>
<html>
<head>
		<link rel="icon" type="image/png" href="../../image-contenu/icone.jpg" />
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
		<title>ShareYourRecipe</title>
		<link rel="stylesheet" type="text/css" href="../../css/style.css">
		<link href="../../css/reset.css" rel="stylesheet" type="text/css">
		<link href='http://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
        
        <script src="../../js/jquery1.7.1.js"></script>
		<script src="../../js/slider.js"></script>
    
</head>
	<body name="menu"> 
            <?php include("header.php"); ?>    
              
            <div class="content">       
                <div class="inner">
					
					<div class="colGauche">
						<?php
							//verif de ingredient si vide
							if (($ingredient1 === '') && ($ingredient2 === '') && ($ingredient3 === '')) {
								echo("Veuillez entrer au minimum un ingrédient pour votre recette.");
								$haserror = true;
							}
							else if (($ingredient2 === '') && ($ingredient3 === '')) {
								//on selectionne tout ou ingredient1 == saisi user
								$req = "select * from ingredient where ingredient1 like '%$ingredient1%' or ingredient2 like'%$ingredient1%' or ingredient3 like'%$ingredient1%' or ingredient4 like'%$ingredient1%' or ingredient5 like'%$ingredient1%' or ingredient6 like'%$ingredient1%' or ingredient7 like'%$ingredient1%' or ingredient8 like'%$ingredient1%' or ingredient9 like'%$ingredient1%' or ingredient10 like'%$ingredient1%'";
								$query = mysql_query($req, $dbc);
								//mettre dans variable la derneire recette ajoutée 
								while ($ligne = mysql_fetch_row($query)) {
									$id_ingredient = $ligne[0];
									//recup du contenu recette
									$req1 = "select * from contient where ID_recette='$id_ingredient'";
									$query1 = mysql_query($req1, $dbc);
									//mettre dans variable ce que contient la recette
									while ($ligne1 = mysql_fetch_row($query1)) {
										$id_contient = $ligne1[0];
										$ID_recette = $ligne1[12];
										$ID_ingredient = $ligne1[13];
									}
									//recuperation recette
									$req2 = "select * from recette where ID_recette='$ID_recette'";
									$query2 = mysql_query($req2, $dbc);
									//mettre dans variable la derneire recette ajoutée 
									while ($ligne2 = mysql_fetch_row($query2)) {
										$id_recette = $ligne2[0];
										$nom_recette = $ligne2[1];
										echo("<a href='affiche_recette.php?id_recette=$id_recette'>$nom_recette</a><br>");
									}
								}
							}
							else if ($ingredient3 === '') {
								//on selectionne tout ou ingredient1 + ingredient2 == saisi user
								$req = "select * from ingredient where ingredient1 like '%$ingredient1%' or ingredient2 like'%$ingredient1%' or ingredient3 like'%$ingredient1%' or ingredient4 like'%$ingredient1%' or ingredient5 like'%$ingredient1%' or ingredient6 like'%$ingredient1%' or ingredient7 like'%$ingredient1%' or ingredient8 like'%$ingredient1%' or ingredient9 like'%$ingredient1%' or ingredient10 like'%$ingredient1%' and ingredient1 like '%$ingredient2%' or ingredient2 like'%$ingredient2%' or ingredient3 like'%$ingredient2%' or ingredient4 like'%$ingredient2%' or ingredient5 like'%$ingredient2%' or ingredient6 like'%$ingredient2%' or ingredient7 like'%$ingredient2%' or ingredient8 like'%$ingredient2%' or ingredient9 like'%$ingredient2%' or ingredient10 like'%$ingredient2%'";
								$query = mysql_query($req, $dbc);
								//mettre dans variable la derneire recette ajoutée 
								while ($ligne = mysql_fetch_row($query)) {
									$id_ingredient = $ligne[0];
									//recup du contenu recette
									$req1 = "select * from contient where ID_recette='$id_ingredient'";
									$query1 = mysql_query($req1, $dbc);
									//mettre dans variable ce que contient la recette
									while ($ligne1 = mysql_fetch_row($query1)) {
										$id_contient = $ligne1[0];
										$ID_recette = $ligne1[12];
										$ID_ingredient = $ligne1[13];
									}
									//recuperation recette
									$req2 = "select * from recette where ID_recette='$ID_recette'";
									$query2 = mysql_query($req2, $dbc);
									//mettre dans variable la derneire recette ajoutée 
									while ($ligne2 = mysql_fetch_row($query2)) {
										$id_recette = $ligne2[0];
										$nom_recette = $ligne2[1];
										echo("<a href='affiche_recette.php?id_recette=$id_recette'>$nom_recette</a><br>");
									}	
								}
							}	
							else {
								//on selectionne tout ou ingredient1 + ingredient2 == saisi user
								$req = "select * from ingredient where ingredient1 like '%$ingredient1%' or ingredient2 like'%$ingredient1%' or ingredient3 like'%$ingredient1%' or ingredient4 like'%$ingredient1%' or ingredient5 like'%$ingredient1%' or ingredient6 like'%$ingredient1%' or ingredient7 like'%$ingredient1%' or ingredient8 like'%$ingredient1%' or ingredient9 like'%$ingredient1%' or ingredient10 like'%$ingredient1%' and ingredient1 like '%$ingredient2%' or ingredient2 like'%$ingredient2%' or ingredient3 like'%$ingredient2%' or ingredient4 like'%$ingredient2%' or ingredient5 like'%$ingredient2%' or ingredient6 like'%$ingredient2%' or ingredient7 like'%$ingredient2%' or ingredient8 like'%$ingredient2%' or ingredient9 like'%$ingredient2%' or ingredient10 like'%$ingredient2%' or ingredient1 like'%$ingredient3%' or ingredient2 like'%$ingredient3%' or ingredient3 like'%$ingredient3%' or ingredient4 like'%$ingredient3%' or ingredient5 like'%$ingredient3%' or ingredient6 like'%$ingredient3%' or ingredient7 like'%$ingredient3%' or ingredient8 like'%$ingredient3%' or ingredient9 like'%$ingredient3%' or ingredient10 like'%$ingredient3%'";
								$query = mysql_query($req, $dbc);
								//mettre dans variable la derneire recette ajoutée 
								while ($ligne = mysql_fetch_row($query)) {
									$id_ingredient = $ligne[0];
									//recup du contenu recette
									$req1 = "select * from contient where ID_recette='$id_ingredient'";
									$query1 = mysql_query($req1, $dbc);
									//mettre dans variable ce que contient la recette
									while ($ligne1 = mysql_fetch_row($query1)) {
										$id_contient = $ligne1[0];
										$ID_recette = $ligne1[12];
										$ID_ingredient = $ligne1[13];
									}
									//recuperation recette
									$req2 = "select * from recette where ID_recette='$ID_recette'";
									$query2 = mysql_query($req2, $dbc);
									//mettre dans variable la derneire recette ajoutée 
									while ($ligne2 = mysql_fetch_row($query2)) {
										$id_recette = $ligne2[0];
										$nom_recette = $ligne2[1];
										echo("<a href='affiche_recette.php?id_recette=$id_recette'>$nom_recette</a><br>");
									}
								}
							}
						?>
                    </div> <!--FIN COLGAUCHE-->
					
                    
                    
                    <div class="colDroite">			
                            <div class="rechercher">
                            <div class="recherchefont">
                                <div class="texte">                          
                                    <h2>Rechercher</h2><br/>
                                    <form action="../recherche/index.php" method="post">
										<input type="text" name="recherche" Placeholder="  Rechercher..."/><br/><br/>
										<div class="bouton"><input type="submit" value="Rechercher"></div>
									</form>
                                    
                                    <p>Rechercher par ingredients  </p>	<img src="../../image-contenu/AjouterIngredient.png" width="26" height="26" alt="plus">
                                </div>
                            </div>
                            </div>
                            
                            <div class="newsletter1">
                                </p> Recevez notre newsletter gratuitement : <p><br>
                                <?php echo($mess); ?>
								<form method="post" action="../../mail.php">
									<input type="text" name="mail" Placeholder="Entrez votre adresse mail..."  value="<?php echo($_COOKIE['mail_post']); ?>"/><br/><br/>
									<div class="bouton2"><input type="submit" value="Envoyer"></div>
									<input type="hidden" name="submitted" id="submitted" value="true" />
								</form>
                            </div>
                            
                            
                            
                            <div class="pub">
                                <div class="texte">
                                    <h2>Espace publicitaire disponible</h2><br/>
                                </div>
                            </div>
                            
                     </div>

					<div class="clear"></div>
                
            	</div><!--FIN INNER --> 
            </div><!--FIN CONTENT-->
              
 
			<div class="clear"></div>
              
            <footer>
              	<div class="inner">                 
                        
                      <div class="mentionlegal">
                        
                          <h4>Mentions légales</h4>
                          <p>Projet réalisé dans le cadre d'un exercice pédagogique au département <a href="http://src-media.com/" title="En savoir plus | src-media.com" target="_blank"> src[*]média</a> de Montbéliard.</p>
                        
                      </div><!--FIN MENTIONLEGAL--> 
                        
                        
                     <div class="reseauxsociaux">
                       <h4>Suivez-nous !</h4>
                       <a href="http://www.facebook.com/pages/ShareYourRecipe/375510972489040" title="Nous rejoindre sur Facebook" target="_blank"><img src="../../image-contenu/Facebook.png" width="34" height="34"></a>
                       <a href="https://plus.google.com/u/1/105408455807828253834/posts" title="Nous rejoindre sur Google+" target="_blank"><img src="../../image-contenu/Google.png" width="35" height="35"> </a>
                     </div><!--FIN RESEAUXSOCIAUX -->
                       
                       
                     <div class="contact">
                          <h4>Contact</h4>
                          <p>Des idées ? Des problèmes? <a href="mailto:shareyourrecipe@gmail.com">Contactez-nous !</a></p>
                      </div><!--FIN CONTACT-->
                     
                       
                     <a href="#menu"><div class="titre">                            
                     	<p>ShareYourRecipe</p>                            
                     	<p>Partage ta recette</p>                                            
                     </div></a><!--FIN TITRE-->
                        
                </div><!--FIN INNER FOOTER-->
          	</footer>
		
    <script type="text/javascript" src="js/modernizr.js"></script>
	<script type="text/javascript" src="js/jquery.960grid-1.0.min.js"></script>
   
	
	<script type="text/javascript">
		var autoScroll = false;
	  scroller.auto({
		onStart:function () { autoScroll = true; },
		onFinish:function () { autoScroll = false; }
      });
    </script>
	<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/jquery.960grid-1.0.min.js"></script>
<script type="text/javascript">
/*<![CDATA[*/
	// onload
	$(function() {
		$("body").addGrid(12, {img_path: 'images-interfaces/'});
	});
/*]]>*/
</script>
</body>
</html>