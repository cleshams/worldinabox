<?php
/**
*   Template name: Glossary
**/

get_template_part('platform/partials', 'header');

global $post;
?>

<main>
    <section>
        <div class="container text__center">
            <h1 class="text__center"><?php the_title(); ?></h1>
            <div class="text__center container container--narrow text__larger">
                <?php
                    echo wpautop($post->post_content);
                ?>
            </div>
        </div>
    </section>
    
    <section class="cms bg__grey-light bg--grey-light-brush">
        <div class="container container--inner">
            <dl class="glossary-terms">
            <?php
                $terms = get_field('terms');
                foreach($terms as $term)
                {
                    echo '
                    <dt>'.$term['term'].'</dt>
                    <dd>'.$term['definition'].'</dd>
                    ';
                }    
            ?>
        </div>
    </section>
</main>

<?php
get_template_part('platform/partials', 'footer');
?>
