<?php
/**
 * Plugin Name: Ultimate Member + WP User Frontend - Addon
 * Plugin URI: http://devwp.pl
 * Description: Integration of "Ultimate Member" + "WP User Fronted" in user profiles
 * Version: 1.0.0
 * Author: DevWP
 * Author URI: http://devwp.pl
 * Text Domain: ufa
 */
 
require_once dirname( __FILE__ ) . '/lib/class.settings-api.php';
require_once dirname( __FILE__ ) . '/admin/options.php';

if ( !class_exists('UFA_plugin' ) ):   
  class UFA_plugin {
  
  }
endif;
$ufa = new UFA_plugin();
?>
