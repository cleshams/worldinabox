

            <div>
                <div class="content__item--lg">
                    <h3 class="page-header"><i class="fa fa-instagram" aria-hidden="true"></i>&nbsp;<a href="https://www.instagram.com/worldinaboxmovema/" target="_blank">#worldinaboxmovema</a></h3>
                    <?php // echo do_shortcode('[instagram-feed]'); ?>
                </div>
            </div>

        </main>

        <footer class="site-footer">
            <div class="container container--inner">
                <div class="columns">
                    <div class="columns__column columns__column--half">

                        <div class="content__item">
                            <img src="<?php echo THEME_URI; ?>/assets/images/logo.svg" class="site-logo__img footer-logo__img">
                        </div>

                        <div class="content__item">
                            <h4 class="h3">Sign up to our newsletter</h4>
                            <p>To get regular news, fun updates, latest videos and lesson plans sign up to our newsletter!</p>
                            <form action="https://movema.us2.list-manage.com/subscribe/post" method="post" id="mc-embedded-subscribe-form" name="mailchimp__form" class="mailchimp__form validate" target="_blank" novalidate>
                                  <input type="hidden" name="u" value="2a7362a7b8ec5b758c26f6e4b">
                                  <input type="hidden" name="id" value="096052e655">
                                <div class="form__group">
                                    <input class="required email mailchimp__email form__group-input" type="email" value="" name="EMAIL" id="mce-EMAIL" placeholder="Enter email">

                            <div style="position: absolute; left: -5000px;" aria-hidden="true">
                                <input type="text" name="b_2a7362a7b8ec5b758c26f6e4b_096052e655" tabindex="-1" value="">
                            </div>
                            <input type="submit" name="submit" value="Subscribe to list" class="btn mailchimp__btn form__group-input form__group-btn"/>


                                </div>
                            </form>
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
                                <?php
                                   wp_nav_menu([
                                     'menu'            => 'main-menu',
                                     'theme_location'  => 'primary-menu',
                                     'container'       => '',
                                     'container_id'    => 'bs4navbar',
                                     'container_class' => '',
                                     'menu_id'         => false,
                                     // 'menu_class'      => 'nav__menu',
                                     'depth'           => 2,
                                     'fallback_cb'     => 'bs4navwalker::fallback',
                                     'walker'          => new bs4navwalker()
                                   ]);
                                ?>
                            </nav>

                    		<p class="site-footer__copy">&copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?> | <a href="">Privacy Policy</a></p>
                    	</div>

                    </div>
                </div>

            </div>
        </footer>
	   <?php wp_footer(); ?>
	</body>
</html>
