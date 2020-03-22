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
  
    
    /************** */
    /* Add new class */
    /************** */
    
    const newClassForm = document.querySelector('.add-new-class-container form');
    if(newClassForm) {
        newClassForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const userId = newClassForm.getAttribute('data-currentuserid');
            const className = document.querySelector('#class_name').value;
            const unit = document.querySelector('#class_unit').value;
            console.log(userId + ' ' + className + ' ' + unit);
    
            $.ajax({
                url:ajaxpagination.ajaxurl,
                type:'post',
                data: {
                    'userId': userId,
                    'className': className,
                    'unit': unit,
                    action: 'save_new_class'
                },
                success: function(result) {
                    var jsonResult = JSON.parse(result);
                    console.log(jsonResult);
                    //@TODO some form response stuff and remove loading anim
                    window.location.reload();
                }
            });
        })
    }


    /************** */
    /* Update Lesson */
    /************** */

    const submitLessonButtons = document.querySelectorAll('.submit-lesson-form');
    
    if(submitLessonButtons)
    {
       $(submitLessonButtons).each(function(i, v) {
            $(v).on('click', function(e) {
                e.preventDefault();
                const rowId = $(this).data('rowid');
                const userId = $(this).data('userid');
                const className = $(this).data('classname');
                const unit = $(this).data('unit');
                const classNum = $(this).data('classnum');
                inputs = $('form[data-classnum="'+classNum+'"] input[type="number"]');
                var values ='{';
                inputs.each(function(i,v)
                {
                    var j = i+1;
                    values += '"'+j+'":"'+$(v).val()+'"';
                    if(j < 6)
                    {
                        values += ',';
                    }
                });
                values += '}';
                console.log(values);
                console.log(rowId + ' ' + userId + ' ' + className + ' ' + unit );
                $.ajax({
                    url:ajaxpagination.ajaxurl,
                    type:'post',
                    data: {
                        'userId': userId,
                        'rowId': rowId,
                        'className': className,
                        'unit': unit,
                        'results': values, 
                        action: 'save_lesson_data'
                    },
                    success: function(result) {
                        var jsonResult = JSON.parse(result);
                        console.log(jsonResult);
                        //@TODO some form response stuff and remove loading anim
                        window.location.reload();
                    }
                });
            })
       })
    }

});




  jQuery(window).load(function() {

      jQuery('#testimonials-slider').flexslider({
      animation: "slide",
      animationLoop: true,
      directionNav: true,
      controlNav: true,
      });

  });