<?php get_header() ; ?>

    <?php if ( have_posts() ): ?>

    <?php while ( have_posts() ) : the_post(); ?>


    <?php endwhile; endif; ?>



                    <?php
                        
                        $heroimage = THEME_URI . '/assets/images/dancing-1.jpg'

                    ?>

   <div class="hero hero--medium" style="background-image: url('<?php echo $heroimage; ?>');">
        <div class="hero__overlay hero__overlay--purple"></div>
            <div class="hero__content--abs">
	            <div class="hero__content-inner">  
        
                	<div class="container container--narrow">
	                    <div class="columns">
	                        <div class="columns__column columns__column">
	                            <h1 class="hero__title">Blog</h1>

                				<p class="hero__text">Where we share advice and ideas about world dance for children - and news about what we've been doing. Follow us on Twitter, Instagram or Facebook for regular updates!</p>
	                        </div>
	                    </div>
                	</div>

            </div>
        </div>
    </div>


<section class="news-blocks__wrap home-news-blocks__wrap">
    <div class="news-blocks__inner">
        <div class="container container--inner text-centre">
            <div class="content__item">
                <h3 class="page-header">Latest from World in a box</h3>

            </div>


            <div class="news-blocks home-news-blocks">

            <?php
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

            // SITE COPY
            $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => 12,
            'orderby' => 'date',
            'order' => 'DESC',
            'paged' => $paged,

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
        	?>

            </div>

            <?php if(function_exists('wp_pagenavi')) : ?>
                <?php wp_pagenavi();?>
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
</section>


<?php get_footer(); ?>
