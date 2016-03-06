<?php
	error_reporting(E_ALL ^ E_NOTICE); // cache les erreurs de php
	
	//avant toute chose faire un session start
	Session_start();

	//si le user n'a rien mis dans login on lui de pense a se connecter
	if (!isset($_SESSION['login'])) {
		$login = 1;
	}
	$pseudo = $_SESSION['login'];
?>	
<!DOCTYPE html>
<html>
<head>
		<link rel="icon" type="image/png" href="image-contenu/icone.jpg" />
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
		<title>ShareYourRecipe</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link href="css/reset.css" rel="stylesheet" type="text/css">
		<link href='http://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'> 
</head>
	<body name="menu"> 
            <?php include("header.php"); ?>    
              
            <div class="content">       
                <div class="inner">
					
					<div class="colGauche">
                    
                    	<h2>FAQ</h2>
                    	<div class="contenufaq">
								<!-- les <br> c'est toute ma vie -->
                                
                                
								<h2>Est-ce que votre service est-il gratuit ?</h2>
								<p>Oui, notre service est entièrement gratuit étant donné que notre concept concerne essentiellement des étudiants qui ne peuvent pas ce permettre d’avoir des dépenses superflues surtout en matière de cuisine.</p><br>
								<h2>Que pouvez-vous m’apporter ?</h2>
								<p>Nous allons vous apporter tous ce dont un étudiant a besoin, et qu’il n’a pas forcement.</p>
								<ul>
										<li>Des aides nutritionnelles</li>
										<li>Des conseils en matière de nutritions et de recettes</li>
										<li>De la rapidité à faire vos repas</li>
										<li>Des économies</li>
								</ul><br>
								<h2>Quel est l’intérêt de vous rejoindre ?</h2>
								<p>Notre site est basé sur un système de communauté qui permet de le dynamiser. Cela permet de toujours avoir de nouvelles recettes avec une grande diversité, où encore un système de « recette de la semaine » qui est pratique pour varier les plats. Donc fini le « steak pâtes » habituel !</p><br>
								<h2>Quels types de recettes me proposez-vous ?</h2>
								<p>Les recettes sont proposées par la communauté, ce qui permet d’avoir une grande diversité. Les recettes seront principalement faciles à créer, rapides et équilibrées.</p>
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
                                    
                                    <a href="connexion/recherche_ingredient/index.php"><p>Rechercher par ingredients  </p>	<img src="image-contenu/AjouterIngredient.png" width="26" height="26" alt="plus"></a>
                                </div>
                            </div>
                            </div>
                            
                            <div class="newsletter1">
                                </p> Recevez notre newsletter gratuitement : <p><br>
                                <input type="text" id="newsletter" Placeholder="  Entrez votre adresse mail..."/><br/><br/>
                                <div class="bouton2"><input type="button" value="Envoyer" /></div>
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
                       <a href="http://www.facebook.com/pages/ShareYourRecipe/375510972489040" title="Nous rejoindre sur Facebook" target="_blank"><img src="image-contenu/Facebook.png" width="34" height="34"></a>
                       <a href="https://plus.google.com/u/1/105408455807828253834/posts" title="Nous rejoindre sur Google+" target="_blank"><img src="image-contenu/Google.png" width="35" height="35"> </a>
                     </div><!--FIN RESEAUXSOCIAUX -->
                       
                       
                     <div class="contact">
                          <h4>Contact</h4>
                          <p>Des idées ? Des problèmes? Contactez-nous !</p>
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