<?php
	//error_reporting(E_ALL ^ E_NOTICE); // cache les erreurs de php
	
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

	//recup des notes des recette
	$req = "select * from moyenne order by moyenne DESC";
	$query = mysql_query($req, $dbc);
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
    
</head>
	<body name="menu"> 
            <?php include("header.php"); ?>    
              
            <div class="content">       
                <div class="inner">
					
					<div class="colGauche">
                    <h2>Top 10 des recettes</h2>
                    <p>Vous trouverez ici le classement des 10 meilleures recettes du mois qui on été les mieux notées par la communauté.</p>
						<?php for ($i=0 ; $i<10 ; $i++) {
										//recuperation des notes
										$enr = mysql_fetch_assoc($query);
										
										//recup contenu table moyenne
										$id_moyenne[$i] = $enr['ID_moyenne'];
										$id_recette[$i] = $enr['ID_recette'];
										$moyenne[$i] = $enr['moyenne'];
										
										//recup contenu table contient en fonction de id_note
										$req1 = "select * from contient where ID_recette='$id_recette[$i]'";
										$query1 = mysql_query($req1, $dbc);
										$enr1 = mysql_fetch_assoc($query1);
										$image[$i] = $enr1['image'];
										
										//recup contenu table recette en fonction de id_note
										$req1 = "select * from recette where ID_recette='$id_recette[$i]'";
										$query1 = mysql_query($req1, $dbc);
										$enr1 = mysql_fetch_assoc($query1);
										$nom_recette[$i] = $enr1['nom_recette'];
										
										//recuperation du seudo pour la recette
										$req2 = "select pseudo from pseudo where ID_pseudo='$id_pseudo[$i]'";
										$query2 = mysql_query($req2, $dbc);
										$enr2 = mysql_fetch_assoc($query2);
										$pseudorec[$i] = $enr2['pseudo'];
									?>
									
                                    <?php echo("<a href='../recherche/affiche_recette.php?id_recette=$id_recette[$i]'>"); ?>
									<div class="image">
                                            <img src="<?php echo($image[$i]); ?>" width="79" height="75" alt="image recette" />
                                            <p><?php echo(stripslashes(htmlspecialchars_decode($nom_recette[$i]))); ?></p><br/>
                                            <p><?php echo($moyenne[$i]);?>/5</p>
                                        </div></a>
									<?php } ?>
                    
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
                          <p>Des idées ? Des problèmes? <a href="mailto:shareyourrecipe@gmail.com">Contactez-nous !</a>!</p>
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