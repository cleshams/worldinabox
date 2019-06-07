    <section class="testimonials">
            <div class="container container--narrow testimonials__container">
                    
                <div class="content__item">
                    <h3 class="page-header">What teachers have to say</h3>
                </div>

                    <div id="testimonials-slider" class="flexslider testimonial__slider">
                        <ul class="slides">
                            <?php

                                $args = array(
                                    'post_type' => 'testimonials',
                                    'post_status' => 'publish',
                                    'posts_per_page' => 6,
                                );

                                $get_posts = new WP_Query($args); // set query with args
                                query_posts($get_posts);

                                if ($get_posts -> have_posts()) : while ( $get_posts -> have_posts() ) : $get_posts -> the_post();

                                $testimonial_name = get_field('testimonial_name');
                                $testimonial_details = get_field('testimonial_details');

                                ?>
                                <li>
                                    <div class="testimonial__quote">
                                        <?php echo cm_excerpt(30); ?>
                                    </div>
                                    <div class="testimonial__info">
                                        <p class="success__name"><span><?php echo $testimonial_name; ?></span> - <?php echo $testimonial_details; ?></p>
                                    </div>
                                </li>

                                <?php // Housekeeping
                                endwhile;
                                else: echo '<p class="small text-centre">No testimonials</p>';
                                endif;

                                wp_reset_postdata();
                                wp_reset_query();
                            ?>

                        </ul>
                    </div>
                    <a href="<?php echo HOME_URI; ?>/testimonials/" class="btn btn--primary">Read all testimonials</a>
        </div>
    </section>
