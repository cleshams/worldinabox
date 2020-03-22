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
            $link = $resource['url'];
            $title = $resource['title'];
            echo '
                <dd><a href="'.$link.'" target="_blank" class="resource-link">
                    <span class="icon">';
                        include('assets/images/icons/other.php');
                    echo '</span>
                    <span>' . $title . '</span>
                </a></dd>';
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
                echo '<dd><a href="'.$file['url'].'" download class="resource-link">
                    <span class="icon">';
                    include('assets/images/icons/' . $musicItem['link_type'] . '.php');
                    echo '</span>
                    <span>' . $title .'</span>
                </a></dd>';
                break;
            
            default: 
                $link = $musicItem['link'];
                $title = $musicItem['title'];
                echo '<dd><a href="' . $link . '" class="resource-link">
                    <span class="icon">'; include('assets/images/icons/' . $musicItem['link_type'] . '.php');
                    echo '</span>
                    <span>' . $title .'</span>
                </a></dd>';
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

/********************************************* */
//Remove Version from styles
/********************************************* */

add_filter( 'style_loader_src',  'sdt_remove_ver_css_js', 9999, 2 );
add_filter( 'script_loader_src', 'sdt_remove_ver_css_js', 9999, 2 );

function sdt_remove_ver_css_js( $src, $handle ) 
{
    $handles_with_version = [ 'style' ]; // <-- Adjust to your needs!

    if ( strpos( $src, 'ver=' ) && ! in_array( $handle, $handles_with_version, true ) )
        $src = remove_query_arg( 'ver', $src );

    return $src;
}


/********************************************* */
//Add Options Page
/********************************************* */

if( function_exists( 'acf_add_options_page' ) ) {

	// Create top level options page
	acf_add_options_page(array(
		'page_title' 	=> 'Site Options',
		'menu_title'	=> 'Site Options',
		'menu_slug' 	=> 'site-options',
		'capability'	=> 'edit_posts',
		'icon_url' 		=> 'dashicons-admin-settings',
		'redirect'		=> true
    ));
    
}


/********************************************* */
//Additional Billing Fields
/********************************************* */

add_filter('woocommerce_billing_fields', 'wiab_woocommerce_billing_fields');

function wiab_woocommerce_billing_fields($fields)
{
    $fields['billing_school_org_name'] = array(
        'type'		=> 'text',
        'label' 	=> __('School / Organisation Name', 'woocommerce'),
        'required' 	=> true,
        'class' 	=> array('form-row-wide'),
        'clear' 	=> true
    );
    $fields['billing_school_org_name']['custom_attributes']['data-lookup-reference'] = 'School_Name';


    $localAuthorities = get_field('local_authority', 'options');

    $localAuthorityNames = array();

    foreach($localAuthorities as $localAuthority)
    {
        $localAuthorityNames[$localAuthority['name']] = $localAuthority['name'];
    }

    $fields['billing_local_authority'] = array(
        'type'          => 'select',
        'options'       => $localAuthorityNames,
        'label'         => __('Local Authority', 'woocommerce'),
        'placeholder'   => _x('', 'placeholder', 'woocommerce'),
        'required'      => false,
        'class'         => array('form-row-wide','hidden'),
        'clear'         => true
    );

    return $fields;
}

add_action('woocommerce_checkout_update_user_meta', 'wiab_woocommerce_checkout_update_user_meta', 10, 3);

function motd_woocommerce_checkout_update_user_meta($customer_id, $posted)
{
    if(isset($posted['school_org_name']))
    {
        $urn = sanitize_text_field($posted['school_org_name']);
        update_user_meta($customer_id, 'school_org_name', $urn);
    }
    $la = $posted['local_authority'];
    update_field('local_authority', $la, 'user_'.$customer_id);
}


add_action( 'woocommerce_admin_order_data_after_billing_address', 'woo_show_additional_form_fields', 10, 1 );

function woo_show_additional_form_fields($order)
{
    $new_text_fields = array(
        'local_authority' => 'Local Authority',
        'school_org_name' => 'School / Organisation Name',
    );
    foreach($new_text_fields as $key => $value) 
    {
        echo '<p><strong>'.__($value).':</strong> ' . get_post_meta( $order->get_id(), $value, true ) . '</p>';
    }
}

add_filter('user_contactmethods', 'update_contact_methods', 10, 1);

function update_contact_methods($fields) {
    $fields['school_org_name'] = 'School /Organisation Name';
    $fields['local_authority'] = 'Local Authority';

    return $fields;
}


function importLA()
{
    $csv = fopen(get_stylesheet_directory().'/LocalAuthorities.csv', 'r');
    $urnLength = count(file(get_stylesheet_directory()."/LocalAuthorities.csv"));


    for($j = 1; $j <= $urnLength; $j++) :
        $cols = fgetcsv($csv, 0, ',');
        if(!$cols) { continue; }
        $la = array('name' => $cols[0]);

        $i = add_row('field_5e6a509776ea2', $la, 'options');
        echo $i;
    endfor;
}


/********
 * Shotcode for Classes on Active Minutes
 ********/

function classes_section_render()
{
    ob_start();
    get_template_part('/templates/classes');
    return ob_get_clean();
}
add_shortcode( 'classes', 'classes_section_render' );


/********
 * Shotcode for Classes on Inactive Statistic
 ********/

 function render_inactive_statistic(){
    $current_user_id = get_current_user_id();
    $userlocalAuthority = get_field('local_authority', 'user_'.$current_user_id);

    $localAuthorities = get_field('local_authority', 'options');
    $localAuthority = array();
    foreach($localAuthorities as $la)
    {
        if($la['name'] == $userlocalAuthority)
        {
            $localAuthority = $la;
        }
    }
    $inactive = $localAuthority['inactive_stat'];

    ob_start();
    ?>
    <p class="inactive_stat">
        Percentage of Population that are inactive in <?=$userlocalAuthority?>
        <br><span><?=$inactive?>%</span>
    </p>
    <?php 
    return ob_get_clean();
 }
 add_shortcode('inactive-statistic', 'render_inactive_statistic');



/********
 * Shotcode for Classes on Inactive Statistic
 ********/

function render_obesity_statistic(){
    $current_user_id = get_current_user_id();
    $userlocalAuthority = get_field('local_authority', 'user_'.$current_user_id);

    $localAuthorities = get_field('local_authority', 'options');
    $localAuthority = array();
    foreach($localAuthorities as $la)
    {
        if($la['name'] == $userlocalAuthority)
        {
            $localAuthority = $la;
        }
    }
    $obesity = $localAuthority['obesity_stat'];
    
    return '<strong>'.$obesity.'%</strong>';
}
add_shortcode('obesity-statistic', 'render_obesity_statistic');




/********
 * Shotcode for Leaderboard
 ********/

function render_leaderboard()
{
    $current_user_id = get_current_user_id();
    $classes = get_field('classes', 'user_'.$current_user_id);
    $school_name = get_user_meta($current_user_id, 'school_org_name', true);
    if(!is_array($classes) || count($classes) < 2)
    {
        exit;
    }
   
    foreach($classes as $index => $class) 
    {
        $total = 0;
        $results = json_decode($class['results']);
        $values = get_object_vars($results);
        $total = array_sum($values);
        $lessons = count(array_filter($values));
        $average = ($total > 0 && $lessons > 0) ?$total / $lessons : 0;
        $classes[$index]['average'] = $average;
    }
    if(is_array($classes) && count($classes) > 2) {

        function average_sort($a, $b)
        {
            return ($a['average'] > $b['average']) ? -1 : 1;
        }
        $classesOrdered = usort( $classes, "average_sort"); 

        ob_start();
        ?>
        </div>
    </section>
    <section class="container container--inner">
        <header>
            <h2 class="text__title"><?= $school_name;?> Leaderboard</h2>
        </header>
        <div class="leaderboard-container">
            <table>
                <thead>
                    <th>Class Name</th>
                    <th>Unit</th>
                    <th>Average Active Minutes</th>
                </thead>
                <tbody>
                    <?php
                    foreach($classes as $class) 
                    {
                        echo '<tr>
                            <td>'.$class['class_name'] . '</td>
                            <td>'.$class['unit']->name.'</td>
                            <td>';
                            echo ($class['average'] != 0) ? number_format((float)$class['average'],1) : '-';
                            echo '</td>
                        </tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php 
        return ob_get_clean();
    }
}
add_shortcode('leaderboard', 'render_leaderboard');


/********
 * Save new class
 ********/

add_action( 'wp_ajax_nopriv_save_new_class', 'save_new_class' );
add_action( 'wp_ajax_save_new_class', 'save_new_class' );

function save_new_class()
{
    $userId = $_POST['userId'];
    $className = $_POST['className'];
    $unitSlug = $_POST['unit'];

    $unit = get_term_by('slug', $unitSlug, 'unit');

    $row = array(
        'class_name' => $className,
        'unit' => $unit,
        'results' => '{"1":null,"2":null,"3":null,"4":null,"5":null,"6":null}'
    );
    $result = add_row('classes', $row, 'user_'.$userId);
    return $result;
}



/********
 * Save lesson 
 ********/

add_action( 'wp_ajax_nopriv_save_lesson_data', 'save_lesson_data' );
add_action( 'wp_ajax_save_lesson_data', 'save_lesson_data' );

function save_lesson_data()
{
    $userId = $_POST['userId'];
    $className = $_POST['className'];
    $unitSlug = $_POST['unit'];
    $rowId = $_POST['rowId'];
    $results = $_POST['results'];       

    $unit = get_term_by('slug', $unitSlug, 'unit');

    $row = array(
        'class_name' => $className,
        'unit' => $unit,
        'results' => $results
    );
    $result = update_row('classes', $rowId, $row, 'user_'.$userId);
    return $result;
   
}