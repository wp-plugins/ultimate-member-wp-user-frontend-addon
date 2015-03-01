<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
/**
 * Plugin Name: Ultimate Member + WP User Frontend - Addon
 * Plugin URI: http://devwp.pl/ultimate-member-wp-user-frontend-addon/
 * Description: Integration of "Ultimate Member" + "WP User Fronted" in user profiles
 * Version: 1.0.0
 * Author: DevWP
 * Author URI: http://devwp.pl
 * Text Domain: ufa
 */
if ( !class_exists( 'WeDevs_Settings_API' ) ) { 
  require_once dirname( __FILE__ ) . '/lib/class.settings-api.php';
}
require_once 'admin/options.php';
require_once 'user-dashboard.php';

    function scripts(){
    	    wp_enqueue_style( 'style-ufa', plugins_url('css/style.css', __FILE__) ); 
    }
    add_action('wp_enqueue_scripts','scripts');
    $slugadd = __( 'add-post', 'ufa' );
    $slugview = __( 'my-post', 'ufa' );

    /* Zakładka moje wpisy w profilu */
    add_filter('um_profile_tabs', 'moje_wpisy_tab', 1000 );
    function moje_wpisy_tab( $tabs  ) {
      $tabs[__( 'add-post', 'ufa' )] = array(
        'name' => __( 'Add posts', 'ufa' ),
        'icon' => 'um-faicon-pencil-square',
      );
      return $tabs;
    }
    add_action('um_profile_content_'.$slugview.'_default', 'moje_wpisy_tab_default');
    function moje_wpisy_tab_default( $args ) {
      echo do_shortcode('[wpuf_dashboard_new]');   
    }
    
    /* Zakładka dodaj wpis w profilu */
    add_filter('um_profile_tabs', 'dodaj_wpis_tab', 1010 );
    function dodaj_wpis_tab( $tabs ) {
        $tabs[__( 'my-post', 'ufa' )] = array(
          'name' => __( 'My posts', 'ufa' ),
          'icon' => 'um-faicon-pencil-square-o',
        );
        return $tabs;
    }
    add_action('um_profile_content_'.$slugadd.'_default', 'dodaj_wpis_tab_default');
    function dodaj_wpis_tab_default( $args ) {
      echo do_shortcode('[wpuf_addpost]');
    }
    
    add_filter('um_user_profile_tabs', 'disable_user_tab', 1000 );
    function disable_user_tab( $tabs ) {
      global $ultimatemember;
    	$user_id = um_user('ID');
    	$role = get_user_meta( $user_id, 'role', true );
      $roles = get_option('settings_basic');	
      if(!um_is_myprofile() || !in_array($role, $roles['roles'])){
        unset( $tabs[__( 'add-post', 'ufa' )] );
        unset( $tabs[__( 'my-posts', 'ufa' )] );           
      }  
        
    	return $tabs;
    } 
?>
