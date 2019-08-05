<!DOCTYPE HTML>
<!--[if IEMobile 7 ]><html class="no-js iem7" manifest="default.appcache?v=1"><![endif]-->
<!--[if lt IE 7 ]><html class="no-js ie6" lang="en"><![endif]-->
<!--[if IE 7 ]><html class="no-js ie7" lang="en"><![endif]-->
<!--[if IE 8 ]><html class="no-js ie8" lang="en"><![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html class="no-js" lang="en"><!--<![endif]-->
<head>
	<title><?php bloginfo( 'name' ); ?><?php wp_title( '|' ); ?></title>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="icon" type="image/png" href="<?php echo THEME_URI ?>/assets/images/favicon.png"/>
	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?> >

  <header class="site-header header-fixed-top">
    <div class="container container--inner site-header__container">
		<div class="site-header__inner">

			<a class="site-logo" href="<?php echo HOME_URI; ?>">
				<img src="<?php echo THEME_URI; ?>/assets/images/logo.svg" class="site-logo__img">
			</a>	
			<div class="site-header__wrap">
				<nav class="nav">
				<?php
				   wp_nav_menu([
					 'menu'            => 'main-menu',
					 'theme_location'  => 'primary-menu',
					 'container'       => '',
					 'container_id'    => 'bs4navbar',
					 'container_class' => '',
					 'menu_id'         => false,
					 'menu_class'      => 'nav__menu',
					 'depth'           => 2,
					 'fallback_cb'     => 'bs4navwalker::fallback',
					 'walker'          => new bs4navwalker()
				   ]);
				?>
				</nav>
				<ul class="nav-btns">

					<li class="nav-btns__item">
					  <a href="/my-account/" class="nav-btns__btn nav-btns__btn-profile"></a>
					</li>
					<li class="nav-btns__item nav-btns__cart-item">
						<a href="<?php echo wc_get_cart_url(); ?>" class="nav-btns__btn nav-btns__btn-cart widget_shopping_cart__btn"></a>
						<?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
					</li>
				</ul>

				<div class="hamburger-button">
					<button type="button" class="hamburger-button__container" id="toggle">
						<span class="hamburger-button__top"></span>
						<span class="hamburger-button__middle"></span>
						<span class="hamburger-button__bottom"></span>
					</button>
				</div>
			</div>

		</div>
    </div>
  </header>


  <main>
