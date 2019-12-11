<?php
/**
*   Template name: Follow Along Dance Routines
**/

get_template_part('platform/partials', 'header');
$linked = (isset($_GET['warmup'])) ? $_GET['warmup'] : null;
while ( have_posts() ) : the_post();
?>

<main>

    <div class="modal vimeo-modal">
        <div class="iframe-container-container">
            <div class="iframe-container">
            </div>
            <button class="close-modal">X</button>
        </div>
    </div>

    
    <section class="cms bg__grey-light bg--grey-light-brush">
        <div class="container container--inner">
            <h1 class="text__center"><?php the_title(); ?></h1>
            <?php
                the_content();
            ?>
        </div>
    </section>

    <section class="section__warm-ups">
        <div class="container container--inner">

            
        <?php $warmUps = get_posts(array(
            'post_type' => 'followalongs',
            'posts_per_page' => -1
          ));

        echo '<ul class="warm-ups">';
        foreach($warmUps as $warmUp)
        {
            $title = $warmUp->post_title;
            $id = $warmUp->ID;
            $slug = $warmUp->post_name;
            $class = ($slug == $linked) ?'class="trigger-on-load"' : '';
            $content = get_field('contet', $id);
            $video = get_field('video', $id);
            $placeholder = get_field('placeholder', $id);
            // $steps = get_field('instructions', $id);

              echo '
              <li>
                <button '.$class.'>
                    <span class="text__sub-title">Theme: </span>
                    <h2>'.$title.'</h2>
                </button>
                <div class="warmup-content display--flex">
                    <div>
                        '.$content.'
                    </div>
                    <div class="video-trigger-container">
                        <span class="text__med-title">Video</span>
                        <button class="trigger-video" title="Play '.$title.' video" data-src="'.$video.'">
                            <img src="'.$placeholder['url'].'" alt="trigger '.$title.' video"/>
                        </button>  
                    </div>
                </div>
            </li>';
        }
        echo '</ul>';
        wp_reset_query();
        wp_reset_postdata();
        ?>

        </div>
    </section>

    <section class="section__additional-links">
        <div class="container container--inner">
            <ul class="flex-third">
                <li><a href="<?php echo HOME_URI; ?>/dashboard/glossary" class="text__med-title">Glossary</a></li>
                <li><a href="<?php echo HOME_URI; ?>/dashboard/lesson-plans" class="text__med-title">Lesson Plan Builder</a></li>
                <li><a href="<?php echo HOME_URI; ?>/dashboard/help-support" class="text__med-title">Help & Support</a></li>
            </ul>
        </div>
    </section>
    
</main>


<script>
    var acc = document.querySelectorAll(".warm-ups > li > button");
    console.log(acc);
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            this.classList.toggle("open");
            var card = this.parentElement;
            card.classList.toggle('open');
            
            if (card.classList.contains('open')){
                card.style.maxHeight = (card.scrollHeight + 20) + "px";
            } else {
                card.style.maxHeight = null;
            } 
        });
    }
    window.onload = function() {
        var trigger = document.querySelector('.trigger-on-load');
        if(trigger) {
            trigger.classList.remove('trigger-on-load');
            trigger.click();
        }
    }
</script>
<?php
get_template_part('platform/partials', 'footer');
?>

<?php
endwhile;
?>