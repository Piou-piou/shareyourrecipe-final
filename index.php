<?php
	error_reporting(E_ALL ^ E_NOTICE); // cache les erreurs de php
	
	//avant toute chose faire un session start
	Session_start();

	//si le user n'a rien mis dans login on lui de pense a se connecter
	if (!isset($_SESSION['login'])) {
		$login = 1;
	}
	$pseudo = $_SESSION['login'];
	
	//connection bdd
	include("projet_co_connect.inc");
	include('connect.php');
	$dbc = monconnect($dbname,$dbhost,$login,$password);
	
	mysql_query("SET NAMES 'utf8'");
	
	//recuperation message d'erreur
	$mess = $_GET['mess'];
	
	//recuperation recette
	$req = "select * from recette order by ID_recette DESC";
	$query = mysql_query($req, $dbc);
	//recuperation ingredient
	$req1 = "select * from ingredient order by ID_ingredient DESC";
	$query1 = mysql_query($req1, $dbc);
	//recup du contenu recette
	$req2 = "select * from contient order by ID_contient DESC";
	$query2 = mysql_query($req2, $dbc);
	//recup des moyennes des recette
	$req3 = "select * from moyenne order by moyenne DESC";
	$query3 = mysql_query($req3, $dbc);
?>
<!DOCTYPE html>
<html>
<head>
		<link rel="icon" type="image/png" href="image-contenu/icone.jpg" />
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
		<title>ShareYourRecipe</title>
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<link href="css/reset.css" rel="stylesheet" type="text/css" />
		<link href='http://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css' />
        
        <script src="js/jquery1.7.1.js"></script>
		<script src="js/slider.js"></script>
    
</head>
	<body name="menu"> 
                <?php include("header.php"); ?>     
              
            <div class="content">       
                <div class="inner">
				
					    <div id="slider" >
    						<div class="contenu">
        
                                <div  id="slide1" class="slide courant">
                                <img src="image-contenu/jeux concours.jpg" width="932" height="275" alt="Jeux Concours" />
                                    <a href="connexion/concours/index.php"><div class="texteJeux">
                                        <h2>JOUEZ</h2>
                                        <p>et tentez de <span id="color">gagner</span> <span id="cook">un cooking chef,</span> <span id="cours">un cours de cuisine,</span><span id="lots"> et bien d’autres lots !</span></p>
                                    </div></a>
                                </div>
                                
                                <div  id="slide2" class="slide apres-0">
                                <img src="image-contenu/Communauté.jpg" width="932" height="275" alt="Communauté"/>
                                    <div class="texte">
                                        <h2>Une vaste communauté</h2>
                                        <p>ShareYourRecipe, c’est une vaste communauté active qui vous permet de créer, partager, commenter, et noter des recettes.</p>
										<p><a href="connexion/index.php">Rejoignez notre communauté !</a></p>
                                    </div>
                                </div>
                                
                                <div id="slide3" class="slide apres-1">
                                <img src="image-contenu/Pates.jpg" width="932" height="275" alt="Recette"/>
                                    <div class="texte">
                                        <h2>Des recettes simples et variées</h2>
                                        <p>ShareYourRecipe, c’est aussi un large choix de recettes simples, variées, et à moindre coût. Finis la routine, ShareYourRecipe est là !</p>
										<p><a href="connexion/ajouter_une_recette/index.php">Ajoutez vos recettes !</a></p>
                                    </div>
                                </div>
                             </div> <!--FIN CONTENU-->
                        </div> <!--FIN SLIDER-->

                        <ul id="navigationSlide">
                            <li><a href="#slide1" accesskey="1">1</a></li>
                            <li><a href="#slide2" accesskey="2">2</a></li>
                            <li><a href="#slide3" accesskey="3">3</a></li>
                        </ul>
					
					<div class="colGauche">
                    
                            <div class="recettesemaine">
                                <img src="image-contenu/recette.jpg" width="612" height="310" alt="Recette de la semaine" />
                                <div class="RStexte">
                                    <h2> Recette de la semaine</h2>                           
                                    <p>Salade César</p>                        
                                </div>
                            </div>
                            
                            
                            <div class="top10">
                            <div class="top10font">
                                <div class="texte">
                                    <h2>Top 10 des recettes</h2><br/>
									<?php for ($i=0 ; $i<3 ; $i++) {
										//recuperation des notes
										$enr3 = mysql_fetch_assoc($query3);
										
										//recup contenu table moyenne
										$id_moyenne[$i] = $enr3['ID_moyenne'];
										$id_recette1[$i] = $enr3['ID_recette'];
										$moyenne[$i] = $enr3['moyenne'];
										
										//recup contenu table contient en fonction de id_note
										$req4 = "select * from contient where ID_recette='$id_recette1[$i]'";
										$query4 = mysql_query($req4, $dbc);
										$enr4 = mysql_fetch_assoc($query4);
										$image1[$i] = $enr4['image'];
										
										//recup contenu table recette en fonction de id_note
										$req5 = "select * from recette where ID_recette='$id_recette1[$i]'";
										$query5 = mysql_query($req5, $dbc);
										$enr5 = mysql_fetch_assoc($query5);
										$nom_recette1[$i] = stripslashes(htmlspecialchars_decode($enr5['nom_recette']));
										
										//recuperation du seudo pour la recette
										$req6 = "select pseudo from pseudo where ID_pseudo='$id_pseudo[$i]'";
										$query6 = mysql_query($req6, $dbc);
										$enr6 = mysql_fetch_assoc($query6);
										$pseudorec1[$i] = $enr6['pseudo'];
									?>
									
                                    
									<div class="image">
											<?php echo("<a href='connexion/recherche/affiche_recette.php?id_recette=$id_recette1[$i]'>"); ?>
                                            <img src="<?php echo($image1[$i]); ?>" width="79" height="75" alt="image recette" />
                                            <p><?php echo($nom_recette1[$i]); ?></p><br/>
                                            <p><?php echo($moyenne[$i]);?>/5</p>
                                        </div></a>
									<?php } ?>
                                    <p><a href="connexion/autre/">Voir les autres recettes</a></p>
                                  </div><!--FIN TEXTE-->
                            </div> <!--FIN FONT-->
                            </div><!--FIN TOP10-->
                                
                            <div class="ajouterrecette">
                            <div class="ajouterrecettefont">
                                <div class="texte">
                                    <a href="connexion/ajouter_une_recette/"><h2>Ajoutez vos recettes !</h2><br/>
                                    <img src="image-contenu/plus.png" width="140" height="138" alt="Ajoutez votre recettes" />
                                    <p>Vous voulez partagez vos recettes ? Une recette vous tient à coeur et vous voulez la faire découvrir à la communauté ? Vous venez d’inventer une recette et vous aimeriez avoir un retour ? C’est ici que ça se passe ! </p></a>
                                </div>
                            </div>
                            </div>
                    
                    </div> <!--FIN COLGAUCHE-->
					
                    
                    
                    <div class="colDroite">			
                            <div class="rechercher">
                            <div class="recherchefont">
                                <div class="texte">                          
                                    <h2>Rechercher</h2><br/>
                                    <form action="connexion/recherche/index.php" method="post">
										<input type="text" name="recherche" Placeholder="  Rechercher..."/><br/><br/>
										<div class="bouton"><input type="submit" value="Rechercher"></div>
									</form>
                                    
                                    <a href="connexion/recherche_ingredient/index.php"><p>Rechercher par ingredients  </p>	<img src="image-contenu/AjouterIngredient.png" width="26" height="26" alt="plus"/></a>
                                </div>
                            </div>
                            </div>
                            
                            <div class="newsletter1">
                                </p> Recevez notre newsletter gratuitement : <p><br>
								<?php echo($mess); ?>
								<form method="post" action="mail.php">
									<input type="text" name="mail" Placeholder="Entrez votre adresse mail..."  value="<?php echo($_COOKIE['mail_post']); ?>"/><br/><br/>
									<div class="bouton2"><input type="submit" value="Envoyer"></div>
									<input type="hidden" name="submitted" id="submitted" value="true" />
								</form>	
                            </div>
                            
                            
                            
                            <div class="pub">
                                <div class="texte">
                                    <h2>Encart publicitaire disponible</h2><br/>
                                </div>
                            </div>
                            
                     </div>

					<div class="clear"></div>
                

                    <div class="derniereR">
						<h2>Dernières recettes ajoutées</h2>
						<?php for ($i=0 ; $i<4 ; $i++) {
							//recuperation des contenus
							$enr = mysql_fetch_assoc($query);
							$enr1 = mysql_fetch_assoc($query1);
							$enr2 = mysql_fetch_assoc($query2);
							
							
							//recup contenu table recette
							$id_recette[$i] = $enr['ID_recette'];
							$nom_recette[$i] = stripslashes(htmlspecialchars_decode($enr['nom_recette']));
							$ID_pseudo[$i] = $enr['ID_pseudo'];
							
							
							//recup contenu table contient
							$image[$i] = $enr2['image'];
							
							//recuperation du seudo pour la recette
							$req3 = "select pseudo from pseudo where ID_pseudo='$ID_pseudo[$i]'";
							$query3 = mysql_query($req3, $dbc);
							$enr3 = mysql_fetch_assoc($query3);
							$pseudorec[$i] = $enr3['pseudo'];
						?>	
                    	
                        <div class="recettes">
                   	    	<img src="<?php echo($image[$i]); ?>" width="145" height="143" alt="Recette"/>
                            <p><span><?php echo("<a href='connexion/recherche/affiche_recette.php?id_recette=$id_recette[$i]'>$nom_recette[$i] </a>"); ?></span><?php echo("par <a href='connexion/affiche_profil.php?id_pseudo=$ID_pseudo[$i]'>$pseudorec[$i]</a>"); ?></p>
                        </div>
						<?php	} ?>
                    </div><!--DERNIERER-->
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
                       <a href="http://www.facebook.com/pages/ShareYourRecipe/375510972489040" title="Nous rejoindre sur Facebook" target="_blank"><img src="image-contenu/Facebook.png" width="34" height="34" alt="Facebook"/></a>
                       <a href="https://plus.google.com/u/1/105408455807828253834/posts" title="Nous rejoindre sur Google+" target="_blank"><img src="image-contenu/Google.png" width="35" height="35" alt="Google+"/> </a>
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
   
	
	<script type="text/javascript">
		var autoScroll = false;
	  scroller.auto({
		onStart:function () { autoScroll = true; },
		onFinish:function () { autoScroll = false; }
      });
    </script>
</script>
</body>
</html>