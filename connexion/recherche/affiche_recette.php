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
	mysql_query("SET NAMES 'utf8'");
	
	//recuperation de l'id ou mess recette dans url
	$id = $_GET['id_recette'];
	$mess = $_GET['mess'];
	
	//recup du pseudo
	//recup de tout dans pseudo id + pseudo
	$req = "select * from pseudo where pseudo='$pseudo'";
	$query = mysql_query($req, $dbc);
	while ($ligne = mysql_fetch_row($query)) {
		$id_pseudo = $ligne[0];
		$pseudobdd = $ligne[1];
	}
	
	//recuperation de la recette + ingredients + contenu
	//recuperation recette
	$req = "select * from recette where ID_recette='$id'";
	$query = mysql_query($req, $dbc);
	
	//mettre dans variable la derneire recette ajoutée 
	while ($ligne = mysql_fetch_row($query)) {
		$id_recette = stripslashes(htmlspecialchars_decode($ligne[0]));
		$nom_recette = stripslashes(htmlspecialchars_decode($ligne[1]));
		$preparation = stripslashes(htmlspecialchars_decode($ligne[2]));
		$conseil = stripslashes(htmlspecialchars_decode($ligne[3]));
		$qr_code = $ligne[4];
		$ID_pseudo = $ligne[5];
    };
	
	//recup du contenu recette
	$req2 = "select * from contient where ID_recette='$id'";
	$query2 = mysql_query($req2, $dbc);
	
	//mettre dans variable ce que contient la recette
	while ($ligne2 = mysql_fetch_row($query2)) {
		$id_contient = $ligne2[0];
		$quantite1 = stripslashes(htmlspecialchars_decode($ligne2[1]));
		$quantite2 = stripslashes(htmlspecialchars_decode($ligne2[2]));
		$quantite3 = stripslashes(htmlspecialchars_decode($ligne2[3]));
		$quantite4 = stripslashes(htmlspecialchars_decode($ligne2[4]));
		$quantite5 = stripslashes(htmlspecialchars_decode($ligne2[5]));
		$quantite6 = stripslashes(htmlspecialchars_decode($ligne2[6]));
		$quantite7 = stripslashes(htmlspecialchars_decode($ligne2[7]));
		$quantite8 = stripslashes(htmlspecialchars_decode($ligne2[8]));
		$quantite9 = stripslashes(htmlspecialchars_decode($ligne2[9]));
		$quantite10 = stripslashes(htmlspecialchars_decode($ligne2[10]));
		$image = $ligne2[11];
		$ID_recette = $ligne2[12];
		$ID_ingredient = $ligne2[13];
    };
	
	//recuperation ingredient
	$req1 = "select * from ingredient where ID_ingredient='$ID_ingredient'";
	$query1 = mysql_query($req1, $dbc);
	
	//mettre dans variable ingredient de la recette
	while ($ligne1 = mysql_fetch_row($query1)) {
		$id_ingredient = $ligne1[0];
		$ingredient1 = stripslashes(htmlspecialchars_decode($ligne1[1]));
		$ingredient2 = stripslashes(htmlspecialchars_decode($ligne1[2]));
		$ingredient3 = stripslashes(htmlspecialchars_decode($ligne1[3]));
		$ingredient4 = stripslashes(htmlspecialchars_decode($ligne1[4]));
		$ingredient5 = stripslashes(htmlspecialchars_decode($ligne1[5]));
		$ingredient6 = stripslashes(htmlspecialchars_decode($ligne1[6]));
		$ingredient7 = stripslashes(htmlspecialchars_decode($ligne1[7]));
		$ingredient8 = stripslashes(htmlspecialchars_decode($ligne1[8]));
		$ingredient9 = stripslashes(htmlspecialchars_decode($ligne1[9]));
		$ingredient10 = stripslashes(htmlspecialchars_decode($ligne1[10]));
		
    };
	
	//recup de la moyenne de cette recette
	$req3 = "select moyenne from moyenne where ID_recette='$id_recette'";
	$query3 = mysql_query($req3, $dbc);
	$row = mysql_fetch_row($query3);
	$moyenne = $row[0];
	
	//recherche si statut == admin
	$reqstatut = "select * from identite where ID_pseudo='$id_pseudo'";
	$execreqstatut = mysql_query($reqstatut, $dbc);
	while ($row1 = mysql_fetch_row($execreqstatut)) {
		$statut = $row1[9];
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
                   		<div class="contenuphpmembre">
							<?php if ($statut === 'admin') {
							echo("<a href='../supprim_recette.php?id_recette=$id'>Suprimer cette recette</a>");	
							}
							if ($id_pseudo === $ID_pseudo) {
								echo("<h2>$nom_recette</h2> <p><a href='../modif_recette.php?id_recette=$id_recette'>Modifier cette recette</a>");
								echo("<a href='../supprim_recette.php?id_recette=$id_recette'>Supprimer cette recette</a>");
							}
							else {
							?>
                            <h2><?php echo($nom_recette); ?></h2>
							<?php } ?>
                            <h3>Les ingredients</h3>
                            <p><?php include("affiche_ingredient.php"); ?></p>	
                            <h3>La préparation</h3>
                            <p><?php echo($preparation); ?></p>
                            <h3>Conseil de preparation</h3>
                            <p><?php echo($conseil); ?></p>
                            <h3>Voici un apercu de la recette terminée</h3>
                            <p><?php echo("<img src='$image' width='600' height='400'>");?></p>
                            <h3>Note de cette recette</h3>
                            <?php echo("$moyenne/5 "); echo($mess); ?>
                            <h3>Commentaires</h3>
                            <?php include("affich_commentaire.php"); ?>
            
                            <?php
                                if (isset($_SESSION['login'])) {
                            ?>
                            
                            <div class="paramettre">
                                <p>Notez cette recette</p>
                                <form method="post" action="note.php">
                                    <input type="text" name="note"/>/5
                                    <div class="bouton2"><input type="submit" value="Notez"/></div>
                                    <input type="hidden" value="<?php echo($id_recette); ?>" name="id_recette"/>
                                    <input type="hidden" name="submittednote" id="submitted" value="true" />
                                </form>	
                
                                <p>Laissez un commentaire</p>
                                <form method="POST" action="commentez.php">
                                    <textarea placeholder="Votre commentaire..." name="commentaire"></textarea>
                                    <input type="hidden" value="<?php echo($id_recette); ?>" name="id">
                                    <div class="bouton2"><input type="submit" value="Commentez"/></div>
                                    <input type="hidden" name="submitted" id="submitted" value="true" />
                                </form>
                             </div>
                            <?php } ?>   
                    	</div>
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
                                    
                                    <a href="../recherche_ingredient/index.php"><p>Rechercher par ingredients  </p>	<img src="../../image-contenu/AjouterIngredient.png" width="26" height="26" alt="plus"></a>
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