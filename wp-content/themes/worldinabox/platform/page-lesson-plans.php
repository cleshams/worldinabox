<?php
/**
*   Template name: Lesson Plans
**/

get_template_part('platform/partials', 'header');

while ( have_posts() ) : the_post();
?>

<main>

<section class="section__warm-ups">
        <div class="container container--inner">

            <h1 class="text__center">Lesson Plans</h1>
            <h2 class="text__center" style="color:#d95ca0;">Feature in development</h1>
        
        </div>
    </section>
    <?php
endwhile;

get_template_part('platform/partials', 'footer'); ?>