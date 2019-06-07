<?php
/**
*   Template name: Testimonials
**/
?>
<?php get_header() ; ?>



                    <?php
                    if ( has_post_thumbnail() ) {
                        $imageid = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'landscape-lg' );
                        $heroimage = $imageid['0'];
                    } else {
                        $heroimage = 'http://via.placeholder.com/1200x700';
                    }

                    ?>


   <div class="hero hero--small" style="background-image: url('<?php echo $heroimage; ?>');">
        <div class="hero__overlay hero__overlay--purple"></div>
            <div class="hero__content--abs">
                <div class="hero__content-inner">  
        
                    <div class="container container--narrow">
                        <div class="columns">
                            <div class="columns__column">
                                <h1 class="hero__title"><?php the_title(); ?></h1>
                                <?php if (get_field('hero_text') ) {

                                    $herotext = get_field('hero_text');

                                    echo '<p class="hero__text">' . $herotext . '</p>';
                                } ?>
                            </div>
                        </div>
                    </div>

            </div>
        </div>
    </div>

<section class="main-content why-content">
    <div class="why-content__inner">
        <div class="container container--inner">
                <h2 class="page-header">What teachers say</h2>

 
                    <?php

                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

                        $args = array(
                            'post_type' => 'testimonials',
                            'post_status' => 'publish',
                            'posts_per_page' => 8,
                            'paged' => $paged,
                        );

                        $get_posts = new WP_Query($args); // set query with args
                        query_posts($get_posts);

                        if ($get_posts -> have_posts()) : while ( $get_posts -> have_posts() ) : $get_posts -> the_post();

                        $testimonial_name = get_field('testimonial_name');
                        $testimonial_details = get_field('testimonial_details');

                        ?>
                        <div class="content__item">
                            <div class="testimonial__quote">
                                                <?php the_content() ?>
                            </div>
                            <div class="testimonial__info">
                                <p class="success__name"><span><?php echo $testimonial_name; ?></span> - <?php echo $testimonial_details; ?></p>
                            </div>
                        </div>

            <?php // Housekeeping
            endwhile;
            else: echo '<p class="small text-centre">No posts</p>';
            endif;
            ?>

                    <?php if(function_exists('wp_pagenavi')) : ?>
                        <div class="content__item content__item--centre">
                            <?php wp_pagenavi(array( 'query' => $get_posts ));?>
                        </div>
                    <?php else : ?>
                    <div id="pagination">
                        <ul class="pagination">
                            <li id="previous-stories" class="arrow">
                                <?php previous_posts_link( '< Previous Stories', $get_posts->max_num_pages ); ?>
                            </li>
                            <li id="next-stories" class="arrow">
                                <?php next_posts_link( 'Next Stories >', $get_posts->max_num_pages ); ?>
                            </li>
                        </ul>
                    </div><!-- /#pagination -->
                    <?php endif; ?>

            </div>
        </div>
    </div>
</section>



<?php get_footer(); ?>
