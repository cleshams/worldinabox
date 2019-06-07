<?php

// Create Custom Post Type


add_action( 'init', 'testimonials_post_type' );
/**
 * Creating the custom post type
 *
 * This functions is attached to the 'init' action hook.
 */
function testimonials_post_type() {
    $labels = array(
        'name' => 'Testimonials',
        'singular_name' => 'Testimonial',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Testimonial',
        'edit_item' => 'Edit Testimonial',
        'new_item' => 'New Testimonial',
        'view_item' => 'View Testimonial',
        'search_items' => 'Search Testimonials',
        'not_found' =>  'No Testimonials found',
        'not_found_in_trash' => 'No Testimonials in the trash',
        'parent_item_colon' => '',
    );

    register_post_type( 'testimonials', array(
        'labels' => $labels,
        'public'            => true,
        'show_ui'           => true,
        'publicly_queryable'=> true,
        'query_var'         => true,
        'capability_type'   => 'post',
        'has_archive'       => false,
        'hierarchical'      => false,
        'rewrite'           => array( 'slug' => 'residents/testimonials' ),
        'supports' => array( 'editor', 'page-attributes', 'thumbnail', 'title')
    ) );
}


    /* ========================================================================================================================

    Custom Post type icons http://melchoyce.github.io/dashicons/

    ======================================================================================================================== */

    function add_testimonials_menu_icons_styles(){
    ?>

    <style>
    #adminmenu #menu-posts-testimonials div.wp-menu-image:before {
        content: "\f473";
    }
    </style>
    <?php
    }
    add_action( 'admin_head', 'add_testimonials_menu_icons_styles' );


?>
