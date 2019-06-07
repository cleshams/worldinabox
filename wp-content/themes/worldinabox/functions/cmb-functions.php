<?php
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 *
 * Be sure to replace all instances of 'yourprefix_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category YourThemeOrPlugin
 * @package  Demo_CMB2
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

/**
 * Get the bootstrap! If using the plugin from wordpress.org, REMOVE THIS!
 */

if ( file_exists( THEME_DIR . '/fuctions/CMB2/init.php' ) ) {
	require_once THEME_DIR . '/fuctions/CMB2/init.php';
} elseif ( file_exists( THEME_DIR . '/fuctions/CMB2/init.php' ) ) {
	require_once THEME_DIR . '/fuctions/CMB2/init.php';
}


/**
 * Conditionally displays a metabox when used as a callback in the 'show_on_cb' cmb2_box parameter
 *
 * @param  CMB2 object $cmb CMB2 object
 *
 * @return bool             True if metabox should show
 */
function yourprefix_show_if_front_page( $cmb ) {
	// Don't show this metabox if it's not the front page template
	if ( $cmb->object_id !== get_option( 'page_on_front' ) ) {
		return false;
	}
	return true;
}

/**
 * Conditionally displays a field when used as a callback in the 'show_on_cb' field parameter
 *
 * @param  CMB2_Field object $field Field object
 *
 * @return bool                     True if metabox should show
 */
function yourprefix_hide_if_no_cats( $field ) {
	// Don't show this field if not in the cats category
	if ( ! has_tag( 'cats', $field->object_id ) ) {
		return false;
	}
	return true;
}

/**
 * Conditionally displays a message if the $post_id is 2
 *
 * @param  array             $field_args Array of field parameters
 * @param  CMB2_Field object $field      Field object
 */
function yourprefix_before_row_if_2( $field_args, $field ) {
	if ( 2 == $field->object_id ) {
		echo '<p>Testing <b>"before_row"</b> parameter (on $post_id 2)</p>';
	} else {
		echo '<p>Testing <b>"before_row"</b> parameter (<b>NOT</b> on $post_id 2)</p>';
	}
}

add_action( 'cmb2_init', '_cm_register_metabox' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_init' hook.
 */
function _cm_register_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_cm_';



	$hero_options = new_cmb2_box( array(
		'id'           => $prefix . 'page_hero_options',
		'title'        => __( 'Hero Options', 'cmb2' ),
		'object_types' => array( 'page', 'classes' ), // Post type
		'context'      => 'normal',
		'priority'     => 'low',
		'show_names'   => true, // Show field names on the left
	) );


	$hero_options->add_field( array(
		'name'       => __( 'Hero Title', 'cmb2' ),
		'desc'       => __( 'Title for the main Hero section', 'cmb2' ),
		'id'         => $prefix . 'hero_title',
		'type'       => 'text',
	) );

	$hero_options->add_field( array(
		'name'       => __( 'Hero Text', 'cmb2' ),
		'desc'       => __( 'Text for the main Hero section', 'cmb2' ),
		'id'         => $prefix . 'hero_text',
		'type'       => 'textarea',
	) );

	$hero_options->add_field( array(
		'name'       => __( 'Hero Image', 'cmb2' ),
		'desc'       => __( 'Image for the main Hero section', 'cmb2' ),
		'id'         => $prefix . 'hero_image',
		'type'       => 'file',
	) );




	$page_options = new_cmb2_box( array(
		'id'           => $prefix . 'page_options',
		'title'        => __( 'Page Options', 'cmb2' ),
		'object_types' => array( 'page', 'classes' ), // Post type
		'context'      => 'normal',
		'priority'     => 'low',
		'show_names'   => true, // Show field names on the left
	) );

	$page_options->add_field( array(
		'name'       => __( 'Page alt title', 'cmb2' ),
		'desc'       => __( 'Title for the main content section', 'cmb2' ),
		'id'         => $prefix . 'page_alt_title',
		'type'       => 'text',
	) );



	$contact_meta = new_cmb2_box( array(
		'id'           => $prefix . 'contact_meta',
		'title'        => __( 'Contact page Options', 'cmb2' ),
		'object_types' => array( 'page' ), // Post type
        'show_on'      => array( 'key' => 'page-template', 'value' => 'templates/template-home.php' ),
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true, // Show field names on the left
	) );

    $contact_meta->add_field( array(
        'name'         => __( 'Contact Address', 'cm' ),
        'desc'         => __( 'Enter address', 'cm' ),
        'id'           => $prefix . 'contact_address',
        'type'         => 'textarea',
    ) );

    $contact_meta->add_field( array(
        'name'         => __( 'Contact Office Phone', 'cm' ),
        'desc'         => __( 'Enter office phone number', 'cm' ),
        'id'           => $prefix . 'contact_office_phone',
        'type'         => 'text',
    ) );

    $contact_meta->add_field( array(
        'name'         => __( 'Contact Mobile Phone', 'cm' ),
        'desc'         => __( 'Enter mobile phone number', 'cm' ),
        'id'           => $prefix . 'contact_mobile_phone',
        'type'         => 'text',
    ) );


        $testimonials_options = new_cmb2_box( array(
            'id'           => $prefix . 'testimonials_options',
            'title'        => __( 'Testimonials Options', 'cmb2' ),
            'object_types' => array( 'testimonials', ), // Post type
            'context'      => 'normal',
            'priority'     => 'high',
            'show_names'   => true, // Show field names on the left
        ) );

        $testimonials_options->add_field( array(
            'name' => 'Client Name',
            'desc' => 'Enter the client name text',
            'id' =>  $prefix . 'testimonial_name',
            'type' => 'text',
        ) );

        $testimonials_options->add_field( array(
            'name' => 'Client Detail',
            'desc' => 'Enter the business name text',
            'id' =>  $prefix . 'testimonial_detail',
            'type' => 'text',
        ) );
    
}


class cm_Admin {
	/**
 	 * Option key, and option page slug
 	 * @var string
 	 */
	private $key = 'cm_options';
	/**
 	 * Options page metabox id
 	 * @var string
 	 */
	private $metabox_id = 'cm_option_metabox';
	/**
	 * Options Page title
	 * @var string
	 */
	protected $title = '';
	/**
	 * Options Page hook
	 * @var string
	 */
	protected $options_page = '';
	/**
	 * Constructor
	 * @since 0.1.0
	 */
	public function __construct() {
		// Set our title
		$this->title = __( 'Site Options', 'cm' );
	}
	/**
	 * Initiate our hooks
	 * @since 0.1.0
	 */
	public function hooks() {
		add_action( 'admin_init', array( $this, 'init' ) );
		add_action( 'admin_menu', array( $this, 'add_options_page' ) );
		add_action( 'cmb2_init', array( $this, 'add_options_page_metabox' ) );
	}
	/**
	 * Register our setting to WP
	 * @since  0.1.0
	 */
	public function init() {
		register_setting( $this->key, $this->key );
	}
	/**
	 * Add menu options page
	 * @since 0.1.0
	 */
	public function add_options_page() {
		$this->options_page = add_menu_page( $this->title, $this->title, 'manage_options', $this->key, array( $this, 'admin_page_display' ) );
		// Include CMB CSS in the head to avoid FOUT
		add_action( "admin_print_styles-{$this->options_page}", array( 'CMB2_hookup', 'enqueue_cmb_css' ) );
	}
	/**
	 * Admin page markup. Mostly handled by CMB2
	 * @since  0.1.0
	 */
	public function admin_page_display() {
		?>
		<div class="wrap cmb2-options-page <?php echo $this->key; ?>">
			<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
			<?php cmb2_metabox_form( $this->metabox_id, $this->key, array( 'cmb_styles' => false ) ); ?>
		</div>
		<?php
	}
	/**
	 * Add the options metabox to the array of metaboxes
	 * @since  0.1.0
	 */
	function add_options_page_metabox() {

		$option_key = '_cm_theme_options';


		$cmb = new_cmb2_box( array(
			'id'      => $this->metabox_id,
			'hookup'  => false,
			'show_on' => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key, )
			),
		) );

		$cmb->add_field( array(
		    'name' 		=> 'Site phone number',
		    'desc' 		=> 'The site wide telephone number',
		    'id' 		=> 'site_phone',
			'type'      => 'text',
		) );

	}
	/**
	 * Public getter method for retrieving protected/private variables
	 * @since  0.1.0
	 * @param  string  $field Field to retrieve
	 * @return mixed          Field value or exception is thrown
	 */
	public function __get( $field ) {
		// Allowed fields to retrieve
		if ( in_array( $field, array( 'key', 'metabox_id', 'title', 'options_page' ), true ) ) {
			return $this->{$field};
		}
		throw new Exception( 'Invalid property: ' . $field );
	}
}
/**
 * Helper function to get/return the cm_Admin object
 * @since  0.1.0
 * @return cm_Admin object
 */
function cm_admin() {
	static $object = null;
	if ( is_null( $object ) ) {
		$object = new cm_Admin();
		$object->hooks();
	}
	return $object;
}
/**
 * Wrapper function around cmb2_get_option
 * @since  0.1.0
 * @param  string  $key Options array key
 * @return mixed        Option value
 */
function cm_get_option( $key = '' ) {
	return cmb2_get_option( cm_admin()->key, $key );
}
// Get it started
cm_admin();
