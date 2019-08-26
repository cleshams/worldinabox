
    <footer class="site-footer">
        <div class="container container--inner">
            <div class="columns">
                <div class="columns__column columns__column--half">

                    <div class="content__item">
                        <img src="<?php echo THEME_URI; ?>/assets/images/logo.svg" class="site-logo__img footer-logo__img">
                    </div>

                    <div class="content__item back-to">
                        <p>Back to<br>
                        <a href="<?php echo site_url(); ?>" class="text__sub-title">worldinabox.co</a></p>
                    </div>

                    <div class="content__item">
                        <h5>Follow us</h5>
                        <?php
                            wp_nav_menu(
                                array(
                                    'theme_location'  => 'social-media',
                                    'link_before'     => '<span class="screen-reader-text">',
                                    'link_after'      => '</span>',
                                    'depth'           => 1,
                                    'fallback_cb'     => '',
                                )
                            );
                        ?>
                    </div>


                    <div class="content__item">
                        <nav class="nav">
                
                        </nav>

                        <p class="site-footer__copy">&copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?> | <a href="/privacy-policy">Privacy Policy</a></p>
                    </div>

                </div>
            </div>

        </div>
    </footer>
       <?php wp_footer(); ?>
       <script type="text/javascript" src="<?php echo THEME_URI; ?>/assets/js/platform.js" ></script> 
	</body>
</html>
