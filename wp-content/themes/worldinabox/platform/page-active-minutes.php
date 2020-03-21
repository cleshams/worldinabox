<?php
/**
*   Template name: Active Minutes
**/


get_template_part('platform/partials', 'header');


while ( have_posts() ) : the_post();
?>

<main>

<section>
        <div class="container text__center">
            <h1 class="text__center"><?php the_title(); ?></h1>
        </div>
</section>


<section class="cms bg__grey-light bg--grey-light-brush">
    <div class="container container--inner">
        <?php
            the_content();
        ?>
    </div>
</section>


</main>
<?php endwhile;

get_template_part('platform/partials', 'footer'); ?>