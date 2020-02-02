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
    $viewCount = get_post_meta($postId, 'view_count', true);

    if(!$viewCount)
    {
        add_post_meta($postId, 'view_count', 0);
        $viewCount = 0;
    }

    $user = get_current_user();

    // if(!array_intersect(array('administrator'),$user->roles))
    // {
        update_post_meta($postId, 'view_count', ($viewCount + 1) );
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

add_filter( 'manage_games_posts_columns', 'set_custom_game_columns' );

function set_custom_game_columns($columns)
{
    $columns['view_count'] = __('View Count');

    return $columns;
}

add_action( 'manage_games_posts_custom_column' , 'custom_games_column', 10, 2 );

function custom_games_column($column, $postId)
{
    switch($column)
    {
        case 'view_count' :
            $viewCount = get_post_meta($postId, 'view_count', true);
            echo ($viewCount) ? $viewCount : 0;
            break;
    }
}

add_filter( 'manage_followalongs_posts_columns', 'set_custom_followalong_columns' );

function set_custom_followalong_columns($columns)
{
    $columns['view_count'] = __('View Count');

    return $columns;
}

add_action( 'manage_followalongs_posts_custom_column' , 'custom_followalongs_column', 10, 2 );

function custom_followalongs_column($column, $postId)
{
    switch($column)
    {
        case 'view_count' :
            $viewCount = get_post_meta($postId, 'view_count', true);
            echo ($viewCount) ? $viewCount : 0;
            break;
    }
}

add_filter( 'manage_warmups_posts_columns', 'set_custom_warmup_columns' );

function set_custom_warmup_columns($columns)
{
    $columns['view_count'] = __('View Count');

    return $columns;
}

add_action( 'manage_warmups_posts_custom_column' , 'custom_warmups_column', 10, 2 );

function custom_warmups_column($column, $postId)
{
    switch($column)
    {
        case 'view_count' :
            $viewCount = get_post_meta($postId, 'view_count', true);
            echo ($viewCount) ? $viewCount : 0;
            break;
    }
}


/*************************** */
// Display view count
/*************************** */

function extend_search_query( $query ) {
    if ( array_key_exists('meta_query', $query->query))
    {
        if(is_array($query->query['meta_query']) && $query->query['meta_query'][0]['key'] == 'keywords') {
            add_filter( 'get_meta_sql', 'es_replace_and_with_or' );
        };
    }
}


function es_replace_and_with_or( $sql ) {
      if ( 1 === strpos( $sql['where'], 'AND' ) ) {
          $sql['where'] = substr( $sql['where'], 4 );
          $sql['where'] = ' OR ' . $sql['where'];
      }
  
      //make sure that this filter will fire only once for the meta query
      remove_filter( 'get_meta_sql', 'es_replace_and_with_or' );
      return $sql;
  }
  
add_filter( 'pre_get_posts', 'extend_search_query');




/********************************************* */
//Register an FAQ block for Gutenberg using ACF 
/********************************************* */

function ac_acf_block_render_callback( $block ) {
	
	// convert name ("acf/testimonial") into path friendly slug ("testimonial")
	$slug = str_replace('acf/', '', $block['name']);
	
	// include a template part from within the "template-parts/block" folder
	if( file_exists(STYLESHEETPATH . "/acf-templates/acf_block-{$slug}.php") ) {
		include( STYLESHEETPATH . "/acf-templates/acf_block-{$slug}.php" );
	}
}


add_action('acf/init', 'custom_acf_init');

function custom_acf_init()
{	
	// check function exists
	if( function_exists('acf_register_block') ) {
		
		// register a testimonial block
		acf_register_block(array(
			'name'				=> 'faq',
			'title'				=> __('FAQ'),
			'description'		=> __('A custom block for frequently asked questions.'),
			'render_callback'	=> 'ac_acf_block_render_callback',
			'category'			=> 'formatting',
			'icon'				=> 'admin-comments',
			'keywords'			=> array( 'faq', 'questions', 'faqs' ),
		));
	}
}



/********************************************* */
//Render Music Resources
/********************************************* */

function renderMusic($source, $resource)
{
    switch ($source) {
        case 'spotify':
            $songLink = $resource['url'];
            print_spotify_embed($songLink);
            break;
        
        case 'soundcloud':
            echo '
                <a href="'.$resource['url'].'" class="resource-link" target="_blank">
                <span class="icon">';
                include('assets/images/icons/' . $source . '.php');
                echo '</span>
                <span>Soundcloud</span></a>';
            break;
        
        case 'youtube':
            echo '
            <a href="'.$resource['url'].'" class="resource-link" target="_blank">
            <span class="icon">';
            include('assets/images/icons/' . $source . '.php');
            echo '</span>
            <span>Youtube</span></a>';
            break;
        
        default:
            # code...
            break;
    }
}

/********************************************* */
//Print a Spotify Song Embed
/********************************************* */
function print_spotify_embed($songLink)
{
    if(strpos($songLink, 'https://open.spotify.com/track/') > -1)
    {
        $linkParts = explode('/', $songLink);

        echo '<dd>
                <iframe src="https://open.spotify.com/embed/track/'.end($linkParts).'" width="300" height="80" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>
            </dd>';
    }
    else
    {
        echo '<dd><a href="$songLink">'.$songLink.'</a></dd>';
    }

}


/********************************************* */
//Fetch lesson objectives
/********************************************* */

add_action( 'wp_ajax_nopriv_fetch_objectives', 'fetch_objectives' );
add_action( 'wp_ajax_fetch_objectives', 'fetch_objectives' );

function fetch_objectives() {
    $data = $_POST['id'];

    $objectives = get_field('objectives', $data);

    echo wp_json_encode($objectives);
    die();
}



/********************************************* */
//Render Music Field Group
/********************************************* */

function renderMusicFields($music) {
    if(is_array($music) && count($music) > 0)
    foreach($music as $musicItem) :
        switch ($musicItem['link_type']) {
            case 'spotify':
                $songlink = $musicItem['link'];
                print_spotify_embed($songlink);
                break;

            case 'file' :
                $file = $musicItem['file'];
                $title = $musicItem['title'];
                echo '<a href="'.$file['url'].'" download class="resource-link">
                    <span class="icon">';
                    include('assets/images/icons/' . $musicItem['link_type'] . '.php');
                    echo '</span>
                    <span>' . $title .'</span>
                </a>';
                break;
            
            default: 
                $link = $musicItem['link'];
                $title = $musicItem['title'];
                echo '<a href="' . $link . '" class="resource-link">
                    <span class="icon">'; include('assets/images/icons/' . $musicItem['link_type'] . '.php');
                    echo '</span>
                    <span>' . $title .'</span>
                </a>';
                break;
        }
    endforeach;
}

/*
* Covert dropbox share link to download link
*/

function returnDropboxEmbed($videoURL)
{
    if(strpos($videoURL, 'dl=0'))
    {
       $videoURL =  str_replace('?dl=0', '?raw=1', $videoURL);
    }
    else
    {
        //there is an issue...
    }
    return $videoURL;
}