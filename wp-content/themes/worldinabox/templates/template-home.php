<?php
/**
*   Template name: Homepage
**/
?>

<?php get_header() ; ?>

    <?php if ( have_posts() ): ?>

        <?php while ( have_posts() ) : the_post(); ?>


    <?php get_template_part('content/content', 'hero'); ?>

        <section class="main-content home-intro">
            <div class="container container--inner">
                <div class="content">
                    <div class="columns home-intro__columns">
                        <div class="columns__column columns__column--half home-intro__text">
                            <h4 class="sub-header">Cross-curricular teaching resource</h4>
                            <h2>Get children moving &amp; learning about world cultures</h2>
                            <div class="">
                                <?php the_content(); ?>
                                <div class="btn-group m-t-md">
                                    <a href="<?php echo HOME_URI; ?>/product/world-in-a-box-1-full-resource/" class="btn btn--primary">Get world in a box</a>
                                    <a href="<?php echo HOME_URI; ?>/about/" class="btn btn--light">More about us</a>    
                                </div>
                            </div>
                        </div>
                        <div class="columns__column columns__column--half home-intro__img">
                            <img src="<?php echo THEME_URI; ?>/assets/images/dancing-1.png" class="img-responsive">
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
                                <p>Buy the full resource pack NOW for just £500 for a 6 month period. Price goes up to £600 July 2020.</p>
                                <a href="<?php echo HOME_URI; ?>/product/world-in-a-box-1-full-resource/" class="btn btn--bordered-white">Get World in a Box</a>
                            </div>
                        </div>
                    </div>
                    <div class="home-page-link__overlay--magenta"></div>
                </div>

                <div class="home-page-links--half">
                    <div class="home-page-link__item" style="background-image: url('<?php echo THEME_URI; ?>/assets/images/home-link-workshop.jpg');">
                        <div class="home-page-link__info">
                            <h6 class="home-page-link__sub-title">Special offer</h6>
                            <h2 class="home-page-link__title">FREE 6 month trial</h2>
                            <div class="home-page-link__content">
                                <p>Enliven your teaching with our digital resources </p>
                                <a href="<?php echo HOME_URI; ?>/product/world-in-a-box-1-full-resource/" class="btn btn--bordered-white">Try our digital platform</a>
                            </div>
                        </div>
                    </div>
                    <div class="home-page-link__overlay--blue"></div>
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
        <div class="container container--inner">
            <div class="content__item">
                <h3 class="page-header">Latest from World in a box</h3>
            </div>
        </div>
        <div class="container container--inner text-centre home-news-blocks__container">

            <div class="news-blocks home-news-blocks">

            <?php

            // SITE COPY
            $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => 4,
            'orderby' => 'date',
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
                <a href="<?php echo HOME_URI; ?>/blog/" class="btn btn--light">Read all news</a>
            </div>

        </div>
    </div>
</section>


	<?php endwhile; endif; ?>

<?php get_footer(); ?>
