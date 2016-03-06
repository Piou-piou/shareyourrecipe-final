<?php
	error_reporting(E_ALL ^ E_NOTICE); // cache les erreurs de php
	
	//avant toute chose faire un session start
	Session_start();

	//si le user n'a rien mis dans login on lui de pense a se connecter
	if (!isset($_SESSION['login'])) {
		header("location:../login.php?mess=Pense a te connecter.");
	}
	$pseudo = $_SESSION['login'];
	
	//recup si trait ok
	$mess = $_GET['mess'];

	//recuperation ndes donnee du traitement si haserror = true
	$nom = $_GET['nom'];
	$image = $_GET['image'];
	$ingredient = $_GET['ingredient'];
	$quantite = $_GET['quantite'];
	$preparation = $_GET['preparation'];
	$conseil = $_GET['conseil'];
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
                    	<div class="contenuphp">
                            <h2>Ajouter une recette</h2>
                            <form action="addrecette.php" method="post" enctype="multipart/form-data">
                                <p>Entrez le nom de votre recette : <input type="text" name="nom" value="<?php echo $_COOKIE['nom_post']; ?>"/><?php echo($nom); ?></p>
                                <p>Illustrez votre recette avec le plat une fois terminié : <input type="file" name="image"/><?php echo($image); ?></p>
                                <p>Entrez les ingrédients nécessaires à la recettes :</p><p><input type="text" name="ingredient1" placeholder="ex: pâtes" value="<?php echo $_COOKIE['ingredient1_post']; ?>"/><input type="text" name="quantite1" placeholder="ex: 500 grammes" value="<?php echo $_COOKIE['quantite1_post']; ?>"/></p>
                                                                    <p><input type="text" name="ingredient2" placeholder="ex: pâtes" value="<?php echo $_COOKIE['ingredient2_post']; ?>"/><input type="text" name="quantite2" placeholder="ex: 500 grammes" value="<?php echo $_COOKIE['quantite2_post']; ?>"/></p>
                                                                    <p><input type="text" name="ingredient3" placeholder="ex: pâtes" value="<?php echo $_COOKIE['ingredient3_post']; ?>"/><input type="text" name="quantite3" placeholder="ex: 500 grammes" value="<?php echo $_COOKIE['quantite3_post']; ?>"/></p>
																	<p><input type="text" name="ingredient4" placeholder="ex: pâtes" value="<?php echo $_COOKIE['ingredient4_post']; ?>"/><input type="text" name="quantite4" placeholder="ex: 500 grammes" value="<?php echo $_COOKIE['quantite4_post']; ?>"/></p>
																	<p><input type="text" name="ingredient5" placeholder="ex: pâtes" value="<?php echo $_COOKIE['ingredient5_post']; ?>"/><input type="text" name="quantite5" placeholder="ex: 500 grammes" value="<?php echo $_COOKIE['quantite5_post']; ?>"/></p>
																	<p><input type="text" name="ingredient6" placeholder="ex: pâtes" value="<?php echo $_COOKIE['ingredient6_post']; ?>"/><input type="text" name="quantite6" placeholder="ex: 500 grammes" value="<?php echo $_COOKIE['quantite6_post']; ?>"/></p>
																	<p><input type="text" name="ingredient7" placeholder="ex: pâtes" value="<?php echo $_COOKIE['ingredient7_post']; ?>"/><input type="text" name="quantite7" placeholder="ex: 500 grammes" value="<?php echo $_COOKIE['quantite7_post']; ?>"/></p>
																	<p><input type="text" name="ingredient8" placeholder="ex: pâtes" value="<?php echo $_COOKIE['ingredient8_post']; ?>"/><input type="text" name="quantite8" placeholder="ex: 500 grammes" value="<?php echo $_COOKIE['quantite8_post']; ?>"/></p>
																	<p><input type="text" name="ingredient9" placeholder="ex: pâtes" value="<?php echo $_COOKIE['ingredient9_post']; ?>"/><input type="text" name="quantite9" placeholder="ex: 500 grammes" value="<?php echo $_COOKIE['quantite9_post']; ?>"/></p>
																	<p><input type="text" name="ingredient10" placeholder="ex: pâtes" value="<?php echo $_COOKIE['ingredient10_post']; ?>"/><input type="text" name="quantite10" placeholder="ex: 500 grammes" value="<?php echo $_COOKIE['quantite10_post']; ?>"/></p>
                                                                    <?php echo($ingredient); ?><br>
																	<?php echo($quantite); ?><br>
                                <p>Entrez la manière dont il faut effectuer la recette : <textarea name="preparation"><?php echo $_COOKIE['preparation_post']; ?></textarea><?php echo($preparation); ?></p>
                                <p>Donnez un conseil particulier pour réaliser cette recette : <textarea name="conseil"><?php echo $_COOKIE['conseil_post']; ?></textarea><?php echo($conseil); ?></p>
                                <div class='bouton2'><input type="submit" value="Envoyer" /></div>
                                <input type="hidden" name="submitted" id="submitted" value="true" />
                            </form>
                            
                            <?php echo($mess); ?>
                            
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