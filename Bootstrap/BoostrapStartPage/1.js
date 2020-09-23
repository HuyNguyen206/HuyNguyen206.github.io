$(document).ready(function(){
  $(window).scroll(function(){
  	var scroll = $(window).scrollTop();
	  if (scroll > 100) {	  
	    $("nav").addClass("menu-scroll");
	  }

	  else{
		  $("nav").removeClass("menu-scroll");  	
	  }
  })
})