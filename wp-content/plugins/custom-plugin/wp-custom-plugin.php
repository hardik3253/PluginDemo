<?php
/*
Plugin Name: Custom Plugin
Plugin URI: #
Description: This is custom plugin
Version: 1.0
Author: Hardik Prajapati
Author URI: #
Text Domain: Custom Plugin
*/

// constants
define("PLUGIN_DIR_PATH",plugin_dir_path(__FILE__));
define("PLUGIN_URL",plugins_url());
define("PLUGIN_VERSION","1.0");

function add_my_custom_menu(){
    add_menu_page(
        "customplugin", // page title
        "Custom Plugin", // menu title
        "manage_options", // admin level
        "custom-plugin1", // page slug
        "add_new_function", // callback function
        "dashicons-dashboard" // icon url
        ,11
    );

    add_submenu_page(
        "custom-plugin1", // parent slug
        "Add New", // page title
        "Add New", // menu title
        "manage_options", // capability = user_level access
        "custom-plugin1", // menu slug
        "add_new_function" // callback function
    );

    add_submenu_page(
        "custom-plugin1", // parent slug
        "All Pages", // page title
        "All Pages", // menu title
        "manage_options", // capability = user_level access
        "all-pages", // menu slug
        "all_page_function" // callback function
    );
}
add_action("admin_menu","add_my_custom_menu");

function add_new_function(){
    // add new function
    include_once PLUGIN_DIR_PATH."/views/add-new.php";
}

function all_page_function(){
    // all page function
    include_once PLUGIN_DIR_PATH."/views/all-page.php";
}

function custom_plugin_assets(){
    // css and js files
    wp_enqueue_style(
        "cpl_style", // unique name for css file
        PLUGIN_URL."/custom-plugin/assets/css/style.css", // css file path
        '', //dependency on other files
        PLUGIN_VERSION // plugin version number
    );

    wp_enqueue_script(
        "cpl_script",
        PLUGIN_URL."/custom-plugin/assets/js/script.js", // css file path
        '',
        PLUGIN_VERSION,
        true
    );

    // $object_array = array(
    //     "Name"=>"WordPress Developer",
    //     "Autor"=>"Hardik Prajapati",
    //     "ajaxurl"=>admin_url("admin-ajax")
    // );
    wp_localize_script("cpl_script","ajaxurl",admin_url("admin-ajax.php"));
}
add_action("init","custom_plugin_assets");

if(isset($_REQUEST['action'])){ // it checks the action param is set or not
    switch($_REQUEST['action']){ // if pass to switch method or match case
        case "custom_plugin_library" :
            add_action("admin_init","add_custom_plugin_library"); // match case
            function add_custom_plugin_library(){ // function attached with the action hook
                global $wpdb;
                include_once PLUGIN_DIR_PATH."/library/custom-plugin-lib.php"; // ajax handler file within /library folder
            }
            break;
    }
}

//custom ajax_req from js file
add_action("wp_ajax_custom_ajax_req","custom_ajax_req_fn");
function custom_ajax_req_fn(){
    echo json_encode($_REQUEST);
    wp_die();
}

add_action('wp_ajax_custom_plugin','prefix_ajax_custom_plugin');
function prefix_ajax_custom_plugin(){
    print_r($_REQUEST);
    wp_die();
}

// table generating code
function custom_plugin_tables(){
    global $wpdb;
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    if(count(array($wpdb->get_var('SHOW TABLES LIKE "wp_custom_plugin"')) == 0)){
        $sql_query_to_create_table = "CREATE TABLE `wp_custom_plugin` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `name` varchar(150) DEFAULT NULL,
                    `email` varchar(150) DEFAULT NULL,
                    `phone` varchar(150) DEFAULT NULL,
                    `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
                    PRIMARY KEY (`id`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4"; // sql query to create table
        dbDelta($sql_query_to_create_table);
    }
}
register_activation_hook(__FILE__,'custom_plugin_tables');

function deactivate_table(){
    // uninstall mysql code
    global $wpdb;
    $wpdb->query("DROP table IF Exists wp_custom_plugin");

    // step1: we get the id of post means page
    // delete the post from table

    $the_post_id = get_option("custom_plugin_page_id");
    if(!empty($the_post_id)){
        wp_delete_post($the_post_id, true);
    }

}
register_deactivation_hook(__FILE__,'deactivate_table');

// register_uninstall_hook(); -- it deletes the page when plugin will be deleted from list

function create_page(){
    // code for create page
    $page = array();
    $page['post_title'] = "Custom Plugin Online Web Tutor";
    $page['post_content'] = "Learning for WordPress Customization for Theme, Plugin";
    $page['post_status'] = "publish";
    $page['post_slug'] = "custom-plugin-online";
    $page['post_type'] = "page";

    $post_id = wp_insert_post($page); // post_id as return value

    add_option("custom_plugin_page_id",$post_id); // wp_options table from the name of custom_plugin_page_id
}
register_activation_hook(__FILE__,'create_page');

?>