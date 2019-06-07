<?php get_header() ; ?>


                    <?php
                        
                        $heroimage = THEME_URI . '/assets/images/dancing-1.jpg'

                    ?>

   <div class="hero hero--small" style="background-image: url('<?php echo $heroimage; ?>');">
        <div class="hero__overlay hero__overlay--purple"></div>
            <div class="hero__content--abs">
                <div class="hero__content-inner">  
        
                    <div class="container container--narrow">
                        <div class="columns">
                            <div class="columns__column columns__column">
                                <h1 class="hero__title">Blog</h1>
                            </div>
                        </div>
                    </div>

            </div>
        </div>
    </div>



	<?php if ( have_posts() ): ?>

	<?php while ( have_posts() ) : the_post(); ?>


<section class="news-article">
    <div class="container container--narrow">
        <div class="content__item--lg">

                    <?php
                    if ( has_post_thumbnail() ) {
                        $image = the_post_thumbnail('landscape-md', ['class' => 'img-responsive img-border-rad', 'title' => 'Feature image']);                    
                    } else {
                        $image = '';
                    }

                    ?>


                <article>

                        <div class="post-info__img-wrap">
                            <?php echo $image; ?>
                        </div>

                    <div class="post-info">
                        <div class="post-info__date">
                            <div class="post-info__date-wrap">
                                <span class="date__day"><?php the_time( 'j M'); ?></span>
                                <span class="date__year"><?php the_time( 'Y'); ?></span>
                            </div>
                        </div>
                        <div class="post-info__title-wrap">
                            <h2 class="post-info__title"><?php the_title(); ?></h2>
                            <ul class="post-info__cat-list">
                                <li class="post-info__cat-item">Posted in: </li>
                            <?php
                                $categories = get_the_category();
                                $separator = ', ';
                                $output = '';
                                if ( ! empty( $categories ) ) {
                                    foreach( $categories as $category ) {
                                        $output .= '<li class="post-info__cat-item"><a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ) . '" class="post-meta__link">' . esc_html( $category->name ) . '</a></li>' . $separator;
                                    }
                                    echo trim( $output, $separator );
                                } ?>
                            </ul>
                        </div>
                    </div>

                    <?php the_content(); ?>

                              

                </article>


                <div class="content__item share-wrap">
                    <h6 class="sub-title share-wrap__title">Share this article:</h6>
                    <div class="share-wrap__btns">
                        <div class="share-btn-wrap">
                            <a class="share-wrap__btn-link" href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;t=<?php the_title(); ?>" title="Share on Facebook."><i class="fa fa-facebook-square fa-2x"></i></a>
                            <a class="share-wrap__btn-link" href="http://twitter.com/home/?status=<?php the_title(); ?> - <?php the_permalink(); ?>" title="Tweet this!"><i class="fa fa-twitter fa-2x"></i></a>
                            <a class="share-wrap__btn-link" href="http://www.linkedin.com/shareArticle?mini=true&amp;title=<?php the_title(); ?>&amp;url=<?php the_permalink(); ?>" title="Share on LinkedIn"><i class="fa fa-linkedin fa-2x"></i></a>
                            <a class="share-wrap__btn-link" href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href,
                              '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-google-plus fa-2x"></i></a>
                            <a class="share-wrap__btn-link" href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); echo $url; ?>"><i class="fa fa-pinterest fa-2x"></i></a>
                        </div>
                    </div>
                </div>

                <div class="content__item">
                    <a href="/blog/" class="btn btn--light">Back to blog</a>
                </div>

        </div>
    </div>
</section>



    <?php endwhile; ?>


    <?php else: ?>
    <h4>No posts to display</h4>
    <?php endif; ?>




<?php get_footer(); ?>
