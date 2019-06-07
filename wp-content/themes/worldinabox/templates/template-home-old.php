<?php
/**
*   Template name: Homepage
**/
?>

<?php get_header() ; ?>

    <?php if ( have_posts() ): ?>

        <?php while ( have_posts() ) : the_post(); ?>


    <?php get_template_part('content/content', 'hero'); ?>

        <section class="main-content">
            <div class="container container--inner">
                <div class="content">
                    <div class="columns">
                        <div class="columns__column columns__column--half">
                            <h4 class="sub-header">Cross-curricular teaching resource</h4>
                            <h2>Get children moving &amp; learning about world cultures</h2>
                            <div class="">
                                <?php the_content(); ?>
                                <div class="btn-group m-t-md">
                                    <a href="/product/world-in-a-box-1-full-resource/" class="btn btn--primary">Get world in a box</a>
                                    <a href="/about" class="btn btn--light">More about us</a>    
                                </div>
                            </div>
                        </div>
                        <div class="columns__column columns__column--half">
                            <img src="https://via.placeholder.com/450x450" class="img-responsive img-circle">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="home-page-links">

                <div class="home-page-links--half">
                    <div class="home-page-link__item" style="background-image: url('<?php echo THEME_URI; ?>/assets/images/home-link-full-resource.jpg');">
                        <div class="home-page-link__info">
                            <h6 class="home-page-link__sub-title">Introductory offer</h6>
                            <h2 class="home-page-link__title">World in a Box FULL resource</h2>
                            <div class="home-page-link__content">
                                <p>Buy the full resource pack NOW for just £500 for a 6 month period. Price goes up to £600 July 2019.</p>
                                <a href="/product/world-in-a-box-1-full-resource/" class="btn btn--bordered-white">Get World in a Box</a>
                            </div>
                        </div>
                    </div>
                    <div class="home-page-link__overlay--magenta"></div>
                </div>

                <div class="home-page-links--half">
                    <div class="home-page-link__item" style="background-image: url('<?php echo THEME_URI; ?>/assets/images/home-link-workshop.jpg');">
                        <div class="home-page-link__info">
                            <h6 class="home-page-link__sub-title">Special offer</h6>
                            <h2 class="home-page-link__title">FREE taster experience</h2>
                            <div class="home-page-link__content">
                                <p>Enliven your school assembly with a visit from our dynamic team who will lead a short World in a Box session for FREE*</p>
                                <a href="" class="btn btn--bordered-white">Book workshop</a>
                            </div>
                        </div>
                    </div>
                    <div class="home-page-link__overlay--blue"></div>
                </div>

        </section>




<section class="why-content">
    <div class="why-content__inner">
        <div class="container container--inner">
                <h3 class="page-header">Why choose WIAB</h3>
                <div class="columns">
                    <div class="columns__column columns__column--quarter">
                        <div class="content__item why-content__item">

                            <?php
                                $attachment_id = get_field('why_1_image');
                                $size = "square-md"; // (thumbnail, medium, large, full or custom size)
                                $image = wp_get_attachment_image_src( $attachment_id, $size );
                            ?>
                            <img class="img-responsive img-circle why-content__img" alt="" src="<?php echo $image[0]; ?>" />

                            <h3 class="h5">Engaging resources</h3>
                            <p>World in a Box gets over 5000 children per year dancing and learning about world cultures through engaging resources.</p>
                        </div>    
                    </div>

                    <div class="columns__column columns__column--quarter">
                        <div class="content__item why-content__item">

                            <?php
                                $attachment_id = get_field('why_2_image');
                                $size = "square-md"; // (thumbnail, medium, large, full or custom size)
                                $image = wp_get_attachment_image_src( $attachment_id, $size );
                            ?>
                            <img class="img-responsive img-circle why-content__img" alt="" src="<?php echo $image[0]; ?>" />

                            <h3 class="h5">Improved confidence</h3>
                            <p>Parents and teachers report significant improvement in confidence, fitness and cultural understanding.</p>
                        </div>    
                    </div>

                    <div class="columns__column columns__column--quarter">
                        <div class="content__item why-content__item">

                            <?php
                                $attachment_id = get_field('why_3_image');
                                $size = "square-md"; // (thumbnail, medium, large, full or custom size)
                                $image = wp_get_attachment_image_src( $attachment_id, $size );
                            ?>
                            <img class="img-responsive img-circle why-content__img" alt="" src="<?php echo $image[0]; ?>" />

                            <h3 class="h5">Children love it</h3>
                            <p>Most importantly, World in a Box is fun and children love the colourful, multi-media approach!</p>
                        </div>    
                    </div>

                    <div class="columns__column columns__column--quarter">
                        <div class="content__item why-content__item">

                            <?php
                                $attachment_id = get_field('why_4_image');
                                $size = "square-md"; // (thumbnail, medium, large, full or custom size)
                                $image = wp_get_attachment_image_src( $attachment_id, $size );
                            ?>
                            <img class="img-responsive img-circle why-content__img" alt="" src="<?php echo $image[0]; ?>" />

                            <h3 class="h5">Cross-Curricular</h3>
                            <p>Exciting cross-curricular teaching resource World In A Box saves teachers time and money.</p>
                        </div>    
                    </div>


            </div>
        </div>
    </div>
</section>



<section class="resource-icons">
    <div class="container container--inner">
        <div class="content__item">
            <h3 class="page-header">Easy &amp; Fun Teachers resources</h3>
            <p>A box of goodies!  Everything you need to run your own world dance lessons. The resource includes... </p>
        </div>
        <div class="resource-icons__wrap">


            <div class="resource-icon__item">
                <img src="<?php echo THEME_URI; ?>/assets/images/icon-box--purple.svg" class="resource-icon__img wow zoomIn" data-wow-duration=".5s">
                <h6>Adaptable Lesson plans</h6>
            </div>

            <div class="resource-icon__item">
                <img src="<?php echo THEME_URI; ?>/assets/images/icon-music--orange.svg" class="resource-icon__img wow zoomIn" data-wow-duration=".5s">
                <h6>Music</h6>
            </div>

            <div class="resource-icon__item">
                <img src="<?php echo THEME_URI; ?>/assets/images/icon-movie--blue.svg" class="resource-icon__img wow zoomIn" data-wow-duration=".5s">
                <h6>Videos</h6>
            </div>

            <div class="resource-icon__item">
                <img src="<?php echo THEME_URI; ?>/assets/images/icon-lesson--green.svg" class="resource-icon__img wow zoomIn" data-wow-duration=".5s">
                <h6>Worksheets</h6>
            </div>

            <div class="resource-icon__item">
                <img src="<?php echo THEME_URI; ?>/assets/images/icon-drum--red.svg" class="resource-icon__img wow zoomIn" data-wow-duration=".5s">
                <h6>Dance Props</h6>
            </div>


        </div>
    </div>
</section>

<?php get_template_part('content/content', 'testimonials-slider'); ?>



<section class="news-blocks__wrap home-news-blocks__wrap">
    <div class="news-blocks__inner">
        <div class="container container--inner text-centre">
            <div class="content__item">
                <h3 class="page-header">Latest from World in a box</h3>
            </div>
            <div class="news-blocks home-news-blocks">

            <?php

            // SITE COPY
            $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => 4,
            'orderby' => 'menu_order',
            'order' => 'DESC',
            );
            $get_posts = new WP_Query($args); // set query with args
            query_posts($get_posts);

            if ($get_posts -> have_posts()) : 

            $i = 0;

            while ( $get_posts -> have_posts() ) :$get_posts -> the_post(); 
            
                $i++; 

                $className = "";

                if ($i % 3 == 0 || $i % 4 == 0) {
                  $className = "news-block__item--reverse";
                }

                $colour = "news-block__content--green";

                if ($i % 5 == 0) {
                  $colour = "news-block__content--green";
                } 

                if ($i % 2 == 0) {
                  $colour = "news-block__content--blue";
                }

                if ($i % 3 == 0) {
                  $colour = "news-block__content--purple";
                } 

                if ($i % 4 == 0) {
                  $colour = "news-block__content--orange";
                }

                ?>
        
            <a class="news-block__item home-news-block__item <?php echo $className; ?>" href="<?php the_permalink();?>">
                <div class="news-block__img-wrap">

                    <?php
                    if ( has_post_thumbnail() ) {
                        $imageid = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'square-md' );
                        $newsimage = $imageid['0'];
                    } else {
                        $newsimage = 'http://via.placeholder.com/400x400';
                    }

                    ?>

                    <span style="background-image: url('<?php echo $newsimage; ?>');" class="news-block__img"></span>
                </div>
                <div class="news-block__content <?php echo $colour; ?>">
                    <div class="news-block__inner">
                        <span class="news-block__date"><?php echo get_the_date('m.d.Y'); ?></span>
                        <h4><?php the_title(); ?></h4>
                        <div class="news-block__text"><?php echo wpautop(cm_excerpt(10)); ?></div>
                    </div>
                </div>
            </a>
            
            <?php // Housekeeping
            endwhile;
            else: echo '<p class="small text-centre">No posts</p>';
            endif;

            wp_reset_postdata();
            wp_reset_query();
        ?>


            </div>

            <div class="content__item--lg content__item--centre">
                <a href="" class="btn btn--light">Read all news</a>
            </div>

        </div>
    </div>
</section>


	<?php endwhile; endif; ?>

<?php get_footer(); ?>
