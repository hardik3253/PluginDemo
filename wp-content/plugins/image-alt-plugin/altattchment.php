<?php
/**
 * Plugin Name: SP Image Designer
 * Plugin URI: https://softpulseinfotech.com/
 * Version: 1.0.0
 * Description: Plugin
 * Author: Softpulse Infotech
 * Author URI: https://softpulseinfotech.com
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Basic plugin definitions
 * 
 * @package SP Image Designer
 * @since 1.0.0
 */
if( !defined( 'SPIP_VERSION' ) ) {
	define( 'SPIP_VERSION', '1.0.0' ); // Version of plugin
}
if( !defined( 'SPIP_DIR' ) ) {
	define( 'SPIP_DIR', dirname( __FILE__ ) ); // Plugin dir
}
if( !defined( 'SPIP_URL' ) ) {
	define( 'SPIP_URL', plugin_dir_url( __FILE__ ) ); // Plugin url
}
if( !defined( 'SPIP_PLUGIN_BASENAME' ) ) {
	define( 'SPIP_PLUGIN_BASENAME', plugin_basename( __FILE__ ) ); // Plugin base name
}
if( !defined('SPIP_POST_TYPE') ) {
	define('SPIP_POST_TYPE', 'post'); // Post type name
}
if( !defined('SPIP_CATE') ) {
	define('SPIP_CATE', 'category'); // Post type name
}
if( !defined('SPIP_REMOTE_URL') ) {
	define('SPIP_REMOTE_URL', 'https://ils.shopiapps.in/demo.php'); // Post type name
}
/**
 * Activation Hook
 * 
 * Register plugin activation hook.
 * 
 * @package SP Image Designer
 * @since 1.0
 */
register_activation_hook( __FILE__, 'SpIp_install' );

/**
 * Plugin Setup (On Activation)
 * 
 * Does the initial setup,
 * stest default values for the plugin options.
 * 
 * @package SP Image Designer
 * @since 1.0.6
 */

function SpIp_install() {
	/* Intialization */
}


// Functions file
include_once "function/alt.php";
include_once "incl/media_custom_alt.php";