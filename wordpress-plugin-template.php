<?php
/**
 * Plugin Name: [ Plugin Name ]
 * Plugin URI: [ Plugin URI ]
 * Description: [ Description ]
 * Version:     1.0.0
 * Author:      [ Author ]
 * Author URI:  [ Author URI ]
 * Contributors: [ Contributors ]
 * License:     GPL3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.en.html
 * Text Domain: [ Text Domain ]
 * Domain Path: [ Domain Path ]
 */

class WP_Plugin_Template {

    public function  __construct()
    {
        // If this file is called directly, abort.
        if ( ! defined( 'WPINC' ) ) {
            die;
        }

        if ( !defined( 'PLUGIN_ROOT_DIR' ) ) {
            define( 'PLUGIN_ROOT_DIR', plugin_dir_path(__FILE__) );
        }

        if ( !defined( 'PLUGIN_BASE_NAME' ) ) {
            define( 'PLUGIN_BASE_NAME', plugin_basename(__FILE__) );
        }

        if ( !defined( 'PLUGIN_URL' ) ) {
            define( 'PLUGIN_URL', plugin_dir_url(__FILE__) );
        }

        if ( !defined( 'PLUGIN_SLUG_NAME') ) {
            define( 'PLUGIN_SLUG_NAME', 'wpplugintemplate' );
        }

        // Includes
        include( PLUGIN_ROOT_DIR . 'includes/class-admin-settings.php' );
        include( PLUGIN_ROOT_DIR . 'includes/class-load-assets.php' );
    }

}

// Initialize Plugin
new WP_Plugin_Template();