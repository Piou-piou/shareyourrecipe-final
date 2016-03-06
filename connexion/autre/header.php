

<header>
	<div class="connect">
			<div class="inner">
			<div class="txtinscription">
			<?php if(!isset($_SESSION['login'])) { ?>
				<li class="inscription"><a href="../index.php"><span>Inscription</span></a></li>
				<li class="connection"><a href="../login.php"><span>Connexion</span></a></li>
			<?php } else { ?>
				<li class="connection"><a href="../espacemembre.php">Mon profil : <?php echo($pseudo);?></a></li>
				<li class="connection"><a href="../logout.php">Se déconnecter</a></li>
			<?php } ?>	
			</div> <!--FIN txtinscription-->
		</div>
	</div> 
					
    <div class="banniere">
        <div class="inner">
             <a href="../../"> <hgroup> 
                 <div class="titre">                           
                        <img src="../../image-contenu/logo.png" width="162" height="94" alt="ShareYourRecipe" />
                         <h1>Share<span id="your">Your</span>Recipe</h1> 
                 </div>                       
              </hgroup></a>
         </div>
	</div> <!--FIN BANNIERE-->
                    
    <div class="navcolor">   
		<div class="inner">
			<nav>
				<li><a href="../concours/index.php"><span class="txtnous">Concours</span></a></li>
				<li><a href="index.php"><span class="txtplus">Top 10</span></a></li>
				<li><a href="../recherche_ingredient/index.php"><span class="txtFAQ">Recherche par ingrédient</span></a></li>
				<li><a href="../derniere_recette/index.php"><span class="txtplus">Dernières recettes</span></a></li>
				<li><a href="../../faq.php"><span class="txtFAQ">FAQ</span></a></li>
				<?php if(isset($_SESSION['login'])) { ?>
					<li><a href="../ajouter_une_recette/index.php">Ajouter une recette</a></li>
				<?php } ?>
				<div class="HeaderReseauxSociaux">
                    <a href="http://www.facebook.com/pages/ShareYourRecipe/375510972489040" title="Nous rejoindre sur Facebook" target="_blank"><img src="../../image-contenu/FacebookH.png" width="28" height="28" alt="Google+"></a>
                    <a href="https://plus.google.com/u/1/105408455807828253834/posts" title="Nous rejoindre sur Google+" target="_blank"><img src="../../image-contenu/Google+H.png" width="28" height="28" alt="Google+"></a>
                </div><!--FIN RESEAUXSOCIAUX -->          
			</nav>
		</div>
	</div> <!--FIN NAVCOLOR-->
</header><!--FIN INNER HEADER-->
