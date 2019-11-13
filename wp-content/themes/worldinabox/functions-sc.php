<?php

add_action('admin_bar_menu', 'add_toolbar_items', 100);

function add_toolbar_items($admin_bar)
{
    if(null !== IS_LOCAL && IS_LOCAL == true)
    {
        $env = 'local';
    }
    elseif(null !== IS_STAGING && IS_STAGING == true)
    {
        $env = 'staging';
    }
    else
    {
        $env = 'production';
    }
    $admin_bar->add_menu( array(
        'id'    => 'environment-'.$env,
        'title' => 'Environment: '.__(ucfirst($env)),
        'href'  => '#',
        'meta'  => array(
            'title' => __(ucfirst($env)),            
        ),
    ));
}

function admin_style_css()
{
    wp_enqueue_style('admin-styles', get_template_directory_uri().'/assets/css/admin.css');
}

add_action('admin_enqueue_scripts', 'admin_style_css');


/*************************** */
// Force option for editor for certain pages
/*************************** */

add_filter('classic_editor_enabled_editors_for_post', 'control_editor_for_post');

function control_editor_for_post($editors)
{
    global $post;

    if($post == null)
    {
        $editors['classic_editor'] = true;
        $editors['block-editor'] = false;

        return $editors;
    }

    switch ($post->post_type) {
        case 'post':
            $editors['classic_editor'] = false;
            $editors['block-editor'] = true;
            break;
        
        case 'page':
            if($post->post_name == 'glossary')
            {
                $editors['classic_editor'] = true;
                $editors['block-editor'] = false;    
            }
            else
            {
                $editors['classic_editor'] = false;
                $editors['block-editor'] = true;
            }
            break;
        
        default:
            $editors['classic_editor'] = true;
            $editors['block-editor'] = false;
            break;
    }
   
    return $editors;
}



/*************************** */
// Hex to RGB
/*************************** */

function hextorgb($hex) {
    // extra sanity check that we're dealing with the hex colors
    // in #NNNNNN format that ACF/WordPress/Iris colorpicker returns
    if (strlen($hex) == 7 && substr($hex,0,1) == '#') {
        $r = hexdec(substr($hex,1,2));
        $g = hexdec(substr($hex,3,2));
        $b = hexdec(substr($hex,5,2));
        return $r . ',' . $g . ',' . $b;
    }
    else {
        // provide a default in an emergency
        return "128,128,128" ;
    }
}

/*************************** */
// Pre Get Posts (order lessons by lesson number)
/*************************** */

add_action( 'pre_get_posts', 'order_lessons_by_number');

function order_lessons_by_number($query)
{
    if(!is_admin() && $query->is_tax('unit'))
    {
        $query->set('orderby', 'meta_value_num');
        $query->set('meta_key', 'lesson_number');
        $query->set('order', 'ASC');
    }
}



/*************************** */
// Allow SVG uploads
/*************************** */

function cc_mime_types( $mimes ){
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
    }
add_filter( 'upload_mimes', 'cc_mime_types' );
    

/*************************** */
// Update view count
/*************************** */

function register_view($postId)
{
    $viewCount = get_post_meta($postId, 'view_count');

    if(!$viewCount)
    {
        add_post_meta($postId, 'view_count', 0);
        $viewCount = 0;
    }

    $user = get_current_user();

    // if(!array_intersect(array('administrator'),$user->roles))
    // {
        update_post_meta($postId, 'view_count', $viewCount + 1 );
    // }
}


/*************************** */
// Display view count
/*************************** */
add_filter( 'manage_lessons_posts_columns', 'set_custom_lesson_columns' );

function set_custom_lesson_columns($columns)
{
    $columns['view_count'] = __('View Count');

    return $columns;
}

add_action( 'manage_lessons_posts_custom_column' , 'custom_lessons_column', 10, 2 );

function custom_lessons_column($column, $postId)
{
    switch($column)
    {
        case 'view_count' :
            $viewCount = get_post_meta($postId, 'view_count', true);
            echo ($viewCount) ? $viewCount : 0;
            break;
    }
}