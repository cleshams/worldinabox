<?php
/**
*   Template name: About
**/
?>
<?php get_header() ; ?>

    <?php if ( have_posts() ): ?>

    <?php while ( have_posts() ) : the_post(); ?>



                    <?php
                    if ( has_post_thumbnail() ) {
                        $imageid = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'landscape-lg' );
                        $heroimage = $imageid['0'];
                    } else {
                        $heroimage = 'http://via.placeholder.com/1200x700';
                    }

                    ?>


   <div class="hero hero--medium" style="background-image: url('<?php echo $heroimage; ?>');">
        <div class="hero__overlay hero__overlay--purple"></div>
            <div class="hero__content--abs">
                <div class="hero__content-inner">  
        
                    <div class="container container--inner">
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

<div class="main-content">
    <div class="container container--inner">
        <div class="columns">
            <div class="columns__column columns__column--half">
                <h4 class="sub-header">About us</h4>
                <h2>Our journey so far</h2>
                    <?php the_content(); ?>
            </div>
            <div class="columns__column columns__column--half">
                <a class="img-video mp-iframe" href="http://www.youtube.com/watch?v=_xJSTLJtEyE&t=15s">


                    <img src="https://via.placeholder.com/450x450" class="img-responsive img-circle">
                </a>
            </div>
        </div>
    </div>
</div>



<section class="news-blocks__wrap bg--light">
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
                <a href="" class="btn btn--dark">Read all news</a>
            </div>

        </div>
    </div>
</section>

    <?php endwhile; endif; ?>

<?php get_footer(); ?>
