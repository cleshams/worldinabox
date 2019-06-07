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
                <h2 class="page-header">What is World in a box?</h2>

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
                            <p>Lesson plans, music, videos, dance props, and stickers to help plan and deliver classes for children at Key stages 1 & 2.</p>
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

                            <h3 class="h5">World culture</h3>
                            <p>World in a Box gets over 5000 children per year dancing and learning about world cultures through engaging resources.</p>
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

                            <h3 class="h5">Improved confidence</h3>
                            <p>Parents and teachers report significant improvement in confidence, fitness and cultural understanding.</p>
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

                            <h3 class="h5">Children love it</h3>
                            <p>Most importantly, World in a Box is fun and children love the colourful, multi-media approach!</p>
                        </div>    
                    </div>


            </div>
        </div>
    </div>
</section>


<section class="bg--light contact-content__form edge edge-top--light edge-bottom--light">
    <div class="container container--medium text-centre">
        <div class="content__item--lg">

            <div class="content__item testimonial__video">
                <div class="video-container">
                    <figure class="wp-block-embed-youtube wp-block-embed is-type-video is-provider-youtube wp-embed-aspect-16-9 wp-has-aspect-ratio"><div class="wp-block-embed__wrapper">
                    <iframe width="500" height="281" src="https://www.youtube.com/embed/wkibgN7A4JU?feature=oembed" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
                    </div></figure>
                </div>
            </div>

            <div class="content__item">


            <h3 class="page-header">See what teachers are saying</h3>


            <div class="testimonial__quote">
                <div class="testimonial__marks">
                World in a Box is much more exciting and engaging than other schemes I have used in the past. The resources that come with the box are so helpful to ensure you can teach the lesson straight away as soon as you open the box. The awe and wonder the children have when you first open the box is amazing and holds the excitement of the children for a long time.
                </div>
            </div>
            <div class="testimonial__info">
                <p class="success__name"><span>Laura McConkey</span> - Primary School Teacher</p>
            </div>
        </div>
        
        </div>
    </div>
</section>


<section>
    <div class="content__item content__item--lg">
        <div class="container container--narrow text-centre">

            <div class="content__item testimonial__video">
                <div class="video-container">
                    <figure class="wp-block-embed-youtube wp-block-embed is-type-video is-provider-youtube wp-embed-aspect-16-9 wp-has-aspect-ratio"><div class="wp-block-embed__wrapper">
                    <iframe width="500" height="281" src="https://www.youtube.com/embed/_xJSTLJtEyE?start=15&amp;feature=oembed" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
                    </div></figure>
                </div>
            </div>

            <div class="content__item">
                <h4>Bring World in a Box into your school</h4>
                <p>World in a Box is a critically acclaimed teaching resource from award-winning dance company Movema. </p>

                <p>Movema world dance experts have worked with teachers for the past 5 years to develop this unique resource which increases confidence, tackles obesity, improves mental health and gives children an understanding of UK diverse communities and cultures for around the world through language, geography, history, STEM subjects and of course, dance!</p>
            </div>


        </div>
    </div>
</section>

<section class="bg--light contact-content__form edge edge-top--light edge-bottom--light">
    <div class="container container--medium text-centre">
        <div class="content__item--lg">


            <div class="content__item testimonial__video">
                <div class="video-container">
                    <figure class="wp-block-embed-youtube wp-block-embed is-type-video is-provider-youtube wp-embed-aspect-16-9 wp-has-aspect-ratio"><div class="wp-block-embed__wrapper">
                    <iframe width="500" height="281" src="https://www.youtube.com/embed/7Py1dOn0iro?feature=oembed" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
                    </div></figure>
                </div>
            </div>

            <div class="content__item">
                <h4>Our journey so far</h4>
                <p>World in a Box is a critically acclaimed teaching resource from award-winning dance company <a href="http://movema.co.uk" target="_blank">Movema.</a></p>

                <p>Movema world dance experts have worked with teachers for the past 5 years to develop this unique resource which increases confidence, tackles obesity, improves mental health and gives children an understanding of UK diverse communities and cultures for around the world through language, geography, history, STEM subjects and of course, dance!</p>
            </div>


        </div>
    </div>
</section>



    <?php endwhile; endif; ?>
<?php get_footer(); ?>
