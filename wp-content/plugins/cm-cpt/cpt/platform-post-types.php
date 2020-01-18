<?php

// Create Custom Post Type

function register_custom_post_types()
{
    // Define post type labels
    $lesson_labels = array (
        'name' => 'Lessons',
        'singular_name' => 'Lesson',
        'menu_name' => 'Lessons',
        'all_items' => 'All Lessons',
        'add_new' => 'Add Lesson',
        'add_new_item' => 'Add Lesson',
        'edit_item' => 'Edit Lesson',
        'new_item' => 'New Lesson',
        'view_item' => 'View Lesson',
        'search_items' => 'Search Lessons',
        'not_found' => 'No Lessons Found',
        'not_found_in_trash' => 'No Lessons Found in Trash',
        
     );
    
    // Define post type arguments
    $lesson_args = array(
        'menu_position' => 6,
        'labels' => $lesson_labels,
        'description' => 'New Lesson',
        'public' => true,
        'capability_type' => 'post',
        'supports' => array( 'title', 'editor', ),
        'has_archive' => true,
        'menu_icon'=> 'dashicons-welcome-widgets-menus',
        'rewrite' => array('slug' => 'dashboard/lessons'),
        'taxonomies' => array('post_tag')
    );
    
    register_post_type( 'Lessons', $lesson_args );

        // Define post type labels
    $warmup_labels = array (
        'name' => 'Warm Ups',
        'singular_name' => 'Warm Up',
        'menu_name' => 'Warm Ups',
        'all_items' => 'All Warm Ups',
        'add_new' => 'Add Warm Up',
        'add_new_item' => 'Add Warm Up',
        'edit_item' => 'Edit Warm Up',
        'new_item' => 'New Warm Up',
        'view_item' => 'View Warm Up',
        'search_items' => 'Search Warm Ups',
        'not_found' => 'No Warm Ups Found',
        'not_found_in_trash' => 'No Warm Ups Found in Trash',
    );
        
    // Define post type arguments
    $warmup_args = array(
        'menu_position' => 7,
        'labels' => $warmup_labels,
        'description' => 'New Warm Up',
        'public' => true,
        'capability_type' => 'post',
        'supports' => array( 'title', 'editor', ),
        'has_archive' => true,
        'menu_icon'=> 'dashicons-plus-alt',
        'taxonomies' => array('post_tag')
    );
        
    register_post_type( 'Warm Ups', $warmup_args );
    
    // Define post type labels
    $games_labels = array (
        'name' => 'Games',
        'singular_name' => 'Game',
        'menu_name' => 'Games',
        'all_items' => 'All Games',
        'add_new' => 'Add Game',
        'add_new_item' => 'Add Game',
        'edit_item' => 'Edit Game',
        'new_item' => 'New Game',
        'view_item' => 'View Game',
        'search_items' => 'Search Games',
        'not_found' => 'No Games Found',
        'not_found_in_trash' => 'No Games Found in Trash',
    );
        
    // Define post type arguments
    $games_args = array(
        'menu_position' => 8,
        'labels' => $games_labels,
        'description' => 'New Game',
        'public' => true,
        'capability_type' => 'post',
        'supports' => array( 'title', 'editor', ),
        'has_archive' => true,
        'menu_icon'=> 'dashicons-groups',
        'rewrite' => array('slug' => 'dashboard/games'),
        'taxonomies' => array('post_tag')
    );
        
    register_post_type( 'Games', $games_args );

        
    // Define post type labels
    $follow_along_labels = array (
        'name' => 'Follow Alongs',
        'singular_name' => 'Follow Along',
        'menu_name' => 'Follow Alongs',
        'all_items' => 'All Follow Alongs',
        'add_new' => 'Add Follow Along',
        'add_new_item' => 'Add Follow Along',
        'edit_item' => 'Edit Follow Along',
        'new_item' => 'New Follow Along',
        'view_item' => 'View Follow Along',
        'search_items' => 'Search Follow Alongs',
        'not_found' => 'No Follow Alongs Found',
        'not_found_in_trash' => 'No Follow Alongs Found in Trash',
    );
        
    // Define post type arguments
    $follow_along_args = array(
        'menu_position' => 9,
        'labels' => $follow_along_labels,
        'description' => 'New Follow Along',
        'public' => true,
        'capability_type' => 'post',
        'supports' => array( 'title', 'editor', ),
        'has_archive' => true,
        'menu_icon'=> 'dashicons-visibility',
        'taxonomies' => array('post_tag')
    );
        
    register_post_type( 'Follow Alongs', $follow_along_args );
}

add_action( 'init', 'register_custom_post_types' );


add_action( 'init', 'create_taxonomies', 0 );

function create_taxonomies()
{
    // Partner Types
    $unit_labels = array(
        'name'              => _x( 'Unit', 'taxonomy general name' ),
        'singular_name'     => _x( 'Unit', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Units' ),
        'all_items'         => __( 'All Units' ),
        'edit_item'         => __( 'Edit Unit' ),
        'update_item'       => __( 'Update Unit' ),
        'add_new_item'      => __( 'Add New Unit' ),
        'new_item_name'     => __( 'New Unit' ),
        'menu_name'         => __( 'Units' ),
    );

    $unit_args = array(
        'hierarchical'      => false,
        'labels'            => $unit_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'show_tagcloud' 	=> false,
        'rewrite'           => array('slug' => 'dashboard/unit-')
    );

    register_taxonomy( 'unit', array( 'lessons', 'games', 'followalongs', 'warmups' ), $unit_args );   

    add_rewrite_rule('^dashboard/unit-(.*)/?','index.php?unit=$matches[1]','top');   

    add_filter( 'term_link', 'change_unit_permalinks', 10, 2 );

    function change_unit_permalinks( $permalink, $term ) {
        if ($term->taxonomy == 'unit') 
        {
            $permalink = str_replace('unit-/', 'unit-', $permalink);
        }
        return $permalink;
    }
}

?>
