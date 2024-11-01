<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://alexeyvolkov.com/
 * @since             0.6
 * @package           Simple_Youtube_Gdpr
 *
 * @wordpress-plugin
 * Plugin Name:       Simple YouTube GDPR
 * Plugin URI:        https://alexeyvolkov.com/blog/simple-youtube-gdpr
 * Description:       Integrate YouTube and Vimeo videos securely!
 * Version:           1.2
 * Author:            Alexey Volkov
 * Author URI:        https://alexeyvolkov.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       simple-youtube-gdpr
 * Domain Path:       /languages
 */
/**
 * Freemius
 */
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

if ( function_exists( 'syg_fs' ) ) {
    syg_fs()->set_basename( false, __FILE__ );
} else {
    if ( !function_exists( 'syg_fs' ) ) {
        // ... Freemius integration snippet ...
        
        if ( !function_exists( 'syg_fs' ) ) {
            // Create a helper function for easy SDK access.
            function syg_fs()
            {
                global  $syg_fs ;
                
                if ( !isset( $syg_fs ) ) {
                    // Include Freemius SDK.
                    require_once dirname( __FILE__ ) . '/freemius/start.php';
                    $syg_fs = fs_dynamic_init( array(
                        'id'             => '4426',
                        'slug'           => 'simple-youtube-gdpr',
                        'premium_slug'   => 'simple-youtube-gdpr-gold',
                        'type'           => 'plugin',
                        'public_key'     => 'pk_72bcdfa58a1ac164e91d2916748e0',
                        'is_premium'     => false,
                        'premium_suffix' => 'premium',
                        'has_addons'     => false,
                        'has_paid_plans' => true,
                        'menu'           => array(
                        'first-path' => 'plugins.php',
                        'contact'    => false,
                        'support'    => false,
                    ),
                        'is_live'        => true,
                    ) );
                }
                
                return $syg_fs;
            }
            
            // Init Freemius.
            syg_fs();
            // Signal that SDK was initiated.
            do_action( 'syg_fs_loaded' );
        }
    
    }
    // ... Your plugin's main file logic ...
    // If this file is called directly, abort.
    if ( !defined( 'WPINC' ) ) {
        die;
    }
    /**
     * Currently plugin version.
     * Start at version 0.6 and use SemVer - https://semver.org
     * Rename this for your plugin and update it as you release new versions.
     */
    define( 'SIMPLE_YOUTUBE_GDPR_VERSION', '1.2' );
    /**
     * The code that runs during plugin activation.
     * This action is documented in includes/class-simple-youtube-gdpr-activator.php
     */
    function activate_simple_youtube_gdpr()
    {
        require_once plugin_dir_path( __FILE__ ) . 'includes/class-simple-youtube-gdpr-activator.php';
        Simple_Youtube_Gdpr_Activator::activate();
    }
    
    /**
     * The code that runs during plugin deactivation.
     * This action is documented in includes/class-simple-youtube-gdpr-deactivator.php
     */
    function deactivate_simple_youtube_gdpr()
    {
        require_once plugin_dir_path( __FILE__ ) . 'includes/class-simple-youtube-gdpr-deactivator.php';
        Simple_Youtube_Gdpr_Deactivator::deactivate();
    }
    
    register_activation_hook( __FILE__, 'activate_simple_youtube_gdpr' );
    register_deactivation_hook( __FILE__, 'deactivate_simple_youtube_gdpr' );
    /**
     * The core plugin class that is used to define internationalization,
     * admin-specific hooks, and public-facing site hooks.
     */
    require plugin_dir_path( __FILE__ ) . 'includes/class-simple-youtube-gdpr.php';
    /**
     * Begins execution of the plugin.
     *
     * Since everything within the plugin is registered via hooks,
     * then kicking off the plugin from this point in the file does
     * not affect the page life cycle.
     *
     * @since    0.6
     */
    function run_simple_youtube_gdpr()
    {
        $plugin = new Simple_Youtube_Gdpr();
        $plugin->run();
    }
    
    run_simple_youtube_gdpr();
}
