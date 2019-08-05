<?php
/*
* Plugin Name: CM Custom Post Types
* Plugin URI: http://www.geckodesign.co.uk
* Description: Theme specific Custom Post Types.
* Version: 1.0
* Author: Gecko Design
* Author URI: http://www.geckodesign.com
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Register CPT
require_once( dirname(__FILE__) . '/cpt/testimonials-type.php');
require_once( dirname(__FILE__) . '/cpt/platform-post-types.php');