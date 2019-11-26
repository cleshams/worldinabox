<?php
/**
*   Template name: Help & Support
**/

get_template_part('platform/partials', 'header');

while ( have_posts() ) : the_post();
?>

<main>

<section class="cms">
        <div class="container container--inner">
            <h1 class="text__center">Help & Support</h1>
            <?php
            the_content();
            ?>
        </div>
    </section>
    <?php
endwhile;

get_template_part('platform/partials', 'footer'); ?>