jQuery(document).ready(function($){

  $('#toggle').click(function() {
     $(this).toggleClass('active');
     $('.nav').toggleClass('open');
  });



  $('.smooth-scroll a').on('click', function(event) {
      var $anchor = $(this);
      $('html, body').stop().animate({
          scrollTop: $($anchor.attr('href')).offset().top + 20
      }, 1500, 'easeInOutExpo');
      event.preventDefault();
  });


    var sections = $('section'),
    nav = $('nav'),
    nav_height = nav.outerHeight();

    $(window).on('scroll', function () {
    var cur_pos = $(this).scrollTop();

        sections.each(function() {
            var top = $(this).offset().top - nav_height,
            bottom = top + $(this).outerHeight();

            if (cur_pos >= top && cur_pos <= bottom) {
                nav.find('a').removeClass('active');
                sections.removeClass('active');

                $(this).addClass('active');
                nav.find('a[href="#'+$(this).attr('id')+'"]').addClass('active');
            }
        });
    });

    /* ===========================================================
       Search Form
    ============================================================== */

    
    $('.search-form').on('submit', function(e) 
    {
        e.preventDefault();
        var val = $(this).find('.search-input').val();
        var string = document.createTextNode(val);

        var url = location.origin +'/dashboard/search/?search=';
        console.log(url + encodeURIComponent(string.textContent));
        location.href = url + encodeURIComponent(string.textContent);

    })

});


jQuery(window).load(function() {

  new WOW().init();

});



jQuery(document).ready(function($){

  $('.dropdown-toggle').click(function() {
    $(this).parent().siblings().find('.nav__dropdown-menu').removeClass('drop');
    $(this).parent().children('.nav__dropdown-menu').toggleClass('drop');
  });


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

    
    $('.faq').on('click', '.accordion-toggle', function () {
        $(this).toggleClass('open')
            .next('.faq-answer')
            .slideToggle();
    });

    $('#pdf-lesson').on('change', function(e)
    {
        var lessonId = e.target.options[e.target.selectedIndex].value;
        console.log(lessonId);
        $.ajax({
            url:ajaxpagination.ajaxurl,
            type:'post',
            data: {
                'id': lessonId,
                action: 'fetch_objectives'
            },
            success: function(result) {
                var jsonResult = JSON.parse(result);
                console.log(jsonResult);
                let output = '';
                $.each(jsonResult, function(i,v) 
                {
                    output += v.objective += '\n';
                });
                var StrippedString = output.replace(/(<([^>]+)>)/ig,"");
                $('#pdf-objectives').val(StrippedString);
            }
        });
    });
  

});


  jQuery(window).load(function() {

      jQuery('#testimonials-slider').flexslider({
      animation: "slide",
      animationLoop: true,
      directionNav: true,
      controlNav: true,
      });

  });