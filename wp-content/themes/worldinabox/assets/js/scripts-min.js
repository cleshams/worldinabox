jQuery(document).ready(function(t){t("#toggle").click(function(){t(this).toggleClass("active"),t(".nav").toggleClass("open")}),t(".smooth-scroll a").on("click",function(e){var a=t(this);t("html, body").stop().animate({scrollTop:t(a.attr("href")).offset().top+20},1500,"easeInOutExpo"),e.preventDefault()});var e=t("section"),a=t("nav"),n=a.outerHeight();t(window).on("scroll",function(){var o=t(this).scrollTop();e.each(function(){var s=t(this).offset().top-n,i=s+t(this).outerHeight();o>=s&&o<=i&&(a.find("a").removeClass("active"),e.removeClass("active"),t(this).addClass("active"),a.find('a[href="#'+t(this).attr("id")+'"]').addClass("active"))})}),t(".search-form").on("submit",function(e){e.preventDefault();var a=t(this).find(".search-input").val(),n=document.createTextNode(a),o=location.origin+"/dashboard/search/?search=";location.href=o+encodeURIComponent(n.textContent)})}),jQuery(window).load(function(){(new WOW).init()}),jQuery(document).ready(function(t){t(".dropdown-toggle").click(function(){t(this).parent().siblings().find(".nav__dropdown-menu").removeClass("drop"),t(this).parent().children(".nav__dropdown-menu").toggleClass("drop")}),t(".faq").on("click",".accordion-toggle",function(){t(this).toggleClass("open").next(".faq-answer").slideToggle()}),t("#pdf-lesson").on("change",function(e){var a=e.target.options[e.target.selectedIndex].value;t.ajax({url:ajaxpagination.ajaxurl,type:"post",data:{id:a,action:"fetch_objectives"},success:function(e){var a=JSON.parse(e);let n="";t.each(a,function(t,e){n+=e.objective+="\n"});var o=n.replace(/(<([^>]+)>)/gi,"");t("#pdf-objectives").val(o)}})});const e=document.querySelector(".add-new-class-container form");e&&e.addEventListener("submit",function(a){a.preventDefault();const n=e.getAttribute("data-currentuserid"),o=document.querySelector("#class_name").value,s=document.querySelector("#class_unit").value,i=document.querySelector("form .newClass");t(e).find("p.error").slideUp(),e.classList.add("submitting"),i.textContent="",t.ajax({url:ajaxpagination.ajaxurl,type:"post",data:{userId:n,className:o,unit:s,action:"save_new_class"},success:function(t){var e=JSON.parse(t);window.location.reload()},error:function(a){console.log(a),e.classList.remove("submitting"),i.textContent="Save class",e.classList.add("error"),t(e).find("p.error").text("There was an error with your submission. Please refresh the page and try again, or contact us for support").slideDown()}})});const a=document.querySelectorAll(".submit-lesson-form");a&&t(a).each(function(e,a){t(a).on("click",function(e){e.preventDefault();const a=t(this).data("classnum"),n=t(this).data("rowid"),o=t(this).data("userid"),s=t(this).data("classname"),i=t(this).data("unit"),r=t('form[data-classnum="'+a+'"]');t(r).find("p.error").slideUp(),t(r).addClass("submitting"),t(this).text(""),inputs=t('form[data-classnum="'+a+'"] input[type="number"]');var c="{";inputs.each(function(e,a){var n=e+1;c+='"'+n+'":"'+t(a).val()+'"',n<6&&(c+=",")}),c+="}",t.ajax({url:ajaxpagination.ajaxurl,type:"post",data:{userId:o,rowId:n,className:s,unit:i,results:c,action:"save_lesson_data"},success:function(t){var e=JSON.parse(t);console.log(e),window.location.reload()},error:function(e){console.log(e),t(r).removeClass("submitting"),t(r).find("button").text("Update Active Minutes"),t(r).addClass("error"),t(r).find("p.error").text("There was an error with your submission. Please refresh the page and try again, or contact us for support").slideDown()}})})})}),jQuery(window).load(function(){jQuery("#testimonials-slider").flexslider({animation:"slide",animationLoop:!0,directionNav:!0,controlNav:!0})});