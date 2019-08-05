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
