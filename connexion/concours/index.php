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
                        
                       	  <h2> Jeu Concours</h2>
                            
                            <img src="../../image-contenu/cupcake.jpg" width="620" height="209">
                          <p>Du 1er juillet au 31 aout 2012, ShareYourRecipe, vous invite à participer au concours sur les plats d’été.</p>
							<p>Postez votre recette avec une photo d’illustration et tentez de gagner 5 compte premium, 2 cours de cuisine ainsi qu’un Cooking chef offert par l’équipe ShareYourRecipe. Laissez déborder votre imagination estival en créant et photographiant vos meilleurs recettes de la saison.</p>
							<p>ShareYourRecipe choisira les 3 plus meilleurs plats. Par la suite, nous vous contacterons si vous êtes l'un des heureux gagnants.</p>
						</div>
                    </div> <!--FIN COLGAUCHE-->
					
                    
                    
                    <div class="colDroite">			
                            <div class="rechercher">
                            <div class="recherchefont">
                                <div class="texte">                          
                                    <h2>Rechercher</h2><br/>
                                    <form action="recherche/index.php" method="post">
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
                                    <h2>Encart publicitaire disponible</h2><br/>
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