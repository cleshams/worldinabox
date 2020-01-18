<?php
/**
*   Template name: Active Games
**/

get_template_part('platform/partials', 'header');

while ( have_posts() ) : the_post();
?>

<main>

    <section class="section__warm-ups">
        <div class="container container--inner">

            <h1 class="text__center">Active Games</h1>
            <?php the_content(); ?>
            
        <?php $games = get_posts(array(
            'post_type' => 'games',
            'posts_per_page' => -1
          ));

        echo '<ul class="active-games flex-third lesson-list">';
        foreach($games as $game)
        {
            $id = $game->ID;
            $units = wp_get_post_terms($id, 'unit');
            $proceed = false;
            foreach($units as $unit)
            {
                if(in_array($unit->slug, array_keys($_SESSION['memberships'])) || in_array('world-in-a-box-full', array_keys($_SESSION['memberships']))) { $proceed = true;} 
            }
            if($proceed)
            {
                $title = $game->post_title;
                $link = get_the_permalink($game);
                echo '
                <li class="lesson--shape">
                    <a href="'.$link.'">
                        <span class="text__sub-title">Theme:</span>
                        <h3>'.$title.'</h3>
                    </a>
                </li>';
            }
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


<?php
get_template_part('platform/partials', 'footer');
?>

<?php
endwhile;
?>