jQuery(document).ready(function(e){e("#toggle").click(function(){e(this).toggleClass("active"),e(".nav").toggleClass("open")}),e(".smooth-scroll a").on("click",function(o){var t=e(this);e("html, body").stop().animate({scrollTop:e(t.attr("href")).offset().top+20},1500,"easeInOutExpo"),o.preventDefault()});var i=e("section"),a=e("nav"),s=a.outerHeight();e(window).on("scroll",function(){var n=e(this).scrollTop();i.each(function(){var o=e(this).offset().top-s,t=o+e(this).outerHeight();o<=n&&n<=t&&(a.find("a").removeClass("active"),i.removeClass("active"),e(this).addClass("active"),a.find('a[href="#'+e(this).attr("id")+'"]').addClass("active"))})})}),jQuery(window).load(function(){(new WOW).init()}),jQuery(document).ready(function(o){o(".dropdown-toggle").click(function(){o(this).parent().siblings().find(".nav__dropdown-menu").removeClass("drop"),o(this).parent().children(".nav__dropdown-menu").toggleClass("drop")});
/* ===========================================================
       MAGNIFIC POPUP
    ============================================================== */
// $('.mp-singleimg').magnificPopup({
//     type: 'image'
// });
// $('.mp-gallery').magnificPopup({
//     type: 'image',
//     gallery:{enabled:true},
// });
// $('.mp-iframe').magnificPopup({
// disableOn: 700,
// type: 'iframe',
// removalDelay: 160,
// preloader: false,
// fixedContentPos: false
// });
}),jQuery(window).load(function(){jQuery("#testimonials-slider").flexslider({animation:"slide",animationLoop:!0,directionNav:!0,controlNav:!0})});