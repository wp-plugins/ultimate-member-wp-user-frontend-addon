<?php      
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
class UAF_Settings {

    private $settings_api;

    function __construct() {
        $this->settings_api = new WeDevs_Settings_API();

        add_action( 'admin_init', array($this, 'admin_init') );
        add_action( 'admin_menu', array($this, 'admin_menu') );
    }

    function admin_init() {

        //set the settings
        $this->settings_api->set_sections( $this->get_settings_sections() );
        $this->settings_api->set_fields( $this->get_settings_fields() );

        //initialize settings
        $this->settings_api->admin_init();
    }

    function admin_menu() {
        add_options_page( 'UFA Settings', 'UFA Settings', 'activate_plugins', 'ufa_settings', array($this, 'plugin_page') );
    }

    function get_settings_sections() {
        $sections = array(
          array(
            'id' => 'settings_basic',
            'title' => __( 'Basic Settings', 'ufa' )
          )
        );
        return $sections;
    }

    function get_settings_fields() {
    
            global $ultimatemember;
            $fields = array(
                'settings_basic' => array(
                    array(
                        'name' => 'roles',
                        'label' => __( 'Roles', 'ufa' ),
                        'desc' => __( 'In waht roles want to show add posts box.', 'ufa' ),
                        'type' => 'multicheck',
                        'options' => $ultimatemember->query->get_roles(),
                    )
                )
            );
            return $fields;
    }

    function plugin_page() {
        ?>
        <div class="wrap">
            <?php
            settings_errors();

            screen_icon( 'options-general' );
            $this->settings_api->show_navigation();
            $this->settings_api->show_forms();
            ?>
        </div>
        <?php
    }  
} 
$wpuf_settings = new UAF_Settings();       