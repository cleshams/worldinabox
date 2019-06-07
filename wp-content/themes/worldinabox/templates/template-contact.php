<?php
/**
*   Template name: Contact
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


   <div class="hero hero--small" style="background-image: url('<?php echo $heroimage; ?>');">
        <div class="hero__overlay hero__overlay--purple"></div>
            <div class="hero__content--abs">
                <div class="hero__content-inner">  
        
                    <div class="container container--narrow">
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


        <section class="main-content home-intro text-centre">
            <div class="container container--narrow">
                <div class="content">

                        <div class="home-intro__text">
                            <h2>Get in touch with us</h2>
                            <div class="content__item">
                                <?php the_content(); ?>
                            </div>

                                <h5 class="icon-heading icon-heading__email">
                                    <a href="mailto:support@worldinabox.online">support@worldinabox.co</a></h5>
                                <h5 class="icon-heading icon-heading__phone">Call Movema for further info: 0748365869</h5>
                        </div>

                </div>
            </div>
        </section>



<section class="bg--light contact-content__form edge edge-top--light edge-bottom--light">
    <div class="container container--narrow">
            <div class="content__item">
                <?php echo do_shortcode('[contact-form-7 id="275" title="Contact form 1"]'); ?>
            </div>
    </div>
</section>






	<?php endwhile; endif; ?>

<?php get_footer(); ?>
