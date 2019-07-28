<a class="news-block__item home-news-block__item" href="<?php the_permalink();?>">
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
    <div class="news-block__content news-block__content--green">
        <div class="news-block__inner">
            <span class="news-block__date"><?php echo get_the_date('m.d.Y'); ?></span>
            <h4><?php the_title(); ?></h4>
            <?php echo wpautop(cm_excerpt(10)); ?>
        </div>
    </div>
</a>
