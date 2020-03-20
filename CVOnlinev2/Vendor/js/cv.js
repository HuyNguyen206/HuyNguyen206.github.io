$('document').ready(function(){
  
	$('.mouse, .ex').click(function(){
	scrollPosition = $('.content-2').offset().top;
	$("html, body").animate({ scrollTop: scrollPosition }, 800);
	})

	$('.comment').click(function(){
	scrollPosition = $('#comment').offset().top;
	$("html, body").animate({ scrollTop: scrollPosition }, 800);
	})
})