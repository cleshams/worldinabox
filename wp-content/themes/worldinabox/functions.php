<?php



    // =========================================================================
    // REMOVE JUNK FROM HEAD
    // =========================================================================
    remove_action('wp_head', 'rsd_link'); // remove really simple discovery link
    remove_action('wp_head', 'wp_generator'); // remove wordpress version
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_action('wp_head', 'feed_links', 2); // remove rss feed links (make sure you add them in yourself if youre using feedblitz or an rss service)
    remove_action('wp_head', 'feed_links_extra', 3); // removes all extra rss feed links
    remove_action('wp_head', 'index_rel_link'); // remove link to index page
    remove_action('wp_head', 'wlwmanifest_link'); // remove wlwmanifest.xml (needed to support windows live writer)
    remove_action('wp_head', 'start_post_rel_link', 10, 0); // remove random post link
    remove_action('wp_head', 'parent_post_rel_link', 10, 0); // remove parent post link
    remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // remove the next and previous post links
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
    remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );




	// Define constants
    define( 'HOME_URI', home_url() );
    define( 'THEME_URI', get_template_directory_uri() );
    define( 'THEME_DIR', get_template_directory() );
    define( 'THEME_IMAGES', THEME_URI . '/images' );
    define( 'THEME_CSS', THEME_URI . '/css' );
    define( 'THEME_JS', THEME_URI . '/js' );
    define( 'THEME_FRAMEWORK', THEME_DIR . '/framework' );
    define( 'THEME_LIBRARY', THEME_URI . '/lib' );



	// Register Custom Navigation Walker

	require_once('functions/bs4navwalker-master/bs4navwalker.php');


	require_once THEME_DIR . '/functions/woocommerce.php';


	// Register Meta Boxes

	// require_once THEME_DIR . '/functions/cmb-functions.php';


	// Register Menus

	add_action( 'init', 'my_register_menus' );

	function my_register_menus() {
		register_nav_menu( 'social-media', _x( 'Social Media', 'nav menu location', 'example-textdomain' ) );
		register_nav_menus(array('primary-menu' => 'Primary Navigation', 'footer-menu' => 'footer Navigation' ));
	}


	// Register Widget Areas

	if (function_exists('register_sidebar')) {

		register_sidebar(array(
			'name' => 'Sidebar primary',
			'id'   => 'sidebar-primary',
			'description'   => 'This is a the main widgetized area.',
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-body">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h5 class="widget__title">',
			'after_title'   => '</h5>'
		));

		register_sidebar(array(
			'name' => 'Instagram',
			'id'   => 'instagram',
			'description'   => 'This is a the instagram widgetized area.',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>'
		));

		register_sidebar(array(
			'name' => 'Footer 1',
			'id'   => 'footer-1',
			'description'   => 'This is a the main widgetized area.',
			'before_widget' => '<div id="%1$s" class="widget site-footer__widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h6 class="site-footer__widget-title">',
			'after_title'   => '</h6>'
		));

		register_sidebar(array(
			'name' => 'Footer 2',
			'id'   => 'footer-2',
			'description'   => 'This is a the main widgetized area.',
			'before_widget' => '<div id="%1$s" class="widget site-footer__widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h6 class="site-footer__widget-title">',
			'after_title'   => '</h6>'
		));

		register_sidebar(array(
			'name' => 'Footer 3',
			'id'   => 'footer-3',
			'description'   => 'This is a the main widgetized area.',
			'before_widget' => '<div id="%1$s" class="widget site-footer__widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h6 class="site-footer__widget-title">',
			'after_title'   => '</h6>'
		));

	}




add_action('after_setup_theme', 'remove_admin_bar');

function remove_admin_bar() {
if (!current_user_can('administrator') && !is_admin()) {
  show_admin_bar(false);
}
}



	// Scripts

	function cm_script_enqueuer() {
	if (!is_admin()) {
        // Register CSS
		wp_register_style('font-awesome', THEME_URI.'/assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css');
        wp_enqueue_style( 'font-awesome' );

		wp_register_style('animate', THEME_URI.'/assets/css/animate-min.css');
        wp_enqueue_style( 'animate' );

		wp_register_style('lity-css', THEME_URI.'/assets/css/lity.min.css');
        wp_enqueue_style( 'lity-css' );

		wp_register_style( 'screen', THEME_URI.'/style.css', '', '', 'screen' );
        wp_enqueue_style( 'screen' );

		wp_register_script( 'wow-js', THEME_URI .'/assets/js/wow.min.js', array( 'jquery' ), '', false );
	  	wp_enqueue_script( 'wow-js' );

		wp_register_script( 'vide-js', THEME_URI.'/assets/js/jquery.vide.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'vide-js' );

		// wp_register_script( 'magnific-js', THEME_URI.'/assets/js/jquery.magnific-popup.min.js', array( 'jquery' ), '', true );
		// wp_enqueue_script( 'magnific-js' );

		wp_register_script( 'lity-js', THEME_URI.'/assets/js/lity.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'lity-js' );		

		wp_register_script( 'flexslider-js', THEME_URI.'/assets/js/jquery.flexslider-min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'flexslider-js' );

		wp_register_script( 'scripts', THEME_URI.'/assets/js/scripts.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'scripts' );

//    	wp_register_script( 'google-maps-api', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBjQ5wq1a4NFSs-Rxd4RCTbshj6wrmoFgE&callback=initMap', 'jquery', '3.0', true );
//		wp_enqueue_script( 'google-maps-api' );
//

   		wp_register_style('londrina-400', 'https://fonts.googleapis.com/css?family=Londrina+Solid:400');
        wp_enqueue_style( 'londrina-400');

   		wp_register_style('lato', 'https://fonts.googleapis.com/css?family=Lato:400,400i,700');
        wp_enqueue_style( 'lato');

		}
	}
	add_action( 'wp_enqueue_scripts', 'cm_script_enqueuer' );


	// Thumbnail sizes

	if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 150, 150, true ); // default Post Thumbnail dimensions (cropped)

	// additional image sizes
	// delete the next line if you do not need additional image sizes
	add_image_size( 'hero-sm', 1920, 480, true );
	add_image_size( 'hero-lg', 1920, 1280, true );
	add_image_size( 'square-sm', 300, 300, true );
	add_image_size( 'square-md', 600, 600, true );
	add_image_size( 'square-lg', 800, 800, true );
	add_image_size( 'landscape-sm', 750, 400, true );
	add_image_size( 'landscape-md', 800, 400, true );
	add_image_size( 'landscape-lg', 1200, 800, true );
	}

	add_filter('body_class', 'cm_body_class');

	function cm_body_class($classes){
		$user = wp_get_current_user();
		$allowed_roles = array('editor', 'administrator', 'author', 'contributor');
		if( array_intersect($allowed_roles, $user->roles ) ) {
	        $classes[] = 'body-logged-in';
	    } else{
	        $classes[] = '';
	    }
		return $classes;
	}

	// Custom excerpt

	function cm_excerpt( $length ) {
		$excerpt = explode( ' ', get_the_excerpt(), $length );
		if ( count( $excerpt ) >= $length ) {
			array_pop( $excerpt );
			$excerpt = implode( " ", $excerpt );
		} else {
			$excerpt = implode( " ", $excerpt );
		}
		$excerpt = preg_replace( '`\[[^\]]*\]`', '', $excerpt );

		return $excerpt;

	}

add_action('wp_head', 'wpb_add_googleanalytics');
function wpb_add_googleanalytics() { ?>
 
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-132979273-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-132979273-1');
</script>
 
<?php }
