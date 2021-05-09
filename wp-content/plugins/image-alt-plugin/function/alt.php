<?php
// load script 
if(!function_exists('script_admin_alt'))
{ 
	function script_admin_alt() {
			wp_enqueue_style('style_checkbox',SPIP_URL.'css/sp-image.css'); 
			wp_enqueue_script( 'media-custom', SPIP_URL.'js/custom.js'); 
			wp_localize_script( 'media-custom', 'custom_alt', array(
					'ajax_url' => admin_url( 'admin-ajax.php')  
			));
	}
	add_action( 'admin_enqueue_scripts', 'script_admin_alt' );
} 

//create menu alt
if(!function_exists('add_menu_alt_image'))
{
	add_action( 'admin_menu', 'add_menu_alt_image' );
	
	function add_menu_alt_image() {
		add_menu_page( 'Image Plugin', 'Image Plugin', 'manage_options', 'ImagePlugin', 'media_custom_alt_func' ,'dashicons-format-image');

	}
}
