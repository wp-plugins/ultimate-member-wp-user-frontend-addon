<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
/**
 * Plugin Name: Ultimate Member + WP User Frontend - Addon
 * Plugin URI: http://devwp.pl/ultimate-member-wp-user-frontend-addon/
 * Description: Integration of "Ultimate Member" + "WP User Fronted" in user profiles
 * Version: 1.1.2
 * Author: DevWP
 * Author URI: http://devwp.pl
 * Text Domain: ufa
 */
if ( !class_exists( 'WeDevs_Settings_API' ) ) { 
  require_once dirname( __FILE__ ) . '/lib/class.settings-api.php';
}
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if(is_plugin_active('ultimate-member')){
  require_once 'admin/options.php';
  require_once 'user-dashboard.php';
  require_once 'actions.php';
}
    function scripts(){
    	    wp_enqueue_style( 'style-ufa', plugins_url('css/style.css', __FILE__) ); 
    }
    add_action('wp_enqueue_scripts','scripts');
    
    add_action( 'plugins_loaded', 'ufa_load_language' );
    function ufa_load_language() {
      load_plugin_textdomain( 'ufa', false, dirname( plugin_basename( __FILE__ ) ) . '/lang' ); 
    }    

    
?>
