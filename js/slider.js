// Execute le code quand la page est prete
jQuery(function ($) {
	// Ici on utilise $ en toute sécurité
	
  // Mode strict
  "use strict";
  
	function changeslide(slide) {
		//metrre l'icone du slider actif et clique en orange
		//jQuery("#navigationSlide>li").removeClass();
		//liClick.parent().toggleClass("click");
		
		//changement de slide
		slide.parent().children().removeClass();
		
		// Class CSS à l'élément "courant"
		slide.addClass("courant");
		
		// Class CSS aux éléments "avant"
		slide.prevAll().each(function (index) {$(this).addClass("avant-"+index)});
		
		// Class CSS aux éléments "apres"
		slide.nextAll().each(function (index) {$(this).addClass("apres-"+index)});
	}


	// Ajoute à "#slider" la classe CSS "slider"
  $('#slider').addClass("slider");
	
	// Pour tous les "A" dans "#navigation"
	$('#navigationSlide').on("click","a",function(event) {
		// Désactive le comportement par défaut
		event.preventDefault();
		
		var liClick = jQuery(this);	
		// prend l'attribut "href" exemple "#slide3"
		var selecteurDuSlide = $(this).attr("href");
		// trouve le slide
		var slide = $(selecteurDuSlide); 

    // enléve toutes les class CSS
		changeslide(slide);
		
		
	});
	
	
	
	
	  function suivant(){
	  console.log("ici le code passant au suivant");
 		var courant = $('#slider').find('.courant');
		if (!courant.is(':last-child')) {
			var slideapres = courant.next();
			changeslide(slideapres);
			
		}else{
			var courant=$('#slide1');
			changeslide(courant);
		}
 }
 
  var timer = setInterval(suivant,9000);
 
})