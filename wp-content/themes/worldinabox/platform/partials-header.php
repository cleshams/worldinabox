<?php
global $post;
if(!wc_memberships_user_can(get_current_user_id(), 'view', array('post' => get_the_ID())))
{
    wp_redirect('/my-account');
}
?>

<!DOCTYPE HTML>
<head>
	<title><?php bloginfo( 'name' ); ?><?php wp_title( ' ' ); ?></title>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/png" href="<?php echo THEME_URI ?>/assets/images/favicon.png"/>
	<?php wp_head(); ?>

</head>

<body <?php body_class('platform'); ?> >

  <header class="site-header header-fixed-top">
    <div class="container container--inner site-header__container">
		<div class="site-header__inner">

			<a class="site-logo" href="<?php echo HOME_URI; ?>/dashboard">
				<img src="<?php echo THEME_URI; ?>/assets/images/logo.svg" class="site-logo__img">
			</a>	
			<div class="site-header__wrap">
				<nav class="nav">
                    <ul class="nav__menu">
                        <li class="nav__item">
                            <a href="<?php echo HOME_URI; ?>/dashboard" class="nav__link">Dashboard</a>
                        </li>
                        <li class="nav__item dropdown__parent">
                            <button class="nav__link dropdown-toggle dropdown__sibling">Lessons</button>
                            <div class="dropdown">
                                <ul>
                                    <?php
                                    $units = get_terms('unit');
                                    foreach($units as $unit)
                                    {
                                        $title = $unit->name;
                                        $slug = $unit->slug;
                                        $number = get_field('unit_number', 'unit_' . $unit->term_id);

                                        echo '<li>
                                            <a href="'.HOME_URI.'/dashboard/unit-'.$slug.'" class="nav__link">Unit '.$number.'</a>
                                            </li>';
                                    }
                                    ?>
                                </ul>
                            </div>
                        </li>
						<li class="nav__item">
                            <a href="<?php echo HOME_URI; ?>/dashboard/follow-along-dance-routines" class="nav__link">Routines</a>
                        </li>
						<li class="nav__item">
                            <a href="<?php echo HOME_URI; ?>/dashboard/warm-ups" class="nav__link">Warm-Ups</a>
                        </li>
						<li class="nav__item">
                            <a href="<?php echo HOME_URI; ?>/dashboard/active-games" class="nav__link">Games</a>
                        </li>
						<li class="nav__item">
                            <a href="<?php echo HOME_URI; ?>/dashboard/lesson-build" class="nav__link">Build a Plan</a>
                        </li>
                    </ul>
				</nav>

				<ul class="nav-btns">
					<li class="nav-btns__item">
                        <a href="/my-account/" title="My Account" class="nav-btns__btn nav-btns__btn-profile">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 13.6 14.6" style="enable-background:new 0 0 13.6 13.6;" xml:space="preserve">
                            <path d="M0,13.6h12.6c0-2.8-2-5.2-4.6-5.9c1.4-0.6,2.4-2,2.4-3.7c0-2.2-1.8-4-4-4s-4,1.8-4,4c0,1.6,1,3,2.4,3.7C2,8.4,0,10.8,0,13.6"/>
                        </svg>
					    </a>
					</li>
					<li class="nav-btns__item nav-btns__logout">
						<a href="<?php echo wp_logout_url('my-account'); ?>" class="nav-btns__btn nav-btns__btn-logout" title="logout">
                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 330 330" style="enable-background:new 0 0 330 330;" xml:space="preserve">
                                <path id="XMLID_4_" d="M51.213,180h173.785c8.284,0,15-6.716,15-15s-6.716-15-15-15H51.213l19.394-19.393c5.858-5.857,5.858-15.355,0-21.213c-5.856-5.858-15.354-5.858-21.213,0L4.397,154.391c-0.348,0.347-0.676,0.71-0.988,1.09c-0.076,0.093-0.141,0.193-0.215,0.288c-0.229,0.291-0.454,0.583-0.66,0.891c-0.06,0.09-0.109,0.185-0.168,0.276c-0.206,0.322-0.408,0.647-0.59,0.986c-0.035,0.067-0.064,0.138-0.099,0.205c-0.189,0.367-0.371,0.739-0.53,1.123c-0.02,0.047-0.034,0.097-0.053,0.145c-0.163,0.404-0.314,0.813-0.442,1.234c-0.017,0.053-0.026,0.108-0.041,0.162c-0.121,0.413-0.232,0.83-0.317,1.257c-0.025,0.127-0.036,0.258-0.059,0.386c-0.062,0.354-0.124,0.708-0.159,1.069C0.025,163.998,0,164.498,0,165s0.025,1.002,0.076,1.498c0.035,0.366,0.099,0.723,0.16,1.08c0.022,0.124,0.033,0.251,0.058,0.374c0.086,0.431,0.196,0.852,0.318,1.269c0.015,0.049,0.024,0.101,0.039,0.15c0.129,0.423,0.28,0.836,0.445,1.244c0.018,0.044,0.031,0.091,0.05,0.135c0.16,0.387,0.343,0.761,0.534,1.13c0.033,0.065,0.061,0.133,0.095,0.198c0.184,0.341,0.387,0.669,0.596,0.994c0.056,0.088,0.104,0.181,0.162,0.267c0.207,0.309,0.434,0.603,0.662,0.895c0.073,0.094,0.138,0.193,0.213,0.285c0.313,0.379,0.641,0.743,0.988,1.09l44.997,44.997C52.322,223.536,56.161,225,60,225s7.678-1.464,10.606-4.394c5.858-5.858,5.858-15.355,0-21.213L51.213,180z"/>
                                <path id="XMLID_5_" d="M207.299,42.299c-40.944,0-79.038,20.312-101.903,54.333c-4.62,6.875-2.792,16.195,4.083,20.816c6.876,4.62,16.195,2.794,20.817-4.083c17.281-25.715,46.067-41.067,77.003-41.067C258.414,72.299,300,113.884,300,165s-41.586,92.701-92.701,92.701c-30.845,0-59.584-15.283-76.878-40.881c-4.639-6.865-13.961-8.669-20.827-4.032c-6.864,4.638-8.67,13.962-4.032,20.826c22.881,33.868,60.913,54.087,101.737,54.087C274.956,287.701,330,232.658,330,165S274.956,42.299,207.299,42.299z"/>
                            </svg>
                        </a>
					</li>
                    <li class="hamburger-button nav-btns__item">
                        <button type="button" class="hamburger-button__container" id="toggle">
                            <span class="hamburger-button__top"></span>
                            <span class="hamburger-button__middle"></span>
                            <span class="hamburger-button__bottom"></span>
                        </button>
                    </li>
				</ul>

			</div>

		</div>
    </div>
  </header>
  <div class="header--search-form">
        <form>
            <input id="search" class="search-input" type="text" placeholder="Feature in development">
            <label class="search-label visually-hidden" for="search">
                Search for lessons    
            </label>
            <input class="button" type="button" value="Search" disabled>
            <p id="error" role="alert"></p>
        </form>
	</div>

