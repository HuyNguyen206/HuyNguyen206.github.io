$('document').ready(function(){
  scrollPosition = $('.content-2').offset().top;
	$('.mouse, .ex').click(function(){
	$("html, body").animate({ scrollTop: scrollPosition }, 800);
	})
})