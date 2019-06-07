<?php
/**
*   Template name: Videos
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
                <h2 class="page-header">Watch our videos</h2>
                <?php echo do_shortcode('[yt_playlist mainid="46QMpdnBGVg" vdid="46QMpdnBGVg,wkibgN7A4JU,RPHpFQH9fIE,pT00WOPIzuE,f4goN_7Lz2k,3JuFDYOCvqQ,HjxkomUwDxk"]'); ?>

            </div>
        </div>
    </div>
</section>




    <?php endwhile; endif; ?>
<?php get_footer(); ?>
