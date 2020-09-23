$( document ).ready(function() {
    function scrolltop() 
{
    var id_button = '#scrolltop';
 
    // Kéo xuống khoảng cách 220px thì xuất hiện button
    var offset = 220;
    // Kéo xuống khoảng cách 50px thì xuất hiện navbar
    var offset_nav = 50;
 
    // THời gian di trượt là 0.5 giây
    var duration = 500;

     // THời gian hien len la 0.3s
    var duration_show = 300;
 
    // Thêm vào sự kiện scroll của window, nghĩa là lúc trượt sẽ
    // kiểm tra sự ẩn hiện của button
    jQuery(window).scroll(function() {
        if (jQuery(this).scrollTop() > offset) {
            // jQuery(id_button).fadeIn(duration_show);
              $(id_button).addClass("fade-in")
        } else {
            // jQuery(id_button).fadeOut(duration_show);
             $(id_button).removeClass("fade-in")
        }
        // alert($(window).width());
          if (jQuery(this).scrollTop() > offset_nav && $(window).width() + 17 >= 992) {
            $('nav').addClass("navcustom")
        } else {

             $('nav').removeClass("navcustom")
        }
    });
 
    // Thêm sự kiện click vào button để khi click là trượt lên top
    jQuery(id_button).click(function(event) {
        event.preventDefault();
        jQuery('html, body').animate({scrollTop: 0}, duration);
        return false;
    });
}
    scrolltop() ;

//     (function($) {
//     var $window = $(window),
//         $selector = $('nav');

//     function resize() {
//         if ($window.width() < 992) {
//             return $selector.removeClass('navcustom');
//         }

//         $selector.addClass('navcustom');
//     }
    
//     $window
//         .resize(resize)
//         .trigger('resize');
// })(jQuery);

});
