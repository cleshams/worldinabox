<?php

	/***************************************

	Global woocommerce functions

	****************************************/


	function mytheme_add_woocommerce_support() {
		add_theme_support( 'woocommerce' );
	}
	add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );


	add_action( 'after_setup_theme', 'activello_theme_setup' );
	function activello_theme_setup() {
	  add_theme_support( 'wc-product-gallery-zoom' );
	  add_theme_support( 'wc-product-gallery-lightbox' );
	  add_theme_support( 'wc-product-gallery-slider' );
	}


	/**
	 * Opening div for our content wrapper
	 */
	add_action('woocommerce_before_main_content', 'iconic_open_div', 15);

	function iconic_open_div() {
		    echo '<section class="main-content shop-content"><div class="container container--inner">';
	}

	/**
	 * Closing div for our content wrapper
	 */
	add_action('woocommerce_after_main_content', 'iconic_close_div', 50);

	function iconic_close_div() {
		    echo '</div></section>';
	}



	/**
	 * Remove the breadcrumbs
	 */
	add_action( 'init', 'woo_remove_wc_breadcrumbs' );
	function woo_remove_wc_breadcrumbs() {
	    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
	}

	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

	remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );

	remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description', 10 );

	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

	add_filter( 'woocommerce_show_page_title', '__return_false' );


function woo_category_lists() {

	$orderby = 'name';
	$order = 'asc';
	$hide_empty = true ;
	$cat_args = array(
	    'orderby'    => $orderby,
	    'order'      => $order,
	    'hide_empty' => $hide_empty,
		'exclude' => array( 15 ),
	);

	$product_categories = get_terms( 'product_cat', $cat_args );
    
    $colour = "shop-cat-nav__link--green";

	if( !empty($product_categories) ){
		echo '<div class="shop-cat-nav">';
	    echo '<div class="container container--narrow">';
	    echo '<h5 class="page-header">Filter products:</h5>';
		echo '<ul class="shop-cat-nav__list">';
	        echo '<li class="shop-cat-nav__item"><a href="/shop/" class="shop-cat-nav__link">All</a></li>';
	        	$i = 0;

	    foreach ($product_categories as $key => $category) {
	    	$i++;

                if ($i % 5 == 0) {
                  $colour = "shop-cat-nav__link--green";
                } 

                if ($i % 2 == 0) {
                  $colour = "shop-cat-nav__link--blue";
                }

                if ($i % 3 == 0) {
                  $colour = "shop-cat-nav__link--purple";
                } 

                if ($i % 4 == 0) {
                  $colour = "shop-cat-nav__link--orange";
                }

                if ($i % 6 == 0) {
                  $colour = "shop-cat-nav__link--red";
                } 

	        echo '<li class="shop-cat-nav__item">';
	        echo '<a href="'.get_term_link($category).'" class="shop-cat-nav__link ' . $colour . '">';
	        echo $category->name;
	        echo '</a>';
	        echo '</li>';
	    }
	    echo '</ul>';
        echo '</div>';
        echo '</div>';
	}
}


/**
 * Display category image on category archive
 */
add_action( 'woocommerce_before_main_content', 'woocommerce_category_image', 0 );
function woocommerce_category_image() {

	if ( is_product_category() || is_shop() ){

    if ( is_product_category() ){
	    global $wp_query;
	    $cat = $wp_query->get_queried_object();
	    $thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
	    $image = wp_get_attachment_url( $thumbnail_id );
	} else if ( is_shop() ) {
		// $image = THEME_URI . '/assets/images/shop__bg.jpg';
		$base_thumb = wc_get_page_id( 'shop' );
		$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $base_thumb ), "hero-lg" );
		$image = $thumbnail[0];
	}
	    echo '<div class="hero hero--medium hero-shop" style="background-image: url(' . $image . ');">';
	    echo '<div class="hero__overlay hero__overlay--purple"></div>';
	    echo '<div class="hero__content--abs">';
	    echo '<div class="hero__content-inner">';
	    echo '<div class="container container--inner">';
	    echo '<div class="columns">';
	    echo '<div class="columns__column columns__column--half">';
	    echo '<h1 class="hero-shop__title">';
	    woocommerce_page_title();
	    echo '</h1>';
	    echo '<div class="hero__text">';

	}
}

add_action( 'woocommerce_before_main_content', 'woocommerce_taxonomy_archive_description', 5 );
add_action( 'woocommerce_before_main_content', 'woocommerce_product_archive_description', 5 );


add_action( 'woocommerce_before_main_content', 'woocommerce_add_closing_divs', 10 );
function woocommerce_add_closing_divs() {
	    if ( is_product_category() || is_shop() ){
	    	echo '</div></div></div></div></div></div></div></div>';

	    	woo_category_lists();

	    }
}


add_action( 'woocommerce_before_main_content', 'woocommerce_add_hero', 5);
function woocommerce_add_hero() {

	if ( is_product() ) {
		$base_thumb = wc_get_page_id( 'shop' );
		$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $base_thumb ), "hero-lg" );
		$image = $thumbnail[0];

	    echo '<div class="hero hero--small hero-shop" style="background-image: url(' . $image . ');">';
	    echo '<div class="hero__overlay hero__overlay--purple"></div>';
	    echo '<div class="hero__content--abs">';
	    echo '<div class="hero__content-inner">';
	    echo '<div class="container container--inner">';
	    echo '<div class="columns">';
	    echo '<div class="columns__column columns__column--half">';
	    echo '<h1 class="hero-shop__title">';
	    woocommerce_page_title();
	    echo '</h1>';
	    echo '<div class="hero__text">';
	    echo '</div></div></div></div></div></div></div></div>';
	    woo_category_lists();
	}
}

