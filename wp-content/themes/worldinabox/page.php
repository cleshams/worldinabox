<?php
/**
 */
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


   <div class="hero hero--small" style="background-image: url('<?php echo $heroimage; ?>');">
        <div class="hero__overlay hero__overlay--purple"></div>
            <div class="hero__content--abs">
	            <div class="hero__content-inner">  
        
                	<div class="container container--inner">
	                    <div class="columns">
	                        <div class="columns__column">
	                            <h1 class="hero__title"><?php the_title(); ?></h1>
	                            <?php if (get_field('hero_text') ) {
	                            	echo '<p class="hero__text">' . the_field('hero_text') . '</p>';
	                            } ?>
	                        </div>
	                    </div>
                	</div>

            </div>
        </div>
    </div>

<div class="main-content">
    <div class="container container--inner">

		<?php the_content(); ?>
    </div>
</div>

	<?php endwhile; endif; ?>

<?php get_footer(); ?>
