<?php
	error_reporting(E_ALL ^ E_NOTICE); // cache les erreurs de php

	$prenom = $_GET['prenom'];
	$nom = $_GET['nom'];
	$pseudo = $_GET['pseudo'];
	$mdp = $_GET['mdp'];
	$verif_mdp = $_GET['verif_mdp'];
	$date = $_GET['date'];
	$mail = $_GET['mail'];
	$verif_mail = $_GET['verif_mail'];
	$citation = $_GET['citation'];
	$robot = $_GET['robot'];
	
?>
<!DOCTYPE html>
<html>
<head>
		<link rel="icon" type="image/png" href="../image-contenu/icone.jpg" />
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
		<title>ShareYourRecipe</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<link href="../css/reset.css" rel="stylesheet" type="text/css">
		<link href='http://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
        
        <script src="../js/jquery1.7.1.js"></script>
		<script src="../js/slider.js"></script>
    
</head>
	<body name="menu"> 
            <?php include("header.php"); ?>    
              
            <div class="content">       
                <div class="inner">
					
					<div class="colGauche">
                    	<div class="contenuphp">
                            <h2>Inscription</h2>
                            <form method="POST" action="form1.php" enctype="multipart/form-data">
                                <p>Prénom : <input type="text" name="prenom" value="<?php echo $_COOKIE['prenom_post']; ?>"/> <?php echo($prenom); ?></p>
                                <p>Nom: <input type="text" name="nom" value="<?php echo $_COOKIE['nom_post']; ?>"/> <?php echo $nom; ?></p>
                                <p>Pseudo : <input type="text" name="pseudo" value="<?php echo $_COOKIE['pseudo_post']; ?>"/> <?php echo($pseudo); ?></p>
                                <p>Illustrez votre profil : <input type="file" name="image"/><?php echo($image); ?></p>
                                <p>Mot de passe : <input type="password" name="mdp"/><?php echo($mdp); ?></p>
                                <p>Vérification mot de passe : <input type="password" name="verif_mdp"/><?php echo($verif_mdp); ?></p>
                                <p>Date de naissance : <select name="jour" value="<?php echo $_COOKIE['jour']; ?>"></p>
                                    <option >jour</option>
                                    <option name="1">1</option>
                                    <option name="2">2</option>
                                    <option name="3">3</option>
									<option name="4">4</option>
									<option name="5">5</option>
									<option name="6">6</option>
									<option name="7">7</option>
									<option name="8">8</option>
									<option name="9">9</option>
									<option name="10">10</option>
									<option name="11">11</option>
									<option name="12">12</option>
									<option name="13">13</option>
									<option name="14">14</option>
									<option name="15">15</option>
									<option name="16">16</option>
									<option name="17">17</option>
									<option name="18">18</option>
									<option name="19">19</option>
									<option name="20">20</option>
									<option name="21">21</option>
									<option name="22">22</option>
									<option name="23">23</option>
									<option name="24">24</option>
									<option name="25">25</option>
									<option name="26">26</option>
									<option name="27">27</option>
									<option name="28">28</option>
									<option name="29">29</option>
									<option name="30">30</option>
									<option name="31">31</option>
                                </select>
                                <select name="mois">
                                    <option>mois</option>
                                    <option value="janvier">Janvier</option>
                                    <option value="fevrier">Février</option>
                                    <option value="mars">Mars</option>
                                    <option value="avril">Avril</option>
                                    <option value="mai">Mai</option>
                                    <option value="juin">juin</option>
                                    <option value="juillet">Juillet</option>
                                    <option value="aout">Août</option>
                                    <option value="septembre">Septembre</option>
                                    <option value="octobre">Octobre</option>
                                    <option value="novembre">Novembre</option>
                                    <option value="decembre">Décembre</option>
                                </select>
                                <select name="annee">
                                    <option>annee</option>
									<?php 
										$format='F j, Y'; 
										for ( $i = 1900; $i < 1997; $i++) { 
											$datep = "$i";
											echo("<option>$datep</option>");
										}	
									?> 
                                </select><?php echo($date); ?><br>	
                                <p>E-mail : <input type="text" name="mail" value="<?php echo $_COOKIE['mail_post']; ?>"/><?php echo($mail); ?></p>
                                <p>Verification mail : <input type="text" name="verif_mail" value="<?php echo $_COOKIE['verif_mail_post']; ?>"/><?php echo($verif_mail); ?></p>
                                <p>Citation : <input type="text" name="citation" value="<?php echo $_COOKIE['citation_post']; ?>"/><?php echo($citation); ?></p>
                                <div class="bouton2"><input type="submit" value="Inscription" /></div>
                                <input type="hidden" name="submitted" id="submitted" value="true" />
								<p><input type="text" class="robot" name="robot"/> <?php echo($robot); ?></p>
                            </form>
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
                                    
                                    <a href="recherche_ingredient/index.php"><p>Rechercher par ingredients  </p>	<img src="../image-contenu/AjouterIngredient.png" width="26" height="26" alt="plus"></a>
                                </div>
                            </div>
                            </div>
                            
                            <div class="newsletter1">
                                </p> Recevez notre newsletter gratuitement : <p><br>
                                <form method="post" action="../mail.php">
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
                       <a href="http://www.facebook.com/pages/ShareYourRecipe/375510972489040" title="Nous rejoindre sur Facebook" target="_blank"><img src="../image-contenu/Facebook.png" width="34" height="34"></a>
                       <a href="https://plus.google.com/u/1/105408455807828253834/posts" title="Nous rejoindre sur Google+" target="_blank"><img src="../image-contenu/Google.png" width="35" height="35"> </a>
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